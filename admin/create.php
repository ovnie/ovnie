<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<meta name="author" content="Josselin Fatah-Roux" />
		<meta name="keywords" content="partage,entraide,découverte,actualités,sciences,informatique,horreur,humour" />
		<meta name="description" content="Chaque fois que l’un d’eux serait détaché, et serait contraint de se lever immédiatement, de retourner la tête, de marcher, et de regarder la lumière, à chacun de ces gestes il souffrirait, et l’éblouissement le rendrait incapable de distinguer les choses dont tout à l’heure il voyait les ombres. [La République (trad. Chambry)/Livre VII]" />
		<title>Ovnie - Ajouter une sous-catégorie | Projet 7.20.12.0.13</title>
	</head>
	
	<body>
		<?php require("./base.php"); ?>
	
		<?php
		if(isset($_POST['ajouterscategorie']))
		{
			//Variables à enregistrer :
			$titre_scategorie = htmlspecialchars($_POST['scategorie']);
			$titre_pcategorie = htmlspecialchars($_POST['pcategorie']);
				
			if (isset($titre_scategorie) AND isset($titre_pcategorie) AND !empty($titre_scategorie) AND !empty($titre_pcategorie))
			{
				$nbdecategorie = $bdd->query('SELECT COUNT(*) AS totaldecategories FROM categories'); //On demande le nombre de ligne pour les catégories.
				$row = $nbdecategorie->fetch(PDO::FETCH_ASSOC);
				$totaldecategorie = $row['totaldecategories']; //On récupère le nombre total.
				if($titre_pcategorie >= 1 AND $titre_pcategorie <= $totaldecategorie)
				{
					//Insertion de la sous-catégorie et de son parent à l'aide d'une requête préparée :
					$req = $bdd->prepare('INSERT INTO souscategories(titre, parent) VALUES(:titre, :parent)');
					$req->execute(array(
					'titre' => $titre_scategorie,
					'parent' => $titre_pcategorie,
					));

					$continuer = 1;
					//Redirection du visiteur vers la page formulaire :
					header('Location: ./layout.php?reussite='.$continuer);
				}
				else
				{
					$continuer = 2;
					//Redirection du visiteur vers la page formulaire :
					header('Location: ./layout.php?reussite='.$continuer);
				}
			}
			else
			{
				$continuer = 2;
				//Redirection du visiteur vers la page formulaire :
				header('Location: ./layout.php?reussite='.$continuer);
			}
		}
		else
		{
			$continuer = 2;
			//Redirection du visiteur vers la page formulaire :
			header('Location: ./layout.php?reussite='.$continuer);
		}
		?>
	</body>
	
</html>