<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      text-align: -webkit-center;
      text-align: -moz-center;
    }

    table {
      background-color: #d3d3d3;
      box-shadow: 0 0 6px black;
      border: 2px solid #000;
    }

    th {
      padding: 5px;
      text-align: center;
      background-color: #212121;
      color: #fff;
    }

    td {
      padding: 2px 5px;
    }

    tr:nth-child(odd) {
      background: #a7a7a7
    }
  </style>
  <?php
  try {
    $hostname = "localhost";
    $dbname = "world";
    $username = "carlos";
    $pass = $_SERVER['MYSQL_CARLOS_PASS'];
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pass");
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }

  if (isset($_POST['continent'])) {
    $queryCountries = $pdo->prepare("SELECT `Name`, `Population` FROM country WHERE Continent LIKE '$_POST[continent]';");
    $queryCountries->execute();
    $countries = $queryCountries->fetch();


    $queryContinentPopulation = $pdo->prepare("SELECT SUM(`Population`) AS `TotalPopulation` FROM country WHERE Continent LIKE '$_POST[continent]';");
    $queryContinentPopulation->execute();
    $totalPopulation = $queryContinentPopulation->fetch();
  }

  $queryContinents = $pdo->prepare("SELECT DISTINCT `Continent` FROM country;");
  $queryContinents->execute();
  $continents = $queryContinents->fetch();
  ?>
</head>

<body>
  <form action="./index.php" method="post">
    <select name="continent">
      <?php
      while ($continents) {
        if ($continents['Continent'] == $_POST['continent']) echo "<option selected value='$continents[Continent]'>$continents[Continent]</option>";
        else echo "<option value='$continents[Continent]'>$continents[Continent]</option>";
        $continents = $queryContinents->fetch();
      }

      unset($queryContinents)
      ?>
    </select>
    <input type="submit" value="Tramet la consulta">
  </form>

  <?php if (isset($_POST['continent'])) : ?>

    <?= "<p style='font-size: xx-large;'><strong>Continent:</strong> $_POST[continent] - <strong>Total població:</strong> $totalPopulation[TotalPopulation]</p>" ?>

    <table>
      <thead>
        <tr>
          <th>Pais</th>
          <th>Població</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($countries) {
          echo "<tr>";
          echo "<td>$countries[Name]</td>";
          echo "<td>$countries[Population]</td>";
          echo "</tr>";
          $countries = $queryCountries->fetch();
        }

        unset($queryCountries);
        ?>
      </tbody>
    </table>
  <?php endif; ?>
</body>

</html>