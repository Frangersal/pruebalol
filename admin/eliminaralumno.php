<?php require_once('../Connections/conamatenlinea.php');

session_start();
$unixtime = time();
$usuario = $_SESSION['usuario'];

if ($usuario == "") {
    
    header("Location: login.php");
	exit;

}
mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset7 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset7 = mysql_query($query_Recordset7, $conamatenlinea) or die(mysql_error());
$row_Recordset7 = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7); 

$permiso = $row_Recordset7['permiso'];

if ($permiso == 2) {

header("Location: index.php");
exit;

}


$id = $_GET['id'];

if ($id != '') {

$query_Recordset1 = "SELECT * FROM alumnos WHERE id = '$id'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

$imagen = $row_Recordset1['imagen'];

if ($imagen != "" || $imagen != NULL) {

    unlink("../images/" . $imagen);

}
    

mysql_query("DELETE FROM alumnos WHERE id = '$id'"); 

mysql_query("INSERT INTO actividad(accion, usuario, fecha) VALUES( 'Eliminó alumno', '$usuario', '$unixtime')"); 

}

header("Location: alumnos.php");
exit;

?>
