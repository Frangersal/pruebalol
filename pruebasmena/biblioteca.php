<?php require_once('../Connections/conamatenlinea.php');
session_start();
$unixtime = time();


if ($_SESSION['sesionalumno'] == "") {
    
    header("Location: login.php");

}else{

    $alumno = $_SESSION['sesionalumno'];
    $time = time();
}

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM alumnos WHERE matricula = '$alumno'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$id = $row_Recordset1['id'];
$imagenactual = $row_Recordset1['imagen'];
$nombrealumno = $row_Recordset1['nombrealumno'];
$apellidopaterno = $row_Recordset1['apellidopaterno'];
$apellidomaterno = $row_Recordset1['apellidomaterno'];

$query_Recordset3 = "SELECT * FROM inscripciones WHERE idalumno = '$id'";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$idcurso = $row_Recordset3['idcurso'];

$query_Recordset4 = "SELECT * FROM cursos WHERE id = '$idcurso'";
$Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

$query_Recordset10 = "SELECT MAX(nummodulo) AS 'nummodulos' FROM materiascurso WHERE idcurso = '$idcurso'";
$Recordset10 = mysql_query($query_Recordset10, $conamatenlinea) or die(mysql_error());
$row_Recordset10 = mysql_fetch_assoc($Recordset10);
$totalRows_Recordset10 = mysql_num_rows($Recordset10); 

$nummodulos = $row_Recordset10['nummodulos'];
$modulo = 1;


?>

<!doctype html>
<html><head>
<meta charset="utf-8">
<title>Conamat | Plataforma Educativa</title>

<!--Librerias/packages-->
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.3.1.js"  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
      crossorigin="anonymous"></script>

<style>

body{
    margin: 0;
    font-family: 'Montserrat', sans-serif;
}

.opcion:hover {
	background-color: #2a3444 !important;
	border-left: 4px solid #4a8ab1 !important;
	cursor: pointer;
}

.cambiarimagentitle:hover {
		cursor: pointer !important;
}

.cambiarimagentitle:active {
	border-bottom: 2px solid #a7adbf !important;
	color: #3e3f42 !important;
}

#fotodeperfiltitulo {
	float: left; 
	width: calc(100% - 40%); 
	margin-left: 20%; 
	margin-right: 20%; 
	font-family: 'Montserrat', sans-serif; 
	font-size: 12px; 
	text-transform: uppercase; 
	color: #465670;
}

}
.opcionmenutop a:link {
	font-family: 'Open Sans', sans-serif; 
	font-size: 14px; 
	padding-bottom: 3px; 
	letter-spacing: 1.3px; 
	float: left; 
	color: #75777d;
	border-bottom: 2px solid #e4e7ec !important;
	text-decoration: none !important;
}
	
.opcionmenutop a:active {
	color: black !important;
}

.opcionmenutop a:hover {
	color: black !important;
	
}

menu{
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
            padding: 20px 50px;
        }


.toprow{
            float:left;
            width: 100%;
            background-color: #0b2c4d; 
            color: white;
            min-height: 50px;
        }
        .topcell{
            float: left; 
            width: calc(25% - 2px);
            line-height: 50px;
            text-align: center;
        }
        .row{
            float:left;
            width: 100%;
            background-color: white; 
        }
        .cell{
            float: left; 
            width: calc(25% - 2px);
            border: 1px solid lightgray;
            line-height: 30px;
            text-align: center;
        }
        .nostyle:link{
            color: #222;
            text-decoration: none;
        }
        .nostyle:visited{
            color: #222;
            text-decoration: none;
        }
        #librolink:hover{
            background-color: #0b2c4d; 
            color: white;
        }
        .botonmodulo:hover {
            background-color: #6b7584;
            color: white !important;
        }
</style>
<script>
    function regresar(num) {

        $("#tablabiblioteca").hide();
        $(".modulo").hide();
        $("#seleccionarmodulo").show();
    
    }
</script>
<script>
    function vermodulo(num) {

        $("#seleccionarmodulo").hide();
        $("#tablabiblioteca").show();
        $("#modulo" + num).show();
    
    }
</script>

<script type="text/javascript">
	
