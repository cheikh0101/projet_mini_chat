<!DOCTYPE html>
<html>
<head>
	<title>lire des donnees</title>
	<?php 

		include "../nav-bar.html"; 


		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=tp-minichat;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}

		catch(Exception $e)
		{
    	    die('Erreur : '.$e->getMessage());
		}

	?>

</head>
<body>

	<br><br><br><br><br><br>

	<div class="container">
	  <marquee><h2>RESULTAT DE LA TABLE fdonnees</h2></marquee>
	  <center style="color: white;">
	  	VOUS AVEZ DEVANT VOUS LES INFORMATIONS FOURNIES RECEMMENT
	   </center>            

	   <br>

	   <?php

			$reponse = $bdd->query('SELECT prenom, nom, phonenumber, commentaire FROM fdonnees ');
		?>

	 <table class="table table-white table-hover">
	    <thead>
	      <tr>
	        <th>Firstname</th>
	        <th>Lastname</th>
	        <th>Phone number</th>
	        <th>commentaire</th>
	      </tr>
	    </thead>

		<?php

			while ($donnees = $reponse->fetch())
			{
				echo '<tr>';

					echo '<td><strong>' . htmlspecialchars($donnees['prenom']) . '</td></strong> ';

					echo '<td><strong>' . htmlspecialchars($donnees['nom']) . '</td></strong> ';

					echo '<td><strong>' . htmlspecialchars($donnees['phonenumber']) . '</td></strong> ';

					echo '<td><strong>' . htmlspecialchars($donnees['commentaire']) . '</td></strong> ';

				echo '</tr>';
			}

			$reponse->closeCursor();

		?>
	  </table>
	</div>

	

	<?php require "../footer.html"; ?>
</body>
</html>