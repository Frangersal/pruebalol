<?php require_once('../Connections/comercenter.php'); 

session_start();
$user = $_SESSION['MM_Username'];
$error = "";
$mensaje2 = "";

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


if ($error == '') {  
  
mysql_query("UPDATE clientes SET estado = '3' WHERE id = '$idcliente'");

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario) VALUES('$ip', '$idcliente', 'Eliminó cuenta', '$time', 'página', '$idcliente')");

echo json_encode(array("mensaje1" => "completo"));

} else {

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Intentó eliminar cuenta', '$time', 'página', '$idcliente', '$error')");

echo json_encode(array("mensaje1" => "error", "mensaje2" => $error));

}

mysql_close($comercenter);

?>