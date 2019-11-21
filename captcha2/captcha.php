<?php //Inicio de sesión
session_start();
$_SESSION['keyreg'] = NULL;
//Creación de cadena aleatoria
$md5 = md5(microtime() * mktime());
/*
No necesitamos 32 caracteres (generados anteriormente) y por lo tanto reducimos a 5
*/
$string = substr($md5,0,5);

/*
Creamos una imagen partiendo de una de fondo (debemos subir una imagen de fondo al servidor)
*/
$captcha = imagecreatefrompng("captcha.png");
/*
Configuramos los colores usados para generan las lineas (formato RGB)
*/
$black = imagecolorallocate($captcha, 255,255,255);
$line = imagecolorallocate($captcha,255,255,255);
/*
Añadimos algunas lineas a nuestra imagen para dificultar la tarea a los robots
*/
imageline($captcha,0,5,100,59,$line);
imageline($captcha,30,5,6,59,$line);
imageline($captcha,120,5,74,59,$line);

$font = "./verdana.ttf";

/*
Ahora escribimos la cadena generada aleatoriamente en la imagen
*/
imagettftext($captcha, 22, 5, 15, 30, $black, $font, $string);
/*
Encriptamos y almacenamos el valor en una variable de sesion
*/
$_SESSION['keyreg'] = $string;
/*
Devolvemos la imagen para mostrarla
*/

header("Content-type: image/png" ) ;  
imagepng($captcha); 

?>