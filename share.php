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
		<title>Ovnie - Liens associations | Projet 7.20.12.0.13</title>
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
				<h1><strong>Fondation Le Refuge : Protéger les jeunes LGBT+</strong></h1>
				<p class="textCenter"><img src="./images/refuge.png" alt="Image" /></p>
				<p class="textJustify">Reconnue d’Utilité Publique, la Fondation Le Refuge a pour objet de prévenir l’isolement et le suicide des jeunes LGBT+, de 14 à 25 ans, victimes d’homophobie ou de transphobie et en situation de rupture familiale. Le Refuge offre à ses bénéficiaires en souffrance un environnement sécurisant et l’attention d’équipes pluridisciplinaires pour les guider vers l’autonomie en les aidant à se reconstruire.</p>
				<p>Lien : <a href="https://le-refuge.org/" title="Fondation Le Refuge" >Fondation Le Refuge</a></p>
				<h1><strong>Fondation Thierry Latran : Dédiée à la maladie de Charcot</strong></h1>
				<p class="textCenter"><img src="./images/thierry_latran_2.png" alt="Image" /></p>
				<p class="textJustify">La Fondation, créée en juin 2008, est dédiée au financement de la recherche au niveau Européen sur La Sclérose Latérale Amyotrophique ou Maladie de Charcot, maladie atteignant le motoneurone, qui paralyse peu à peu tous les muscles du corps et enferme sa victime dans une prison lui laissant une espérance de survie de 3 à 5 ans.</p>
				<p>Lien : <a href="http://www.fondation-thierry-latran.org/" title="Fondation Thierry Latran" >Fondation Thierry Latran</a></p>
			</article>
		</section>
		<footer>
			<?php require("./footer.php"); ?>
		</footer>
	</body>
	
</html>