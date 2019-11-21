<?php require_once('../Connections/comercenter.php'); 

session_start();
$user = $_SESSION['MM_Username'];
$error = "";
$mensaje2 = "";

mysql_select_db($database_comercenter, $comercenter);

if ($user == "") {

$error = "Por favor vuelve a entrar a la página";

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

$id = $_GET['id'];
$s = $_GET['s'];

if ($error == '') {  

$query_Recordset1 = "SELECT * FROM mensajes WHERE id = '$id' AND estadodestinatario = '1' AND iddestinatario = '$idcliente' OR id = '$id' AND estadoremitente = '1' AND idremitente = '$idcliente' ORDER BY id DESC";
$Recordset1 = mysql_query($query_Recordset1, $comercenter) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

if ($totalRows_Recordset1 > 0) {  

$idmensaje = $row_Recordset1['id'];
$idremitente = $row_Recordset1['idremitente'];
$asunto = stripslashes(stripslashes($row_Recordset1['tema']));
$iddestinatario = $row_Recordset1['iddestinatario'];
$tema = $row_Recordset1['tema'];
$fecha = $row_Recordset1['fecha'];
$mensaje = stripslashes(stripslashes($row_Recordset1['mensaje']));
$leido = $row_Recordset1['leido'];

if ($leido == "" && $iddestinatario == $idcliente) {

mysql_query("UPDATE mensajes SET leido = 'si' WHERE id = '$id'");

}

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

$query_Recordset2 = "SELECT * FROM clientes WHERE id = '$idremitente'";
$Recordset2 = mysql_query($query_Recordset2, $comercenter) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$remitente = $row_Recordset2['nombre'];
$foto = $row_Recordset2['foto'];
$link = $row_Recordset2['link'];

$query_Recordset3 = "SELECT * FROM clientes WHERE id = '$iddestinatario'";
$Recordset3 = mysql_query($query_Recordset3, $comercenter) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$destinatario = $row_Recordset3['nombre'];
$link1 = $row_Recordset3['link'];

?>
<div id="email" style="width:100%; float:left; margin-top:10px; color:#333; position:relative;">

 <div id="fotowrapp" style="width:50px; height:60px; float:left; position:relative; margin-left:10px;">
    
<?php if ($foto != '') { 
   $img = "usuarios/".$foto;
 } else { 
	  
	  $img = "silueta". $sexo1 ."500.jpg";
	  
} ?>
   <?php if ($idcliente != $idremitente) { ?><a href="<?php echo $link; ?>"><?php } ?>
      <div id="foto" align="center" style="width:100%; padding-bottom:100%; border:solid 2px #416BAE; overflow:hidden; border-radius:50%; float:left; position:absolute; background-image:url(../images/<?php echo $img; ?>); background-size:cover;"></div>
     <?php if ($idcliente != $idremitente) { ?></a><?php } ?>
      </div>
<div id="datos" style="float:left; width:calc(100% - 75px); height:100%; margin-left:15px;">

<div id="nom" style="width:100%; height:30px; line-height:30px; float:left; font-size:20px;"><strong>De:</strong><?php if ($idcliente != $idremitente) { ?><a href="<?php echo $link; ?>"><?php } ?><?php echo $remitente; ?><?php if ($idcliente != $idremitente) { ?></a><?php } ?></div>

<div id="destinatario" style="width:100%; height:20px; line-height:20px; float:left; font-size:14px;"><strong>Asunto:</strong> <?php echo $asunto; ?></div>

<div id="fecha" style="width:100%; height:20px; line-height:20px; float:left; font-size:14px; color:#555;"><?php echo $di; ?> <?php echo $dia; ?>/<?php echo $mes1; ?>/<?php echo $ano; ?>, <?php echo $h; ?>:<?php echo $m; ?></div>

<div id="nom" style="width:100%; height:20px; line-height:20px; float:left; font-size:14px;"><strong>Para:</strong> <?php if ($idcliente == $idremitente) { ?><a href="<?php echo $link1; ?>"><?php } ?><?php echo $destinatario; ?><?php if ($idcliente == $idremitente) { ?></a><?php } ?></div>

</div>

<div id="emailres" style="float:left; width:100%; height:40px; margin-top:10px;">
<?php if ($idcliente != $idremitente) { ?>
<input type="hidden" id="tipousuario" name="tipousuario" value="destinatario">
 <a href="javascript:responder('<?php echo $id; ?>');" class="5linka" style="width:calc(50% - 1px); float:left; height:40px;"><div id="responder" style="height:39px; line-height:40px; overflow:hidden; width:100%; float:left;">
 <div id="menuinside" style="display: table; margin: 0 auto;">
 <div id="xxs" style="width:24px; height:20px; float:left; margin-left:20px; margin-top:10px;"><img src="../images/responder.png?id=<?php echo $time; ?>" height="20" /></div>
 
 <div id="xx" align="left" style="height:40px; float:left; line-height:40px; font-size:14px; color:#333; margin-left:15px;">Responder</div>
 </div>
 
 </div></a>
   <div id="linea" style="width:1px; float:left; height:40px; background-color:#333;"></div>
 <a href="javascript:eliminarmensaje('<?php echo $id; ?>');" class="5linka" style="width:calc(50% - 1px); float:left; height:40px;"><div id="responder" style="height:40px; line-height:39px; overflow:hidden; width:100%; float:left;">
 <div id="menuinside" style="display: table; margin: 0 auto;">
 <div id="xxs" style="width:20px; height:20px; float:left; margin-left:20px; margin-top:10px;"><img src="../images/delete.png?id=<?php echo $time; ?>" height="20" /></div>
 
 <div id="xx" align="left" style="height:40px; float:left; line-height:40px; font-size:14px; color:#333; margin-left:15px;">Eliminar</div>
 </div>
 
 </div></a>
  <?php } else { ?>
   <a href="javascript:eliminarmensaje('<?php echo $id; ?>');" class="5linka" style="width:100%; float:left; height:40px;"><div id="responder" style="height:40px; line-height:39px; overflow:hidden; width:100%; float:left;">
 <div id="menuinside" style="display: table; margin: 0 auto;">
 <div id="xxs" style="width:20px; height:20px; float:left; margin-left:20px; margin-top:10px;"><img src="../images/delete.png?id=<?php echo $time; ?>" height="20" /></div>
 
 <div id="xx" align="left" style="height:40px; float:left; line-height:40px; font-size:14px; color:#333; margin-left:15px;">Eliminar</div>
 </div>
 
 </div></a>
  <input type="hidden" id="tipousuario" name="tipousuario" value="remitente">
  <?php } ?>
 
 </div>

</div>

<div id="linea" style="width:100%; float:left; background-color:#ccc; height:1px;"></div>

<div id="email" style="width:96%; float:left; margin-left:2%; margin-top:10px; color:#333; line-height:20px; font-size:14px;"><?php echo nl2br($mensaje); ?>

</div>
<input type="hidden" id="seccion" name="seccion" value="<?php echo $s; ?>">
<?php } else { ?>
<div id="emails" align="center" style="width:100%; float:left; border-bottom:#ccc solid 1px; font-size:14px; line-height:30px;">
No existe el mensaje
     </div>
<?php }
} else {

?>
<script>
alert("<?php echo $error; ?>");
</script>
<?php
}

mysql_close($comercenter);

?>
