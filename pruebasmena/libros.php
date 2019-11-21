<?php require_once('../Connections/conamatenlinea.php');
session_start();

if ($_SESSION['sesionmaestro'] == "") {
    
    header("Location: login.php");

}else{

    $usuario = $_SESSION['sesionmaestro'];
    $unixtime = time();
}

$idmateriacurso = $_GET['id'];

//Necesaria para la imagen y nombre del maestro

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM maestros WHERE usuario = '$usuario'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$idmaestro = $row_Recordset1['id'];
$imagenactual = $row_Recordset1['imagen'];
$nombre = $row_Recordset1['nombre'];

//--->

$query_Recordset7 = "SELECT * FROM materiascurso WHERE id = '$idmateriacurso'";
$Recordset7 = mysql_query($query_Recordset7, $conamatenlinea) or die(mysql_error());
$row_Recordset7 = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7);

$idmateria = $row_Recordset7['idmateria'];

$query_Recordset3 = "SELECT * FROM materias WHERE id = '$idmateria'";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$nombremateria = $row_Recordset3['nombre'];

$query_Recordset5 = "SELECT * FROM biblioteca";
$Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

$query_Recordset6 = "SELECT * FROM libroscurso WHERE idmateriacurso = '$idmateriacurso' ORDER BY idlibro ASC";
$Recordset6 = mysql_query($query_Recordset6, $conamatenlinea) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);




?>

<!DOCTYPE html>
<html lang="es">

