<?php

session_start();

// estabelecer conexão à base de dados

include_once  './conexaobasedados.php';


$mensagemErroCodigo = "";
$mensagemErroSenha = "";
$codigo = "";
$senha = "";


if (isset($_POST['botao-cancelar-entrada'])) {
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
    header("Location: index.php");
}



if (isset($_POST['botao-iniciar-sessao'])) {

    $codigo = strtolower(trim(mysqli_real_escape_string($_conn, $_POST["formCodigo"])));
    $codigo = trim($codigo);

    $senha = trim(mysqli_real_escape_string($_conn, $_POST["formSenha"]));
    $senha = trim($senha);

    $codigo = strip_tags($codigo);


    $stmt = $_conn->prepare('SELECT * FROM USERS WHERE CODIGO = ?');
    $stmt->bind_param('s', $codigo);
    $stmt->execute();

    $resultadoUsers = $stmt->get_result();

    if ($resultadoUsers->num_rows > 0) {
        while ($rowUsers = $resultadoUsers->fetch_assoc()) {

            if ($rowUsers['USER_STATUS'] == 2) { // utilizador bloqueado

                $mensagemErroSenha = "Não é possível entrar no sistema. Contacte os nossos serviços para obter ajuda.";
            } else  if ($rowUsers['USER_STATUS'] == 0) { // Utilizador criou a conta mas não ativou

                $mensagemErroSenha =  $rowUsers['NOME'] . ", ainda não ativou a sua conta. A mensagem com o código inicial de ativação de conta foi enviada para a sua caixa de correio. Caso não a encontre na sua caixa de entrada, verifique também o seu correio não solicitado ou envie-nos um email para ativarmos a sua conta. Obrigado.";
            } else  if (password_verify($senha, $rowUsers["PASSWORD"])) {


                $_SESSION["UTILIZADOR"] = $rowUsers["CODIGO"];
                $_SESSION["NIVEL_UTILIZADOR"] = $rowUsers["NIVEL"];
                $_SESSION["NOME_UTILIZADOR"] = $rowUsers["NOME"];
                $_SESSION["EMAIL_UTILIZADOR"] = $rowUsers["EMAIL"];


                header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
                header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
                header("Location: index.php");
            } else {
                $mensagemErroSenha = "Senha incorreta!";


                // encaminhar para página principal
                header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
                header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately

                header("Refresh: 3; URL=index.php"); // encaminhar 5 segundos depois



            }
        }
    } else {
        $mensagemErroCodigo = "O código de utilizador não existe na nossa base de dados!";
    }

    $stmt->free_result();
    $stmt->close();
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Sistema X</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <div class="main">
        <p class="sign" align="center">Sign in</p>
        <form class="form1" action="#" method="POST">
            <input class="un " type="text" align="center" name="formCodigo" placeholder="Código de Utilizador" value="<?php echo $codigo; ?>" required>
            <?php echo $mensagemErroCodigo; ?>
            <input class="pass" type="password" align="center" name="formSenha" placeholder="Senha" value="<?php echo $codigo; ?>" required>
            <?php echo $mensagemErroSenha; ?>
            <div class="div-submit">
            <button name="botao-iniciar-sessao" type="submit" class="submit"> Iniciar Sessão</button>
        </form>

        <form action="#" method="POST">.
        <button name="botao-cancelar-entrada" type="submit" class="submit"> Cancelar</button></div>
        </form>
</body>

</html>