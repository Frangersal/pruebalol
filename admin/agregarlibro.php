<?php require_once('../Connections/conamatenlinea.php'); 
session_start();

$usuario = $_SESSION['usuario'];

date_default_timezone_set('America/Mexico_City');
$fecha=date("d/m/Y");
$h=date("Hi");
$unixtime = time();

$titulo = $_POST['titulo'];

$archivo = basename($_FILES['archivo']['name']);

$targetPath = "../libros/";

	$tempFile = $_FILES["archivo"]["tmp_name"];
	$numero1 = substr(md5(rand(0,9999)), 17, /*Numero de Digitos*/5);
    $name1 = date("dmY").$numero1.$h."1";
	$ext = pathinfo($archivo, PATHINFO_EXTENSION);  //figures out the extension
	$newFileName1 = $name1.".".$ext;
	$targetFile =  $targetPath . $newFileName1;
	
   move_uploaded_file($tempFile, $targetFile);
   
   mysql_select_db($database_conamatenlinea, $conamatenlinea);

   echo json_encode(array("mensaje1" => "completo", "mensaje2" => "Se han guardado los cambios"));

   mysql_query("INSERT INTO biblioteca(titulo, archivo) VALUES('$titulo', '$newFileName1')");

   mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Agregó un libro', '$unixtime')"); 

?>