$(document).ready(function() {
	
	$("#botonimagen").hide();
	
});
	
function validaenvia() {
	
    if (document.formcambiarnombre.nombrealumno.value == "") {

        alert("Por favor escribe tu nombre.");
        document.formcambiarnombre.nombrealumno.focus()
        return false;

    }
	
	if(document.formcambiarnombre.apellidopaterno.value == "") {
		
		alert("Por favor escribe tu apellido paterno.");
		document.formcambiarnombre.apellidopaterno.focus()
		return false;
	}
	
	if(document.formcambiarnombre.apellidomaterno.value == "") {
		
		alert("Por favor escribe tu apellido materno.");
		document.formcambiarnombre.apellidomaterno.focus()
		return false;
	}
	
	
	if (document.formcambiarcontrasena.confirmarcontrasena.value != document.formcambiarcontrasena.contrasena.value) {

        alert("Las contraseñas no coinciden.");
        document.formcambiarcontrasena.confirmarcontrasena.focus()
        return false;

    }

}
	
function guardarimagen() {
	
	var form_data = new FormData();
	
	form_data.append('foto', $('#foto')[0].files[0]);
	
	$.ajax({
	url : "cambiarimagen.php",
	type: "POST",
	data : form_data,
	cache: false,
    contentType: false,
    processData:false,
    dataType: 'json',
  	mimeType:"multipart/form-data"
    }).done(function(res){

        if (res.mensaje1 == "completo") {

            $("#foto").val('');
            $("#botonimagen").hide();

        } else {

            $("#botonimagen").hide();
            alert(res.mensaje2);
            return false;

        }
});
	location.reload();
    alert("Se han guardado los cambios.");
	
}
	

