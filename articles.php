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
							
							echo '<h2><strong>Commentaires</strong></h2>';
							
							if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['mail']))
							{
								if(isset($_POST['rep_commentaire']) AND !empty($_POST['rep_commentaire']))
								{
									//Sécurité : si jamais le message contient des balises HTML
									$recup_commentaire=htmlspecialchars($_POST['rep_commentaire']);
									
									$req = $bdd->prepare('INSERT INTO commentaires(pseudo, message, num_redac) VALUES(:pseudo, :message, :num_redac)');
									$req->execute(array(
										'pseudo' => $_SESSION['pseudo'],
										'message' => $recup_commentaire,
										'num_redac' => $_GET['redaction'],
										));
										
									$req1 = $bdd->prepare('INSERT INTO commentaires(date_commentaire) VALUES(NOW())');
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
							<label for="rep_commentaire">Message</label> : <br><textarea name="rep_commentaire" id="rep_commentaire" rows="10" cols="50">Insérer le commentaire !</textarea>
							<p class="textCenter"><input type="submit" value="Envoyer" name="boutoncommentaire" /></p>
							</form>
							
							<div class="messages">
							<?php
							$messagesParPage=15; //Nous allons afficher 15 messages par page.
							
							$resultat = $bdd->query('SELECT COUNT(*) AS total FROM commentaires WHERE num_redac LIKE "%'.$_GET['redaction'].'%"'); //On demande le nombre de ligne de commentaire.
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
							
							//On récupère tout le contenu de la table commentaires avec le num_redac par ordre décroissant de l'id :
							$reponse = $bdd->query('SELECT pseudo, message, DATE_FORMAT(date_commentaire, \'%d/%m/%Y %Hh%imin%ss\') AS date_commentaire FROM commentaires WHERE num_redac LIKE "%'.$_GET['redaction'].'%" ORDER BY id DESC LIMIT '.$premiereEntree.', '.$messagesParPage.'');
							
							//On affiche chaque entrée une à une :
							while ($donnees = $reponse->fetch())
							{
							?>
							
							<p>
							<strong><?php echo $donnees['pseudo'] ?></strong> <?php echo '(' . $donnees['date_commentaire'] . ')' ?> : <?php echo $donnees['message'] ?>
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
								  echo ' <a href="articles.php?redaction='.$_GET['redaction'].'&page='.$i.'">'.$i.'</a> ';
								}
							}
							echo '</p>';
							?>
							</div>
							<?php
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
			<?php require("./footer.php"); ?>
		</footer>
	</body>
	
</html>