<?php require_once('../Connections/conamatenlinea.php');

session_start();
date_default_timezone_set('America/Mexico_City');
mysql_select_db($database_conamatenlinea, $conamatenlinea);

$unixtime = time();
$targetPath = "../images/";
$minDim = 520;
$usuario = $_SESSION['usuario'];

//Datos del form

    $hayimagen = addslashes(addslashes(trim($_POST["imagen"])));
    $fechainicio  = $_POST["fechainicio"];
    $fechafinal   = $_POST["fechafinal"];
    $fechafinal1 = $fechafinal." 23:59:59";
    $iniciounix   = strtotime($fechainicio);
    $finalunix    = strtotime($fechafinal1);
    $nombre = addslashes(addslashes(trim($_POST["nombre"])));
    $costo = addslashes(addslashes(trim($_POST["costo"])));
    $descripcion = addslashes(addslashes(trim($_POST["descripcion"])));

//Datos si mientras se modifica

    $idcurso = $_GET['id'];

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
   
	} else {
	
        echo json_encode(array("mensaje1" => "Error", "mensaje2" => "Error en la foto"));
	
	}

    echo json_encode(array("mensaje1" => "completo", "mensaje2" => "Se han guardado los cambios"));

    unlink("../images/" . $imagenactual);

if ($idcurso > 0) {

    mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Modificó un curso', '$unixtime')"); 

    mysql_query("UPDATE cursos SET nombre = '$nombre', descripcion = '$descripcion', imagen = '$newFileName1', costo = '$costo', fechainicio = '$iniciounix', fechafinal = '$finalunix' WHERE id = '$idcurso'");

} else {//si idcurso es 0

    mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Agregó un curso', '$unixtime')"); 

    mysql_query("INSERT INTO cursos( nombre, descripcion, imagen, costo, fechainicio, fechafinal) VALUES('$nombre', '$descripcion', '$newFileName1', '$costo', '$iniciounix', '$finalunix')");

header("Location: cursos.php");

}


} else { //si $hayimagen == "falso"

        echo json_encode(array("mensaje1" => "completo", "mensaje2" => "Se han guardado los cambios"));

        mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Modificó un curso', '$unixtime')"); 

        mysql_query("UPDATE cursos SET nombre = '$nombre', descripcion = '$descripcion', imagen = '$imagen', costo = '$costo', fechainicio = '$iniciounix', fechafinal = '$finalunix' WHERE id = '$idcurso'");
    
}

//Insercion a las tablas materia y libros

    $idcurso = mysql_insert_id();

    $nummaterias = $_POST["nummaterias"];
    $numlibros = $_POST["numlibros"];

    for($i = 1; $i <= $nummaterias; $i++) {

        $idmateria = "idmateria" . $i;
        $materia = $_POST[$idmateria];

		$query = "INSERT INTO materiascurso( idmateria, idcurso) VALUES( '$materia', '$idcurso')";
		mysql_query($query, $conamatenlinea) or die(mysql_error());

    }


    for($j = 1; $j <= $numlibros; $j++) {


        $idlibro = "idlibro" . $i;
        $libro = $_POST[$idlibro];

		$query = "INSERT INTO libroscurso( idlibro, idcurso) VALUES( '$idlibro', '$idcurso')";
		mysql_query($query, $conamatenlinea) or die(mysql_error());

    }



?>
