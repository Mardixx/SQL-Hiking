<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <table>
      <!-- Afficher la liste des randonnées -->
      <?php
      /* require "./delete.php"; */
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
        try 
        {
          $DB = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'REDACTED', 'REDACTED');
          $query = 'SELECT * FROM hiking;';
          $fetch = $DB->query($query)->fetchAll(PDO::FETCH_ASSOC);
          
          foreach($fetch as $infos) {
            $id = $infos['id'];
            $name = $infos['name'];
            $difficulty = $infos['difficulty'];
            $distance = $infos['distance'];
            $duration = $infos['duration'];
            $height_difference = $infos['height_difference'];
            
            echo <<<EOD
                <tr>
                    <th>
                        $name
                        <a href="update.php?id=$id">Modify</a>
                        <button onclick='window.location.href="./delete.php?id=$id"'>Delete</button>
                    </th>
                    <td>
                        $difficulty
                    </td>
                    <td>
                        $distance km
                    </td>
                    <td>
                        $duration h
                    </td>
                    <td>
                        $height_difference m
                    </td>
                </tr>
            EOD;
          }
        }
        catch(Exception $e)
        {
            // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
        }
      ?>
    </table>
  </body>
</html>
