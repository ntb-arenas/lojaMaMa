<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include_once  './loginSession/connect_DB.php';

if (isset($_POST['add'])) {
    if (isset($_SESSION['cart'])) {

        $item_array_id1 = array_column($_SESSION['cart'], "product_id1");
        $item_array_id2 = array_column($_SESSION['cart'], "product_id2");

        if (in_array($_POST['product_id1'], $item_array_id1) && in_array($_POST['product_id2'], $item_array_id2)) {
            $temporaryMsg = '<div class="alert alert-warning mt-3 p-2" role="alert">Item already exists</div>';
        } else {

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id1' => $_POST['product_id1'],
                'product_id2' => $_POST['product_id2'],
                'quantityInput' => $_POST['quantityInput']
            );

            $_SESSION['cart'][$count] = $item_array;
        }
    } else {

        $item_array = array(
            'product_id1' => $_POST['product_id1'],
            'product_id2' => $_POST['product_id2'],
            'quantityInput' => $_POST['quantityInput']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
    }
}

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

</head>

<body>
    <main>

        <?php include_once './components/header.php'; ?>
        <?php include_once './components/navbar.php'; ?>

        <!--Product page starts here-->
        <!-- 
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
        </div> -->


        <!-- Carousel wrapper -->
        <div class="container-fluid mt-5 mb-custom">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div id="carouselFrente" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                                <!-- Slides -->
                                <div class="carousel-inner mb-5 shadow-1-strong rounded-3">
                                    <?php
                                    $result = mysqli_query($_conn, "SELECT * FROM OPTION_GROUP WHERE PACK = 'OP1'");
                                    while ($row = mysqli_fetch_array($result)) {
                                        if ($row['CODE'] == 'F1') {
                                            echo '
                                            <div class="carousel-item active">
                                                <img src="' . $row["IMAGE_URL"] . '" class="d-block w-100" alt="..." />
                                            </div>';
                                        } else {
                                            echo '
                                            <div class="carousel-item">
                                                <img src="' . $row["IMAGE_URL"] . '" class="d-block w-100" alt="..." />
                                            </div>';
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- Slides -->

                                <!-- Controls -->
                                <button class="carousel-control-prev" type="button" data-mdb-target="#carouselFrente" data-mdb-slide="prev">
                                    <span class="carousel-control-prev-icon theme-color" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-mdb-target="#carouselFrente" data-mdb-slide="next">
                                    <span class="carousel-control-next-icon theme-color" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                <!-- Controls -->

                                <!-- Thumbnails -->
                                <div class="carousel-indicators" style="margin-bottom: -20px;">
                                    <?php
                                    $num = 0;
                                    $slideNum = 1;
                                    $result = mysqli_query($_conn, "SELECT * FROM OPTION_GROUP WHERE PACK = 'OP1'");
                                    while ($row = mysqli_fetch_array($result)) {
                                        if ($row['CODE'] == 'F1') {
                                            echo '
                                            <button type="button" data-mdb-target="#carouselFrente" data-mdb-slide-to="' . $num . '" class="active" aria-current="true" aria-label="Slide ' . $slideNum . '" style="width: 100px;">
                                                <img class="d-block w-100 shadow-1-strong rounded" src="' . $row['IMAGE_URL'] . '" class="img-fluid" />
                                            </button>';
                                        } else {
                                            $num = $num + 1;
                                            $slideNum = $slideNum + 1;
                                            echo '
                                            <button type="button" data-mdb-target="#carouselFrente" data-mdb-slide-to="' . $num . '" aria-label="Slide ' . $slideNum . '" style="width: 100px;">
                                                <img class="d-block w-100 shadow-1-strong rounded" src="' . $row['IMAGE_URL'] . '" class="img-fluid" />
                                            </button>';
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- Thumbnails -->
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div id="carouselVerso" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                                <!-- Slides -->
                                <div class="carousel-inner mb-5 shadow-1-strong rounded-3">
                                    <?php
                                    $result = mysqli_query($_conn, "SELECT * FROM OPTION_GROUP WHERE PACK = 'OP2'");
                                    while ($row = mysqli_fetch_array($result)) {
                                        if ($row['CODE'] == 'V1') {
                                            echo '
                                            <div class="carousel-item active">
                                                <img src="' . $row["IMAGE_URL"] . '" class="d-block w-100" alt="..." />
                                            </div>';
                                        } else {
                                            echo '
                                            <div class="carousel-item">
                                                <img src="' . $row["IMAGE_URL"] . '" class="d-block w-100" alt="..." />
                                            </div>';
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- Slides -->

                                <!-- Controls -->
                                <button class="carousel-control-prev" type="button" data-mdb-target="#carouselVerso" data-mdb-slide="prev">
                                    <span class="carousel-control-prev-icon theme-color" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-mdb-target="#carouselVerso" data-mdb-slide="next">
                                    <span class="carousel-control-next-icon theme-color" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                <!-- Controls -->

                                <!-- Thumbnails -->
                                <div class="carousel-indicators" style="margin-bottom: -20px;">
                                    <?php
                                    $num = 0;
                                    $slideNum = 1;
                                    $result = mysqli_query($_conn, "SELECT * FROM OPTION_GROUP WHERE PACK = 'OP2'");
                                    while ($row = mysqli_fetch_array($result)) {
                                        if ($row['CODE'] == 'V1') {
                                            echo '
                                            <button type="button" data-mdb-target="#carouselFrente" data-mdb-slide-to="' . $num . '" class="active" aria-current="true" aria-label="Slide ' . $slideNum . '" style="width: 100px;">
                                                <img class="d-block w-100 shadow-1-strong rounded" src="' . $row['IMAGE_URL'] . '" class="img-fluid" />
                                            </button>';
                                        } else {
                                            $num = $num + 1;
                                            $slideNum = $slideNum + 1;
                                            echo '
                                            <button type="button" data-mdb-target="#carouselFrente" data-mdb-slide-to="' . $num . '" aria-label="Slide ' . $slideNum . '" style="width: 100px;">
                                                <img class="d-block w-100 shadow-1-strong rounded" src="' . $row['IMAGE_URL'] . '" class="img-fluid" />
                                            </button>';
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- Thumbnails -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <form action='almofadasAmaPadrao.php' method='post'>
                        <h3 class="m-0">Almofadas de Amamentação</h3>
                        <hr class="mt-2">
                        <p class="m-0"><small>Preço:</small><strong class="fs-2"> 45€</strong></p>
                        <p class="m-0">
                            <small>
                                Qty:
                                <select name="quantityInput">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </small>
                        </p>

                        <div class="row">
                            <div class="col">
                                Frente
                                <select class="form-select" name='product_id1'>
                                    <?php
                                    $result = mysqli_query($_conn, "SELECT * FROM OPTION_GROUP WHERE PACK = 'OP1'");
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value='<?php echo $productid = $row['CODE'] ?>'><?php echo $productname = $row['NAME'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                Verso
                                <select class="form-select" name='product_id2'>
                                    <?php
                                    $result = mysqli_query($_conn, "SELECT * FROM OPTION_GROUP WHERE PACK = 'OP2'");
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value='<?php echo $productid = $row['CODE'] ?>'><?php echo $productname = $row['NAME'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button class="btn mt-3" id="btn-customized" name="add" type="submit">COMPRAR <i class='fas fa-shopping-cart'></i></button>
                    </form>
                    <?php
                    echo $temporaryMsg;
                    mysqli_free_result($result);
                    ?>
                </div>
            </div>
        </div>



        <!--Product page ends here-->

        <!--Footer section starts here-->
        <footer class="p-3 d-none d-md-block mb-5 mt-5" style="background-color: rgb(224, 224, 224);">
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
                                <h4 class=" border-bottom border-dark">Sobre Nós</h4>
                                <div class="p-0 d-flex flex-column">
                                    <a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Quem Somos</a>
                                    <a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Contactos</a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 mb-3">
                                <h4 class=" border-bottom border-dark">Informações</h4>
                                <div class="p-0 d-flex flex-column">
                                    <a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Modos de Pagamento</a>
                                    <a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Envio de Encomendas e Custos</a>
                                    <a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Garantias</a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 mb-3">
                                <h4 class=" border-bottom border-dark">Siga-nos</h4>
                                <div class="p-0 d-flex flex-row col-9 justify-content-around">
                                    <div class="p-0 d-flex flex-row col-9 justify-content-between">
                                        <a class="btn btn-primary" style="background-color: #3b5998;" href="#!">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a class="btn btn-primary" style="background-color: #1D9BF0;" href="#!">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a class="btn btn-primary gradient-insta" href="#!">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <footer class="list-group w-100 p-3 d-md-none mb-5 mb-sm-1 mt-5" style="background-color: rgb(224, 224, 224);">
            <a href="./index.php">
                <img class="img-fluid col-5 col-sm-4 col-md-3" src="gallery/logo.png" alt="Ma-ma logo" class="logo">
            </a>
            <h4 style="color: #ff7b46;">Apoio Comercial</h4>
            <h2 style="color: rgb(93, 93, 93);"><strong>916 532 480</strong></h2>
            <p>das 9h às 18h</p>

            <a href="#shortExampleAnswer1collapse" data-mdb-toggle="collapse" aria-expanded="false" aria-controls="shortExampleAnswer1collapse">
                <div class="d-flex w-100 justify-content-between border-bottom mb-2" style="border-color: rgb(93, 93, 93)!important;">
                    <h4 class="" class="text-decoration-none" style="color: rgb(93, 93, 93);">Sobre Nós</h4>
                </div>
                <!-- Collapsed content -->
                <div class="collapse" id="shortExampleAnswer1collapse">
                    <div><a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Quem Somos</a></div>
                    <div><a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Contactos</a></div>
                </div>
            </a>

            <a href="#shortExampleAnswer2collapse" data-mdb-toggle="collapse" aria-expanded="false" aria-controls="shortExampleAnswer3collapse">
                <div class="d-flex w-100 justify-content-between  border-bottom mb-2" style="border-color: rgb(93, 93, 93)!important;">
                    <h4 class="text-decoration-none" style="color: rgb(93, 93, 93);">Informações <span class="caret"></span></h4>
                </div>
                <!-- Collapsed content -->
                <div class="collapse" id="shortExampleAnswer2collapse">
                    <div><a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Quem Somos</a></div>
                    <div><a class="text-decoration-none" style="color: rgb(93, 93, 93);" href="#">Contactos</a></div>
                </div>
            </a>

            <a href="#shortExampleAnswer3collapse" data-mdb-toggle="collapse" aria-expanded="false" aria-controls="shortExampleAnswer3collapse">
                <div class="d-flex w-100 justify-content-between  border-bottom mb-2" style="border-color: rgb(93, 93, 93)!important;">
                    <h4 class="text-decoration-none" style="color: rgb(93, 93, 93);">Siga-nos</h4>
                </div>
                <!-- Collapsed content -->
                <div class="collapse" id="shortExampleAnswer3collapse">
                    <div class="justify-content-around">
                        <a class="btn btn-primary" style="background-color: #3b5998;" href="#!" role="button">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="btn btn-primary" style="background-color: #1D9BF0;" href="#!" role="button">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="btn btn-primary gradient-insta" href="#!" role="button">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </a>
        </footer>
        <!--Footer section ends here-->
    </main>
</body>
<script src="./js/script.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>

</html>