<?php

session_start();
include_once  '../loginSession/connect_DB.php';

$username = $_SESSION["USER"];

$stmt = $_conn->prepare('SELECT * FROM USERS WHERE USERNAME = ?');
$stmt->bind_param('s', $username);
$stmt->execute();

$usersResult = $stmt->get_result();

if ($usersResult->num_rows > 0) {
    while ($rowUsers = $usersResult->fetch_assoc()) {
        $morada = $rowUsers['MORADA'];
        $telemovel = $rowUsers['TELEMOVEL'];
        $cidade = $rowUsers['CIDADE'];
        $codPostal = $rowUsers['COD_POSTAL'];
        $pais = $rowUsers['PAIS'];
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ma-Ma</title>
        <!-- stylesheet ---------------------------->
        <link rel="stylesheet" href="../css/style.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />
        <!-- page icon --------------------------------->
        <link rel="shortcut icon" href="../gallery/logo.png">
        <!-- fonts ------------------------------------------>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
        <!-- Google Fonts -->
    </head>
</head>

<body>
    <main>
        <?php include_once '../components/header_redirect.php'; ?>
        <?php include_once '../components/navbar_redirect.php'; ?>

        <div class="container py-5">
            <h2>Olá <?php echo $_SESSION["FIRSTNAME_USER"] . " " . $_SESSION["LASTNAME_USER"] ?>, </h2>
            <h5><a href="../loginSession/userSair.php">Logout</a></h5>
        </div>

        <div class="container-md">
            <div class="row">
                <div class="col-3">
                    <div class="list-group list-group-light">
                        <a href="./profileAccount.php" class="list-group-item list-group-item-action px-3 border-0">INFORMAÇÕES DA CONTA</a>
                        <a href="./encomendas.php" class="list-group-item list-group-item-action px-3 border-0">AS MINHAS ENCOMENDAS</a>
                        <a href="./userEditAccount.php" class="list-group-item list-group-item-action px-3 border-0">EDITAR CONTA</a>
                        <a href="./favorite.php" class="list-group-item list-group-item-action px-3 border-0  active" id="account-style" aria-current="true">LISTA DE DESEJOS</a>
                    </div>
                </div>
                <div class="col-9 border-start">
                    Wishlist
                </div>
            </div>
        </div>

        <!-- <div class="information-container">
            <div class="sidebar-main">
                <div class="customer-area">
                    <h1>
                        Olá 
                    </h1>
                    <h3><a href="./loginSession/userSair.php">Logout</a></h3>
                </div>

                <div class="account-panel">
                    <h3>PAINEL DE CONTA</h3>
                    <div class="account-panel-wrapper">
                        <p><a href="#">A MINHA CONTA</a></p>
                        <p><a href="#">AS MINHAS ENCOMENDAS</a></p>
                        <p><a href="#">SUBSCRIÇÃO MARKETING</a></p>
                    </div>
                </div>
            </div>

            <div class="information-component">
                <h1>A Minha conta</h1>

                <div class="box-information">
                    <div class="box-title">
                        <h2 class="info_cont">INFORMAÇÃO DE CONTACTO</h2>
                    </div>

                    <div class="box-content">
                        <p>
                            <?php echo $_SESSION["FIRSTNAME_USER"] . " " . $_SESSION["LASTNAME_USER"] ?>
                            <br>
                            <?php echo $_SESSION["EMAIL_USER"] ?>
                        </p>
                    </div>
                    <div class="div-btn-profile">
                        <form action="./loginSession/userEditPass.php">
                            <button class="btn-profile" name="button-edit-info" type="submit"><span>EDITAR</span></button>
                        </form>
                    </div>
                </div>
                <div class="box-information">
                    <div class="box-title">
                        <h2 class="info_cont">MORADA</h2>
                    </div>

                    <div class="box-content">
                        <p><?php echo $_SESSION["FIRSTNAME_USER"] . " " . $_SESSION["LASTNAME_USER"]; ?></p>
                        <p><?php echo $morada; ?></p>
                        <p><?php echo $codPostal . ", " . $cidade; ?></p>
                        <p><?php echo $pais; ?></p>
                        <p><?php echo "T: " . $telemovel; ?></p>
                    </div>

                    <div class="div-btn-profile">
                        <form action="./loginSession/userEditAccount.php">
                            <button class="btn-profile" name="button-edit-morada" type="submit"><span>EDITAR</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->

        <?php include_once '../components/footer_redirect.php'; ?>
    </main>
</body>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>

</html>