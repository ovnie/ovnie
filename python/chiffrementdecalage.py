#Auteur : Josselin Fatah-Roux
#Chiffrer une chaine de caractère par le chiffre de César :

chaine=input("Entrez la chaine de caractère à chiffrer : ")
clef=int(input("Entrez la clé de chiffrement : "))

def chiffrement(chaine,clef):
    
    i=0
    chiffrement=""
    while (i<len(chaine)):
        if (chaine[i]==" "):
            chiffrement=chiffrement+chaine[i]
            i+=1 #i+=1
        else:
            decalage=ord(chaine[i])+clef
            if (decalage<=122):
                x=chr(decalage)
                chiffrement+=x #chiffrement=chiffrement+x
                i+=1 #i+=1
            elif (decalage>122):
                y=chr(decalage-26)
                chiffrement+=y #chiffrement=chiffrement+y
                i+=1 #i+=1
    return(chiffrement)
    
print(chiffrement(chaine,clef))