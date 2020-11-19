<?php
require("./functions.php");
$conn = connection("carlos", $_SERVER['MYSQL_CARLOS_PASS'], "world");
$insert = "INSERT INTO city VALUES (null, '$_POST[nameCity]', '$_POST[countryCode]', '$_POST[district]', $_POST[population]);";
$res = mysqli_query($conn, $insert);

if (!$res) {
    $message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
    $message .= 'Consulta realitzada: ' . $insert;
    header("location:./addCity.php?status=error");
}

header("location:./addCity.php?status=success");