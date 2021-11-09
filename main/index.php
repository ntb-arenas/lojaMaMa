<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>
        <link rel="stylesheet" href="css/style.css">
</head>

<body>
        <div class="container">
                <div class="div-contents">
                        <h2>Sistema X</h2>

                        <!-- Utilizador em sessão -->
                        <?php if (isset($_SESSION["UTILIZADOR"])) { ?>

                                Utilizador <b><?php echo $_SESSION["UTILIZADOR"]; ?></b> em sessão.&nbsp;

                                [<A href="userSair.php">Sair</A>]<br><br>
                                <A href="userEditarConta.php">Editar conta de <?php echo $_SESSION["NOME_UTILIZADOR"]; ?></A><br><BR>

                        <?php } else { ?>
                                <A href="userEntrar.php">Entrar</A><br>
                                <A href="userCriarConta.php">Criar conta</A><br>
                                <A href="userRecuperarSenha.php">Recuperar senha</A><br>

                        <?php } ?>

                        <!-- Interface para administrador -->
                        <?php if (isset($_SESSION["NIVEL_UTILIZADOR"]) == 2) { ?>
                                <A href="userGerirUtilizadores.php">Gerir utilizadores</A><br>
                        <?php } ?>
                </div>
        </div>
        <b>Zona de conteúdos públicos.</b>


        <?php if (isset($_SESSION["UTILIZADOR"])) { ?>
                <br><br><br>
                <b>Zona de conteúdos privados!</b>
        <?php }  ?>
</body>

</html>