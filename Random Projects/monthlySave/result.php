<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="solid">
        <tr>
            <th>Month</th>
            <th>Money</th>
        </tr>
        <tr>
            <?php
            for ($i = 1; $i <= $_POST["months"]; $i++) {
                echo "<tr> <td align=center>" . $i . "<td align=center>" . $i * $_POST["moneyToSave"];
            }
            ?>
        </tr>
    </table>
    <br>
    <?php
    $result = $_POST["moneyToSave"] * $_POST["months"];
    echo "Money you will save in " . $_POST["months"] . " months: " . $result . "€";
    ?>
</body>

</html>