<!DOCTYPE html>
<html>
 <head>
 	<meta charset="utf-8">	
 	<title>Exemple de lectura de dades a MySQL</title>
 	<style>
 		body{
 		}
 		table,td {
 			border: 1px solid black;
 			border-spacing: 0px;
 		}
 	</style>
 </head>
 <body>
 	<h1>Exemple de lectura de dades a MySQL</h1>
 	<!-- (3.1) aquí va la taula HTML que omplirem amb dades de la BBDD -->
 	<table>
 	<!-- la capçalera de la taula l'hem de fer nosaltres -->
 	<thead><td colspan="4" align="center" bgcolor="cyan">Llistat de ciutats</td></thead>
  	<!-- (3.6) tanquem la taula -->
 		<?php
		  //connexió dins block try-catch:
		  //  prova d'executar el contingut del try
		  //  si falla executa el catch
		  try {
		    $hostname = "localhost";
		    $dbname = "world";
		    $username = "root";
		    $pw = "Contrasenya9";
		    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
		  } catch (PDOException $e) {
		    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
		    exit;
		  }

		  //preparem i executem la consulta
		  $query = $pdo->prepare("select Name, Population FROM country WHERE Continent = '".$_POST['Continent']."';");
		  $query->execute();

		  //anem agafant les fileres d'amb una amb una
		  $row = $query->fetch();
		  while ( $row ) {
		  	echo "<tr>";
		    echo "<td>".$row["Name"]."</td>";
		     echo "<td>".$row["Population"]."</td>";
		    $row = $query->fetch();
		    echo "</tr>";
		  }
		  //eliminem els objectes per alliberar memòria 
		 
		?>

	</table>

	<?php

		$query = $pdo->prepare("select sum(Population) as total FROM country WHERE Continent = '".$_POST['Continent']."';");
		  $query->execute();

		  //anem agafant les fileres d'amb una amb una
		  $row = $query->fetch();
		  
		    echo "<h5>Total: ".$row["total"]."</h5>";
		    $row = $query->fetch();

		     unset($pdo); 
		  	unset($query)

	?>	
 </body>
</html>