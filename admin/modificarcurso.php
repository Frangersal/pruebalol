<?php require_once('../Connections/conamatenlinea.php');

session_start();
date_default_timezone_set('America/Mexico_City');
mysql_select_db($database_conamatenlinea, $conamatenlinea);

$unixtime = time();
$targetPath = "../images/";
$minDim = 520;
$usuario = $_SESSION['usuario'];
$nummodulos = $_POST["nummodulos"];

//Datos del form

    $hayimagen = addslashes(addslashes(trim($_POST["imagen"])));
    $fechainicio  = $_POST["fechainicio"];
    $fechafinal   = $_POST["fechafinal"];
    $fechafinal1 = $fechafinal." 23:59:59";
    $iniciounix   = strtotime($fechainicio);
    $finalunix    = strtotime($fechafinal1);
    $nombre = addslashes(addslashes(trim($_POST["nombre"])));
    $costo = addslashes(addslashes(trim($_POST["costo"])));
    $sesiones = addslashes(addslashes(trim($_POST["sesiones"])));
    $descripcion = addslashes(addslashes(trim($_POST["descripcion"])));
    $idcurso = $_POST['id'];

    $url = trim($nombre);
    $url = strtolower($url);

    $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');

    $repl = array('a', 'e', 'i', 'o', 'u', 'n');

    $url = str_replace ($find, $repl, $url);

    // Añaadimos los guiones

    $find = array(' ', '&', '\r\n', '\n', '+');
    $url = str_replace ($find, '-', $url);

    // Eliminamos y Reemplazamos demás caracteres especiales

    $find = array('/[^a-z0-9\-<>]/', "/[\-]+/", "/<['^>\"]*>/");

    $repl = array('', '-', '');

    $url = preg_replace ($find, $repl, $url);

//Datos si mientras se modifica


//Procesamiento de la imagen

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM cursos WHERE id = '$idcurso'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

$imagenactual = $row_Recordset1['imagen'];

if ($hayimagen == 'verdadero') {

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
   
	}

if ($idcurso > 0) {

    unlink("../images/" . $imagenactual);

}

if ($idcurso > 0) {

    mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Modificó un curso', '$unixtime')"); 

    mysql_query("UPDATE cursos SET nombre = '$nombre', descripcion = '$descripcion', imagen = '$newFileName1', costo = '$costo', fechainicio = '$iniciounix', fechafinal = '$finalunix', link = '$url' WHERE id = '$idcurso'");

} else {//si idcurso es 0

    mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Agregó un curso', '$unixtime')"); 

    mysql_query("INSERT INTO cursos( nombre, descripcion, imagen, costo, fechainicio, fechafinal, link, sesiones, modulos) VALUES('$nombre', '$descripcion', '$newFileName1', '$costo', '$iniciounix', '$finalunix', '$url', '$sesiones' , '$nummodulos')");


}

    $lastid = strval(mysql_insert_id());



} else { //si $hayimagen == "falso"



    if ($idcurso > 0) {

        mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Modificó un curso', '$unixtime')"); 

        mysql_query("UPDATE cursos SET nombre = '$nombre', descripcion = '$descripcion', imagen = '$imagenactual', costo = '$costo', fechainicio = '$iniciounix', fechafinal = '$finalunix', link = '$url', sesiones = '$sesiones', modulos = '$nummodulos' WHERE id = '$idcurso'");


    }

    $lastid = strval(mysql_insert_id());
    
}

mysql_query("DELETE FROM materiascurso WHERE idcurso = '$idcurso'");

$modulosmaterias = json_decode(stripslashes($_POST["modulosmaterias"]));
$modulosmaestros = json_decode(stripslashes($_POST["modulosmaestros"]));

for($i = 0; $i < $nummodulos; $i++) {

    $materias = $modulosmaterias[$i];
    $maestros = $modulosmaestros[$i];

    $nummaterias = sizeof($materias);

    for($j = 0; $j < $nummaterias; $j++) {

        $idmateria = $materias[$j];
        $idmaestro = $maestros[$j];

        $numeromodulo = $i + 1;
        
        if (!$idcurso) {

            $idcurso = $lastid;
        
        }

        mysql_query("INSERT INTO materiascurso( idcurso, nummodulo, idmateria, idmaestro ) VALUES( '$idcurso', '$numeromodulo', '$idmateria', '$idmaestro')");

    }

}

echo json_encode(array("mensaje1" => "completo", "mensaje2" => "Se han guardado los cambios"));

?>
