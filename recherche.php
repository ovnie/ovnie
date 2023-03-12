<?php
session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<link rel="stylesheet" href="ovnie.css" type="text/css" media="screen" />
		<link href="prism.css" rel="stylesheet" />
		<meta name="author" content="Josselin Fatah-Roux" />
		<meta name="keywords" content="partage,entraide,découverte,actualités,sciences,informatique,horreur,humour" />
		<meta name="description" content="Chaque fois que l’un d’eux serait détaché, et serait contraint de se lever immédiatement, de retourner la tête, de marcher, et de regarder la lumière, à chacun de ces gestes il souffrirait, et l’éblouissement le rendrait incapable de distinguer les choses dont tout à l’heure il voyait les ombres. [La République (trad. Chambry)/Livre VII]" />
		<title>Ovnie - Recherche | Projet 7.20.12.0.13</title>
	</head>
	
	<body>
		<?php require("./admin/base.php"); ?>
		<header>
			<?php require("./header.php"); ?>
		</header>
		<section class="banner">
			<?php require("./banner.php"); ?>
		</section>
		<section>
			<nav>
				<?php require("./menu.php"); ?>
			</nav>
			<article>
				<h1><strong>Recherche</strong></h1>
				<?php 
					if(isset($_GET['q']) AND !empty($_GET['q']))
					{
						//var_dump($_GET['q']);
						$q = htmlspecialchars($_GET['q']);
						$recherche = $bdd->query('SELECT id, titre FROM articles WHERE titre LIKE "%'.$q.'%" ORDER BY id DESC');
					}
					else
					{
						echo '<p class="textCenter"><span class="erreur">Erreur, aucune recherche n\'est indiquée ! Veuillez contacter l\'administrateur du site.</span></p>';
					}
				?>
				<?php
					if(isset($recherche))
					{
						if($recherche->rowCount() > 0) 
						{
				?>
				<ul>
				<?php 
							while($enumeration = $recherche->fetch()) 
							{
				?>
					<li><a href="./articles.php?redaction=<?php echo $enumeration['id']; ?>"><?= $enumeration['titre'] ?></a></li>
				<?php
							} 
				?>
				</ul>
				<?php
						} 
						else
						{
							echo '<p class="textCenter"><span class="erreur">Aucun résultat pour : '.$q.' ...</span></p>';
						}
					}
				?>
			</article>
		</section>
		<footer>
			<?php require("./footer.php"); ?>
		</footer>
	</body>
	
</html>