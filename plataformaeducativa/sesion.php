<?php require_once('../Connections/conamatenlinea.php');
session_start();

if ($_SESSION['sesionmaestro'] == "") {

    header("Location: ../index.php");
} else {

    $maestro = $_SESSION['sesionmaestro'];
    $time = time();
}
//Necesaria para la imagen y nombre del maestro

$idmateriacurso = $_GET['materia'];
$idcurso = $_GET['id'];
$nummodulo = $_GET['nummodulo'];
$sesion = $_GET['s'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset11 = "SELECT * FROM maestros WHERE usuario = '$maestro'";
$Recordset11 = mysql_query($query_Recordset11, $conamatenlinea) or die(mysql_error());
$row_Recordset11 = mysql_fetch_assoc($Recordset11);
$totalRows_Recordset11 = mysql_num_rows($Recordset11);

$idmaestro = $row_Recordset11['id'];
$imagenactual = $row_Recordset11['imagen'];
$nombre = $row_Recordset11['nombre'];

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

$query_Recordset6 = "SELECT * FROM libroscurso WHERE idmateriacurso = '$idmateriacurso' ORDER BY idlibro ASC";
$Recordset6 = mysql_query($query_Recordset6, $conamatenlinea) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);

$query_Recordset1 = "SELECT * FROM bloques WHERE idcurso = '$idcurso' AND idmateria = '$idmateria' AND idmaestro = '$idmaestro' AND nummodulo = '$nummodulo' GROUP BY numbloque ORDER BY numbloque";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$numbloques = $totalRows_Recordset1;

?>
<html lang="en">

<head>

    <!---Librerias-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    </link>

    <title>Sesion</title>

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

        .tophead:hover {
            text-decoration: underline;
        }

        #subtema {
            font-size: 22px;
            font-weight: bold;
            margin: 10px 0px;
            padding: 5px;
            width: calc(100% - 10px);
            color: #187ba8;

        }

        #sesion {
            font-size: 16px;
            margin: 10px 0px;
            padding: 5px;
            text-align: justify;
            font-weight: bold;
            color: #187ba8;
        }

        #porcentaje {
            font-size: 16px;
            margin: 10px 0px;
            padding: 5px;
            text-align: justify;
            font-weight: bold;
        }

        #estatus {
            font-size: 16px;
            margin: 10px 0px;
            padding: 5px;
            text-align: justify;
            font-weight: bold;
        }

        #agregaractividad:hover {
            background: green;
            color: white !important;
        }

        #sesion:hover {
            background: lightblue;
            cursor: pointer
        }

        #bloquenombre {
            width: calc(20% - 40px);
            margin: 5px 20px;
            float: left;
        }
    </style>

    <script type="text/javascript">
        function agregaractividad() {
            $('#ventanaemergente').show();
        }

        function cerrar() {
            $('#ventanaemergente').hide();
        }

        function mostraractividad() {
            $('#seccionactividad').show();
        }

        function valida_envia() {

            if ($("#indicaciones").val() == '') {
                alert("Especifica las indicaciones de la actividad");
                $("#indicaciones").focus();
                return false;
            }

            var radios = document.getElementsByName("bloque");
            var formValid = false;

            var i = 0;
            while (!formValid && i < radios.length) {
                if (radios[i].checked) formValid = true;
                i++;
            }

            if (!formValid) alert("Selecciona un bloque");
            return false;
        }

    </script>

<script>

$( document ).ready(function() {

    $('[name="contenidolibro"]').change(function() {

        var contenidolibro = this.value;

        if ( contenidolibro == "si" ) {

             $("#libro").selectedIndex = "0";

             $("#numeropagina").value = "";

             $("#contenedorbiblioteca").show();
        
        } else {

             $("#contenedorbiblioteca").hide();
        
        }

    });

});

    </script>
<script>

