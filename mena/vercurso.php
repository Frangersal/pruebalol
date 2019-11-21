<?php
session_start();
require_once('../Connections/conamatenlinea.php');

if ($_SESSION['usuario'] == "") {
    
    header("Location: login.php");

}else{

    $usuario = $_SESSION['usuario'];
    $time = time();

}

$id = $_GET["id"];

if ($id == ""){
    header("Location: cursos.php");
}

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM cursos WHERE id = '$id'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

$nombre = $row_Recordset1['nombre'];
$descripcion = $row_Recordset1['descripcion'];
$libros = $row_Recordset1['libros'];
$costo = $row_Recordset1['costo'];
$imagen = $row_Recordset1['imagen'];
$fechainicio = date("d/m/Y", $unixinicio);
$fechafinal = date("d/m/Y", $unixfinal);;

$query_Recordset3 = "SELECT * FROM materiascurso WHERE idcurso = '$id'";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3); 

$query_Recordset4 = "SELECT * FROM libroscurso WHERE idcurso = '$id'";
$Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4); 

if ($permiso == 3) {

header("Location: index.php");
exit;

}
?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar curso</title>


    <!--Librerias-->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>

     <!--Libreria de los iconos-->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">

    
    
    <!--Javascript-->
    <script type="text/javascript">


        $(document).ready(function () {

            $(".menuopen").hide();
            $("#oscuro").hide();
            $("#ventana").hide();

            $('.show_hide').click(function () {
                $(".menuopen").slideToggle("fast");
            });

        });


    </script>
    <!--Fin Javascript-->

    <!--Estilos CSS-->
