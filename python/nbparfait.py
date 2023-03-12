#Auteur : Josselin Fatah-Roux
#Les nombres parfaits inférieur ou égal à 2 puissance k :

k=int(input("Entrez une valeur pour k : "))

def est_parfait(n):
    som_div=0
    diviseur=1
    while (diviseur<n):
        if ((n%diviseur)==0):
           som_div+=diviseur #som_div=som_div+diviseur
        diviseur+=1 #diviseur=diviseur+1
    return(som_div==n)

def affiche_parfait(k):
    a=1
    liste_nbparfait=[]
    while (a<=2**k):
        if (est_parfait(a)):
            liste_nbparfait+=[a] #liste_nbparfait=liste_nbparfait+[a]
        a+=1 #a=a+1
    return(liste_nbparfait)

print(affiche_parfait(k))