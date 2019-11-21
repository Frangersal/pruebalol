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

$query_Recordset6 = "SELECT * FROM inscripciones WHERE idalumno = '$id'";
$Recordset6 = mysql_query($query_Recordset6, $conamatenlinea) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6); 

$idcurso = $row_Recordset6['idcurso'];

$query_Recordset9 = "SELECT MAX(nummodulo) AS 'nummodulos' FROM materiascurso WHERE idcurso = '$idcurso'";
$Recordset9 = mysql_query($query_Recordset9, $conamatenlinea) or die(mysql_error());
$row_Recordset9 = mysql_fetch_assoc($Recordset9);
$totalRows_Recordset9 = mysql_num_rows($Recordset9); 

$nummodulos = $row_Recordset9['nummodulos'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset12 = "SELECT * FROM cursos WHERE id = '$idcurso'";
$Recordset12 = mysql_query($query_Recordset12, $conamatenlinea) or die(mysql_error());
$row_Recordset12 = mysql_fetch_assoc($Recordset12);
$totalRows_Recordset12 = mysql_num_rows($Recordset12);

$nombre = stripslashes(stripslashes($row_Recordset12['nombre']));
$descripcion = stripslashes(stripslashes($row_Recordset12['descripcion']));
$unixinicio = stripslashes(stripslashes($row_Recordset12['fechainicio']));
$unixfinal = stripslashes(stripslashes($row_Recordset12['fechafinal']));
$costo = stripslashes(stripslashes($row_Recordset12['costo']));
$imagen = stripslashes(stripslashes($row_Recordset12['imagen']));
$sesiones = stripslashes(stripslashes($row_Recordset12['sesiones']));



?>

<!doctype html>
<html>

<head>
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
			font-size: 13px;
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
			background-color: #bccdd4;
			color: #fff !important;
			/*text-shadow: none;*/
		}

		#regresar:hover {
			background-color: #bccdd4;
			color: #fff !important;
		}
		
		#agregar:hover {
			text-decoration: underline;
		}

		#editar:hover {
			text-decoration: underline;
		}

		#eliminar:hover {
			text-decoration: underline;
		}
		

	</style>

	<script>

		function AgregarMateria() {

			//Ventana emergente para agregar una materia de un módulo en el plan de estudios
		}

		function eliminar() {

			//Ventana emergente para eliminar una materia del plan de estudios
		}

	</script>

</head>