<style>
    body{
        margin: 0;
        font-family: 'Montserrat', sans-serif;
    }
    .menu{
        font-family: 'Montserrat', sans-serif;
        float:left;
        padding: 10px;
        line-height: 30px;
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
        -webkit-box-shadow: 0 0 20px rgba(0,0,0,.08);
        box-shadow: 0 0 20px rgba(0,0,0,.08);
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
    .progress-bar{
        height: 45px;
        width: 0;
        background-color: #0b2c4d;
        line-height:45px;
    }
    .status{
        top:3px;
        left:0%;
        width:100%;
        text-align:center;
        position:absolute;
        line-height:45px;
        display:inline-block;
        color: #000000;
    }
    .imagencurso{
        width: 100%;
        overflow: hidden;
        float: left;
        padding-bottom: 80%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;

    }

    .card a:link{
        color: black;
    }
    .card a:visited{
        color: black;
    }

    a:link{
        color: white;
        text-decoration: none;
    }
    a:visited{
        color: white;
        text-decoration: none;

    }
    .tip:hover {
        background-color: lightblue; /* Color pendiente */
        cursor: pointer; /* reemplaza el cursor highlighter */
    }
    .delete{
        cursor: pointer;
    }


</style>
    <!--Fin estilos CSS-->

   
    

</head>

<body>

<div id="adminmenu" style="float: left; box-shadow: 0px 0px 10px #000; width: 20%; background-color: #1d4267; position: fixed; height: 100%; overflow: scroll;">

        <div id="logotipo" align="center" style="float: left; width: calc(100% - 60px); padding-top: 50px; padding-bottom: 30px; padding-right: 30px; padding-left: 30px;"><img src="../images/logotipo.png" alt="logotipo" style="width: 100%;"></div>

        <div id="etiquetaadmin" style="font-family: 'Montserrat', sans-serif; float: left; width: calc(80% - 20px); margin-left: 10%; margin-top: 20px; margin-bottom: 50px; text-align: center; padding: 10px; border: 1px solid white; color: white; font-size: 18px; border-radius: 20px;">Menú admin</div>

        <div id="navegacion" style="width: 100%; float: left; margin-bottom: 20px; ">
                    
            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="index.php">Inicio</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>


            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">CONTENIDO PÁGINA</div>


            <a class="menu" href="academicos.php">Académicos</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="quienessomos.php">Quiénes somos</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>


            <a class="menu" href="secciones.php">Secciones</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>


            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">PLATAFORMA EDUCATIVA</div>

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


            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">MENÚ ADMIN</div>

            <a class="menu" href="actividad.php">Actividad</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="usuarios.php">Usuarios</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="logout.php">Salir</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

        </div>

    </div>

        <!--Wraper-->
        <div id="wrapper" style="margin-left:20%;margin-right:10%;width:80%; padding-top: 10px; background:white;">
    
    
            <div id="cuerpocurso" style="width:70%; margin-left: 15%; float:left; margin-bottom:25px;">

            <div id="encabezado">
    
                <div id="titulo" style="font-weight: bold;border-bottom: solid #e1e1e1;width:100%;font-size:28px;float:left;padding: 5px;">
                       <?php echo $nombre; ?> 
                </div>
    
                <div id="fechas" style="width: 100%; margin-top: 20px; float: left; font-family: montserrat">
                    
                         <div id="fechainicio" style="width: 40%; float: left; font-size: 15px; color: #58575d; font-family: 'Open Sans',sans-serif; margin-left: 5px; text-transform: uppercase;">Fecha inicio:<?php echo $fechainicio; ?></div> 
                         <div id="fechafinal" style="width: 40%; float: left; font-size: 15px; color:#58575d; font-family: 'Open Sans',sans-serif; text-transform: uppercase;">Fecha final:<?php echo $fechafinal; ?></div>
    
                         
                </div>
    
            </div>
    
                <div id="leftbar" style="float:left; border:0px; width:50%;">

                    
                    <div id="imagencurso" >

                        <img src="../images/<?php echo $imagen; ?>" alt="" style="width:100%;  margin-top: 30px;float: left;">

                    </div>
        
                    <div id="descripcionnoticia" style="width:100%; float:left; padding:5px; padding-top:25px; color:gray;font-size:16px;">
                    
                        <?php echo $descripcion; ?>

                    </div>

                </div>
        
               <input id="id" name="id" type="hidden" value="1">

               <div id="rightbar" style="margin-left:10px;  float: left; width: calc(50% -10px); "> 

                    <div id="costo" style="width:100%; min-height:50px; float:left">Cost o
                      <?php echo $costo; ?>
                    </div>

                    <div id="materias" style="width:100%; min-height:50px; float:left">

                    <div style="width: 100%; float:left; line-height: 18px;">Materias</div>

                            <?php 

                            if ($totalRows_Recordset3 > 0) {

                            $contador = 1;

                            do{

                                $idmateria = $row_Recordset3['idmateria'];
                                    
                                $query_Recordset5 = "SELECT * FROM materias WHERE id = '$idmateria'";
                                $Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
                                $row_Recordset5 = mysql_fetch_assoc($Recordset5);
                                $totalRows_Recordset5 = mysql_num_rows($Recordset5); 

                                $materia = $row_Recordset5['nombre'];
                                $id = $row_Recordset5['id'];
                            ?>

                                        <div id="materia<?php echo $contador; ?>" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                                            <span style="margin-right:5px;"><?php echo $materia; ?><input id="idmateria<?php echo $contador; ?>" name="idmateria<?php echo $contador; ?>" type="hidden" value="<?php echo $id; ?>"></span>

                                        </div>
                            <?php 
                                $contador++;

                            }while($row_Recordset3 = mysql_fetch_assoc($Recordset3));

                            }

                            ?>


                                    </div>

                    <div id="libros" style="width:100%; min-height:50px; float:left">

                        <div style="width: 100%; float:left; line-height: 18px;">Libros</div>

                            <?php 

                                    if ($totalRows_Recordset4 > 0) {
                                
                                        $contador = 1;

                                        do{

                                            $idlibro = $row_Recordset4['idlibro'];
                                                
                                            $query_Recordset6 = "SELECT * FROM biblioteca WHERE id = '$idlibro'";
                                            $Recordset6 = mysql_query($query_Recordset6, $conamatenlinea) or die(mysql_error());
                                            $row_Recordset6 = mysql_fetch_assoc($Recordset6);
                                            $totalRows_Recordset6 = mysql_num_rows($Recordset6); 

                                            $libro = $row_Recordset6['titulo'];
                                            $id = $row_Recordset6['id'];

                            ?>

                                                    <div id="libro<?php echo $contador; ?>" name="libro<?php echo $contador; ?>" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                                                        <span style="margin-right:5px;"><?php echo $libro; ?><input id="idmateria<?php echo $contador; ?>" name="idmateria<?php echo $contador; ?>" type="hidden" value="<?php echo $id; ?>"></span>

                                                        
                                                    </div>
                            <?php 
                                            $contador++;


                                        }while($row_Recordset4 = mysql_fetch_assoc($Recordset4));

                                    }
                                
                            ?>



                    </div>

               </div>
       
            <a style="width: 100%;float: left;padding-top: 10px; color:blue;" href="cursos.php"> <div style="padding-top:10px;">&lt;---Regresar a cursos </div> </a>
      
        <!--Fin wraper-->

</body>

</html>
