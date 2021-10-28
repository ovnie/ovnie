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
		<title>Ovnie - Articles | Projet 7.20.12.0.13</title>
	</head>
	
	<body>
		<?php require("admin/base.php"); ?>
		<header>
			<?php require("header.php"); ?>
		</header>
		<section class="banner">
			<?php require("banner.php"); ?>
		</section>
		<section>
			<nav>
				<?php require("menu.php"); ?>
			</nav>
			<article>
				<?php 
					if(isset($_GET['redaction']))
					{
						//var_dump($_GET['redaction']);
						$nbarticles = $bdd->query('SELECT COUNT(*) AS totalarticles FROM articles'); //On demande le nombre de ligne pour les articles.
						$row = $nbarticles->fetch(PDO::FETCH_ASSOC);
						$totalarticles = $row['totalarticles']; //On récupère le nombre total.
						if($_GET['redaction'] >= 1 AND $_GET['redaction'] <= $totalarticles)
						{
							//On récupère l'article :
							$req_article = $bdd->query('SELECT corps FROM articles WHERE id="'.$_GET['redaction'].'"');

							while ($recup_article = $req_article->fetch())
							{
								echo $recup_article['corps'];
							}//Fin de la boucle pour l'article :
							$req_article->closeCursor();
						}
						else
						{
							echo '<p class="textCenter"><span class="erreur">Erreur, cette rédaction n\'existe pas ! Veuillez contacter l\'administrateur du site.</span></p>';
						}
					}
					else
					{
						echo '<p class="textCenter"><span class="erreur">Erreur, aucune rédaction n\'est indiquée ! Veuillez contacter l\'administrateur du site.</span></p>';
					}
				?>
			</article>
		</section>
		<footer>
			<?php require("footer.php"); ?>
		</footer>
	</body>
	
</html>