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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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
        <div class="navBar" style="margin-top: 0;">
            <input type="checkbox" id="click">
            <label for="click" class="menu-btn">
                <i class="fas fa-bars"></i>
            </label>
            <ul>
                <?php
                $resultTablecategory = mysqli_query($_conn, "SELECT * FROM CATEGORY WHERE VISIBLE = 1 ORDER BY SEQUENCE ASC");
                if (mysqli_num_rows($resultTablecategory) > 0) {
                    $ctd = 0;
                    while ($rowTablecategory = mysqli_fetch_assoc($resultTablecategory)) {
                        $ctd = $ctd + 1;
                ?>

                        <li><a href="<?php echo $rowTablecategory['LINK'] ?>"><?php echo $rowTablecategory['TITLE'] ?></a></li>
                <?php
                    }
                }
                mysqli_free_result($resultTablecategory);
                ?>
            </ul>
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
            <div class="option-container">
                <a href="./almofadasAmaPadrao.php"><img src="./gallery/padrao.png" alt=""></a>
                <a href="#"><img src="./gallery/liso.png" alt=""></a>
            </div>
        </div>

        <!-- HOW TO USE -->
        <!-- <div class="container-modoUtilizacao">
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
                <div class="component-modoUtilizacao left">

                    <img src="./gallery/productimg/6.jpg" alt="">

                    <div class="content">
                        <h3>Para dormir</h3>
                        <span>
                            A Almofada de Amamentação MA-MA é a aliada perfeita da mãe mesmo antes do nascimento do bebé.Com o seu tamanho e a sua forma em U, esta almofada ajuda a mãe a encontrar uma posição de repouso confortável tanto para ela como para o seu bebé.
                        </span>
                    </div>
                </div>
                <br><br>

                <div class="component-modoUtilizacao right">

                    <img src="./gallery/productimg/10.jpg" alt="">

                    <div class="content">
                        <h3>Para amamentar</h3>
                        <span>
                            A Almofada de Amamentação MA-MA® ajuda a mãe a amamentar numa posição confortável, apoiando o bebé e evitando a colocação de stress desnecessário na coluna e costas da mãe. O fecho nas extremidades da almofada permitem que fique presa e apoiada, pelo que a mãe poderá focar-se totalmente no bebé e aproveitar o momento de vínculo.
                        </span>
                    </div>
                </div>
                <br><br>

                <div class="component-modoUtilizacao left">

                    <img src="./gallery/productimg/7.jpg" alt="">

                    <div class="content">
                        <h3>Para o bebé descansar</h3>
                        <span>
                            A Almofada de Amamentação MA-MA® permite que os bebés façam sestas em perfeita segurança sem o risco de se virarem. Além disso, também servem de redutor em cama de grades ou de ninho, aconchegando o bebé. Quando o bebé se começa a sentar, apoia-o, evitando desequilíbrios para os lados ou para trás.
                        </span>
                    </div>
                </div>
            </div>
        </div> -->
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
                            <a href="#">Envio de Encomendas e Custos</a><br>
                            <a href="#">Garantias</a>
                        </div>
                    </div>
                    <div class="component">
                        <div class="componentTitle">
                            <h4>Siga-nos</h4>
                        </div>
                        <div class="line"></div>
                        <div class="componentContent logo">
                            <a href="#"><img src="./gallery/facebook.png" alt=""></a>
                            <a href="#"><img src="./gallery/twitter.png" alt=""></a>
                            <a href="#"><img src="./gallery/instagram.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--Footer section ends here-->
    </main>

    <script src="js/script.js"></script>

</html>