function guardarformcambiarnombre() {

	var form_data = new FormData();
	var nombre = $("#nombrealumno").val();
	var apellidopat = $("#apellidopaterno").val();
	var apellidomat = $("#apellidomaterno").val();
	
    form_data.append('nombrealumno', nombre);
	form_data.append('apellidopaterno', apellidopat);
	form_data.append('apellidomaterno', apellidomat);
    
$.ajax({
	url : "cambiarnombre.php",
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
	
function guardarformcambiarcorreo() {

	var form_data = new FormData();
	var correoelectronico = $("#correoalumno").val();
	var confirmarcorreo = $("#confirmarcorreo").val();
	
	if (confirmarcorreo != correoelectronico ) {
        alert("Los correos no coinciden.");
        document.correoelectronico.focus()
        return false;
    }
	
    form_data.append('correo' , correoelectronico);
	
$.ajax({
	url : "cambiarcorreo.php",
	type: "POST",
	data : form_data,
	cache: false,
    contentType: false,
    processData:false,
    dataType: 'json',
    mimeType:"multipart/form-data"
    }).done(function(res){

        if (res.mensaje1 == "completo") {

            alert("Se han guardado los cambios");

        } else {
            alert(res.mensaje2);
            return false;
        }
	
})
	
alert("Se han guardado los cambios.");
window.location.reload();

}
	
	
function guardarformcambiarcontrasena() {

	var form_data = new FormData();
	var contrasenaalumno = $("#contrasena").val();
	var confirmarcontrasena = $("#confirmarcontrasena").val();
	
	if (confirmarcontrasena != contrasenaalumno) {
        alert("Las contraseñas no coinciden.");
        document.contrasenaalumno.focus()
        return false;
    }
	
    form_data.append('contrasena' , contrasenaalumno);
	
$.ajax({
	url : "cambiarcontrasena.php",
	type: "POST",
	data : form_data,
	cache: false,
    contentType: false,
    processData:false,
    dataType: 'json',
    mimeType:"multipart/form-data"
    }).done(function(res){

        if (res.mensaje1 == "completo") {

            alert("Se han guardado los cambios.");

        } else {
            alert(res.mensaje2);
            return false;
        }
	
})
	
alert("Se han guardado los cambios.");
window.location.reload();
}
	

function enviar() {

    var file = $("#foto")[0].files[0];

    var reader = new FileReader();
        
    //funcion que corre cuando ya se termino de subir el o los archivos
    reader.addEventListener("load", function(){

        var imagen = '<img src="' + reader.result + '" id="contenedorimagenactual" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; object-fit: cover;">'

        $("#contenedorimagepreview").html(imagen);
		$("#botonimagen").show();
        
    }, false);

    if(file){

        reader.readAsDataURL(file);
    }

}
	
	
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
	
function CancelarNombre() {
	
	var ocultarcambiarnombre = document.getElementById("contenidocambiarnombre");
	var ocultardatos = document.getElementById("mostrardatos");
	
	if(ocultarcambiarnombre.style.display == "block") { 
	
		ocultardatos.style.display = "block";
	    ocultarcambiarnombre.style.display = "none";

	}
}
	
function CancelarImagen() {
	
	var ocultarcambiarimagen = document.getElementById("contenidocambiarimagen");
	var ocultardatos = document.getElementById("mostrardatos");
	
	if(ocultarcambiarimagen.style.display == "block") { 
	
		ocultardatos.style.display = "block";
	    ocultarcambiarimagen.style.display = "none";
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
	
function CancelarContrasena() {
	
	var ocultarcambiarcontrasena = document.getElementById("contenidocambiarcontrasena");
	var ocultardatos = document.getElementById("mostrardatos");
	
	if(ocultarcambiarcontrasena.style.display == "block") { 
	
		ocultardatos.style.display = "block";
	    ocultarcambiarcontrasena.style.display = "none";

	}
}

</script>

</head>
<body>

<div id="wrapper" style="width: 100%; float: left; height: 100vh; position: relative;">

	<!--Menu Plataforma educativa-->
	<div id="seccionmenu" style="width: 20%; background-color: #354052; position: fixed; top: 0; left: 0; z-index: 999; height: 100%; box-shadow: 0px 0px 10px #000;">
	
		<a href="/plataformaeducativa/"><div id="logotipoplataforma" align="center" style="float: left; width: 70%; margin-top: 30px; margin-bottom: 30px; margin-left: 15%; margin-right: 15%;">
			<img src="../images/logoplataformaeducativa.png?id=<?php echo $unixtime; ?>" alt="logotipo" style="width: 100%; opacity: 0.8; float: left;">
			</div></a>
			
				<?php if($imagenactual == "") { ?>
				
					 <div id="contenedorimagenactual" align="center" style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; border-radius: 50%; float: left; background-image: url(../images/iconavatar.png); background-size: cover; background-position: center; background-color: #bec5d5;">

				 </div>
					
				<?php } else if ($imagenactual != "") { ?>
				
					<div id="contenedorimagenactual" align="center" style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; border-radius: 50%; position: relative; float: left; box-shadow: 0px 0px 2px 0px #272d38; background-image: url(../images/<?php echo $imagenactual; ?>); background-size: cover; background-position: center; background-color: #bec5d5;">
					
					</div>
					
				<?php } ?>


		<div id="nombrealumno" align="center" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #abb4c1; width: 90%; letter-spacing: 0.5px; line-height: 20px; padding: 10px;">
			<?php echo $nombrealumno .  " " . $apellidopaterno . " " . $apellidomaterno; ?>
		</div>
		
		<div id="lineaseparadora1" style="width: 100%; height: 1px; background-color: #000; float: left;"></div>
		<div id="lineaseparadora2" style="width: 100%; height: 1px; background-color: #807979; float: left;"></div>
		
		<div id="opcionesmenu" style="width: 100%; float: left;">
		
		<a class="linkopcion"  href="index.php" style="text-decoration: none;">	
			<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
				<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
					<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
						<img class="opcionicon" src="../images/iconinicio.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
					</div>
				
					<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Inicio</div>
				
				</div>
				
			</div>
			</a>
			
						
			<a class="linkopcion"  href="configuracion.php" style="text-decoration: none;">
				<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
				
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconconfiguracion.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Configuración</div>
				
					</div>
				
				</div>
            </a>
			
			
			<a class="linkopcion"  href="pagos.php" style="text-decoration: none;">
				<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
				
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconpagos.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Pagos</div>
				
					</div>
				
				</div>
			
			</a>
			
				
			<a class="linkopcion"  href="curso.php" style="text-decoration: none;">
				<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconcursos.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Curso</div>
				
					</div>
					
				</div>
				
			</a>
			
			
				<div class="opcion" style="width: calc(100% - 4px); float: left; background-color: #2a3444; border-left: 4px solid #4a8ab1;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconbiblioteca.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Biblioteca</div>
				
					</div>
					
				</div>
				
			
			<a class="linkopcion"  href="ayuda.php" style="text-decoration: none;">
				<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconayuda.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Ayuda</div>
				
					</div>
					
				</div>
				
			</a>
			
				
			<a class="linkopcion"  href="../logout.php" style="text-decoration: none;">
				
				<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
				
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconsalir.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Salir</div>
						
					</div>
				
				</div>
				
			</a>
				
		</div>
			
	</div>
	
<div id="seccionprincipal" style="width: 80%; height: 100vh; float: left; position: relative; margin-left: 20%; background-color: #fff;">		
  <!--FIN Menu Plataforma educativa-->  


    <!-- Contenedor biblioteca-->
	<div id="contenedor-biblioteca" class="card" style="width:calc(100% - 100px); float: left;">
           


  <div id="titulo" align="center" style="width: 100%; float: left; margin-top: 30px; margin-bottom: 50px; font-family: 'Montserrat', sans-serif; font-size: 22px; text-transform: uppercase; letter-spacing: 2px; font-weight: bold;">Biblioteca</div>

<div id="seleccionarmodulo" style="width: 70%; float: left; margin-left: 15%; margin-right: 15%; margin-bottom: 50px;">

	
		<div id="texto" align="center" style="width: 100%; float: left; font-size: 18px; color: #44618C; letter-spacing: 3px; text-align: center; padding: 10px; font-family: 'Montserrat', sans-serif; text-transform: uppercase; margin-bottom: 30px; margin-left: 15px; margin-right: 15px;">Selecciona un módulo:</div>

<?php 

    do {

?>
        <div id="botonmodulo<?php echo $modulo; ?>" class="botonmodulo" onclick="vermodulo(<?php echo $modulo ?>);" style="width: calc(33.33% - 62px); border: 2px solid #54647d; color: #54647d; border-radius: 6px; float: left; font-size: 15px; letter-spacing: 3px; text-align: center; padding-top: 25px; padding-bottom: 25px; padding-left: 10px; padding-right: 10px; cursor: pointer; font-family: 'Montserrat', sans-serif; text-transform: uppercase; font-weight: bold; margin: 15px;">Módulo <?php echo $modulo; ?>.
		</div>

<?php
    $modulo = $modulo + 1;

    } while($modulo <= $nummodulos); 

    ?>

	</div>


            <div id="tablabiblioteca" style="float: left; margin-bottom: 100px; width: 100%; display: none;">


<?php 

    if($totalRows_Recordset4 > 0 && $totalRows_Recordset3 > 0 ){
        
        $contador = 1;

        do{
			
			$numodulos = $row_Recordset4['modulos'];
			
?>

            <div id="modulo<?php echo $contador; ?>" class="modulo" style="width:100%; float: left; text-align: center; display: none;">

                <div id="numeromodulo" style="width: 100%; float: left; margin-top: 30px; margin-bottom: 30px; font-family: 'Montserrat', sans-serif; font-size: 22px; text-transform: uppercase; letter-spacing: 2px; font-weight: bold;">Módulo <?php echo $contador; ?></div>

<?php 

            $query_Recordset5 = "SELECT * FROM materiascurso WHERE nummodulo = '$contador' AND idcurso = '$idcurso'";
			$Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
			$row_Recordset5 = mysql_fetch_assoc($Recordset5);
			$totalRows_Recordset5 = mysql_num_rows($Recordset5);

            do {

                $idmateria = $row_Recordset5['idmateria'];
                $idmaestro = $row_Recordset5['idmaestro'];
                $idmateriacurso = $row_Recordset5['id'];

                $query_Recordset6 = "SELECT * FROM materias WHERE id = '$idmateria'";
                $Recordset6 = mysql_query($query_Recordset6, $conamatenlinea) or die(mysql_error());
                $row_Recordset6 = mysql_fetch_assoc($Recordset6);
                $totalRows_Recordset6 = mysql_num_rows($Recordset6);

                $nombremateria = $row_Recordset6['nombre'];

                $query_Recordset7 = "SELECT * FROM maestros WHERE id = '$idmaestro'";
                $Recordset7 = mysql_query($query_Recordset7, $conamatenlinea) or die(mysql_error());
                $row_Recordset7 = mysql_fetch_assoc($Recordset7);
                $totalRows_Recordset7 = mysql_num_rows($Recordset7);

                $nombremaestro = $row_Recordset7['nombre'];

?>

            <div id="materia" style="width: calc(50% - 22px); float: left; font-family: montserrat; border: 1px solid #becae0; padding: 5px; margin-bottom: 30px; margin-left: 25%; margin-right: 25%; margin-top: 20px;">

                <div id="titulomateria" style="color: #56729c; font-weight: bold; font-size: 20px; margin: 5px 0px; width: calc(100% - 20%); margin-left:10%; margin-right:10%; text-align:center; float: left;"><?php echo $nombremateria; ?></div>

                <div id="linea" style="float: left; width: calc(100% - 10px); margin-left: 5px; margin-right: 5px; height: 1px; background-color: #becae0; margin-top: 5px; margin-right: 5px;"></div>

<?php
            
                $query_Recordset8 = "SELECT * FROM libroscurso WHERE idmateriacurso = '$idmateriacurso'";
                $Recordset8 = mysql_query($query_Recordset8, $conamatenlinea) or die(mysql_error());
                $row_Recordset8 = mysql_fetch_assoc($Recordset8);
                $totalRows_Recordset8 = mysql_num_rows($Recordset8);

                do {

                    $idlibro = $row_Recordset8['idlibro'];

                    $query_Recordset9 = "SELECT * FROM biblioteca WHERE id = '$idlibro'";
                    $Recordset9 = mysql_query($query_Recordset9, $conamatenlinea) or die(mysql_error());
                    $row_Recordset9 = mysql_fetch_assoc($Recordset9);
                    $totalRows_Recordset9 = mysql_num_rows($Recordset9);

                    $titulo = $row_Recordset9['titulo'];
                    $archivo = $row_Recordset9['archivo'];
                    $idlibro = $row_Recordset9['id'];


?>
    
                    <div id="libro" style="width: 100%; float: left; text-align: left;">

                        <div id="titulolibro" style="width: calc(80% - 10px); float: left; margin-left: 5px; margin-right: 5px; font-size: 14px; margin-top: 5px;"><?php echo $titulo; ?></div>

                        <a href="../ViewerJS/#../libros/110220197124712261.pdf">
                            <div id="botonver" onclick="location.href = '../libros/<?php echo $archivo; ?>'" style=" width: calc(20% - 16px); float: left; background-color: #56729c; text-align: center; padding-top: 5px; padding-bottom: 5px; padding-left: 8px; padding-right: 8px; margin-top: 4px; margin-bottom: 2px; color: #fff; font-size: 11px; text-transform: uppercase; border-radius: 3px; cursor: pointer;">Ver libro</div>
                        </a>

                    </div>

<?php

                } while($row_Recordset8 = mysql_fetch_assoc($Recordset8));

?>

            </div>

<?php 
        } while($row_Recordset5 = mysql_fetch_assoc($Recordset5));
?>
    
            </div>

<?php
            $contador = $contador + 1;
    
        } while( $contador <= $numodulos );

    } else {

?>

    <div id="nohay" style="font-size: 15px; line-height: 30px; width: 100%; float: left; text-align: center;">No se encontraron libros en la biblioteca para este curso</div>

<?php } ?>

                <div id="botonregresar" align="center" style="float: left; width: 100%; margin-top: 20px; margin-right: 2%;">

                    <div id="regresar" onclick="regresar();" style="font-size: 16px; width: 150px; border: 2px solid #6b7584; font-weight: bold; letter-spacing: 3px; text-align: center; padding: 8px; cursor: pointer; color: #fff; background-color: #6b7584; border-radius: 6px; font-family: 'Montserrat', sans-serif;">Regresar</div>

                </div>

            </div>
            
        </div>
	<!-- FIN Contenedor biblioteca-->
	
  </div>
  
</div>

</body>
</html>
