<?php require_once('../Connections/comercenter.php'); 

session_start();
$user = $_SESSION['MM_Username'];
$error = "";
$mensaje2 = "";

if ($user == "") {

$error = "Por favor vuelve a entrar a la página";

} else {

mysql_select_db($database_comercenter, $comercenter);
$query_Recordset4 = "SELECT * FROM clientes WHERE email = '$user' AND estado = '1'";
$Recordset4 = mysql_query($query_Recordset4, $comercenter) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

if ($totalRows_Recordset4 == 0) {

$error = "El cliente no existe o está suspendido";

} else {

$idcliente = $row_Recordset4['id'];

}

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
$h=date("Hi");
$time = time();

$id = $_POST['id'];


if ($idcliente != '') {

$query_Recordset5 = "SELECT * FROM mensajes WHERE id = '$id' AND iddestinatario = '$idcliente'";
$Recordset5 = mysql_query($query_Recordset5, $comercenter) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

if ($totalRows_Recordset5 == 0) {

$error = "El mensaje no está disponible";

}

$idremitente = $row_Recordset5['idremitente'];

$query_Recordset6 = "SELECT * FROM clientes WHERE id = '$idremitente' AND estado = '1'";
$Recordset6 = mysql_query($query_Recordset6, $comercenter) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);

if ($totalRows_Recordset6 == 0) {

$error = "El usuario al que quieres responder está suspendido o eliminó su cuenta";

}

$destinatario = stripslashes(stripslashes($row_Recordset4['nombre']));
$nombrerespuesta = stripslashes(stripslashes($row_Recordset6['nombre']));

$fecha =$row_Recordset5['fecha'];

$h = date('G', $fecha);
$mes = date('m', $fecha);
$dia = date('j', $fecha);
$d = date('w', $fecha); 
$m = date("i", $fecha);
$ano = date('Y', $fecha);

if ($d == 0) $di = "Dom";
else if ($d == 1) $di = "Lun";
else if ($d == 2) $di = "Mar";
else if ($d == 3) $di = "Mie";
else if ($d == 4) $di = "Jue";
else if ($d == 5) $di = "Vie";
else if ($d == 6) $di = "Sab";

if ($mes == "01") $mes1 = "Ene";
	else if ($mes == "02") $mes1 = "Feb";
	else if ($mes == "03") $mes1 = "Mar";
	else if ($mes == "04") $mes1 = "Abr";
	else if ($mes == "05") $mes1 = "May";
	else if ($mes == "06") $mes1 = "Jun";
	else if ($mes == "07") $mes1 = "Jul";
	else if ($mes == "08") $mes1 = "Ago";
	else if ($mes == "09") $mes1 = "Sept";
	else if ($mes == "10") $mes1 = "Oct";
	else if ($mes == "11") $mes1 = "Nov";
	else if ($mes == "12") $mes1 = "Dic";

$asunto = "Re: ".$row_Recordset5['tema'];
$asunto1 = $row_Recordset5['tema'];
$mensaje = '<br/><br/><br/><div id="linea" style="width:100%; float:left; height:1px; background-color:#ccc; margin-bottom:20px;"></div><div id="datos" style="float:left; width:100%;"><div id="remitente" style="width:100%; height:30px; line-height:30px; float:left; font-size:20px;"><strong>De:</strong> '. $nombrerespuesta .'</div><div id="destinatario" style="width:100%; height:20px; line-height:20px; float:left; font-size:12px;"><strong>Asunto:</strong> '.$asunto1.'</div><div id="fecha" style="width:100%; height:20px; line-height:20px; float:left; font-size:12px; color:#555;">'. $di.' '. $dia.'/'. $mes1 .'/'. $ano.', '. $h .':'. $m. '</div><div id="destinatario" style="width:100%; height:20px; line-height:20px; float:left; font-size:12px;"><strong>Para:</strong> '.$destinatario.'</div></div><div id="linea" style="width:100%; float:left; height:1px; background-color:#ccc; margin-top:20px; margin-bottom:20px;"></div><div id="datos" style="float:left; width:100%;">'.stripslashes(stripslashes($row_Recordset5['mensaje'])).'</div>';

}


if ($error == '') {  

echo json_encode(array("mensaje1" => "completo", "idperfil" => $idremitente, "asunto" => $asunto, "cuerpo" => $mensaje, "respondiendo" => $nombrerespuesta));

} else {

echo json_encode(array("mensaje1" => "error", "mensaje2" => $error));

}

mysql_close($comercenter);

?>