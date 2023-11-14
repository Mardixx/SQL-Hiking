<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
</body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	$id = $_GET['id'];

	try 
	{
		$DB = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'REDACTED', 'REDACTED');
		$query = "SELECT * FROM hiking WHERE id = $id;";
		$fetch = $DB->query($query)->fetchAll(PDO::FETCH_ASSOC);

		$distance = $fetch[0]["distance"];
		$duration = $fetch[0]["duration"];
		$name = $fetch[0]["name"];
		$height_difference = $fetch[0]["height_difference"];
		$name = str_replace(' ', '', $name);


		echo <<<EOD
		<a href="/Hiking/read.php">Liste des données</a>
		<h1>Ajouter</h1>
		<form action="" method="post">
			<div>
				<label for="name">Name</label>
				<input type="text" name="name" value=$name>
			</div>

			<div>
				<label for="difficulty">Difficulté</label>
				<select name="difficulty">
					<option value="très facile">Très facile</option>
					<option value="facile">Facile</option>
					<option value="moyen">Moyen</option>
					<option value="difficile">Difficile</option>
					<option value="très difficile">Très difficile</option>
				</select>
			</div>
			
			<div>
				<label for="distance">Distance</label>
				<input type="text" name="distance" value=$distance>
			</div>
			<div>
				<label for="duration">Durée</label>
				<input type="duration" name="duration" value=$duration>
			</div>
			<div>
				<label for="height_difference">Dénivelé</label>
				<input type="text" name="height_difference" value=$height_difference>
			</div>
			<button type="submit" name="button">Envoyer</button>
		</form>
		EOD;
		if (isset($_POST["name"])) {
			$name = $_POST["name"];
			$difficulty = $_POST["difficulty"];
			$distance = $_POST["distance"];
			$duration = $_POST["duration"];
			$height_difference = $_POST["height_difference"];

			$query = "UPDATE hiking
						SET name = ?, difficulty = ?, distance = ?, duration = ?, height_difference = ?
						WHERE id = $id;";
			$prep = $DB->prepare($query);

			$prep->bindValue(1, $name, PDO::PARAM_STR);
			$prep->bindValue(2, $difficulty, PDO::PARAM_STR);
			$prep->bindValue(3, $distance, PDO::PARAM_INT);
			$prep->bindValue(4, $duration, PDO::PARAM_STR);
			$prep->bindValue(5, $height_difference, PDO::PARAM_INT);

			$prep->execute();

			$prep->closeCursor();
			$prep = NULL;

			echo 'La randonnée a était modifié';
		}
	}
	catch(Exception $e)
	{
		// En cas d'erreur, on affiche un message et on arrête tout
		die('Erreur : '.$e->getMessage());
	}
?>
</html>
