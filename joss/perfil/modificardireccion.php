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

$idcliente = $_POST['idcliente'];
$iddireccion = $_POST['id'];

mysql_select_db($database_comercenter, $comercenter);
$query_Recordset7 = "SELECT * FROM direcciones WHERE id = '$iddireccion' AND idcliente = '$idcliente'";
$Recordset7 = mysql_query($query_Recordset7, $comercenter) or die(mysql_error());
$row_Recordset7 = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7);

if ($totalRows_Recordset7 == 0) {

$error = "Esta dirección no existe o no es tuya";

}


if ($error == '') {  

echo json_encode(array("mensaje1" => "completo", "nombre" => $row_Recordset7['nombre'], "email" => $row_Recordset7['email'], "calle" => $row_Recordset7['calle'], "numero" => $row_Recordset7['numero'], "interior" => $row_Recordset7['interior'], "colonia" => $row_Recordset7['colonia'], "cp" => $row_Recordset7['cp'], "ciudad" => $row_Recordset7['ciudad'], "estado" => $row_Recordset7['estado']));

} else {

echo json_encode(array("mensaje1" => "error", "mensaje2" => $error));

}

mysql_close($comercenter);

?>