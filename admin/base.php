<?php
//Connexion à la base de données en PDO :
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=ovnie;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
?>