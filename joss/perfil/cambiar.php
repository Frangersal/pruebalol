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
$id = $_POST['id'];
$valor = addslashes(addslashes(trim($_POST[$id])));

mysql_select_db($database_comercenter, $comercenter);

if ($idcliente != '') {

$query_Recordset4 = "SELECT * FROM clientes WHERE id = '$idcliente' AND estado = '1'";
$Recordset4 = mysql_query($query_Recordset4, $comercenter) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

if ($totalRows_Recordset4 == 0) {

$error = "El cliente no existe o está suspendido";

}

$valor1 = $row_Recordset4[$id];

if ($valor == $valor1) {

$error = "Esto ya está agregado";

}

}

if ($id == "email") {

$mensaje2 = "sesion";

$query_Recordset3 = "SELECT * FROM clientes WHERE email = '$valor' OR email2 = '$valor'";
$Recordset3 = mysql_query($query_Recordset3, $comercenter) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

if ($totalRows_Recordset3 > 0) {

$error = "Ese email ya existe en nuestra base de datos";

}

}


if ($error == '') {  
  
mysql_query("UPDATE clientes SET ".$id." = '$valor' WHERE id = '$idcliente'");
 
$nuevonombre1 = stripslashes(stripslashes(strtoupper($nuevonombre)));

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Modificó ".$id."', '$time', 'página', '$idcliente', '$valor')");

echo json_encode(array("mensaje1" => "completo", "mensaje2" => $mensaje2));

} else {

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Intentó modifcar ".$id."', '$time', 'página', '$idcliente', '$error')");

echo json_encode(array("mensaje1" => "error", "mensaje2" => $error));

}

mysql_close($comercenter);

?>