<?php
session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<link rel="stylesheet" href="ovnie.css" type="text/css" media="screen" />
		<meta name="author" content="Josselin Fatah-Roux" />
		<meta name="keywords" content="partage,entraide,découverte,actualités,sciences,informatique,horreur,humour" />
		<meta name="description" content="Chaque fois que l’un d’eux serait détaché, et serait contraint de se lever immédiatement, de retourner la tête, de marcher, et de regarder la lumière, à chacun de ces gestes il souffrirait, et l’éblouissement le rendrait incapable de distinguer les choses dont tout à l’heure il voyait les ombres. [La République (trad. Chambry)/Livre VII]" />
		<title>Ovnie - Accueil | Projet 7.20.12.0.13</title>
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
				<h1><strong>Projet 7.20.12.0.13</strong></h1>
				<p class="textCenter"><img src="./images/image_terminal_3.gif" alt="Image" /></p>
				<h1><strong>État du développement</strong></h1>
				<?php
				//On récupère les 5 dernières actualités :
				$req = $bdd->query('SELECT id, titre, message, DATE_FORMAT(date_actu, \'%d/%m/%Y %Hh%imin%ss\') AS date_actu FROM actu ORDER BY id DESC LIMIT 0, 10');

				while ($donnees = $req->fetch())
				{
				?>

				<section class="news">
					<h2>
						<em>Ticket n°<?php echo $donnees['id']; ?> - <?php echo $donnees['date_actu']; ?> :
						<?php echo htmlspecialchars($donnees['titre']); ?></em>
					</h2>
		
					<p>
					<?php
					//On affiche le contenu de l'article :
					echo nl2br(htmlspecialchars($donnees['message']));
					?>
					</p>
				</section>
					
				<?php

				} //Fin de la boucle des articles :
				$req->closeCursor();

				?>
			</article>
		</section>
		<footer>
			<?php require("./footer.php"); ?>
		</footer>
	</body>
	
</html>