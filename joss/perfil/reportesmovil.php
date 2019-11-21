<?php require_once('../Connections/comercenter.php'); 

session_start();
$user = $_SESSION['MM_Username'];
$error = "";
$mensaje2 = "";
$error2 = "";

mysql_select_db($database_comercenter, $comercenter);

if ($user == "") {

$error = "Por favor vuelve a entrar a la página";
$error2 = "reload";

} else {

$query_Recordset4 = "SELECT * FROM clientes WHERE email = '$user' AND estado = '1'";
$Recordset4 = mysql_query($query_Recordset4, $comercenter) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

if ($totalRows_Recordset4 == 0) {

$error = "Tu cuenta está suspendida";

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
$fecha=date("d/m/Y");
$h=date("Hi");
$time = time();


if ($error == '') {  

$query_Recordset1 = "SELECT * FROM reportes WHERE idremitente = '$idcliente' AND estado = 'abierto' AND respuestaleida IS NULL ORDER BY id DESC";
$Recordset1 = mysql_query($query_Recordset1, $comercenter) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

if ($totalRows_Recordset1 > 0) { do { 

$idreporte = $row_Recordset1['id'];
$reporte = $row_Recordset1['reporte'];
$fecha = $row_Recordset1['fecha'];
$idreportado = $row_Recordset1['idreportado'];
$tipo = $row_Recordset1['tipo'];
$respuesta = $row_Recordset1['respuesta'];

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
	
if ($tipo == "cliente") {

$query_Recordset2 = "SELECT * FROM clientes WHERE id = '$idreportado'";
$Recordset2 = mysql_query($query_Recordset2, $comercenter) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

} else if ($tipo == "tienda") {

$query_Recordset2 = "SELECT * FROM tiendas WHERE id = '$idreportado'";
$Recordset2 = mysql_query($query_Recordset2, $comercenter) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

}

$nombrereportado = $row_Recordset2['nombre'];

?>
<div id="emails" style="width:90%; float:left; border: solid 2px #760204; font-weight:500; margin-left:5%; border-radius:7px; margin-top:20px; padding-bottom:10px;">
     
     <div id="nom" align="left" style="width:96%; font-size:18px; line-height:25px; float:left; margin-left:2%; overflow:hidden; margin-top:5px;">Reportaste a<?php if ($tipo == "cliente") { ?>l cliente <?php } else { ?> la tienda <?php } ?><strong><?php echo $nombrereportado; ?></strong></div>
     
     <div id="fech" align="left" style="width:96%; margin-right:1%; float:left; font-size:14px; margin-left:2%; line-height:20px; overflow:hidden;"><?php echo $di; ?> <?php echo $dia; ?>/<?php echo $mes1; ?>/<?php echo $ano; ?>, <?php echo $h; ?>:<?php echo $m; ?></div>
     
      <div id="tem" align="left" align="center" style="width:90%; margin-left:4%; float:left; margin-top:10px; font-size:14px; line-height:20px; overflow:hidden;"><?php if ($respuesta != '') { 
	  
	  mysql_query("UPDATE reportes SET respuestaleida = 'si' WHERE id = '$idreporte'");
	  
	  ?><strong>Respuesta:</strong><br/><?php echo $respuesta; ?><?php } else { ?>Esperando la respuesta, nos encargaremos del reporte lo más pronto posible.<?php } ?></div>
      
     </div>
<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));  ?>

<?php } else { ?>
<div id="emails" align="center" style="width:100%; float:left; border-bottom:#ccc solid 1px; font-size:16px; line-height:30px;">
No has enviado reportes
     </div>
<?php }
} else {

?>
<script>
alert("<?php echo $error; ?>");
<?php if ($error2 == "reload") { ?>
window.location.href = "/";
<?php } ?>
</script>
<?php
}

mysql_close($comercenter);

?>
