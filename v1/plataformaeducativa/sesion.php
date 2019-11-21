<?php require_once('../Connections/conamatenlinea.php');
session_start();

if ($_SESSION['sesionmaestro'] == "") {

    header("Location: ../index.php");
} else {

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

$idmateriacurso = $_GET['materia'];

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
        function agregartexto() {

            $("#seccionform").append('<textarea id="respuesta" name="respuesta" type="text" value="" placeholder="Ingresa texto" style="font-size: 12px;width: 100%;margin: 10px 0px;box-sizing: border-box;height: 150px;padding: 10px 10px;border: none;background-color: #DDE3EC;color: gray;resize: none;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"> </textarea>');

        }
    </script>

    <script>
        function agregarlibro() {

            var numlibros = parseInt($("#numlibros").val(), 10) + parseInt(1, 10);

            $("#numlibros").val(numlibros);

            $("#contenedorlibros").append('<div id="contenedorlibro' + numlibros + '" style="width:100%; float:left;"><select id="libro' + numlibros + '" name="libro" style="border: solid lightgray; font-size: 12px; width: 50%; margin: 10px; padding: 5px; float: left; font-weight: bold;"><?php if ($totalRows_Recordset5 == 0) { ?><option value="' + numlibros + '">No hay libros</option><?php } else { ?><option value="' + numlibros + '">Elegir un libro</option><?php do {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $id = $row_Recordset5['id'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $titulo = stripslashes(stripslashes($row_Recordset5['titulo'])); ?><option value="<?php echo $id; ?>"><?php echo $titulo; ?></option><?php } while ($row_Recordset5 = mysql_fetch_assoc($Recordset5)); ?><?php } ?></select><div id="eliminarlibro' + numlibros + '" class="boton" type="button" onclick="eliminarlibro(&#39;' + numlibros + '&#39;)" style="font-weight: bold;float: left;line-height: 30px; margin:10px; color: #f66666;cursor: pointer;">Eliminar libro</div></div>');

        }

        function eliminarlibro(id) {

            var numlibros = parseInt($("#numlibros").val());

            $("#contenedorlibro" + id).remove();

            numlibros = numlibros - 1;

            $("#numlibros").val(numlibros);

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

                <div id="contenedorimagenactual" align="center" style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; position: relative; float: left; border: 1px solid #35405263; background-image: url(../images/<?php echo $imagenactual; ?>); background-size: cover; backgro