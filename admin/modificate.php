<?php
session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<meta name="author" content="Josselin Fatah-Roux" />
		<meta name="keywords" content="partage,entraide,découverte,actualités,sciences,informatique,horreur,humour" />
		<meta name="description" content="Chaque fois que l’un d’eux serait détaché, et serait contraint de se lever immédiatement, de retourner la tête, de marcher, et de regarder la lumière, à chacun de ces gestes il souffrirait, et l’éblouissement le rendrait incapable de distinguer les choses dont tout à l’heure il voyait les ombres. [La République (trad. Chambry)/Livre VII]" />
		<title>Ovnie - Modification d'un article | Projet 7.20.12.0.13</title>
	</head>
	
	<body>
		<?php require("./base.php"); ?>
		
		<?php
		if(isset($_POST['activermodification']))
		{
			if(isset($_POST['modtitre']) AND !empty($_POST['modtitre']) AND isset($_POST['modmessage']) AND !empty($_POST['modmessage']) AND isset($_SESSION['ticket']) AND !empty($_SESSION['ticket']))
			{
				//Modification du titre/message de l'article à l'aide d'une requête préparée :
				$nv_titre = htmlspecialchars($_POST['modtitre']);
				$nv_message = htmlspecialchars($_POST['modmessage']);
				$req = $bdd->prepare('UPDATE actu SET titre=?, message=? WHERE id=?');
				$req->execute(array($nv_titre,$nv_message,$_SESSION['ticket']));
				header('Location: ../index.php');
			}
			else
			{
				echo 'Aucune modification n\'a été apportée';
			}
		}
		?>
	
		<?php
		if(isset($_POST['lancermodification']))
		{
			if(isset($_POST['ticket']) AND !empty($_POST['ticket']))
			{
				$ticket = htmlspecialchars($_POST['ticket']);
				$nbticket = $bdd->query('SELECT COUNT(*) AS total FROM actu'); //On demande le nombre de ligne pour les articles.
				$row = $nbticket->fetch(PDO::FETCH_ASSOC);
				$total = $row['total']; //On récupère le nombre total.
				if($ticket >= 1 AND $ticket<=$total)
				{
					//Récupération du titre et du message du ticket :
					$recup_titmess = $bdd->prepare('SELECT titre, message FROM actu WHERE id=?');
					$recup_titmess->execute(array($ticket));
					$donnees = $recup_titmess->fetch()
		?>
					<h1>Ajouter un article :</h1>
					<form method="post">
						<fieldset>
							<legend>Informations</legend>
								<label for="modtitre">Modifier le titre :</label>
								<br/><input type="text" name="modtitre" id="modtitre" value="<?php echo $donnees['titre'] ?>" />
						</fieldset>
						<fieldset>
							<legend>Actualités</legend>
								<label for="modmessage">Modifier message</label>
				<br/><textarea name="modmessage" id="modmessage" rows="10" cols="50"><?php echo $donnees['message'] ?></textarea> 
						</fieldset>
						<p><input type="submit" value="Modifier" name="activermodification" /></p>
					</form>
		<?php
					$_SESSION['ticket']=intval($ticket);
				}
				else
				{
					echo 'Le ticket n\'existe pas !';
				}
			}
			else
			{
				echo 'Le champ est resté vide !';
			}
		}
		?>
	</body>
	
</html>