<?php require_once('../Connections/conamatenlinea.php');

session_start();
date_default_timezone_set('America/Mexico_City');

$unixtime = time();
$targetPath = "../images/";
$minDim = 520;
$usuario = $_SESSION['usuario'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$permiso = $row_Recordset2['permiso'];

/*
if ($permiso ==  3) {

header("Location: index.php");
exit;

}*/

$id = $_GET['id'];
    
mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM maestros WHERE id = '$id'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$nombre = stripslashes(stripslashes($row_Recordset1['nombre']));
$sexo = $row_Recordset1['sexo'];
$correo = stripslashes(stripslashes($row_Recordset1['correo']));
$imagen = $row_Recordset1['imagen'];
$contrasena = stripslashes(stripslashes($row_Recordset1['contrasena']));
$cedula = stripslashes(stripslashes($row_Recordset1['cedula']));


?>
<!DOCTYPE html>
<html lang="es"><head>
    <meta charset="UTF-8">
    <title>Conamat en línea | Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script
      src="https://code.jquery.com/jquery-3.3.1.js"
      integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
      crossorigin="anonymous"></script>

<!--Estilos CSS-->
<style>
body{
    margin: 0;
    background-color: #0b2c4d;
    font-family: 'Montserrat', sans-serif;
}
.menu{
    font-family: 'Montserrat', sans-serif;
    float:left;
    padding: 10px;
    line-height: 30px;
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
    padding: 30px 60px;
}
.progress-wrp {
    position: relative;
    border-radius: 3px;
    margin: 0px;
    text-align: left;
    background: #7FDBFF;
    color: white;
}
.progress-bar{
	height: 45px;
    width: 0;
    background-color: #0b2c4d;
	line-height:45px;
}
.status{
	top:3px;
	left:0%;
	width:100%;
	text-align:center;
	position:absolute;
	line-height:45px;
	display:inline-block;
	color: #000000;
}
.imagenmaestro{
    width: 100%;
    padding-bottom: 100%;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    border-radius: 50%;
    background-image: url("../images/iconusuario.png");
}

.card a:link{
    color: black;
}
.card a:visited{
    color: black;
}

a:link{
    color: white;
    text-decoration: none;
}
a:visited{
    color: white;
    text-decoration: none;

}

.contiene{
    width: calc(70% - 10px);
    margin: 5px;
}

.atributo{
    font-weight: bold;
    color: steelblue;
    font-size: 16px;
    text-align: center;
}

.dato{
    color:black;
    font-weight: bold;
    font-size: 14px;
}


</style>
<!--Fin estilos CSS-->

<!--Javascript-->
<script type="text/javascript" >
function valida_envia(formnumber) {

//validamos que no esten vacíos los campos

if ( $("#academiconombre" + formnumber).val() == '') {
    
    alert("Por favor escribe un nombre");
    $("#maestronombre" + formnumber).focus();
    return false;
}

if ( $("#maestrocorreo" + formnumber).val() == '') {
    
    alert("Por favor escribe un correo");
    $("#maestrosexo" + formnumber).focus()
    return false;
}

if ( $("#maestrosexo" + formnumber).val() == '') {
    
    alert("Porfavor selecciona una opción");
    $("#maestrosexo" + formnumber).focus()
    return false;
}

}

function enviar() {

//carga el objeto del archivo
var file = $("#foto")[0].files[0];

//Vista previa de la imagen

var reader = new FileReader();
    
//funcion que corre cuando ya se termino de subir el o los archivos
reader.addEventListener("load", function(){

 $("#contenedorimagenactual").css("background-image", "url(" + reader.result + ")");
    
}, false);

if(file){

    reader.readAsDataURL(file);
}

}


</script>



<!--Fin Javascript-->

</head>
<body>

<div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

    <div id="adminmenu" style="float: left; box-shadow: 0px 0px 10px #000; width: 20%; background-color: #1d4267; position: fixed; height: 100%; overflow: scroll;">

        <div id="logotipo" align="center" style="float: left; width: calc(100% - 60px); padding-top: 50px; padding-bottom: 30px; padding-right: 30px; padding-left: 30px;"><img src="../images/logotipo.png" alt="logotipo" style="width: 100%;"></div>

        <div id="etiquetaadmin" style="font-family: 'Montserrat', sans-serif; float: left; width: calc(80% - 20px); margin-left: 10%; margin-top: 20px; margin-bottom: 50px; text-align: center; padding: 10px; border: 1px solid white; color: white; font-size: 18px; border-radius: 20px;">Menú admin</div>

        <div id="navegacion" style="width: 100%; float: left; margin-bottom: 20px; ">
                    
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
            
            <div id="link">Maestros</div>
            
            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="materias.php">Materias</a>

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

    <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">

    <div id="contenedor-maestro<?php echo $id; ?>" class="card" align="center" style="width:calc(70% - 120px); margin-left: 15%; float: left; margin-bottom: 40px; margin-top: 50px;">

            <div id="titulo" style="width: 100%; margin-bottom: 40px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">VISTA MAESTRO</div>

            <input id="id" name="id" value="<?php echo $id; ?>" type="hidden">

            <div id="contenedorsubidaimagen" style="float: left; width: calc(30% - 20px); margin-right: 20px;">

                <div id="contenedorimagenactual" class="imagenmaestro" align="center" style="background-image: url(../images/<?php echo $imagen; ?>);"></div>

            </div>

            <div id="up<?php echo $id; ?>" style="width:calc(100% - 22px); font-family: 'Montserrat', sans-serif; margin-left: 10px; color: white; margin-right: 10px; height:45px; float:left; position:relative; z-index:1;  border-radius:5px; overflow:hidden; border:solid 1px #7FDBFF; margin-top: 10px; margin-bottom: 10px; display: none; visibility:hidden;">

                 <div id="progress-wrp<?php echo $id; ?>" style="color: white;" class="progress-wrp"><div class="progress-bar"></div ><div class="status" style="color: white; ">0%</div></div>

            </div>
			
           <div id="nombre" class="contiene" align="left" style=" float: left;">
           	
           		<div id="etiquetanombre" class="atributo" style="float: left; width: 40%; margin-top: 5px; text-transform: uppercase; font-family: 'Open Sans', sans-serif;">Nombre: </div>
           		
           		<div id="maestronombre" name="maestronombre" placeholder="Escribe un nombre" style="resize: none;   background-color: white; width: calc(60% - 12px); margin-bottom: 10px; padding: 5px; float: left; " type="text" value=""><?php echo $nombre; ?> </div>
           	
           </div>
           
           <div id="genero" class="contiene" align="left" style=" float: left;">
           
           		<div id="etiquetagenero" class="atributo" style="float: left; width: 40%; text-transform: uppercase;  font-family: 'Open Sans', sans-serif;">Sexo:</div>
                
                <div id="generomaestro" style="resize: none;   background-color: white; width: calc(60% - 12px); margin-bottom: 10px; padding: 5px; float: left; " value=""> <?php echo $sexo; ?> </div>
                
			</div>
            
            
            <div id="correo" class="contiene" align="left" style="float: left;">
           	
           		<div id="etiquetacorreo" class="atributo" style="float: left; width: 40%; margin-top: 5px; text-transform: uppercase;  font-family: 'Open Sans', sans-serif;">Correo: </div>
           		
           		<div id="maestrocorreo" name="maestrocorreo" placeholder="Escribe un correo" style="resize: none; background-color: #0b2c4d;  background-color: white; width: calc(60% - 12px); margin-bottom: 10px; padding: 5px; float: left; " type="text" value="<?php echo $nombre; ?>"><?php echo $correo; ?></div>
           	
           </div>
                     
           <div id="contrasena" class="contiene" align="left" style=" float: left;">
           	
           		<div id="etiquetacontrasena" class="atributo" style="float: left; width: 40%; margin-top: 5px; text-transform: uppercase;  font-family: 'Open Sans', sans-serif;">Contraseña: </div>
           		
           		<div id="maestrocontrasena" name="maestrocontrasena" placeholder="Escribe una contraseña" style="resize: none; background-color: #0b2c4d;  background-color: white; width: calc(60% - 12px); margin-bottom: 10px; padding: 5px; float: left; " type="text" value="<?php echo $contrasena; ?>">*******</div>
           	
           </div>     	
           
                <div id="botones" align="center" style="width:100%; float: left;  margin:5% 0px;">
            
            		<button type="button" name="Cancelar" value="Cancelar" onclick="window.location='maestros.php'" style="border-radius: 10px; line-height: 30px; background-color: #00020287; border-color: #b6b8b9; padding-left: 20px; padding-right: 20px; color: #ced2d4; cursor: pointer;">Regresar</button>
            	
            	</div>
          
    </div><!--Fin de contenedor-nuevomaestro-->

</div>
</body>
</html>