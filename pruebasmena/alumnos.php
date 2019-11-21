<?php require_once('../Connections/conamatenlinea.php');
session_start();

if($_SESSION['sesionmaestro'] == "") {
	
	header("Location: ../index.php");

} else{

    $maestro = $_SESSION['sesionmaestro'];
    $time = time();
}
//Necesaria para la imagen y nombre del maestro

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset11 = "SELECT * FROM maestros WHERE usuario = '$maestro'";
$Recordset11 = mysql_query($query_Recordset11, $conamatenlinea) or die(mysql_error());
$row_Recordset11 = mysql_fetch_assoc($Recordset11);
$totalRows_Recordset11 = mysql_num_rows($Recordset11);

$idmaestro = $row_Recordset11['id'];
$imagenactual = $row_Recordset11['imagen'];
$nombre = $row_Recordset11['nombre'];

//--->



$idcurso = $_GET['id'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM cursos WHERE id = '$idcurso'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$nombre = stripslashes(stripslashes($row_Recordset1['nombre']));
$descripcion = stripslashes(stripslashes($row_Recordset1['descripcion']));
$unixinicio = stripslashes(stripslashes($row_Recordset1['fechainicio']));
$unixfinal = stripslashes(stripslashes($row_Recordset1['fechafinal']));
$costo = stripslashes(stripslashes($row_Recordset1['costo']));
$imagen = stripslashes(stripslashes($row_Recordset1['imagen']));
$sesiones = stripslashes(stripslashes($row_Recordset1['sesiones']));

$query_Recordset2 = "SELECT * FROM inscripciones WHERE idcurso = '$idcurso'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

?>

<!DOCTYPE html>
<html lang="es"><head>
    <meta charset="UTF-8">
    <title>Conamat en línea | Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<!--Estilos CSS-->
<style>
body{
    margin: 0;
    background-color: #0b2c4d;
    font-family: 'Montserrat', sans-serif; 
}
.menu{
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
    padding: 20px 30px;
}
	
 .progress-wrp {
            position: relative;
            border-radius: 3px;
            margin: 0px;
            text-align: left;
            background: #7FDBFF;
            color: white;
}

.progress-bar {
            height: 45px;
            width: 0;
            background-color: #0b2c4d;
            line-height: 45px;
}

.status {
     top: 3px;
     left: 0%;
     width: 100%;
     text-align: center;
     position: absolute;
     line-height: 45px;
     display: inline-block;
     color: #000000;
 }
	
.toprow {
    float:left;
    width: 100%;
    background-color: #0b2c4d; 
    color: white;
}
.topcell {
    float: left; 
    width: calc(25% - 2px);
    line-height: 30px;
    text-align: center;
}
.row {
    float:left;
    width: 100%;
    background-color: white; 
}
.cell {
    float: left; 
    width: calc(25% - 2px);
    border: 1px solid lightgray;
    line-height: 30px;
    text-align: center;
}
.nostyle:link {
    color: #222;
    text-decoration: none;
}
.nostyle:visited {
    color: #222;
    text-decoration: none;
}
#librolink:hover {
    background-color: #0b2c4d; 
    color: white;
}

.imagenmateria {
     width: 100%;
	 height: 200px;
     float: left;
     border: 1px solid #ccc;
	background-size: cover;
	background-position: center;
	margin-bottom: 10px;
}

.portadamateria {
		width: 859px;
		height: 220px;
		float: left;
		border: 1px solid #ccc;
		background-image: url(../images/headerciencia.jpg);
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
}

.boton:hover {   
	 text-decoration: underline;
}

.opcion:hover {
	background-color: #2a3444 !important;
	border-left: 4px solid #4a8ab1 !important;
	cursor: pointer;
}

.nombreopcion:hover {
		cursor: pointer !important;
}
#nombrealumno:hover {

    font-weight: bold;

}
	

</style>
<!--Fin estilos CSS-->

</head>
<body>

<div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

