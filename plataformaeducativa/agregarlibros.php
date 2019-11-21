<?php require_once('../Connections/conamatenlinea.php');


$libros = json_decode(stripslashes($_POST["libros"]));
$numlibros = $_POST["numlibros"];
$idmateriacurso = $_POST["idmateriacurso"];

mysql_query("DELETE FROM libroscurso WHERE idmateriacurso = '$idmateriacurso'");

for($j = 0; $j < $numlibros; $j++) {

    $idlibro = $libros[$j];
    
    mysql_query("INSERT INTO libroscurso(  idlibro, idmateriacurso ) VALUES( '$idlibro', '$idmateriacurso')");

}

echo json_encode(array("mensaje1" => "completo", "mensaje2" => "Se han guardado los cambios"));

?>