function guardarform() {

    var numbloques = $("#numbloques").val();
    
    for (var i = 1; i <= numbloques; i++) {

        if ($("#bloque" + i).prop("checked")) { 
        
         //   alert("Seleccionaste el bloque " + $("#bloque" + i).val());

        }
    
    }

    var introsesion = $("#introsesion").val();

    var contenidolibro = $("#contenidolibro").prop("checked");

    var imagenes = document.getElementById("foto0");

    alert(imagenes.files.items(1).name);
    alert(imagenes.files.items(2).name);

}

</script>
</head>
<body>

    <!--Wrapper-->
    <div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

        <!--Menu del admin-->
        <div id="seccionmenu" style="width: 20%; background-color: #354052; position: fixed; top: 0; left: 0; z-index: 999; height: 100%; box-shadow: 0px 0px 10px #000;">

            <a href="/plataformaeducativa/">
                <div id="logotipoplataforma" align="center" style="float: left; width: calc(70%); margin-top: 30px; margin-bottom: 30px; margin-left: 15%; margin-right: 15%;">
                    <img src="../images/logoplataformaeducativa.png?id=<?php echo $unixtime; ?>" alt="logotipo" style="width: 100%; opacity: 0.8; float: left;">
                </div>
            </a>

            <?php if ($imagenactual == "") { ?>

                <div id="contenedorimagenactual" align="center" style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; float: left; border: 1px solid #35405263; background-image: url(../images/iconavatar.png); background-size: cover; background-position: center;">

                </div>

            <?php } else if ($imagenactual != "") { ?>

                <div id="contenedorimagenactual" align="center" style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; position: relative; float: left; border: 1px solid #35405263; background-image: url(../images/<?php echo $imagenactual; ?>); background-size: cover; background-position: center;">

                </div>

            <?php } ?>

            <div id="nombre" align="center" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #abb4c1; width: 90%; letter-spacing: 0.5px; line-height: 20px; padding: 10px;">
                <?php echo $nombre . " " . $apellidopaterno . " " . $apellidomaterno; ?>
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

                            <div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Configuración</div>

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
        <!--FIN menu admin-->


        <div id="seccionprinpal" style="width:80%; margin-left: 20%; float: left; background: white; ">

            <div id="contenedor" style="width: calc(100% - 20%);float:left;padding: 20px 10%;position: relative;">

                <div id="titulosesion" style="font-size:25px; letter-spacing:1.5px; color:steelblue; font-weight:bold; text-align:center; width:100%; float:left; margin-bottom: 20px;  ">SESIÓN N</div>

                <div id="bloquessesion" style="border-radius: 5px;font-size: 14px;letter-spacing: 1.5px;text-align: center;width: calc(100% - 4px);float: left;margin-bottom: 20px;border: 2px solid #5fbde3;padding: 10px 0px;">

                    <div id="instruccion" style="calc(100% - 20px);  margin:10px; 0px;">
                        Selecciona los bloques de la sesión
                    </div>

                    <div id="contienebloques" align="center" style="padding: 0px 5%; font-weight: bold; font-size: 15px; width: calc(100% - 10%); float: left; margin: 2px 0px;">

