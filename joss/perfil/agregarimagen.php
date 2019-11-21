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
$time1 = strtotime('+1 hour', $time);

$idcliente = $_POST['idcliente'];

mysql_select_db($database_comercenter, $comercenter);

if ($idcliente != '' && $error == '') {

$query_Recordset4 = "SELECT * FROM clientes WHERE id = '$idcliente' AND estado = '1'";
$Recordset4 = mysql_query($query_Recordset4, $comercenter) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

if ($totalRows_Recordset4 == 0) {

$error = "El cliente no existe o está suspendido";

}

}

if ($error == "") {

$cambiofoto = $row_Recordset4['cambiofoto'];

if ($cambiofoto != '') {

$cambiofoto1 = strtotime('+1 hour', $cambiofoto);

if ($cambiofoto1 > $time) {

$error = "Sólo puedes cambiar tu foto 1 vez por hora";

}

}

}

if ($error == "") {
	
$foto1 = basename($_FILES['foto1']['name']);

mysql_select_db($database_comercenter, $comercenter);

$foto1a = "";

$newFileName1 = "";

$targetPath = "../images/usuarios/";
$maxDim = 600;
$error = "";

if ($foto1 != '') {

	$tempFile = $_FILES["foto1"]["tmp_name"];
	$numero1 = substr(md5(rand(0,9999)), 17, /*Numero de Digitos*/5);
    $name1 = date("dmY").$numero1.$h;
	$ext = pathinfo($foto1, PATHINFO_EXTENSION);  //figures out the extension
	$newFileName1 = $name1.".".$ext;
	$targetFile =  $targetPath . $newFileName1;
	
	if(getimagesize($tempFile)){
		
        list($width, $height, $type, $attr) = getimagesize($_FILES["foto1"]["tmp_name"]);
		$fn = $_FILES["foto1"]["tmp_name"];
		 $size = getimagesize( $fn );
        $ratio = $size[0]/$size[1]; // width/height
		$width1 = $size[0];
			
if ($width >= $height) {

$mensaje3 = 'alto';

} else {
	
$mensaje3 = 'ancho';

}
		
		if ($width1 >= 500) {
   
                $width = $maxDim;
                $height = $maxDim/$ratio;
            
            $src = imagecreatefromjpeg($fn);
            $dst = imagecreatetruecolor($width, $height);
            imagecopyresampled( $dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
		 	 imagejpeg($dst, $targetFile); 
			 
			 $foto1a = "si";
			 
		} else {
		
		$error = "La foto es muy chica";
      
		}
	} else {
	
	$error = "La foto es errónea";
	
	}

} 

}


if ($error == '') {
	
$fotooriginal = $row_Recordset4['foto'];
  
 mysql_query("UPDATE clientes SET foto = '$newFileName1', cambiofoto = '$time1' WHERE id = '$idcliente'");
  
if ($fotooriginal != '') {

unlink("../images/usuarios/".$fotooriginal);

}

 mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario) VALUES('$ip', '$idcliente', 'Modificó foto', '$time', 'página', '$idcliente')");

echo json_encode(array("mensaje1" => "completo", "mensaje2" => $newFileName1, "mensaje3" => $mensaje3, "mensaje4" => $time1));

} else {

if ($foto1a == 'si') {

imagedestroy($dst);
imagedestroy($src);

}

mysql_query("INSERT INTO login(ip, usuarioafectado, actividad, time, seccion, idusuario, comentarios) VALUES('$ip', '$idcliente', 'Intentó modificar foto', '$time', 'página', '$idcliente', '$error')");

echo json_encode(array("mensaje1" => "error", "mensaje2" => $error));

}

mysql_close($comercenter);

?>