#Auteur : Josselin Fatah-Roux
#Fonction qui retourne un booléen pour savoir si une année est bissextile :

annee=int(input("Entrez une année : "))

def Bissextile(annee):
    if annee%400==0 or (annee%4==0 and annee%100!=0):
        return(True)
    else:
        return(False)

print(Bissextile(annee))