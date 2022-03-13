<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<meta name="author" content="Josselin Fatah-Roux" />
		<meta name="keywords" content="partage,entraide,découverte,actualités,sciences,informatique,horreur,humour" />
		<meta name="description" content="Chaque fois que l’un d’eux serait détaché, et serait contraint de se lever immédiatement, de retourner la tête, de marcher, et de regarder la lumière, à chacun de ces gestes il souffrirait, et l’éblouissement le rendrait incapable de distinguer les choses dont tout à l’heure il voyait les ombres. [La République (trad. Chambry)/Livre VII]" />
		<title>Ovnie - Gestion des articles | Projet 7.20.12.0.13</title>
	</head>
	
	<body>
		<?php 
		if(isset($_GET['reussite']))
		{
			if($_GET['reussite']==1)
			{
				echo '<p>Article publié</p>';
			}
			else
			{
				echo '<p>Erreur, veuillez réessayer !</p>';
			}
		}
		?>
		<h1>Ajouter un article :</h1>
		<form method="post" action="./generate.php">
			<fieldset>
				<legend>Informations</legend>
					<label for="titre">Quel est le titre ?</label>
					<br/><input type="text" name="titre" id="titre" required />
			</fieldset>
			<fieldset>
				<legend>Actualités</legend>
					<label for="message">Message</label>
					<br/><textarea name="message" id="message" rows="10" cols="50"></textarea> 
			</fieldset>
			<p><input type="submit" value="Envoyer" name='ajouterarticle' /></p>
		</form>
		
		<h1>Modifier un article :</h1>
		<form method="post" action="./modificate.php">
			<label for="ticket">Quel est le numéro de ticket ?</label>
			<br/><input type="text" name="ticket" id="ticket" />
			<p><input type="submit" value="Envoyer" name='lancermodification' /></p>
		</form>
	</body>
	
</html>