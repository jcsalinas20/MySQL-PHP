<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    try {
        $database = "logros";
        $user = 'carlos';
        $pass = 'Aa123456.';
        $db = new PDO("mysql:host=localhost;dbname=$database", $user, $pass);
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage();
        die();
    }
    $msg = "";
    if (isset($_POST['mail'])) {
        $mail = $_POST['mail'];
        $user = $_POST['user'];

        $query = $db->prepare("SELECT * FROM register WHERE `email` LIKE '$mail';");
        $query->execute();
        $first_row = $query->fetch();
        if ($first_row) {
            $msg = "<p>Este correo ya está registrado.</p>";
        } else {
            $msg = "<p>Correo registrado correctamente.</p>";
            $query = $db->prepare("INSERT INTO register(email, user) VALUES ('$mail', '$user');");
            $query->execute();
        }
    }
    ?>
</head>

<body>
    <?= $msg ?>
    <form method="post">
        <input type="text" name="user" placeholder="user">
        <input type="email" name="mail" placeholder="mail">
        <input type="submit" value="Submit">
    </form>
</body>

</html>