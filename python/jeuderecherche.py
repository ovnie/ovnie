#Auteur : Josselin Fatah-Roux
#Devinez un nombre entre 0 et 100 :

#Importation du module random :
import random

#Initialisation des variables :
nb_hasard=random.randint(0,100)
nb_joueur=int(input("Entrez un nombre entre 0 et 100 : "))
compteur=0

while nb_joueur!=nb_hasard:
    if nb_joueur>=0 and nb_joueur<=100:
        if nb_joueur<nb_hasard:
            print("Choississez un nombre plus grand : ")
        elif nb_joueur>nb_hasard:
            print("Choississez un nombre plus petit : ")
        nb_joueur=int(input("Entrez un nombre entre 0 et 100 : "))
        compteur+=1 #compteur=compteur+1
    else:
        print("Veuillez choisir un nombre entre 0 et 100 !")
        nb_joueur=int(input("Entrez un nombre entre 0 et 100 : "))

print("Félicitation vous avez trouvés le bon nombre",nb_joueur,"en",compteur,"coup")