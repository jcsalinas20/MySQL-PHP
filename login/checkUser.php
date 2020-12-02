<?php

if (isset($_POST['login'])) {
    $host = "localhost";
    $db = "users";
    $user = "carlos";
    $pass = $_SERVER['MYSQL_CARLOS_PASS'];
    $conn = "";

    /*** MySQLi ***/
    $conn = mysqli_connect($host, $user, $pass);
    mysqli_select_db($conn, $db);

    $userLogin = mysqli_real_escape_string($conn, $_POST['user']);
    $passLogin = mysqli_real_escape_string($conn, $_POST['pass']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $res = mysqli_query($conn, "SELECT * FROM `Users` WHERE `username`='$userLogin' AND `password`=md5('$passLogin');");
    $conn->close();

    if (!$res) {
        $message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
        $message .= 'Consulta realitzada: ' . $insert;
        header("location:./index.php?status=error");
    } else {
        if ($res->num_rows > 0) header("location:./index.php?status=success");
        else header("location:./index.php?status=error");
    }
} else header("location:./index.php");
