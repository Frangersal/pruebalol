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
	
		#modulo:hover{
		background-color: #44618c;
		color: #fff !important;
	}

</style>

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
			
	</div> <!--Fin menú principal-->
	
<div id="seccionprincipal" style="width: 80%; height: 100vh; float: left; position: relative; margin-left: 20%; background-color: #fff;">

	<div id="titulo" align="center" style="width: 100%; float: left; margin-top: 30px; margin-bottom: 50px; font-family: 'Montserrat', sans-serif; font-size: 22px; text-transform: uppercase; letter-spacing: 2px; font-weight: bold;">Biblioteca</div>
	
	<div id="seleccionarmodulo" style="width: 60%; float: left; margin-left: 20%; margin-right: 20%; margin-bottom: 50px;">
	
		<div id="texto" align="center" style="width: 100%; float: left; font-size: 18px; color: #44618C; letter-spacing: 3px; text-align: center; padding: 10px; font-family: 'Montserrat', sans-serif; text-transform: uppercase; margin-bottom: 30px; margin-left: 30px;">Selecciona un módulo:</div>
	
		<div id="modulo" style="width: 150px; border: 2px solid #44618C; color: #44618C; border-radius: 6px; float: left; font-size: 15px; letter-spacing: 3px; text-align: center; padding-top: 25px; padding-bottom: 25px; padding-left: 10px; padding-right: 10px; cursor: pointer; font-family: 'Montserrat', sans-serif; text-transform: uppercase; font-weight: bold; margin-left: 30px;">Módulo I.
		</div>
		
		<div id="modulo" style="width: 150px; border: 2px solid #44618C; color: #44618C; border-radius: 6px; float: left; font-size: 15px; letter-spacing: 3px; text-align: center; padding-top: 25px; padding-bottom: 25px; padding-left: 10px; padding-right: 10px; cursor: pointer; font-family: 'Montserrat', sans-serif; text-transform: uppercase; font-weight: bold; margin-left: 30px;">Módulo I.
		</div>
		
		<div id="modulo" style="width: 150px; border: 2px solid #44618C; color: #44618C; border-radius: 6px; float: left; font-size: 15px; letter-spacing: 3px; text-align: center; padding-top: 25px; padding-bottom: 25px; padding-left: 10px; padding-right: 10px; cursor: pointer; font-family: 'Montserrat', sans-serif; text-transform: uppercase; font-weight: bold; margin-left: 30px;">Módulo I.
		</div>
	
	</div>

	<div id="botonregresar" align="center" style="float: left; width: 100%; margin-top: 20px; margin-right: 2%;">

		<div id="regresar" onclick="location.href='bienvenidacurso.php';" style="font-size: 16px; width: 150px; border: 2px solid #44618C; font-weight: bold; letter-spacing: 3px; text-align: center; padding: 8px; cursor: pointer; color: #fff; background-color: #44618C; border-radius: 6px; font-family: 'Montserrat', sans-serif;">Regresar</div>

	</div>
	
	
	<div id="modulo" style="width: calc(80% - 12px); float: left; font-family: montserrat; border: 1px solid #ccc; padding: 5px; margin-bottom: 30px; margin-left: 10%; margin-right: 10%; margin-top: 50px;">

			<div id="titulomodulo" style="float: left; width: 100%; border-bottom: 1px solid lightgray;">

				<div id="titlemod" style="color: #6698ac; font-weight: bold; font-size: 20px; margin: 5px 0px; width: calc(100% - 20%); margin-left:10%; margin-right:10%; text-align:center; float: left;">MÓDULO 1</div>

			</div>

			<div id="contenido" style="width: 100%; float: left; text-align:center">

				<div id="tophead" align="center" style="width: calc(100% - 4px); float:left; font-weight: bold; margin: 2px; text-transform: uppercase;"> LIBROS</div>

			</div>
						
			<div id="contenedormodulo" style="width: 100%; float: left; text-align:center;">
												
				<div id="materia-maestro" align="center" style="width: calc(100% - 10px); float: left; margin-left: 5px; margin-right: 5px; font-size: 14px; margin-top: 5px;">Inglés</div>
						
				<div id="materia-maestro" align="center" style="width: calc(100% - 10px); float: left; margin-left: 5px; margin-right: 5px; font-size: 14px; margin-top: 5px;">Inglés</div>
						
				<div id="materia-maestro" align="center" style="width: calc(100% - 10px); float: left; margin-left: 5px; margin-right: 5px; font-size: 14px; margin-top: 5px;">Inglés</div>
								
			</div>

	</div>
				<!---FIN modulo 1-->
	

</div>	<!--Fin sección principal-->

</div> <!--Fin wrapper-->

</body>

</html>