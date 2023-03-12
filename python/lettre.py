#Auteur : Josselin Fatah-Roux
#Calcul le nombre de fois qu'apparaît une lettre dans une chaine de caractère :

chaine=input("Entrez la chaine de caractère : ")
lettre=input("Entrez la lettre recherchée : ")

def occurence(chaine,lettre):
    
    compteur=0
    i=0
    while (i<len(chaine)):
        if(chaine[i]==lettre):
            compteur+=1 #compteur=compteur+1
        i+=1 #i=i+1
    return(compteur)
    
print(occurence(chaine,lettre))