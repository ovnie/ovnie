#Définition de la fonction fragmenter :
def fragmenter(phrase):

    #Récupération de la phrase dans une autre variable :
    recup_Phrase=phrase

    #Calcul la longueur de la chaîne :
    longueur_Chaine=len(recup_Phrase)

    #Initialisation des variables :
    i=0
    construction_Mot=""
    construction_Liste=[]
    
    #Itération pour étude de chaque caractère :
    for i in range(longueur_Chaine):
        caractere=recup_Phrase[i]
        
        #Si le caractère est dans l'aphabet, on concatène pour former le mot :
        if caractere in alphabet_Minuscule or caractere in alphabet_Majuscule:
            construction_Mot+=caractere
            #Si c'est le dernier caractère, on ajoute le mot à la liste :
            if i==(longueur_Chaine-1):
                construction_Liste.append(construction_Mot)
                
        #Sinon dans le cas de la découverte d'un caractère spéciale :
        else:
            #Si c'est le premier caractère, on l'ajoute dans la liste :
            if i==0:
                construction_Liste.append(caractere)
            #Sinon
            else:
                #Si le caractère précédent est spéciale, on ajoute juste le caractère :
                if recup_Phrase[i-1] not in alphabet_Minuscule and recup_Phrase[i-1] not in alphabet_Majuscule:
                    construction_Liste.append(caractere)
                #Dans le cas contraire, on ajoute le mot à la liste puis le caractère spéciale :
                else:
                    construction_Liste.append(construction_Mot)
                    construction_Liste.append(caractere)
                    construction_Mot=""
                    
    return(construction_Liste)

#Définition de la fonction inverser :
def inverser(mot):

    #Calcul la longueur du mot :
    longueur_Mot=len(mot)

    #Initialisation des variables :
    j=0
    concatenation_Inverse=""

    #Itération pour inverser mot :
    for j in range(longueur_Mot):
        concatenation_Inverse+=mot[longueur_Mot-1-j]

    #Déplacement de la majuscule si elle est présente :
    if concatenation_Inverse[longueur_Mot-1].isupper():
        recup_Lettre=""
        recup_Lettre=concatenation_Inverse[0]
        recup_Concatenation_Inverse_Lower=concatenation_Inverse[1:]
        concatenation_Inverse=recup_Lettre.upper()+recup_Concatenation_Inverse_Lower.lower()
    
    return(concatenation_Inverse)

#Définition de la fonction traduire :
def traduire(phrase):

    #On fragmente la phrase avec la fonction fragmenter :
    recup_Liste=fragmenter(phrase)
    print("---------Fragmenter---------")
    print(recup_Liste)

    #Longueur de la liste précedemment créée :
    longueur_Liste=len(recup_Liste)

    #Initialisation des variables :
    k=0
    nouvelle_Liste=[]
    nouvelle_Chaine=""

    #Inversion des mots dans la liste :
    for k in range(longueur_Liste):
        nouvelle_Liste.append(inverser(recup_Liste[k]))
        nouvelle_Chaine+=inverser(recup_Liste[k])

    print("---------Inversion---------")
    print(nouvelle_Liste)
    
    return(nouvelle_Chaine)

#Définition de l'aphalbet :
alphabet_Minuscule=["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"]
alphabet_Majuscule=["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"]

#Exécution interactive :
quitter=""
while quitter!="Q" :

    #Récupération de la phrase :
    phrase=input("Entrez un texte à traduire : ")

    #On vérifie que la phrase est une chaine de caractère :
    if type(phrase)==str:
        recup_Nouvelle_Chaine=traduire(phrase)
        print("---------Traduction---------")
        print(recup_Nouvelle_Chaine)

        #Doit-on traduire le résultat ?
        continuer=input("Voulez-vous traduire le résultat Y/n : ")

        #On traite la réponse :
        if continuer=="Y":
            recup_Nouvelle_Nouvelle_Chaine=traduire(recup_Nouvelle_Chaine)
            print("---------Traduction---------")
            print(recup_Nouvelle_Nouvelle_Chaine)

        #Doit-on continuer ?
        quitter=input("Entrez Q pour quitter ou Entrée pour continuer : ")

    else:
        print("Merci de retaper la phrase")
