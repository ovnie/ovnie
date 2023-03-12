#Auteur : Josselin Fatah-Roux
#Trie un tableau comportant des prénoms par ordre alphabétique :

#Nettoyage de l'invite de commande :
Clear-Host

#Initialisation de l'option et d'un tableau par défaut :
$nombre=Read-Host "Entrez une option"
$tableau1="josselin","hurricate","amsterdam","savane"

#Boucle switch :
switch($nombre){
	
	#Cas 1 : on réalise un tableau de prénom
    1{
        [string[]]$tableau1=@()
        [bool]$choix=$FALSE
        while($choix -ne $TRUE ){
            [string]$prenom=Read-Host "Entrez votre prénom"
            if($prenom -eq "stop"){
                $choix=$TRUE
                break
            }
            $tableau1+=$prenom
        }
    }
	
	#Cas 2 : on traite le tableau en le triant par ordre alphabétique
    2{
        Write-Host "Le tableau initial est :" $tableau1
        for($i=0;$i -lt $tableau1.Length-1;$i++){
            for($j=$i+1;$j -lt $tableau1.Length;$j++){
                if($tableau1[$i] -gt $tableau1[$j]){                
                    $var_int=$tableau1[$i]
                    $tableau1[$i]=$tableau1[$j]
                    $tableau1[$j]=$var_int
                 }
            }
        }
        Write-Host "Le tableau trié est :" $tableau1
        $recup=$tableau1 | Where-Object{$_ -like "S*"} | Sort-Object -descending
        Write-Host "On récupère les mots commençant par la lettre S et on les tries désalphabétiquement :" $recup
    }
	
	#Cas par défaut : l'option saisie n'est pas valide
    default{
        Write-Host "L'option choisie n'est pas valide"
    }

}