<head>
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
        body {
            margin: 0;
            background-color: #0b2c4d;
            font-family: 'Montserrat', sans-serif;
        }

        .menu {
            font-family: 'Montserrat', sans-serif;
            padding: 10px;
            line-height: 30px;
            float: left;
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
            float: left;
            width: 100%;
            background-color: #0b2c4d;
            color: white;
            min-height: 50px;
        }

        .topcell {
            float: left;
            width: calc(25% - 2px);
            line-height: 50px;
            text-align: center;
        }

        .row {
            float: left;
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
    </style>
    <!--Fin estilos CSS-->

    <!--Javascript-->
    <script type="text/javascript">

        function cancelar() {

            location.href = "cursos.php";
        }


        function guardarform(idmateriacurso) {

            var form_data = new FormData();
                    
            //materias y modulos

            var numlibros = $("#numlibros").val();
            var libros = [];

            for(var j = 1; j <= numlibros; j++) {

                libros[j-1] = $("#libro" + j).val();

            }

            form_data.append('numlibros' , numlibros);
            form_data.append('libros' , JSON.stringify(libros));
            form_data.append('idmateriacurso', idmateriacurso);

            $.ajax({

                url: "agregarlibros.php",
                type: "POST",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                mimeType: "multipart/form-data"
            });

            alert("Se han guardado los cambios");

            location.href = "";

        }

        function agregarlibro() {

            var numlibros = parseInt($("#numlibros").val(), 10) + parseInt(1, 10);

            $("#numlibros").val(numlibros);

            $("#contenedorlibros").append('<div id="contenedorlibro' + numlibros + '" style="width:60%; float:left; padding: 0px 20%"><select id="libro' + numlibros + '" name="libro" style="font-size: 12px; height: 40px; width: calc(70% - 14px); box-sizing: border-box; padding:10px; border: 2px solid lightgray; background-color: whitesmoke; color: gray; float: left;"><?php if ($totalRows_Recordset5 == 0 ) { ?><option value="' + numlibros + '">No hay libros</option><?php } else { ?><option value="">Elegir un libro</option><?php do { $id = $row_Recordset5['id'];$titulo = stripslashes(stripslashes($row_Recordset5['titulo'])); ?><option value="<?php echo $id; ?>"><?php echo $titulo; ?></option><?php } while($row_Recordset5 = mysql_fetch_assoc($Recordset5)); ?><?php } ?></select><div id="eliminarlibro' + numlibros + '" class="boton" type="button" onclick="eliminarlibro(&#39;' + numlibros + '&#39;)" style="width: calc(30% - 20px); font-weight: bold; float: left; line-height: 30px;  margin:10px; color: #f66666; cursor: pointer;">Eliminar libro</div></div>');

        }

        function eliminarlibro(id) {

            var numlibros = parseInt($("#numlibros").val());

            $("#contenedorlibro" + id).remove();

            numlibros = numlibros - 1;

            $("#numlibros").val(numlibros);


        }


    </script>
    <!--Fin Javascript-->

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

        <div id="seccionprincipal"style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">

            <div id="contenedor-libros" class="card" style="width:calc(100% - 60px); float: left;">

                <div id="contenedorbiblioteca" align="center" style="border: 5px solid #1d4267; float: left; width: calc(100% - 10px); ">

                <div id="datosbasicos" align="center" style="float: left;width: 100%;font-size: 20px;text-transform: uppercase;font-family: 'Montserrat', sans-serif;margin: 20px 0px;color: #000;font-weight: bold;letter-spacing: 2px;">LIBROS DE <?php echo strtoupper($nombremateria); ?></div>

                            <div id="contenedorboton" align="center" style="float: left;width: calc(100% - 30px);margin: 15px;">

                                <button type="button" onclick="agregarlibro()" style="border-radius: 5px; line-height: 30px; background-color: #494d51; border-color: #494d51; padding: 0px 20px; color: white; cursor: pointer;">Agregar libro</button>

                            </div>

                            <div id="contenedorlibros" style="width: calc(100% - 20px); float: left; margin: 10px;">

                            <input id="numlibros" type="hidden" name="numlibros" value="<?php echo $totalRows_Recordset6; ?>">

<?php 

$query_Recordset5 = "SELECT * FROM biblioteca";
$Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

/*

$query_Recordset6 = "SELECT * FROM libroscurso WHERE idmateriacurso = '$idmateria'";
$Recordset6 = mysql_query($query_Recordset6, $conamatenlinea) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);

 */

if ($totalRows_Recordset6 > 0) {

    $contador = 1;

    do {

        $idlibroseleccionado = $row_Recordset6['idlibro'];

?>

<div id="contenedorlibro<?php echo $contador; ?>" style="width:60%; float:left; padding: 0px 20%">
    <select id="libro<?php echo $contador; ?>" name="libro" style="font-size: 12px; height: 40px; width: calc(70% - 14px); box-sizing: border-box; padding:10px; border: 2px solid lightgray; background-color: whitesmoke; color: gray; float: left;">

<?php
$query_Recordset5 = "SELECT * FROM biblioteca";
$Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

if ($totalRows_Recordset5 > 0) {

    do {

        $idlibro = $row_Recordset5['id'];
        $titulo = $row_Recordset5['titulo'];
?>

    <option value="<?php echo $idlibro; ?>"<?php if ($idlibro == $idlibroseleccionado) echo " selected"; ?>><?php echo $titulo; ?></option>

<?php

    } while($row_Recordset5 = mysql_fetch_assoc($Recordset5));

}

?>



    </select>

    <div id="eliminarlibro<?php echo $contador; ?>" class="boton" type="button" onclick="eliminarlibro('<?php echo $contador; ?>')" style="width: calc(30% - 20px); font-weight: bold; float: left; line-height: 30px;  margin:10px; color: #f66666; cursor: pointer;">Eliminar libro</div>

</div><!--Termina contenedor de libro1-->

<?php 

        $contador++;

    } while($row_Recordset6 = mysql_fetch_assoc($Recordset6));

}

?>


                            </div>

                        <div id="contenedorboton" align="center" style="float: left; width: 100%; margin: 40px 0px;">
                            <button type="button" onclick="guardarform(); " style="border-radius: 5px;line-height: 30px;background-color: #1d4267;border-color: #1d4267;padding: 0px 20px;color: white;cursor: pointer;font-weight: bold;font-size: 12px;border-style: none;">GUARDAR CAMBIOS</button>
                            <button type="button" onclick="cancelar();" style="border-radius: 5px;line-height: 30px;background-color: #7f8081;border-color: #7f8081;padding: 0px 20px;color: white;cursor: pointer;font-size: 12px;font-weight: bold;border-style: none;">REGRESAR</button>
                        </div>

                </div>

            </div>

        </div>

    </div>


</body>

</html>
