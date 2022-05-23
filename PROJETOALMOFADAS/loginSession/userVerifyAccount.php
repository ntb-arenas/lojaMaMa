<?php

session_start();

include_once  './connect_DB.php';


$message = "";

if (isset($_GET['id']) && isset($_GET['code'])) {

    $username = base64_decode($_GET['id']); // código do utilizador...
    $code = $_GET['code']; // token...


    $stmt = $_conn->prepare('SELECT * FROM USERS WHERE USERNAME = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $usersResult = $stmt->get_result();

    if ($usersResult->num_rows > 0) {
        while ($rowUsers = $usersResult->fetch_assoc()) {

            $estado = $rowUsers['USER_STATUS'];

            if ($estado != 0) {

                $message = "A sua conta já se encontra ativa. Pode iniciar sessão com a sua conta.";
            } else {
                // Procedimento de segurança para ativar a conta...
                if (($code != $rowUsers['TOKEN_CODE'] || $rowUsers['TOKEN_CODE'] == '')) {

                    $message = "O código de ativação não está correto ou já foi utilizado.";
                } else {
                    // o código de ativação está correto e não foi ainda utilizado
                    // fazer update à tabela de USERS para atualizar o estado e limpar o token
                    $sql = "UPDATE  USERS SET USER_STATUS=1, TOKEN_CODE=? WHERE USERNAME=?";

                    if ($stmt = mysqli_prepare($_conn, $sql)) {

                        $code = "";
                        mysqli_stmt_bind_param($stmt, "ss", $code, $username);
                        mysqli_stmt_execute($stmt);


                        $message = "A sua conta foi ativada com sucesso! Já pode iniciar a sua sessão."; // ok


                    } else {
                        // falhou a atualização 
                        printf("Error: %s.\n", mysqli_stmt_error($stmt));
                        echo "STATUS ADMIN (ativar conta): " . mysqli_error($_conn);
                    }
                    mysqli_stmt_close($stmt);
                }
            }
        }
    } else {
        echo "Error in " . $stmt . "<br>" . $stmt->error;
        $message = "A conta para ativar não existe na nossa base de dados!";
    }
} else {

    // caso alguém use o endereço sem parametros volta 
    // de imediato para a página principal sem dar qualquer
    // tipo de message

    // // encaminhar para página principal
    // header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    // header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
    // header("Location: ../index.php"); // encaminhar de imediato




}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma-Ma Entrar</title>
    <!-- stylesheet ---------------------------->
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />
    <!-- page icon --------------------------------->
    <link rel="shortcut icon" href="../gallery/logo.png">
    <!-- fonts ------------------------------------------>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>

<body>
    <main>
        <?php include_once '../components/header_redirect.php'; ?>
        <?php include_once '../components/navbar_redirect.php'; ?>

        <nav class="mx-3 mt-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="../index.php">Início</a></li>
                <li class="breadcrumb-item active text-warning" aria-current="page">
                    <a class="text-decoration-none text-warning" href="./login.php">Verificar a conta</a>
                </li>
            </ol>
        </nav>

        <div class="container border p-3 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
            </svg>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg> <b><?php echo $message; ?></b></h4>
                <form action="../index.php" method="POST">
                    <button class="btn btn-success" type="submit">PÁGINA PRINCIPAL</button>
                </form>
            </div>
        </div>


        <?php include_once '../components/footer_redirect.php'; ?>
    </main>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>

</html>