<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<meta name="author" content="Josselin Fatah-Roux" />
		<meta name="keywords" content="partage,entraide,découverte,actualités,sciences,informatique,horreur,humour" />
		<meta name="description" content="Chaque fois que l’un d’eux serait détaché, et serait contraint de se lever immédiatement, de retourner la tête, de marcher, et de regarder la lumière, à chacun de ces gestes il souffrirait, et l’éblouissement le rendrait incapable de distinguer les choses dont tout à l’heure il voyait les ombres. [La République (trad. Chambry)/Livre VII]" />
		<title>Ovnie - Gestion des membres | Projet 7.20.12.0.13</title>
	</head>
	
	<body>
		<?php require("./base.php"); ?>
		
		<?php
		if(isset($_GET['type']) AND $_GET['type'] == 'membre') 
		{		   
			if(isset($_GET['supprime']) AND !empty($_GET['supprime']))
			{
			  $supprime = (int) $_GET['supprime'];
			  $req = $bdd->prepare('DELETE FROM membres WHERE id = ?');
			  $req->execute(array($supprime));
			}
		}
		
		$membres = $bdd->query('SELECT * FROM membres');
		?>
		
		<ul>
			<?php while($membre = $membres->fetch()) { 
			//var_dump($membre) ?>
			<li><?php echo $membre['id'] ?> : <?php echo $membre['pseudo'] ?> - <a href="./membres.php?type=membre&supprime=<?php echo $membre['id'] ?>">Supprimer</a></li>
			<?php } ?>
		</ul>
	</body>
	
</html>