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
$errorMessageTelemovel = "";
$errorMessageCodPostal = "";

$telemovel = "";
$morada = "";
$codPostal = "";
$cidade = "";
$pais = "";

if (!isset($_SESSION["USER"])) {
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
    header("Location: ../index.php");
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
            $encryptedPassword = $rowUsers['PASSWORD'];
            $morada = $rowUsers['MORADA'];
            $telemovel = $rowUsers['TELEMOVEL'];
            $cidade = $rowUsers['CIDADE'];
            $codPostal = $rowUsers['COD_POSTAL'];
            $pais = $rowUsers['PAIS'];

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
                $morada = mysqli_real_escape_string($_conn, $_POST['formMorada']);
                $morada = trim($morada);
                $cidade = mysqli_real_escape_string($_conn, $_POST['formCidade']);
                $cidade = trim($cidade);
                $telemovel = mysqli_real_escape_string($_conn, $_POST['formTelemovel']);
                $telemovel = trim($telemovel);
                $codPostal = mysqli_real_escape_string($_conn, $_POST['formCodPostal']);
                $codPostal = trim($codPostal);
                $pais = mysqli_real_escape_string($_conn, $_POST['formPais']);
                $pais = trim($pais);

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
                if (strlen(trim($telemovel)) < 9) {
                    $errorMessageTelemovel = "O número telemóvel é invalido!";
                    $podeRegistar = "Nao";
                }
                if (strlen(trim($codPostal)) < 8) {
                    $errorMessageCodPostal = "O código postal fornecido parece ser inválido. 
                    Exemplo: 5360-316; 1234-567";
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


    if (password_verify($password, $encryptedPassword)) {

        // senha OK, filtar e validar inputs

    } else {

        $errorMessagePassword = "Senha incorreta!";
        $podeRegistar = "Nao";
    }


    if ($podeRegistar == "Sim") {


        ///////////////////////////////////
        // ALTERA/INSIRA
        //////////////////////////////////


        $morada = strip_tags($morada);
        $cidade = strip_tags($cidade);
        $telemovel = strip_tags($telemovel);
        $pais = strip_tags($pais);
        $fName = strip_tags($fName);
        $lName = strip_tags($lName); // demonstração da remoção de caracteres especiais html por exemplo..

        $sql = "UPDATE USERS SET fNAME = ?, lNAME = ?, MORADA = ?, COD_POSTAL = ?, CIDADE = ?, PAIS = ?, TELEMOVEL = ?, MSGS_MARKETING = ? WHERE USERNAME = ?";

        if ($stmt = mysqli_prepare($_conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "sssssssis", $fName, $lName, $morada, $codPostal, $cidade, $pais, $telemovel, $receberMsgs, $username);


            mysqli_stmt_execute($stmt);

            $temporaryMsg = "Definições de conta alteradas com sucesso.";

            // atualizar variável de sessão, a questão de receber mensagens de marketing não
            // é uma variável de sessão, não é necessário guardar em sessão.

            $_SESSION["FIRSTNAME_USER"] = $fName;
            $_SESSION["LASTNAME_USER"] = $lName;


            // encaminhar com timer 3 segundos
            header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
            header("Refresh: 3; URL=../profileAccount.php");
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
    <!-- stylesheet ---------------------------->
    <link rel="stylesheet" href="../bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.scss">
    <!-- <link rel="stylesheet" href="../css/loginSession.css"> -->
    <!-- page icon --------------------------------->
    <link rel="shortcut icon" href="../gallery/logo.png">
    <!-- fonts ------------------------------------------>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <main>
        <!--Header starts here-->
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <a href="../index.php">
                        <img class="img-fluid" src="../gallery/logo.png" alt="Ma-ma logo" class="logo">
                    </a>
                </div>
                <form class="col-sm-6 col-md-7 col-lg-6 col-xl-7 mt-3 d-none d-sm-block">
                    <div class="row justify-content-center">
                        <div class="col-sm-9">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        </div>
                        <div class="col-sm-3">
                            <button class="btn p-sm-6 btn-customized" type="submit">Search <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </div>
                    </div>
                </form>
                <div class="col-6 col-sm-3 col-md-2 col-lg-3 col-xl-2 mt-3"><?php
                                                                            if (isset($_SESSION["USER"])) { ?>
                        <div class="d-flex justify-content-evenly col-12">
                            <a href="like.html" style="color: #f35518;"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                    <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                </svg></a>
                            <a href="./userEditAccount.php" style="color: #f35518;"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg></a>
                            <a href="cart.html" style="color: #f35518;"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg></a>
                        </div>

                    <?php } else { ?>
                        <div class="d-flex justify-content-evenly col-12">
                            <a href="like.html" style="color: #f35518;"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                    <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                </svg></a>
                            <a href="./login.php" style="color: #f35518;"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg></a>
                            <a href="cart.html" style="color: #f35518;"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!--Header ends here-->

        <!--Navbar starts here-->
        <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top border-bottom">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="navbar-nav justify-content-around col-12">
                        <?php
                        $resultTablecategory = mysqli_query($_conn, "SELECT * FROM CATEGORY WHERE VISIBLE = 1 ORDER BY SEQUENCE ASC");
                        if (mysqli_num_rows($resultTablecategory) > 0) {
                            $ctd = 0;
                            while ($rowTablecategory = mysqli_fetch_assoc($resultTablecategory)) {
                                $ctd = $ctd + 1;
                        ?>
                                <li class="nav-item"><a href="../<?php echo $rowTablecategory['LINK'] ?>" class="nav-link fs-5"> <?php echo $rowTablecategory['TITLE'] ?></a></li>
                        <?php
                            }
                        }
                        mysqli_free_result($resultTablecategory);
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
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
                <h1>Editar Morada</h1>
                <br>
                Por uma questão de segurança, para alterar as suas definições de conta deverá digitar a
                sua senha. No final, não se esqueça de gravar as alterações. Se apenas pretende alterar a sua senha use a opção "Esqueci-me da senha".

                <div class="editAcc-box">
                    <div class="information-editAcc-content">
                        <form action="#" method="POST">
                            <fieldset class="editAcc-fieldset">
                                <legend>Nome</legend>
                                <div class="div-input">
                                    <input type="text" class="editAcc-input" name="fName" value="<?php echo $fName; ?>">
                                </div>
                            </fieldset>

                            <div class="div-errors">
                                <p><?php echo $errorMessagefName; ?></p>
                            </div>
                            <br>

                            <fieldset class="editAcc-fieldset">
                                <legend>Apelido</legend>
                                <div class="div-input">
                                    <input type="text" class="editAcc-input" name="lName" value="<?php echo $lName; ?>">
                                </div>
                            </fieldset>
                            <div class="div-errors">
                                <p><?php echo $errorMessagelName; ?></p>
                            </div>
                            <br>

                            <fieldset class="editAcc-fieldset">
                                <legend>Número de telemóvel</legend>
                                <div class="div-input">
                                    <input type="text" class="editAcc-input" name="formTelemovel" value="<?php echo $telemovel; ?>">
                                </div>
                            </fieldset>

                            <div class="div-errors">
                                <p><?php echo $errorMessageTelemovel; ?></p>
                            </div>

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
                    </div>
                    <div class="information-editAcc-content">
                        <fieldset class="editAcc-fieldset">
                            <legend>Morada</legend>
                            <div class="div-input">
                                <input type="text" class="editAcc-input" name="formMorada" value="<?php echo $morada; ?>">
                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="editAcc-fieldset">
                            <legend>Código Postal</legend>
                            <div class="div-input">
                                <input type="text" class="editAcc-input" name="formCodPostal" value="<?php echo $codPostal; ?>">
                            </div>
                        </fieldset>
                        <div class="div-errors">
                            <p><?php echo $errorMessageCodPostal; ?></p>
                        </div>
                        <br>
                        <fieldset class="editAcc-fieldset">
                            <legend>Cidade</legend>
                            <div class="div-input">
                                <input type="text" class="editAcc-input" name="formCidade" value="<?php echo $cidade; ?>">
                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="editAcc-fieldset">
                            <legend>País</legend>
                            <div class="div-input">
                                <input type="text" class="editAcc-input" name="formPais" value="<?php echo $pais; ?>">
                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="editAcc-fieldset">
                            <legend>Senha</legend>
                            <div class="div-input">
                                <input type="password" class="editAcc-input" name="password" value="<?php echo $password; ?>">
                            </div>
                        </fieldset>
                        <div class="div-errors">
                            <p><?php echo $errorMessagePassword; ?></p>
                        </div>

                    </div>
                </div>
                <p><b><?php echo $temporaryMsg; ?></b></p>

                <br>

                <div class="btn-editAcc">
                    <div class="div-btn-profile">
                        <button class="btn-profile" name="btn-save-changes" type="submit"><span>GRAVAR ALTERAÇÕES</span></button>
                    </div>
                    <div class="div-btn-profile">
                        <button class="btn-profile" name="btn-cancel-changes" type="submit"><span>CANCELAR ALTERAÇÕES</span></button>
                    </div>
                </div>
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