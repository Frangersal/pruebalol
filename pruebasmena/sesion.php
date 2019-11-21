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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

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

        .agregarrespuesta:hover {
            color: green;
        }

        .quitarrespuesta:hover {
            color: red;

        }

        .agregarespacio:hover{
            color:#4ca1e57d!important;
        }

        .quitarespacio:hover{
            color:#ef71688a!important;
        }

        .completarfrase:hover{
            color:#5076957d!important;
        }

        .quitarcompletar:hover{
            color:#b257508a!important;
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

        /*  function valida_envia() {

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
        */
    </script>

    <script type="text/javascript">

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
        
        $(document).ready(function() {

            $('[name="contenidolibro"]').change(function() {

                var contenidolibro = this.value;

                if (contenidolibro == "si") {

                    $("#libro").selectedIndex = "0";

                    $("#numeropagina").value = "";

                    $("#contenedorbiblioteca").show();

                } else {

                    $("#contenedorbiblioteca").hide();

                }

            });

        });
    </script>

    <script type="text/javascript">

        function agregarpregunta() {

            var numpreguntas = parseInt($("#numpreguntas").val()) + 1;

            $("#numpreguntas").val(numpreguntas);

            $('#opcionmultiple').append('<div id="contenedorpregunta' + numpreguntas + '" style="display: block; font-size: 12px; float:left; width:100%; border-bottom: 1px solid lightgray"> <div id="contienepregunta' + numpreguntas + '" style="display:block; font-size:12px; margin:10px; float:left; width:calc(70% - 20px)"> ' + numpreguntas + ' <input type="text" placeholder="Escribe una pregunta" style="border: 2px solid lightgray; width: calc(90% - 20px); height: 40px; padding: 10px;"> <div id="respuestas' + numpreguntas + '" style="float: left; width: 100%; margin-bottom: 20px;"></div></div> <div id="contenedorbotones' + numpreguntas + '" style="margin:10px; float:right; width:calc(20% - 20px);"> <div type="button" id="agregarrespuesta'+numpreguntas+'" class="agregarrespuesta" onclick="agregarrespuesta(' + numpreguntas + ')" style="display: block; font-weight: bold; padding: 5px; cursor: pointer; width: calc(100% - 10px); float: left; font-size: 15px;  margin: 5px 0px; overflow: hidden;"> <i class="fas fa-plus-circle" style="font-size:20px; float:left;"></i> Agregar respuesta </div> <div type="button" id="quitarrespuesta'+numpreguntas+'" class="quitarrespuesta" onclick="quitarrespuesta(' + numpreguntas + ')" style="display: block; font-weight: bold; padding: 5px; cursor: pointer; width: calc(100% - 10px); float: left; font-size: 15px;  margin: 5px 0px;  overflow: hidden;"> <i class="fas fa-minus-circle" style="font-size:20px; float:left;"></i> Quitar respuesta </div> </div> <input id="numrespuestas' + numpreguntas + '" type="hidden" value="1"> </div>');

        }

        function agregarrespuesta(preguntaactual) {

            var numrespuestas = parseInt($("#numrespuestas" + preguntaactual).val()) + 1;

            $("#numrespuestas" + preguntaactual).val(numrespuestas);

            $("#respuestas" + preguntaactual).append(' <div id="contienerespuesta'+numrespuestas+'" style="float: left; width: 25%;" > <div style="float: left; margin-right: 2px; margin-top: 10px;">' + numrespuestas + '</div><input id="respuesta' + numrespuestas + '" type="text" placeholder="respuesta" style="float: left; margin-top: 10px; width: calc(100% - 14px); border: 2px solid lightgray; padding: 5px;"> </div>');



        }

        function eliminarpregunta() {

            var numpreguntas = parseInt($("#numpreguntas").val());

                $('#contenedorpregunta'+ numpreguntas).remove();

                numpreguntas = numpreguntas - 1 ;

                $("#numpreguntas").val(numpreguntas);

                if (numpreguntas == 1) {
                    $("#eliminarpregunta").hide();
                }

        }

        function quitarrespuesta(numpreguntas) {

           var numrespuestas = parseInt($("#numrespuestas"+numpreguntas).val());

            $('#contienerespuesta'+numrespuestas).remove();

            numrespuestas = numrespuestas - 1;

            $("#numrespuestas"+numpreguntas).val(numrespuestas);

            if (numrespuestas == 1) {
                $("#botoneliminar"+numpreguntas).hide();
            }

        }
    </script>

    <script type="text/javascript">

        function agregarfrase() {

            var numfrases = parseInt($("#numfrases").val()) + 1;

            $("#numfrases").val(numfrases);

            $('#contenedorfrasesglobal').append('<div id="contenedorfrase'+numfrases+'" style="width:100%; float:left; border-bottom:1px solid lightgray;"><div id="contienefrase" style="width: 70%; float: left;margin: 20px 0px; line-height: 40px;"> <input type="text" id="frase'+numfrases+'" placeholder="Escribe la frase '+numfrases+'" style="border: 2px solid gray; width: calc(100% - 28px); height: 40px; padding: 10px; margin: 2px ;"> <input type="text" id="espacio'+numfrases+'" name="espacio'+numfrases+'" placeholder=" Respuesta oculta de la frase'+numfrases+'" style="border: 2px solid lightgray; width: calc(100% - 28px); height: 40px; padding: 10px; margin: 2px ;">    <input type="text" id="complemento'+numfrases+'" name="complemento'+numfrases+'" placeholder="Completa la frase'+numfrases+'" style="border:2px solid gray; width: calc(100% - 28px); height: 40px; padding: 10px; margin: 2px ;"> </div> <div id="botonesfrase" style="width: calc(20% - 20px); text-align: center; float: right; margin: 10px;"> <div id="agregarespacio'+numfrases+'" class="agregarespacio" onclick="agregarespacio();" style="font-weight: bold; padding: 5px;  cursor: pointer; width: calc(100% - 10px); font-size: 14px;  overflow: hidden; text-align: center; float: right; margin: 5px 0px; line-height: 15px;"><i class="fas fa-plus-circle" style="font-size:20px; float:left;"></i>Agregar espacio  </div> <div id="quitarespacio'+numfrases+'" class="quitarespacio" onclick="quitarespacio();" style="font-weight: bold; padding: 5px; cursor: pointer; width: calc(100% - 10px); font-size: 14px; overflow: hidden; text-align: center; float: right; margin: 5px 0px; line-height: 15px;"><i class="fas fa-minus-circle" style="font-size:20px; float:left;"></i>Quitar espacio</div> <div id="completarfrase'+numfrases+'" class="completarfrase" onclick="completarfrase();" style=" font-weight: bold; padding: 5px; cursor: pointer; width: calc(100% - 10px);  font-size: 14px; overflow: hidden; text-align: center; float: right; margin: 5px 0px; line-height: 15px;"><i class="fas fa-plus-circle" style="font-size:20px; float:left;"></i>Completar frase</div> <div id="quitarcompletar'+numfrases+'" class="quitarcompletar" onclick="quitarcompletar();" style=" font-weight: bold; padding: 5px;  cursor: pointer;  width: calc(100% - 10px);  font-size: 14px;  overflow: hidden; text-align: center; float: right; margin: 5px 0px; line-height: 15px;"><i class="fas fa-minus-circle" style="font-size:20px; float:left;"></i>Quitar complemento</div> </div>');

        }

        function quitarfrase() {
            
            var numfrases = parseInt($("#numfrases").val());

                $('#contenedorfrase'+ numfrases).remove();

                numfrases = numfrases - 1 ;

                $("#numfrases").val(numfrases);

        }

        function agregarespacio() {

            var numespacios = parseInt($("#numespacios").val()) + 1;

            $("#numespacios").val(numespacios);

            $('#contienefrase').append('<input type="text" id="espacio' + numespacios +'" name="espacio'+ numespacios +'"  placeholder="Escribe una respuesta oculta" style="border: 2px solid lightgray; width: calc(20% - 8px); margin:2px; height: 40px; font-size: 10px; text-align: center;">');
        }

        function eliminarespacio() {
            
        }

        function completarfrase() {

            var numcompletar = parseInt($("#numcompletar").val()) + 1;

            $("#numcompletar").val(numcompletar);

            $('#contienefrase').append('<input type="text" id="complemento' + numcompletar +'" name="complemento'+ numcompletar +'"  placeholder="Completa la frase" style="border: 2px solid gray; width: calc(30% - 8px); margin:2px; height: 40px; font-size: 10px; text-align:center; ">');

        }

        function quitarcompletar() {
            
        }


    </script>

    <script type="text/javascript">

        function generarpalabras() {
            
           var numeropalabras = $('#palabras').val();

            for (let i = 1; i <= numeropalabras; i++) {

                $('#contienepalabrasgeneradas').append('<div id="contenedorpalabra'+i+'" style="width:85%; padding-left:15%;  float:left; "><input type="text" name="palabragenerada'+i+'" id="palabragenerada'+i+'" placeholder="Escribe la plabara '+i+'" style="border: 2px solid lightgray; width: Calc(70% - 24px); height: 40px; padding: 10px; margin: 10px 0px; float:left;"> <div id="eliminarpalabra" onclick="eliminarpalabra();" style="color: a51717; cursor: pointer; float: left; font-size: 20px;"> <i class="fas fa-minus-circle"></i> </div> </div>');
                
            }

        }

        function eliminarpalabra(i) {

            var numeropalabras = parseInt($("#palabras").val());

            $("#contenedorpalabra"+numeropalabras).remove();

            numeropalabras = numeropalabras - 1;

            $("#palabras").val(numeropalabras);


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

            <div id="contenedor" style="width: calc(100% - 5%);float:left;padding: 20px 2.5%;position: relative;">

                <div id="titulosesion" style="font-size:25px; letter-spacing:1.5px; color:steelblue; font-weight:bold; text-align:center; width:100%; float:left; margin-bottom: 20px;  ">SESIÓN N</div>

                <div id="bloquessesion" style="border-radius: 5px;font-size: 14px;letter-spacing: 1.5px;text-align: center;width: calc(100% - 4px);float: left;margin-bottom: 20px;border: 2px solid #5fbde3;padding: 10px 0px;">

                    <div id="instruccion" style="calc(100% - 20px);  margin:10px; 0px;">
                        Selecciona los bloques de la sesión
                    </div>

                    <div id="contienebloques" align="center" style="padding: 0px 5%; font-weight: bold; font-size: 15px; width: calc(100% - 10%); float: left; margin: 2px 0px;">

                        <?php

                        $contador = 1;

                        do { ?>

                            <div id="bloquenombre">

                                <input id="bloque<?php echo $contador; ?>" type="checkbox" value="<?php echo $contador; ?>" name="bloque<?php echo $contador; ?>"> <label for="bloque<?php echo $contador; ?>" style="">Bloque <?php echo $contador; ?></label>

                            </div>
                            <?php

                            $contador = $contador + 1;
                        } while ($contador <= $numbloques); ?>





                    </div>

                </div>

                <div id="contenedorsesion" style="border-radius: 5px;width: calc(100% - 4px);float: right;border: 2px solid lightblue;">

                    <div id="seccion-form" align="center" style="width:100%; background-color: white; float: left;">

                        <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data">

                            <input id="id" name="id" value="1" type="hidden">

                            <div id="instruccion" style="margin: 10px 0px;">Introducción de la sesión</div>

                            <textarea id="respuesta" name="respuesta" type="text" value="" placeholder="Ingresa texto" style="font-size: 12px; width: 90%; box-sizing: border-box; height: 350px; padding: 10px 10px; background-color: whitesmoke; color: black; resize: none; border: 2px solid #e3e2e2;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"> </textarea>

                            <a href="javascript:void();" onclick="javascript:document.getElementById('foto0').click();">
                                <div id="botonfile" align="center" style="border-radius: 5px; margin: 20px 40%; border: 2px solid #3f6b97; background-color: #437fb0; color: white; padding: 5px; cursor:pointer; width: calc(20% - 12px); float: left;">

                                    <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; background-color: #437fb0; height:0px; display:block;">

                                    <div style="font-size:12px;">Agregar imágenes</div>

                                    <input type="file" id="foto0" name="foto0" onchange="javascript:enviar('0');" style="display: none;" accept="image/jpeg">

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

                                } while ($row_Recordset6 = mysql_fetch_assoc($Recordset6));
                            }

                            ?>

                            </select>

                            <div id="contienepagina" style=" font-weight: bold; font-size: 14px; color: #bc3737; float: left; line-height: 40px; margin: 10px; cursor: pointer;">

                                <label for="numeropagina" style="float:left; margin: 0px 5px;">página</label>
                                <input type="number" name="numeropagina" id="numeropagina" style="padding:4px; border:2px solid lightgray; float:left; width: 60px; border-radius:5px; line-height: 17px; margin-top:4px; text-align:center">
                            </div>

                        </div>

                    </div>

                </div>

                <div id="contieneagregaractividad" align="center" style="width: 100%; float: left; margin-top:30px;">

                    <div id="agregaractividad" onclick="agregaractividad()" style="text-align: center; width: calc(20% - 4px);  cursor: pointer; color: green;  font-weight: bold; border: 2px solid green; height: 30px; line-height: 30px; border-radius: 5px; margin: 0px 15%; margin-bottom: 10px; overflow:hidden;">Agregar actividad</div>

                </div>

                <div id="ventanaemergente" align="center" style="border: 2px solid rgb(150, 192, 171); width: calc(100% - 14px); float: right; padding: 5px; background: white; display:none; ">

                    <form id="formsesion" action="" enctype="multipart/form-data" method="post" onsubmit="return(valida_envia())">

                        <div id="cerrar" onclick="cerrar()" style="color:red; font-weight: bold; float:right; cursor:pointer">X</div>

                        <div style="margin-top: 10px;font-weight: bold;"> Selecciona el tipo de actividad</div>

                        <select name="actividades" id="actividades" style="border: 2px solid lightgray; font-size: 12px; width: 50%; margin: 10px 25%; padding: 5px; float: left; font-weight: bold; background: whitesmoke; border-radius: 5px; height: 40px;">
                            <option value="">Actvidad</option>
                            <option value="">Crucigrama</option>
                            <option value="">Sopa de letras</option>
                            <option value="">Preguntas abiertas</option>
                            <option value="">Opcion multiple</option>
                            <option value="">Completa la frase</option>
                            <option value="">Verdadero-falso</option>
                        </select>
                        <div id="contenedorboton" align="center" style="float: left;width: 100%;margin: 20px 0px;">
                            <button type="button" onclick="mostraractividad()" style="margin: 0px 10px; border-radius: 5px; padding: 5px 10px; background-color: #6ba1b0; font-size: 14px; border-color: #5c757c; color: white;cursor: pointer;">Siguiente</button>
                        </div>

                        <div id="seccionactividad" align="center" style="border-radius: 5px;border: 1px solid #127a35; width: calc(100% - 14px); float: left; padding: 5px; background: #faf9f9; display:none;">

                            <div style="font-size: 20px; margin: 5px 0px; font-weight: bold;">Nueva actividad</div>

                            <div style="margin-top: 10px; font-size: 15px; margin: 2px 0px;">Indicaciones</div>

                            <textarea name="indicaciones" id="indicaciones" cols="30" rows="10" value="" style="border: 1px solid rgb(172, 172, 172); margin: 0px; width: 100%; height: 105px;"></textarea>

                            <div id="opcionmultiple" style="border:2px solid #0096885e; margin:10px 0px;  float:left; width:calc(100% - 4px);">

                                <div id="etiqueta" style="font-size:20px; font-weight:bold; margin:5px 0px;">Opción multiple</div>

                                <div id="botonespregunta" align="center" style="width:100%; float:left;">

                                    <input id="numpreguntas" type="hidden" value="1">

                                    <button type="button" onclick="agregarpregunta()" style="border-radius: 5px;  margin: 10px 0px; border: 2px solid #0096889c;background-color: #0096889c; color: white; font-weight: bold; padding: 5px; cursor: pointer; ">Agregar pregunta</button>

                                    <button type="button" onclick="eliminarpregunta()" style="border-radius: 5px; margin: 10px 0px; border: 2px solid #a95458; background-color: #ce666b; color: white; font-weight: bold; padding: 5px; cursor: pointer;">Eliminar pregunta</button>


                                </div>

                            </div>

                            <div id="completalafrase" style="border:2px solid #0095ff40; margin:10px 0px; float:left; width:calc(100% - 4px);">

                                <div id="etiqueta" style="font-size:20px; font-weight:bold; margin:5px 0px;">Completa la frase</div>

                                <div id="contienebotones" align="center" style="width: 40%; float: left; margin: 10px 0px; padding-left: 30%; padding-right: 30%;">

                                    <div id="agregarfrase" onclick="agregarfrase();" style="border-radius: 5px; border: 2px solid #2196f399; background-color: #2196f399; color: white; width: calc(50% - 24px); font-size: 14px; overflow: hidden; text-align: center; font-weight: bold; padding: 5px; cursor: pointer; margin: 0px 5px;  float: left; ">Agregar frase </div>

                                    <div id="quitarfrase" onclick="quitarfrase();" style="border-radius: 5px; border: 2px solid #72001099; background-color: #a100009c; color: white; width: calc(50% - 24px); font-size:14px; overflow: hidden; text-align: center; font-weight:bold; padding: 5px; cursor: pointer; margin:0px 5px; float: left;">Quitar frase</div>

                                    <input type="hidden" id="numfrases" name="numfrases" value="1">

                                    <input type="hidden" id="numespacios" name="numfrases" value="1">

                                </div>

                                <div id="contenedorfrasesglobal" align="center" style="width:100%; float:left;">

                                  <div id="contenedorfrase" style="width:100%; float:left; border-bottom:1px solid lightgray;">

                                    <div id="contienefrase" style="width: 70%; float: left; margin: 20px 0px; line-height: 40px;">

                                        <input type="text" id="frase" placeholder="Escribe una frase" style="border: 2px solid gray; width: calc(100% - 28px); height: 40px; padding: 10px; margin: 2px ;">

                                        <input type="text" id="espacio" name="espacio" placeholder=" Respuesta oculta" style="border: 2px solid lightgray;     width: calc(100% - 28px); height: 40px; padding: 10px; margin: 2px;">

                                        <input type="text" id="complemento" name="espacio" placeholder="Completa la frase" style="border: 2px solid gray; width: calc(100% - 28px); height: 40px; padding: 10px;  margin: 2px;">

                                    </div>

                                    <div id="botonesfrase"  style="width: calc(20% - 20px); text-align: center; float: right; margin: 10px;">

                                        <div id="agregarespacio" class="agregarespacio" onclick="agregarespacio();" style="font-weight: bold; padding: 5px;  cursor: pointer; width: calc(100% - 10px); font-size: 14px;  overflow: hidden; text-align: center; float: right; margin: 5px 0px; line-height: 15px;"><i class="fas fa-plus-circle" style="font-size:20px; float:left;"></i>Agregar espacio  </div>
                                        
                                        <div id="quitarespacio" class="quitarespacio" onclick="quitarespacio();" style="font-weight: bold; padding: 5px; cursor: pointer; width: calc(100% - 10px); font-size: 14px; overflow: hidden; text-align: center; float: right; margin: 5px 0px; line-height: 15px;"><i class="fas fa-minus-circle" style="font-size:20px; float:left;"></i>Quitar espacio</div>
                                        
                                        <div id="completarfrase" class="completarfrase" onclick="completarfrase();" style=" font-weight: bold; padding: 5px; cursor: pointer; width: calc(100% - 10px);  font-size: 14px; overflow: hidden; text-align: center; float: right; margin: 5px 0px; line-height: 15px;"><i class="fas fa-plus-circle" style="font-size:20px; float:left;"></i>Completar frase</div>
                                        
                                        <div id="quitarcompletar" class="quitarcompletar" onclick="quitarcompletar();" style=" font-weight: bold; padding: 5px;  cursor: pointer;  width: calc(100% - 10px);  font-size: 14px;  overflow: hidden; text-align: center; float: right; margin: 5px 0px; line-height: 15px;"><i class="fas fa-minus-circle" style="font-size:20px; float:left;"></i>Quitar complemento</div>

                                    </div>

                                  </div>

                                </div>

                            </div>

                            <div id="sopadeletras" style="border:2px solid #e4cbcb; margin:10px 0px; float:left; width:calc(100% - 4px);">

                                <div id="etiqueta" style="font-size:20px; font-weight:bold; margin:5px 0px;">Sopa de letras</div>

                                <div id="words" align="center" style="width:100%; margin:10px 0px;">

                                    <div>numero de palabras</div>

                                    <input type="hidden" name="numpalabras" id="numpalabras" value="1">

                                    <input type="number" name="palabras" id="palabras" style=" border: 2px solid lightgray; width: 20%; height: 40px; margin: 10px 40%; padding: 0px 15px; font-size: 15px; text-align:center;">

                                    <div id="contieneboton" align="center" style="width:100%; float:left; ">

                                    <button type="button" onclick="generarpalabras();" style="display: block; border-radius: 5px; margin: 10px 0px; border: 2px solid #cc9d9d; background-color: #cc9e9eba; color: white; padding: 5px;cursor: pointer; font-weight: bold; width:20%;">Generar</button>

                                    </div>

                                    <div id="contienepalabrasgeneradas" style="width:100%; float:left;">

                                    </div>

                                </div>

                            </div>

                            <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 30px; margin-bottom: 20px;">
                                <button type="submit" onclick="location.href='sesion1.php'" style="margin: 0px 10px; border-radius: 7px; padding: 5px 10px; background-color: #4e8493; font-size: 14px; border-color: #496168; color: white; cursor: pointer;">Guardar actividad</button>
                            </div>

                        </div>

                    </form>

                </div>

                <div id="contieneactividades" style="width: calc(100% - 20px); padding:10px; float: left;">

                    <div id="etiqueta" style="margin-bottom: 10px; font-size: 25px; text-align: center;width: 100%; float: left;color: #799ea9; font-weight: bold;">Actividades</div>

                    <div id="etiqueta" style="margin:5px 0px; width: 100%; float: left; color: #a19a9a; font-weight: bold; margin: 5px 0px;">Actividad 1 - Aprendiendo el verbo to be</div>

                    <div id="etiqueta" style="margin:5px 0px; width: 100%; float: left; color: #a19a9a; font-weight: bold; margin: 5px 0px;">Actividad 2 - Jugando a ser profesor</div>

                    <div id="etiqueta" style="margin:5px 0px; width: 100%; float: left; color: #a19a9a; font-weight: bold; margin: 5px 0px;">Actividad 3 - Primera conversacion y canciones</div>

                </div>

            </div>

            <div id="contenedorboton" align="center" style="float: left; width: 100%; margin: 40px 0px;">
                <button type="button" onclick="guardarform(); " style="border-radius: 5px;line-height: 30px;background-color: #1d4267;border-color: #1d4267;padding: 0px 20px;color: white;cursor: pointer;font-weight: bold;font-size: 12px;border-style: none;">GUARDAR CAMBIOS</button>
                <button type="button" onclick="window.location.href='sesiones.php'" style="border-radius: 5px;line-height: 30px;background-color: #7f8081;border-color: #7f8081;padding: 0px 20px;color: white;cursor: pointer;font-size: 12px;font-weight: bold;border-style: none;">REGRESAR</button>
            </div>


        </div>

    </div>

    </div>
    <!--FIN Wrapper-->

</body>

</html>