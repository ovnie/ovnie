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
		<title>Ovnie - Inscription | Projet 7.20.12.0.13</title>
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
				<?php
				if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['mail'])){
					header("Location: ./profil.php");
				}
				else{
					?>
					<h1><strong>Inscription</strong></h1>
					<form method="POST">
					<table>
					   <tr>
						  <td>
							 <label for="pseudo">Pseudo :</label>
						  </td>
						  <td>
							 <input type="text" placeholder="Pseudo" id="pseudo" name="pseudo" />
						  </td>
					   </tr>
					   <tr>
						  <td>
							 <label for="mail">E-mail :</label>
						  </td>
						  <td>
							 <input type="email" placeholder="E-mail" id="mail" name="mail" />
						  </td>
					   </tr>
					   <tr>
						  <td>
							 <label for="mail2">Confirmation de l'e-mail :</label>
						  </td>
						  <td>
							 <input type="email" placeholder="Confirmez" id="mail2" name="mail2" />
						  </td>
					   </tr>
					   <tr>
						  <td>
							 <label for="mdp">Mot de passe :</label>
						  </td>
						  <td>
							 <input type="password" placeholder="Mot de passe" id="mdp" name="mdp" />
						  </td>
					   </tr>
					   <tr>
						  <td>
							 <label for="mdp2">Confirmation du mot de passe :</label>
						  </td>
						  <td>
							 <input type="password" placeholder="Confirmez" id="mdp2" name="mdp2" />
						  </td>
					   </tr>
					   <tr>
						  <td class="textCenter" colspan=2>
							 <br><input type="submit" name="forminscription" value="Je m'inscris" />
						  </td>
					   </tr>
					</table>
					</form>
					<?php
					if(isset($_POST['forminscription'])){
						$pseudo = htmlspecialchars($_POST['pseudo']);
						$mail = htmlspecialchars($_POST['mail']);
						$mail2 = htmlspecialchars($_POST['mail2']);
						$mdp = md5(($_POST['mdp']));
						$mdp2 = md5(($_POST['mdp2']));
						if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])){
							$pseudolength = strlen($pseudo);
							if($pseudolength <= 255){
								$reqpseudo = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ?");
								$reqpseudo->execute(array($pseudo));
								$pseudoexist = $reqpseudo->rowCount();
								if($pseudoexist == 0){
									if($mail == $mail2){
										if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)){
											$reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
											$reqmail->execute(array($mail));
											$mailexist = $reqmail->rowCount();
											if($mailexist == 0){
												if($mdp == $mdp2){
													$insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse) VALUES(?, ?, ?)");
													$insertmbr->execute(array($pseudo, $mail, $mdp));
													echo '<p class="textCenter"><span class="valide">Votre compte a bien été créé !</span></p>';
												} 
												else{
													$erreur = "Vos mots de passe ne correspondent pas !";
												}
											} 
											else{
												$erreur = "Adresse e-mail déjà utilisée !";
											}
										} 
										else{
										   $erreur = "Votre adresse e-mail n'est pas valide !";
										}
									} 
									else{
										$erreur = "Vos adresses e-mail ne correspondent pas !";
									}
								} 
								else{
									$erreur = "Pseudo déjà utilisé !";
								}
							}
							else{
								$erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
							}
						} 
						else{
						  $erreur = "Tous les champs doivent être complétés !";
						}
					}
					?>
					<?php
					if(isset($erreur))
					{
						echo '<p class="textCenter"><span class="erreur">'.$erreur.'</span></p>';
					}
					?>
				<?php
				}
				?>
			</article>
		</section>
		<footer>
			<?php require("./footer.php"); ?>
		</footer>
	</body>
	
</html>