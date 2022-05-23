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

        <?php include_once './components/footer.php'; ?>
    </main>
</body>
<script src="./js/script.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>

</html>