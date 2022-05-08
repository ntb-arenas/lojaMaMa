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

        <div class="container-fluid p-0 d-none d-lg-block">
            <div class="row">
                <div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <a href="./index.php">
                        <img class="img-fluid" src="gallery/logo.png" alt="Ma-ma logo">
                    </a>
                </div>
                <form class="col-sm-6 col-md-7 col-lg-6 col-xl-7 mt-3 d-none d-sm-block">
                    <div class="row justify-content-center">
                        <div class="col-sm-9">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        </div>
                        <div class="col-sm-3">
                            <button class="btn p-sm-6" id="btn-customized" type="submit">Search <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </div>
                    </div>
                </form>
                <div class="col-6 col-sm-3 col-md-2 col-lg-3 col-xl-2 mt-3"><?php
                                                                            if (isset($_SESSION["USER"])) { ?>
                        <div class="d-flex justify-content-evenly col-12">
                            <a href="#" id="icon-hover"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                    <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                </svg></a>
                            <a href="./loginSession/userEditAccount.php" id="icon-hover"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg></a>
                            <a href="#" id="icon-hover"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg></a>
                        </div>

                    <?php } else { ?>
                        <div class="d-flex justify-content-evenly col-12">
                            <a href="#" id="icon-hover"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                    <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                </svg></a>
                            <a href="./loginSession/login.php" id="icon-hover"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg></a>
                            <a href="#" id="icon-hover"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!--Navbar starts here-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="d-lg-none" style="width: 100%;">
                <div class="row align-items-center">
                    <div class="col-5 col-sm-6 col-md-3">
                        <a href="./index.php">
                            <img class="img-fluid" src="gallery/logo.png" alt="Ma-ma logo">
                        </a>
                    </div>
                    <form class="col-md-6 d-none d-md-block">
                        <div class="row justify-content-center pt-2 px-2">
                            <div class="col-12 col-sm-9 col-md-7">
                                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                            </div>
                            <div class="col-sm-3 col-md-5 d-none d-sm-block text-center">
                                <button class="btn p-sm-6" id="btn-customized" type="submit">Search <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg></button>
                            </div>
                        </div>
                    </form>
                    <div class="col-5 col-sm-3 col-md-2  "><?php
                                                            if (isset($_SESSION["USER"])) { ?>
                            <div class="d-flex justify-content-evenly col-12">
                                <a href="#" id="icon-hover"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                        <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                    </svg></a>
                                <a href="./loginSession/userEditAccount.php" id="icon-hover"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg></a>
                                <a href="#" id="icon-hover"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                    </svg></a>
                            </div>

                        <?php } else { ?>
                            <div class="d-flex justify-content-evenly col-12">
                                <a href="#" id="icon-hover"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                        <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                    </svg></a>
                                <a href="./loginSession/login.php" id="icon-hover"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg></a>
                                <a href="#" id="icon-hover"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                    </svg></a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-2 col-sm-3 col-md-1   text-center">
                        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-bars theme-color"></i>
                        </button>
                    </div>

                </div>
            </div>
            <div class="collapse navbar-collapse px-2" id="navbarTogglerDemo02">
                <ul class="navbar-nav justify-content-around col-12">

                    <?php
                    $resultTablecategory = mysqli_query($_conn, "SELECT * FROM CATEGORY WHERE VISIBLE = 1 ORDER BY SEQUENCE ASC");
                    $resultTablecategoryDropdown = mysqli_query($_conn, "SELECT * FROM CATEGORY WHERE VISIBLE = 2 ORDER BY SEQUENCE ASC");

                    //MENU OPTION
                    if (mysqli_num_rows($resultTablecategoryDropdown) > 0) {
                        $ctd = 0;
                        while ($rowTablecategoryDropdown = mysqli_fetch_assoc($resultTablecategoryDropdown)) {
                            $ctd = $ctd + 1;
                    ?>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link fs-5 dropdown-toggle" id="dropdownMenuLink" data-mdb-boundary="scrollParent" data-mdb-toggle="dropdown" aria-expanded="false">
                                    <?php echo $rowTablecategoryDropdown['TITLE'] ?>
                                </a>
                                <?php
                                if ($rowTablecategoryDropdown['TITLE'] == 'ALMOFADAS DE AMAMENTAÇÃO') { ?>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="./almofadasAmaPadrao.php">GRANDE</a></li>
                                        <li><a class="dropdown-item" href="#">PEQUENO</a></li>
                                    </ul>
                                <?php
                                }
                                ?>
                            </li>
                    <?php
                        }
                    }
                    //MENU OPTION

                    mysqli_free_result($resultTablecategoryDropdown);
                    ?>

                    <?php
                    if (mysqli_num_rows($resultTablecategory) > 0) {
                        $ctd = 0;
                        while ($rowTablecategory = mysqli_fetch_assoc($resultTablecategory)) {
                            $ctd = $ctd + 1;
                    ?>
                            <li class="nav-item"><a href="./<?php echo $rowTablecategory['LINK'] ?>" class="nav-link fs-5"> <?php echo $rowTablecategory['TITLE'] ?></a></li>
                    <?php
                        }
                    }
                    mysqli_free_result($resultTablecategory);
                    ?>
                </ul>
            </div>
            <form class="d-md-none" style="width: 100%;">
                <div class="row justify-content-center pt-2 px-2">
                    <div class="col-12 col-sm-9 col-md-10">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    </div>
                    <div class="col-sm-3 col-md-2 d-none d-sm-block text-center">
                        <button class="btn p-sm-6" id="btn-customized" type="submit">Search <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg></button>
                    </div>
                </div>
            </form>
        </nav>
        <!--Navbar ends here-->

        <!-- Page cover -->
        <img class="img-fluid mx-auto d-none d-md-block" src="./gallery/maincover.jpg" alt="">
        <img class="img-fluid mx-auto d-none d-sm-block d-md-none" src="./gallery/maincovertabletsize.jpg" alt="">
        <img class="img-fluid mx-auto d-sm-none" src="./gallery/maincovermobilesize.jpg" alt="">
        <!-- Page cover -->

        <div class="container-fluid p-0 border-bottom">
            <h3 class="text-center m-3 cover-message-fs" style="color: rgb(93, 93, 93);">Com a Ma-Ma, a vida da mãe e do seu bebé nunca foi tão fácil. Descubra os nossos produtos!</h3>
        </div>

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
                    <a href="./almofadasAma.php" class="text-decoration-none" style="font-size: calc(0.5rem + .3vw); color: rgb(40, 40, 40);" role="button">
                        <div class="border h-100">
                            <img class="img-fluid" src="gallery/almofadaImg.png" alt="">
                            <h4 class="text-center card-message-fs">ALMOFADAS DE AMAMENTAÇÃO</h4>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-4 py-3 px-lg-3">
                    <a href="./cunhas.php" class="text-decoration-none" style="font-size: calc(0.5rem + .3vw); color: rgb(40, 40, 40);" role="button">
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
    </main>
</body>
<!-- <script src="./bootstrap/js/bootstrap.bundle.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>

</html>