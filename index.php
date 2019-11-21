<?php require_once('Connections/conamatenlinea.php');
session_start();

$unixtime = time();



if ($_SESSION['sesionalumno'] != "") {
    
    //header("Location: plataformaeducativa/");

}

if($_SESSION['sesionmaestro'] != "") {
	
	
}

$time = time();
mysql_select_db($database_conamatenlinea, $conamatenlinea);

$error = "";

if ($_POST) {

    $codigo = $_POST['codigo'];

    if ($codigo != $_SESSION['keyreg']) {

        $error = "El código captcha es incorrecto, inténtalo de nuevo.";
    
    } else {

        $matricula = $_POST['matricula'];

        $query_Recordset3 = "SELECT * FROM alumnos WHERE matricula = '$matricula'";
        $Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
        $row_Recordset3 = mysql_fetch_assoc($Recordset3);
        $totalRows_Recordset3 = mysql_num_rows($Recordset3); 
		
		if( $totalRows_Recordset3 > 0 ) {
			
			$_SESSION['sesionalumno'] = $matricula;
		}
  
		
        $query_Recordset5 = "SELECT * FROM maestros WHERE usuario = '$matricula'";
        $Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
        $row_Recordset5 = mysql_fetch_assoc($Recordset5);
        $totalRows_Recordset5 = mysql_num_rows($Recordset5); 

        if($totalRows_Recordset3 == 0 && $totalRows_Recordset5 == 0) {

            $error = "La matrícula " . $matricula . " no existe.";

        } else {
            
            $password =  $_POST['password'];

            $query_Recordset2 = "SELECT * FROM alumnos WHERE matricula = '$matricula' AND contrasena = '$password'";
            $Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
            $row_Recordset2 = mysql_fetch_assoc($Recordset2);
            $totalRows_Recordset2 = mysql_num_rows($Recordset2);  

            $query_Recordset6 = "SELECT * FROM maestros WHERE usuario = '$matricula' AND contrasena = '$password'";
            $Recordset6 = mysql_query($query_Recordset6, $conamatenlinea) or die(mysql_error());
            $row_Recordset6 = mysql_fetch_assoc($Recordset6);
            $totalRows_Recordset6 = mysql_num_rows($Recordset6);  

            if($totalRows_Recordset2 == 0 && $totalRows_Recordset6 == 0) {

                $error = "La contraseña es incorrecta.";

            } else { 

                session_start();

                $_SESSION['sesionalumno'] = $matricula;

                if ( $totalRows_Recordset6 > 0 ) {

                    $_SESSION['sesionmaestro'] = $matricula;
                
                }
				
                header("Location: plataformaeducativa");
         
            }

        }

    }

}

$matricula = $_SESSION['sesionalumno'];
$usuariomaestro = $_SESSION['sesionmaestro'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM cursos";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

if ($matricula != "") {

$query_Recordset4 = "SELECT * FROM alumnos WHERE matricula = '$matricula'";
$Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4); 

$id = $row_Recordset4['id'];
$nombrealumno = $row_Recordset4['nombrealumno'];
$apellidopaterno = $row_Recordset4['apellidopaterno'];
$apellidomaterno = $row_Recordset4['apellidomaterno'];
$sexo = $row_Recordset4['sexo'];

$query_Recordset7 = "SELECT * FROM maestros WHERE usuario = '$usuariomaestro'";
$Recordset7 = mysql_query($query_Recordset7, $conamatenlinea) or die(mysql_error());
$row_Recordset7 = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7);

$idmaestro = $row_Recordset7['id'];
$nombremaestro = $row_Recordset7['nombre'];
$sexoalumno = $row_Recordset7['sexo'];
	
}

?>


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
		
	<?php if ($_SESSION['sesionalumno'] == "" || $_SESSION['sesionmaestro'] == "") { ?>
	
		$("#login").show();
		$("#menuplataformaalumno").hide();
		$("#menuplataformamaestro").hide();
		
	<?php } else if ($_SESSION['sesionalumno'] != "") { ?>
		
		$("#menuplataformaalumno").show();
		$("#login").hide();
		$("#menuplataformamaestro").hide();
		
	<?php } else if ($_SESSION['sesionmaestro'] != "") ?>
		
		$("#menuplataformamaestro").show();
		$("#menuplataformaalumno").hide();
		$("#login").hide(); 
		
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

