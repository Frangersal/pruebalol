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
$iddireccion = $_POST['iddireccion'];
$nombre = addslashes(addslashes(trim($_POST['nombre'])));
$email = addslashes(addslashes(trim($_POST['email'])));
$calle = addslashes(addslashes(trim($_POST['calle'])));
$numero = addslashes(trim($_POST['numero']));
$interior = addslashes(addslashes(trim($_POST['interior'])));
$colonia = addslashes(addslashes(trim($_POST['colonia'])));
$ciudad = addslashes(addslashes(trim($_POST['ciudad'])));
$estado = $_POST['estado'];
$cp = $_POST['cp'];

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

if ($iddireccion == "") {

mysql_query("INSERT INTO direcciones(idcliente, nombre, email, activa, calle, numero, interior, colonia, cp, ciudad, estado, pais, fecha) VALUES('$idcliente', '$nombre', '$email', '1', '$calle', '$numero', '$interior', '$colonia', '$cp', '$ciudad', '$estado', 'México', '$time')");

$lastid = mysql_insert_id();

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Agregó dirección', '$time', 'página', '$idcliente', '$lastid')");

echo json_encode(array("mensaje1" => "completo", "mensaje2" => "agregada"));

} else {

mysql_query("UPDATE direcciones SET idcliente = '$idcliente', nombre = '$nombre', email = '$email', calle = '$calle', numero = '$numero', interior = '$interior', colonia = '$colonia', cp = '$cp', ciudad = '$ciudad', estado = '$estado', pais = 'México' WHERE id = '$iddireccion'");

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Modificó dirección', '$time', 'página', '$idcliente', '$iddireccion')");

echo json_encode(array("mensaje1" => "completo", "mensaje2" => "modificada"));

}

} else {

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Intentó modifcar dirección', '$time', 'página', '$idcliente', '$error')");

echo json_encode(array("mensaje1" => "error", "mensaje2" => $error));

}

mysql_close($comercenter);

?>