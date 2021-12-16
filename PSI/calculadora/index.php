<?php 
    $valor1 = 0;
    $valor2 = 0;
    $resultado = 0;

    $mensagem = "";

    if ( isset($_POST['formValor1'])) {

        $valor1 = $_POST['formValor1'];
        $valor2 = $_POST['formValor2'];
        $resultado = $_POST['formResultado'];
    }

    if ( isset($_POST['botao-somar'])) {
        $resultado = $valor1 + $valor2;
        $mensagem = "Soma efetuada.";
    }
    if ( isset($_POST['botao-subtrair'])) {
        $resultado = $valor1 - $valor2;
        $mensagem = "Subtração efetuada.";
    }
    if ( isset($_POST['botao-multiplicar'])) {
        $resultado = $valor1 * $valor2;
        $mensagem = "Multiplicação efetuada.";
    }
    if ( isset($_POST['botao-dividir'])) {
        if ($valor2 <> 0) {
            $resultado = $valor1 / $valor2;
            $mensagem = "Divisão efetuada";
        } else {
            $mensagem = "0 divisor não pode ser zero!";
        }
    }
    if ( isset($_POST['botao-pi'])) {
        $valor1 = $_POST['valor-pi'];
        $valor2 = 0;
        $resultado = 0;

        $mensagem = "";
    }
    if ( isset($_POST['botao-limpar'])) {
        $valor1 = 0;
        $valor2 = 0;
        $resultado = 0;
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>

<body>

    <form action="#" method="post">
        Primeiro Valor:
        <input type="text" id="formValor1" name="formValor1" value="<?php echo $valor1;?>"><br><br>

        Segundo Valor:
        <input type="text" id="formValor2" name="formValor2" value="<?php echo $valor2;?>"><br><br>

        Resultado:
        <input type="text" id="formResultado" name="formResultado" value="<?php echo $resultado;?>"><br><br>

        <br><b><?php echo $mensagem;?></b><br>

        <input type="submit" value="Somar" id="botao-somar" name="botao-somar">
        <input type="submit" value="Subtrair" id="botao-subtrair" name="botao-subtrair">
        <input type="submit" value="Multiplicar" id="botao-multiplicar" name="botao-multiplicar">
        <input type="submit" value="Dividir" id="botao-Dividir" name="botao-Dividir">
        <input type="submit" value="Pi" id="botao-pi" name="botao-pi">
        <input type="hidden" value="3.14159265" id="valor-pi" name="valor-pi">
        <br><br>
        <input type="submit" value="Limpar" id="botao-limpar" name="botao-limpar"> 
        
    </form>

</body>

</html>