<div id="inicio" style="width: 100%; float: left; height: 100vh; background-image: url('images/background.jpg'); background-size: cover; background-position: center; backgroudn-repeat: no-repeat;">

   <div id="menus" style="background-color: rgba(0, 0, 0, 0.6); border-top: 3px solid #FF4136;width: 100%; font-family: 'Montserrat', sans-serif; float: left; padding-top: 30px; padding-bottom: 30px; position: relative; z-index: 1;">

   <div id="logotipo" style="margin-left: 40px; min-height: 72px; float: left;"><a href="/"><img id="imagenlogotipo" src="images/logotipoindex.png?id=<?php echo $unixtime; ?>" alt="logotipo" style="height: 70px;"></a></div>

        <a href="javascript:void(0);" onclick="javascript:menumovil();" id="menumovil" style="display: none; padding: 10px; position: relative; z-index: 1; float: right; margin-top: 10px; margin-right: 10px;">

            <img src="../images/menumovil.png" style="height: 40px;" alt="">

        </a>

        <div id="menudesplegable" style="width: 80%; z-index: 2; background-color: #dad7cb; position: fixed; border-top: 3px solid #FF4136; top: 0px; bottom: 0px; right: -100%;">

            <a href="javascript:void(0);" onclick="javascript:cerrarmenumovil();" style="float: right; padding: 5px;">

                <img id="cerrar" style="height: 30px; float: right;" src="../images/x.png" alt="">

            </a>

            <img src="../images/logotipoazul.png?id=<?php echo $unixtime; ?>" style="width: 90%; margin-left: 5%; margin-top: 30px; margin-bottom: 30px;" alt="">

            <a class="menunav" style="background-color: #afa496; border-top: 1px solid rgba(244,244,244,0.5);">INICIO</a>

            <a class="menunav" href="../cursos">CURSOS</a>

            <a class="menunav" href="../academicos">ACADÉMICOS</a>

            <a class="menunav" href="../quienessomos">QUIÉNES SOMOS</a>

            <a class="menunav" href="../contacto">CONTACTO</a>
 

        </div>



        <div id="navegacion" style="float: right;">

            <div class="menu" style="cursor: default; width: 120px; color: #ff4136;">INICIO</div>
            <div class="menu" align="center" style="width: 120px;"><a href="cursos">CURSOS</a></div>
            <div class="menu" align="center" style="width: 170px;"><a href="academicos">ACADÉMICOS</a></div>
            <div class="menu" align="center" style="width: 200px;"><a href="quienessomos">QUIÉNES SOMOS</a></div>
            <div class="menu" align="center" style="width: 150px;"><a href="contacto">CONTACTO</a></div>
            <button id="buscar" style=" display: none; color: white; font-family: 'Montserrat', sans-serif; background: none; cursor: pointer; margin-right: 20px; font-size: 20px; float: left; text-align: center; margin-top: 13px;">
            
                <img src="images/buscar.png" style="float: left; height: 23px;">

                <div id="textoboton" style="float: left; margin-right: 5px;">BUSCAR</div>

            </button>

        </div>
    
    <div id="barrabusqueda" style="display:none; position: absolute; float: right; top: 110px; width: calc(100% - 40px); background-color: white; padding: 20px;">

        <button value="Buscar" style="height: 34px; color: white; border: none; float: right; padding: 5px; background-color: #B0040A;" type="submit"><img src="images/buscar.png" style="height: 23px;"></button>
        
        <input placeholder="Escribe tu búsqueda" style="padding: 5px; width: 300px; float: right; height: 20px;" type="text">

    </div>

    </div><!--Fin de Menus-->


    <div id="pantallanegra" style="position: absolute; height: 100vh; background-color: rgba(0, 0, 0, 0.3); width: 100%;"></div>

    <div id="titulo" align="center" style="font-size: 90px; color: white; width: 70%; font-family: 'Montserrat', sans-serif; height: 100px; position: absolute; top: 50%; margin-top: -50px; left: 50%; margin-left: -35%;">
        
        <img src="images/logotipoindex.png?id=<?php echo $unixtime; ?>" style="width: 100%;">

    </div>

</div>

