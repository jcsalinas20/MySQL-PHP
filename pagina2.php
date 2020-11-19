<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {}

        table,
        td {
            border: 1px solid black;
            border-spacing: 0px;
        }
    </style>
    <?php
    $conn = mysqli_connect('localhost', 'carlos', 'Aa123456.');
    mysqli_select_db($conn, 'world');
    ?>
</head>

<body>
    <?php
    $consulta = "SELECT * FROM city  WHERE CountryCode LIKE '$_POST[countryCode]';";
    $resultat = mysqli_query($conn, $consulta);

    if (!$resultat) {
        $message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
        $message .= 'Consulta realitzada: ' . $consulta;
        die($message);
    } ?>
    <table>
        <thead>
            <td colspan="4" align="center" bgcolor="cyan">Llistat de ciutats</td>
        </thead>
        <?php
        while ($registre = mysqli_fetch_assoc($resultat)) {
            echo "\t<tr>\n";
            echo "\t\t<td>" . $registre["Name"] . "</td>\n";
            echo "\t\t<td>" . $registre['CountryCode'] . "</td>\n";
            echo "\t\t<td>" . $registre["District"] . "</td>\n";
            echo "\t\t<td>" . $registre['Population'] . "</td>\n";
            echo "\t</tr>\n";
        }
        ?>
    </table>
</body>

</html>