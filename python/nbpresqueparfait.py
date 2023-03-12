#Auteur : Josselin Fatah-Roux
#Les nombres presque parfaits inférieur ou égal à 2 puissance k :

k=int(input("Entrez une valeur pour k : "))

def est_presque_parfait(n):
    som_div=0
    diviseur=1
    while (diviseur<n):
        if ((n%diviseur)==0):
           som_div+=diviseur #som_div=som_div+diviseur
        diviseur+=1 #diviseur=diviseur+1
    return(som_div==(n-1) or som_div==(n+1))

def affiche_est_presque_parfait(k):
    a=1
    liste_nbpresqueparfait=[]
    while (a<=2**k):
        if (est_presque_parfait(a)):
            liste_nbpresqueparfait+=[a] #liste_nbpresqueparfait=liste_nbpresqueparfait+[a]
        a+=1 #a=a+1
    return(liste_nbpresqueparfait)

print(affiche_est_presque_parfait(k))