<?php require_once('../Connections/conamatenlinea.php');

session_start();
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

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM biblioteca WHERE id = '$id'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$archivoactual = $row_Recordset2['archivo'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);

if($archivoactual != "") {

    unlink("../libros/" . $archivoactual);

}

mysql_query("DELETE FROM biblioteca WHERE id = '$id'"); 

mysql_query("INSERT INTO actividad(accion, usuario, fecha) VALUES( 'Eliminó libro', '$usuario', '$unixtime')"); 

}

header("Location: biblioteca.php");
exit;

?>
