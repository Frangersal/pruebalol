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

$elim = $_POST['elim'];
$tags = explode(',', $elim);

mysql_select_db($database_comercenter, $comercenter);

$i = 0;
 
foreach ($tags as $v) {
    
mysql_query("UPDATE mensajes SET estadoremitente = '2' WHERE id = '$v'");
	
}


if ($error == '') {  

echo "completo";

} else {

echo $error;

}

mysql_close($comercenter);

?>