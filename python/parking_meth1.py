#Auteur : Josselin Fatah-Roux
#Le parking :

#Importation des modules :
import time

#Création de la classe Client :
class Client:
    def __init__(self, immatriculation, heure_Arr, heure_Dep):
        self.immatriculation=immatriculation
        self.heure_Arr=heure_Arr
        self.heure_Dep=heure_Dep

#Initialisation des variables :
mdpAdmin="abc"
mdpUtilisateur=0
option=0
tab_Client=[]

#Tant qu'un administrateur ne ferme pas le parking :
while mdpUtilisateur!=mdpAdmin:
    #Définition du menu :
    option=int(input("1 : Enregistrement du client | 2 - Suivi du tableau des immatriculations | 3 - Paiement | 4 - Fermeture du parking \n Entrez l'option : "))
    if option==1:
        #Récupération de l'immatriculation :
        immatriculation=input("Récupération de la plaque d'immatriculation : ")
        #Vérification que l'immatriculation n'est pas en double :
        doublette=0
        for n in range(0,len(tab_Client),1):
            if tab_Client[n].immatriculation==immatriculation and tab_Client[n].heure_Dep==0:
                doublette=1
        if doublette==1:
            #L'immatriculation existe déjà et la voiture est sur le parking :
            print("Vous ne pouvez pas entrer car votre voiture est déjà sur le parking")
            print("En cas d'ursupation de plaque d'immatriculation veuillez contacter la police en appellant le 16")
        elif doublette==0:
            #Enregistrement du client :
            heure_Arr=time.time()
            heure_Dep=0
            client=Client(immatriculation,heure_Arr,heure_Dep)
            tab_Client.append(client) #équivalent tab_Client+=[client] ou tab_Client=tab_Client+[client]
            print("Votre immatriculation a été enregistrée")
    elif option==2:
        #Suivi du tableau des immatriculations :
        for k in range(0,len(tab_Client),1):
            if tab_Client[k].heure_Dep==0:
                print("Heure d'arrivée :",time.ctime(tab_Client[k].heure_Arr),"| Immatriculation :",tab_Client[k].immatriculation,"| Heure de départ : actuellement sur le parking")
            else:
                print("Heure d'arrivée :",time.ctime(tab_Client[k].heure_Arr),"| Immatriculation :",tab_Client[k].immatriculation,"| Heure de départ :",time.ctime(tab_Client[k].heure_Dep))
    elif option==3:
        #Calcul de la durée de stationnement en heure :
        paiement=0
        facture=0
        immatriculation=input("Récupération de la plaque d'immatriculation : ")
        heure_Dep=time.time()
        for i in range(0,len(tab_Client),1):
            if tab_Client[i].immatriculation==immatriculation and tab_Client[i].heure_Dep==0:
                tab_Client[i].heure_Dep=heure_Dep
                recup_Heure_Arr=tab_Client[i].heure_Arr
        heure_diff=heure_Dep-recup_Heure_Arr
        heure_diff=heure_diff/3600
        #Calcul de la facture :
        if heure_diff*60<30:
            facture=1.20
        elif heure_diff*60<60 and heure_diff*60>=30:
            facture=1.70
        else:
            facture=int(heure_diff)*2
        #Paiement de la facture :
        while paiement<facture:
            argent=float(input("Veuillez insérer "+str(facture-paiement)+" : "))
            paiement=paiement+argent
        #Rendu monnaie éventuel :
        rendu=abs(facture-paiement)
        print("Votre rendu monnaie est de :",rendu,"euro(s)")
        print ("Au revoir ...")
    elif option==4:
       mdpUtilisateur=input("Entrez le mot de passe d'administrateur pour fermer le parking : ")
print ("Fermeture du parking !")