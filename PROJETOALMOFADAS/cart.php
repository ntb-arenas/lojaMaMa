<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include_once  './loginSession/connect_DB.php';

// if (!isset($_SESSION['USER'])) {
//     header("Location: ./index.php");
//     exit;
// }

if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value["product_id1"] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                echo "<script>window.location = 'cart.php'</script>";
            }
            if ($value["product_id"] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
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
    <!-- Google Fonts -->
</head>

<body>
    <main>
        <?php include_once './components/header.php'; ?>
        <?php include_once './components/navbar.php'; ?>

        <div class="container-fluid mt-5">
            <div class="row px-md-5">
                <div class="col-md-7">
                    <div class="shopping-cart">
                        <h3><strong>Carrinho de compras</strong></h3>
                        <hr>

                        <?php
                        $total = 0;
                        if (!empty($_SESSION['cart'])) { ?>
                            <div class="container d-none d-lg-block">
                                <div class="row">
                                    <div class="col-3 text-center">
                                        <h4><strong>Item</strong></h4>
                                    </div>
                                    <div class="col-3">

                                    </div>
                                    <div class="col-2">
                                        <h4><strong>Quantidade</strong></h4>
                                    </div>
                                    <div class="col-2">
                                        <h4><strong>Preço</strong></h4>
                                    </div>
                                    <div class="col-2">
                                    </div>
                                </div>
                            </div>

                            <?php
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $result = mysqli_query($_conn, "SELECT * FROM OPTION_GROUP");
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        if ($row['CODE'] == $value['product_id1']) {
                            ?>
                                            <div class='container border rounded mb-3'>
                                                <div class="row">
                                                    <div class="col-3 text-center">
                                                        <form action='cart.php?action=remove&id=<?php echo $row['CODE'] ?>' method='post' class='cart-items'>
                                                            <img src=<?php echo $row['IMAGE_URL'] ?> alt='Image1' class='img-fluid'>
                                                            <h5 class='pt-2'>(Frente): <?php echo $row['NAME'] ?></h5>
                                                    </div>
                                                <?php
                                                $totalQuantity = (int)$row['PRICE'] * $value['quantityInput'];
                                                $total = $total + $totalQuantity;
                                            }
                                            if ($row['CODE'] == $value['product_id2']) {
                                                ?>
                                                    <div class="col-3 text-center">
                                                        <img src=<?php echo $row['IMAGE_URL'] ?> alt='Image1' class='img-fluid'>
                                                        <h5 class='pt-2'>(Verso): <?php echo $row['NAME'] ?></h5>
                                                    </div>
                                                    <div class="col-2 text-center">
                                                        <h5 class='pt-2'><?php echo $value['quantityInput'] ?></h5>
                                                    </div>
                                                    <div class="col-2">
                                                        <h5 class='pt-2'>€<?php echo $totalQuantity ?></h5>
                                                    </div>
                                                    <div class="col-3 d-none d-sm-block">
                                                        <button type='submit' class='btn btn-danger m-2' name='remove'>Remover</button>
                                                    </div>
                                                    <div class="col-2 d-sm-none text-center">
                                                        <button type='submit' class='btn btn-danger p-0 fs-5' name='remove'>X</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php
                                            }
                                            if ($row['CODE'] == $value['product_id']) {
                                        ?>
                                            <div class="container border rounded mb-3">

                                                <form action='cart.php?action=remove&id=<?php echo $row['CODE'] ?>' method='post' class='cart-items'>
                                                    <?php
                                                    $totalQuantity = (int)$row['PRICE'] * $value['quantityInput'];
                                                    $total = $total + $totalQuantity;
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-3 text-center">
                                                            <img src=<?php echo $row['IMAGE_URL'] ?> alt='Image1' class='img-fluid'>
                                                            <h5 class='pt-2'><?php echo $row['NAME'] ?></h5>
                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                        <div class="col-2 text-center">
                                                            <h5 class='pt-2'><?php echo $value['quantityInput'] ?></h5>
                                                        </div>
                                                        <div class="col-2">
                                                            <h5 class='pt-2'>€<?php echo $totalQuantity ?></h5>
                                                        </div>
                                                        <div class="col-3 d-none d-sm-block">
                                                            <button type='submit' class='btn btn-danger m-2' name='remove'>Remover</button>
                                                        </div>
                                                        <div class="col-2 d-sm-none text-center">
                                                            <button type='submit' class='btn btn-danger p-0 fs-5' name='remove'>X</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                        <?php
                                            }
                                        }
                                    }
                                }
                            } else {
                                echo "<h6><strong>Carrinho está vazío!</strong></h6>";
                            }
                        ?>

                    </div>
                </div>
                <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
                    <div class="pt-4">
                        <h5><strong>Resumo</strong></h5>
                        <hr>
                        <div class="row price-details">
                            <div class="col-md-6">
                                <?php
                                if (isset($_SESSION['cart'])) {
                                    $count  = count($_SESSION['cart']);
                                    echo "<h6>Preço ($count Produtos)</h6>";
                                } else {
                                    echo "<h6>Preço (0 Produtos)</h6>";
                                }
                                ?>
                                <h6>Custo de envio</h6>
                                <hr>
                                <h6>TOTAL DA ENCOMENDA</h6>
                            </div>
                            <div class="col-md-6">
                                <h6>$<?php echo $total; ?></h6>
                                <h6 class="text-success">Envio gratis</h6>
                                <hr>
                                <h6>$<?php
                                        echo $total;
                                        ?></h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php include_once './components/footer.php'; ?>
    </main>
</body>
<!-- <script src="./bootstrap/js/bootstrap.bundle.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>

</html>