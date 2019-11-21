<?php require_once('../Connections/comercenter.php'); 

session_start();
$user = $_SESSION['MM_Username'];
$error = "";
$mensaje2 = "";
$error2 = "";
$time = time();

if ($user == "") {

$error = "Por favor vuelve a entrar a la página";
$error2 = "reload";

} else {
	
mysql_select_db($database_comercenter, $comercenter);
$query_Recordset1 = "SELECT * FROM clientes WHERE email = '$usuarioemail'";
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

$elim = $_POST['elim'];
$tags = explode(',', $elim);

mysql_select_db($database_comercenter, $comercenter);

$i = 0;

foreach ($tags as $v) {
    
mysql_query("UPDATE mensajes SET estadodestinatario = '2' WHERE id = '$v'");
	
}


if ($error == '') {  

echo "completo";

mysql_query("INSERT INTO login(ip, id_cliente, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Eliminó mensaje', '$time', 'página', '$idcliente', '$v')");

} else {

echo $error;

}

mysql_close($comercenter);

?>