<?php
session_start();
include_once  './loginSession/connect_DB.php';

// $dbname = 'id17632851_pap';
// $dbuser = 'id17632851_projetoalmo';
// $dbpass = 'Bp[84zQW+)WU5Cs6';
// $dbhost = 'localhost';

// $connect = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
// mysqli_select_db($dbname) or die("Could not open the db '$dbname'");

// $test_query = "SHOW TABLES FROM $dbname";
// $result = mysqli_query($test_query);

// $tblCnt = 0;
// while($tbl = mysqli_fetch_array($result)) {
//   $tblCnt++;
//   #echo $tbl[0]."<br />\n";
// }

// if (!$tblCnt) {
//   echo "There are no tables<br />\n";
// } else {
//   echo "There are $tblCnt tables<br />\n";
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma-Ma</title>
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
            ?>
        </div>
        <!--Navbar ends here-->

        <!--Page cover starts here-->
        <div class="coverDiv">
            <div class="titleDiv">
                <h1>Conforto e Bem-estar <br> ao Melhor Preço</h1>
            </div>
            <div class="divImage">
                <img src="gallery/almofadaAmam.webp" id="coverImg">
            </div>
        </div>
        <div class="titleMsg">
            <p>Com a Ma-Ma, a vida da mãe e do seu bebé nunca foi tão fácil. Descubra os nossos produtos!</p>
        </div>
        <!--Page cover ends here-->

        <!--Features section starts here-->
        <section class="features" id="features">
            <div class="box-container">
                <div class="box">
                    <img src="gallery/almofadaImg.png" alt="">
                    <h3>ALMOFADAS DE AMAMENTAÇÃO</h3>
                    <div class="b6">
                        <div class="button_cont" align="center">
                            <div class="example_f"> <span><a href="almofadasAma.php" class="btn">EXPLORAR</a></div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <img src="gallery/cunhas.png" alt="">
                    <h3>CUNHAS</h3>
                    <div class="b6">
                        <div class="button_cont" align="center">
                            <div class="example_f"> <span><a href="cunhas.php" class="btn">EXPLORAR</a></div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <img src="gallery/slingBebe1.png" alt="">
                    <h3>SLINGS</h3>
                    <div class="b6">
                        <div class="button_cont" align="center">
                            <div class="example_f"> <span><a href="slings.php" class="btn">EXPLORAR</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="features2">
            <div class="box-container2">
                <div class="box">
                    <img src="gallery/mudaFraldas.png" alt="">
                    <h3>MUDA FRALDAS</h3>
                    <div class="b6">
                        <div class="button_cont" align="center">
                            <div class="example_f"> <span><a href="mudafraldas.php" class="btn">EXPLORAR</a></div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <img src="gallery/kitMaternidadeAzul.png" alt="">
                    <h3>KIT MATERNIDADE</h3>
                    <div class="b6">
                        <div class="button_cont" align="center">
                            <div class="example_f"> <span><a href="kitMat.php" class="btn">EXPLORAR</a></div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <img src="gallery/antiColicas.png" alt="">
                    <h3>ALMOFADAS ANTI-CÓLICAS</h3>
                    <div class="b6">
                        <div class="button_cont" align="center">
                            <div class="example_f"> <span><a href="almofadasAnti.php" class="btn">EXPLORAR</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Features section ends here-->

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
    </main>
</body>

</html>