<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
function delete() {
    try 
	{
        $id = $_GET["id"];
		$DB = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'REDACTED', 'REDACTED');
		$query = "DELETE FROM hiking WHERE id = $id";
        
        $prep = $DB->prepare($query);
        $prep->execute();

        $prep->closeCursor();
        $prep = NULL;

        header('Location:./read.php');

	}
	catch(Exception $e)
	{
		// En cas d'erreur, on affiche un message et on arrête tout
		die('Erreur : '.$e->getMessage());
	}
}

delete();
?>
</body>
</html>