<?php require_once('../Connections/conamatenlinea.php');

session_start();

$unixtime = time();
$usuario = $_SESSION['usuario'];

if ($usuario == "") {
    
    header("Location: login.php");
	exit;

}

$id = $_GET['id'];

if ($id != '') {

mysql_select_db($database_conamatenlinea, $conamatenlinea);
mysql_query("DELETE FROM usuarios WHERE id = '$id'"); 

mysql_query("INSERT INTO actividad(accion, usuario, fecha) VALUES( 'Eliminar usuario', '$usuario', '$unixtime')"); 



}


header("Location: usuarios.php");
exit;

?>