<div id="seccion-form" style="width: 100%; float: left; background-color: #ecebeb;">
	
	<form id="login" name="login" action="index.php" method="post" enctype="multipart/form-data" style="float: left;  width: 80%; margin-left: 10%; margin-right: 10%; color: black; background-color: white; margin-top: 20px; margin-bottom: 40px; background-color: #ecebeb;" onSubmit="return(validaenvia())">
	
		<div id="loginTitulo" style="width: 100%; font-family: 'Signika', sans-serif; font-size: 25px; color: #111; float: left; margin-bottom: 25px;">Plataforma educativa</div>
		
		<input id="matricula" name="matricula" type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Matrícula" value="<?php echo $matricula; ?>" style="width: 20%; float: left; height: 30px; padding: 5px 15px; color: #f4f4f4; background-color: #5f574f; border: 1px solid #5f574f; border-radius: 3px; font-size: 16px; margin-right: 3%;">
	
		<input id="password" name="password" type="password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Contraseña" style="width: 20%; float: left; height: 30px; padding: 5px 15px; color: #f4f4f4; background-color: #5f574f; border: 1px solid #5f574f; border-radius: 3px; font-size: 16px; margin-right: 3%;">
	
		<input id="codigo" type="text" name="codigo" placeholder="Código" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" style="width: 11%; float: left; height: 30px; padding: 5px 15px; background-color: #5f574f; border: 1px solid #5f574f; color: #f4f4f4; border-radius: 3px; font-size: 16px; margin-right: 3%;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
	
		<div id="captchainput" style="width: 15%; height: 42px; overflow: hidden; float: left;">
			<img src="captcha/captcha.php" width="100%" height="42" border="1" style="float:left; border-color:#cdccc8;"/>
		</div>
	
		<button id="loginbutton" type="submit" style="width: 12%; background-color: #8c1515; color: white; border: 1px solid #8c1515; box-shadow: 0 1px 10px 1px rgba(46,45,41,0.2); margin-left: 3%; border-radius: 5px; padding: 12px 12px; font-weight: bold; height: 42px; font-size: 12px; cursor: pointer;">ENTRAR</button>

	</form>
		
	
	<div id="menuplataformaalumno" style="float: left; width: calc(100% - 5%); margin-left: 2.5%; margin-right: 2.5%; margin-bottom: 30px;">
            
            <div id="tituloplataforma" align="center" style="float: left; width: 100%; margin-bottom: 40px; color: #4a596f; text-transform: uppercase; margin-top: 20px; letter-spacing: 2px; font-size: 22px;">Plataforma Educativa</div>
            
            <div id="contenedorbienvenido"  style="float: left; width: 60%; margin-left: 37%;">
            
            	<div class="contenedoricon" style="width: 13px; margin-top: 12px; float: left;">
            	
					<img class="opcionicon" src="../images/plataformausuario.png?id=<?php echo $unixtime; ?>" style="width: 100%; float: left;" />
					
				</div>
            
            	<div id="nombre" align="center" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 12px; color: #8b96a2; letter-spacing: 0.5px; line-height: 20px; padding: 10px; text-transform: uppercase; margin-bottom: 20px;">Bienvenid<?php if ( $sexo == "masculino" ) { echo "o"; } else { echo "a"; } ?>: <?php echo $nombrealumno ." ". $apellidopaterno ." ". $apellidomaterno; ?></div>
            	
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
           
           
           <a class="linkopcion"  href="plataformaeducativa/pagos.php" style="text-decoration: none;">
			
				<div class="opcion" style="float: left;">
				
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/plataformapagos.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #4d5b71; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden; padding-bottom: 3px;">Pagos</div>
				
					</div>
				
				</div>
				
			</a>
           
           
           <a class="linkopcion"  href="plataformaeducativa/curso.php" style="text-decoration: none;">
			
				<div class="opcion" style="float: left;">
				
					<div class="contenedoropcion" style="padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/plataformacurso.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #4d5b71; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden; padding-bottom: 3px;">Curso</div>
				
					</div>
				
				</div>
				
			</a>
           
           
           <a class="linkopcion"  href="plataformaeducativa/biblioteca.php" style="text-decoration: none;">
			
				<div class="opcion" style="float: left;">
				
					<div class="contenedoropcion" style="padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/plataformabiblioteca.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #4d5b71; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden; padding-bottom: 3px;">Biblioteca</div>
				
					</div>
				
				</div>
				
			</a>
           
           <a class="linkopcion"  href="plataformaeducativa/ayuda.php" style="text-decoration: none;">
			
				<div class="opcion" style="float: left;">
				
					<div class="contenedoropcion" style="padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/plataformaayuda.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #4d5b71; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden; padding-bottom: 3px;">Ayuda</div>
				
					</div>
				
				</div>
				
			</a>
           
           
           <a class="linkopcion"  href="logout.php" style="text-decoration: none;">
			
				<div class="opcion" style="float: left;">
				
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/plataformasalir.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #4d5b71; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden; padding-bottom: 3px;">Salir</div>
				
					</div>
				
				</div>
				
			</a>
            
            </div>
           
           </div> <!--Fin contenedormenu-->
            
     </div> <!-- Fin menu plataforma alumno -->
	
	<div id="menuplataformamaestro" style="float: left; width: calc(100% - 5%); margin-left: 2.5%; margin-right: 2.5%; margin-bottom: 30px;">
            
            <div id="tituloplataforma" align="center" style="float: left; width: 100%; margin-bottom: 40px; color: #4a596f; text-transform: uppercase; margin-top: 20px; letter-spacing: 2px; font-size: 22px;">Plataforma Educativa</div>
            
            <div id="contenedorbienvenido"  style="float: left; width: 60%; margin-left: 40%;">
            
            	<div class="contenedoricon" style="width: 13px; margin-top: 12px; float: left;">
            	
					<img class="opcionicon" src="../images/plataformausuario.png?id=<?php echo $unixtime; ?>" style="width: 100%; float: left;" />
					
				</div>
            
            	<div id="nombre" align="center" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 12px; color: #8b96a2; letter-spacing: 0.5px; line-height: 20px; padding: 10px; text-transform: uppercase; margin-bottom: 20px;">Bienvenid<?php if ( $sexomaestro == "masculino" ) { echo "o"; } else { echo "a"; } ?>: <?php echo $nombremaestro; ?></div>
            	
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
           
           <a class="linkopcion"  href="plataformaeducativa/configuracionmaestro.php" style="text-decoration: none;">
			
				<div class="opcion" style="float: left;">
				
					<div class="contenedoropcion" style="padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/plataformaconfiguracion.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #4d5b71; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden; padding-bottom: 3px;">Configuración</div>
				
					</div>
				
				</div>
				
			</a>
           
           
           <a class="linkopcion"  href="plataformaeducativa/cursos.php" style="text-decoration: none;">
			
				<div class="opcion" style="float: left;">
				
					<div class="contenedoropcion" style="padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/plataformacurso.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #4d5b71; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden; padding-bottom: 3px;">Cursos</div>
				
					</div>
				
				</div>
				
			</a>
           
          
           
           <a class="linkopcion"  href="logout.php" style="text-decoration: none;">
			
				<div class="opcion" style="float: left;">
				
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/plataformasalir.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #4d5b71; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden; padding-bottom: 3px;">Salir</div>
				
					</div>
				
				</div>
				
			</a>
            
            </div>
           
           </div> <!--Fin contenedormenu-->
            
     </div> <!-- Fin menu plataforma maestro -->
	
			