<body>

	<!---Wrapper-->
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
		<!---FIN menu plataforma educativa-->

		<!---Seccion principal-->
		<div id="seccionprincipal" style="width: 80%; float: left; margin-left: 20%; background-color: #fff; background-position: center; background-size: cover; overflow: scroll; height: 100vh;">

			<div id="titulo" align="center" style="float: left; font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: bolder; color: #000; width: 100%; margin-top: 40px; margin-bottom: 40px; letter-spacing: 2px;"> PLAN DE ESTUDIOS</div>

			<div id="contenedormodulos" style="width: calc(100% - 20px); float: left; margin-right: 10px; margin-left: 10px;">

			<?php 

    		$modulo = 1;
    
    		do {

        	$query_Recordset2 = "SELECT * FROM materiascurso WHERE idcurso = '$idcurso' AND nummodulo = '$modulo'";
        	$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
        	$row_Recordset2 = mysql_fetch_assoc($Recordset2);
        	$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

        	$nummaterias = $totalRows_Recordset2;
        
			?>
				<!---Modulo 1-->
				<div id="modulo" style="width: calc(50% - 35px); float: left; font-family: montserrat; border: 1px solid #ccc; padding: 5px; margin-bottom: 30px; margin-left: 10px; margin-right: 10px;">

					<div id="titulomodulo" style="float: left; width: 100%; border-bottom: 1px solid lightgray;">

						<div id="titlemod" style="color: #6698ac; font-weight: bold; font-size: 20px; margin: 5px 0px; width: calc(50% - 10px); padding: 5px; float: left;">MÓDULO <?php echo $modulo; ?></div>

					</div>

					<div id="contenido" style="width:100%; float: left;">

						<div id="cabeceras" style="color: #d30000; width: 96%; float:left;padding: 3px;">

							<div id="tophead" style="width: calc(48% - 10px); float:left; font-weight: bold; margin: 2px; margin-left: 5px; margin-right: 5px; text-transform: uppercase;">Materia</div>

							<div id="tophead" style="width: calc(48% - 10px); margin-left: 5px; margin-right: 5px; float:left; font-weight: bold; margin: 2px; text-transform: uppercase;"> Maestro</div>

						</div>

					</div>
						
						<div id="contenedormaterias<?php echo $modulo; ?>" style="width: 100%; float: left;">
						
						<?php

                        $materiaactual = 0;

                        do {
                                
                            $materiaactual = $materiaactual + 1;

                            $idmateria = $row_Recordset2['idmateria'];
                            $idmaestro = $row_Recordset2['idmaestro'];

                            $query_Recordset3 = "SELECT * FROM maestros WHERE id = '$idmaestro'";
                            $Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
                            $row_Recordset3 = mysql_fetch_assoc($Recordset3);
                            $totalRows_Recordset3 = mysql_num_rows($Recordset3); 

                            $nombremaestro = $row_Recordset3['nombre'];

                            $query_Recordset4 = "SELECT * FROM materias WHERE id = '$idmateria'";
                            $Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
                            $row_Recordset4 = mysql_fetch_assoc($Recordset4);
                            $totalRows_Recordset4 = mysql_num_rows($Recordset4); 

                            $nombremateria = $row_Recordset4['nombre'];
                    ?>
						
							<div id="materia-maestro" style="width: calc(96% - 10px); float: left; margin-left: 5px; margin-right: 5px;">

								<div id="materia<?php echo $materiaactual; ?>" style="width: calc(48% - 10px); float:left; font-weight: bold; margin: 5px; line-height: 25px;"><?php echo $nombremateria ?></div>
	
								<div id="maestro<?php echo $materiaactual; ?>" style="width: calc(48% - 10px); float:left; font-weight: bold; margin: 5px; line-height: 25px;"><?php echo $nombremaestro; ?></div>

							</div>
							
							<?php
                			$row_Recordset2 = mysql_fetch_assoc($Recordset2);

             				} while($materiaactual < $nummaterias); ?>

						</div>

					</div>
				<!---FIN modulo 1-->
			
			<?php
				$modulo = $modulo + 1;

    			} while($modulo <= $nummodulos); 

				?>
				
			
			<div id="botones" style="float: left; width: 100%; margin-top: 50px; margin-bottom: 20px;">

				<div id="botonregresar" align="right" style="float: left; width: 48%; margin-top: 20px; margin-right: 2%;">

					<div id="regresar" onclick="location.href='bienvenidacurso.php';" style="font-size: 14px; width: 150px; border: 2px solid #bccdd4; font-weight: bold; letter-spacing: 3px; text-align: center; padding: 8px; cursor: pointer; color: #73848c; border-radius: 6px; font-family: 'Montserrat', sans-serif; text-transform: uppercase;">Regresar</div>

				</div>

			
				<div id="botoncontinuar" align="left" style="float: left; width: 48%; margin-top: 20px;">

					<div id="continuar" onclick="location.href='elegirmateria.php';" style="font-size: 14px; width: 150px; border: 2px solid #bccdd4; font-weight: bold; letter-spacing: 3px; text-align: center; padding: 8px; cursor: pointer; color: #73848c; border-radius: 6px; font-family: 'Montserrat', sans-serif; text-transform: uppercase;">Continuar</div>

				</div>
				
			</div> <!--Fin botones-->		
			
		</div>
		<!---FIN Seccion principal-->

	</div>
	<!---FIN Wrapper-->

</body>

</html>
