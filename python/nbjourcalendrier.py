#Auteur : Josselin Fatah-Roux
#Retourne le nombre de jours à partir de deux paramètres que sont le nom du mois et l'entier correspondant à l'année :

liste_jour=[31,28,31,30,31,30,31,31,30,31,30,31]
liste_mois=['janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre']

annee=int(input("Entrez une année : "))
mois=input("Entrez un mois : ")

def Bissextile(annee):
    if annee%400==0 or (annee%4==0 and annee%100!=0):
        return(True)
    else:
        return(False)

def nombre_de_jours(mois,annee):
    if (Bissextile(annee)==True and mois==liste_mois[1]):
        return(29)
    else:
        i=0
        while (i<len(liste_mois)):
            if (mois==liste_mois[i]):
                return(liste_jour[i])
            i+=1 #i=i+1
            
print(nombre_de_jours(mois,annee))