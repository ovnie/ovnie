#Auteur : Josselin Fatah-Roux
#Fonction qui calcule la factorielle de n (n!) :

n=int(input("Entrez une valeur pour n : "))

def factorielle(n):
    produit=1
    i=2
    while (i<=n):
        produit=produit*i
        i+=1 #i=i+1
    return [produit]
    
print(factorielle(n))