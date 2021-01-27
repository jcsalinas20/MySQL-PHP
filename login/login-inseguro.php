<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        html,
        body {
            height: -webkit-fill-available;
        }

        body {
            display: flex;
            flex-flow: column wrap;
            margin: auto;
            background-color: #e4e4e4;
        }

        .alert {
            box-shadow: 0 0 5px black;
            position: absolute;
            bottom: 0;
            left: 10px;
            right: 10px;
            text-align: center;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-flow: column;
            width: 15%;
            margin: auto;
            place-content: center;
            box-shadow: 0 0 5px black;
            border: 2px solid;
            padding: 20px;
            background-color: white;
        }

        label {
            margin: 0;
        }

        input {
            margin: 0 10px 10px 10px;
        }

        input[type="submit"] {
            margin-top: 20px;
        }

        .sql {
            position: fixed;
            top: 60px;
            left: 0;
            right: 0;
            text-align: center;
            font-weight: bold;
        }
    </style>
    <?php
    try {
        $hostname = "localhost";
        $dbname = "users";
        $username = "carlos";
        $pass = $_SERVER['MYSQL_CARLOS_PASS'];
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pass");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    /*  INJECCIONES
    INSERT: jcsalinas'; INSERT INTO usuaris VALUES (NULL, 'hola', 'esto es una injeccion', 'pass sin encriptar');--
    */

    $sql = "";
    if (isset($_POST['login'])) {
        $sql = "SELECT * FROM `usuaris` WHERE `username`='$_POST[user]' AND `password`=sha2('$_POST[pass]', 512);";
        $query = $pdo->prepare($sql);
        $query->execute();
        $row = $query->fetch();
    }

    ?>
</head>

<body>
    <p class="sql"><?= $sql ?></p>
    <form action="./login-inseguro.php" method="post" autocomplete="false">
        <label for="user">Username:</label>
        <input type="text" required name="user">
        <label for="pass">Password:</label>
        <input type="password" required name="pass">
        <input type="submit" value="Log in" name="login">
    </form>
    <?php
    if (isset($_POST['login'])) {
        if ($row)
            echo "<div class='alert alert-success'<strong>Sesion iniciada correctamente.</strong></div>";
        else if (!$row)
            echo "<div class='alert alert-danger'><strong>Usuario no encontrado.</strong></div>";
        echo "<script>setTimeout(() => {document.getElementsByClassName('alert')[0].style.display = 'none'}, 4000);</script>";
    }
    ?>
</body>

</html>