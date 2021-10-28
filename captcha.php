<?php
session_start(); //On ouvre la session.
$_SESSION['captcha'] = mt_rand(1000,9999); //On définit un nombre aléatoire entre 1000 et 9999.

header ("Content-type: image/png"); //On définit le type de l'image.
$image = imagecreate(80,30); //On créé une image vide de taille 80*30 pixels.

$bg = imagecolorallocate($image, 255, 255, 255); //Le premier appel de imagecolorallocate définit la couleur de fond.
$textcolor = imagecolorallocate($image, 0, 0, 0); //On définit la couleur du texte.
$font = 'ecricap.ttf'; //On définit une police.

imagettftext($image, 16, 0, 17, 22, $textcolor, $font, $_SESSION['captcha']); //On créé l'image en prenant en compte tous les paramètres.

imagepng($image); //On affiche l'image.
imagedestroy($image); //On vide la mémoire utilisée.
?>