<?php session_start(); 
$unixtime = time();

require_once('../Connections/conamatenlinea.php');

if($_SESSION['sesionalumno'] == "") {
	
	header("Location: login.php");
} else{

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
$correo = $row_Recordset1['correo'];
$contrasena = $row_Recordset1['contrasena'];

?>

<!doctype html>
<html><head>
<meta charset="utf-8">
<title>Conamat | Plataforma Educativa</title>
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">

<style>
        body{
            margin: 0px;
            font-family: 'Montserrat', sans-serif;
        }

        #subtema{
            font-size: 16px;
            margin: 8px 0px;
            padding: 5px;
            width: calc(100% - 10px);
            color: #545f6f;
			float: left;
			text-transform: uppercase;
			text-align: center;
        }

        #descsub{
            font-size: 14px;
            margin: 8px 0px;
            padding: 5px;
            text-align: justify;
			float: left;
			color: #000;
			line-height: 25px;
            
        }

        #continuar {
			color: #617ca2;
		}
		
        #continuar:hover {
            background-color: #617ca2;
			color: #fff;
        }
		
		#regresar {
			color: #617ca2;
		}
		
        #regresar:hover {
            background-color: #617ca2;
			color: #fff;
        }
	
</style>

<script>

</script>

</head>
<body>
	
<div id="wrapper" style="width: 100%; float: left; height: 100vh; position: relative;">

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
		
		<div id="nombrealumno" align="center" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #abb4c1; width: 90%; letter-spacing: 0.5px; line-height: 20px; padding: 10px;">
			<?php echo $nombrealumno ." ". $apellidopaterno ." ". $apellidomaterno; ?>
		</div>
		
		<div id="lineaseparadora1" style="width: 100%; height: 1px; background-color: #000; float: left;"></div>
		<div id="lineaseparadora2" style="width: 100%; height: 1px; background-color: #807979; float: left;"></div>
				
		<div id="opcionesmenu" style="width: 100%; float: left;">
		
			<a class="linkopcion"  href="index.php" style="text-decoration: none;">
			
				<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
				
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

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
			
			<div class="opcionactual" style="width: calc(100% - 4px); float: left; background-color: #2a3444; border-left: 4px solid #4a8ab1;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconcursos.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Curso</div>
				
					</div>
				
				</div>
			
			
			<a class="linkopcion"  href="biblioteca.php" style="text-decoration: none;">
				<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconbiblioteca.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Biblioteca</div>
				
					</div>
				</div>	
			</a>
			
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
	
	<div id="seccionprincipal" style="width: 80%; float: left; margin-left: 20%; background-color: #fff; background-position: center; background-size: cover; overflow: scroll; height: 100vh;">
	
		<div id="contenedor" style="margin-left: 100px; width: calc(100% - 200px); float:left; padding: 5px;">

			<div id="titulosesion" align="left" style="width: 50%; float: left; font-size: 13px; margin-bottom: 5px; text-transform: uppercase; color: #585858; letter-spacing: 2px; margin-top: 10px;">Sesión 1</div>

			<div id="numbloque" align="right" style="width: 50%; float: left; font-size: 13px; margin-bottom: 5px; text-transform: uppercase; color: #585858; letter-spacing: 2px; margin-top: 10px;">Bloque 1</div>
			
			<div id="leccion" align="center" style="width: 100%; float: left; font-size: 12px; margin-bottom: 7px; text-transform: uppercase; color: #585858; letter-spacing: 3px;">Lección</div>
           
            <div id="tituloleccion" align="center" style="width: 100%; float: left; font-size: 22px; margin-bottom: 20px; text-transform: uppercase; color: #545f6f; letter-spacing: 2px; font-weight: bold; padding-bottom: 15px; border-bottom: 1px solid #ccc;">Who am I?</div>

            <div id="subtema"> Competencias disciplinarias básicas a desarrollar. </div>

            <div id="descsub"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rutrum, libero auctor
                commodo posuere, augue justo euismod est, a tristique arcu diam at ligula. Praesent vel augue at justo
                aliquet laoreet quis quis nisl. Phasellus fermentum ex ac odio blandit, sed ultrices enim ultrices.
                Nullam id sodales neque. Aliquam laoreet eget augue nec viverra. Duis imperdiet, nisi ut tincidunt
                maximus, arcu felis blandit massa, sit amet viverra felis arcu vitae justo. Donec sit amet arcu eros.
                Fusce placerat purus accumsan ipsum consectetur, eu feugiat erat hendrerit. </div>
            
            <div id="subtema">  Desempeño del estudiante al concluir el bloque. </div>

            <div id="descsub"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rutrum, libero auctor
                commodo posuere, augue justo euismod est, a tristique arcu diam at ligula. Praesent vel augue at justo
                aliquet laoreet quis quis nisl. Phasellus fermentum ex ac odio blandit, sed ultrices enim ultrices.
                Nullam id sodales neque. Aliquam laoreet eget augue nec viverra. Duis imperdiet, nisi ut tincidunt
                maximus, arcu felis blandit massa, sit amet viverra felis arcu vitae justo. Donec sit amet arcu eros.
                Fusce placerat purus accumsan ipsum consectetur, eu feugiat erat hendrerit. </div>
            
            <div id="subtema"> Introducción teórica </div>

            <div id="descsub"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rutrum, libero auctor
                    commodo posuere, augue justo euismod est, a tristique arcu diam at ligula. Praesent vel augue at justo
                    aliquet laoreet quis quis nisl. Phasellus fermentum ex ac odio blandit, sed ultrices enim ultrices.
                    Nullam id sodales neque. Aliquam laoreet eget augue nec viverra. Duis imperdiet, nisi ut tincidunt
                    maximus, arcu felis blandit massa, sit amet viverra felis arcu vitae justo. Donec sit amet arcu eros.
                    Fusce placerat purus accumsan ipsum consectetur, eu feugiat erat hendrerit. </div>
            
         		
         	<div id="botones" style="float: left; width: 100%; margin-top: 50px; margin-bottom: 50px;">

				<div id="botonregresar" align="right" style="float: left; width: 48%; margin-top: 20px; margin-right: 2%;">

					<div id="regresar" onclick="location.href='sesionesactividades.php';" style="font-size: 14px; width: 150px; border: 2px solid #617ca2; font-weight: bold; letter-spacing: 3px; text-align: center; padding: 8px; cursor: pointer; border-radius: 6px; font-family: 'Montserrat', sans-serif; text-transform: uppercase;">Regresar</div>

				</div>
				
			
				<div id="botoncontinuar" align="left" style="float: left; width: 48%; margin-top: 20px;">

					<div id="continuar" onclick="location.href='teoria.php';" style="font-size: 14px; width: 150px; border: 2px solid #617ca2; font-weight: bold; letter-spacing: 3px; text-align: center; padding: 8px; cursor: pointer; border-radius: 6px; font-family: 'Montserrat', sans-serif; text-transform: uppercase;">Continuar</div>

				</div>
				
			</div> <!--Fin botones-->

        </div>
    
    </div>
		
	</div>
	
</div>

</body>
</html>
