#Auteur : Josselin Fatah-Roux
#Gestion des étudiants en fonction de leur moyenne en précisant ou en ne précisant pas leur sexe :

#Nettoyage de l'invite commande :
Clear-Host

#Classe :
class Etudiant{

    #Propriétés|Attributs :
    [String]$prenom
    [String]$nom
    [String]$sexe
    [Decimal]$moyenne

    #Constructeur qui précise le sexe :
    Etudiant ([String]$prenom,[String]$nom,[String]$sexe,[Decimal]$moyenne){
        $this.prenom=$prenom
        $this.nom=$nom
		$this.sexe=$sexe
        $this.moyenne=$moyenne
    }

    #Constructeur qui ne précise pas le sexe :
    Etudiant ([String]$prenom,[String]$nom,[Decimal]$moyenne){
        $this.prenom=$prenom
        $this.nom=$nom
        $this.moyenne=$moyenne
    }
	
	#Méthode qui affiche les informations de l'étudiant en précisant le sexe :
	[Void] displayInfo(){
	    Write-Host("Prénom de l'étudiant : {0} | Nom de l'étudiant : {1} | Sexe de l'étudiant : {2} | Moyenne de l'étudiant : {3}" -f $this.prenom,$this.nom,$this.sexe,$this.moyenne)
	}

    #Méthode qui affiche les informations de l'étudiant sans préciser le sexe :
	[Void] displayInfoWithoutSexe(){
	    Write-Host("Prénom de l'étudiant : {0} | Nom de l'étudiant : {1} | Moyenne de l'étudiant : {2}" -f $this.prenom,$this.nom,$this.moyenne)
	}

    #Méthode qui calcule la moyenne de l'étudiant :
	[Decimal] static moyenneEtudiant([Decimal]$note1,[Decimal]$note2,[Decimal]$note3){
	    $moy=($note1+$note2+$note3)/3
        return $moy
	}

    #Méthode qui permet de créer et donc d'ajouter un étudiant en précisant le sexe :
	[Etudiant] static creerEtudiant(){
	    [String]$prenom_etudiant=Read-Host "Quel est le prénom de l'étudiant ?"
        [String]$nom_etudiant=Read-Host "Quel est le nom de l'étudiant ?"
        [String]$sexe_etudiant=Read-Host "Quel est le sexe de l'étudiant ?"
        [Decimal]$note1=Read-Host "Quel est sa première note ?"
        [Decimal]$note2=Read-Host "Quel est sa deuxième note ?"
        [Decimal]$note3=Read-Host "Quel est sa troisième note ?"
        $etudiant=[Etudiant]::new($prenom_etudiant,$nom_etudiant,$sexe_etudiant,[Etudiant]::moyenneEtudiant($note1,$note2,$note3))
        $etudiant.displayInfo()
        return $etudiant
	}

    #Méthode qui permet de créer et donc d'ajouter un étudiant sans préciser le sexe :
	[Etudiant] static creerEtudiantWithoutSexe(){
	    [String]$prenom_etudiant=Read-Host "Quel est le prénom de l'étudiant ?"
        [String]$nom_etudiant=Read-Host "Quel est le nom de l'étudiant ?"
        [Decimal]$note1=Read-Host "Quel est sa première note ?"
        [Decimal]$note2=Read-Host "Quel est sa deuxième note ?"
        [Decimal]$note3=Read-Host "Quel est sa troisième note ?"
        $etudiant=[Etudiant]::new($prenom_etudiant,$nom_etudiant,[Etudiant]::moyenneEtudiant($note1,$note2,$note3))
        $etudiant.displayInfo()
        return $etudiant
	}
    
    #Méthode qui permet de créer une liste d'étudiant en précisant le sexe :
    [System.Collections.ArrayList] static creerListeEtudiant(){
        #Initialisation du tableau d'objets :
        $tabEtudiant=[System.Collections.ArrayList]::new()
        [Int]$option=0

        #Gestion des étudiants :
        Do{
            [Int]$option=Read-Host "1 : Fin du traitement | 2 - Ajouter un étudiant | 3 - Moyenne inférieur à 10 | 4 - Moyenne supérieur à 17 `n Entrez l'option"
            switch ($option){
                1{
                    Write-Host "Fin du traitement"
                }
                2{
                    $tabEtudiant+=[Etudiant]::creerEtudiant()
                }
                3{
                    Foreach($historique in $tabEtudiant){
			            if($historique.moyenne -lt 10){
			                $historique.displayInfo()
                        }
                    }
                }
                4{
                    Foreach($historique in $tabEtudiant){
			            if($historique.moyenne -gt 17){
			                $historique.displayInfo()
                        }
                    }
                }
                Default{
                    Write-Host "Ton option n'est pas bonne, recommence !"
                }
            }
        }While($option -ne 1)

        return $tabEtudiant
    }

    #Méthode qui permet de créer une liste d'étudiant sans préciser le sexe :
    [System.Collections.ArrayList] static creerListeEtudiantWithoutSexe(){
        #Initialisation du tableau d'objets :
        $tabEtudiant=[System.Collections.ArrayList]::new()
        [Int]$option=0

        #Gestion des étudiants :
        Do{
            [Int]$option=Read-Host "1 : Fin du traitement | 2 - Ajouter un étudiant (sans préciser le sexe) | 3 - Moyenne inférieur à 10 (sans préciser le sexe) | 4 - Moyenne supérieur à 17 (sans préciser le sexe) `n Entrez l'option"
            switch ($option){
                1{
                    Write-Host "Fin du traitement"
                }
                2{
                    $tabEtudiant+=[Etudiant]::creerEtudiantWithoutSexe()
                }
                3{
                    Foreach($historique in $tabEtudiant){
			            if($historique.moyenne -lt 10){
			                $historique.displayInfoWithoutSexe()
                        }
                    }
                }
                4{
                    Foreach($historique in $tabEtudiant){
			            if($historique.moyenne -gt 17){
			                $historique.displayInfoWithoutSexe()
                        }
                    }
                }
                Default{
                    Write-Host "Ton option n'est pas bonne, recommence !"
                }
            }
        }While($option -ne 1)

        return $tabEtudiant
    }

}

$firstListEtudiant=[Etudiant]::creerListeEtudiant()
$firstListEtudiantWithoutSexe=[Etudiant]::creerListeEtudiantWithoutSexe()
$firstListEtudiant
$firstListEtudiantWithoutSexe