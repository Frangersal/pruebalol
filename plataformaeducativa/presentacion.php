<?php session_start(); 
$unixtime = time();

require_once('../Connections/conamatenlinea.php');

if($_SESSION['sesionalumno'] == "") {
	
	header("Location: login.php");
} else{

    $alumno = $_SESSION['sesionalumno'];
    $time = time();
}

$idmateriascurso = $_GET['id'];

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

$query_Recordset2 = "SELECT * FROM materiascurso WHERE id = '$idmateriascurso'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 
$idmateria = $row_Recordset2['idmateria'];

$presentacion = $row_Recordset2['presentacion'];
$introduccion = $row_Recordset2['introduccion'];
$propositos = $row_Recordset2['propositos'];
$idmateria = $row_Recordset2['idmateria'];

$query_Recordset3 = "SELECT * FROM materias WHERE id = '$idmateria'";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3); 

$nombremateria = $row_Recordset3['nombre'];

$query_Recordset4 = "SELECT * FROM materiascurso WHERE id = '$idmateriascurso'";
$Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4); 
$idmateria = $row_Recordset4['idmateria'];

$competencias = $row_Recordset4['competencias'];
$idcurso = $row_Recordset4['idcurso'];
$idmateria = $row_Recordset4['idmateria'];
$idmaestro = $row_Recordset4['idmaestro'];


$query_Recordset5 = "SELECT * FROM bloques WHERE idcurso = '$idcurso' AND idmateria = '$idmateriaget' AND idmaestro = '$idmaestro' AND nummodulo = '$nummodulo' GROUP BY numbloque ORDER BY numbloque";
$Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

$query_Recordset6 = "SELECT * FROM bloques WHERE idcurso = '$idcurso' AND idmateria = '$idmateriaget' AND idmaestro = '$idmaestro' AND nummodulo = '$nummodulo' ORDER BY numleccion";
$Recordset6 = mysql_query($query_Recordset6, $conamatenlinea) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);

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
            font-size: 18px;
           	letter-spacing: 4px;
            margin: 10px 0px;
            padding: 5px;
            width: calc(100% - 10px);
            color: #5a6372;
			text-transform: uppercase;
			float: left;

        }

        #descsub{
            font-size: 16px;
            margin: 30px 0px;
            padding: 5px;
            text-align: justify;
			color: #373131;
            width: calc(100% - 10px);
			float: left;
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

			<a class="linkopcion"  href="calificacion.php" style="text-decoration: none;">
				
				<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconeditar.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Calificacion</div>
				
					</div>
					
				</div>
				
			</a>
			
			
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
		
		<div id="titulomateria" align="center" style="float: left; width: 100%; color: #000; font-size: 30px; font-weight: bold; letter-spacing: 5px; margin-top: 40px; margin-bottom: 20px; text-transform: uppercase;"><?php echo $nombremateria; ?></div>
		
		<div id="separador" style="float: left; width: 100%; margin-bottom: 50px;">
					
			<div id="lineaprincipal" style="position: relative; width: 60px; margin-left: 47%; background-color: #ddd; height: 2px;"></div>
					
		</div>

    	<div id="datosmateria" style="float: left; width: 100%;">
			
                <div id="subtema" align="center"> Presentación </div>
    
                <div id="descsub"><?php echo $presentacion; ?></div>
    
                <div id="subtema" align="center"> Introducción </div>
    
				<div id="descsub"><?php echo $introduccion; ?></div>

				<div id="subtema" align="center"> Competencias </div>
				
				<div id="descsub"><?php echo $competencias; ?></div>
		</div>

		<div id="titulomateria" align="center" style="float: left; width: 100%; color: #000; font-size: 20px; font-weight: bold; letter-spacing: 5px; margin-top: 50px; margin-bottom: 40px; text-transform: uppercase;">Cuadro de contenido</div>

<div id="tablamod" style="width:100%; float: left; font-weight: bold;">
<?php 

do {

$nombrebloque = $row_Recordset5['nombrebloque'];
$numbloque = $row_Recordset5['numbloque'];

?>

<div id="bloque<?php echo $numbloque; ?>" style="float: left; width: calc(100% - 20px); margin-right: 10px; margin-left: 10px; margin-bottom: 30px;">

<div id="titulo" style="float: left; width: calc(100% - 6px); border: 3px double #a0c2d5; height: 30px; margin-bottom: 5px;">
	
<div id="etiquetatitulo" align="center" style="    float: left; width: calc(100% - 10px); padding: 5px; text-transform: uppercase; letter-spacing: 1.5px; font-size: 17px; text-align: center; font-weight: 700;">Bloque <?php echo $numbloque; ?> - <?php echo $nombrebloque; ?></div>
	
</div>

<div id="contenido" style="float: left; width: calc(100% - 6px); background: linear-gradient(to bottom, #ebf5fb 0%, #b4d2e2 100%); border: 3px double #a0c2d5; margin-bottom: 10px;">

	<div id="lecciones" align="center" style="    float: left; width: calc(100% - 20px); margin-left: 5px; margin-right: 5px; padding: 5px; font-size: 13px; text-transform: uppercase; font-weight: 700; letter-spacing: 2px;">Temas</div>

	<?php

		$query_Recordset6 = "SELECT * FROM bloques WHERE idcurso = '$idcurso' AND idmateria = '$idmateria' AND idmaestro = '$idmaestro' AND numbloque = '$numbloque' ORDER BY numleccion";
		$Recordset6 = mysql_query($query_Recordset6, $conamatenlinea) or die(mysql_error());
		$row_Recordset6 = mysql_fetch_assoc($Recordset6);
		$totalRows_Recordset6 = mysql_num_rows($Recordset6); 
	
		do {

			$leccion = $row_Recordset6['leccion'];

	?>


		<div id="tema" style=" float: left; width: calc(100% - 20px); margin: 5px 10px; font-size: 14px;;"><?php echo $leccion; ?></div>

<?php
		}while($row_Recordset6 = mysql_fetch_assoc($Recordset6));
?>

	</div>
	
</div>




<?php 

}while($row_Recordset5 = mysql_fetch_assoc($Recordset5));

?>
</div>
    
                    
            <div id="botones" style="float: left; width: 100%; margin-top: 80px; margin-bottom: 20px;">

				<div id="botonregresar" align="center" style="float: left; width: 100%; margin-top: 20px; margin-right: 2%;">

					<div id="regresar" onclick="location.href='bienvenidamateria.php?id=<?php echo $idmateriascurso; ?>';" style="font-size: 14px; width: 150px; border: 2px solid #617ca2; font-weight: bold; letter-spacing: 3px; text-align: center; padding: 8px; cursor: pointer; border-radius: 6px; font-family: 'Montserrat', sans-serif; text-transform: uppercase;">Regresar</div>

				</div>
				
			</div> <!--Fin botones-->
    
            </div>
        <!---Fin contenedor-->

    </div>
    <!---Fin Wrapper-->

</body>
</html>