<!--Menu plataforma educativa-->
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
		
		<div id="nombre" align="center" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #abb4c1; width: 90%; letter-spacing: 0.5px; line-height: 20px; padding: 10px;">
			<?php echo $nombre ." ". $apellidopaterno ." ". $apellidomaterno; ?>
		</div>
		
		<div id="lineaseparadora1" style="width: 100%; height: 1px; background-color: #000; float: left;"></div>
		<div id="lineaseparadora2" style="width: 100%; height: 1px; background-color: #807979; float: left;"></div>
				
		<div id="opcionesmenu" style="width: 100%; float: left;">
			
            <a class="linkopcion" href="index.php" style="text-decoration: none;">

                <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconinicio.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Inicio</div>
				
					</div>
				
                </div>

            </a>

            <div class="opcionactual" style=" width: calc(100% - 4px); float: left; background-color: #2a3444; border-left: 4px solid #4a8ab1;">

				<div class="opcion" style="width: calc(100% - 4px); float: left;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">

							<img class="opcionicon" src="../images/iconcursos.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Cursos</div>
				
					</div>
					
				</div>
				
            </div>
            
            <a class="linkopcion" href="./configuracionmaestro.php" style="text-decoration: none;">

                <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconconfiguracion.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Configuracion</div>
				
					</div>
				
                </div>

            </a>

            <a class="linkopcion" href="../logout.php" style="text-decoration: none;">

                <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconsalir.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Salir</div>
				
					</div>
				
                </div>

            </a>



		</div>

			
    </div>
    <!--FIN Menu plataforma educativa-->


    <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">
       
        
        <div id="contenedor" class="card" style="width: calc(100% - 60px); float: left;">

            <div id="titulo" align="center" style="padding-top: 20px; margin-bottom: 20px; font-family: 'Montserrat', sans-serif; font-size: 35px; color: #333; font-weight: bold; line-height: 90px; letter-spacing: 1.6px;">Alumnos</div>


    <div id="titulo" align="center" style="font-family: 'Montserrat', sans-serif; font-size: 18px; color: #333; margin-bottom: 10px;"><?php echo $nombre; ?></div>

           
            <div id="tablamaterias" style="float: left; margin-bottom: 60px; width: 100%;">
    
                <div class="toprow" style="margin-left: 10px;">
                    <div class="topcell" style="width: 5%;">No.</div>
                    <div class="topcell" style="width: calc( 95% - 110px); text-align: left; padding-left: 110px;">Nombre del alumno</div>
                </div>

                <?php

                $numalumno = 1;

                if ($totalRows_Recordset2 > 0) {

                    do {

                        $idalumno = $row_Recordset2['idalumno'];

                        $query_Recordset3 = "SELECT * FROM alumnos WHERE id = '$idalumno'";
                        $Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
                        $row_Recordset3 = mysql_fetch_assoc($Recordset3);
                        $totalRows_Recordset3 = mysql_num_rows($Recordset3);

                        $nombre = $row_Recordset3['nombrealumno'];
                        $apellidopaterno = $row_Recordset3['apellidopaterno'];
                        $apellidomaterno = $row_Recordset3['apellidomaterno'];
                        $correo = $row_Recordset3['correo'];
                        $curp = $row_Recordset3['curp'];
                        $imagenalumno = $row_Recordset3['imagen'];
                        $id = $row_Recordset3['id'];

                        ?>

                        <!--alumno n -->
                        <div id="alumno<?php echo $id; ?>" style="margin-left:10px; float:left; overflow:hidden; width:calc(100% - 20px); height: 100px; background-color:#FFF; border-bottom:1px solid lightgray; position:relative;">

                        <div id="numalumno" style="width: 5%; line-height: 100px; font-size: 13px; float: left; text-align: center;"><?php echo $numalumno; ?>.-</div>

                            <a href="veralumnoplataforma.php?id=<?php echo $idalumno; ?>">
                                <div id="imagen<?php echo $id; ?>" style="width:80px; height:80px; float:left; margin-top:10px; background-image:url('../images/<?php if ($imagenalumno != "") {echo $imagenalumno;} else { echo "silueta.png";} ?>');background-size: cover; background-position: center; background-repeat: no-repeat; margin-left: 10px;"></div>
                            </a>

                            <a href="veralumnoplataforma.php?id=<?php echo $idalumno; ?>">
                                <div id="nombrealumno" align="left" style="width: calc(95% - 110px); line-height:20px; float:left; margin-top:10px; color:#000; font-size: 14px; font-weight:bold; margin-left:10px;"><?php echo $nombre; ?> <?php echo $apellidopaterno; ?> <?php echo $apellidomaterno; ?></div>
                            </a>

                            <div id="title" align="left" style="width: calc(95% - 110px); line-height:20px; float:left; margin-top:5px;color:#000; font-size: 12px; margin-left:10px;">Correo: <?php echo $correo; ?></div>


                        </div>

                        <?php

                        $numalumno = $numalumno + 1;
                    } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));

?>

            </div>

<?php } ?>

                    <div id="contenedorboton" align="center" style="float: left; width: 100%; margin: 40px 0px;">
                            <button type="button" onclick="window.location.href='cursos.php'" style="border-radius: 5px;line-height: 30px;background-color: #7f8081;border-color: #7f8081;padding: 0px 20px;color: white;cursor: pointer;font-size: 12px;font-weight: bold;border-style: none;">REGRESAR</button>
                    </div>
                        
      </div>


    </div>
    
</div>


</body>
</html>