<?php if ($numbloques > 0) { ?>

                    <input id="numbloques" value="<?php echo $numbloques; ?>" type="hidden">

             <?php

                    $contador = 1;

                    do { ?>

                        <div id="bloquenombre">

                            <input id="bloque<?php echo $contador; ?>" type="checkbox" value="<?php echo $contador; ?>" name="bloque<?php echo $contador; ?>"> <label for="bloque<?php echo $contador; ?>" style="">Bloque <?php echo $contador; ?></label>

                        </div>
                <?php

                        $contador = $contador + 1;

                    }while($contador <= $numbloques); ?>

<?php } else { ?>

                        <div id="error">No hay bloques.</div>

<?php } ?>

                    </div>

                </div>

                <div id="contenedorsesion" style="border-radius: 5px;width: calc(100% - 4px);float: right;border: 2px solid lightblue;">

                    <div id="seccion-form" align="center" style="width:100%; background-color: white; float: left;">

                        <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data">

                            <input id="id" name="id" value="" type="hidden">

                            <div id="instruccion" style="margin: 10px 0px;">Introducción de la sesión</div>

                            <textarea id="introsesion" name="introsesion" type="text" value="" placeholder="Ingresa texto" style="font-size: 12px; width: 90%; box-sizing: border-box; height: 350px; padding: 10px 10px; background-color: whitesmoke; color: black; resize: none; border: 2px solid #e3e2e2;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"> </textarea>

                            <a href="javascript:void(0);" onclick="javascript:document.getElementById('foto0').click();">
                                <div id="botonfile" align="center" style="border-radius: 5px; margin: 20px 40%; border: 2px solid #3f6b97; background-color: #437fb0; color: white; padding: 5px; cursor:pointer; width: calc(20% - 12px); float: left;">

                                    <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; background-color: #437fb0; height:0px; display:block;">

                                    <div style="font-size:12px;">Agregar imágenes</div>

                                    <input type="file" id="foto0" name="foto0" multiple style="display: none;" accept="image/jpeg">

                                </div>

                            </a>

                        </form>

                    </div>

                </div>

                <div id="respuestacheck" style="padding: 0px 5%;width: calc(100% - 10%);float: left;margin-bottom: 10px;margin-top: 30px;">

                    <div id="instruccion" style="float:left; width:70%;">Agregar contenido del libro</div>

                    <div id="cheks" style="float:left; width:25%;">

                        <input type="radio" name="contenidolibro" value="si" id="contenidolibro">
                        <label for="si">si</label>

                        <input type="radio" name="contenidolibro" value="no" checked id="contenidolibro">
                        <label for="no">no</label>

                    </div>

                </div>

                <div id="contenedorbiblioteca" align="center" style="border: 2px solid #007e8b;float: left;display: none;width: calc(100% - 4px);">

                    <div id="contenedorlibros" style="width: calc(100% - 20px); float: left; margin: 10px;">

                        <div id="contienelibro" style="width:70%;float:left;padding:0px 15%;display: flex;">

                            <select id="libro" name="libro" style="border: 2px solid lightgray;font-size: 12px;flex: 1;margin: 10px;padding: 5px;float: left;font-weight: bold;background: whitesmoke;border-radius: 5px;height: 40px;">


                                <option value="">No hay libros</option>

                                <?php


                                if ($totalRows_Recordset6 > 0) {

                                    do {

                                        $idlibro = $row_Recordset6['idlibro'];
                                
                                        $query_Recordset5 = "SELECT * FROM biblioteca WHERE id = '$idlibro'";
                                        $Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
                                        $row_Recordset5 = mysql_fetch_assoc($Recordset5);
                                        $totalRows_Recordset5 = mysql_num_rows($Recordset5);

                                        $id = $row_Recordset5['id'];
                                        $titulo = $row_Recordset5['titulo'];
                                ?>

                                    <option value="<?php echo $id; ?>"><?php echo $titulo; ?></option>

                                <?php

                                    } while($row_Recordset6 = mysql_fetch_assoc($Recordset6));

                                }

                                ?>

                            </select>

                            <div id="contienepagina" style=" font-weight: bold; font-size: 14px; color: #bc3737; float: left; line-height: 40px; margin: 10px; cursor: pointer;">

                                <label for="numeropagina" style="float:left; margin: 0px 5px;">página</label>
                                <input type="number" name="numeropagina" id="numeropagina" style="padding:4px; border:2px solid lightgray; float:left; width: 60px; border-radius:5px; line-height: 17px; margin-top:4px;">
                            </div>

                        </div>

                    </div>

                </div>

                <div id="contieneagregaractividad" style="width: 100%; float: left; margin-top:30px;">

                    <div id="agregaractividad" onclick="agregaractividad()" style="text-align: center; width: calc(20% - 4px); float: right; cursor: pointer; color: green;  font-weight: bold; border: 2px solid green; height: 30px; line-height: 30px; border-radius: 5px; margin: 0px 15%; margin-bottom: 10px;">Agregar actividad</div>

                </div>

                <div id="ventanaemergente" align="center" style="border: 2px solid rgb(150, 192, 171); width: calc(50% - 14px); float: right; padding: 5px; background: white; display:none; ">

                    <form id="formsesion" action="" enctype="multipart/form-data" method="post" onsubmit="return(valida_envia())">

                        <div id="cerrar" onclick="cerrar()" style="color:red; font-weight: bold; float:right; cursor:pointer">X</div>
                        <div style="margin-top: 10px;font-weight: bold;"> Selecciona el tipo de actividad</div>
                        <select name="actividades" id="actividades" style="border: 2px solid lightgray; font-size: 12px; width: 50%; margin: 10px 25%; padding: 5px; float: left; font-weight: bold; background: whitesmoke; border-radius: 5px; height: 40px;">
                            <option value="">Actvidad</option>
                            <option value="">Crucigrama</option>
                            <option value="">Sopa de letras</option>
                            <option value="">Preguntas abiertas</option>
                            <option value="">Opcion multiple</option>
                            <option value="">Acompleta la frase</option>
                            <option value="">Verdadero-falso</option>
                        </select>
                        <div id="contenedorboton" align="center" style="float: left;width: 100%;margin: 20px 0px;">
                            <button type="button" onclick="mostraractividad()" style="margin: 0px 10px; border-radius: 5px; padding: 5px 10px; background-color: #6ba1b0; font-size: 14px; border-color: #5c757c; color: white;cursor: pointer;">Siguiente</button>
                        </div>

                        <div id="seccionactividad" align="center" style="border-radius: 5px;border: 1px solid #127a35; width: calc(100% - 14px); float: left; padding: 5px; background: #faf9f9; display:none;">

                            <div style="font-size: 20px; margin: 5px 0px; font-weight: bold;">Nueva actividad</div>

                            <div style="margin-top: 10px; font-size: 15px; margin: 2px 0px;">Indicaciones</div>

                            <textarea name="indicaciones" id="indicaciones" cols="30" rows="10" value="" style="border: 1px solid rgb(172, 172, 172); margin: 0px; width: 100%; height: 105px;"></textarea>

                            <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 30px; margin-bottom: 20px;">
                                <button type="submit" onclick="location.href='sesion1.php'" style="margin: 0px 10px; border-radius: 7px; padding: 5px 10px; background-color: #4e8493; font-size: 14px; border-color: #496168; color: white; cursor: pointer;">Guardar actividad</button>
                            </div>

                        </div>

                    </form>

                </div>

                <div id="contieneactividades" style="width: calc(49% - 20px); padding:10px; float: left;">

                    <div id="etiqueta" style="margin-bottom: 10px; font-size: 25px; text-align: center;width: 100%; float: left;color: #799ea9; font-weight: bold;">Actividades</div>

                    <div id="etiqueta" style="margin:5px 0px; width: 100%; float: left; color: #a19a9a; font-weight: bold; margin: 5px 0px;">Actividad 1 - Aprendiendo el verbo to be</div>

                    <div id="etiqueta" style="margin:5px 0px; width: 100%; float: left; color: #a19a9a; font-weight: bold; margin: 5px 0px;">Actividad 2 - Jugando a ser profesor</div>

                    <div id="etiqueta" style="margin:5px 0px; width: 100%; float: left; color: #a19a9a; font-weight: bold; margin: 5px 0px;">Actividad 3 - Primera conversacion y canciones</div>

                </div>

            </div>

            <div id="contenedorboton" align="center" style="float: left; width: 100%; margin: 40px 0px;">
                <button type="button" onclick="guardarform();" style="border-radius: 5px;line-height: 30px;background-color: #1d4267;border-color: #1d4267;padding: 0px 20px;color: white;cursor: pointer;font-weight: bold;font-size: 12px;border-style: none;">GUARDAR CAMBIOS</button>

                <button type="button" onclick="window.location.href='sesiones.php?id=<?php echo $idcurso; ?>&materia=<?php echo $idmateriacurso; ?>'" style="border-radius: 5px;line-height: 30px;background-color: #7f8081;border-color: #7f8081;padding: 0px 20px;color: white;cursor: pointer;font-size: 12px;font-weight: bold;border-style: none;">REGRESAR</button>
            </div>


        </div>

    </div>

    </div>
    <!--FIN Wrapper-->

</body>

</html>
