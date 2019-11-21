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

if ($_POST) {

    $foto = basename($_FILES['foto']["name"]);
    $nombre = addslashes(addslashes(trim($_POST["maestronombre"])));
	$sexo = $_POST["sexo"];
    $correo = addslashes(addslashes(trim($_POST["maestrocorreo"])));
	$contrasena = addslashes(addslashes(trim($_POST["maestrocontrasena"])));
    $id = addslashes(addslashes(trim($_POST["id"])));

	mysql_select_db($database_conamatenlinea, $conamatenlinea);
	$query_Recordset3 = "SELECT * FROM maestros WHERE id = '$id'";
	$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
	$row_Recordset3 = mysql_fetch_assoc($Recordset3);
	$totalRows_Recordset3 = mysql_num_rows($Recordset3);

    $imagenactual = $row_Recordset3['imagen'];
    
    if ($foto != "") {

    //Subida de la foto
		$foto = basename($_FILES['foto']["name"]);

		$tempFile = $_FILES['foto']["tmp_name"];
		$numero1 = substr(md5(rand(0,9999)), 17, /*Numero de Digitos*/5);
    	$name1 = date("dmY").$numero1;
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

    if ( $imagenactual) { 
        unlink("../images/" . $imagenactual);
    }

    mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Modificó un maestro', '$unixtime')"); 

    mysql_query("UPDATE maestros SET nombre = '$nombre', sexo = '$sexo', correo = '$correo', contrasena = '$contrasena', imagen = '$newFileName1' WHERE id = '$id'");
    
} else { 


        mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Modificó un maestro', '$unixtime')"); 

        mysql_query("UPDATE maestros SET nombre = '$nombre', sexo = '$sexo', correo = '$correo', contrasena = '$contrasena', imagen = '$imagenactual' WHERE id = '$id'");

    }

header("Location: maestros.php");

}

//Fin del POST


$id = $_GET['id'];
    
mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM maestros WHERE id = '$id'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$nombre = $row_Recordset1['nombre'];
$sexo = $row_Recordset1['sexo'];
$correo = $row_Recordset1['correo'];
$contrasena = $row_Recordset1['contrasena'];
$imagen = $row_Recordset1['imagen'];
$cedula = $row_Recordset1['cedula'];
$id = $row_Recordset1['id'];


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
        
        <form id="maestroform<?php echo $id; ?>" action="modificarmaestro.php" onSubmit="valida_envia()" name="maestroform<?php echo $id; ?>" enctype="multipart/form-data" method="post">

            <div id="titulo" style="width: 100%; margin-bottom: 40px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Modificar maestro</div>

            <input id="id" name="id" value="<?php echo $id; ?>" type="hidden">

            <div id="contenedorsubidaimagen" style="float: left; width: calc(30% - 20px); margin-right: 20px;">

                <div id="contenedorimagenactual" class="imagenmaestro" align="center" style="background-image: url(../images/<?php echo $imagen; ?>);"></div>

                 <a href="javascript:void(0);" onclick="javascript:document.getElementById('foto').click();"><div id="botonfile" align="center" style="border: 1px solid #1d4267; background-color: #1d4267; margin-top: 20px; color: #7FDBFF; padding:10px; cursor:pointer; width: calc(100% - 22px); float: left;">

                    <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; background-color: #1d4267; height:0px; display:block;">

                    <div style="font-size:12px;">Elegir imagen</div>

                    <input type="file" id="foto" name="foto" onchange="javascript:enviar('<?php echo $id; ?>');" style="display: none;" accept="image/jpeg" />  
                    
                </div></a>

            </div>

            <div id="up<?php echo $id; ?>" style="width:calc(100% - 22px); font-family: 'Montserrat', sans-serif; margin-left: 10px; color: white; margin-right: 10px; height:45px; float:left; position:relative; z-index:1;  border-radius:5px; overflow:hidden; border:solid 1px #7FDBFF; margin-top: 10px; margin-bottom: 10px; display: none; visibility:hidden;">

                 <div id="progress-wrp<?php echo $id; ?>" style="color: white;" class="progress-wrp"><div class="progress-bar"></div ><div class="status" style="color: white; ">0%</div></div>

            </div>
			
           <div id="nombre" align="left" style="width: 70%; float: left;">
           	
           		<div id="etiquetanombre" style="float: left; width: 40%; margin-top: 5px; text-transform: uppercase; font-size: 12px; font-family: 'Open Sans', sans-serif;">Nombre: </div>
           		
           		<input id="maestronombre" name="maestronombre" placeholder="Escribe un nombre" style="resize: none; background-color: #0b2c4d; font-size: 12px; background-color: white; width: calc(60% - 12px); margin-bottom: 10px; padding: 5px; float: left; border: 1px solid lightgray;" type="text" value="<?php echo $nombre; ?>">
           	
           </div>
           
           
           <div id="genero" align="left" style="width: 70%; float: left;">
           
           		<div id="etiquetagenero" style="float: left; width: 30%; margin-top: 10px; text-transform: uppercase; font-size: 12px; font-family: 'Open Sans', sans-serif;">Sexo:</div>
                
                	<div id="opciones" style="font-family: arial; margin-top: 10px; font-size: 14px; float: left; margin-bottom: 20px; width: 60%; margin-left: 30px;">
                   
                    	<input id="masculino" type="radio" name="sexo" style="margin-left: 20px;" value="masculino"<?php if ($sexo == 'masculino') {echo 'checked'; } ?>>Masculino
                    
                    	<input id="femenino" type="radio" name="sexo" style="margin-left: 40px;" value="femenino"<?php if ($sexo == 'femenino') {echo 'checked'; } ?>>Femenino
                    
                	</div>
                
			</div>
            
            
            <div id="correo" align="left" style="width: 70%; float: left;">
           	
           		<div id="etiquetacorreo" style="float: left; width: 40%; margin-top: 5px; text-transform: uppercase; font-size: 12px; font-family: 'Open Sans', sans-serif;">Correo: </div>
           		
           		<input id="maestrocorreo" name="maestrocorreo" placeholder="Escribe un correo" style="resize: none; background-color: #0b2c4d; font-size: 12px; background-color: white; width: calc(60% - 12px); margin-bottom: 10px; padding: 5px; float: left; border: 1px solid lightgray;" type="text" value="<?php echo $nombre; ?>">
           	
           </div>
                     
           
           <div id="contrasena" align="left" style="width: 70%; float: left;">
           	
           		<div id="etiquetacontrasena" style="float: left; width: 40%; margin-top: 5px; text-transform: uppercase; font-size: 12px; font-family: 'Open Sans', sans-serif;">Contraseña: </div>
           		
           		<input id="maestrocontrasena" name="maestrocontrasena" placeholder="Escribe una contraseña" style="resize: none; background-color: #0b2c4d; font-size: 12px; background-color: white; width: calc(60% - 12px); margin-bottom: 10px; padding: 5px; float: left; border: 1px solid lightgray;" type="text" value="<?php echo $contrasena; ?>">
           	
           </div>     
               	
           <div id="recontrasena" align="left" style="width: 70%; float: left;">
           	
           		<div id="etiquetarecontra" style="float: left; width: 40%; margin-top: 5px; text-transform: uppercase; font-size: 12px; font-family: 'Open Sans', sans-serif;">Confirma la contraseña: </div>
           		
           		<input id="maestrorecontrasena" name="maestrorecontrasena" placeholder="Confirma la contraseña" style="resize: none; background-color: #0b2c4d; font-size: 12px; background-color: white; width: calc(60% - 12px); margin-bottom: 10px; padding: 5px; float: left; border: 1px solid lightgray;" type="text" value="<?php echo $contrasena; ?>">
           	
           </div>                   
                	
           
                <div align="center" style="margin-left: 12%; float: left; margin-top: 10%; margin-bottom: 10%;">
            
            		<div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 20px; margin-bottom: 20px;">
            		
            			<button type="submit" style="border-radius: 10px; line-height: 30px; background-color: #1d4267; border-color: #7FDBFF; padding-left: 20px; padding-right: 40px; margin-top: 20px; color: #7FDBFF; cursor: pointer; margin-right: 30px;">Guardar cambios</button>
            
            			<input type="button" name="Cancelar" value="Cancelar" onclick="window.location='maestros.php'" style="border-radius: 10px; line-height: 30px; background-color: #00020287; border-color: #b6b8b9; padding-left: 20px; padding-right: 20px; margin-top: 20px; color: #ced2d4; cursor: pointer;">
            		
            		</div>
            	
            	</div>
            	
        </form>
    
    </div><!--Fin de contenedor-nuevomaestro-->

</div>
</body>
</html>
