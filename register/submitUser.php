<?php

if (isset($_POST['submit'])) {

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

    $res = mysqli_query($conn, "INSERT INTO `Users` VALUES (null, '$userLogin', md5('$passLogin'));");

    if (!$res) {
        $message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
        $message .= 'Consulta realitzada: ' . $insert;
        header("location:./index.php?status=error");
    }

    $conn->close();


    /*** PDO ***/
    /*try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    $conn->exec("INSERT INTO `Users` VALUES (null, '$userLogin', md5('$passLogin'));");
    $conn = null;*/

    header("location:./index.php?status=success");
} else header("location:./index.php");
