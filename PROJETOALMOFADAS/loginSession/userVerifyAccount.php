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

                        echo "STATUS ADMIN (ativar conta): " . mysqli_error($_conn);
                    }
                    mysqli_stmt_close($stmt);
                }
            }
        }
    } else {

        $message = "A conta para ativar não existe na nossa base de dados!";
    }
} else {

    // caso alguém use o endereço sem parametros volta 
    // de imediato para a página principal sem dar qualquer
    // tipo de message

    // encaminhar para página principal
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
    header("Location: ../index.php"); // encaminhar de imediato




}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaMa verify</title>
    <link rel="stylesheet" href="../css/loginSession.css">
</head>

<body class="verifyAcc-page">

    <div class="verifyAcc-container">
        <div class="verifyAcc-content">
            <h3>ATIVAR CONTA</h3>
            <p>Ativar a sua conta de utilizador.</p>


            <p><b><?php echo $message; ?></b></p>

            <form action="../index.php" method="POST">
                <button class="btn" type="submit"><span>PÁGINA PRINCIPAL</span></button>

            </form>
        </div>
    </div>

</body>

</html>
