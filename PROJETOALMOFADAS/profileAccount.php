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
                    <span><a href="like.html"><img src="gallery/like.png" id="likeBtn"></a></span>
                    <span><a href="./profileAccount.php"><img src="gallery/user.png" id="userBtn"></a></span>
                    <span><a href="cart.html"><img src="gallery/cart.png" id="cartBtn"></a></span>
                </div>
            <?php } else { ?>
                <div class="divIcon">
                    <span><a href="like.html"><img src="gallery/like.png" id="likeBtn"></a></span>
                    <span><a href="./loginSession/login.php"><img src="gallery/user.png" id="userBtn"></a></span>
                    <span><a href="cart.html"><img src="gallery/cart.png" id="cartBtn"></a></span>
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

        <div class="information_container">
            <div class="sidebar-main">
                <div class="customer_area">
                    <h1>
                        Olá <?php echo $_SESSION["FIRSTNAME_USER"] . " " . $_SESSION["LASTNAME_USER"] ?>
                    </h1>
                    <h3><a href="./loginSession/userSair.php">Logout</a></h3>
                </div>
            </div>

            <div class="information_component">
                <h1>A Minha conta</h1>

                <div class="box_information">
                    <div class="box_title">
                        <h2 class="info_cont">INFORMAÇÃO DE CONTACTO</h2>
                    </div>

                    <div class="box_content">
                        <p>
                            <?php echo $_SESSION["FIRSTNAME_USER"] . " " . $_SESSION["LASTNAME_USER"] ?>
                            <br>
                            <?php echo $_SESSION["EMAIL_USER"] ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>