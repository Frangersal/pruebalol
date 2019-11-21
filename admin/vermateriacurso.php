<?php require_once('../Connections/conamatenlinea.php');
session_start();

if ($_SESSION['usuario'] == "") {
    
    header("Location: login.php");

}else{

    $usuario = $_SESSION['usuario'];
    $unixtime = time();
}

$id = $_GET['id'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM materiascurso2 WHERE id = '$id'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 
    
$imagen = $row_Recordset1['imagen'];
$portada = $row_Recordset1['portada'];
$presentacion = $row_Recordset1['presentacion'];
$introduccion = $row_Recordset1['introduccion'];
$competencias = $row_Recordset1['competencias'];
$propositos = $row_Recordset1['propositos'];
$idmateria = $row_Recordset1['idmateria'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset3 = "SELECT * FROM materias WHERE id = '$idmateria'";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$nombre = $row_Recordset3['nombre'];

$permiso = $row_Recordset2['permiso'];

if ($permiso == 2) {

header("Location: index.php");
exit;

}

?>

<!DOCTYPE html>
<html lang="es"><head>
    <meta charset="UTF-8">
    <title>Conamat en línea | Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<!--Estilos CSS-->
<style>
body{
    margin: 0;
    background-color: #0b2c4d;
    font-family: 'Montserrat', sans-serif; 
}
.menu{
    font-family: 'Montserrat', sans-serif;
    padding: 10px;
    line-height: 30px;
    float:left;
    text-decoration: none;
    font-size: 18px;
    color: white;
    width: calc(100% - 20px);
}
.menu:hover{
    background-color: #7FDBFF !important;
    color: #0b2c4d !important;
}
.linea{
    border-bottom: 1px solid #7FDBFF;
    height: 0px;
    width: 100%;
    float: left;
}
#link{
    font-weight: bold;
    float: left;
    width: calc(100% - 20px);
    font-family: 'Montserrat', sans-serif;
    padding-left: 10px;
    padding-right: 10px;
    line-height: 50px;
    text-decoration: none;
    font-size: 18px;
    background-color: #7FDBFF;
    color: #0b2c4d;
    cursor: default;
}
.card{
    border: 0 solid transparent;
    background-color: white;
    padding: 20px 30px;
}
	
 .progress-wrp {
            position: relative;
            border-radius: 3px;
            margin: 0px;
            text-align: left;
            background: #7FDBFF;
            color: white;
}

.progress-bar {
            height: 45px;
            width: 0;
            background-color: #0b2c4d;
            line-height: 45px;
}

.status {
     top: 3px;
     left: 0%;
     width: 100%;
     text-align: center;
     position: absolute;
     line-height: 45px;
     display: inline-block;
     color: #000000;
 }
	
.toprow {
    float:left;
    width: 100%;
    background-color: #0b2c4d; 
    color: white;
    min-height: 50px;
}
.topcell {
    float: left; 
    width: calc(25% - 2px);
    line-height: 50px;
    text-align: center;
}
.row {
    float:left;
    width: 100%;
    background-color: white; 
}
.cell {
    float: left; 
    width: calc(25% - 2px);
    border: 1px solid lightgray;
    line-height: 30px;
    text-align: center;
}
.nostyle:link {
    color: #222;
    text-decoration: none;
}
.nostyle:visited {
    color: #222;
    text-decoration: none;
}
#librolink:hover {
    background-color: #0b2c4d; 
    color: white;
}

.imagenmateria {
     width: 100%;
	 height: 200px;
     float: left;
     border: 1px solid #ccc;
	background-size: cover;
	background-position: center;
	margin-bottom: 10px;
}

.portadamateria {
		width: 859px;
		height: 220px;
		float: left;
		border: 1px solid #ccc;
		background-image: url(../images/headerciencia.jpg);
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
}

.boton:hover {   
	 text-decoration: underline;
}


</style>
<!--Fin estilos CSS-->


<!--Javascript-->
<script type="text/javascript">
</script>

</head>
<body>
<div id="wrapper" style="width: 100%; float: left; height: 100vh; position: relative;">

    <div id="adminmenu" style="float: left; box-shadow: 0px 0px 10px #000; overflow: scroll; width: 20%; background-color: #1d4267; position: fixed; height: 100%; overflow: scroll;">

        <div id="logotipo" align="center" style="float: left; width: calc(100% - 60px); padding-top: 50px; padding-bottom: 30px; padding-right: 30px; padding-left: 30px;"><img src="../images/logotipo.png" alt="logotipo" style="width: 100%;"></div>

        <div id="etiquetaadmin" style="font-family: 'Montserrat', sans-serif; float: left; width: calc(80% - 20px); margin-left: 10%; margin-top: 20px; margin-bottom: 50px; text-align: center; padding: 10px; border: 1px solid white; color: white; font-size: 18px; border-radius: 20px;">Menú admin</div>

        <div id="navegacion" style="width: 100%; float: left; margin-bottom: 20px;">
                    
            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="index.php">Inicio</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

