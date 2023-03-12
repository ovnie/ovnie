#Auteur : Josselin Fatah-Roux
#Les nombres amicaux inférieur ou égal à 2 puissance k :

k=int(input("Entrez une valeur pour k : "))

def som_div_propres(n):
    som_div=0
    diviseur=1
    while (diviseur<n):
        if ((n%diviseur)==0):
           som_div+=diviseur #som_div=som_div+diviseur
        diviseur+=1 #diviseur=diviseur+1
    return(som_div)

def amicaux(n,m):
    return(som_div_propres(n)==m and som_div_propres(m)==n)

def affiche_amicaux(k):
    listeamicaux=[]
    n=1
    while (n<=2**k):
        if(amicaux(n,som_div_propres(n))):
            listeamicaux=listeamicaux+[n]+[som_div_propres(n)]
        n+=1 #n=n+1
    return(listeamicaux)

print(affiche_amicaux(k))