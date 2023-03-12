#Auteur : Josselin Fatah-Roux
#Fait la somme des diviseurs propres d'un nombre entré :

n=int(input("Entrez un nombre : "))

def somme_diviseurs_propres(n):
    som_div=0
    diviseur=1
    while (diviseur<n):
        if ((n%diviseur)==0):
           som_div+=diviseur #som_div=som_div+diviseur
        diviseur+=1 #diviseur=diviseur+1
    return(som_div)
    
print(somme_diviseurs_propres(n))