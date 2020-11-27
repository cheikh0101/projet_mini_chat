<!DOCTYPE html>
<html>
<head>

</head>
<body>

	<div class="container">

		<h3 class="text-center"><i>Lou CANA di nirool</i></h3>
		
		<div class="row">


			<div class="col">
			
				<form action="" method="POST">
				 	
				 	<div class="form-group">
				    <label for="pwd">Pseudo:</label>
				    <input type="text" class="form-control" placeholder="Votre pseudonyme" id="" name="pseudo"></input>
				  </div>

				   <div class="form-group">
				    <label for="pwd">Commentaire:</label>
				    <textarea type="" class="form-control" placeholder="petit commentaire" id="pwd" name="commentaire"></textarea>
				  </div>

				  <button type="submit" class="btn btn-primary btn-block">ENVOYÉ</button>

				</form>

			</div>


		</div>

	</div>


	<?php

		$pseudo = $commentaire = "";

		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}

		catch(Exception $e)
		{
    	    die('Erreur : '.$e->getMessage());
		}

		if(!empty($_POST['pseudo']) && !empty($_POST['commentaire']))
		{

			$req = $bdd->prepare('INSERT INTO chat (pseudo, commentaire) VALUES(?, ?)');

			$req->execute(array($_POST['pseudo'], $_POST['commentaire']));

		}
		else
		{
			
			$error = "Les 2 champs sont obligatoires";

			?>

			<div class="alert alert-danger">
				<h5 class="text-center"> <?php echo $error; ?></h5>
			</div>

		<?php			
		}

		
		$reponse = $bdd->query('SELECT pseudo, commentaire FROM chat ORDER BY ID DESC LIMIT 0, 20');

		$i = 1;
		while ($donnees = $reponse->fetch())
		{

			?>

			<div class="container">
			
				<div class="row">

					<div class="col pb-3">

						<div class="card">

							<div class="card-header">

									<?php 

										echo ' '. $i .' ';
							 
										echo  '<i>' .htmlspecialchars($donnees['pseudo']). '</i> ';

									?>
									
							</div>

							<div class="card-body">

								<div class="card-text">

									<?php 
										
										echo '<p>';

											echo '' .htmlspecialchars($donnees['commentaire']). '' ;
										echo '</p>';

										$i++;

									?>
									
								</div>
								
							</div>

							<div class="card-footer text-right">
								<?php echo date("Y/m/d"); ?>
							</div>
							
						</div>
						
					</div>
					
				</div>

			</div>

			<?php
		}

		$reponse->closeCursor();

	?>



</body>
</html>