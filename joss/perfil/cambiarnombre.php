<?php require_once('../Connections/comercenter.php'); 

session_start();
$user = $_SESSION['MM_Username'];
$error = "";

if ($user == "") {

$error = "Por favor vuelve a entrar a la página";

}

if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    elseif (isset($_SERVER['HTTP_VIA'])) {  
       $ip = $_SERVER['HTTP_VIA'];  
    }  
    elseif (isset($_SERVER['REMOTE_ADDR'])) {  
       $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    else {  
       $ip = "unknown";
    }

date_default_timezone_set('America/Mexico_City');
$fecha=date("d/m/Y");
$h=date("Hi");
$time = time();
$time1 = strtotime('+3 months', $time);

$idcliente = $_POST['idcliente'];

mysql_select_db($database_comercenter, $comercenter);

if ($idcliente != '') {

$query_Recordset4 = "SELECT * FROM clientes WHERE id = '$idcliente' AND estado = '1'";
$Recordset4 = mysql_query($query_Recordset4, $comercenter) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

if ($totalRows_Recordset4 == 0) {

$error = "El cliente no existe o está suspendido";

}

}

if ($error == "") {

$cambionombre = $row_Recordset4['cambionombre'];

if ($cambionombre != '') {

$cambionombre1 = strtotime('+3 months', $cambionombre);

if ($cambionombre1 > $time) {

$error = "Sólo puedes cambiar tu nombre 1 vez cada 3 meses";

}

}

}

if ($error == '') {

$nuevonombre = addslashes(trim($_POST['nuevonombre']));

$query_Recordset5a = "SELECT * FROM clientes WHERE nombre = '$nuevonombre' AND id = '$idcliente'";
$Recordset5a = mysql_query($query_Recordset5a, $comercenter) or die(mysql_error());
$row_Recordset5a = mysql_fetch_assoc($Recordset5a);
$totalRows_Recordset5a = mysql_num_rows($Recordset5a);

if ($totalRows_Recordset5a > 0) {

$error = "El nombre es el mismo que ya tienes";

}

}

if ($error == '') {

$query_Recordset5 = "SELECT * FROM clientes WHERE nombre = '$nuevonombre' AND id != '$idcliente'";
$Recordset5 = mysql_query($query_Recordset5, $comercenter) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

if ($totalRows_Recordset5 > 0) {

$error = "Ese nombre ya existe, por favor elige otro";

}

}


if ($error == '') {

$nombreoriginal = addslashes($_POST['nombreoriginal']);
$nuevonombre1 = trim($_POST['nuevonombre']);

$url = strtolower($nuevonombre1);
$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
$repl = array('a', 'e', 'i', 'o', 'u', 'n');
$url = str_replace ($find, $repl, $url);

$find = array(' ', '&', '\r\n', '\n', '+'); 
$url = str_replace ($find, '', $url);
$find = array('/[^a-z0-9\-<>]/', "/[\-]+/", "/<['^>\"]*>/");
$repl = array('', '', '');
$url = preg_replace ($find, $repl, $url);
  
mysql_query("UPDATE clientes SET nombre = '$nuevonombre', link = '$url', cambionombre = '$time' WHERE id = '$idcliente'");
 
$nuevonombre1 = stripslashes(stripslashes(strtoupper($nuevonombre)));

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, nombreusuario, comentarios) VALUES('$ip', '$idcliente', 'Modificó nombre', '$time', 'página', '$idcliente', '$nuevonombre', '$nombreoriginal')");

echo json_encode(array("mensaje1" => "completo", "mensaje2" => $nuevonombre1));

} else {

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, nombreusuario, comentarios) VALUES('$ip', '$idcliente', 'Intentó modifcar nombre', '$time', 'página', '$idcliente', '$nuevonombre', '$error')");

echo json_encode(array("mensaje1" => "error", "mensaje2" => $error));

}

mysql_close($comercenter);

?>