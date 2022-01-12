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
    <title>Ma-Ma</title>
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
            $resultTableCategories = mysqli_query($_conn, "SELECT * FROM CATEGORIES");

            if (mysqli_num_rows($resultTableCategories) > 0) {
                $ctd = 0;
                while ($rowTableCategories = mysqli_fetch_assoc($resultTableCategories)) {
                    $ctd = $ctd + 1;

            ?>

                    <span><a href="<?php echo $rowTableCategories['LINK'] ?>"><?php echo $rowTableCategories['TITLE'] ?></a></span>

            <?php
                }
            }
            ?>
        </div>
        <!--Navbar ends here-->

        <!--Product page starts here-->

        <div class="content-wrapper">
            <div class="div-contents">
                <h1>Almofadas de Amamentação</h1>
                <h2><b>Pequenos detalhes que tornam o seu mundo grande</b></h2>

                <p>
                    <span class="desc__read-more">
                        A Almofada de Amamentação MA-MA® foi concebida para acompanhar a mamã tanto na gravidez como
                        no
                        pós
                        parto,
                        ajudando <br> a mamã num conjunto de situações para que ela se possa focar no que é mais
                        importante:
                        o
                        seu bebé. <br> <br>
                        A Almofada de Amamentação MA-MA® Original serve como um apoio fundamental para a futura
                        mamã, proporcionando noites de sono tranquilas e sem os habituais desconfortos que costumam
                        ocorrer
                        durante a
                        gravidez. <br> Chegada a altura de amamentar a almofada MA-MA® será igualmente uma fiel
                        aliada,
                        permitindo que a
                        mamã adopte uma posição confortável e que o bebé fique bem apoiado.
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
                            <h3>GRANDE</h3>
                        </div>
                        <div class="div-preco">
                            <h3>€45</h3>
                        </div>
                    </div>

                    <p>Com 1 cor lisa no verso e 1 padrão na frente</p><br>

                    <form action="">
                        <label for="frente">Frente</label>
                        <select name="frente" id="frente">
                            <option value="">Escolher</option>
                            <option value="amarelo">Amarelo</option>
                            <option value="laranja">Laranja</option>
                            <option value="castanho">Castanho</option>
                            <option value="rosa">Rosa</option>
                            <option value="verde">Verde</option>
                            <option value="azul">Azul</option>
                            <option value="azul-escuro">Azul-Escuro</option>
                            <option value="azul-pique">Azul-Pique</option>
                            <option value="azulao">Azulão</option>
                        </select>
                        <br><br>
                        <label for="verso">Verso</label>
                        <select name="verso" id="verso">
                            <option value="">Escolher</option>
                            <option value="amarelo">Amarelo</option>
                            <option value="laranja">Laranja</option>
                            <option value="castanho">Castanho</option>
                            <option value="rosa">Rosa</option>
                            <option value="verde">Verde</option>
                            <option value="azul">Azul</option>
                            <option value="azul-escuro">Azul-Escuro</option>
                            <option value="azul-pique">Azul-Pique</option>
                            <option value="azulao">Azulão</option>
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

                <div class="semPadrao">

                    <div class="container">
                        <div class="div-grande">
                            <h3>GRANDE</h3>
                        </div>
                        <div class="div-preco">
                            <h3>€40</h3>
                        </div>
                    </div>

                    <p>Com 1 ou 2 cores lisas na frente e no verso</p><br>

                    <form action="">
                        <label for="frente">Frente</label>
                        <select name="frente" id="frente">
                            <option value="">Escolher</option>
                            <option value="amarelo">Amarelo</option>
                            <option value="laranja">Laranja</option>
                            <option value="castanho">Castanho</option>
                            <option value="rosa">Rosa</option>
                            <option value="verde">Verde</option>
                            <option value="azul">Azul</option>
                            <option value="azul-escuro">Azul-Escuro</option>
                            <option value="azul-pique">Azul-Pique</option>
                            <option value="azulao">Azulão</option>
                        </select>
                        <br><br>
                        <label for="verso">Verso</label>
                        <select name="verso" id="verso">
                            <option value="">Escolher</option>
                            <option value="amarelo">Amarelo</option>
                            <option value="laranja">Laranja</option>
                            <option value="castanho">Castanho</option>
                            <option value="rosa">Rosa</option>
                            <option value="verde">Verde</option>
                            <option value="azul">Azul</option>
                            <option value="azul-escuro">Azul-Escuro</option>
                            <option value="azul-pique">Azul-Pique</option>
                            <option value="azulao">Azulão</option>
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
                                    <img src="gallery/productimg/amarelo.jpg" alt="" id="amarelo" class="amarelo">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Amarelo</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-b">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/laranja.jpg" alt="" id="laranja" class="laranja">
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
                                    <img src="gallery/productimg/castanho.jpg" alt="" id="castanho" class="castanho">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Castanho</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-d">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/rosa.jpg" alt="" id="rosa" class="rosa">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Rosa</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-e">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/verde.jpg" alt="" id="verde" class="verde">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Verde</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-f">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/azul.jpg" alt="" id="azul" class="azul">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Azul</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-g">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/azul_escuro.jpg" alt="" id="azul-escuro" class="azul-escuro">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Azul-Escuro</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-h">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/azul_pique.jpg" alt="" id="azul-pique" class="azul-pique">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Azul-Pique</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-h">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/azulao.jpg" alt="" id="azulao" class="azulao">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Azul-Pique</h4>
                            </div>
                        </div>
                    </li>
                </ul>

                <h2>Tecidos disponíveis com padrões:</h2>
                <ul class="autoWidth" class="cs-hidden">
                    <li class="item-i">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/baloes.jpg" alt="" class="baloes">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Balões</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-j">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/bhen.jpg" alt="" class="bhen">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Bhen</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-k">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/selva.jpg" alt="" class="selva">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Selva</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-l">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/riscas_diferentes.jpg" alt="" class="riscas_diferentes">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Riscas Tamanhos Diferentes</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-m">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/riscas_largas.jpg" alt="" class="riscas_largas">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Riscas Largas</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-n">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/flores_verde.jpg" alt="" class="flores_verde">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Flores Fundo Verde</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-o">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/bolas.jpg" alt="" class="bolas">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Bolas</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-p">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/carros.jpg" alt="" class="carros">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Carros</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-q">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/animais_beje.jpg" alt="" class="animais_beje">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Animais com Fundo Beje</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-r">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/circo_verde.jpg" alt="" class="circo_verde">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Circo com Fundo Verde</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-s">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/malmequeres.jpg" alt="" class="malmequeres">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Malmequeres</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-t">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/coracoes_azuis.jpg" alt="" class="coracoes_azuis">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Corações Azuis</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-u">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/cidade.jpg" alt="" class="cidade">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Cidade</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-v">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/circulos.jpg" alt="" class="circulos">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Circulos</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-w">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/ovelhas_rosa.jpg" alt="" class="ovelhas_rosa">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Ovelhas Fundo Rosa</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-x">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/argolas_laranja.jpg" alt="" class="argolas_laranja">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Argolas Laranja</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-y">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/argolas_turquesa.jpg" alt="" class="argolas_turquesa">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Argolas Turquesa</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-z">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/bolas_azul.jpg" alt="" class="bolas_azul">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Bolas Azul</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-a1">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/estrelinhas_azul_bebe.jpg" alt="" class="estrelinhas_azul_bebe">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Estrelinhas Azul Bebé</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-b1">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/fantasia_bonecos.jpg" alt="" class="fantasia_bonecos">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Fantasia Bonecos</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-c1">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/pintinhas_azul_bebe.jpg" alt="" class="pintinhas_azul_bebe">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Pitinihas Azul Bebé</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-d1">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/pintinhas_cinza.jpg" alt="" class="pintinhas_cinza">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Pitinhas Cinza</h4>
                            </div>
                        </div>
                    </li>
                    <li class="item-z">
                        <div class="component">
                            <a href="#">
                                <div class="product">
                                    <img src="gallery/productimg/pintinhas_rosa.jpg" alt="" class="pintinhas_rosa">
                                </div>
                            </a>
                            <div class="productName">
                                <h4>Pitinhas Rosa</h4>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!--Product page ends here-->

        <!-- HOW TO USE -->
        <div class="container-modoUtilizacao">
            <div class="title-desc">
                <h1>Modo de Utilização</h1>
                <span>
                    A Almofada de Amamentação MA-MA® Original tem uma série de funções praticas que vão para além de uma
                    simples almofada de amamentação.
                    <br> A almofada pode acompanhar a mamã desde o início da gravidez até aos primeiros anos de vida do
                    bebé.
                </span>
            </div>
            <br><br>

            <div class="content-wrapper-modoUtilizacao">
                <div class="component-modoUtilizacao">
                    <div class="image-modoUtilizacao-dormir">
                    </div>
                    <div class="content">
                        <h3>Para dormir</h3>
                        <span>
                            A Almofada de Amamentação MA-MA® é uma perfeita aliada da mamã mesmo antes do nascimento do
                            bebé.
                            <br> Durante a gravidez a mamã pode utilizar a almofada para dormir. O seu tamanho e
                            <br> formato em U permitem colocar a almofada entre as pernas ao mesmo tempo que a barriga
                            <br> fica apoiada e a cabeça e pescoço ficam numa posição ideal. Desta forma a mamã consegue
                            encontrar uma
                            <br> posição de repouso confortável tanto para ela como para o pequeno bebé que se está a
                            desenvolver.
                        </span>
                    </div>
                </div>
                <br><br>

                <div class="component-modoUtilizacao">
                    <div class="image-modoUtilizacao-amamentar">
                    </div>
                    <div class="content">
                        <h3>Para amamentar</h3>
                        <span>
                            A Almofada de Amamentação MA-MA® é uma perfeita aliada da mamã mesmo antes do nascimento do
                            bebé.
                            <br> Durante a gravidez a mamã pode utilizar a almofada para dormir. O seu tamanho e
                            <br> formato em U permitem colocar a almofada entre as pernas ao mesmo tempo que a barriga
                            <br> fica apoiada e a cabeça e pescoço ficam numa posição ideal. Desta forma a mamã consegue
                            encontrar uma
                            <br> posição de repouso confortável tanto para ela como para o pequeno bebé que se está a
                            desenvolver.
                        </span>
                    </div>
                </div>
                <br><br>

                <div class="component-modoUtilizacao">
                    <div class="image-modoUtilizacao-descansar">
                    </div>
                    <div class="content">
                        <h3>Para o bebé descansar</h3>
                        <span>
                            A Almofada de Amamentação MA-MA® é uma perfeita aliada da mamã mesmo antes do nascimento do
                            bebé.
                            <br> Durante a gravidez a mamã pode utilizar a almofada para dormir. O seu tamanho e
                            <br> formato em U permitem colocar a almofada entre as pernas ao mesmo tempo que a barriga
                            <br> fica apoiada e a cabeça e pescoço ficam numa posição ideal. Desta forma a mamã consegue encontrar uma
                            <br> posição de repouso confortável tanto para ela como para o pequeno bebé que se está a
                            desenvolver.
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- HOW TO USE -->


        <!--Footer section starts here-->
        <footer>
            <div class="coverFooter">
                <div class="logoContainer">
                    <div class="logo">
                        <a href="#"><img src="gallery/logo.png" alt=""></a>
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

    <script src="js/script.js"></script>

</html>