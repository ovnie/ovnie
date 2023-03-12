<?php
session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<link rel="stylesheet" href="ovnie.css" type="text/css" media="screen" />
		<meta name="author" content="Josselin Fatah-Roux" />
		<meta name="keywords" content="partage,entraide,découverte,actualités,sciences,informatique,horreur,humour" />
		<meta name="description" content="Chaque fois que l’un d’eux serait détaché, et serait contraint de se lever immédiatement, de retourner la tête, de marcher, et de regarder la lumière, à chacun de ces gestes il souffrirait, et l’éblouissement le rendrait incapable de distinguer les choses dont tout à l’heure il voyait les ombres. [La République (trad. Chambry)/Livre VII]" />
		<title>Ovnie - Mini-chat | Projet 7.20.12.0.13</title>
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
				<h1><strong>Mini-chat</strong></h1>
				<section class="minichat">
					<?php
					if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['mail']))
					{
						if(isset($_POST['rep_message']) AND !empty($_POST['rep_message']))
						{
							//Sécurité : si jamais le message contient des balises HTML
							$recup_message=htmlspecialchars($_POST['rep_message']);
						
							$req = $bdd->prepare('INSERT INTO minichat(pseudo, message) VALUES(:pseudo, :message)');
							$req->execute(array(
								'pseudo' => $_SESSION['pseudo'],
								'message' => $recup_message,
								));
								
							$req1 = $bdd->prepare('INSERT INTO minichat(date_minichat) VALUES(NOW())');
							echo '<p class="valide">Message envoyé !</p>';
						}
						else
						{
							echo '<p class="valide">Vous êtes connecté !</p>';
						}
					}
					else
					{
						echo '<p class="erreur">Vous n\'êtes pas connecté pour pouvoir participer !</p>';
					}
					?>
					
					<form method="post">
					<label for="rep_message">Message</label> : <br><textarea name="rep_message" id="rep_message" rows="10" cols="50">Bonjour tout le monde !</textarea>
					<p class="textCenter"><input type="submit" value="Envoyer" name="boutonchat" /></p>
					</form>
					
					<div class="messages">
					<?php
					$messagesParPage=15; //Nous allons afficher 15 messages par page.
				 
					$resultat = $bdd->query('SELECT COUNT(*) AS total FROM minichat'); //On demande le nombre de ligne de minichat.
					$row = $resultat->fetch(PDO::FETCH_ASSOC);
					$total = $row['total']; //On récupère le nombre total.
					
					//Nous allons maintenant compter le nombre de pages avec ceil qui arrondi à l'entier supérieur :
					$nombreDePages=ceil($total/$messagesParPage);
					 
					if(isset($_GET['page'])) //Si la variable $_GET['page'] existe...
					{
						 $pageActuelle=intval($_GET['page']); //Si un visiteur change le get on le transforme en nombre (protection).
					 
						 if($pageActuelle>$nombreDePages) //Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
						 {
							  $pageActuelle=$nombreDePages;
						 }
					}
					else //Sinon...
					{
						 $pageActuelle=1; //La page actuelle est la n°1. 
					}
					 
					$premiereEntree=($pageActuelle-1)*$messagesParPage; //On calcul la première entrée à lire.
					
					//On récupère tout le contenu de la table minichat par ordre décroissant de l'id :
					$reponse = $bdd->query('SELECT pseudo, message, DATE_FORMAT(date_minichat, \'%d/%m/%Y %Hh%imin%ss\') AS date_minichat FROM minichat ORDER BY id DESC LIMIT '.$premiereEntree.', '.$messagesParPage.'');
					
					//On affiche chaque entrée une à une :
					while ($donnees = $reponse->fetch())
					{
					?>
					
					<p>
					<strong><?php echo $donnees['pseudo'] ?></strong> <?php echo '(' . $donnees['date_minichat'] . ')' ?> : <?php echo $donnees['message'] ?>
					</p>

					<?php
					}
					$reponse->closeCursor(); //Termine le traitement de la requête.
					
					echo '<p class="textCenter">Page : '; //Pour l'affichage, on centre la liste des pages.
					for($i=1; $i<=$nombreDePages; $i++) //On fait notre boucle.
					{
						//On va faire notre condition :
						if($i==$pageActuelle) //Si il s'agit de la page actuelle...
						{
							echo ' [ '.$i.' ] '; 
						}	
						else //Sinon...
						{
						  echo ' <a href="minichat.php?page='.$i.'">'.$i.'</a> ';
						}
					}
					echo '</p>';
					?>
					</div>
					<script>
						setInterval('load_messages()',2000); //On appelle à intervalle régulier (2000ms=2s) la fonction load_messages.
						function load_messages()
						{
							$('.messages').load('load_messages.php');
						}
					</script>
				</section>
			</article>
		</section>
		<footer>
			<?php require("./footer.php"); ?>
		</footer>
	</body>
	
</html>