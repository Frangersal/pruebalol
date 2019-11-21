<?php
session_start();
require_once('../Connections/conamatenlinea.php');

$id = $_GET['id'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM cursos ";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$idcurso = stripslashes(stripslashes($row_Recordset1['id']));
$nombre = stripslashes(stripslashes($row_Recordset1['nombre']));
$descripcion = stripslashes(stripslashes($row_Recordset1['descripcion']));
$costo = stripslashes(stripslashes($row_Recordset1['costo']));
$imagen = stripslashes(stripslashes($row_Recordset1['imagen']));
$sesiones = stripslashes(stripslashes($row_Recordset1['sesiones']));

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset4 = "SELECT * FROM maestros ";
$Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

$idmaestro = stripslashes(stripslashes($row_Recordset4['id']));

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset5 = "SELECT * FROM materiascurso ";
$Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

$idmateriacurso = stripslashes(stripslashes($row_Recordset5['idcurso']));

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset11 = "SELECT * FROM inscripciones WHERE idcurso = '$idalumno'";
$Recordset11 = mysql_query($query_Recordset11, $conamatenlinea) or die(mysql_error());
$row_Recordset11 = mysql_fetch_assoc($Recordset11);
$totalRows_Recordset11 = mysql_num_rows($Recordset11);


$query_Recordset2 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$query_Recordset9 = "SELECT MAX(nummodulo) AS 'nummodulos' FROM materiascurso WHERE idcurso = '$idcurso'";
$Recordset9 = mysql_query($query_Recordset9, $conamatenlinea) or die(mysql_error());
$row_Recordset9 = mysql_fetch_assoc($Recordset9);
$totalRows_Recordset9 = mysql_num_rows($Recordset9);

$nummodulos = $row_Recordset9['nummodulos'];


?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conamatenlinea | admin</title>


    <!--Librerias-->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!--Libreria de los iconos-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">

    <!--Javascript-->
    <script type="text/javascript">
        $(document).ready(function() {

            $(".menuopen").hide();
            $("#oscuro").hide();
            $("#ventana").hide();

            $('.show_hide').click(function() {
                $(".menuopen").slideToggle("fast");
            });
        });

        function eliminarmateria(id) {

            if (confirm("¿Estás seguro de eliminar esta materia?") == 1) {

                location.href = "./eliminarmateria.php?id=" + id;

            }

            location.reload();

        }
    </script>
    <!--Fin Javascript-->

    <!--Estilos CSS-->
    <style>
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }

        .menu {
            font-family: 'Montserrat', sans-serif;
            float: left;
            padding: 10px;
            line-height: 30px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            width: calc(100% - 20px);
        }

        .menu:hover {
            background-color: #7FDBFF !important;
            color: #0b2c4d !important;
        }

        .linea {
            border-bottom: 1px solid #7FDBFF;
            height: 0px;
            width: 100%;
            float: left;
        }

        #link {
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

        .card {
            border: 0 solid transparent;
            -webkit-box-shadow: 0 0 20px rgba(0, 0, 0, .08);
            box-shadow: 0 0 20px rgba(0, 0, 0, .08);
            background-color: white;
            padding: 10px 30px;
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

        .imagencurso {
            width: 100%;
            overflow: hidden;
            float: left;
            padding-bottom: 80%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;

        }

        .card a:link {
            color: black;
        }

        .card a:visited {
            color: black;
        }

        a:link {
            color: white;
            text-decoration: none;
        }

        a:visited {
            color: white;
            text-decoration: none;

        }

        .tip:hover {
            background-color: lightblue;
            /* Color pendiente */
            cursor: pointer;
            /* reemplaza el cursor highlighter */
        }

        .delete {
            cursor: pointer;
        }

        #title {
            font-weight: bold;
            margin: 2px 2px;
            text-transform: uppercase;
            font-size: 18px;

        }

        #descripcion {
            margin: 2px 2px;
            font-size: 14px;

        }

        #editar:hover {
            text-decoration: underline;
            cursor: pointer;
        }

        .seleccionado:hover {
            text-decoration: underline;
            cursor: pointer;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#botonmodificar').click(function(idmateria) {

                $('#ventanaemergente').css("display", "block");
            });

            function eliminarmateria(id) {
                confirm("¿Deseas elimimar esta materia?");
            }

        });
    </script>
    <script>
        function editarmateria(id) {




        }
    </script>

