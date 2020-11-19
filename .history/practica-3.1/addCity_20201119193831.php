<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .alert {
            position: absolute;
            bottom: 0;
            left: 10px;
            right: 10px;
            text-align: center;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-flow: row;
            width: 100%;
            margin: auto;
            place-content: center;
        }

        input,
        select {
            margin: 10px;
        }

        .links {
            display: flex;
            justify-content: center;
        }

        .links h1 {
            margin: 0 20px;
            text-align: center;
        }
    </style>
    <?php
    require("./functions.php");
    $conn = connection("carlos", $_SERVER['MYSQL_'], "world");
    $res = createQuery($conn, "SELECT DISTINCT Code, `Name` FROM country;");
    ?>
</head>

<body>
    <div class="links">
        <h1><a href="./">Escollir pais</a></h1>
        <h1>Nova ciutat</h1>
    </div>
    <form action="./insertCity.php" method="post">
        <input type="text" name="nameCity" required placeholder="nom ciutat">
        <select name="countryCode">
            <?php while ($row = mysqli_fetch_assoc($res)) : ?>
                <option value="<?= $row['Code'] ?>"><?= $row["Name"] ?></option>
            <?php endwhile; ?>
        </select>
        <input type="text" name="district" required placeholder="districte">
        <input type="number" name="population" required placeholder="nº de població">
        <input type="submit" value="Afegir">
    </form>

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success')
            echo "<div class='alert alert-success'<strong>S'ha insertat correctament</strong></div>";
        else if ($_GET['status'] == 'error')
            echo "<div class='alert alert-danger'><strong>No s'ha introduit correctament</strong></div>";
        echo "<script>setTimeout(() => {document.getElementsByClassName('alert')[0].style.display = 'none'}, 4000);</script>";
    }
    ?>
</body>

</html>