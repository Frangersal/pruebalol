<?php require_once('../Connections/comercenter.php'); 

session_start();
$user = $_SESSION['MM_Username'];
$error = "";
$mensaje2 = "";
$error2 = "";

if ($user == "") {

$error = "Por favor vuelve a entrar a la página";
$error2 = "reload";

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

$idcliente = $_POST['idcliente'];
$idperfil = $_POST['idperfil'];
$tipo = $_POST['tipo'];
$reporte = addslashes(addslashes(trim($_POST['reporte'])));

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

if ($idperfil != '') {

$query_Recordset5 = "SELECT * FROM clientes WHERE id = '$idperfil'";
$Recordset5 = mysql_query($query_Recordset5, $comercenter) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

if ($totalRows_Recordset5 == 0) {

$error = "El cliente al que intentas reportar no existe";

}

}


if ($error == '') {

$remitente = $row_Recordset4['nombre'];
$destinatario = $row_Recordset5['nombre'];

$from = "Comercenter <info@comercenter.com.mx>";
$to = "murueta@hotmail.com";

$subject = utf8_encode("=?UTF-8?B?".base64_encode($remitente." ha hecho un reporte de cliente") . "?=");

$body = "Hola:<br/><br/>";
$body .= $remitente." ha enviado el siguiente reporte sobre ".$destinatario." en Comercenter.<br/><br/>";
$body .= '<div style="width:80%; float:left; border: solid 1px #ccc; line-height:20px; padding:10px; border-radius:7px; font-size:12px; font-weight:bold;">'.stripslashes(stripslashes(nl2br($reporte))).'</div>';

$headers = "From: ".$from. "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";

mail($to, $subject, $body, $headers);

mysql_query("INSERT INTO reportes(idremitente, idreportado, tipo, descripcion, estado, fecha) VALUES('$idcliente', '$idperfil', '$tipo', '$reporte', 'abierto', '$time')");

$lastid = mysql_insert_id();

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Reportó', '$time', 'página', '$idperfil', '$lastid')");

echo json_encode(array("mensaje1" => "completo"));


} else {

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Intentó enviar un reporte', '$time', 'página', '$idperfil', '$error')");

echo json_encode(array("mensaje1" => "error", "mensaje2" => $error, "mensaje3" => $error2));

}

mysql_close($comercenter);

?>