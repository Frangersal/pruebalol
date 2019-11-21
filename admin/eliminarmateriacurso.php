<?php require_once('../Connections/conamatenlinea.php');
session_start();
if ($_SESSION['usuario'] == "") {
    
    header("Location: login.php");

}else{

    $usuario = $_SESSION['usuario'];
    $unixtime = time();
}

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$permiso = $row_Recordset2['permiso'];

if ($permiso == 2) {

header("Location: index.php");
exit;

}

$id = $_GET['id'];

if ($id != '') {

	mysql_select_db($database_conamatenlinea, $conamatenlinea);
	$query_Recordset1 = "SELECT * FROM materiascurso2 WHERE id = '$id'";
	$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

	$imagen = $row_Recordset1['imagen'];
	$portada = $row_Recordset1['portada'];

	if ($imagen != "" || $imagen != NULL) {

    	unlink("../images/" . $imagen);

	}
	
	if ($portada != "" || $portada != NULL) {
	
		unlink("../images/" . $portada);
	}
	
	mysql_select_db($database_conamatenlinea, $conamatenlinea);
	mysql_query("DELETE FROM materiascurso2 WHERE id = '$id'"); 

	mysql_query("INSERT INTO actividad(accion, usuario, fecha) VALUES( '$usuario', 'Eliminó una materia del curso', '$unixtime')"); 

}

header("Location: materias1.php");
exit;

?>
