<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Exemple de lectura de dades a MySQL</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		table,
		td {
			border: 1px solid black;
			border-spacing: 0px;
		}

		h1 {
			text-align: center;
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
	</style>
	<?php
	require("./functions.php");
	$conn = connection("carlos", $_SERVER['MYSQL_CARLOS_PASS'], "world");
	$res = createQuery($conn, "SELECT DISTINCT Code, `Name` FROM country;");
	?>
</head>

<body>
	<h1><a href="./addCity.php">Afegir ciutat</a></h1>
	<form action="showCities.php" method="post">
		<select name="countryCode">
			<?php while ($row = mysqli_fetch_assoc($res)) : ?>
				<option value="<?= $row['Code'] ?>"><?= $row["Name"] ?></option>
			<?php endwhile; ?>
		</select>
		<input type="submit" value="Enviar">
	</form>
</body>

</html>