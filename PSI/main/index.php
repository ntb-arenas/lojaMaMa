<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema X</title>
        <meta name="description" content="Some ideas for modern button styles and effects" />
        <meta name="keywords" content="button, effect, hover, style, inspiration, web design" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="css/vicons-font.css" />
        <link rel="stylesheet" type="text/css" href="css/base.css" />
        <link rel="stylesheet" type="text/css" href="css/buttons.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
        <div class="container">
                <section class="content">
                        <h2>Sistema X</h2>

                        <!-- Utilizador em sessão -->
                        <?php if (isset($_SESSION["UTILIZADOR"])) { ?>

                                Utilizador <b><?php echo $_SESSION["UTILIZADOR"]; ?></b> em sessão.&nbsp;

                                [<A href="userSair.php">Sair</A>]<br><br>
                                <A href="userEditarConta.php">Editar conta de <?php echo $_SESSION["NOME_UTILIZADOR"]; ?></A><br><BR>

                        <?php } else { ?>

                                <div class="box bg-2">
                                        <a href="userEntrar.php">
                                                <button class="button button--winona button--border-thick button--round-l button--text-upper button--size-s button--text-thick" data-text="ENTRAR">
                                                        <span>Entrar</span></button></a>
                                        <A href="userCriarConta.php"><button class="button button--winona button--border-thick button--round-l button--text-upper button--size-s button--text-thick" data-text="CRIAR CONTA">
                                                        <span>Criar conta</span></button></A>
                                        <A href="userRecuperarSenha.php"><button class="button button--winona button--border-thick button--round-l button--text-upper button--size-s button--text-thick" data-text="RECUPERAR SENHA">
                                                        <span>Recuperar senha</span></button></A>
                                </div>
                </section>
        </div>
<?php } ?>

<!-- Interface para administrador -->
<?php if (isset($_SESSION["NIVEL_UTILIZADOR"]) == 2) { ?>
        <A href="userGerirUtilizadores.php">Gerir utilizadores</A><br>
<?php } ?>

<div class="div-article">
        <div class="container1">
                <h1 style="margin-top: 0px; margin-bottom: 0px;">Portugal reimposes rules as COVID-19 cases rise</h1>
                <p>By Catarina Demony and Patricia Vicente rua</p><br>
                <div class="article">
                        <img src="gallery/pplmask.jpg" alt="Avatar" class="image">
                        <p>People wearing protective masks due to coronavirus disease (COVID-19) pandemic walk in
                                central
                                Lisbon, Portugal, November 25,
                                2021. REUTERS/Pedro Nunes</p>
                </div>
                <br>
                <p class="artigo">LISBON, Nov 25 (Reuters) - Portugal, which has one of the world's highest rates of vaccination against COVID-19, announced it would reimpose restrictions to stop a surge in cases, ordering all passengers flying into the country to show a negative test certificate on arrival. <br><br>

                        "It doesn't matter how successful the vaccination was, we must be aware we are entering a phase of greater risk," Prime Minister Antonio Costa told a news conference on Thursday. <br><br>

                        "We have seen significant growth (in cases) in the EU and Portugal is not an island," he added. <br><br>

                        Portugal reported 3,773 new cases on Wednesday, the highest daily figure in four months, before dropping to 3,150 on Thursday. Deaths, however, remain far below levels seen in January, when the country faced its toughest battle against COVID-19. <br><br>

                        Around 87% of Portugal's population of just over 10 million is fully inoculated against the coronavirus and the country's speedy vaccination rollout has been widely praised. That has allowed it to lift most of its pandemic restrictions. <br><br>

                        But, as another wave of the pandemic sweeps across Europe, the government reintroduced some old rules and announced new ones to limit the spread in the run-up to the holiday season. The measures come into force next Wednesday, Dec. 1. <br><br>

                        'SAVE LIVES' <br><br>

                        Speaking about the new travel rule, Costa said airlines would be fined 20,000 euros ($22,416) per passenger if they transport anyone who does not carry proof of a COVID-19 test, including those who are fully vaccinated. <br><br>

                        Passengers can take a PCR or a rapid antigen test, 72 hours or 48 hours respectively before departure. <br><br>

                        Costa also announced that those fully vaccinated must also present proof of a negative coronavirus test to enter nightclubs, bars, large events and care homes, and that the EU digital certificate would be required to stay in hotels, go to the gym, or dine indoors in restaurants. <br><br>

                        Those sitting outdoors will not need to show the digital certificate. <br><br>

                        Remote work, which is now recommended where possible, will be mandatory during the first week of January and students will return to school a week later than usual to control the spread of the virus after the holiday festivities. <br><br>

                        Costa said Portugal must continue to bet on vaccination to control the pandemic. Health authorities hope to give COVID-19 booster shots to a quarter of the country's population by the end of January. <br><br>

                        "Vaccination has allowed us to save lives," the premier said.</p><br>

        </div>
</div>


<?php if (isset($_SESSION["UTILIZADOR"])) { ?>
        <br><br><br>
<?php }  ?>

<script>
        (function() {
                var isSafari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/);
                if (isSafari) {
                        document.getElementById('support-note').style.display = 'block';
                }
        })();
</script>
</body>

</html>