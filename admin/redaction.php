<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<meta name="author" content="Josselin Fatah-Roux" />
		<meta name="keywords" content="partage,entraide,découverte,actualités,sciences,informatique,horreur,humour" />
		<meta name="description" content="Chaque fois que l’un d’eux serait détaché, et serait contraint de se lever immédiatement, de retourner la tête, de marcher, et de regarder la lumière, à chacun de ces gestes il souffrirait, et l’éblouissement le rendrait incapable de distinguer les choses dont tout à l’heure il voyait les ombres. [La République (trad. Chambry)/Livre VII]" />
		<title>Ovnie - Ajouter une rédaction | Projet 7.20.12.0.13</title>
	</head>
	
	<body>
		<?php require("./base.php"); ?>
	
		<?php
		if(isset($_POST['ajouterredaction']))
		{
			//Variables à enregistrer :
			$titre_redaction = htmlspecialchars($_POST['rtitre']);
			$titre_rscategorie = htmlspecialchars($_POST['rscategorie']);
			$message_redaction = $_POST['rmessage'];
			
			if (isset($titre_redaction) AND isset($titre_rscategorie) AND isset($message_redaction) AND !empty($titre_redaction) AND !empty($titre_rscategorie) AND !empty($message_redaction))
			{
				$nbdesouscategorie = $bdd->query('SELECT COUNT(*) AS totaldesouscategories FROM souscategories'); //On demande le nombre de ligne pour les catégories.
				$row = $nbdesouscategorie->fetch(PDO::FETCH_ASSOC);
				$totaldesouscategorie = $row['totaldesouscategories']; //On récupère le nombre total.
				if($titre_rscategorie >= 1 AND $titre_rscategorie <= $totaldesouscategorie)
				{
					//Insertion de la rédaction et de sa sous-catégorie à l'aide d'une requête préparée :
					$req = $bdd->prepare('INSERT INTO articles(titre, corps, liaison) VALUES(:titre, :corps, :liaison)');
					$req->execute(array(
					'titre' => $titre_redaction,
					'corps' => $message_redaction,
					'liaison' => $titre_rscategorie,
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