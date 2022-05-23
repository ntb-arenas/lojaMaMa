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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />
    <!-- page icon --------------------------------->
    <link rel="shortcut icon" href="gallery/logo.png">
    <!-- fonts ------------------------------------------>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
</head>

<body>
    <main>
        <?php include_once './components/header.php'; ?>
        <?php include_once './components/navbar.php'; ?>

        <!-- Page cover -->
        <img class="img-fluid mx-auto d-none d-md-block" src="./gallery/maincover.jpg" alt="">
        <img class="img-fluid mx-auto d-none d-sm-block d-md-none" src="./gallery/maincovertabletsize.jpg" alt="">
        <img class="img-fluid mx-auto d-sm-none" src="./gallery/maincovermobilesize.jpg" alt="">
        <!-- Page cover -->

        <div class="container-fluid p-0 border-bottom">
            <h3 class="text-center m-3 cover-message-fs" style="color: rgb(93, 93, 93);">Com a Ma-Ma, a vida da mãe e do seu bebé nunca foi tão fácil. Descubra os nossos produtos!</h3>
        </div>

        <!-- Product Page -->
        <div class="container-fluid px-lg-5 d-none d-sm-block">
            <div class="row mx-lg-n5">
                <div class="col-6 col-sm-6 col-md-4 py-3 px-lg-3">
                    <a href="#">
                        <div class="py-3 border h-100 hover-shadow">
                            <img class="img-fluid" src="gallery/almofadaImg.png" alt="">
                            <h4 class="text-center card-message-fs">ALMOFADAS DE AMAMENTAÇÃO</h4>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 py-3 px-lg-3">
                    <a href="#">
                        <div class="py-3 border h-100 hover-shadow">
                            <img class="img-fluid" src="gallery/cunhas.png" alt="">
                            <h4 class="text-center card-message-fs">CUNHAS</h4>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 py-3 px-lg-3">
                    <a href="#">
                        <div class="py-3 border h-100 hover-shadow">
                            <img class="img-fluid" src="gallery/slingBebe1.png" alt="">
                            <h4 class="text-center card-message-fs">SLINGS</h4>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 py-3 px-lg-3">
                    <a href="#">
                        <div class="py-3 border h-100 hover-shadow">
                            <img class="img-fluid" src="gallery/mudaFraldas.png" alt="">
                            <h4 class="text-center card-message-fs">MUDA FRALDAS</h4>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 py-3 px-lg-3">
                    <a href="#">
                        <div class="py-3 border h-100 hover-shadow">
                            <img class="img-fluid" src="gallery/kitMaternidadeAzul.png" alt="">
                            <h4 class="text-center card-message-fs">KIT MATERNIDADE</h4>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 py-3 px-lg-3">
                    <a href="#">
                        <div class="py-3 border h-100 hover-shadow">
                            <img class="img-fluid" src="gallery/antiColicas.png" alt="">
                            <h4 class="text-center card-message-fs">ALMOFADAS ANTI-CÓLICAS</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="container-fluid px-lg-5 d-block d-sm-none">
            <div class="row mx-lg-n5">
                <div class="col-6 col-sm-6 col-md-4 py-3 px-lg-3">
                    <a href="#" class="text-decoration-none" style="font-size: calc(0.5rem + .3vw); color: rgb(40, 40, 40);" role="button">
                        <div class="border h-100">
                            <img class="img-fluid" src="gallery/almofadaImg.png" alt="">
                            <h4 class="text-center card-message-fs">ALMOFADAS DE AMAMENTAÇÃO</h4>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 py-3 px-lg-3">
                    <a href="#" class="text-decoration-none" style="font-size: calc(0.5rem + .3vw); color: rgb(40, 40, 40);" role="button">
                        <div class="border h-100">
                            <img class="img-fluid" src="gallery/cunhas.png" alt="">
                            <h4 class="text-center card-message-fs">CUNHAS</h4>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 py-3 px-lg-3">
                    <a href="#" class="text-decoration-none" style="font-size: calc(0.5rem + .3vw); color: rgb(40, 40, 40);" role="button">
                        <div class="border h-100">
                            <img class="img-fluid" src="gallery/slingBebe1.png" alt="">
                            <h4 class="text-center card-message-fs">SLINGS</h4>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 py-3 px-lg-3">
                    <a href="#" class="text-decoration-none" style="font-size: calc(0.5rem + .3vw); color: rgb(40, 40, 40);" role="button">
                        <div class="border h-100">
                            <img class="img-fluid" src="gallery/mudaFraldas.png" alt="">
                            <h4 class="text-center card-message-fs">MUDA FRALDAS</h4>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 py-3 px-lg-3">
                    <a href="#" class="text-decoration-none" style="font-size: calc(0.5rem + .3vw); color: rgb(40, 40, 40);" role="button">
                        <div class="border h-100">
                            <img class="img-fluid" src="gallery/kitMaternidadeAzul.png" alt="">
                            <h4 class="text-center card-message-fs">KIT MATERNIDADE</h4>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 py-3 px-lg-3">
                    <a href="#" class="text-decoration-none" style="font-size: calc(0.5rem + .3vw); color: rgb(40, 40, 40);" role="button">
                        <div class="border h-100">
                            <img class="img-fluid" src="gallery/antiColicas.png" alt="">
                            <h4 class="text-center card-message-fs">ALMOFADAS ANTI-CÓLICAS</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- Product Page -->

        <?php include_once './components/footer.php'; ?>
    </main>
</body>
<!-- <script src="./bootstrap/js/bootstrap.bundle.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>

</html>