<?php

    if ($permiso == 1) {

?>

            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">CONTENIDO PÁGINA</div>

<?php 

    }

    if ($permiso == 2 || $permiso == 1) {

?>

            <a class="menu" href="academicos.php">Académicos</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="quienessomos.php">Quiénes somos</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>


            <a class="menu" href="secciones.php">Secciones</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
<?php
    
    }

    if ($permiso == 3 || $permiso == 1) {

?>

            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">PLATAFORMA EDUCATIVA</div>

            <a class="menu" href="alumnos.php">Alumnos</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="ayuda.php">Ayuda</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="biblioteca.php">Biblioteca</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="cursos.php">Cursos</a>
            
            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="maestros.php">Maestros</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <div id="link">Materias</div>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="pagos.php">Pagos</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="sesiones.php">Sesiones</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

<?php

    }

    if ($permiso == 1) {

?>

            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">MENÚ ADMIN</div>

            <a class="menu" href="actividad.php">Actividad</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="usuarios.php">Usuarios</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>


<?php 

    }

?>
            <a class="menu" href="logout.php">Salir</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

        </div>

    </div>

    <div id="seccionprincipal" style="width: 80%; float: left; margin-left: 20%; background-color: #fff; background-position: center; background-size: cover; overflow: scroll; height: 100vh;">
	
		<div id="header" style="width: 100%; height: 380px; background-image: url(../images/<?php echo $portada; ?>); background-size: cover; background-position: center; overflow: hidden; position: relative;"></div>				
		<div id="imagencircular" style="position: relative; width: 200px; height: 200px; border-radius: 50%; overflow: hidden; margin-top: -8%; margin-left: 40%; border: 6px solid #fff; background-image: url(../images/<?php echo $imagen; ?>); background-size: cover; background-position: center; overflow: hidden;"></div>
	
 		<div id="contenedordatos<?php echo $id; ?>" style="width: calc(100% - 100px); margin-left: 50px; margin-right: 50px; float: left; margin-bottom: 30px;">
 		
 			<div id="datos<?php echo $id; ?>" style="width: 100%; color: #000; float: left; margin-top: 10px;">
			
 				<div id="nombre<?php echo $id; ?>" align="center" style="font-size: 22px; width: 100%; font-family: 'Montserrat', sans-serif; letter-spacing: 1.6px; margin-bottom: 40px; text-transform: uppercase; font-weight: bold;"><?php echo $nombre; ?></div>
			
				<div id="presentacion<?php echo $id; ?>" style="width: 100%; float: left; margin-bottom: 20px;">
			
					<div id="subtitulo1<?php echo $id; ?>" align="center" style="font-family: 'Open Sans', sans-serif; font-size: 16px; letter-spacing: 2px; margin-bottom: 10px; font-weight: bold;">Presentación</div>
 		
 					<div id="contenido1<?php echo $id; ?>" style="font-family: 'Open Sans', sans-serif; font-size: 14px; text-align: justify; line-height: 20px;"><?php echo $presentacion; ?></div>
				
				</div>
			
				<div id="introduccion<?php echo $id; ?>" style="width: 100%; float: left; margin-bottom: 20px;">
			
					<div id="subtitulo2<?php echo $id; ?>" align="center" style="font-family: 'Open Sans', sans-serif; font-size: 16px; letter-spacing: 2px; margin-bottom: 10px; font-weight: bold;">Introducción</div>
 		
 					<div id="contenido2<?php echo $id; ?>" style="font-family: 'Open Sans', sans-serif; font-size: 14px; text-align: justify; line-height: 20px;"><?php echo $introduccion; ?></div>
				
				</div>
			
				<div id="propositos<?php echo $id; ?>" style="width: 100%; float: left; margin-bottom: 20px;">
			
					<div id="subtitulo<?php echo $id; ?>3" align="center" style="font-family: 'Open Sans', sans-serif; font-size: 16px; letter-spacing: 2px; margin-bottom: 10px; font-weight: bold;">Propósitos</div>
 		
 					<div id="contenido3<?php echo $id; ?>" style="font-family: 'Open Sans', sans-serif; font-size: 14px; text-align: justify; line-height: 20px;"><?php echo $propositos; ?></div>
				
				</div>
			
				<div id="competencias<?php echo $id; ?>" style="width: 100%; float: left; margin-bottom: 20px;">
			
					<div id="subtitulo4<?php echo $id; ?>" align="center" style="font-family: 'Open Sans', sans-serif; font-size: 16px; letter-spacing: 2px; margin-bottom: 10px; font-weight: bold;">Competencias</div>
 		
 					<div id="contenido4<?php echo $id; ?>" style="font-family: 'Open Sans', sans-serif; font-size: 14px; text-align: justify; line-height: 20px;"><?php echo $competencias; ?></div>
				
				</div>
			
	   		</div>
 			
 		</div>
		
		<div id="boton" align="center" style="float: left; width: 100%; margin-bottom: 30px;">
			
			<div id="regresar" align="center" onclick="location.href='materias1.php';" style="font-size: 14px; width: 150px; border: 2px solid #9fa9ad; font-weight: bold; letter-spacing: 3px; text-align: center; padding: 8px; cursor: pointer; color: #fff; background-color: #949fa5; border-radius: 6px; font-family: 'Montserrat', sans-serif; text-transform: uppercase;">Regresar</div> 
			
		</div>
                
   	
	</div>
	
</div>
	
</body>
</html>
