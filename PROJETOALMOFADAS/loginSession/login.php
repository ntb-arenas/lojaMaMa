<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

// to see all errors:
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

include_once  './connect_DB.php';

$errorMessageUsername = "";
$errorMessagePassword = "";

if (isset($_SESSION["USER"])) {
    header("Location: ../index.php"); // redirects them to homepage
    exit; // for good measure
}

if (isset($_POST['button-cancel'])) {
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
    header("Location: ../index.php");
}

if (isset($_POST['button-login'])) {

    $username = strtolower(trim(mysqli_real_escape_string($_conn, $_POST["formUsername"])));
    $username = trim($username);

    $password = trim(mysqli_real_escape_string($_conn, $_POST["formPassword"]));
    $password = trim($password);

    $username = strip_tags($username);

    $stmt = $_conn->prepare('SELECT * FROM USERS WHERE USERNAME = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $usersResult = $stmt->get_result();

    if ($usersResult->num_rows > 0) {
        while ($rowUsers = $usersResult->fetch_assoc()) {

            if ($rowUsers['USER_STATUS'] == 2) { // BLocked user

                $errorMessagePassword = "Não é possível entrar no sistema. Contacte os nossos serviços para obter ajuda.";
            } else  if ($rowUsers['USER_STATUS'] == 0) { // User account created but not verified

                $errorMessagePassword =  $rowUsers['fNAME'] . ", ainda não ativou a sua conta. A mensagem com o código inicial de ativação de conta foi enviada para a sua caixa de correio. Caso não a encontre na sua caixa de entrada, verifique também o seu correio não solicitado ou envie-nos um email para ativarmos a sua conta. Obrigado.";
            } else  if (password_verify($password, $rowUsers["PASSWORD"])) {

                $_SESSION["USER"] = $rowUsers["USERNAME"];
                $_SESSION["LEVEL_USER"] = $rowUsers["USER_STATUS"];
                $_SESSION["FIRSTNAME_USER"] = $rowUsers["fNAME"];
                $_SESSION["LASTNAME_USER"] = $rowUsers["lNAME"];
                $_SESSION["MORADA_USER"] = $rowUsers["MORADA"];
                $_SESSION["COD_POSTAL_USER"] = $rowUsers["COD_POSTAL"];
                $_SESSION["CIDADE_USER"] = $rowUsers["CIDADE"];
                $_SESSION["PAIS_USER"] = $rowUsers["PAIS"];
                $_SESSION["TELEMOVEL_USER"] = $rowUsers["TELEMOVEL"];
                $_SESSION["EMAIL_USER"] = $rowUsers["EMAIL"];

                header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
                header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
                header("Location: ../index.php");
            } else {
                $errorMessagePassword = "password incorreta!";
            }
        }
    } else {
        $errorMessageUsername = "O código de utilizador não existe na nossa base de dados!";
    }

    $stmt->free_result();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma-Ma Entrar</title>
    <link rel="stylesheet" href="../css/loginSession.css">
</head>

<body class="login-page">
    <!-- interface para entrar no sistema -->
    <main>
        <div class="form-login">
            <div class="form-container">
                <div class="form-logo">
                    <div class="form-logo-content">
                        <a href="../index.php"><img src="../gallery/logo.png" alt=""></a>
                    </div>
                </div>
                <form action="#" method="POST">
                    <fieldset class="login-input-fieldset">
                        <legend>Código de Utilizador</legend>
                        <input class="input-login" type="text" name="formUsername" value="<?php echo $username; ?>">
                    </fieldset>
                    <p><?php echo $errorMessageUsername; ?></p>

                    <fieldset class="login-input-fieldset">
                        <legend>Senha</legend>
                        <input class="input-login" type="password" name="formPassword" value="<?php echo $password; ?>">
                    </fieldset>
                    <p><?php echo $errorMessagePassword; ?></p>

                    <div class="div-forgot-password">
                        <a href="./userRecuperarSenha.php">Esqueceu-se da palavra-passe?</a>
                    </div>

                    <div class="div-button-login">
                        <button class="btn" name="button-login" type="submit"><span>INICIAR SESSÃO</span></button>
                        <button class="btn" name="button-cancel" type="submit"><span>CANCELAR</span></button>
                    </div>
                </form>

                <div class="div-criar-conta">
                    <a href="./userCreateAccount.php">Criar Conta</a>
                </div>
            </div>
        </div>
    </main>


</body>

</html>