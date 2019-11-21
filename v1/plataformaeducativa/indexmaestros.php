

<!DOCTYPE html>
<html lang="es"><head>
    <meta charset="UTF-8">
    <title>Conamat en línea</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <link rel="image_src" href="images/conamatlogo.jpg" />
    <meta name="description" content="Conamat Acapulco en línea. Plataforma de cursos en línea." />
    <meta property="og:image" content="images/conamatlogo.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/jquery.color-animation/1/mainfile"></script>
<!--Estilos CSS-->
<style>
	
body {
margin: 0;
font-family: 'Montserrat', sans-serif;
}
	
a:link{
    text-decoration: none;
    color: white;
}
a:visited{
    text-decoration: none;
    color: white;
}

.menu{
    color: white;
    font-size: 20px;
    float: left;
    text-align: center;
    margin-top: 25px;
}
.menu>*:hover{
    color: #ff4136;
}
#buscar:hover{
    color: #0074D9 !important;
    border-color: #0074D9 !important;
}
.bx-wrapper, .bx-viewport {
    height: 250px !important;
    border: none; !important;
}
.zoom{
	transition: all .3s ease;
}
.zoom:hover{
    transform: scale(1.03);
}
.curso {
    border: 1px solid #ccc;
	box-shadow: 1px 4px 7px rgba(46,45,41,0.35);
    float: left;
    width: 21%;
    margin-left: calc(2% - 1px);
    margin-right: calc(2% - 1px);
	margin-top: 2%;
}
.imagencurso{
    height: 200px;
    width: 100%;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
.nombreCurso {
    height: 16px;
    overflow: hidden;
    text-align: left;
    padding: 10px 15px;
    font-family: 'Open Sans', sans-serif;
	font-weight: bold;
    color: #0b2c4d;
    font-size: 16px;

}
#encabezado {
    text-align: center;
    font-family: helvetica;
}
.contenidoCurso {
    height: 150px;
    overflow: hidden;
	font-family: 'Open Sans', sans-serif;
    font-size: 13px;
    color: #000;
    margin: 10px;
}
.contenedorCursos{
    width: 100%;
    float: left;
    margin-bottom: 30px;
    font-family: helvetica;
} 
p{
    font-family: helvetica;
}
	
#menus:hover{
	background-color: #0b2c4d; 		
}

#login input::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: #bebebe;
  opacity: 1; /* Firefox */
}

.nombreopcion:hover {
    font-weight: bold;
}
	
	
@media screen and (max-width: 994px) {
    #wrapper{
        width: calc(100% - 40px) !important;
        padding: 0px 20px 0 20px !important;
    }
    #menumovil{
        display: block !important;
    }
    #navegacion{
        display: none !important;
    }
    #imagenlogotipo{
        height: 55px !important;
    }
    #logotipo{
        margin-left: 10px !important;
        padding-top: 10px !important;
    }
    .menunav{
        padding: 15px 20px !important;
        font-size: 13px !important;
        float: left;
        width: 100%;
        text-align: left;
        color: #1d4267 !important;
        border-bottom: 1px solid rgba(244,244,244,0.5) !important;
    }
    #footer-conamat{
        height: auto !important;
    }
    #logo-footer{
        width: 100% !important;
        height: auto !important;
    }
    #logo-footer img{
        width: 50% !important;
        margin-left: 25% !important;
    }
    #linksfooterprincipales{
    
        margin-left: 0px !important;
    }
    a.menu-footer-principal {
        width: calc(50% - 30px) !important;
        height: 40px !important;
        line-height: 40px !important;
        
    }
    #columna-izquierda{
        width: 100% !important;
        padding-left: 0px !important;
        height: auto !important;
        margin-bottom: 50px !important;
    }
    #columna-derecha{
        width: 100% !important;
        padding-left: 0px !important;
        margin-right: 0px !important;
        margin-bottom: 50px !important;
    }
    #contenido-contacto{
        width: 80% !important;
        margin-left: 10% !important;
        margin-right: 10% !important;
        margin-top: 50px !important;
    }
    .curso{
        width: 46% !important;
        margin-top: 10% !important;
    }
    .nombreCurso{
        text-align: center;
        font-size: 18px !important; 
    }
    .contenidoCurso{
        font-size: 15px !important; 

    }
    .contenedorinfo{
        padding: 20px 10px !important;
        margin: 40px 10px !important;
        width: calc( 100% - 40px) !important;
        background-size: 450px;
    }
    #matricula{
        margin-right: 0px !important;
        width: calc(100% - 32px) !important;
        margin-bottom: 20px !important;
    }
    #password{
        margin-right: 0px !important;
        width: calc(100% - 32px) !important;
        margin-bottom: 20px !important;
    }
    #codigo{
        margin-right: 20px !important;
        width: calc(50% - 52px) !important;
        margin-bottom: 20px !important;
    }
    #captchainput{
        width: 50% !important;
        margin-bottom: 20px !important;
    }
    #loginbutton{
        width: calc(100% - 2px) !important;
        padding: 12px 0px;
        margin-left: 0px !important;
    }
 
	.nombreopcion:hover{
    font-weight: 600;
	}

}
	
