<?php

session_start();
error_reporting(E_ERROR | E_PARSE);


include_once  './connect_DB.php';
include_once './function_mail_utf8.php';

$mensagemErrousername = "";
$mensagemErroSenha = "";
$mensagemErroEmail = "";
$geraFormulario = "Sim";



if (isset($_POST['botao-recuperar-senha'])) {

    $username = mysqli_real_escape_string($_conn, $_POST['formusername']);
    $username = strtolower(trim($username));


    $stmt = $_conn->prepare('SELECT * FROM USERS WHERE USERNAME = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $resultadoUsers = $stmt->get_result();

    if ($resultadoUsers->num_rows > 0) {
        while ($rowUsers = $resultadoUsers->fetch_assoc()) {

            $fName = $rowUsers['fNAME'];
            $lName = $rowUsers['lNAME'];

            if ($rowUsers['USER_STATUS'] == 2) { // utilizador bloqueado

                $mensagemErroSenha = "Não foi enviada mensagem de recuperação de senha, contacte os nossos serviços para obter ajuda.";
            } else  if ($rowUsers['USER_STATUS'] == 0) { // Utilizador criou a conta mas não ativou

                $mensagemErroSenha =  $rowUsers['fNAME'] . ", ainda não ativou a sua conta. A mensagem com o código inicial de ativação de conta foi enviada para a sua caixa de correio. Caso não a encontre na sua caixa de entrada, verifique também o seu correio não solicitado ou envie-nos um email para ativarmos a sua conta. Obrigado.";
            } else {

                // Recuperar a senha 
                // gerar token, preparar e enviar mail de recuperação

                $code = md5(uniqid(rand()));

                $sql = "UPDATE USERS SET TOKEN_CODE=? WHERE USERNAME=?";

                if ($stmt = mysqli_prepare($_conn, $sql)) {

                    mysqli_stmt_bind_param($stmt, "ss", $code, $username);
                    mysqli_stmt_execute($stmt);

                    // Update efetuado com sucesso, preparar e enviar mensagem 
                    $id = base64_encode($username);

                    $urlPagina = "https://ntbarenas.000webhostapp.com/loginSession/";


                    $mensagem = "Caro(a) $fName" . "," . "\r\n" .  "\r\n" .


                        "Foi-nos pedido para recuperar a sua senha. Se nos pediu isto basta seguir as instruções seguintes, caso contrário, ignore esta mensagem." . "\r\n" .  "\r\n" .

                        "Para recuperar agora a sua senha basta carregar na seguinte ligação:" . "\r\n" . "\r\n" .

                        $urlPagina . "userNovaSenha.php?id=$id&code=$code" . "\r\n" . "\r\n" .

                        "Esta mensagem foi-lhe enviada automaticamente.";

                    $subject = "Recuperação da sua senha em $urlPagina";

                    // use wordwrap() if lines are longer than 70 characters
                    $mensagem = wordwrap($mensagem, 70);

                    // send email
                    mail_utf8($email, $subject, $mensagem);
                    // echo $mensagem; // apenas para efeitos de teste...
                    //$msgTemporaria = $email . " " . $subject . " " . $mensagem;
                    // mail enviado

                    $mensagemEmail = " " . "$nome, verifique por favor a sua caixa de correio para recuperar de imediato a sua senha!";

                    // fim do envio de mensagem //////////////////////////////////////////////////////////////////            

                    $geraFormulario = "Nao";
                } else {
                    // erro
                    echo "STATUS ADMIN (recuperar senha): " . mysqli_error($_conn);
                }
            }
        }
    } else {
        $mensagemErrousername = "O código de utilizador não existe na nossa base de dados!";
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
    <title>Ma-Ma Profile</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/loginSession.css">
    <link rel="shortcut icon" href="../gallery/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <main>
        <!--Header starts here-->
        <header>
            <div class="logo">
                <a href="../index.php">
                    <img src="../gallery/logo.png" alt="Ma-ma logo" class="logo">
                </a>
            </div>

            <div class="search-bar">
                <input type="search" placeholder="Encontre o produto de que precisa...">
                <span><img src="../gallery/searchBtn.png" id="searchBtn"></span>
            </div>

            <?php
            if (isset($_SESSION["USER"])) { ?>
                <div class="divIcon">
                    <span><a href="#"><img src="../gallery/like.png" id="likeBtn"></a></span>
                    <span><a href="../profileAccount.php"><img src="../gallery/user.png" id="userBtn"></a></span>
                    <span><a href="#"><img src="../gallery/cart.png" id="cartBtn"></a></span>
                </div>
            <?php } else { ?>
                <div class="divIcon">
                    <span><a href="#"><img src="gallery/like.png" id="likeBtn"></a></span>
                    <span><a href="./login.php"><img src="../gallery/user.png" id="userBtn"></a></span>
                    <span><a href="#"><img src="gallery/cart.png" id="cartBtn"></a></span>
                </div>
            <?php } ?>


        </header>
        <!--Header ends here-->

        <!--Navbar starts here-->
        <div class="navBar">
            <?php
            $resultTablecategory = mysqli_query($_conn, "SELECT * FROM CATEGORY WHERE VISIBLE = 1 ORDER BY SEQUENCE ASC");

            if (mysqli_num_rows($resultTablecategory) > 0) {
                $ctd = 0;
                while ($rowTablecategory = mysqli_fetch_assoc($resultTablecategory)) {
                    $ctd = $ctd + 1;

            ?>

                    <span><a href="../<?php echo $rowTablecategory['LINK'] ?>"><?php echo $rowTablecategory['TITLE'] ?></a></span>

            <?php
                }
            }
            ?>
        </div>
        <!--Navbar ends here-->

        <div class="information-container">
            <div class="sidebar-main">
                <div class="customer-area">
                    <h1>
                        Olá <?php echo $_SESSION["FIRSTNAME_USER"] ?>
                    </h1>
                    <h3><a href="./userSair.php">Logout</a></h3>
                </div>

                <div class="account-panel">
                    <h3>PAINEL DE CONTA</h3>
                    <div class="account-panel-wrapper">
                        <p><a href="../profileAccount.php">A MINHA CONTA</a></p>
                        <p><a href="#">AS MINHAS ENCOMENDAS</a></p>
                        <p><a href="#">SUBSCRIÇÃO MARKETING</a></p>
                    </div>
                </div>
            </div>

            <div class="information-component">
                <h1>Recuperar Senha</h1>
                <br>
                <div class="editAcc-box">
                    <div class="information-editAcc-content">
                        <?php

                        if ($geraFormulario == "Sim") {

                        ?>

                            <form action="#" method="POST">

                                <p>Introduza o código que utiliza para inciar sessão e carregue no botão para recuperar senha. Será enviada para o seu e-mail uma mensagem com um código de recuperação de senha.
                                    Por vezes estas mensagens são consideradas correio não solicitado. Se não vir a mensagem de recuperação verifique o seu correio não solicitado (SPAM).
                                </p>

                                <fieldset class="editAcc-fieldset">
                                    <legend>Código de Utilizador</legend>
                                    <div class="div-input">
                                        <input type="text" class="editAcc-input" name="formusername" value="<?php echo $username; ?>">
                                    </div>
                                </fieldset>
                                <p><?php echo $mensagemErrousername; ?></p>

                                <p><?php echo $mensagemErroSenha; ?></p>
                                <p><?php echo $mensagemErroEmail; ?></p>

                                <p><button name="botao-recuperar-senha" type="submit">Recuperar senha agora</button></p>

                            </form>

                        <?php
                        } else {
                        ?>
                            <p>Recuperação de senha: <i>link</i> de recuperação enviado. Verifique a sua caixa de correio.</p>

                            <form action="../loginSession/userRecuperarSenha.php" method="POST">
                                <!-- A LINHA SEGUINTE DEVE SER REMOVIDA EM INSTANCIAÇÃO COM SERVIÇO DE EMAIL ATIVO -->
                                <textarea rows="10" cols="50"><?php echo $mensagem; ?></textarea>

                                <p><button type="submit">PÁGINA PRINCIPAL</button></p>

                            </form>

                        <?php
                        }
                        ?>
                    </div>
                </div>

                <!--Footer section starts here-->
                <footer>
                    <div class="coverFooter">
                        <div class="logoContainer">
                            <div class="logo">
                                <a href="../index.php"><img src="../gallery/logo.png" alt=""></a>
                            </div>
                            <div class="apoio">
                                <h5>Apoio Comercial</h5>
                                <h4><b>916 532 480</b></h4>
                                <p>das 9h às 18h</p>
                            </div>
                        </div>

                        <div class="componentContainer">
                            <div class="component">
                                <div class="componentTitle">
                                    <h4>Sobre Nós</h4>
                                </div>
                                <div class="line"></div>
                                <div class="componentContent">
                                    <a href="#">Quem Somos</a><br>
                                    <a href="#">Contactos</a>
                                </div>
                            </div>
                            <div class="component">
                                <div class="componentTitle">
                                    <h4>Informações</h4>
                                </div>
                                <div class="line"></div>
                                <div class="componentContent">
                                    <a href="#">Modos de Pagamento</a><br>
                                    <a href="#">Envio de Encomendas e Custos</a>
                                    <a href="#">Garantias</a>
                                </div>
                            </div>
                            <div class="component">
                                <div class="componentTitle">
                                    <h4>Siga-nos</h4>
                                </div>
                                <div class="line"></div>
                                <div class="componentContent">
                                    <a href="#">Instagram</a><br>
                                    <a href="#">Facebook</a><br>
                                    <a href="#">Twitter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!--Footer section ends here-->
    </main>
</body>

</html>