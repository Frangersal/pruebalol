<?php require_once('../Connections/conamatenlinea.php');
session_start();

if($_SESSION['sesionmaestro'] == "") {
	
	header("Location: ../index.php");

} else{

    $maestro = $_SESSION['sesionmaestro'];
    $time = time();
}

$exito = $_GET['exito'];

//Necesaria para la imagen y nombre del maestro

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM maestros WHERE usuario = '$maestro'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$idmaestro = $row_Recordset1['id'];
$imagenactual = $row_Recordset1['imagen'];
$nombre = $row_Recordset1['nombre'];
$correo = $row_Recordset1['correo'];
$contrasena = $row_Recordset1['contrasena'];

//--->

$query_Recordset2 = "SELECT * FROM materiascurso WHERE idmaestro = '$idmaestro' GROUP BY idcurso";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$idcurso = $row_Recordset2['idcurso'];

$query_Recordset3 = "SELECT * FROM cursos WHERE id = '$idcurso'";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3); 

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
    font-weight: bold;
    width: 100%;
    background-color: #0b2c4d; 
    color: white;
    height: 50px;
}
.topcell {
    float: left; 
    width: calc(25% - 2px);
    line-height: 30px;
    text-align: center;
    margin: 10px;
}
.row {
    float:left;
    width: 80%;
    background-color: whitesmoke; 
    margin:10px 10%;
}
.cell {
    font-weight: bold;
    float: left; 
    width: calc(25% - 2px);
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

.opcion:hover {
	background-color: #2a3444 !important;
	border-left: 4px solid #4a8ab1 !important;
	cursor: pointer;
}

.nombreopcion:hover {
		cursor: pointer !important;
}

#materia:hover{
    color:salmon !important;
}

.vermateria:hover{
    background: #366a95 !important;
    color: white !important;
}

.bloques:hover{
    background: #a13434 !important;
    color: white !important;
}

.calificaciones:hover{
    background: #459fe9 !important;
    color: white !important;
}

.sesiones:hover{
    background: #a76192 !important;
    color: white !important;
}

.libros:hover{
    background: #4b9b4d !important;
    color: white !important;
}
	

</style>
<!--Fin estilos CSS-->

<!--Javascript-->
<script type="text/javascript">
	
$(document).ready(function() {
	
	$("#botonimagen").hide();
	
});
	
function CambiarNombre() {
	
	var ocultarcambiarnombre = document.getElementById("contenidocambiarnombre");
	var ocultardatos = document.getElementById("mostrardatos");
	
	if (ocultarcambiarnombre.style.display == "block")  {
		
		ocultarcambiarnombre.style.display = "none";
		ocultardatos.style.display = "block";
		
	} else {
		
		ocultarcambiarnombre.style.display = "block";
		ocultardatos.style.display = "none";
	}
}

function CancelarNombre() {
	
	var ocultarcambiarnombre = document.getElementById("contenidocambiarnombre");
	var ocultardatos = document.getElementById("mostrardatos");
	
	if(ocultarcambiarnombre.style.display == "block") { 
	
		ocultardatos.style.display = "block";
	    ocultarcambiarnombre.style.display = "none";

	}
}

function CambiarCorreo() {
	
	var ocultarcambiarcorreo = document.getElementById("contenidocambiarcorreo");
	var ocultardatos = document.getElementById("mostrardatos");
	
	if (ocultarcambiarcorreo.style.display == "block")  {
		
		ocultarcambiarcorreo.style.display = "none";
		ocultardatos.style.display = "block";
		
	} else {
		
		ocultarcambiarcorreo.style.display = "block";
		ocultardatos.style.display = "none";
	}
}
	
function CancelarCorreo() {
	
	var ocultarcambiarcorreo = document.getElementById("contenidocambiarcorreo");
	var ocultardatos = document.getElementById("mostrardatos");
	
	if(ocultarcambiarcorreo.style.display == "block") { 
	
		ocultardatos.style.display = "block";
	    ocultarcambiarcorreo.style.display = "none";

	}
}
		
function CambiarContrasena() {
	
	var ocultarcambiarcontrasena = document.getElementById("contenidocambiarcontrasena");
	var ocultardatos = document.getElementById("mostrardatos");
	
	if (ocultarcambiarcontrasena.style.display == "block")  {
		
		ocultarcambiarcontrasena.style.display = "none";
		ocultardatos.style.display = "block";
		
	} else {
		
		ocultarcambiarcontrasena.style.display = "block";
		ocultardatos.style.display = "none";
	}
}

