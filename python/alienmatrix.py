#Module pour information sur le répertoire de travail :
import os

#Récupération du répertoire courant :
path = os.getcwd()
print("Le répertoire courant est : " + path)

#Récupération du nom du répertoire courant :
repn = os.path.basename(path)
print("Le nom du répertoire est : " + repn)

#Module pour transformer image en matrice :
from PIL import Image

mat = [[0] * 200 for _ in range(200)]
image = Image.open("alien_mask.png")
for y in range(200):
    for x in range(200):
        p = image.getpixel((y, x))[0]
        mat[y][x] = p and 1

#Ecriture du résultat dans fichier texte :
fichier = open("alien_1.txt", "w")
fichier.write(str(mat))
fichier.close()

#Module pour nombre aléatoire sur le répertoire de travail :
import random

#Remplacement des 0 par des chiffres entre 2 et 9 :
for y in range(200):
    for x in range(200):
        if mat[y][x] == 0:
            mat[y][x] = random.randint(2,9)

#Ecriture du résultat dans fichier texte :
fichier = open("alien_2.txt", "w")
fichier.write(str(mat))
fichier.close()