@media screen and (max-width: 764px) {
    #menus{
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }
    #menumovil{
        display: block !important;
    }
    #navegacion{
        display: none !important;
    }
    #imagenlogotipo{
        height: 55px !important;
    }
    #logotipo{
        margin-left: 10px !important;
        padding-top: 10px !important;
    }
    #inicio #titulo{
        width: 100% !important;
        margin-left: -50% !important;
        padding-left: 0px !important;
        text-align: center !important;
        font-size: 40px; 
    }
    .contenedorCursos #titulo{
        text-align: center;
        padding-top: 30px !important;
        padding-bottom: 10px !important;
        width: calc(100% - 60px);
    }
    .curso{
        width: 96% !important;
        margin-top: 10% !important;
    }
    .nombreCurso{
        text-align: center;
        font-size: 18px !important; 
    }
    .contenidoCurso{
        font-size: 15px !important; 
    }
    .contenedorinfo{
        padding: 20px 10px !important;
        margin: 40px 10px !important;
        width: calc( 100% - 40px) !important;
        background-size: 450px;
    }
    #matricula{
        width: calc(100% - 32px) !important;
        margin-right: 0px !important;
        margin-bottom: 20px !important;
    }
    #password{
        width: calc(100% - 32px) !important;
        margin-right: 0px !important;
        margin-bottom: 20px !important;
    }
    #codigo{
        margin-right: 20px !important;
        width: calc(50% - 52px) !important;
        margin-bottom: 20px !important;
    }
    #captchainput{
        width: 50% !important;
        margin-bottom: 20px !important;
    }
    #loginbutton{
        width: calc(100% - 2px) !important;
        padding: 12px 0px;
        margin-left: 0px !important;
    }
  
}
 

</style>
<!--Fin estilos CSS-->
<script>
	
	$(document).ready(function() {
	
	$("#menus").hover(function() {
			$(this).animate({ backgroundColor: '#0b2c4d'}, 'fast');
		}, function() {
			$(this).animate({ backgroundColor: 'rgba(0,0,0,0.6);'}, 'fast');
		});	
    });
	
function validaenvia() {

	if (document.login.matricula.value == "") {
		alert("Por favor escribe tu matrícula.");
		document.login.matricula.focus();
		return false;
	}

	if (document.login.password.value == "") {
		alert("Por favor escribe tu contraseña.");
		document.login.password.focus();
		return false;
	}

	if (document.login.codigo.value == "") {
		alert("Por favor escribe el código de la imagen.");
		document.login.codigo.focus();
		return false;
	}

}
	
</script>

<script>
function menumovil() {
    $("#menudesplegable").animate({
        right: '0'
    }, 'fast');
}

function cerrarmenumovil() {
    $("#menudesplegable").animate({
        right: '-100%'
    }, 'fast');
}

</script>
<script>
$('html').bind('touchstart mousedown', function(e){

 if (e.target.id != 'menudesplegable' && e.target.id != 'imagenmovil' && e.target.id != 'inicio' && e.target.id != '' && e.target.id != 'equis') {

$( "#menudesplegable" ).animate({
    right: "-100%"
  }, 'fast' );

    }
});
</script>


</head>

<body>

<div id="seccion-form" style="width: 100%; float: left; background-color: #ecebeb;">
		
	<div id="menuplataforma" style="float: left; width: calc(100% - 5%); margin-left: 2.5%; margin-right: 2.5%; margin-bottom: 30px; display:block;">
            
            <div id="tituloplataforma" align="center" style="float: left; width: 100%; margin-bottom: 40px; color: #4a596f; text-transform: uppercase; margin-top: 20px; letter-spacing: 2px; font-size: 22px;">Plataforma Educativa</div>
            
            <div id="contenedorbienvenido"  style="float: left; width: 60%; margin-left: 37%;">
            
            	<div class="contenedoricon" style="width: 13px; margin-top: 12px; float: left;">
            	
					<img class="opcionicon" src="../images/plataformausuario.png?id=<?php echo $unixtime; ?>" style="width: 100%; float: left;" />
					
				</div>
            
            	<div id="nombre" align="center" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 12px; color: #8b96a2; letter-spacing: 0.5px; line-height: 20px; padding: 10px; text-transform: uppercase; margin-bottom: 20px;">Bienvenido(a) Maestro(a): <?php echo $nombrealumno ." ". $apellidopaterno ." ". $apellidomaterno; ?></div>
            	
            </div>
            
		<div id="contenedormenu" style="width: 100%; float: left;">
        
        <div id="menuinside" style="display: table; margin: 0 auto;">
           
            <a class="linkopcion"  href="plataformaeducativa/" style="text-decoration: none;">
			
				<div class="opcion" style="float: left;">
				
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/plataformainicio.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #4d5b71; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden; padding-bottom: 3px;">Inicio</div>
				
					</div>
				
				</div>
				
			</a>
           
           <a class="linkopcion"  href="plataformaeducativa/configuracion.php" style="text-decoration: none;">
			
				<div class="opcion" style="float: left;">
				
					<div class="contenedoropcion" style="padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/plataformaconfiguracion.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #4d5b71; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden; padding-bottom: 3px;">Configuración</div>
				
					</div>
				
				</div>
				
			</a>
          