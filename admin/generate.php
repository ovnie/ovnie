<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<meta name="author" content="Josselin Fatah-Roux" />
		<meta name="keywords" content="partage,entraide,découverte,actualités,sciences,informatique,horreur,humour" />
		<meta name="description" content="Chaque fois que l’un d’eux serait détaché, et serait contraint de se lever immédiatement, de retourner la tête, de marcher, et de regarder la lumière, à chacun de ces gestes il souffrirait, et l’éblouissement le rendrait incapable de distinguer les choses dont tout à l’heure il voyait les ombres. [La République (trad. Chambry)/Livre VII]" />
		<title>Ovnie - Ajouter un article | Projet 7.20.12.0.13</title>
	</head>
	
	<body>
		<?php require("./base.php"); ?>
	
		<?php
		if(isset($_POST['ajouterarticle']))
		{
			//Variables à enregistrer :
			$titre_article = htmlspecialchars($_POST['titre']);
			$message_article = htmlspecialchars($_POST['message']);
			
			/* var_dump($titre_article);
			var_dump($message_article);
			var_dump(isset($titre_article));
			var_dump(isset($message_article)); */
				
			if (isset($titre_article) AND isset($message_article) AND !empty($titre_article) AND !empty($message_article))
			{
				//Insertion du message à l'aide d'une requête préparée :
				$req = $bdd->prepare('INSERT INTO actu(titre, message) VALUES(:titre, :message)');
				$req->execute(array(
				'titre' => $titre_article,
				'message' => $message_article,
				));
				
				$req1 = $bdd->prepare('INSERT INTO actu(date_actu) VALUES(NOW())');
				$continuer = 1;
				//Redirection du visiteur vers la page formulaire :
				header('Location: ./message.php?reussite='.$continuer);
			}
			else
			{
				$continuer = 2;
				//Redirection du visiteur vers la page formulaire :
				header('Location: ./message.php?reussite='.$continuer);
			}
		}
		else
		{
			$continuer = 2;
			//Redirection du visiteur vers la page formulaire :
			header('Location: ./message.php?reussite='.$continuer);
		}
		?>
	</body>
	
</html>