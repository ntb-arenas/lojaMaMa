<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "psi_basededados";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_REQUEST['id'];
$user =  $_REQUEST['user'];
$email = $_REQUEST['email'];

$sql = "INSERT INTO usertable  VALUES ('$id', '$user', '$email')";

if (mysqli_query($conn, $sql)) {
    echo "<h3>data stored in a database successfully. </h3>";

    $sql = "SELECT id, user, email FROM usertable";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<br> id: " . $row["id"] . "User: " . $row["user"] . "Email" . $row["email"] . "<br>";
        }
    } else {
        echo "0 results";
    }
} else {
    echo "ERROR:  $sql. "
        . mysqli_error($conn);
}

mysqli_close($conn);