</div> <!--Fin seccion-form-->


<section id="global" style="float: left; width: 100%;">

         <!-- Contenedor de los cursos-->
        <section class="contenedorCursos">

            <div id="titulo" style="padding-top: 50px; font-family: 'Montserrat', sans-serif; padding-bottom: 50px; border-top: 1px solid lightgray; font-size: 35px; color: #333; font-weight: bold; padding-left: 30px; letter-spacing: 1.6px;"><a href="cursos" style="color: black;">CURSOS</a></div>

<?php
$numcurso = 1;

if ($totalRows_Recordset1 > 0) {

    do{

        $nombre = $row_Recordset1['nombre'];
        $descripcion = $row_Recordset1['descripcion'];
        $imagen = $row_Recordset1['imagen'];
        $id = $row_Recordset1['id'];

?>
      
    <a href="../curso/index.php"><div class="curso zoom" style="width: <?php if ( $totalRows_Recordset1 == 1 ) { echo "96% !important"; } else if ( $totalRows_Recordset1 == 2 ) { echo "46%"; } ?>;">
       <div class="imagencurso" style="background-image: url(../images/<?php echo $imagen; ?>);"></div>
           <div class="nombreCurso"><?php echo $nombre; ?></div>
           <div class="contenidoCurso"><?php echo $descripcion; ?></div>
       </div></a>

<?php 

        $numcurso = $numcurso + 1;

    }while($row_Recordset1 = mysql_fetch_assoc($Recordset1));


} else { //fin de if hay totalrowrecordset1
?>

    <div id="nohay" align="center" style="float: left; color: black; width: 100%; line-height: 300px; ">No se encontraron cursos registrados</div>

<?php
}

?>

        </section>

