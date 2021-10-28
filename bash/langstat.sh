#!/bin/bash
#Auteur : Josselin Fatah-Roux
#Compte pour chaque lettre de l'alphabet le nombre de mots - contenus dans un fichier texte - qui la comporte :

#On récupère le chemin absolu du fichier "dico.txt" s'il existe, sinon on obtient une chaîne de caractère vide :
chemin=$(sudo find /home -name $1)
echo "Le chemin du fichier est : $chemin"

#On créer ou efface le contenu du fichier statistiques.txt :
echo '' > statistiques.txt

#On vérifie que find renvoie bien un résultat (chaîne de caractère), -z confirme si la chaîne de caractère est vide :
if [ -z "$chemin" ]
then
	#Dans le cas où la chaine de caractère est vide on le précise et on arrête le script :
	echo "Le fichier n'existe pas et/ou ne se situe pas dans le répertoire /home"
else
	#Création d'un tableau alphabétique :
	alphabet=('A' 'B' 'C' 'D' 'E' 'F' 'G' 'H' 'I' 'J' 'K' 'L' 'M' 'N' 'O' 'P' 'Q' 'R' 'S' 'T' 'U' 'V' 'W' 'X' 'Y' 'Z')
	#${alphabet[*]} affiche le tableau alphabet en entier :
	echo "L'alphabet est : ${alphabet[*]}"
	#${#alphabet[*]} affiche le nombre d'éléments dans le tableau :
	echo "L'alphabet contient : ${#alphabet[*]} lettres"
	#On soustrait 1 à ${#alphabet[*]} car le premier indice d'un tableau est 0 :
	for i in $(seq 0 $((${#alphabet[*]} - 1)))
	do
		#On calcul le nombre de mots contenant la lettre de l'alphabet actuellement traitée  dans la boucle :
		compteurs[$i]=$(grep ${alphabet[$i]} $chemin | wc -l)
		#On enregistre les statistiques au fur et à mesure de l'évolution de la boucle dans un fichier texte :
		echo "${compteurs[$i]} - ${alphabet[$i]}" >> statistiques.txt
	done
	echo "Les statistiques pour chaque lettre sont respectivement :"
	#On vérifie que le deuxième paramètre --description existe et on le fait jouer s'il existe :
	if [ $# -ge 2 ] && [ $2 = '--description' ]
	then
		#Si le deuxième paramètre existe alors on remplace dans le fichier statistiques.txt pour chaque ligne le caractère - par la chaîne de caractère : mot(s) contenant la lettre :
		sed -i 's/-/mot(s) contenant la lettre/g' statistiques.txt
		#Puis on trie numériquement par ordre décroissant les données du fichier statistiques.txt :
		sort -nr statistiques.txt
	else
		#Si le deuxième paramètre n'existe pas alors on trie uniquement numériquement par ordre décroissant les données du fichier statistiques.txt :
		sort -nr statistiques.txt
	fi
fi

#On supprime le fichier statistiques.txt :
rm statistiques.txt