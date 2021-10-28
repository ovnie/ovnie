#Auteur : Josselin Fatah-Roux
#Trie un tableau comportant des années :

#Nettoyage de l'invite de commande :
Clear-Host

#Initialisation des variables :
[string[]]$tableau2=@()
[bool]$choix=$FALSE
[string[]]$majeur=@()
[string[]]$av90=@()
[string[]]$an80=@()

#On réalise un tableau avec des années de naissance :
while($choix -ne $TRUE ){
    [string]$annee=Read-Host "Entrez une année"
    if($annee -eq "stop"){
        $choix=$TRUE
        break
    }
    $tableau2+=$annee
}

#On fait du traitement sur le tableau :
for($cmpt=0;$cmpt -lt $tableau2.Length;$cmpt++){
    if($tableau2[$cmpt] -le 2002){
        $majeur+=$tableau2[$cmpt]
    }
    if($tableau2[$cmpt] -le 1990){
        $av90+=$tableau2[$cmpt]
    }
    if($tableau2[$cmpt] -lt 1990 -and $tableau2[$cmpt] -ge 1980){
        $an80+=$tableau2[$cmpt]
    }
}

Write-Host "Le nombre de majeur est de" $majeur.Length
Write-Host "Le nombre personne né avant 1990 est de" $av90.Length
Write-Host "Le nombre personne né dans les années 80 est de" $an80.Length

$recup=$tableau2 | Where-Object{$_ -like "198*"}