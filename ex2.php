<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body>
<form action="consulta2.php" method="post">
Continent: <select name="Continent">
	
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
		  $query = $pdo->prepare("select distinct Continent FROM country");
		  $query->execute();

		  //anem agafant les fileres d'amb una amb una
		  $row = $query->fetch();
		  while ( $row ) {
		    echo "<option>".$row['Continent']."</option>";
		    $row = $query->fetch();
		  }

		  //eliminem els objectes per alliberar memòria 
		  unset($pdo); 
		  unset($query)

		?>
	  </select>
	  <input type="submit" name="submit"/>
</form>
</body>
</html>


