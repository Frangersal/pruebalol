<?php require_once('../Connections/conamatenlinea.php');

session_start();
date_default_timezone_set('America/Mexico_City');
mysql_select_db($database_conamatenlinea, $conamatenlinea);

mysql_query("DELETE FROM bloques WHERE idmateriacurso = '$idmateriacurso'");

$bloques = json_decode(stripslashes($_POST["bloques"]));
$leccionesporbloque = json_decode(stripslashes($_POST["leccionesporbloque"]));
$numbloques = $_POST["numbloques"];
$idcurso = $_POST["idcurso"];
$idmateria = $_POST["idmateria"];
$idmaestro = $_POST["idmaestro"];
$nummodulo = $_POST["nummodulo"];

for($i = 0; $i < $numbloques; $i++) {

    $bloque = $bloques[$i];
    $leccionesbloque = $leccionesporbloque[$i];

    $numbloque = $i + 1;

    $nombrebloque = $bloque;

    $numlecciones = sizeof($leccionesbloque);

    for($j = 0; $j < $numlecciones; $j++) {

        $leccion = $leccionesbloque[$j];

        $numleccion = $j + 1;
        
        mysql_query("INSERT INTO bloques( idcurso, numbloque, nombrebloque, numleccion, leccion, idmateria, idmaestro, nummodulo ) VALUES( '$idcurso', '$numbloque', '$nombrebloque', '$numleccion', '$leccion', '$idmateria', '$idmaestro', '$nummodulo' )");

    
    }

}

echo json_encode(array("bloques" => $bloques, "leccionesbloque" => $leccionesporbloque, "idcurso" => $idcurso, "idmateria" => $bloques, "bloques" => $bloques));


?>
