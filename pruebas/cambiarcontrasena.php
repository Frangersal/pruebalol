<?php require_once('../Connections/conamatenlinea.php');
session_start();

$unixtime = time();
$alumno = $_SESSION['sesionalumno'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM alumnos WHERE matricula = '$alumno'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$idoriginal = $row_Recordset1['id'];
$imagenoriginal = $row_Recordset1['imagen'];
$nombrealumnooriginal = $row_Recordset1['nombrealumno'];
$apellidopaternooriginal = $row_Recordset1['apellidopaterno'];
$apellidomaternooriginal = $row_Recordset1['apellidomaterno'];
$correooriginal = $row_Recordset1['correo'];
$contrasenaoriginal = $row_Recordset1['contrasena'];
$recontrasena = $row_Recordset1['confirmarcontrasena'];


$nombrealumno = addslashes(addslashes(trim($_POST['nombrealumno'])));
$apellidopaterno = addslashes(addslashes(trim($_POST['apellidopaterno'])));
$apellidomaterno = addslashes(addslashes(trim($_POST['apellidomaterno'])));
$correo = addslashes(addslashes(trim($_POST['correo'])));
$contrasena = addslashes(addslashes(trim($_POST['contrasena'])));
$confirmarcontrasena = addslashes(addslashes(trim($_POST['confirmarcontrasena'])));
$imagen = addslashes(addslashes(trim($_POST['imagen'])));


if ($nombrealumno == "") $nombrealumno = $nombrealumnooriginal;

if ($apellidopaterno == "") $apellidopaterno = $apellidopaternooriginal;

if ($apellidomaterno == "") $apellidomaterno = $apellidomaternooriginal;

if ($correo == "") $correo = $correooriginal; 

if ($contrasena == "") $contrasena = $contrasenaoriginal;

if ($imagen == "") $imagen = $imagenoriginal;


	if ($contrasena != "")  {		

        mysql_query("UPDATE alumnos SET nombrealumno = '$nombrealumno', apellidopaterno = '$apellidopaterno', apellidomaterno = '$apellidomaterno', correo = '$correo', contrasena = '$contrasena', imagen = '$imagen' WHERE matricula = '$alumno'");
                
    } else {

        mysql_query("UPDATE alumnos SET nombrealumno = '$nombrealumno', apellidopaterno = '$apellidopaterno', apellidomaterno = '$apellidomaterno', correo = '$correo', contrasena = '$contrasena', imagen = '$imagen'' WHERE matricula = '$alumno'");
    
    }
  
	header("Location: configuracion.php");

?>

