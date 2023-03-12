#Auteur : Josselin Fatah-Roux
#Calcul du prix HT et TTC d'une commande en fonction du prix du produit et de sa quantité :

#Nettoyage de l'invite commande :
Clear-Host

#Récupération du prix du produit et de sa quantité :
[Decimal]$prix_Produit=Read-Host "Quel est le prix de votre produit ?"
[Int]$nb_Produit=Read-Host "Quel est le nombre de produit(s) commandé(s) ?"

#Fonction qui calcule la taxe de 20% (pour 5 euros 5*0.2=5*2*10^(-1)=10^(1)*10^(-1)=10^(0)=1 d'où 5+1=6 équivalent à 5*1.2=6) :
Function taxe([Decimal]$prix_Produit,[Int]$quantite)
{
    $prixHT=($prix_Produit*$quantite)
    $prixTTC=($prix_Produit*$quantite)*1.2
    return $prix_Produit,$quantite,$prixHT,$prixTTC
}

$produit_Taxe=taxe($prix_Produit)($nb_Produit)

Write-Host "Le produit coûte :" $produit_Taxe[0] "euros"
Write-Host "Il a été commandé en :" $produit_Taxe[1] "fois"
Write-Host "Le prix HT est donc de :" $produit_Taxe[2] "euros"
Write-Host "Le prix TTC est donc de :" $produit_Taxe[3] "euros"