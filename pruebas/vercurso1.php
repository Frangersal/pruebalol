<?php
session_start();
require_once('../Connections/conamatenlinea.php');

if ($_SESSION['usuario'] == "") {

    header("Location: login.php");
} else {

    $usuario = $_SESSION['usuario'];
    $time = time();
}

$permiso = $row_Recordset2['permiso'];

if ($permiso == 3) {

    header("Location: index.php");
    exit;
}

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

$diainicio = date("d", $unixinicio);
$mesinicio = date("m", $unixinicio);

if ($mesinicio == 1 ){

    $mesinicio = "Enero";

}else if ($mesinicio == 2){

    $mesinicio = "Febrero";

}else if ($mesinicio == 3){

    $mesinicio = "Marzo";

}else if ($mesinicio == 4){

    $mesinicio = "Abril";

}else if ($mesinicio == 5){

    $mesinicio = "Mayo";

}else if ($mesinicio == 6){

    $mesinicio = "Junio";

}else if ($mesinicio == 7){

    $mesinicio = "Julio";

}else if ($mesinicio == 8){

    $mesinicio = "Agosto";

}else if ($mesinicio == 9){

    $mesinicio = "Septiembre";

}else if ($mesinicio == 10){

    $mesinicio = "Octubre";

}else if ($mesinicio == 11){

    $mesinicio = "Noviembre";

}else if ($mesinicio == 12){

    $mesinicio = "Diciembre";
}

$anoinicio = date("Y", $unixinicio);

$diafinal = date("d", $unixfinal);
$mesfinal = date("m", $unixfinal);

if ($mesfinal == 1 ){

    $mesfinal = "Enero";

}else if ($mesfinal == 2){

    $mesfinal = "Febrero";

}else if ($mesfinal == 3){

    $mesfinal = "Marzo";

}else if ($mesfinal == 4){

    $mesfinal = "Abril";

}else if ($mesfinal == 5){

    $mesfinal = "Mayo";

}else if ($mesfinal == 6){

    $mesfinal = "Junio";

}else if ($mesfinal == 7){

    $mesfinal = "Julio";

}else if ($mesfinal == 8){

    $mesfinal = "Agosto";

}else if ($mesfinal == 9){

    $mesfinal = "Septiembre";

}else if ($mesfinal == 10){

    $mesfinal = "Octubre";

}else if ($mesfinal == 11){

    $mesfinal = "Noviembre";

}else if ($mesfinal == 12){

    $mesfinal = "Diciembre";
}

$anofinal = date("Y", $unixfinal);

$fechainicio = $diainicio . " de " . $mesinicio . " del " . $anoinicio;
$fechafinal = $diafinal . " de " . $mesfinal . " del " . $anofinal;

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

function editarmateria( id ){




}

</script>

</head>

