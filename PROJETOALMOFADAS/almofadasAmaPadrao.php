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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

</head>

<body>
    <main>

        <?php include_once './components/header.php'; ?>
        <?php include_once './components/navbar.php'; ?>

        <!--Product page starts here-->

        <!-- Carousel wrapper -->
        <div class="container-lg mt-5 mb-custom">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-5 mb-sm-5 mb-custom">
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

                        <div class="col-12 col-md-6 mb-5 mb-sm-5">
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
                                            <button type="button" data-mdb-target="#carouselVerso" data-mdb-slide-to="' . $num . '" class="active" aria-current="true" aria-label="Slide ' . $slideNum . '" style="width: 100px;">
                                                <img class="d-block w-100 shadow-1-strong rounded" src="' . $row['IMAGE_URL'] . '" class="img-fluid" />
                                            </button>';
                                        } else {
                                            $num = $num + 1;
                                            $slideNum = $slideNum + 1;
                                            echo '
                                            <button type="button" data-mdb-target="#carouselVerso" data-mdb-slide-to="' . $num . '" aria-label="Slide ' . $slideNum . '" style="width: 100px;">
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
                        <h3 class="m-0" style="font-weight: 700;">Almofadas de Amamentação</h3>
                        <hr class="mt-2">
                        <p style="font-size: 0.9rem;">A Almofada de Amamentação MA-MA® Original serve como um apoio fundamental para a futura mamã, proporcionando noites de sono tranquilas e sem os habituais desconfortos que costumam ocorrer durante a gravidez. Chegada a altura de amamentar a almofada MA-MA® será igualmente uma fiel aliada, permitindo que a mamã adopte uma posição confortável e que o bebé fique bem apoiado.</p>
                        <p class="m-0"><small>Preço:</small><span class="fs-3" style="font-weight: 500;"> 45€</span></p>
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
        <!-- Carousel wrapper -->

        <div class="container mt-5">
            <h1 class="text-center m-0" style="font-weight: 500;">Modo de Utilização</h1>
        </div>
        <hr>
        <div class="container-fluid" style="background: rgb(223,223,223);background: linear-gradient(0deg, rgba(223,223,223,0.8435749299719888) 0%, rgba(238,238,238,0) 100%);">
            <div class="container-lg">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <img src="gallery/productimg/amamentar.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="fs-3 m-0" style="font-weight: 400; color: #000;">Para Amamentar</p>
                        <p class="fs-custom" style="font-weight: 400; color: #414042;">A amamentação pode ser um momento muito especial se correr da melhor forma, tanto para o bebé como para a mãe. Nesse sentido a Almofada de Amamentação MA-MA® é uma perfeita aliada após o parto. A almofada permite à mamã amamentar numa posição confortável e sem colocar stress desnecessário na sua coluna e costas. O bebé fica apoiado e deste modo consegue amamentar de uma forma mais eficiente. O fecho nas extremidades da almofada permitem que ela fique 100% presa e apoiada, deste modo a mamã pode focar-se apenas no bebé e aproveitar ao máximo este momento único de vinculação.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="background: rgb(223,223,223);background: linear-gradient(0deg, rgba(223,223,223,0.8435749299719888) 0%, rgba(238,238,238,0) 100%);">
            <div class="container-lg">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 order-2 order-md-1">
                        <p class="fs-3 m-0" style="font-weight: 400; color: #000;">Para Dormir</p>
                        <p class="fs-custom" style="font-weight: 400; color: #414042;">A Almofada de Amamentação MA-MA® é uma perfeita aliada da mamã mesmo antes do nascimento do bebé. Durante a gravidez a mamã pode utilizar a almofada para dormir. O seu tamanho e formato em U permitem colocar a almofada entre as pernas ao mesmo tempo que a barriga fica apoiada e a cabeça e pescoço ficam numa posição ideal. Desta forma a mamã consegue encontrar uma posição de repouso confortável tanto para ela como para o pequeno bebé que se está a desenvolver.</p>
                    </div>
                    <div class="col-12 col-md-6 order-1 order-md-2">
                        <img src="gallery/productimg/dormir.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="background: rgb(223,223,223);background: linear-gradient(0deg, rgba(223,223,223,0.8435749299719888) 0%, rgba(238,238,238,0) 100%);">
            <div class="container-lg">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 d-flex justify-content-center">
                        <img src="gallery/productimg/bebeDescansar.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="fs-3 m-0" style="font-weight: 400; color: #000;">Para o bebé descansar</p>
                        <p class="fs-custom" style="font-weight: 400; color: #414042;">Não é só a mãe que pode utilizar a Almofada de Amamentação MA-MA® para dormir. Os bebés adoram ficar apoiados nas almofadas enquanto dormem uma sesta em perfeita segurança sem o risco de se virarem. Estas almofadas também servem de redutor na cama de grades ou até mesmo de ninho, ficando o bebé muito aconchegado. Mais tarde quando o bebé se começa a sentar é um apoio muito seguro para evitar qualquer desequilíbrio para os lados ou para trás.</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="container mt-3">
            <h1 class="text-center m-0" style="font-weight: 500;">Acabamentos</h1>
        </div>
        <hr>
        <div class="container">
            <p><b>Todas as nossas almofadas têm acabamentos importantes para o bem-estar da mãe e do bebé:</b></p>
            <p><b>- Forro com fecho invisível</b>: Permite a lavagem sempre que necessário ou modificar o padrão do forro sempre que quiser.<br><b>- Fecho em velcro</b>: Estas almofadas fecham, fazendo um ninho que permite dar maior apoio e versatilidade à almofada.
            </p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-3 mb-1"><img src="gallery/productimg/1.jpg" class="img-fluid" alt=""></div>
                <div class="col-12 col-sm-3 mb-1"><img src="gallery/productimg/2.jpg" class="img-fluid" alt=""></div>
                <div class="col-12 col-sm-3 mb-1"><img src="gallery/productimg/3.jpg" class="img-fluid" alt=""></div>
                <div class="col-12 col-sm-3 mb-1"><img src="gallery/productimg/4.jpg" class="img-fluid" alt=""></div>
            </div>
        </div>

        <!--Product page ends here-->


        <?php include_once './components/footer.php'; ?>
    </main>
</body>
<script src="./js/script.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>

</html>