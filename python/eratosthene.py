#Auteur : Josselin Fatah-Roux
#Crible d'Ératosthène pour une valeur n donnée :

n=int(input("Entrez une valeur pour n : "))

def crible(n):
    liste_nb_premier=[]
    Liste_nb=list(range(0,n,1)) #Liste_nb=[0,1,2,3,...,n-1].
    i=2 #On commence par enlever les multiples de 2.
    while (i<n):
        j=i+i
        while (j<n): #Remplacement des multiples par 0.
            Liste_nb[j]=0
            j=j+i
        i=i+1 #On cherche le nombre premier suivant et on remplace ses multiples par 0.
        while (i<n and Liste_nb[i]==0):
            i=i+1 #Si la valeur est zéro on n'y touche pas et on passe à la suivante.
    k=0
    while (k<len(Liste_nb)): #On revisite Liste_nb pour enlever les éléments 0.
        if (Liste_nb[k]!=0 and Liste_nb[k]!=1):
            liste_nb_premier=liste_nb_premier+[Liste_nb[k]]
        k=k+1
    return(liste_nb_premier)
    
print(crible(n))