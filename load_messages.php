<?php require("./admin/base.php"); ?>

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
	if($i==$pageActuelle) //S'il s'agit de la page actuelle...
	{
		echo ' [ '.$i.' ] '; 
	}	
	else //Sinon...
	{
	  echo ' <a href="./minichat.php?page='.$i.'">'.$i.'</a> ';
	}
}
echo '</p>';
?>