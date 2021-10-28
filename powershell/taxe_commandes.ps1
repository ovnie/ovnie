#Auteur : Josselin Fatah-Roux
#Calcul du prix HT et TTC de commande(s) en fonction du prix du produit et de sa quantité :

#Nettoyage de l'invite commande :
Clear-Host

#Fonction qui calcule la taxe de 20% (pour 5 euros 5*0.2=5*2*10^(-1)=10^(1)*10^(-1)=10^(0)=1 d'où 5+1=6 équivalent à 5*1.2=6) :
Function taxe([Decimal]$prix_Produit,[Int]$quantite){
    $prixHT=($prix_Produit*$quantite)
    $prixTTC=($prix_Produit*$quantite)*1.2
    return $prix_Produit,$quantite,$prixHT,$prixTTC
}

#Initialisation des tableaux récupérant les prix HT et TTC :
[System.Collections.ArrayList]$tabHT=@() #[System.Object[]]$tabHT=@()
[System.Collections.ArrayList]$tabTTC=@() #[System.Object[]]$tabTTC=@()

#Boucle qui permet de générer des commandes :
Do{
    [Int]$option=Read-Host "0 : Fin du traitement | 1 - Prix HT de la commande | 2 - Prix TTC de la commande `n Entrez l'option"
    if($option -eq 1 -or $option -eq 2){
        [Decimal]$prix_Produit=Read-Host "Quel est le prix de votre produit ?"
        [Int]$nb_Produit=Read-Host "Quel est le nombre de produit(s) commandé(s) ?"
        $produit_Taxe=taxe($prix_Produit)($nb_Produit)
    }
    switch ($option){
        0{
            Write-Host "Fin du traitement"
        }
        1{
            Write-Host "Le prix HT est donc de :" $produit_Taxe[2] "euros"
            Write-Host ("Le prix HT est donc de : {2} euros" -f $produit_Taxe)
            $tabHT+=$produit_Taxe[2]       
        }
        2{
            Write-Host "Le prix TTC est donc de :" $produit_Taxe[3] "euros"
            Write-Host ("Le prix TTC est donc de : {3} euros" -f $produit_Taxe)
            $tabTTC+=$produit_Taxe[3]
        }
        Default{
            Write-Host "Ton option n'est pas bonne, recommence !"
        }
    }
}While($option -ne 0)