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
$haycontrasena = $_POST['haycontrasena'];
$passwordactual = trim($_POST['password']);
$passwordnuevo = trim($_POST['passwordnuevo']);

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

if ($error == "" && $haycontrasena == "si") {

$query_Recordset3 = "SELECT * FROM clientes WHERE id = '$idcliente' AND password = '$passwordactual'";
$Recordset3 = mysql_query($query_Recordset3, $comercenter) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$password = $row_Recordset3['password'];

if ($totalRows_Recordset3 == 0) {

$error = "Tu contraseña actual no coincide";

}

if ($password == $passwordnuevo) {

$error = "Tu contraseña nueva es igual a la anterior";

}

}



if ($error == '') {
  
mysql_query("UPDATE clientes SET password = '$passwordnuevo' WHERE id = '$idcliente'");

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario) VALUES('$ip', '$idcliente', 'Modificó contraseña', '$time', 'página', '$idcliente')");

echo json_encode(array("mensaje1" => "completo"));

} else {

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Intentó modifcar contraseña', '$time', 'página', '$idcliente', '$error')");

echo json_encode(array("mensaje1" => "error", "mensaje2" => $error));

}

mysql_close($comercenter);

?>