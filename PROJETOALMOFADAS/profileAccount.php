<?php

session_start();
include_once  '../PROJETOALMOFADAS/loginSession/connect_DB.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma-Ma Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/loginSession.css">
    <link rel="shortcut icon" href="gallery/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <main>
        <!--Header starts here-->
        <header>
            <div class="logo">
                <a href="index.php">
                    <img src="gallery/logo.png" alt="Ma-ma logo" class="logo">
                </a>
            </div>

            <div class="search-bar">
                <input type="search" placeholder="Encontre o produto de que precisa...">
                <span><img src="gallery/searchBtn.png" id="searchBtn"></span>
            </div>

            <?php
            if (isset($_SESSION["USER"])) { ?>
                <div class="divIcon">
                    <span><a href="#"><img src="gallery/like.png" id="likeBtn"></a></span>
                    <span><a href="./profileAccount.php"><img src="gallery/user.png" id="userBtn"></a></span>
                    <span><a href="#"><img src="gallery/cart.png" id="cartBtn"></a></span>
                </div>
            <?php } else { ?>
                <div class="divIcon">
                    <span><a href="#"><img src="gallery/like.png" id="likeBtn"></a></span>
                    <span><a href="./loginSession/login.php"><img src="gallery/user.png" id="userBtn"></a></span>
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
                    <h3><a href="./loginSession/userSair.php">Logout</a></h3>
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
                <h1>A Minha conta</h1>

                <div class="box-information">
                    <div class="box-title">
                        <h2 class="info_cont">INFORMAÇÃO DE CONTACTO</h2>
                    </div>

                    <div class="box-content">
                        <p>
                            <?php echo $_SESSION["FIRSTNAME_USER"] . " " . $_SESSION["LASTNAME_USER"] ?>
                            <br>
                            <?php echo $_SESSION["EMAIL_USER"] ?>
                        </p>
                    </div>
                    <div class="div-btn-profile">
                        <button class="btn-profile" name="button-edit-info" type="submit"><span>EDITAR</span></button>
                    </div>
                </div>
                <div class="box-information">
                    <div class="box-title">
                        <h2 class="info_cont">MORADA</h2>
                    </div>

                    <div class="box-content">
                        <p>
                            <?php echo $_SESSION["FIRSTNAME_USER"] . " " . $_SESSION["LASTNAME_USER"] ?>
                            <br>
                            <?php echo $_SESSION["MORADA_USER"] ?>
                            <br>
                            <?php echo $_SESSION["COD_POSTAL_USER"] ?>, <?php echo $_SESSION["CIDADE_USER"] ?>
                            <br>
                            <?php echo $_SESSION["PAIS_USER"] ?>
                            <br>
                            Número de telefone: <?php echo $_SESSION["TELEMOVEL_USER"] ?>
                        </p>
                    </div>

                    <button class="btn-profile" name="button-edit-morada" type="submit"><span>EDITAR</span></button>
                </div>
            </div>
        </div>

        <!--Footer section starts here-->
        <footer>
            <div class="coverFooter">
                <div class="logoContainer">
                    <div class="logo">
                        <a href="./index.php"><img src="gallery/logo.png" alt=""></a>
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