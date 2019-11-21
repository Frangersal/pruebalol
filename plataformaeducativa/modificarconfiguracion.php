<?php require_once('../Connections/conamatenlinea.php');
session_start();

$unixtime = time();
$alumno = $_SESSION['sesionalumno'];
$targetPath = "../images/";
$minDim = 520;

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT id, nombrealumno, correo, contrasena, imagen FROM alumnos WHERE matricula = '$alumno'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$idoriginal = $row_Recordset1['id'];
$imagenoriginal = $row_Recordset1['imagen'];
$nombrealumnooriginal = $row_Recordset1['nombrealumno'];
$correooriginal = $row_Recordset1['correo'];
$contrasenaoriginal = $row_Recordset1['contrasena'];


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
	
	echo json_encode(array("mensaje1" => "Error", "mensaje2" => "Error en la foto"));
	
	}

echo json_encode(array("mensaje1" => "completo", "mensaje2" => "Se han guardado los cambios"));

$nombrealumno = addslashes(addslashes(trim($_POST['nombrealumno'])));
$correo = addslashes(addslashes(trim($_POST['correo'])));
$contrasena = addslashes(addslashes(trim($_POST['contrasena'])));

if ($nombrealumno == "") $nombrealumno = $nombrealumnooriginal;

if ($correo == "") $correo = $correooriginal;

if ($contrasena == "") $contrasena = $contrasenaoriginal;


	if ($foto != "")  {

        unlink("../images/" . $imagenactual);
		

        mysql_query("UPDATE alumnos SET nombrealumno = '$nombrealumno', correo = '$correo', contrasena = '$contrasena', imagen = '$newFileName1' WHERE matricula = '$alumno'");
                
    } else {

        mysql_query("UPDATE alumnos SET nombrealumno = '$nombrealumno', correo = '$correo', contrasena = '$contrasena' WHERE matricula = '$alumno'");
    
    }
  
?>