</head>

<body>

    <!--Menu plataformaeducativa-->
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
		
			
				<div class="opcionactual" style="width: calc(100% - 4px); float: left; background-color: #2a3444; border-left: 4px solid #4a8ab1;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconinicio.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Inicio</div>
				
					</div>
				
				</div>
<?php

if ($maestro != "") {
    
?>
            <a class="linkopcion" href="cursos.php" style="text-decoration: none;">
				<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">

							<img class="opcionicon" src="../images/iconcursos.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Cursos</div>
				
					</div>
					
				</div>
				
            </a>
            
            <a class="linkopcion"  href="alumnosplataforma.php" style="text-decoration: none;">
			
				<div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconconfiguracion.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
			
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Alumnos</div>
			
					</div>
			
				</div>
			
			</a>


<?php } else { ?>

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

<?php

} 

?>

				
		</div>
	
			
	</div>
    <!--Fin menu plataformaeducativa-->

    <!--Wraper-->
    <div id="wrapper" style="margin-left:20%; margin-right:10%; width:80%; padding-top: 10px; background:white;">

        <!--Cuerpo curso-->
        <div id="cuerpocurso" style="width: 100%; float:left; margin-bottom:25px;">
 
        <!--Seccion alumnos-->
        <div id="seccionalumnos" style="width: 100%; background-color: #fff; text-align:center; float:left; float: left;">

<div id="tituloseccion" style="line-height: 40px; margin-top: 10px; color:#777; border-bottom: 2px solid lightgray; margin-left: 10px; margin-right: 10px; font-size: 20px; text-align: left;">Alumnos inscritos al curso</div>

<?php

$numalumnos = 1;

if ($totalRows_Recordset11 > 0) {

    do {

        $idalumno = $row_Recordset11['idalumno'];

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


        <!--Noticia 1 -->
        <div id="alumno<?php echo $id; ?>" style="margin-left:10px; float:left; overflow:hidden; width:calc(100% - 20px); height: 100px; background-color:#FFF; border-bottom:1px solid lightgray; position:relative;">

            <a href="veralumno.php?id=<?php echo $idalumno; ?>">
                <div id="imagen<?php echo $id; ?>" style="width:80px; height:80px; float:left; margin-top:10px; background-image:url('../images/<?php if ($imagenalumno != "") {echo $imagenalumno;} else { echo "silueta.png";} ?>');background-size: cover; background-position: center; background-repeat: no-repeat; margin-left: 10px;"></div>
            </a>

            <a href="veralumno.php?id=<?php echo $idalumno; ?>">
                <div id="title" align="left" style="width: calc(100% - 110px); line-height:20px; float:left; margin-top:10px; color:#000; font-size: 14px; font-weight:bold; margin-left:10px;"><?php echo $nombre; ?> <?php echo $apellidopaterno; ?> <?php echo $apellidomaterno; ?></div>
            </a>

            <div id="title" align="left" style="width: calc(100% - 110px); line-height:20px; float:left; margin-top:5px;color:#000; font-size: 12px; margin-left:10px;">Correo: <?php echo $correo; ?></div>


        </div>

        <?php

        $numalumno = $numalumno + 1;
    } while ($row_Recordset11 = mysql_fetch_assoc($Recordset11));

} else {
    ?>

    <div id="nohay" align="center" style="float: left; width: 100%; color: #fff; line-height: 300px; ">No se encontraron cursos registrados</div>

<?php
}

?>


</div>
        <!--Fin seccion alumnos-->

    </div>
    <!--Fin cuerpo curso-->

</div>
<!--Fin wraper-->

</body>

</html>
