<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

// to see all errors:
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

include_once  './connect_DB.php';

$errorMessageUsername = "";
$errorMessagePassword = "";

if(isset($_SESSION["USER"])) {
    header("Location: ../index.php"); // redirects them to homepage
    exit; // for good measure
}

if (isset($_POST['button-cancel'])) {
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
    header("Location: ./PROJETOALMOFADAS/index.php");
}

if (isset($_POST['button-login'])) {

    $username = strtolower(trim(mysqli_real_escape_string($_conn, $_POST["formUsername"])));
    $username = trim($username);

    $password = trim(mysqli_real_escape_string($_conn, $_POST["formPassword"]));
    $password = trim($password);

    $username = strip_tags($username);

    $stmt = $_conn->prepare('SELECT * FROM USERS WHERE USERNAME = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $usersResult = $stmt->get_result();

    if ($usersResult->num_rows > 0) {
        while ($rowUsers = $usersResult->fetch_assoc()) {

            if ($rowUsers['USER_STATUS'] == 2) { // BLocked user

                $errorMessagePassword = "Não é possível entrar no sistema. Contacte os nossos serviços para obter ajuda.";
            } else  if ($rowUsers['USER_STATUS'] == 0) { // User account created but not verified

                $errorMessagePassword =  $rowUsers['fNAME'] . ", ainda não ativou a sua conta. A mensagem com o código inicial de ativação de conta foi enviada para a sua caixa de correio. Caso não a encontre na sua caixa de entrada, verifique também o seu correio não solicitado ou envie-nos um email para ativarmos a sua conta. Obrigado.";
            } else  if (password_verify($password, $rowUsers["PASSWORD"])) {

                $_SESSION["USER"] = $rowUsers["USERNAME"];
                $_SESSION["LEVEL_USER"] = $rowUsers["USER_STATUS"];
                $_SESSION["FIRSTNAME_USER"] = $rowUsers["fNAME"];
                $_SESSION["LASTNAME_USER"] = $rowUsers["lNAME"];
                $_SESSION["EMAIL_USER"] = $rowUsers["EMAIL"];

                header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
                header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
                header("Location: ../index.php");
            } else {
                $errorMessagePassword = "password incorreta!";
            }
        }
    } else {
        $errorMessageUsername = "O código de utilizador não existe na nossa base de dados!";
    }

    $stmt->free_result();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma-Ma Entrar</title>
    <link rel="stylesheet" href="../css/loginSession.css">
</head>

<body>
    <!-- interface para entrar no sistema -->
    <main>
        <form action="#" method="POST">
            <input type="text" placeholder="Código de utilizador" name="formUsername" value="<?php echo $username; ?>">
            <p><?php echo $errorMessageUsername; ?></p>

            <input type="password" placeholder="password" name="formPassword" value="<?php echo $password; ?>">
            <p><?php echo $errorMessagePassword; ?></p>

            <p>
                <button name="button-login" type="submit">INICIAR SESSÃO</button>
                <button name="button-cancel" type="submit">CANCELAR</button>
            </p>
        </form>
        <p>Esqueceu-se da password? <a href="userRecoverPassword.php"> Recuperar password.</a></p>
    </main>


</body>

</html>