<body>

    <div id="adminmenu" style="float: left; box-shadow: 0px 0px 10px #000; width: 20%; background-color: #1d4267; position: fixed; height: 100%; overflow: scroll;">

        <div id="logotipo" align="center" style="float: left; width: calc(100% - 60px); padding-top: 50px; padding-bottom: 30px; padding-right: 30px; padding-left: 30px;">
            <img src="../images/logotipo.png" alt="logotipo" style="width: 100%;"></div>

        <div id="etiquetaadmin" style="font-family: 'Montserrat', sans-serif; float: left; width: calc(80% - 20px); margin-left: 10%; margin-top: 20px; margin-bottom: 50px; text-align: center; padding: 10px; border: 1px solid white; color: white; font-size: 18px; border-radius: 20px;">
            Menú admin</div>

        <div id="navegacion" style="width: 100%; float: left; margin-bottom: 20px; ">

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="index.php">Inicio</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>


            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">
                CONTENIDO PÁGINA</div>


            <a class="menu" href="academicos.php">Académicos</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="quienessomos.php">Quiénes somos</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>


            <a class="menu" href="secciones.php">Secciones</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>


            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">
                PLATAFORMA EDUCATIVA</div>

            <a class="menu" href="alumnos.php">Alumnos</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="ayuda.php">Ayuda</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
            <a class="menu" href="biblioteca.php">Biblioteca</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <div id="link">Cursos</div>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="materias.php">Materias</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="pagos.php">Pagos</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="sesiones.php">Sesiones</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>


            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">
                MENÚ ADMIN</div>

            <a class="menu" href="actividad.php">Actividad</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="usuarios.php">Usuarios</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="logout.php">Salir</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

        </div>

    </div>

    <!--Wraper-->
    <div id="wrapper" style="margin-left:20%; margin-right:10%; width:80%; padding-top: 10px; background:white;">

        <!--Cuerpo curso-->
        <div id="cuerpocurso" style="width: 100%; float:left; margin-bottom:25px;">

            <div id="encabezado">

                <div id="titulo" style="font-weight: bold; border-bottom: solid #e1e1e1; width:100%; font-size:28px; float: left; margin-left: 5%;">
                    <?php echo $nombre; ?>
                </div>

            </div>

            <div id="izquierda" style="padding: 5px; float:left; width: 50%; margin-left: 5%;">

                <div id="imagencurso" style="float: left; width: 50%;">

                    <img src="../images/<?php echo $imagen; ?>" alt="" style="height: 150px; width: 100%; margin: 10px 0px; float: left;">

                </div>

                <div id="descripcioncurso" style="min-height: 50px; margin: 10px 0px; width:100%; float:left; color: #58575d; font-size:16px;">

                    <div id="title" style="">Descripcion</div>

                    <div id="descripcion" style="font-size: 14px;"><?php echo $descripcion; ?>
                    </div>

                </div>

                <a style="width: 20%; float: left; margin: 10px 0px;color:black;" href="cursos.php">
                    <div id="botonregresar" style="line-height: 25px; color: #7FDBFF; cursor: pointer; background-color: #1d4267; font-size: 14px; border-color: #7FDBFF; text-align: center; width: 200px;">&lt; Regresar a cursos </div>
                </a>

            </div>

            <div id="centro" style="padding: 5px; float: left; width: 30%; ">

                <div id="fechas" style="width: 100%; float: left;font-family: montserrat;">

                    <div id="contenedorfechainicio" style="height: 70px; width: 100%; float: left; font-size: 15px; color: #58575d;font-family: 'Open Sans',sans-serif; margin: 10px 0px; text-transform: uppercase;">
                        <div id="title" style="color: green;"> Fecha inicio </div>

                        <div id="fechainicio"><?php echo $fechainicio; ?></div>

                    </div>

                    <div id="fechafinal" style="height: 70px;width: 100%;float: left;font-size: 15px; color:#58575d; font-family: 'Open Sans',sans-serif; text-transform: uppercase; margin: 10px 0px;">
                        <div id="title" style="color:red"> Fecha final </div>

                        <div id="descripcion" style=""><?php echo $fechafinal; ?></div>
                    </div>

                </div>

                <div id="sesiones" style="margin: 10px 0px; width:100%; min-height:50px; float:left; color: #58575d;">

                    <div id="title" style=""> Sesiones </div>

                    <div id="descripcion" style=""> 8</div>
                </div>

                <div id="costo" style="margin: 10px 0px;width: 100%;min-height:50px;float:left;color: #58575d;">
                    <div id="title" style=""> Costo </div>

                    <div id="descripcion" style=""> <?php echo $costo; ?></div>
                </div>


            </div>

            <div id="plandeestudios" style="width: 100%;float: left;background-color: #fff;background-position: center;background-size: cover;height: 100vh;">

                <div id="titulo" align="center" style="float: left; font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: bolder; color: #000; width: 100%; margin-top: 40px; margin-bottom: 40px; letter-spacing: 2px;"> PLAN DE ESTUDIOS</div>

                <div id="contenedormodulos" style="width: calc(100% - 20px); float: left; margin-right: 10px; margin-left: 10px;">

                    <!---Modulo 1-->