</section>

 <div id="informacion" style="float: left; width: 100%; color: white; background-color: #1d4267; padding-top: 50px; padding-bottom: 50px; margin-top: 50px;">

    <div class="contenedorinfo" style="padding: 30px 50px; float: left; height: 300px; margin: 10px 20px; width: calc( 50% - 140px); background-image: url(images/background1.svg); background-repeat: no-repeat; background-size: 450px; background-position: center;">

        <div class="informacionbody">

                <div class="titulo" align="center" style="font-weight: bold; padding-bottom: 20px; padding-top: 20px; font-size: 25px;">Aprendizaje de por vida</div>

                <div class="texto" style="line-height: 25px; height: 150px; overflow: hidden;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ultricies felis in nisi venenatis aliquet. Phasellus luctus a nibh at lacinia. Cras egestas leo id augue bibendum tempus. Nulla facilisi. Donec laoreet vestibulum ultrices. Aliquam vehicula volutpat tortor. Maecenas volutpat sit amet est vitae venenatis.</div>

        </div>

        <div class="contenedorboton" align="center" style="margin-top: 20px;">            

            <button style="width: 80px; border: none; border-radius: 50%; height: 80px; background-color: #202C58;"> 

                <img src="images/right-arrow.png" style="width: 20px;">

            </button>

        </div>

    </div>

    <div class="contenedorinfo" style="padding: 30px 50px; float: left; height: 300px; margin: 10px 20px; width: calc( 50% - 140px); background-image: url(images/background2.svg); background-repeat: no-repeat; background-size: 400px; background-position: center;">

        <div class="informacionbody">

            <div class="titulo" align="center" style="font-weight: bold; padding-bottom: 20px; padding-top: 20px; font-size: 25px;">Credenciales conamat</div>

            <div class="texto" style="line-height: 25px; height: 150px; overflow: hidden;">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ut dignissim purus. Phasellus posuere mauris sit amet dolor mattis mollis.</div>
        
        </div>

        <div class="contenedorboton" align="center" style="margin-top: 20px;">
            
            <button style="width: 80px; border: none; border-radius: 50%; height: 80px; background-color: #202C58;"> 

                <img src="images/right-arrow.png" style="width: 20px;">

            </button>

        </div>

    </div>

    <div class="contenedorinfo" style="margin-top: 20px; padding: 50px 50px; float: left; height: 300px; margin-left: 12.5%; width: calc( 75% - 100px ); background-image: url(images/background3.svg); background-size: 600px; background-repeat: no-repeat; background-position: center;">

        <div class="informacionbody">

            <div class="titulo" align="center" style="font-weight: bold; padding-bottom: 20px; padding-top: 20px; font-size: 25px;">Comunidad conamat</div>

            <div class="texto" style="line-height: 25px; height: 150px; overflow: hidden;">Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus et nisi ut sem imperdiet pulvinar sit amet et ipsum. Aliquam vestibulum sem a risus rhoncus, a mattis ipsum scelerisque.  In sit amet lacus ac urna ornare pharetra. Praesent euismod tortor tellus, ac egestas tellus porta et. Nam suscipit, justo et condimentum rhoncus, est quam posuere ante, ut viverra magna magna ac nisl. Sed eu eros leo. Praesent congue nisl ut sem tempus, eget placerat enim ultrices. Nam vel dignissim eros, eu venenatis nunc.</div>

        </div>

        <div class="contenedorboton" align="center" style="margin-top: 20px;">            

            <button style="width: 80px; border: none; border-radius: 50%; height: 80px; background-color: #202C58;"> 

                <img src="images/right-arrow.png" style="width: 20px;">

            </button>

        </div>

    </div>

</div> 

<div id="footer-conamat" style="width: 100%; height: 170px; background-color: #0b2c4d; float: left;">
	   
	   <div id="contenido-footer" style="width:90%; float:left; margin-top: 40px; margin-left: 5%; margin-right: 5%;">
	   
	    	<div id="logo-footer" style="width: 260px; height: 80px;  float:left;">
            	<img src="../images/logotipo.png" style="width: 100%;">
        	</div>
        	
        	<div id="linksfooterprincipales" style="float:left; margin-left: 70px; font-size: 18px; margin-bottom: 35px; font-family:'Source Sans Pro', sans-serif; line-height: 1.2px; margin-top: 40px;">
       		 
        		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color: white; padding-left: 30px;" href="/">Inicio</a>
        		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color: white; padding-left: 30px;" href="/cursos/">Cursos</a>
        		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color: white; padding-left: 30px;" href="/academicos/">Académicos</a>
        		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color: white; padding-left: 30px;" href="/quienessomos/">Quiénes Somos</a>
        		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color: white; padding-left: 30px;" href="/contacto/">Contacto</a>
        		 
        	</div>
	</div>
</div> 

<?php 
	
if ($error != "") { ?>
<script>
	alert("<?php echo $error; ?>"); 
</script> 

<?php } ?>

</body>
</html>
