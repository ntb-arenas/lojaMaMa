<?php 
    $preco = "";
    $quantidade = "";
    $subTotal = "";
    $iva = 23;
    $total = "";


    if ( isset($_POST['preco'])) {

        $preco = $_POST['formPreco'];
        $quantidade = $_POST['formQuantidade'];
        $subTotal = $_POST['formSubTotal'];
        $total = $_POST['formResultado'];
    }
    if ( isset($_POST['botao-adicionar'])) {
        $subTotal = $_POST['formPreco'] * $_POST['formQuantidade'];
        $valorIva = ($subTotal*$iva)/100;
        $total = $subTotal + $valorIva;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing</title>
</head>
<body>
    <form action="#" method="post">
        Preço:
        <input type="text" id="formPreco" name="formPreco" value="<?php echo $preco;?>"><br><br>

        Quantidade: 
        <input type="text" id="formQuantidade" name="formQuantidade" value="<?php echo $quantidade;?>"><br><br>

        <b> Sub-Total: 
        <?php echo $subTotal;?></b>

        <br><b><?php echo "Iva (" . $iva . "%)";?></b><br>

        <b>Total: 
        <?php echo $total;?></b>

        <br><br>
        <input type="submit" value="Adicionar" name="botao-adicionar" id="botao-adicionar">
    </form>
</body>
</html>