<?php

session_start();
error_reporting(E_ERROR | E_PARSE);

include_once  './connect_DB.php';


if (isset($_POST['btn-cancel-changes'])) {
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
    header("Location: ../index.php");
}

if (isset($_POST['btn-forgot-pass'])) {

    session_destroy(); // destruição imediata de sessão

    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
    header("Location: ../userRecuperarSenha.php");
}




$temporaryMsg = "";

$errorMessagefName = "";
$errorMessagelName = "";
$errorMessagePassword = "";

if (!isset($_SESSION["USER"])) {
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
    header("Location: index.php");
} else {
    // ler informações de conta 
    $username = $_SESSION["USER"];

    $stmt = $_conn->prepare('SELECT * FROM USERS WHERE USERNAME = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $usersResult = $stmt->get_result();

    if ($usersResult->num_rows > 0) {
        while ($rowUsers = $usersResult->fetch_assoc()) {

            $password = "";
            $encryptedPassowrd = $rowUsers['PASSWORD'];

            if (!isset($_POST["fName"], $_POST["lName"])) {

                $fName = $rowUsers['fNAME'];
                $lName = $rowUsers['lNAME'];
                $receberMsgs = $rowUsers['MSGS_MARKETING'];
            } else {

                $podeRegistar = "Sim";

                $fName = mysqli_real_escape_string($_conn, $_POST['fName']);
                $fName = trim($fName);
                $lName = mysqli_real_escape_string($_conn, $_POST['lName']);
                $lName = trim($lName);

                $receberMensagens = $_POST['receberMensagens'];
                if ($receberMensagens == "Sim") {
                    $receberMsgs = 1;
                } else {
                    $receberMsgs = 0;
                }

                if (strlen(trim($fName)) < 2) {
                    $errorMessagefName = "O nome é demasiado curto!";
                    $podeRegistar = "Nao";
                }

                if (strlen(trim($lName)) < 2) {
                    $errorMessagelName = "O apelido é demasiado curto!";
                    $podeRegistar = "Nao";
                }
            }
        }
    } else {
        echo "STATUS ADMIN (Editar conta): " . mysqli_error($_conn);
    }
    mysqli_stmt_close($stmt);
}



if (isset($_POST['btn-save-changes'])) {


    // verificar senha por questões de segurança

    $password = mysqli_real_escape_string($_conn, $_POST['password']);
    $password = trim($password);


    if (password_verify($password, $encryptedPassowrd)) {

        // senha OK, filtar e validar inputs



    } else {

        $errorMessagePassword = "Senha incorreta!";
        $podeRegistar = "Nao";
    }


    if ($podeRegistar == "Sim") {


        ///////////////////////////////////
        // ALTERA
        //////////////////////////////////

        $fName = strip_tags($fName); // demonstração da remoção de caracteres especiais html por exemplo..

        $sql = "UPDATE USERS SET fNAME = ?, lNAME = ?, MSGS_MARKETING = ? WHERE USERNAME = ?";

        if ($stmt = mysqli_prepare($_conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "ssis", $fName, $lName, $receberMsgs, $username);


            mysqli_stmt_execute($stmt);

            $temporaryMsg = "Definições de conta alteradas com sucesso.";

            // atualizar variável de sessão, a questão de receber mensagens de marketing não
            // é uma variável de sessão, não é necessário guardar em sessão.

            $_SESSION["FIRSTNAME_USER"] = $fName;
            $_SESSION["LASTNAME_USER"] = $lName;


            // encaminhar com timer 3 segundos
            header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
            header("Refresh: 3; URL=../index.php");
        } else {
            // echo "ERROR: Could not prepare query: $sql. " . mysqli_error($_conn);
            echo "STATUS ADMIN (alterar definições): " . mysqli_error($_conn);
        }

        mysqli_stmt_close($stmt);
    }
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
            <span><a href="./almofadasAma.php">ALMOFADAS DE AMAMENTAÇÃO</a></span>
            <span><a href="./cunhas.php">CUNHAS</a></span>
            <span><a href="./slings.php">SLINGS</a></span>
            <span><a href="./mudafraldas.php">MUDA FRALDAS</a></span>
            <span><a href="./kitMat.php">KIT MATERNIDADE</a></span>
            <span><a href="./almofadasAnti.php">ALMOFADAS ANTI-CÓLICAS</a></span>
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
                        <p><a href="#">A MINHA CONTA</a></p>
                        <p><a href="#">AS MINHAS ENCOMENDAS</a></p>
                        <p><a href="#">SUBSCRIÇÃO MARKETING</a></p>
                    </div>
                </div>
            </div>

            <div class="information-component">
                <h1>Editar Conta</h1>
                <br>
                Por uma questão de segurança, para alterar as suas definições de conta deverá digitar a
                sua senha. No final, não se esqueça de gravar as alterações. Se apenas pretende alterar a sua senha use a opção "Esqueci-me da senha".

                <div class="editAcc-box">
                    <div class="information-editAcc-content">
                        <form action="#" method="POST">
                            <fieldset class="editAcc-fieldset">
                                <legend>Nome</legend>
                                <input type="text" class="editAcc-input" name="fName" value="<?php echo $fName; ?>">
                            </fieldset>
                            <p><?php echo $errorMessagefName; ?></p>
                            <br>
                            <fieldset class="editAcc-fieldset">
                                <legend>Apelido</legend>
                                <input type="text" class="editAcc-input" name="lName" value="<?php echo $lName; ?>">
                            </fieldset>
                            <p><?php echo $errorMessagelName; ?></p>
                            <br>

                            <fieldset class="editAcc-fieldset">
                                <legend>Número de telemóvel</legend>
                                <input type="text" class="editAcc-input" name="telemovel" value="<?php echo $telemovel; ?>">
                            </fieldset>
                            <br>
                            <p>Pretendo receber mensagens de marketing:</p>
                            <select name="receberMensagens">
                                <option value="Sim" <?php if ($receberMsgs == 1) {
                                                        echo " selected";
                                                    } ?>>Sim</option>
                                <option value="Não" <?php if ($receberMsgs == 0) {
                                                        echo " selected";
                                                    } ?>>Não</option>
                            </select>
                            <p>
                    </div>
                    <div class="information-editAcc-content">
                        <fieldset class="editAcc-fieldset">
                            <legend>Morada</legend>
                            <input type="text" class="editAcc-input" name="morada" value="<?php echo $morada; ?>">
                        </fieldset>
                        <br>
                        <fieldset class="editAcc-fieldset">
                            <legend>Código Postal</legend>
                            <input type="text" class="editAcc-input" name="codPostal" value="<?php echo $codPostal; ?>">
                        </fieldset>
                        <br>
                        <fieldset class="editAcc-fieldset">
                            <legend>Cidade</legend>
                            <input type="text" class="editAcc-input" name="cidade" value="<?php echo $cidade; ?>">
                        </fieldset>
                        <br>
                        <fieldset class="editAcc-fieldset">
                            <legend>País</legend>
                            <input type="text" class="editAcc-input" name="pais" value="<?php echo $pais; ?>">
                        </fieldset>
                        <br>
                        <fieldset class="editAcc-fieldset">
                            <legend>Senha</legend>
                            <input type="password" class="editAcc-input" name="password" value="<?php echo $password; ?>">
                        </fieldset>
                        <p><?php echo $errorMessagePassword; ?></p>
                    </div>
                </div>



                <button name="btn-save-changes" type="submit">GRAVAR ALTERAÇÕES</button>
                <button name="btn-cancel-changes" type="submit">CANCELAR ALTERAÇÕES</button>

                </p>
                </form>

                <br>

                <form action="#" method="POST">
                    <button name="btn-cancel-my-account" type="submit">Pretendo cancelar a minha conta</button>
                </form>

                <br>

                <form action="#" method="POST">
                    <button name="btn-forgot-pass" type="submit">Esqueci-me da senha</button>
                </form>
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>



</body>

</html>