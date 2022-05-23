<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include_once  './loginSession/connect_DB.php';

if (isset($_POST['add'])) {
    if (isset($_SESSION['cart'])) {

        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if (in_array($_POST['product_id'], $item_array_id)) {
            echo "<script>alert('Already added to cart');</script>";
            echo "<script>window.location = 'cunhas.php'</script>";
        } else {

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id'],
                'quantityInput' => $_POST['quantityInput']
            );

            $_SESSION['cart'][$count] = $item_array;
        }
    } else {

        $item_array = array(
            'product_id' => $_POST['product_id'],
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
    <link rel="stylesheet" href="css/almofadasAma.css">
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

        <div class="container mt-5 mb-custom">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div id="carouselFrente" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                                <!-- Slides -->
                                <div class="carousel-inner mb-5 shadow-1-strong rounded-3">
                                    <div class="carousel-item active">
                                        <img src="./gallery/cunhaProduct/azul_bebe.jpg" class="d-block w-100" alt="..." />
                                    </div>
                                    <div class="carousel-item">
                                        <img src="./gallery/cunhaProduct/azul_escuro.jpg" class="d-block w-100" alt="..." />
                                    </div>
                                    <div class="carousel-item">
                                        <img src="./gallery/cunhaProduct/laranja.jpg" class="d-block w-100" alt="..." />
                                    </div>
                                    <div class="carousel-item">
                                        <img src="./gallery/cunhaProduct/verde.jpg" class="d-block w-100" alt="..." />
                                    </div>
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
                                    <button type="button" data-mdb-target="#carouselFrente" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" style="width: 100px;">
                                        <img class="d-block w-100 shadow-1-strong rounded" src="./gallery/cunhaProduct/azul_bebe.jpg" class="img-fluid" />
                                    </button>
                                    <button type="button" data-mdb-target="#carouselFrente" data-mdb-slide-to="1" aria-label="Slide 2" style="width: 100px;">
                                        <img class="d-block w-100 shadow-1-strong rounded" src="./gallery/cunhaProduct/azul_escuro.jpg" class="img-fluid" />
                                    </button>
                                    <button type="button" data-mdb-target="#carouselFrente" data-mdb-slide-to="2" aria-label="Slide 3" style="width: 100px;">
                                        <img class="d-block w-100 shadow-1-strong rounded" src="./gallery/cunhaProduct/laranja.jpg" class="img-fluid" />
                                    </button>
                                    <button type="button" data-mdb-target="#carouselFrente" data-mdb-slide-to="3" aria-label="Slide 4" style="width: 100px">
                                        <img class="d-block w-100 shadow-1-strong rounded" src="./gallery/cunhaProduct/verde.jpg" class="img-fluid" />
                                    </button>
                                </div>
                                <!-- Thumbnails -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <form action='cunhas.php' method='post'>
                        <h3 class="m-0">Cunhas</h3>
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
                        <div class="row align-items-center mt-3">
                            <div class="col">
                                <select class="form-select" name='product_id'>
                                    <?php
                                    $result = mysqli_query($_conn, "SELECT * FROM OPTION_GROUP WHERE PACK = 'OPC'");
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value='<?php echo $product_id = $row['CODE'] ?>'><?php echo $productname = $row['NAME'] ?></option>
                                        <?php $product_id = $row['CODE']; ?>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <button class="btn" id="btn-customized" name="add" type="submit">
                                    COMPRAR <i class='fas fa-shopping-cart'></i>
                                </button>
                            </div>
                        </div>


                    </form>
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