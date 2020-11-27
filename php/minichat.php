<!DOCTYPE html>
<html>
<head>
	<title>minichat</title>
	
	
		
</head>
<body>


	
	<div class="row">

		<div class="col-2"></div>

		<div class="col-8">
			<form action="post.php" method="POST">

				<div class="form-group">
			    	<label for="pwd">Pseudo:</label>
			    	<input type="text" class="form-control" placeholder="pseudo" id="pwd" name="prenom">
		    	</div>	

		    	<div class="form-group">
			    	<label for="pwd">nom:</label>
			    	<input type="text" class="form-control" placeholder="nom" id="pwd" name="nom">
			    </div>

			    <div class="form-group">
			    	<label for="pwd">Commentaire:</label>
			    	<input type="text" class="form-control" placeholder="un mot sur l'UT" id="pwd" name="commentaire">
			    </div>		

				<div class="form-group">
			    	
			    	<input type="submit" class="btn btn-outline-danger btn-block" value="YONEL!!" >
			    </div>				    

			</form>
		</div>

		<div class="col-2"></div>

	</div>
	

	<?php
		// Connexion à la base de données
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=tp-minichat;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		/*

			*-*$bdd représente un objet mais pas vraiment une variable

			*-*L'extension PDO : c'est un outil complet qui permet d'accéder à n'importe quel type de base de données. 
			On peut donc l'utiliser pour se connecter aussi bien à MySQL que PostgreSQL ou Oracle.
			PDO est ce qu'on appelle une extension orientée objet.

			*-*localhost symbolise le nom de l'ordinateur ou mysql est installé pour notre cas on travail en local d'ou le 
				nom de localhost
			
			*-*test represente le nom de la base de donnée

			*-*root représente le login dans mon cas c'est root

			*-* l'autre case libre devrait représenter le mot de passe dans mon cas il est vide
		*/
//--------------------------------*---------------------------*-----------------------------*-------------------------------

		catch(Exception $e)
		{
		        die('Erreur : '.$e->getMessage());
		}
		/*
			il faut savoir que PHP essaie d'exécuter les instructions à l'intérieur du bloctry. 
			S'il y a une erreur, il rentre dans le bloc catch et fait ce qu'on lui demande 
			(ici, on arrête l'exécution de la page en affichant un message décrivant l'erreur).
			Si au contraire tout se passe bien, PHP poursuit l'exécution du code et ne lit pas ce 
			qu'il y a dans le bloc catch.
		*/

//--------------------------------*---------------------------*-----------------------------*-------------------------------
		// Récupération des 10 derniers messages
		$reponse = $bdd->query('SELECT prenom, nom, message FROM mini ORDER BY ID DESC LIMIT 0, 10');

		// LIMIT nous permet de ne sélectionner qu'une partie des résultats

		 /* 
		 	*-*les mots soulignes en rouge sont du langage sql plus precisemment de mysql

		 		-SELECT demande à MySQL d'afficher ce que contient une table.
				-Si vous voulez prendre tous les champs, tapez * mais puisque c'est uniquement pseudo et message qui nous 
				 intéresse on préfere les ecrires en entier .

				-FROM : c'est un mot de liaison qui se traduit par « dans ».FROM fait la liaison entre le nom des champs et
				 le nom de la table.

				-Dans ce cas minichat représente le nom de la table


			*-*query en anglais signifie « requête ».

			*-*On récupère ce que la base de données nous a renvoyé dans un autre objet que l'on a appelé ici $reponse.



		*/

//--------------------------------*---------------------------*-----------------------------*-------------------------------

		// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
		$i = 1;
		while ($donnees = $reponse->fetch())
		{
			

			/*echo '<p><strong>' . htmlspecialchars($donnees['prenom']) . '</strong> : ' . htmlspecialchars($donnees['message']) . . htmlspecialchars($donnees['nom']) . '</p>';*/

			echo '<p>';

				echo ' '. $i .' ';
 
				echo  '<i>' .htmlspecialchars($donnees['prenom']). '</i> &nbsp;';

				echo '<i>' .htmlspecialchars($donnees['nom']). '</i>: &nbsp;';

				echo '<u>' .htmlspecialchars($donnees['message']). '</u>' ;
			echo '</p>';

			$i++;
		}

		$reponse->closeCursor();

		/*
		 termine le traitement de la requete cad Elle provoque la « fermeture du curseur d'analyse des résultats ».
		  Cela signifie, en d'autres termes plus humains, que vous devez effectuer cet appel à closeCursor()chaque fois 
		  	que vous avez fini de traiter le retour d'une requête, afin d'éviter d'avoir des problèmes à la requête suivante.
		  Cela veut dire qu'on a terminé le travail sur la requête.
		*/


		/*
			*-* Pour récupérer une entrée, on prend la réponse de MySQL et on y exécute fetch(), ce qui nous renvoie la
		 		première ligne.

		 	*-* $donnees est un array qui contient champ par champ les valeurs de la première entrée.
		 		Par exemple, si vous vous intéressez au champ message, vous utiliserez l'array $donnees['message'].
		 		Chaque fois qu'on fait une boucle,fetch va chercher dans $reponse l'entrée suivante et organise les champs
		 		dans l'array 	$donnees.
		*/

//----------------------------------------*--------------------*-------------------------------*----------------------
	?>





	<?php
		include "../footer.html";
	?>

</body>
</html>