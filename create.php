<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="/Hiking/read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
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
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
	<?php
		try 
		{
		if (isset($_POST["name"])) {
			$name = $_POST["name"];
			$difficulty = $_POST["difficulty"];
			$distance = $_POST["distance"];
			$duration = $_POST["duration"];
			$height_difference = $_POST["height_difference"];

			$DB = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'REDACTED', 'REDACTED');
			$query = 'INSERT INTO hiking (name, difficulty, distance, duration, height_difference) VALUES (?, ?, ?, ?, ?);';
			$prep = $DB->prepare($query);

			$prep->bindValue(1, $name, PDO::PARAM_STR);
			$prep->bindValue(2, $difficulty, PDO::PARAM_STR);
			$prep->bindValue(3, $distance, PDO::PARAM_INT);
			$prep->bindValue(4, $duration, PDO::PARAM_STR);
			$prep->bindValue(5, $height_difference, PDO::PARAM_INT);

			$prep->execute();

			$prep->closeCursor();
			$prep = NULL;

			echo 'La randonnée a était ajouté';
		}

		}
		catch(Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
			die('Erreur : '.$e->getMessage());
		}
	?>
</body>
</html>
