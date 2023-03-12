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
		<title>Ovnie - Profil | Projet 7.20.12.0.13</title>
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
				if(isset($_POST['newmail']) AND !empty($_POST['newmail'])){
					if($_POST['newmail'] != $_SESSION['mail']){
						$newmail = htmlspecialchars($_POST['newmail']);
						if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $newmail)){
							$reqverifmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
							$reqverifmail->execute(array($newmail));
							$mailverifexist = $reqverifmail->rowCount();
							if($mailverifexist == 0){
								$insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
								$insertmail->execute(array($newmail, $_SESSION['id']));
								$_SESSION['mail']=$newmail;
								echo '<p class="textCenter"><span class="valide">L\'e-mail a été modifié !</span></p>';
							}
							else{
								echo '<p class="textCenter"><span class="erreur">E-mail déjà utilisé !</span></p>';
							}
						}
						else{
							echo '<p class="textCenter"><span class="erreur">Nouveau e-mail invalide !</span></p>';
						}
					}
					else{
						echo '<p class="textCenter"><span class="erreur">E-mail identique au précédent !</span></p>';
					}
				}
				if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])){
				$mdp1 = md5($_POST['newmdp1']);
				$mdp2 = md5($_POST['newmdp2']);
					if($mdp1 == $mdp2) {
						$insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
						$insertmdp->execute(array($mdp1, $_SESSION['id']));
						echo '<p class="textCenter"><span class="valide">Le mot de passe a été modifié !</span></p>';
					} 
					else{
						echo '<p class="textCenter"><span class="erreur">Vos deux mots de passe ne correspondent pas !</span></p>';
					}
				}
			?>
				<h1><strong>Profil</strong></h1>
				<p class="textCenter"> Pseudo : <?php echo $_SESSION['pseudo']; ?> </p>
				<p class="textCenter"> E-mail : <?php echo $_SESSION['mail']; ?> </p>
				
				<h1><strong>Modification e-mail/mot de passe</strong></h1>
				<form method="POST">
				<table>
				   <tr>
					  <td>
						 <label for="newmail">Nouveau e-mail :</label>
					  </td>
					  <td>
						 <input type="email" placeholder="Nouveau e-mail" id="newmail" name="newmail" />
					  </td>
				   </tr>
				   <tr>
					  <td>
						 <label for="newmdp1">Nouveau mot de passe :</label>
					  </td>
					  <td>
						 <input type="password" placeholder="Nouveau mot de passe" id="newmdp1" name="newmdp1" />
					  </td>
				   </tr>
				   <tr>
					  <td>
						 <label for="newmdp2">Confirmation du nouveau mot de passe :</label>
					  </td>
					  <td>
						 <input type="password" placeholder="Confirmez" id="newmdp2" name="newmdp2" />
					  </td>
				   </tr>
				   <tr>
					  <td class="textCenter" colspan=2>
						 <br><input type="submit" name="formmodification" value="Modifier" />
					  </td>
				   </tr>
				</table>
				</form>
			<?php 
			}
			else{
				header("Location: ./index.php");
			}
			?>
			</article>
		</section>
		<footer>
			<?php require("./footer.php"); ?>
		</footer>
	</body>
	
</html>