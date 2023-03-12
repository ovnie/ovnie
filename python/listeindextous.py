#Auteur : Josselin Fatah-Roux
#Fonction qui prend deux paramètres, une liste et un élément à chercher dans la liste, et qui retourne tous les index référençant l'élément dans la liste :

chaine=input("Entrez une chaine de caractère : ")
liste=list(chaine)
elt=input("Entrez l'élément à recherché : ")

def liste_index_tous(liste,elt):

    i=0
    liste_index=[]
    while(i<len(liste)):
        if (liste[i]==elt):
            liste_index+=[i] #liste_index=liste_index+[i]
        i+=1 #i=i+1
    return(liste_index)

print(liste_index_tous(liste,elt))