<?php 

    $modulo = 1;
    
    do {

        $query_Recordset10 = "SELECT * FROM materiascurso WHERE idcurso = '$idcurso' AND nummodulo = '$modulo'";
        $Recordset10 = mysql_query($query_Recordset10, $conamatenlinea) or die(mysql_error());
        $row_Recordset10 = mysql_fetch_assoc($Recordset10);
        $totalRows_Recordset10 = mysql_num_rows($Recordset10); 

        $nummaterias = $totalRows_Recordset10;
        
?>

                    <div id="modulo" style="width: calc(50% - 35px); float: left; font-family: montserrat; border: 1px solid #ccc; padding: 5px; margin-bottom: 30px; margin-left: 10px; margin-right: 10px;">

                        <div id="titulomodulo" style="float: left; width: 100%; border-bottom: 1px solid lightgray;">

                            <div id="titlemod" style="color: #6698ac; font-weight: bold; font-size: 20px; margin: 5px 0px; width: calc(50% - 10px); padding: 5px; float: left;"> MODULO <?php echo $modulo; ?> </div>

                        </div>

                        <div id="contenido" style="width:100%; float: left;">

                            <div id="cabeceras" style="color: #d30000; width: 96%; float:left; padding: 3px;">

                                <div id="tophead" style="width: calc(40% - 30px); float:left; font-weight: bold; margin: 2px; margin-left: 5px; margin-right: 5px; text-transform: uppercase;">Materia</div>

                                <div id="tophead" style="width: calc(40% - 30px); margin-left: 5px; margin-right: 5px; float:left; font-weight: bold; margin: 2px; text-transform: uppercase;"> Maestro</div>

                            </div>

                        </div>

                        <div id="materias<?php echo $modulo; ?>" style="width: 100%; float: left;">
                        
                    <?php

                        $materiaactual = 0;

                        do {
                                
                            $materiaactual = $materiaactual + 1;

                            $idmateria = $row_Recordset10['idmateria'];
                            $idmaestro = $row_Recordset10['idmaestro'];

                            $query_Recordset8 = "SELECT * FROM maestros WHERE id = '$idmaestro'";
                            $Recordset8 = mysql_query($query_Recordset8, $conamatenlinea) or die(mysql_error());
                            $row_Recordset8 = mysql_fetch_assoc($Recordset8);
                            $totalRows_Recordset8 = mysql_num_rows($Recordset8); 

                            $nombremaestro = $row_Recordset8['nombre'];

                            $query_Recordset9 = "SELECT * FROM materias WHERE id = '$idmateria'";
                            $Recordset9 = mysql_query($query_Recordset9, $conamatenlinea) or die(mysql_error());
                            $row_Recordset9 = mysql_fetch_assoc($Recordset9);
                            $totalRows_Recordset9 = mysql_num_rows($Recordset9); 

                            $nombremateria = $row_Recordset9['nombre'];


                    ?>

                                    <div id="materia-maestro" style="width: calc(100% - 10px); float: left; margin: 5px;">

                                        <div id="materia<?php echo $materiaactual; ?>" style="width: calc(33% - 20px); float:left; font-weight: bold; margin: 10px; line-height: 25px;"><?php echo $nombremateria ?></div>
                                
                                        <div id="maestro<?php echo $materiaactual; ?>" style="width: calc(33% - 20px); float:left; font-weight: bold; margin: 10px; line-height: 25px;"><?php echo $nombremaestro ?></div>

                                        <div id="contieneeditar" style="float: left; width: calc(33% - 20px); margin:10px; text-align:center;">

                                        <div id="eliminar" class="seleccionado" onclick="eliminarmateria(<?php echo $idmateria; ?>)" style="float: right; font-size: 13px; font-weight: bolder; cursor: pointer; letter-spacing: 1.5px; color: white; background: #9ea6ae; border-radius: 3px; margin: 1px; padding: 2px; width: calc(50% - 6px); text-align: center;">Eliminar</div>

                                            <div id="editar" class="seleccionado" onclick="editarmateria(<?php echo $idmateria; ?>);" style="text-align: center; float: left; font-size: 13px; font-weight: bolder; cursor: pointer; letter-spacing: 1.5px; color: white; background: #9ea6ae; border-radius: 3px; margin: 1px; padding: 2px; width: calc(50% - 6px);">Editar</div>
                
                                        </div>

                                    </div>
        <?php
                $row_Recordset10 = mysql_fetch_assoc($Recordset10);

             }while($materiaactual < $nummaterias); ?>
 
                                        <div id="contienebotones" align="center" style="float:left; width:100%; font-family: montserrat; display:none;">
                                            
                                            <button id="botoncancelar" type="button" onclick="javascript:('');" style=" border: solid #7e7474 2px; background: #6a6a6ab5;border-radius: 5px; width: 100px; cursor: pointer; font-size: 12px; color: white; padding: 10px 0px; ">CANCELAR</button>

                                            <button id="botonguardar" type="button" onclick="javascript:('');" style=" border: solid #595f61 2px; background: #094866c9; border-radius: 5px; width: 100px; font-size: 12px; cursor: pointer; color: white; padding: 10px 0px; ">GUARDAR</button>

                                        </div>
                        
                        </div>

                    </div>

<?php
        $modulo = $modulo + 1;

    } while($modulo <= $nummodulos); 

?>

                </div>

            </div>

        </div>
        <!--Fin cuerpo curso-->

    </div>
    <!--Fin wraper-->

</body>

</html>
