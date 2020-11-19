<html>

<head>
	<title>Exemple de lectura de dades a MySQL</title>
	<style>
		table,
		td {
			border: 1px solid black;
			border-spacing: 0px;
		}
	</style>
</head>

<body>
	<h1>Exemple de lectura de dades a MySQL</h1>

	<?php
	$conn = mysqli_connect('localhost', 'carlos', 'Aa123456.');
	mysqli_select_db($conn, 'world');
	$consulta = "SELECT DISTINCT Code, `Name` FROM country;";
	$resultat = mysqli_query($conn, $consulta);

	if (!$resultat) {
		$message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
		$message .= 'Consulta realitzada: ' . $consulta;
		die($message);
	}
	?>

	<form action="pagina2.php" method="post">
		<select name="countryCode">
			<?php while ($registre = mysqli_fetch_assoc($resultat)) : ?>
				<option value="<?= $registre['Code'] ?>"><?= $registre["Name"] ?></option>
			<?php endwhile; ?>
			<input type="submit" value="Enviar">
		</select>
	</form>
</body>

</html>