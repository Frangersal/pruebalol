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
$time1 = strtotime('+3 months', $time);

$idcliente = $_POST['idcliente'];
$idperfil = $_POST['idperfil'];
$tema = addslashes(addslashes(trim($_POST['tema'])));
$mensaje = addslashes(addslashes(trim($_POST['mensaje'])));

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

$query_Recordset5 = "SELECT * FROM clientes WHERE id = '$idperfil' AND estado = '1'";
$Recordset5 = mysql_query($query_Recordset5, $comercenter) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

if ($totalRows_Recordset5 == 0) {

$error = "El cliente al que intentas mandar mensaje no existe o está suspendido";

}

}


if ($error == '') {

$remitente = $row_Recordset4['nombre'];
$destinatario = $row_Recordset5['nombre'];
$email1 = $row_Recordset5['email'];
$emailelegido = $row_Recordset5['emailelegido'];

if ($emailelegido == "") $email = $email1;
else if ($emailelegido != "") $email = $emailelegido;

$from = "Comercenter <info@comercenter.com.mx>";
$to = $email;

$subject = utf8_encode("=?UTF-8?B?".base64_encode($remitente." te ha enviado un mensaje en Comercenter") . "?=");

$body = "Hola ".$destinatario.":<br/><br/>";
$body .= $remitente." te ha enviado el siguiente mensaje en Comercenter.<br/><br/>";
$body .= '<div style="width:80%; float:left; border: solid 1px #ccc; line-height:20px; padding:10px; border-radius:7px; font-size:12px; font-weight:bold;">Asunto: '.$tema.'<br/><br/>'.stripslashes(stripslashes(nl2br($mensaje))).'</div>';
$body .= '<div style="display:block; float:left; margin-top:20px; font-weight:300; padding-left:10px;">Para leerlo y contestarle ve a tu perfil en <a href="https://comercenter.com.mx" target="_blank">Comercenter</a>.</div>';

$headers = "From: ".$from. "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";

mail($to, $subject, $body, $headers);

mysql_query("INSERT INTO mensajes(idremitente, iddestinatario, tema, mensaje, estadoremitente, estadodestinatario, fecha) VALUES('$idcliente', '$idperfil', '$tema', '$mensaje', '1', '1', '$time')");

$lastid = mysql_insert_id();

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Envió mensaje', '$time', 'página', '$idperfil', '$lastid')");

echo json_encode(array("mensaje1" => "completo"));


} else {

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Intentó enviar un mensaje', '$time', 'página', '$idperfil', '$error')");

echo json_encode(array("mensaje1" => "error", "mensaje2" => $error, "mensaje3" => $error2));

}

mysql_close($comercenter);

?>