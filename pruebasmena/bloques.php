<?php
require_once('../Connections/conamatenlinea.php');
session_start();

if($_SESSION['sesionmaestro'] == "") {
	
	header("Location: index.php");

} else{

    $maestro = $_SESSION['sesionmaestro'];
    $time = time();
}

$idcurso = $_GET['id'];
$idmateriaget = $_GET['idmateria'];
$idmaestro = $_GET['idmaestro'];
$nummodulo = $_GET['nummodulo'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM bloques WHERE idcurso = '$idcurso' AND idmateria = '$idmateriaget' AND idmaestro = '$idmaestro' AND nummodulo = '$nummodulo' GROUP BY numbloque ORDER BY numbloque";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

$query_Recordset2 = "SELECT * FROM bloques WHERE idcurso = '$idcurso' AND idmateria = '$idmateriaget' AND idmaestro = '$idmaestro' AND nummodulo = '$nummodulo' ORDER BY numleccion";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$query_Recordset0 = "SELECT * FROM maestros WHERE usuario = '$maestro'";
$Recordset0 = mysql_query($query_Recordset0, $conamatenlinea) or die(mysql_error());
$row_Recordset0 = mysql_fetch_assoc($Recordset0);
$totalRows_Recordset0 = mysql_num_rows($Recordset0); 

$imagenactual = $row_Recordset0['imagen'];
$nombre = $row_Recordset0['nombre'];



?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!---Librerias-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"></link>

    <title>Bloques</title>

    <!--Estilos-->
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

            .tophead:hover{
                text-decoration: underline;
            }

textarea{
    height: 100px;
}


    </style>

    <!--Javascript-->
    <script type="text/javascript">

        function agregarbloque() {

            var numerobloque = parseInt($("#numerobloque").val()) + 1;

            $("#numerobloque").val(numerobloque);

            $('#tablamod').append('<div id="topheadi'+numerobloque+'" class="tophead" onclick="agregarleccion('+numerobloque+')" style="color: #00959594; width: 25%; float: left; font-weight: bold; margin: 2px; cursor: pointer; margin-left:calc(30% + 4px);"> +Agregar leccion </div> <div id="topheadd'+numerobloque+'" class="tophead" onclick="eliminarleccion('+numerobloque+')" style="color: #d16c6cbd; width: 25%; float: left; font-weight: bold; margin: 2px; cursor: pointer; display: none;">-Eliminar leccion</div> </div> <form id="bloquesform'+numerobloque+'" name="bloquesform'+numerobloque+'" enctype="multipart/form-data" method="post" action=""> <input id="numlecciones'+numerobloque+'" type="hidden" name="numlecciones'+numerobloque+'" value="'+1+'"> <div id="toprow'+numerobloque+'" style="width: calc(100% - 10px); float:left; padding: 5px;"> <input type="text" id="nombrebloque'+numerobloque+'" name="nombrebloque'+numerobloque+'" value="" placeholder="Nombre del bloque '+numerobloque+'" style="padding: 10px;  width: calc(30% - 32px); float:left; margin: 5px;background: #afdaff;"> <div id="bloqued'+numerobloque+'" style="background: aliceblue;padding: 10px; font-size: 10px; width: calc(70% - 32px); float:left; margin: 5px;"> <textarea id="cuerpo1" name="cuerpo1" placeholder="Nombre y contenido de la lección" value="" style="width: calc(100% - 6px); resize: none; float: left; margin: 3px;"> </textarea> </div> </div> </div>');

            if (numerobloque > 1) {
                $("#topheade").show();
            }
            
        }

        function eliminarbloque() {

            var numerobloque = parseInt($("#numerobloque").val());

            $("#toprow"+numerobloque).remove();
            $("#topheadd"+numerobloque).remove();
            $("#topheadi"+numerobloque).remove();

            numerobloque = numerobloque - 1;

            $("#numerobloque").val(numerobloque);

            if (numerobloque == 1) {
                $("#topheade").hide();
            }

        }

        function agregarleccion(numerobloque) {

            var numlecciones = parseInt($("#numlecciones"+numerobloque).val()) + 1;

            $("#numlecciones" + numerobloque).val(numlecciones);

            $('#bloqued'+numerobloque).append('<textarea id="cuerpo'+numlecciones+'"  style="width:calc(100% - 6px); float: left; resize: none; margin: 3px;"></textarea>');

            if (numlecciones  > 1) {
                $("#topheadd"+ numerobloque).show();

            }

        }

        function eliminarleccion(numerobloque) {

           var numlecciones = parseInt($("#numlecciones"+numerobloque).val());

            $("#cuerpo"+numlecciones).remove();

            numlecciones = numlecciones - 1;

            $("#numlecciones"+numerobloque).val(numlecciones);

            if (numlecciones == 1) {
                $("#topheadd"+numerobloque).hide();
            }

        }
    
    </script>

    <script>


function guardarform() {

	var form_data = new FormData();

    //materias y modulos

    var numlecciones = 0;
    var leccionesporbloque = [];
    var bloques = [];
    var numbloque = $("#numerobloque").val();

    for(var i = 1; i <= numbloque; i++) {

        var lecciones = [];

        bloques[i-1] = $("#nombrebloque" + i ).val();

        numlecciones = $("#numlecciones" + i).val();

        for(var j = 1; j <= numlecciones; j++) {

            lecciones[j-1] = $("#bloqued" + i + " #cuerpo" + j).val();

        }

        leccionesporbloque[i-1] = lecciones;

        
    }


    form_data.append('numbloques' , numbloque);
    form_data.append('bloques' , JSON.stringify(bloques));
    form_data.append('leccionesporbloque' , JSON.stringify(leccionesporbloque));
    form_data.append('idcurso' , <?php echo $idcurso ?>);
    form_data.append('idmateria' , <?php echo $idmateriaget ?>);
    form_data.append('idmaestro' , <?php echo $idmaestro ?>);
    form_data.append('nummodulo' , <?php echo $nummodulo ?>);

$.ajax({

	url: "modificarbloques.php",
	type: "POST",
	data: form_data,
	cache: false,
    contentType: false,
    processData:false,
    dataType: 'json',
    mimeType:"multipart/form-data"

    }).done(function (){

        location.href = "cursos.php";

    });




}



    </script>

</head>

<body>

        <!--Wrapper-->
        <div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

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

            <a class="linkopcion"  href="../logout.php" style="text-decoration: none;">
			
				<div class="opcion" style="float: left;">
				
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/plataformasalir.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden; padding-bottom: 3px;">Salir</div>
				
					</div>
				
				</div>
				
			</a>

		</div>
			
	</div>

                <!--Seccion principal-->
                <div id="seccionprinpal" style="width:80%; margin-left: 20%; float: left; background: white; ">

                    <div id="contenedor" style="width: calc(100% - 10px);float:left; padding: 5px;position:relative;">

                    <div id="titulo" style="text-align: center; font-size: 30px; font-weight: bold;margin: 20px 0px; padding: 5px; color: #187ba8; width: calc(100% - 10px);">BLOQUES DEL MÓDULO <?php echo $nummodulo; ?></div>

<?php

if ($totalRows_Recordset1 == 0) {


?>

                        <!--TABLA MOD-->                    
                        <div id="tablamod" style="width:100%;  float: left; font-weight: bold;">

                        <input id="numerobloque" type="hidden" name="numerobloque" value="1">

                        <div id="toph" style="width: calc(100% - 20px); float:left; padding: 0px 10px;">

                            <div id="contiene-agregareliminar" style="margin: 2px; width: calc(30% - 4px); float:left;">

                                <div id="topheada" class="tophead" onclick="agregarbloque('1')" style="color: #009595;width: calc(50% - 4px);float:left;font-weight: bold;margin: 2px;cursor:pointer;">+Agregar bloque</div>
                                            
                                <div id="topheade" class="tophead" onclick="eliminarbloque('1')" style="color: rgb(209, 108, 108); width: calc(50% - 4px); float: left; font-weight: bold; margin: 2px; cursor: pointer; display: none;">-Eliminar bloque</div>

                            </div>
                               
                            <div id="agregareliminar-leccion" style="margin: 2px;width: calc(70% - 4px);float:left;">

                                <div id="topheadi" class="tophead" onclick="agregarleccion('1')" style="color: #00959594; width: 25%; float: left; font-weight: bold; margin: 2px; cursor: pointer; ">+Agregar leccion</div>

                                <div id="topheadd1" class="tophead" onclick="eliminarleccion('1')" style="color: rgba(209, 108, 108, 0.74); width: 25%; float: left; font-weight: bold; margin: 2px; cursor: pointer; display: none;">-Eliminar leccion</div>

                            </div>

                        </div>

                        <form id="bloquesform" name="bloquesform" enctype="multipart/form-data" method="post" action="">
                            
                        <input id="numlecciones1" type="hidden" name="numlecciones" value="1">

                        <div id="toprow" style="width: calc(100% - 10px); float:left; padding: 5px;">

                                <input type="text" id="nombrebloque1" name="nombrebloque1" value="" placeholder="Nombre del bloque" style="padding: 10px;  width: calc(30% - 32px); float:left; margin: 5px;background: #afdaff;">

                                <div id="bloqued1" style="background: aliceblue;padding: 10px; font-size: 10px; width: calc(70% - 32px); float:left; margin: 5px;">

                                    <textarea id="cuerpo1" name="cuerpo1" placeholder="Nombre y contenido de la lección" value="" style="width: calc(100% - 6px); resize: none; float: left; margin: 3px;"></textarea>
                                        
                                </div>

                            </div>      
                                            
                        </div>
                        <!--FIN TABLA MOD-->

<?php } else { ?> 
                
                    </div>



 <div id="contenedor" style=" width: calc(100% - 10px); float:left; padding: 5px; position:relative;">

                <div id="titulomateria" style="font-size: 20px; font-weight: bold; margin: 20px 0px; padding: 5px; background: #187ba8;color:white; width: calc(100% - 10px);">
                    Contenido de la materia</div>


                    <div id="tablamod" style="width:100%; float: left; font-weight: bold;">
                        <div id="toprow" style="width:100%;float:left;margin-left: 5px;">
                            <div id="tophead" style="width:30%; float:left; font-weight: bold; margin: 2px;">Bloque</div>
                            <div id="tophead" style="width:50%; float:left; font-weight: bold; margin: 2px;">Leccion</div>
                        </div>
<?php 

        do {

            $nombrebloque = $row_Recordset1['nombrebloque'];
            $numbloque = $row_Recordset1['numbloque'];

?>

                        <div id="toprow" style="width:100%; float:left; padding: 3px;">
                        <div id="bloquei" style="background: #4ecdf4; border: 2px solid #187ba8; height: 100px; width:calc(30% - 10px);float:left; margin: 3px;"><?php echo $nombrebloque; ?></div>

                            <?php

                                $query_Recordset2 = "SELECT * FROM bloques WHERE idcurso = '$idcurso' AND idmateria = '$idmateriaget' AND idmaestro = '$idmaestro' AND numbloque = '$numbloque' ORDER BY numleccion";
                                $Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
                                $row_Recordset2 = mysql_fetch_assoc($Recordset2);
                                $totalRows_Recordset2 = mysql_num_rows($Recordset2); 
                            
                                do {

                                    $leccion = $row_Recordset2['leccion'];

                            ?>
                            <div id="bloqued" style="font-size: 10px; height: 100px; width: calc(70% - 10px); float:right; margin: 3px; border: 2px solid #187ba8; background: #eefaff;">
                                <div id="topdescd" style="width:100%; float: left; margin: 3px;"><?php echo $leccion; ?></div>
                            </div>

<?php
                            }while($row_Recordset2 = mysql_fetch_assoc($Recordset2));
?>

                        </div>
<?php 

        }while($row_Recordset1 = mysql_fetch_assoc($Recordset1));

?>

                    </div>
    
<?php } ?>
         <!---Fin contenedor-->

    </div>               
                

                <div id="contenedorbotones" align="center" style="float: left; width: 100%; margin-top: 50px; margin-bottom: 20px;">
                    
<?php

if ($totalRows_Recordset1 == 0) {

?>
                    <button type="button" onclick="javascript:guardarform();" style="border: solid #595f61 2px; background: #094866c9; border-radius: 5px; width: 100px; font-size: 12px; cursor: pointer; color: white; padding: 10px 0px;">GUARDAR</button>

                    <button type="button" onclick="window.location='cursos.php'" style="border: solid #7e7474 2px; background: #6a6a6ab5;border-radius: 5px; width: 100px; cursor: pointer; font-size: 12px; color: white; padding: 10px 0px; ">CANCELAR</button>

<?php } else { ?>


                    <button type="button" onclick="window.location='cursos.php'" style="border: solid #7e7474 2px; background: #6a6a6ab5;border-radius: 5px; width: 100px; cursor: pointer; font-size: 12px; color: white; padding: 10px 0px; ">REGRESAR</button>

<?php } ?>

                </div>

                </form>

            </div>
            <!--FIN seccion principal-->   

        </div>
  
    <!--FIN Wrapper-->

</body>
</html>
