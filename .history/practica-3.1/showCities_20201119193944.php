<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table,
        td {
            border: 1px solid black;
            border-spacing: 0px;
        }

        .links {
            display: flex;
            justify-content: center;
        }

        .links h1 {
            margin: 0 20px;
            text-align: center;
        }

        .alert {
            position: absolute;
            bottom: 0;
            left: 10px;
            right: 10px;
            text-align: center;
            font-weight: bold;
        }

        table {
            width: 25%;
            margin: 20px auto auto auto;
            place-content: center;
            text-align: center;
        }

        input,
        select {
            margin: 10px;
        }
    </style>
    <?php
    require("./functions.php");
    $conn = connection("carlos", $_SERVER['MYSQL_CARLOS_PASS'], "world");
    $res = createQuery($conn,     "SELECT city.Name as 'CityName', country.Name as 'CountryName', country.Code as 'Code' FROM city, country WHERE CountryCode LIKE '$_POST[countryCode]' AND city.CountryCode = country.Code;");
    ?>
</head>

<body>
    <div class="links">
        <h1><a href="./">Escollir pais</a></h1>
        <h1><a href="./addCity.php">Afegir ciutats</a></h1>
    </div>
    <table>
        <thead>
            <td colspan="4" align="center" bgcolor="cyan">Llistat de ciutats</td>
        </thead>
        <?php
        while ($row = mysqli_fetch_assoc($res)) {
            echo "\t<tr>\n";
            echo "\t\t<td>" . $row['CityName'] . "</td>\n";
            echo "\t\t<td>" . $row['CountryName'] . "</td>\n";
            echo "\t\t<td><img src='./flags/" . strtolower(changeCountryCode($row['Code'])) . ".png'</td>\n";
            echo "\t</tr>\n";
        }
        ?>
    </table>
</body>

</html>