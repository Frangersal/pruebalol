<?php require_once('../Connections/comercenter.php'); 

session_start();
$user = $_SESSION['MM_Username'];
$error = "";
$mensaje2 = "";

if ($user == "") {

$error = "Por favor vuelve a entrar a la página";

} else {

mysql_select_db($database_comercenter, $comercenter);
$query_Recordset1 = "SELECT * FROM clientes WHERE email = '$user'";
$Recordset1 = mysql_query($query_Recordset1, $comercenter) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$idcliente = $row_Recordset1['id'];

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

if ($id != '') {

$query_Recordset4 = "SELECT * FROM direcciones WHERE idcliente = '$idcliente' AND id = '$id'";
$Recordset4 = mysql_query($query_Recordset4, $comercenter) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

if ($totalRows_Recordset4 == 0) {

$error = "La dirección no existe o no te pertenece";

}

}


if ($error == '') {  

mysql_query("UPDATE direcciones SET activa = '2' WHERE id = '$id'");

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Eliminó dirección', '$time', 'página', '$idcliente', '$id')");

} else {

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Intentó eliminar direccion', '$time', 'página', '$idcliente', '$error')");

}

mysql_close($comercenter);

header("Location: /perfil");
  exit;

?>