function CancelarContrasena() {
	
	var ocultarcambiarcontrasena = document.getElementById("contenidocambiarcontrasena");
	var ocultardatos = document.getElementById("mostrardatos");
	
	if(ocultarcambiarcontrasena.style.display == "block") { 
	
		ocultardatos.style.display = "block";
	    ocultarcambiarcontrasena.style.display = "none";

	}
}
	
function guardarformcambiarnombre() {

	var form_data = new FormData();
	var nombre = $("#nombremaestro").val();
	
    form_data.append('nombremaestro', nombre);
    
$.ajax({
	url : "cambiarnombremaestro.php",
	type: "POST",
	data : form_data,
	cache: false,
    contentType: false,
    processData:false,
    dataType: 'json',
  	mimeType:"multipart/form-data"
    })

alert("Se han guardado los cambios.");
window.location.reload();

}

</script>

</head>
<body>

<div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

<!--Menu plataforma educativa-->
<div id="seccionmenu" style="width: 20%; background-color: #354052; position: fixed; top: 0; left: 0; z-index: 999; height: 100%; box-shadow: 0px 0px 10px #000;">
	
		<a href="/plataformaeducativa/"><div id="logotipoplataforma" align="center" style="float: left; width: calc(70%); margin-top: 30px; margin-bottom: 30px; margin-left: 15%; margin-right: 15%;">
			<img src="../images/logoplataformaeducativa.png?id=<?php echo $unixtime; ?>" alt="logotipo" style="width: 100%; opacity: 0.8; float: left;">
		</div> </a>
		
		<?php if($imagenactual == "") { ?>
				
					 <div id="contenedorimagenactual" align="center" style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; float: left; border: 1px solid #35405263; background-image: url(../images/iconavatar.png); background-size: cover; background-position: center;">

				 </div>
					
				<?php } else if ($imagenactual != "") { ?>
				
					<div id="contenedorimagenactual" align="center" style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; position: relative; float: left; border: 1px solid #35405263; background-image: url(../images/<?php echo $imagenactual; ?>); background-size: cover; background-position: center;">
					
					</div>
					
				<?php } ?>
		
		<div id="nombre" align="center" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #abb4c1; width: 90%; letter-spacing: 0.5px; line-height: 20px; padding: 10px;">
			<?php echo $nombre ." ". $apellidopaterno ." ". $apellidomaterno; ?>
		</div>
		
		<div id="lineaseparadora1" style="width: 100%; height: 1px; background-color: #000; float: left;"></div>
		<div id="lineaseparadora2" style="width: 100%; height: 1px; background-color: #807979; float: left;"></div>
				
		<div id="opcionesmenu" style="width: 100%; float: left;">
			
            <a class="linkopcion" href="index.php" style="text-decoration: none;">

                <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconinicio.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Inicio</div>
				
					</div>
				
                </div>

            </a>

            
            <a class="linkopcion" href="./configuracionmaestro.php" style="text-decoration: none;">

				<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">

							<img class="opcionicon" src="../images/iconcursos.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Cursos</div>
				
					</div>
					
				</div>
				
            </a>
            
            
			<div class="opcionactual" style=" width: calc(100% - 4px); float: left; background-color: #2a3444; border-left: 4px solid #4a8ab1;">
               			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconconfiguracion.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Configuracion</div>
				
					</div>
			
            </div>

            <a class="linkopcion" href="../logout.php" style="text-decoration: none;">

                <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconsalir.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: pointer; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Salir</div>
				
					</div>
				
                </div>

            </a>



		</div>

			
    </div>
    <!--FIN Menu plataforma educativa-->

	
