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

$idcliente = $_POST['idcliente'];
$email = trim($_POST['email']);
$predeterminado = $_POST['predeterminado'];
mysql_select_db($database_comercenter, $comercenter);

if ($idcliente != '') {

$query_Recordset4 = "SELECT * FROM clientes WHERE id = '$idcliente' AND estado = '1'";
$Recordset4 = mysql_query($query_Recordset4, $comercenter) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

if ($totalRows_Recordset4 == 0) {

$error = "El cliente no existe o está suspendido";

}

if ($email != '') {

$valor1 = $row_Recordset4['email2'];
$emailelegido = $row_Recordset4['emailelegido'];

if ($valor1 == $emailelegido && $predeterminado == "si") {

$error = "El email ya está agregado";	

} else if ($email == $valor1 && $valor1 != $emailelegido && $predeterminado != "si") {

$error = "El email ya está agregado";

}

}

if ($error == "") {

$query_Recordset3 = "SELECT * FROM clientes WHERE email = '$email' AND id != '$idcliente' OR email2 = '$email' AND id != '$idcliente'";
$Recordset3 = mysql_query($query_Recordset3, $comercenter) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

if ($totalRows_Recordset3 > 0) {

$error = "Ese email ya existe en nuestra base de datos";

}

}

if ($error == "") {

$query_Recordset3a = "SELECT * FROM clientes WHERE email = '$email' AND id = '$idcliente'";
$Recordset3a = mysql_query($query_Recordset3a, $comercenter) or die(mysql_error());
$row_Recordset3a = mysql_fetch_assoc($Recordset3a);
$totalRows_Recordset3a = mysql_num_rows($Recordset3a);

if ($totalRows_Recordset3a > 0) {

$error = "Ese email lo tienes actualmente como predeterminado";

}

}

}


if ($error == '') {  

if ($email == "") {

mysql_query("UPDATE clientes SET email2 = '', emailelegido = '' WHERE id = '$idcliente'");

} else if ($predeterminado == "si" && $email != '') {

mysql_query("UPDATE clientes SET email2 = '$email', emailelegido = '$email' WHERE id = '$idcliente'");

} else if ($predeterminado != "si" && $email != '') {
  
mysql_query("UPDATE clientes SET email2 = '$email', emailelegido = '' WHERE id = '$idcliente'");

}
 
$nuevonombre1 = stripslashes(stripslashes(strtoupper($nuevonombre)));

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Modificó email2', '$time', 'página', '$idcliente', '$email')");

echo json_encode(array("mensaje1" => "completo"));

} else {

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Intentó modifcar email2', '$time', 'página', '$idcliente', '$error')");

echo json_encode(array("mensaje1" => "error", "mensaje2" => $error));

}

mysql_close($comercenter);

?>