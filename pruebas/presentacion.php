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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>presentacion</title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

    <style>
        body{
            margin: 0px;
            font-family: 'montserrat';
        }

        #subtema{
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0px;
            padding: 5px;
            width: calc(100% - 10px);
            color: #187ba8;

        }

        #descsub{
            font-size: 14px;
            margin: 10px 0px;
            padding: 5px;
            text-align: justify;
            
        }

        #continuar:hover {
            transform: scale(1.07) ;
        }
    </style>
</head>
<body>
    <!--Wrapper-->
	<div id="wrapper" style="width: 100%; float: left; height: 100vh; position: relative;">

            <!---Menu plataforma educativa-->
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
        <!---FIN Menu plataforma educativa-->

        <!---Contenedor-->
        <div id="contenedor" style="margin-left: 24%; width: 70%; float:left; padding: 5px; position: relative;">

                <div id="titulomateria" style="font-size: 20px; font-weight: bold; margin: 20px 0px; padding: 5px; background: #187ba8; color:white; width: calc(100% - 10px);"> Ingles I</div>
    
                <div id="subtema"> Presentación </div>
    
                <div id="descsub"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rutrum, libero auctor
                    commodo posuere, augue justo euismod est, a tristique arcu diam at ligula. Praesent vel augue at justo
                    aliquet laoreet quis quis nisl. Phasellus fermentum ex ac odio blandit, sed ultrices enim ultrices.
                    Nullam id sodales neque. Aliquam laoreet eget augue nec viverra. Duis imperdiet, nisi ut tincidunt
                    maximus, arcu felis blandit massa, sit amet viverra felis arcu vitae justo. Donec sit amet arcu eros.
                    Fusce placerat purus accumsan ipsum consectetur, eu feugiat erat hendrerit. </div>
    
                <div id="subtema"> Introducción </div>
    
                <div id="descsub"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rutrum, libero auctor
                    commodo posuere, augue justo euismod est, a tristique arcu diam at ligula. Praesent vel augue at justo
                    aliquet laoreet quis quis nisl. Phasellus fermentum ex ac odio blandit, sed ultrices enim ultrices.
                    Nullam id sodales neque. Aliquam laoreet eget augue nec viverra. Duis imperdiet, nisi ut tincidunt
                    maximus, arcu felis blandit massa, sit amet viverra felis arcu vitae justo. Donec sit amet arcu eros.
                    Fusce placerat purus accumsan ipsum consectetur, eu feugiat erat hendrerit. </div>
    
                <div id="subtema"> Propósitos generales de la unidad de aprendizaje </div>
    
                <div id="descsub"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rutrum, libero auctor
                    commodo posuere, augue justo euismod est, a tristique arcu diam at ligula. Praesent vel augue at justo
                    aliquet laoreet quis quis nisl. Phasellus fermentum ex ac odio blandit, sed ultrices enim ultrices.
                    Nullam id sodales neque. Aliquam laoreet eget augue nec viverra. Duis imperdiet, nisi ut tincidunt
                    maximus, arcu felis blandit massa, sit amet viverra felis arcu vitae justo. Donec sit amet arcu eros.
                    Fusce placerat purus accumsan ipsum consectetur, eu feugiat erat hendrerit. </div>
                    
            <div id="botones" style="padding: 5px; width: calc(100% - 400px); margin-left: 200px; float: left;">
				
					<div id="continuar" onclick="location.href='competencias.php';" style="margin-right: 100px; font-size: 16px; width: 100px; border: 3px solid #0074a9; font-weight: bold; background: #0082bd; height: 20px; text-align: center; padding: 5px; float: right; cursor: pointer; color: #bde0f0; border-radius: 10px;">Continuar</div>
				
					<div id="continuar" onclick="location.href='bienvenidamateria.php';" style="margin-right: 40px; font-size: 16px; width: 100px; border: 3px solid #0074a9; font-weight: bold; background: #0082bd; height: 20px; text-align: center; padding: 5px; float: right; cursor: pointer; color: #bde0f0; border-radius: 10px;">Regresar</div>

			</div>
    
                <!--<div id="botoncontinuar" style="padding: 5px; width: calc(100% - 10px); float: left;">
    
                    <div id="continuar" onclick="location.href='competencias.php';" style="font-size: 16px; width: 100px; border: 3px solid #0474a7; font-weight: bold; background: #187ba8; height: 20px; text-align: center; padding: 5px; float: right; cursor: pointer; color: #bde0f0; border-radius: 10px;">Continuar</div>
            
                </div>-->
    
            </div>
        <!---Fin contenedor-->

    </div>
    <!---Fin Wrapper-->

</body>
</html>