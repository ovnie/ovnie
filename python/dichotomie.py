#Auteur : Josselin Fatah-Roux
#Nombre aléatoire entre 0 et 100 qui doit être retrouvé par dichotomie :

#Importation du module random :
import random

#Initialisation des variables :
lenombre=random.randint(0,100)
print("Le nombre à trouver est :",lenombre)
commencement=50
borneinf=0
bornesup=100
compteur=0

while commencement!=lenombre:
    if commencement<lenombre:
        if borneinf<0:
            borneinf=0
        if commencement>borneinf:
            borneinf=commencement
        commencement=commencement+int((bornesup-commencement)/2) #commencement=bornesup-int((bornesup-commencement)/2)
        print(commencement)
        compteur+=1 #compteur=compteur+1
    if commencement>lenombre:
        if bornesup>100:
            bornesup=100
        if commencement<bornesup:
            bornesup=commencement
        commencement=commencement-int((commencement-borneinf)/2) #commencement=borneinf+int((commencement-borneinf)/2)
        print(commencement)
        compteur+=1 #compteur=compteur+1
        
print("Le nombre trouvé par dichotomie est",commencement,"en",compteur,"coups")