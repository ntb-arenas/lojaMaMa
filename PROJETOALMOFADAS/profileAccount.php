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
            <span><a href="almofadasAma.html">ALMOFADAS DE AMAMENTAÇÃO</a></span>
            <span><a href="cunhas.html">CUNHAS</a></span>
            <span><a href="slings.html">SLINGS</a></span>
            <span><a href="mudafraldas.html">MUDA FRALDAS</a></span>
            <span><a href="kitMat.html">KIT MATERNIDADE</a></span>
            <span><a href="almofadasAnti.html">ALMOFADAS ANTI-CÓLICAS</a></span>
        </div>
        <!--Navbar ends here-->


        <div class="sidebar-main">
            <ul class="customer-account">
                <li>
                    <span>Olá</span>
                    <span>- <?php echo $_SESSION["FIRSTNAME_USER"] ." " . $_SESSION["LASTNAME_USER"]; ?></span>
                </li>
                <li>
                    <a href="./loginSession/userSair.php">Logout</a>
                </li>
            </ul>
        </div>
    </main>
</body>

</html>