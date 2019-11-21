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

$query_Recordset12 = "SELECT * FROM materiascurso WHERE idcurso = '$idcurso'";
$Recordset12 = mysql_query($query_Recordset12, $conamatenlinea) or die(mysql_error());
$row_Recordset12 = mysql_fetch_assoc($Recordset12);
$totalRows_Recordset12 = mysql_num_rows($Recordset12); 

$nummodulos = $row_Recordset9['nummodulos'];


?>

<!DOCTYPE html>
<html lang="en">
<head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
        <title>Escoge materia</title>
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
            font-family: "montserrat";  
            margin: 0px;
        }

        #materia1{
            border-radius: 20px;
            width: calc(20% - 20px);
            background: black;
            height: 200px;
            margin: 10px;
            cursor: pointer;
            box-shadow: 7px 7px 7px rgba(46,45,41,0.35);
            overflow: hidden;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
			height: 200px;
           
        }

        #nombremat1{
            background: rgba(0, 0, 0, 0.7);
            margin-top: 110px;
            padding: 5px 0px;
            font-size: 24px;
            text-align: center; 
            color: white;
        }

        #materia1:hover{
            transform: scale(1.1);
		}
		
		#regresar:hover {
            background-color: #617ca2;
			color: #fff;
		}
		
		#plandeestudios:hover {
            background-color: #48768d;
			color: #fff;
        }

    

    </style>

	<script type="text/javascript">
	
		function mostrarmaterias(){

			$("#contenedormaterias").slideToggle('fast');

		}
       
    </script>

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
        <div id="contenedor" style="width: calc(100% - 22%); float:right; padding: 10px;  height: 500px; ">

			<div id="instrucciones" style="width:100%; float:left; top: 12%; font-size: 20px; text-align: center; margin-top: 50px; margin-bottom: 50px;"> Da click en alguna materia para comenzar a trabajar.</div>
			
			<div id="botonplandeestudios" align="center" style="float: left; width: 100%; margin: 30px 0px;">

				<div id="plandeestudios" onclick="location.href='plandeestudios.php';" style="font-size: 14px; width: 150px; border: 2px solid #48768d; font-weight: bold; letter-spacing: 3px; text-align: center; padding: 8px; cursor: pointer; border-radius: 6px; font-family: 'Montserrat', sans-serif; text-transform: uppercase;">Plan de estudios</div>

			</div>

			<?php 

    		$modulo = 1;
    
    		do {
        
			?>


            <div id="titulomodulo" style="float: left; width: 100%; border-bottom: 1px solid lightgray; background: lightgray; cursor: pointer; text-align: center; margin-bottom: 10px;" onclick="mostrarmaterias();">

                <div id="titlemod" style="text-align:center; color: #6698ac; font-weight: bold; font-size: 20px; margin: 5px 0px; width: calc(100% - 10px); padding: 5px; float: left; ">Materias del módulo <?php echo $modulo; ?></div>

            </div>

			<div id="contenedormaterias" align="center" style="width:100%; float: left; top: calc(50% - 150px); margin-bottom: 50px; display:none;">

<?php 

            $query_Recordset2 = "SELECT * FROM materiascurso WHERE idcurso = '$idcurso' AND nummodulo = '$modulo'";
            $Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
            $row_Recordset2 = mysql_fetch_assoc($Recordset2);
            $totalRows_Recordset2 = mysql_num_rows($Recordset2); 


        
            do {

                $idmateriacurso = $row_Recordset2["id"];

                $nummaterias = $totalRows_Recordset2;
                $imagenmateria = $row_Recordset2['imagen'];
                $idmateria = $row_Recordset2['idmateria'];

                $query_Recordset3 = "SELECT * FROM materias WHERE id = '$idmateria'";
                $Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
                $row_Recordset3 = mysql_fetch_assoc($Recordset3);
                $totalRows_Recordset3 = mysql_num_rows($Recordset3); 

                $nombremateria = $row_Recordset3['nombre'];


?>
			
    <a id="linkcontinuar" href="bienvenidamateria.php?id=<?php echo $idmateriacurso; ?>">
                    <div id="materia1" <?php if ($imagenmateria != "") { ?>style="background-image: url(../images/<?php echo $imagenmateria ?>);"<?php } else { ?>style="background-color: darkorange; color: white;"<?php } ?>>
                        <div id="nombremat1"><?php echo $nombremateria ?></div>
					</div>
				</a>

<?php
    
            
    			} while($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 

?>
			
			</div>
			
			<?php

                    $modulo = $modulo + 1;

                

    			} while($modulo <= $nummodulos); 

				?>
	
				

					<div id="botonregresar" align="center" style="float: left; width: 100%; margin: 30px 0px;">

						<div id="regresar" onclick="location.href='curso.php';" style="font-size: 14px; width: 150px; border: 2px solid #617ca2; font-weight: bold; letter-spacing: 3px; text-align: center; padding: 8px; cursor: pointer; border-radius: 6px; font-family: 'Montserrat', sans-serif; text-transform: uppercase;">Regresar</div>

					</div>
    
		</div>
		<!---FIN Contenedor-->
    
	</div>
	<!--FIN Wrapper-->

</body>

</html>
