<?php require_once('../Connections/conamatenlinea.php');
session_start();

if ($_SESSION['usuario'] == "") {
    
    header("Location: login.php");

}else{

    $usuario = $_SESSION['usuario'];
    $unixtime = time();
}

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM materiascurso2 GROUP BY id DESC";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$permiso = $row_Recordset2['permiso'];

if ($permiso == 2) {

header("Location: index.php");
exit;

}

$targetPath = "../images/";
$targetPath2 = "../images/";
$minDim = 520;
$nombre = $_POST["nombre"];
$presentacion = addslashes(addslashes(trim($_POST["presentacion"])));
$introduccion = addslashes(addslashes(trim($_POST["introduccion"])));
$propositos = addslashes(addslashes(trim($_POST["propositos"])));
$competencias = addslashes(addslashes(trim($_POST["competencias"])));

//Subida de la foto
	$foto = basename($_FILES['foto']["name"]);

	$tempFile = $_FILES['foto']["tmp_name"];
	$numero1 = substr(md5(rand(0,9999)), 17, /*Numero de Digitos*/5);
    $name1 = date("dmY").$numero1.$h;
	$ext = pathinfo($foto, PATHINFO_EXTENSION);  //figures out the extension
	$newFileName1 = $name1.".".$ext;
	$targetFile =  $targetPath . $newFileName1;
	
	if (getimagesize($tempFile)) {

    $fn = $tempFile;
	$size = getimagesize( $fn );
    $ratio = $size[0]/$size[1]; // width/height
	$width1 = $size[0];
	$height1 = $size[1];
   
               if ($width1 > $height1) {			   
				  $height = $minDim;
                $width = $minDim * $ratio;
			   } else {
				$width = $minDim;
               $height = $minDim / $ratio;
			   }
			   
			   $medida = "100% auto";
			   
			   $largo = $width1 - 300;
               $alto = $height1 - 200;
   
   if ($largo >= $alto) {		   
	 $medida = 'auto 100%';
	}

            $src = imagecreatefromjpeg($fn);
            $dst = imagecreatetruecolor($width, $height);
            imagecopyresampled( $dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
		 	imagejpeg($dst, $targetFile, 80); 
   
            imagedestroy($dst);
   
	} else {
	
        echo json_encode(array("mensaje1" => "Error", "mensaje2" => "Error en la foto 1"));
	
	}

	//**********************************PORTADA*************************************************

	$portada = basename($_FILES['portada']['name']);

	$tempFile2 = $_FILES['portada']["tmp_name"];
	$numero2 = substr(md5(rand(0, 9999)), 17, 6);
	$name2 = date("dmY").$numero2.$h;
	$ext2 = pathinfo($portada, PATHINFO_EXTENSION);
	$newFileName2 = $name2.".".$ext2;
	$targetFile2 = $targetPath2 . $newFileName2;

	
	if (getimagesize($tempFile2)) {

    $fn2 = $tempFile2;
	$size2 = getimagesize( $fn2 );
    $ratio2 = $size2[0]/$size2[1]; // width/height
	$width2 = $size2[0];
	$height2 = $size2[1];
   
               if ($width2 > $height2) {			   
				  $height2 = $minDim;
                  $width2 = $minDim * $ratio2;
			   } else {
				$width2 = $minDim;
                $height2 = $minDim / $ratio2;
			   }
			   
			   $medida2 = "100% auto";
			   
			   $largo2 = $width2 - 300;
               $alto2 = $height2 - 200;
   
   if ($largo2 >= $alto2) {		   
	 $medida2 = 'auto 100%';
	}

            $src2 = imagecreatefromjpeg($fn2);
            $dst2 = imagecreatetruecolor($width2, $height2);
            imagecopyresampled( $dst2, $src2, 0, 0, 0, 0, $width2, $height2, $size2[0], $size2[1] );
		 	imagejpeg($dst2, $targetFile2, 80); 
   
            imagedestroy($dst2);
   
	} else {
	
        echo json_encode(array("mensaje1" => "Error", "mensaje2" => "Error en la foto 2"));
	
	}

    echo json_encode(array("mensaje1" => "completo", "mensaje2" => $portada));


    mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Agregó una materia del curso', '$unixtime')"); 

    mysql_query("INSERT INTO materiascurso2(idmateria, imagen, portada, presentacion, introduccion, propositos, competencias) VALUES('$nombre', '$newFileName1', '$newFileName2', '$presentacion', '$introduccion', '$propositos', '$competencias')");
?>
