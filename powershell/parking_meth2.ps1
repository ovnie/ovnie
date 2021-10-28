#Auteur : Josselin Fatah-Roux
#Le parking :

#Nettoyage de l'invite commande :
Clear-Host

#Classe :
class Client{

    #Propriétés|Attributs :
    [String]$immatriculation
    [DateTime]$heure_Arr
    [DateTime]$heure_Dep

    #Constructeur :
    Client ([String]$immatriculation,[DateTime]$heure_Arr,[DateTime]$heure_Dep){
        $this.immatriculation=$immatriculation
        $this.heure_Arr=$heure_Arr
		$this.heure_Dep=$heure_Dep
    }

}

#Initialisation des variables :
[string]$mdpAdmin="abc"
[string]$mdpUtilisateur="0"
[int]$option=0
$tabClient=@()

#Tant qu'un administrateur ne ferme pas le parking :
while($mdpUtilisateur -ne $mdpAdmin ){
    [string]$option=Read-Host "1 : Enregistrement du client | 2 - Suivi du tableau des immatriculations | 3 - Paiement | 4 - Fermeture du parking `n Entrez l'option"
    if($option -eq 1){
		#Récupération de l'immatriculation :
        [string]$immatriculation=Read-Host "Récupération de la plaque d'immatriculation"
		#Vérification que l'immatriculation n'est pas en double :
        $doublette=0
		for($n=$tabClient.Length-1;$n -ge 0;$n--){
			if($tabClient[$n][0] -eq $immatriculation -and $tabClient[$n][2] -eq [DateTime]0){
				$doublette=1
			}
		}
		if($doublette -eq 1){
			#L'immatriculation existe déjà et la voiture est sur le parking :
            Write-Host "Vous ne pouvez pas entrer car votre voiture est déjà sur le parking"
            Write-Host "En cas d'ursupation de plaque d'immatriculation veuillez contacter la police en appellant le 16"
		}
		elseif($doublette -eq 0){
			#Enregistrement du client :
			[DateTime]$heure_Arr=Get-Date
			[DateTime]$heure_Dep=0
			$client = New-Object Client -ArgumentList $immatriculation,$heure_Arr,$heure_Dep
			$tabClient+=,@($client.immatriculation,$client.heure_Arr,$client.heure_Dep)
			#$tabClient
			#$tabClient.GetType()
			#$tabClient[0][1]
			Write-Host "Votre immatriculation a été enregistrée"
		}
    }
	elseif($option -eq 2){
		for($k=0;$k -le $tabClient.Length-1;$k++){
			if($tabClient[$k][2] -eq [DateTime]0){
				Write-Host "Heure d'arrivée :" $tabClient[$k][1] "| Immatriculation :" $tabClient[$k][0] "| Heure de départ : actuellement sur le parking"
			}
			else{
				Write-Host "Heure d'arrivée :" $tabClient[$k][1] "| Immatriculation :" $tabClient[$k][0] "| Heure de départ :" $tabClient[$k][2]
			}
		}
	}
    elseif($option -eq 3){
        #Calcul de la durée de stationnement en heure :
        $paiement=0
        $facture=0
        [string]$immatriculation=Read-Host "Récupération de la plaque d'immatriculation"
        $heure_Dep=Get-Date
        for($i=$tabClient.Length-1;$i -ge 0;$i--){
            if($tabClient[$i][0] -eq $immatriculation -and $tabClient[$i][2] -eq [DateTime]0){
                $recup_Heure_Arr=$tabClient[$i][1]
                $tabClient[$i][2]=$heure_Dep
            }
        }
        $heure_Diff=$heure_Dep-$recup_Heure_Arr
        $heure_Diff=$heure_Diff.Seconds
        $heure_Diff=$heure_Diff/3600
        #Calcul de la facture :
        if($heure_Diff*60 -lt 30){
            $facture=1.20
        }
        elseif($heure_Diff*60 -lt 60 -and $heure_Diff*60 -ge 30){
            $facture=1.70
        }
        else{
            $facture=2*$heure_Diff
        }
        while($paiement -lt $facture){
            $argent=Read-Host "Veuillez insérer" ($facture-$paiement) "euro(s)"
            $paiement=$paiement+$argent
        }
        #Rendu monnaie éventuel :
        $rendu=$facture-$paiement
        $rendu=[Math]::Abs($rendu)
        Write-Host "Votre rendu monnaie est de" $rendu "euro(s)"
        Write-Host "Merci, au revoir !"
    }
    elseif($option -eq 4){
        $mdpUtilisateur=Read-Host "Entrez le mot de passe d'administrateur"
    }
}

Write-Host "Le parking est fermé"