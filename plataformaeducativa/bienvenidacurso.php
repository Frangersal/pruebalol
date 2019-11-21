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

body {
	margin: 0;	
}


.opcion:hover {
	background-color: #2a3444 !important;
	border-left: 4px solid #4a8ab1 !important;
	cursor: pointer;
}

.nombreopcion:hover {
		cursor: pointer !important;
}

	#continuar:hover {
		background-color: #fff;
		color: #000 !important;
		/*text-shadow: none;*/
	}
	
</style>

<script>

</script>

</head>
<body>
	
<div id="wrapper" style="width: 100%; float: left; height: 100vh; position: relative;">

	<div id="seccionmenu"
			style="width: 20%; background-color: #354052; position: fixed; top: 0; left: 0; z-index: 999; height: 100%; box-shadow: 0px 0px 10px #000;">

			<a href="/plataformaeducativa/">
				<div id="logotipoplataforma" align="center"
					style="float: left; width: calc(70%); margin-top: 30px; margin-bottom: 30px; margin-left: 15%; margin-right: 15%;">
					<img src="../images/logoplataformaeducativa.png?id=<?php echo $unixtime; ?>" alt="logotipo"
						style="width: 100%; opacity: 0.8; float: left;">
				</div>
			</a>

			<?php if($imagenactual == "") { ?>

			<div id="contenedorimagenactual" align="center"
				style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; float: left; border: 1px solid #35405263; background-image: url(../images/iconavatar.png); background-size: cover; background-position: center;">

			</div>

			<?php } else if ($imagenactual != "") { ?>

			<div id="contenedorimagenactual" align="center"
				style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; position: relative; float: left; border: 1px solid #35405263; background-image: url(../images/<?php echo $imagenactual; ?>); background-size: cover; background-position: center;">

			</div>

			<?php } ?>

			<div id="nombrealumno" align="center"
				style="float: left; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #abb4c1; width: 90%; letter-spacing: 0.5px; line-height: 20px; padding: 10px;">
				<?php echo $nombrealumno ." ". $apellidopaterno ." ". $apellidomaterno; ?>
			</div>

			<div id="lineaseparadora1" style="width: 100%; height: 1px; background-color: #000; float: left;"></div>
			<div id="lineaseparadora2" style="width: 100%; height: 1px; background-color: #807979; float: left;"></div>

			<div id="opcionesmenu" style="width: 100%; float: left;">

				<div class="opcionactual"
					style="width: calc(100% - 4px); float: left; background-color: #2a3444; border-left: 4px solid #4a8ab1;">

					<div class="contenedoropcion"
						style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">

						<div class="contenedoricon"
							style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconinicio.png?id=<?php echo $unixtime; ?>"
								style="width: 100%; position: absolute;" />
						</div>

						<div class="nombreopcionactual"
							style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">
							Inicio</div>

					</div>

				</div>


				<a class="linkopcion" href="configuracion.php" style="text-decoration: none;">

					<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">

						<div class="contenedoropcion"
							style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

							<div class="contenedoricon"
								style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
								<img class="opcionicon" src="../images/iconconfiguracion.png?id=<?php echo $unixtime; ?>"
									style="width: 100%; position: absolute;" />
							</div>

							<div class="nombreopcion"
								style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">
								Configuración</div>

						</div>

					</div>

				</a>


				<a class="linkopcion" href="pagos.php" style="text-decoration: none;">
					<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">

						<div class="contenedoropcion"
							style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

							<div class="contenedoricon"
								style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
								<img class="opcionicon" src="../images/iconpagos.png?id=<?php echo $unixtime; ?>"
									style="width: 100%; position: absolute;" />
							</div>

							<div class="nombreopcion"
								style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">
								Pagos</div>

						</div>

					</div>

				</a>


				<a class="linkopcion" href="curso.php" style="text-decoration: none;">
					<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">

						<div class="contenedoropcion"
							style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

							<div class="contenedoricon"
								style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
								<img class="opcionicon" src="../images/iconcursos.png?id=<?php echo $unixtime; ?>"
									style="width: 100%; position: absolute;" />
							</div>

							<div class="nombreopcion"
								style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">
								Curso</div>

						</div>

					</div>

				</a>


				<a class="linkopcion" href="biblioteca.php" style="text-decoration: none;">
					<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">

						<div class="contenedoropcion"
							style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

							<div class="contenedoricon"
								style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
								<img class="opcionicon" src="../images/iconbiblioteca.png?id=<?php echo $unixtime; ?>"
									style="width: 100%; position: absolute;" />
							</div>

							<div class="nombreopcion"
								style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">
								Biblioteca</div>

						</div>
					</div>
				</a>

				<a class="linkopcion" href="ayuda.php" style="text-decoration: none;">
					<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">

						<div class="contenedoropcion"
							style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

							<div class="contenedoricon"
								style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
								<img class="opcionicon" src="../images/iconayuda.png?id=<?php echo $unixtime; ?>"
									style="width: 100%; position: absolute;" />
							</div>

							<div class="nombreopcion"
								style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">
								Ayuda</div>

						</div>

					</div>

				</a>


				<a class="linkopcion" href="../logout.php" style="text-decoration: none;">

					<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">

						<div class="contenedoropcion"
							style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

							<div class="contenedoricon"
								style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
								<img class="opcionicon" src="../images/iconsalir.png?id=<?php echo $unixtime; ?>"
									style="width: 100%; position: absolute;" />
							</div>

							<div class="nombreopcion"
								style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">
								Salir</div>

						</div>

					</div>

				</a>

			</div>

		</div>
	
	<div id="seccionprincipal" style="width: 80%; float: left; margin-left: 20%; background-image: url(../images/college.jpg?id=<?php echo $unixtime; ?>); background-position: center; background-size: cover; overflow: hidden; height: 100vh;">
	
			<div id="pantallanegra" style="position: absolute; height: 100vh; background-color: rgba(0, 0, 0, 0.3); width: 100%;"></div>
		
            <div id="datos" align="center" style="width: 100%;">
				
				<div id="titulo" align="center" style="font-size: 40px; color: white; width: 100%; font-family: 'Montserrat', sans-serif; font-weight: bold; letter-spacing: 1.3px; margin-bottom: 20px; position: absolute; top: 50%; margin-top: -50px; left: 35%; margin-left: -25%;">BIENVENIDO(A) AL CURSO</div>
            
            	<a id="linkcontinuar" href="plandeestudios.php" style="text-decoration: none; position: absolute; top: 55%; left: 28%; margin-left: 28%;">
    
                	<div id="continuar" style="font-size: 14px;width: 150px; border: 2px solid #fff;font-weight: bold; letter-spacing: 3px; text-align: center; padding: 8px; cursor: pointer; color: #fbfcfd; border-radius: 6px; font-family: 'Montserrat', sans-serif; text-transform: uppercase; position: absolute;">Continuar</div>
                
				</a>
				
			</div>
    
        </div>
		
	</div>
	
</div>

</body>
</html>
