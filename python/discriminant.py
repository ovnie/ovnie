#Auteur : Josselin Fatah-Roux
#Fonction qui calcule le discriminant et les solutions d'une équation du second degré :

a=int(input("Entrez une valeur a pour l'équation de la forme ax^2+bx+c : "))
b=int(input("Entrez une valeur b pour l'équation de la forme ax^2+bx+c : "))
c=int(input("Entrez une valeur c pour l'équation de la forme ax^2+bx+c : "))

def discriminant(a,b,c):
    delta=b**2-4*a*c #delta=b*b-4*a*c
    print("Le discriminant vaut :",delta)

    if (delta>0):
        x=(-b-delta**(1/2))/(2*a)
        m=(-b+delta**(1/2))/(2*a)
        print("Il existe 2 racines distinctes :",x,"et",m)
        return [x,m]
    if (delta==0):
        k=(-b)/(2*a)
        print("Il exite une unique solution réelle :",k)
        return [k]
    if (delta<0):
        print("Il n'existe aucune solution réelle.")
        return [None]
        
print(discriminant(a,b,c))