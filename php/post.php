<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=tp-minichat;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
	/*
		*-* on ajoute le array pour que la signalisation des erreurs soit beaucoup plus clair
	*/

//--------------------------------*---------------------------*-----------------------------*-------------------------------

catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

//--------------------------------*---------------------------*-----------------------------*-------------------------------

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO mini (prenom, nom, message) VALUES(?, ?, ?)');

$req->execute(array($_POST['prenom'], $_POST['nom'], $_POST['commentaire']));

//--------------------------------*---------------------------*-----------------------------*-------------------------------

// Redirection du visiteur vers la page du minichat
header('Location: minichat.php');

?>