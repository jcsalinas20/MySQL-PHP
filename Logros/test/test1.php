<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    $list = "";
    try {
        $database = "logros";
        $user = 'carlos';
        $pass = 'Aa123456.';
        $db = new PDO("mysql:host=localhost;dbname=$database", $user, $pass);
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage();
        die();
    }
    if (isset($_GET['value'])) {
        $value = $_GET['value'];
        $query = $db->prepare("SELECT `value` FROM list WHERE `value` LIKE '%$value%';");
        $query->execute();
        foreach ($query as $row) {
            $list .= "<option>$row[0]</option>\n";
        }
    }
    ?>
</head>

<body>
    <form method="get">
        <input type="text" name="value">
        <input type="button" value="Submit">
    </form>
    <select>
        <?= $list ?>
    </select>
</body>

</html>