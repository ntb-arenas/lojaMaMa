<?php

session_start();

include_once  './connect_DB.php';
include_once './function_mail_utf8.php';


// iniciar e limpar possíveis mensagens de erro
$temporaryMsg = "";

$errorMessageUsername = "";
$errorMessageUsername = "";
$errorMessagePassword = "";
$errorMessagePasswordRecover = "";
$errorMessagefName = "";
$errorMessagelName = "";

// inciar e limpar variáveis
$username = "";
$email = "";
$password = "";
$passwordConfirmation = "";
$fName = "";
$lName = "";
$aceito = "";
$aceitoMarketing = 0;

$geraFormulario = "Sim";


if (isset($_POST['button-cancel-account'])) {

    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
    header("Location: ../index.php");
}


if (isset($_POST['submit-create-account'])) {


    $podeCriarRegisto = "Sim";

    // obter parametros (determinadas validações poderiam ser feitas no lado cliente)
    $username = mysqli_real_escape_string($_conn, $_POST['formUser']);
    $username = strtolower(trim($username));
    $email = mysqli_real_escape_string($_conn, $_POST['formEmail']);
    $email = strtolower(trim($email));
    $password = mysqli_real_escape_string($_conn, $_POST['formPassword1']);
    $password = trim($password);
    $passwordConfirmation = mysqli_real_escape_string($_conn, $_POST['formPassword2']);
    $passwordConfirmation = trim($passwordConfirmation);
    $fName = mysqli_real_escape_string($_conn, $_POST['formfName']);
    $fName = trim($fName);
    $lName = mysqli_real_escape_string($_conn, $_POST['formlName']);
    $lName = trim($lName);
    $aceito = $_POST['formAceito'];

    if ($aceito == "aceito_marketing") {
        $aceitoMarketing = 1;
    } else {
        $aceitoMarketing = 0;
    }

    // retirar possíveis tags html do código
    $username = strip_tags($username);
    $email = strip_tags($email);
    $fName = strip_tags($fName);
    $lName = strip_tags($lName);

    // não permitir que um user tenha espaços no código...
    $username = str_replace(' ', '', $username);

    // validar parametros recebidos

    if (strlen(trim($username)) < 4) {
        $errorMessageUsername = "O código de utilizador é demasiado curto!";
        $podeCriarRegisto = "Nao";
    }

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessageUsername = "O e-mail não é válido!";
        $podeCriarRegisto = "Nao";
    }


    if (strlen(trim($password)) < 8) {
        $errorMessagePassword = "A senha tem que ter pelo menos 8 caracteres!";
        $podeCriarRegisto = "Nao";
    }

    if ($password != $passwordConfirmation) {
        $errorMessagePasswordRecover = "A senha de confirmação deve ser igual à primeira password!";
        $podeCriarRegisto = "Nao";
    }


    if (strlen(trim($fName)) < 2) {
        $errorMessagefName = "O primeiro nome é demasiado curto!";
        $podeCriarRegisto = "Nao";
    }

    if (strlen(trim($lName)) < 2) {
        $errorMessagelName = "O ultimo nome é demasiado curto!";
        $podeCriarRegisto = "Nao";
    }

    // a check box não precisa de ser validada..

    // inicio

    if ($podeCriarRegisto == "Sim") {

        // validações corretas: validar se existe utilizador
        $stmt = $_conn->prepare('SELECT * FROM USERS WHERE USERNAME = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();

        $usersResult = $stmt->get_result();

        if ($usersResult->num_rows > 0) {

            $errorMessageUsername = "Já existe um utilizador registado com este código.";

            $stmt->free_result();
            $stmt->close();
        } else {


            ///////////////////////////////////
            // INSERE UTILIZADOR NA BASE DE DADOS
            //////////
            $sql = "INSERT INTO USERS (USERNAME, EMAIL, PASSWORD, fNAME, lNAME, USER_LEVEL, USER_STATUS, MSGS_MARKETING, DATE_HOUR) VALUES (?,?,?,?,?,?,?,?,?)";

            if ($stmt = mysqli_prepare($_conn, $sql)) {

                $nivel = 1;
                $status = 0;

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                date_default_timezone_set('Europe/Lisbon');
                $data_hora = date("Y-m-d H:i:s", time());

                mysqli_stmt_bind_param($stmt, "sssssiiis", $username, $email, $passwordHash, $fName, $lName, $nivel, $status, $aceitoMarketing, $data_hora);


                mysqli_stmt_execute($stmt);

                $geraFormulario = "Nao";
            } else {

                echo "STATUS ADMIN (inserir user): " . mysqli_error($_conn);
            }

            mysqli_stmt_close($stmt);
            //////////
            // INSERIDO
            ////////////////////////////////////////

            ////////////////////////////////////////////////////////////////////////////
            // registo efetuado, gerar token, preparar e enviar mail de ativação
            $code = md5(uniqid(rand()));

            $sql = "UPDATE USERS SET TOKEN_CODE=? WHERE USERNAME=?";

            if ($stmt = mysqli_prepare($_conn, $sql)) {

                mysqli_stmt_bind_param($stmt, "ss", $code, $username);
                mysqli_stmt_execute($stmt);

                // Update efetuado com sucesso, preparar e enviar mensagem 
                $id = base64_encode($username);

                $urlPagina = "http://localhost:8888/";

                // ou: $urlPagina = "http://alexandrebarao.infinityfreeapp.com/";

                $mensagem = "Caro(a) $fName " . $lName . "," . "\r\n" .  "\r\n" .

                    "Obrigado por se ter registado." . "\r\n" .  "\r\n" .

                    "Para ativar a sua conta basta carregar na seguinte ligação:" . "\r\n" . "\r\n" .

                    $urlPagina . "userVerifyAccount.php?id=$id&code=$code" . "\r\n" . "\r\n" .

                    "Esta mensagem foi-lhe enviada automaticamente.";

                $subject = "Ativação da sua conta em $urlPagina";

                $mensagem = wordwrap($mensagem, 70);

                // send email
                mail_utf8($email, $subject, $mensagem);
                //echo $mensagem; // apenas para efeitos de teste...
                //$temporar$temporaryMsg = $email . " " . $subject . " " . $mensagem;
                $temporaryMsg = $temporaryMsg . " " . "$fName, verifique por favor a sua caixa de correio para ativar de imediato a sua conta! Por vezes estas mensagens são consideradas correio não solicitado. Se não vir a mensagem de ativação verifique o seu correio não solicitado (SPAM).";
            } else {
                echo "STATUS ADMIN (gerar token): " . mysqli_error($_conn);
            }

            mysqli_stmt_close($stmt);
        }
    }


    // fim

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma-Ma Criar Conta</title>
</head>

<body>

    <main>
        <div class="div-container">
            <div class="container">
                <h3>Criar Conta</h3>
                <?php
                if ($geraFormulario == "Sim") {
                ?>

                    <form action="#" method="POST">
                        <input type="text" placeholder="Código de utilizador" name="formUser" value="<?php echo $username; ?>">
                        <p><?php echo $errorMessageUsername; ?></p>

                        <input type="email" placeholder="e-Mail" name="formEmail" value="<?php echo $email; ?>">
                        <p><?php echo $errorMessageUsername; ?></p>


                        <input type="password" placeholder="Senha" name="formPassword1" value="<?php echo $password; ?>">
                        <p><?php echo $errorMessagePassword; ?></p>

                        <input type="password" placeholder="Confirmação de Senha" name="formPassword2" value="<?php echo $passwordConfirmation; ?>">
                        <p><?php echo $errorMessagePasswordRecover; ?></p>


                        <input type="text" placeholder="Primeiro Nome" name="formfName" value="<?php echo $fName; ?>">
                        <p><?php echo $errorMessagefName; ?></p>

                        <input type="text" placeholder="Ultimo Nome" name="formlName" value="<?php echo $lName; ?>">
                        <p><?php echo $errorMessagelName; ?></p>

                        <input type="checkbox" name="formAceito" value="aceito_marketing" <?php if ($aceitoMarketing == 1) {
                                                                                                echo " checked";
                                                                                            } ?>>
                        <label> Aceito que os meus dados sejam utilizados para efeitos de marketing</label>

                        <p>
                            <button name="submit-create-account" type="submit">CRIAR CONTA</button>
                            <button name=button-cancel-account type="submit">CANCELAR</button>

                        </p>
                    </form>

                <?php
                } else {
                ?>


                    <p>Conta criada com sucesso</p>
                    <p><b><?php echo $temporaryMsg; ?></b></p>

                    <form action="../index.php" method="POST">
                        <!-- A LINHA SEGUINTE DEVE SER REMOVIDA EM INSTANCIAÇÃO COM SERVIÇO DE EMAIL ATIVO -->
                        <textarea rows="10" cols="50"><?php echo $mensagem; ?></textarea>

                        <p><button type="submit">VOLTAR</button></p>

                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </main>

</body>

</html>