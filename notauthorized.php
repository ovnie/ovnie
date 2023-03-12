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
		<title>Ovnie - Accès aux VIP | Projet 7.20.12.0.13</title>
	</head>
	
	<body>
		<?php
		if(isset($_POST['lancerlaverification'])){
			//Variable à enregistrer :
			$le_code = strtolower(htmlspecialchars($_POST['codesecret']));
				
			if (isset($le_code) AND !empty($le_code)){
				if ($le_code == "ange" OR $le_code == "anges"){
					header('Location: index.php');
				}
				else{
					$erreur_passe = "Le mot de passe inséré est incorrect, vous n'êtes pas autorisé à accéder à la zone VIP !";
				}
			}
			else{
				$erreur_passe = "Le mot de passe inséré est vide, vous n'êtes pas autorisé à accéder à la zone VIP !";
			}
		}?>
		<div class="secret">
			<a href="./index.php"><img class="bloc" src="./images/secretHeader.png" alt="Image" title="Ovnie - Accès aux VIP" /></a>
		</div>
		<div class="secret">
			<img class="bloc" src="./images/notauthorized1.png" alt="Image" title="Ovnie - Not Authorized" />
			<?php if (isset($erreur_passe)){echo '<p class="textCenter"><span class="erreur">'.$erreur_passe.'</span></p>';} ?>
			<form method="post">
				<label for="ticket">Entrer le mot de passe pour accéder à la zone VIP :</label>
				<p><input type="text" name="codesecret" id="codesecret" /></p>
				<p><input type="submit" value="Envoyer" name='lancerlaverification' /></p>
			</form>
			<img class="bloc" src="./images/notauthorized2.png" alt="Image" title="Ovnie - Accès aux VIP" />
		</div>
	</body>
	
</html>