<div id="seccionprincipal" style="width: 80%; float: left; position: relative; margin-left: 20%; background-color: #fff;">		
	
	<div id="contenedorconfiguracion" style="width: calc(100% - 5%); margin: 2.5%; float: left; overflow: hidden; background-color: #fff;">
			
			<div id="contenidocambiarnombre" style="width: calc(100% - 20%); margin-left: 10%; float: left; margin-bottom: 90px; display: none; margin-top: 50px;">
			
				<div id="titulomodificarnombre" style="width: 50%; margin-top: 20px; font-family: 'Open Sans', sans-serif; font-size: 22px; color: #58504a; letter-spacing: 1.5px; float: left;">Modificar nombre</div>
				
				<div id="lineaseparadora" style="width: 100%; float: left; margin-top: 15px;">
					
					<div id="linea" style="float: left; width: 100%; height: 2px; margin-top: 8px; background-color: #e5e5e5;"></div>
					
				</div>
			
				<form id="formcambiarnombre" name="formcambiarnombre" action="cambiarnombre.php" enctype="multipart/form-data" method="post" onSubmit="return(validaenvia())" style="width: calc(100% - 20%); margin-left: 10%; margin-right: 10%; margin-top: 5%; float: left;">
				
				
					<input id="id" name="id" value="<?php echo $id; ?>" type="hidden">
            	 
            		<div id="contenedornombremaestro" style="width: 100%; float: left; margin-left: 10%;">
            			
            			<div id="nombremaestroetiqueta" style="width: 15%; float: left; font-size: 16px; font-family: 'Open Sans', sans-serif; color: #4c5669; font-weight: 600; padding-top: 5px; margin-bottom: 20px;">Nombre </div>
             	
             			<input id="nombremaestro" name="nombremaestro" placeholder="Escriba su nombre." style="resize: none; background-color: #f9fafc; font-size: 16px; width: 60%; margin-bottom: 20px; padding: 1.5%; float: left; border: 1px solid #c0c8d0; border-radius: 3px; color: #75787d;" type="text" value="<?php echo $nombre; ?>">
             		
					</div>
            	
           		
            		<div id="contenedorboton" align="center" style="float: left; width: 40%; margin-left: 20%; margin-top: 40px; margin-bottom: 40px;">
             
             			<button type="button" onclick="guardarformcambiarnombre();" style="width: 50%; margin-left: 30%; padding: 3px 5px; background-color: #fff; border: 1px solid #b1b4bf; color: #4a515d; cursor: pointer; font-family: 'Open Sans', sans-serif; float: left; font-size: 13px; border-radius: 3px;">Guardar cambios</button>
             
             		</div>
             		
             	    <a id="cancelarnombre" href="Javascript:void(0)" onclick="CancelarNombre()" style="float: left; margin-top: 40px; margin-bottom: 20px; text-decoration: none;">

						<div id="cancelartitle" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 13px; color: #4a515d; padding: 2px 30px; border: 1px solid #b1b4bf; border-radius: 3px;">Cancelar</div>
				
				    </a>
             	
			</form>
			
		</div>
		
		
		<div id="contenidocambiarcorreo" style="width: calc(100% - 20%); margin-left: 10%; float: left; margin-bottom: 90px; display: none; margin-top: 50px;">
			
				<div id="titulomodificarcorreo" style="width: 50%; margin-top: 20px; font-family: 'Open Sans', sans-serif; font-size: 22px; color: #58504a; letter-spacing: 1.5px; float: left;">Modificar correo</div>
				
				<div id="lineaseparadora" style="width: 100%; float: left; margin-top: 15px;">
					
					<div id="linea" style="float: left; width: 100%; height: 2px; margin-top: 8px; background-color: #e5e5e5;"></div>
					
				</div>
			
				<form id="formcambiarcorreo" name="formcambiarcorreo" action="cambiarcorreo.php" enctype="multipart/form-data" method="post" onSubmit="return(validaenvia())" style="width: calc(100% - 20%); margin-left: 10%; margin-right: 10%; margin-top: 5%; float: left;">
				
					<input id="id" name="id" value="<?php echo $id; ?>" type="hidden">
           	 		            	 
            		<div id="contenedorcorreo" style="width: 80%; float: left; margin-left: 10%;">
            			
            			<div id="correoetiqueta" style="width: 30%; float: left; font-size: 16px; font-family: 'Open Sans', sans-serif; color: #4c5669; font-weight: 600; padding-top: 10px; margin-bottom: 20px; margin-right: 5%;">Correo electrónico </div>
             	
             			<input id="correoalumno" name="correoalumno" placeholder="Escriba su correo electrónico." style="resize: none; background-color: #f9fafc; font-size: 16px; width: 57%; margin-bottom: 10px; padding: 1.5%; float: left; border: 1px solid #c0c8d0; border-radius: 3px; color: #75787d;" type="text" value="<?php echo $correo; ?>">
             		
					</div>
          
           
            		<div id="contenedorconfirmarcorreo" style="width: 80%; float: left; margin-left: 10%;">
            			
            			<div id="confirmarcorreoetiqueta" style="width: 30%; float: left; font-size: 16px; font-family: 'Open Sans', sans-serif; color: #4c5669; font-weight: 700; padding-top: 10px; margin-right: 5%;">Confirma tu correo </div>
             	
             			<input id="confirmarcorreo" name="confirmarcorreo" placeholder="Confirma tu correo electrónico." style="resize: none; background-color: #f9fafc; font-size: 16px; width: 57%; margin-bottom: 10px; padding: 1.5%; float: left; border: 1px solid #c0c8d0; border-radius: 3px; color: #75787d;" type="text" value="">
             		
					</div>
          		
          			
           		
            		<div id="contenedorbotonguardar" align="center" style="float: left; width: 40%; margin-left: 25%; margin-top: 40px; margin-bottom: 40px;">
             
             			<button type="button" onclick="guardarformcambiarcorreo();" style="width: 50%; margin-left: 30%; padding: 3px 5px; background-color: #fff; border: 1px solid #b1b4bf; color: #4a515d; cursor: pointer; font-family: 'Open Sans', sans-serif; float: left; font-size: 13px; border-radius: 3px;">Guardar cambios</button>
             
             		</div>
             		
             	    <a id="cancelarcorreo" href="Javascript:void(0)" onclick="CancelarCorreo()" style="float: left; margin-top: 40px; margin-bottom: 20px; text-decoration: none;">

						<div id="cancelartitle" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 13px; color: #4a515d; padding: 2px 30px; border: 1px solid #b1b4bf; border-radius: 3px;">Cancelar</div>
				
				    </a>
             	
			</form>
			
		</div>
	
		
		<div id="contenidocambiarcontrasena" style="width: calc(100% - 20%); margin-left: 10%; float: left; margin-bottom: 90px; display: none; margin-top: 50px;">
			
				<div id="titulomodificarcontrasena" style="width: 50%; margin-top: 20px; font-family: 'Open Sans', sans-serif; font-size: 22px; color: #58504a; letter-spacing: 1.5px; float: left;">Modificar contraseña</div>
				
				<div id="lineaseparadora" style="width: 100%; float: left; margin-top: 15px;">
					
					<div id="linea" style="float: left; width: 100%; height: 2px; margin-top: 8px; background-color: #e5e5e5;"></div>
					
				</div>
			
				<form id="formcambiarcontrasena" name="formcambiarcontrasena" action="cambiarcontrasena.php" enctype="multipart/form-data" method="post" onSubmit="return(validaenvia())" style="width: calc(100% - 20%); margin-left: 10%; margin-right: 10%; margin-top: 5%; float: left;">
				
					<input id="id" name="id" value="<?php echo $id; ?>" type="hidden">
           	 		            	 
            		<div id="contenedorcontrasena" style="width: 80%; float: left; margin-left: 10%;">
            			
            			<div id="contrasenaetiqueta" style="width: 30%; float: left; font-size: 16px; font-family: 'Open Sans', sans-serif; color: #4c5669; font-weight: 600; padding-top: 10px; margin-bottom: 20px; margin-right: 5%;">Contraseña </div>
             	
             			<input id="contrasena" name="contrasena" placeholder="Escriba su contraseña." style="resize: none; background-color: #f9fafc; font-size: 16px; width: 57%; margin-bottom: 10px; padding: 1.5%; float: left; border: 1px solid #c0c8d0; border-radius: 3px; color: #75787d;" type="password" value="<?php echo $contrasena; ?>">
             		
					</div>
          
           
            		<div id="contenedorconfirmarcontrasena" style="width: 80%; float: left; margin-left: 10%;">
            			
            			<div id="confirmarcontrasenaetiqueta" style="width: 30%; float: left; font-size: 16px; font-family: 'Open Sans', sans-serif; color: #4c5669; font-weight: 700; padding-top: 10px; margin-right: 5%;">Confirma tu contraseña </div>
             	
             			<input id="confirmarcontrasena" name="confirmarcontrasena" placeholder="Confirma tu contraseña." style="resize: none; background-color: #f9fafc; font-size: 16px; width: 57%; margin-bottom: 10px; padding: 1.5%; float: left; border: 1px solid #c0c8d0; border-radius: 3px; color: #75787d;" type="password" value="">
             		
					</div>
          		
           		
            		<div id="contenedorguardarcontrasena" align="center" style="float: left; width: 40%; margin-left: 25%; margin-top: 40px; margin-bottom: 40px;">
             
             			<button type="button" onclick="guardarformcambiarcontrasena();" style="width: 50%; margin-left: 30%; padding: 3px 5px; background-color: #fff; border: 1px solid #b1b4bf; color: #4a515d; cursor: pointer; font-family: 'Open Sans', sans-serif; float: left; font-size: 13px; border-radius: 3px;">Guardar cambios</button>
             
             		</div>
             		
             	    <a id="cancelarcontrasena" href="Javascript:void(0)" onclick="CancelarContrasena()" style="float: left; margin-top: 40px; margin-bottom: 20px; text-decoration: none;">

						<div id="cancelartitulo" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 13px; color: #4a515d; padding: 2px 30px; border: 1px solid #b1b4bf; border-radius: 3px;">Cancelar</div>
				
				    </a>
             	
			</form>
			
		</div>
	
			
		<div id="mostrardatos" style="width: calc(100% - 20%); margin-left: 10%; margin-right: 10%; float: left; margin-bottom: 30px;">
					
				<div id="titulo" style="width: 50%; margin-top: 8px; font-family: 'Open Sans', sans-serif; font-size: 22px; color: #515152; letter-spacing: 1px; float: left;">Datos de la cuenta</div>	
				
				<div id="lineaseparadora" style="width: 100%; float: left; margin-top: 15px;">
					
					<div id="linea" style="float: left; width: 100%; height: 2px; margin-top: 8px; background-color: #e5e5e5;"></div>
					
				</div>
		
			
            	<input id="id" name="id" value="<?php echo $id; ?>" type="hidden">
            	 
            <form id="formcambiarimagen" name="formcambiarimagen" action="configuracion.php" enctype="multipart/form-data" method="post" onSubmit="return(validaenvia())" style="width: calc(100% - 20%); margin-left: 10%; margin-right: 10%; float: left;">
            
            	<?php if ($imagenactual != "") { ?>

				 <div id="contenedorimagenactual" align="center" style="width: calc(100% - 80%); padding-bottom: 20%; margin-left: 40%; margin-right: 40%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; position: relative; float: left; background-image: url(../images/<?php echo $imagenactual; ?>); background-size: cover; background-position: center;">
					
					<div id="contenedorimagepreview" align="center" style="width: 100%; height: 100%; position: absolute;"> </div>

				 </div>
				
				<?php } else if ($imagenactual == "") { ?>
				
				<div id="contenedorimagenactual" align="center" style="width: calc(100% - 80%); padding-bottom: 20%; margin-left: 40%; margin-right: 40%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; position: relative; float: left; background-image: url(../images/iconavatar.png); background-size: cover; background-position: center;">
					
					<div id="contenedorimagepreview" align="center" style="width: 100%; height: 100%; position: absolute;"> </div>

				 </div>
				 
				 <?php } ?>
				
				 <a id="editarimagen" href="javascript:void(0)" onclick="javascript:document.getElementById('foto').click();" style="margin-left: 42%; margin-top: 5px; float: left; text-decoration: none;">
												
						<div id="iconoeditarimagen" style="width: 17px; float: left; padding-right: 8px; margin-top: 1px;">
							
							<img src="../images/iconfoto.png?id=<?php echo $unixtime; ?>" style="width: 100%; float: left; padding-right: 10px;">
							
						</div>
						
						<div id="cambiarimagentitle" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 15px; color: #637394;">Editar imagen</div>
						
						<input type="file" id="foto" name="foto" onchange="javascript:enviar();" style="display: none;" accept="image/jpeg" />  
	
				</a>
           		
           		<div id="botonimagen" align="center" style="float: left; width: calc(100% - 60%); margin-left: 30%; margin-right: 30%; margin-top: 20px; margin-bottom: 20px;">
             		
             		<button type="button" id="botonguardarimagen" onclick="guardarimagen();" style="width: 40%; margin-left: 32%; padding: 3px 5px; background-color: #fff; border-color: #8d98ac; color: #637394; cursor: pointer; font-family: 'Open Sans', sans-serif; float: left; letter-spacing: 1px; border: 1px solid #acb6c5; border-radius: 3px; font-size: 12px;">GUARDAR</button>
             
             	</div>
             	
			</form>
            
             
             <div id="contenedornombremaestro" style="width: calc(100% - 20%); float: left; margin-left: 10%; margin-right: 10%; margin-top: 40px; height: 30px; margin-bottom: 10px;">
             	
             	<div id="nombremaestroetiqueta" align="left" style="width: 35%; margin-right: 5%; float: left; font-size: 16px; font-family: 'Open Sans', sans-serif; color: #4c5669; font-weight: 600; margin-bottom: 20px;">Nombre </div>
             	
             	<div id="nombremaestrocontenido" align="left" style="width: 45%; float: left; font-size: 16px; font-family: 'Open Sans', sans-serif; color: #67737d;"><?php echo $nombre; ?> </div>
             	
             	<a id="editarnombre" href="Javascript:void(0)" onclick="CambiarNombre()" style="margin-right: 5%; margin-left: 5%; margin-top: 5px; float: left; text-decoration: none;">
						
						<div id="iconoeditarnombre" style="width: 15px; float: left; padding-right: 5px;">
							
							<img src="../images/iconeditar.png?id=<?php echo $unixtime; ?>" style="width: 100%; float: left; padding-right: 10px;">
							
						</div>
				</a>
             	
             </div>
             
             <div id="lineaseparadora1" style="width: 82%; margin-left: 6%; float: left; margin-top: 15px; margin-bottom: 30px;">
					
					<div id="linea1" style="float: left; width: 100%; height: 1px; margin-top: 8px; background-color: #e3e5e6;"></div>
					
			 </div>

             <div id="contenedorcorreoalumno" style="width: calc(100% - 20%); float: left; margin-left: 10%; margin-right: 10%; margin-bottom: 10px; height: 30px;">
             	
             	<div id="correoalumnoetiqueta" align="left" style="width: 35%; margin-right: 5%; float: left; font-size: 16px; font-family: 'Open Sans', sans-serif; color: #4c5669; font-weight: 600;">Correo electrónico</div>
             	
             	<div id="correoalumnocontenido" align="left" style="width: 45%; float: left; font-size: 16px; font-family: 'Open Sans', sans-serif; color: #67737d;"><?php echo $correo; ?></div>
             	
             	<a id="editarcorreo" href="Javascript:void(0)" onclick="CambiarCorreo()" style="margin-right: 5%; margin-left: 5%; margin-top: 5px; float: left; text-decoration: none;">
						
						<div id="iconoeditarcorreo" style="width: 15px; float: left; padding-right: 5px;">
							
							<img src="../images/iconeditar.png?id=<?php echo $unixtime; ?>" style="width: 100%; float: left; padding-right: 10px;">
							
						</div>	
				</a>
             	
			</div>
           
            
             <div id="lineaseparadora2" style="width: 82%; margin-left: 6%; float: left; margin-top: 15px; margin-bottom: 30px;">
					
					<div id="linea2" style="float: left; width: 100%; height: 1px; margin-top: 8px; background-color: #e3e5e6;"></div>
					
			 </div>
             
			<div id="contenedorcontrasena" style="width: calc(100% - 20%); float: left; margin-left: 10%; margin-right: 10%; margin-bottom: 10px; height: 30px;">
             	
             	<div id="contrasenaetiqueta" align="left" style="width: 35%; margin-right: 5%; float: left; font-size: 16px; font-family: 'Open Sans', sans-serif; color: #4c5669; font-weight: 600;">Contraseña </div> 
             	
             	<div id="contrasenacontenido" align="left" style="width: 45%; float: left; font-size: 16px; font-family: 'Open Sans', sans-serif; color: #67737d;">
             	
             		<input id="mostrarcontrasena" name="mostrarcontrasena" type="password" value="<?php echo $contrasena; ?>" style="float: left; border: 0; font-size: 14px; letter-spacing: 1px; color: #67737d;" readonly /></div>
				
             	
             	<a id="editarcontrasena" href="Javascript:void(0)" onclick="CambiarContrasena()" style="margin-right: 5%; margin-left: 5%; margin-top: 5px; float: left; text-decoration: none;">
						
						<div id="iconoeditarcontrasena" style="width: 15px; float: left; padding-right: 5px;">
							
							<img src="../images/iconeditar.png?id=<?php echo $unixtime; ?>" style="width: 100%; float: left; padding-right: 10px;">
							
						</div>	
				</a>
			
			</div>
			
		</div>
		
	</div>
	
  </div> <!--Fin sección principal-->
  
</div>

</body>
</html>
