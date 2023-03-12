<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<meta name="author" content="Josselin Fatah-Roux" />
		<meta name="keywords" content="partage,entraide,découverte,actualités,sciences,informatique,horreur,humour" />
		<meta name="description" content="Chaque fois que l’un d’eux serait détaché, et serait contraint de se lever immédiatement, de retourner la tête, de marcher, et de regarder la lumière, à chacun de ces gestes il souffrirait, et l’éblouissement le rendrait incapable de distinguer les choses dont tout à l’heure il voyait les ombres. [La République (trad. Chambry)/Livre VII]" />
		<title>Ovnie - Gestion de l'agencement | Projet 7.20.12.0.13</title>
	</head>
	
	<body>
		<?php require("./base.php"); ?>
	
		<?php 
		if(isset($_GET['reussite']))
		{
			if($_GET['reussite']==1)
			{
				echo '<p>Validation de l\'ajout</p>';
			}
			else
			{
				echo '<p>Erreur, veuillez réessayer !</p>';
			}
		}
		?>
		
		<h1><strong>Les catégories existantes :</strong></h1>
		<ul>
			<?php
			//On récupère les catégories :
			$req_pcategories = $bdd->query('SELECT * FROM categories ORDER BY id ASC');
			
			while ($recup_pcategories = $req_pcategories->fetch())
			{
			?>
				<li><?php echo htmlspecialchars($recup_pcategories['id']); ?> : <?php echo htmlspecialchars($recup_pcategories['titre']); ?></li>
			<?php
			} //Fin de la boucle des catégories :
			$req_pcategories->closeCursor();
			?>
		</ul>
		
		<h1><strong>Les sous-catégories existantes :</strong></h1>
		<ul>
			<?php
			//On récupère les sous-catégories :
			$req_rscategories =  $bdd->query('SELECT * FROM souscategories ORDER BY id ASC');
			
			while ($recup_rscategories = $req_rscategories->fetch())
			{
			?>
				<li><?php echo htmlspecialchars($recup_rscategories['id']); ?> : <?php echo htmlspecialchars($recup_rscategories['titre']); ?></li>
			<?php
			} //Fin de la boucle des sous-catégories :
			$req_rscategories->closeCursor();
			?>
		</ul>
		
		<h1>Ajouter une catégorie :</h1>
		<form method="post" action="./parent.php">
			<label for="categorie">Quel est le titre ?</label>
			<br/><input type="text" name="categorie" id="categorie" />
			<p><input type="submit" value="Envoyer" name='ajoutercategorie' /></p>
		</form>
		
		<h1>Ajouter une sous-catégorie :</h1>
		<form method="post" action="./create.php">
			<fieldset>
				<legend>Informations</legend>
					<label for="scategorie">Quel est le titre ?</label>
					<br/><input type="text" name="scategorie" id="scategorie" required />
			</fieldset>
			<fieldset>
				<legend>Catégories</legend>
					<label for="pcategorie">Quel est sa catégorie (numéro uniquement) ?</label>
					<br/><input type="text" name="pcategorie" id="pcategorie" required />
			</fieldset>
			<p><input type="submit" value="Envoyer" name='ajouterscategorie' /></p>
		</form>
		
		<h1>Ajouter une rédaction :</h1>
		<form method="post" action="./redaction.php">
			<fieldset>
				<legend>Informations</legend>
					<label for="rtitre">Quel est le titre ?</label>
					<br/><input type="text" name="rtitre" id="rtitre" required />
					<br/><label for="rscategorie">Quel est sa sous-catégorie (numéro uniquement) ?</label>
					<br/><input type="text" name="rscategorie" id="rscategorie" required />
			</fieldset>
			<fieldset>
				<legend>Rédaction</legend>
					<label for="rmessage">Message</label>
					<br/><textarea name="rmessage" id="rmessage" rows="10" cols="50"></textarea>
			</fieldset>
			<p><input type="submit" value="Envoyer" name='ajouterredaction' /></p>
		</form>
	</body>
	
</html>