<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Conamat en línea | Admin  | Modulos</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

    <!--Estilos CSS-->
    <style>
        body {
            margin: 0;
            background-color: #0b2c4d;
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

        s .card {
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
    </style>
    <!--Fin estilos CSS-->

<!--Javascript-->
<script type="text/javascript">

function valida_envia() {

    if ($("#materia1").val() == '') {

    alert("Porfavor especifica una materia del curso");
    $("#materia1").focus();
    return false;
    }

    if ($("#maestro1").val() == '') {

    alert("Porfavor especifica un maestro para el curso");
    $("#maestro1").focus();
    return false;
    }

    if ($("#grupo").val() == '') {

    alert("Porfavor especifica un grupo para el curso");
    $("#grupo").focus();
    return false;
    }

    $("#modulosform").submit();
    
}


    $(document).ready(function(){

    $('#agregarmodulo').click(function() {

    var nummodulos = parseInt($("#nummodulos").val()) + 1;

    $("#nummodulos").val(nummodulos);
     
    $('#contienemodulos').append('<div id="contenedormodulo'+nummodulos+'" style="width: 70%; float: left; margin-bottom: 10px; margin-left: 15%; margin-right: 15%;"> <div id="modulo'+nummodulos+'" name="contenedormodulo" style="font-size: 12px;  width: calc(100% - 22px); padding: 10px; float: left; border: 1px solid lightgray;"> <div id="nombremod" style="width:100%; float: left; font-size: 14px; text-transform: uppercase; font-weight: bold;">  Módulo '+nummodulos+' </div> <div id="contenedorbotones" align="center" style="padding: 0px 20px; margin: 20px 20px; float: left; width: calc(100% - 80px);"> <button id="botonagregar'+nummodulos+'" type="button" onclick="javascript:agregarmateria('+nummodulos+');" style="border-radius: 7px;float: left;margin: 5px 15%;padding: 5px 15px;background-color: #23a11b;font-size: 14px;border-color: #028401eb;color: #e4ffe7;cursor: pointer;width: 150px;">Agregar materia</button> <button id="botoneliminar'+nummodulos+'" type="button" onclick="javascript:eliminarmateria('+nummodulos+');" style="border-radius: 7px; float: left; margin: 5px 40px; padding: 5px 15px; background-color: #d70707; font-size: 14px; border-color: #b80a0a; color: #f8e6e6; cursor: pointer; width: 150px; height: 30px; display:none;">Eliminar materia</button> </div> <div id="materias'+nummodulos+'"> <input type="hidden" id="nummaterias'+nummodulos+'" name="nunmaterias'+nummodulos+'" value="'+1+'"> <div id="contenedormateria" style="width: 100%;float: left;margin: 15px 0px;">  <select id="materia" name="materia" value="" style="font-size: 12px; width: calc(48% - 5px); margin-top: 10px; margin-bottom: 10px; box-sizing: border-box; padding: 10px 10px; border: 1px solid #d0d5de; background-color: whitesmoke; color: gray; float: left;">Materias <option value="">Selecciona una materia</option>  <!--?php if($totalRows_Recordset14 --> 0) do { $idmateria = $row_Recordset14["id"]; $materia = $row_Recordset14["nombre"];      ?&gt;<option value=""> <!--?php echo $materia; ?--> </option> <!--?php } while ($row_Recordset14 = mysql_fetch_assoc($Recordset14)); ?--> </select> <div id="lineaunion" style="width: 25px; border: 1px solid #c1c3c7; float: left; margin-top: 26px;"> </div><select id="maestro1 " name="maestro1" value="" style="font-size: 12px; width: calc(48% - 5px); margin: 10px 0;box-sizing: border-box; padding: 10px 10px; border: 1px solid #d0d5de; background-color: whitesmoke; color: gray;float: left;">Maestros <option value="">Selecciona un maestro</option> <!--?php if($totalRows_Recordset13 --> 0)do { $idmaestro = $row_Recordset13["id"];  $maestro = $row_Recordset13["nombre"];      ?&gt;<option value=""> <!--?php echo $maestro; ?--> </option> <!--?php } while ($row_Recordset13 = mysql_fetch_assoc($Recordset13)); ?--> </select> </div> </div> <!--Contenedor grupos-->  <div id="contenedorgrupos" style="width: calc(100% - 6px);float:left;margin-top: 20px;margin-bottom: 19px;"> <div id="grupos" style="text-align: center; width: 100%; float: left; margin-bottom: 3px;">GRUPOS </div> <div id="grupo1" style="height: 60px; float: left; width: 14%; border-radius: 5px; margin-left: 20px;"> <input id="grupo" name="grupo" value="" type="text" style="text-align: center; width: 50%; margin:20px 25px;float: left; border: 5px solid lightgray;"> </div> <div id="grupo2" style="height: 60px; float: left; width: 15%; border-radius: 5px;"> <input type="text" style="border: 5px solid lightgray; text-align: center; width: 50%; margin:20px 25px; float: left;"> </div> <div id="grupo3" style="height: 60px; float: left; width: 14%; border-radius: 5px;"> <input type="text" style="border: 5px solid lightgray; text-align: center; width: 50%; margin:20px 25px; float: left;"> </div>  <div id="grupo4" style="height: 60px; float: left; width: 14%; border-radius: 5px;"> <input type="text" style="text-align: center; width: 50%; margin:20px 25px; float: left; border: 5px solid lightgray;">  </div> <div id="grupo5" style="height: 60px; float: left; width: 14%; border-radius: 5px;"> <input type="text" style="border: 5px solid lightgray; text-align: center; width: 50%; margin:20px 25px; float: left;"> </div> <div id="grupo6" style="height: 60px; float: left; width: 14%; border-radius: 5px;"> <input type="text" style="text-align: center; width: 50%; margin:20px 25px; float: left; border: 5px solid lightgray;"> </div> </div> <!--Fin contenedor grupos-->  </div> </div>');

    if (nummodulos > 1) {
        $('#eliminarmodulo').show();
    }

});  

$('#eliminarmodulo').click(function() {

    var nummodulos = parseInt($("#nummodulos").val());

    $('#contenedormodulo'+nummodulos).remove();

    nummodulos = nummodulos - 1 ;

    $("#nummodulos").val(nummodulos);

    if (nummodulos == 1) {
        $("#eliminarmodulo").hide();
    }
            
});


});  

function agregarmateria(nummodulos) {

var nummaterias = parseInt($("#nummaterias"+nummodulos).val()) + 1;

$("#nummaterias"+nummodulos).val(nummaterias);

$('#materias' + nummodulos).append('<div id="contenedormateria'+ nummaterias +'" style="width: 100%;float: left; margin:15px 0px"> <select id="materia'+ nummaterias +'" name="materia'+ nummaterias +'" value="" style="font-size: 12px;width: calc(48% - 5px); margin-top: 10px; margin-bottom: 10px; box-sizing: border-box;padding: 10px 10px; border: 1px solid #d0d5de; background-color: whitesmoke; color: gray; float: left;">Materias<option value="">Selecciona una materia</option></select><div id="lineaunion" style="width: 25px; border: 1px solid #c1c3c7; float: left; margin-top: 26px;"></div><select id="maestro'+ nummaterias +'" name="maestro'+ nummaterias +'" value="" style="font-size: 12px; width: calc(48% - 5px);margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: 1px solid #d0d5de;background-color: whitesmoke;color: gray;float: left;">Maestros<option value="">Selecciona un maestro</option></select></div>');

if (nummaterias > 1) {
$("#botoneliminar"+nummodulos).show();
}

}

function eliminarmateria(nummodulos) {

nummaterias = parseInt($("#nummaterias"+nummodulos).val());

$('#contenedormateria'+nummaterias).remove();

nummaterias = nummaterias - 1;

$("#nummaterias"+nummodulos).val(nummaterias);

if (nummaterias == 1) {
$("#botoneliminar"+nummodulos).hide();
}

}
</script>
<!--Fin Javascript-->


</head>
<body>

<div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

        <!--Menu Admin-->
        <div id="adminmenu"
            style="float: left; box-shadow: 0px 0px 10px #000; width: 20%; background-color: #1d4267; position: fixed; overflow: scroll;">

            <div id="logotipo" align="center"
                style="float: left; width: calc(100% - 60px); padding-top: 50px; padding-bottom: 30px; padding-right: 30px; padding-left: 30px;">
                <img src="../images/logotipo.png" alt="logotipo" style="width: 100%;"></div>

            <div id="etiquetaadmin"
                style="font-family: 'Montserrat', sans-serif; float: left; width: calc(80% - 20px); margin-left: 10%; margin-top: 20px; margin-bottom: 50px; text-align: center; padding: 10px; border: 1px solid white; color: white; font-size: 18px; border-radius: 20px;">
                Menú admin</div>

            <div id="navegacion" style="width: 100%; float: left; margin-bottom: 20px; ">

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <a class="menu" href="index.php">Inicio</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <?php

                if ($permiso == 1) {

                    ?>

                <div id="tituloseccion" align="center"
                    style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">
                    CONTENIDO PÁGINA</div>

                <?php

            }

            if ($permiso == 2 || $permiso == 1) {

                ?>

                <a class="menu" href="academicos.php">Académicos</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <a class="menu" href="quienessomos.php">Quiénes somos</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>


                <a class="menu" href="secciones.php">Secciones</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <?php

            }

            if ($permiso == 3 || $permiso == 1) {

                ?>
                
                <div id="tituloseccion" align="center"
                    style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">
                    PLATAFORMA EDUCATIVA</div>

                <a class="menu" href="alumnos.php">Alumnos</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <a class="menu" href="ayuda.php">Ayuda</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
                <a class="menu" href="biblioteca.php">Biblioteca</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <div id="link">Cursos</div>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <a class="menu" href="maestros.php">Maestros</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <a class="menu" href="materias.php">Materias</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <a class="menu" href="pagos.php">Pagos</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <a class="menu" href="sesiones.php">Sesiones</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <?php

            }

            if ($permiso == 1) {

                ?>

                <div id="tituloseccion" align="center"
                    style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">
                    MENÚ ADMIN</div>

                <a class="menu" href="actividad.php">Actividad</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <a class="menu" href="usuarios.php">Usuarios</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <?php

            }

            ?>
                <a class="menu" href="logout.php">Salir</a>

                <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            </div>

        </div>

   
        <!--FIN Menu Admin-->
    <div id="seccionprincipal" style="float: left;width: calc(80% - 20px);position: relative;margin-left: 20%;background: white;padding: 10px;">

     <div id="titulocurso" align="center" style="font-size: 25px; line-height: 60px; float: left; width: 100%; font-weight: bold;">Modulos materia</div>


     <div id="contieneboton" style="width: 100%;float:left;margin: 15px 0px;" align="center">
            <button id="agregarmodulo" style="margin: 0px 5px;border-radius: 7px; padding: 5px 15px; background-color: #0576a9; font-size: 14px;border-color: #2196F3; color: #ffffff;cursor: pointer; text-transform: uppercase;">Agregar módulo</button>
            <button id="eliminarmodulo" style="margin: 0px 5px;border-radius: 7px; padding: 5px 15px; background-color: #9E9E9E; font-size: 14px; border-color: #bcbcbc; color: #fffafa; cursor: pointer; text-transform: uppercase; display: none;">Eliminar módulo</button>
     </div>

     <!-- Modulos -->
     <input type="hidden" name="nummodulos" id="nummodulos" value="1">

     <div id="contienemodulos" style="width:100%; float:left; " align="center">

        <div id="contenedormodulo" style="width: 70%;float: left;margin-bottom: 10px;margin-left: 15%;margin-right: 15%;">

            <div id="modulo" name="contenedormcodulo" style="font-size: 12px;width: calc(100% - 22px);padding: 10px;float: left;border: 1px solid lightgray;">

                <div id="nombremod" style="width:100%; float: left; font-size: 14px; text-transform: uppercase; font-weight: bold;">
                    Módulo 1
                </div>

                <div id="contenedorbotones" align="center" style="padding: 0px 20px; margin: 20px 20px; float: left; width: calc(100% - 80px);">

                    <button id="botonagregar" type="button" onclick="agregarmateria('');" style="border-radius: 7px;float: left;margin: 5px 15%;padding: 5px 15px;background-color: #23a11b;font-size: 14px;border-color: #028401eb;color: #e4ffe7;cursor: pointer;width: 140px;">Agregar materia</button>

                    <button id="botoneliminar" type="button" onclick="javascript:eliminarmateria('');" style="border-radius: 7px;float: left;margin: 5px 15%;padding: 5px 15px;background-color: #d70707;font-size: 14px;border-color: #b80a0a;color: #f8e6e6;cursor: pointer;width: 140px; display: none;">Eliminar materia</button>
                </div>

                <form id="modulosform" name="modulosform" action="" enctype="multipart/form-data" method="post" onsubmit="return(valida_envia())">

                <div id="materias">

                    <input type="hidden" id="nummaterias" name="nunmaterias" value="1">

                    <div id="contenedormateria" style="width: 100%;float: left;margin: 15px 0px;">

                        <select id="materia1" name="materia1" value="" style="font-size: 12px;width: calc(50% - 14px);margin-top: 10px;margin-bottom: 10px;box-sizing: border-box;padding: 10px 10px;border: 1px solid #d0d5de;background-color: whitesmoke;color: gray;float: left;">Materias

                            <option value="">Selecciona una materia</option>

                            <!--?php if($totalRows_Recordset14 --> 0) do {

                            $idmateria = $row_Recordset14['id'];
                            $materia = $row_Recordset14['nombre'];

                            ?&gt;<option value="">
                                <!--?php echo $materia; ?-->
                            </option>
                            <!--?php
                                } while ($row_Recordset14 = mysql_fetch_assoc($Recordset14)); ?-->

                        </select>

                        <div id="lineaunion" style="width: 25px; border: 1px solid #c1c3c7; float: left; margin-top: 26px;">
                        </div>

                        <select id="maestro1 " name="maestro1" value="" style="font-size: 12px;width: calc(50% - 14px);margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: 1px solid #d0d5de;background-color: whitesmoke;color: gray;float: left;">Maestros

                            <option value="">Selecciona un maestro</option>

                            <!--?php if($totalRows_Recordset13 --> 0)do {

                            $idmaestro = $row_Recordset13['id'];
                            $maestro = $row_Recordset13['nombre'];

                            ?&gt;<option value="">
                                <!--?php echo $maestro; ?-->
                            </option>
                            <!--?php
                                } while ($row_Recordset13 = mysql_fetch_assoc($Recordset13)); ?-->

                        </select>

                    </div>
                    
                </div>     

                <!--Contenedor grupos-->
                <div id="contenedorgrupos" style="width: 100%;float:left;margin-top: 20px;margin-bottom: 19px;">

                    <div id="grupos" style="text-align: center; width: 100%; float: left; margin-bottom: 3px;">GRUPOS </div>

                    <div id="grupo1" style="height: 60px;float: left;width: 14%;border-radius: 5px;margin-left: 20px;">

                        <input id="grupo" name="grupo" value="" type="text" style="text-align: center; width: 50%; margin:20px 25px;float: left; border: 5px solid lightgray;">

                    </div>

                    <div id="grupo2" style="height: 60px; float: left; width: 15%; border-radius: 5px;">

                        <input type="text" style="border: 5px solid lightgray; text-align: center; width: 50%; margin:20px 25px; float: left;">

                    </div>

                    <div id="grupo3" style="height: 60px;float: left;width: 15%;border-radius: 5px;">

                        <input type="text" style="border: 5px solid lightgray; text-align: center; width: 50%; margin:20px 25px; float: left;">

                    </div>

                    <div id="grupo4" style="height: 60px;float: left;width: 15%;border-radius: 5px;">

                        <input type="text" style="text-align: center; width: 50%; margin:20px 25px; float: left; border: 5px solid lightgray;">

                    </div>

                    <div id="grupo5" style="height: 60px;float: left;width: 15%;border-radius: 5px;">

                        <input type="text" style="border: 5px solid lightgray; text-align: center; width: 50%; margin:20px 25px; float: left;">

                    </div>

                    <div id="grupo6" style="margin-right: 20px;height: 60px;float: left;width: 15%;border-radius: 5px;">

                        <input type="text" style="text-align: center; width: 50%; margin:20px 25px; float: left; border: 5px solid lightgray;">

                    </div>

                </div>
                <!--Fin contenedor grupos-->

                </form>

            </div>

        </div>

    </div>
    <!--FIN  Modulos -->

    <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 50px; margin-bottom: 20px;">
        <button type="button" onclick="location.href='materias1.php'" style="margin: 0px 10px; border-radius: 7px; padding: 10px 15px; background-color: #8b8f93; font-size: 14px; border-color: #c1d4db; color: #fcfcfc; cursor: pointer;">REGRESAR</button>
        <button type="submit" onclick="location.href='bloques.php'" style="margin: 0px 10px; border-radius: 7px; padding: 10px 15px;background-color: #1d4267; font-size: 14px; border-color: #7FDBFF; color: #7FDBFF; cursor: pointer;">SIGUIENTE</button>
    </div>
        
</div>

</div>


</body>
</html>

