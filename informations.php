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
		<title>Ovnie - Informations | Projet 7.20.12.0.13</title>
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
				<h1 id="qui"><strong>Qui sommes-nous ?</strong></h1>
				<p class="textJustify">Ovnie est une organisation à but non lucratif créée initialement en 2020 par un individu passionné d'informatique ayant pour objectif de développer un réseau unique d'échange d'informations sur des sujets à caractère sérieux/mystérieux.</p>
				<h1 id="policy"><strong>Cookies policy</strong></h1>
				<h2>Que sont les cookies ?</h2>
				<p class="textJustify">Un cookie est un petit fichier informatique, un traceur, déposé et lu par exemple lors de la consultation d'un site internet, de la lecture d'un courrier électronique, de l'installation ou de l'utilisation d'un logiciel ou d'une application mobile et ce, quel que soit le type de terminal utilisé (ordinateur, smartphone, liseuse numérique, console de jeux vidéos connectée à Internet, etc.).</p>
				<p class="textJustify">L'utilisation de cookie(s) est soumise à votre consentement dès lors qu'ils ne sont pas strictement nécessaires au fonctionnement du site concerné.</p>
				<h2>Quel type de cookies utilisons-nous ?</h2>
				<p class="textJustify">Nous utilisons des cookies de type fonctionnement uniquement, c'est-à-dire strictement nécessaires à la fourniture d'un service expressément demandé par l'utilisateur (identifiants de session).</p>
				<p class="textJustify">Ces cookies sont dispensés du recueil de consentement de l'utilisateur.</p>
				<h1 id="recrutement"><strong>Recrutement</strong></h1>
				<p class="textAlinea">Aucune offre d'emploi n’est actuellement proposée.</p>
				<p class="textJustify">Pour une candidature spontanée, envoyer une lettre de motivation et votre curriculum vitæ à notre direction des ressources humaines : recrutement@ovnie.com</p>
				<p class="textJustify"><em>En envoyant votre candidature par e-mail à la Direction des Ressources Humaines, dans le cadre de votre candidature spontanée, vous nous autorisez à conserver votre dossier et à prendre contact avec vous dans le respect de la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés, plus connue sous le nom de loi informatique et libertés.</em></p>
				<h1 id="contact"><strong>Contact</strong></h1>
				<?php
				if(isset($_POST['captcha'])) {
					if($_POST['captcha'] == $_SESSION['captcha']) {
						if(isset($_POST['demande']) AND !empty($_POST['demande'])){
							$recup_demande=htmlspecialchars($_POST['demande']);
							$recup_mail=htmlspecialchars($_POST['email']);
							if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $recup_mail)){
								$to = 'vufic@outlook.com';
								$letitre='Envoi depuis page Contact';
								$passage_ligne = "\r\n";
								$boundary = "-----=".md5(rand());
								 
								$headers = "From: " . $recup_mail . $passage_ligne;
								$headers.= "Reply-to: " . $recup_mail . $passage_ligne;
								$headers.= "MIME-Version: 1.0" . $passage_ligne;
								$headers.= "Content-Type: multipart/mixed;" . $passage_ligne . " boundary=\"" . $boundary . "\"" . $passage_ligne;

								$message = $passage_ligne . $boundary . $passage_ligne;

								$message .= "Content-Type: text/plain; charset=\"UTF-8\"" . $passage_ligne;
								$message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
								$message .= $passage_ligne . $recup_demande . $passage_ligne; 
								$message .= $passage_ligne . "--" . $boundary . $passage_ligne;
								 
								$message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
								$retour=mail($to, $letitre, $recup_demande, $headers);
								if($retour){
									echo '<p class="valide">Votre message a été envoyé.</p>';
								}
								else{
									echo '<p class="erreur">Il y a eu une erreur, veuillez réessayer !</p>';
								}
							}
							else{
								echo '<p class="erreur">Votre e-mail est invalide.</p>';
							}
						}
						else{
							echo '<p class="erreur">Vous n\'avez pas rempli un champ !</p>';
						}
					}
					else{
						echo '<p class="erreur">Captcha invalide !</p>';
					}
				}
				?>
				<form method="post">
					<fieldset>
						<legend>Vos coordonnées</legend>
							<label for="email">Quel est votre e-mail ?</label>
							<br/><input type="email" name="email" id="email" required />
					</fieldset>
					<fieldset>
						<legend>Votre message</legend>
							<label for="demande">Comment pouvons-nous vous aider ?</label>
							<br/><textarea name="demande" id="demande" rows="10" cols="50"></textarea> 
					</fieldset>
					<fieldset>
						<legend>Captcha</legend>
						<label for="captcha">Veuillez recopier le code !</label>
							<br/><img src="captcha.php" />
							<br/><input type="text" name="captcha" id="captcha" required />
					</fieldset>
					<p class="textCenter"><input type="submit" value="Envoyer" /></p>
				</form>
			</article>
		</section>
		<footer>
			<?php require("./footer.php"); ?>
		</footer>
	</body>
	
</html>