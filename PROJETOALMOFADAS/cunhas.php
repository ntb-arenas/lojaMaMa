<?php
session_start();
include_once  './loginSession/connect_DB.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaMa</title>
    <!-- stylesheet ---------------------------->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/almofadasAma.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/lightslider.css">
    <!-- page icon --------------------------------->
    <link rel="shortcut icon" href="gallery/logo.png">
    <!-- fonts ------------------------------------------>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- Jquery ----------------------------------------------->
    <script src="js/jquery.js"></script>
    <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- lightslider.js ------------------------------------------>
    <script src="js/lightslider.js"></script>
    <script src="js/script1.js"></script>
</head>

<body>
    <main>
        <!--Header starts here-->
        <header>
            <div class="logo">
                <a href="./index.php">
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
            <?php


            $resultTablecategory = mysqli_query($_conn, "SELECT * FROM CATEGORY WHERE VISIBLE = 1 ORDER BY SEQUENCE ASC");

            if (mysqli_num_rows($resultTablecategory) > 0) {
                $ctd = 0;
                while ($rowTablecategory = mysqli_fetch_assoc($resultTablecategory)) {
                    $ctd = $ctd + 1;

            ?>

                    <span><a href="<?php echo $rowTablecategory['LINK'] ?>"><?php echo $rowTablecategory['TITLE'] ?></a></span>

            <?php
                }
            }
            mysqli_free_result($resultTablecategory);
            ?>
        </div>
        <!--Navbar ends here-->

        <!--Product page starts here-->

        <div class="content-wrapper">
            <div class="div-contents">
                <h1>Cunhas</h1>
                <h2><b>Pequenos detalhes que tornam o seu mundo grande</b></h2>

                <p>
                    <span class="desc__read-more">
                        Durante a gravidez ocorrem alguns desconfortos que, com algumas soluções alternativas, poderão ser minorados.
                        <br> Nesse sentido a MA-MA® acaba de lançar um produto que poderá servir de grande apoio, devolvendo à futura mamã uma boa qualidade de vida.
                    </span>
                </p>

                <p class="read-more-btn">Ler mais</p>
            </div>
        </div>


        <br><br>


        <div class="div-row">

            <div class="sidebar">
                <div class="comPadrao">

                    <div class="container">
                        <div class="div-grande">
                            <h3>Cunha</h3>
                        </div>
                        <div class="div-preco">
                            <h3>€40</h3>
                        </div>
                    </div>

                    <p>Escolha uma cor lisa por cunha</p><br>

                    <form action="">
                        <label for="frente">Cores Disponíveis</label>
                        <select name="frente" id="frente">
                            <option value="">Escolher</option>
                            <option value="verde">Verde</option>
                            <option value="laranja">Laranja</option>
                            <option value="azul">Azul Bebé</option>
                            <option value="azul-escuro">Azul Escuro</option>
                        </select>
                        <br>

                        <div class="container-button">
                            <div class="quantity buttons_added">
                                <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
                            </div>

                            <div class="addToCart">
                                <input type="button" id="addToCart" name="addToCart" value="ADICIONAR AO CARRINHO">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="content-container">
                <h2>Tecidos disponíveis Lisos:</h2>
                <ul class="autoWidth" class="cs-hidden">
                    <li class="item-a">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/cunhaProduct/verde.jpg" alt="" id="verde" class="verde">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Verde</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-b">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/cunhaProduct/laranja.jpg" alt="" id="laranja" class="laranja">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Laranja</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-c">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/cunhaProduct/azul_bebe.jpg" alt="" id="azul" class="azul">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Azul Bebé</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-d">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/cunhaProduct/azul_escuro.jpg" alt="" id="azul-escuro" class="azul-escuro">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Azul Escuro</h4>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!--Product page ends here-->


        <!--Footer section starts here-->
        <footer style="background-color: rgb(224, 224, 224);">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-12 col-lg-4 ps-4 ps-lg-5">
                        <a href="./index.php">
                            <img class="img-fluid col-5 col-sm-4 col-md-3" src="gallery/logo.png" alt="Ma-ma logo" class="logo">
                        </a>
                        <h4 style="color: #ff7b46;">Apoio Comercial</h4>
                        <h2 style="color: rgb(93, 93, 93);"><strong>916 532 480</strong></h2>
                        <p>das 9h às 18h</p>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="row justify-content-center p-2 footer-layout">
                            <div class="col-12 col-lg-3 mb-3">
                                <h4 class=" border-bottom border-secondary">Sobre Nós</h4>
                                <div class="p-0 d-flex flex-column">
                                    <a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Quem Somos</a>
                                    <a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Contactos</a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 mb-3">
                                <h4 class=" border-bottom border-secondary">Informações</h4>
                                <div class="p-0 d-flex flex-column">
                                    <a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Modos de Pagamento</a>
                                    <a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Envio de Encomendas e Custos</a>
                                    <a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Garantias</a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 mb-3">
                                <h4 class=" border-bottom border-secondary">Siga-nos</h4>
                                <div class="p-0 d-flex flex-row col-9 justify-content-around">
                                    <a class="text-decoration-none" href="#"><img style="width: 2rem;" src="./gallery/facebook.png" alt=""></a>
                                    <a class="text-decoration-none" href="#"><img style="width: 2rem;" src="./gallery/twitter.png" alt=""></a>
                                    <a class="text-decoration-none" href="#"><img style="width: 2rem;" src="./gallery/instagram.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--Footer section ends here-->
    </main>
</body>
<script src="js/script.js"></script>

</html>