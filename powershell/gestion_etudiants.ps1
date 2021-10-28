#Auteur : Josselin Fatah-Roux
#Gestion des étudiants en fonction de leur moyenne :

#Nettoyage de l'invite commande :
Clear-Host

#Classe :
class Etudiant{

    #Propriétés|Attributs :
    [String]$prenom
    [String]$nom
    [String]$sexe
    [Decimal]$moyenne

    #Constructeur :
    Etudiant ([String]$prenom,[String]$nom,[String]$sexe,[Decimal]$moyenne){
        $this.prenom=$prenom
        $this.nom=$nom
		$this.sexe=$sexe
        $this.moyenne=$moyenne
    }
	
	#Méthode qui affiche les informations de l'étudiant :
	[Void] displayInfo(){
	    Write-Host("Prénom de l'étudiant : {0} | Nom de l'étudiant : {1} | Sexe de l'étudiant : {2} | Moyenne de l'étudiant : {3}" -f $this.prenom,$this.nom,$this.sexe,$this.moyenne)
	}

    #Méthode qui calcule la moyenne de l'étudiant :
	[Decimal] static moyenneEtudiant([Decimal]$note1,[Decimal]$note2,[Decimal]$note3){
	    $moy=($note1+$note2+$note3)/3
        return $moy
	}

    #Méthode qui permet de créer et donc d'ajouter un étudiant :
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

}

#Initialisation du tableau d'objets :
[System.Collections.ArrayList]$tabEtudiant=@() #[System.Object[]]$tabEtudiant=@()

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