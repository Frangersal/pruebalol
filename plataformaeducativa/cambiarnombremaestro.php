<?php require_once('../Connections/conamatenlinea.php');
session_start();

$unixtime = time();
$maestro = $_SESSION['sesionmaestro'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM maestros WHERE usuario = '$maestro'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$idoriginal = $row_Recordset1['id'];
$imagenoriginal = $row_Recordset1['imagen'];
$nombremaestrooriginal = $row_Recordset1['nombre'];
$correooriginal = $row_Recordset1['correo'];
$contrasenaoriginal = $row_Recordset1['contrasena'];

$nombremaestro = addslashes(addslashes(trim($_POST['nombremaestro'])));
$correo = addslashes(addslashes(trim($_POST['correo'])));
$contrasena = addslashes(addslashes(trim($_POST['contrasena'])));
$imagen = addslashes(addslashes(trim($_POST['imagen'])));

if ($nombremaestro == "") $nombremaestro = $nombremaestrooriginal;
if ($correo == "") $correo = $correooriginal; 
if ($contrasena == "") $contrasena = $contrasenaoriginal;
if ($imagen == "") $imagen = $imagenoriginal;


	if ($nombremaestro != "")  {		

        mysql_query("UPDATE maestros SET nombre = '$nombremaestro', correo = '$correo', contrasena = '$contrasena', imagen = '$imagen' WHERE id = '$maestro'");
                
    } else {
		
        mysql_query("UPDATE alumnos SET nombre = '$nombremaestro', correo = '$correo', contrasena = '$contrasena', imagen = '$imagen' WHERE id = '$maestro'");
    
    }
 
?>