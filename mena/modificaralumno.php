<?php require_once('../Connections/conamatenlinea.php');

session_start();
$usuario = $_SESSION['usuario'];
$error = "";
date_default_timezone_set('America/Mexico_City');
$unixtime = time();

if ($usuario == "") {

    header("Location: index.php");
    exit;

}

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$permiso = $row_Recordset1['permiso'];

if ($permiso == 2) {

    header("Location: alumno.php");
    exit;

}

if ($_POST) {

    $nombre = addslashes(addslashes(trim($_POST['nombre'])));
    $idalumno = addslashes(addslashes(trim($_POST['idalumno'])));
    $apellidopaterno = addslashes(addslashes(trim($_POST['apellidopaterno'])));
    $apellidomaterno =addslashes(addslashes(trim($_POST['apellidomaterno'])));
    $sexo =$_POST['sexo'];
    $dia =$_POST['dia'];
    $mes =$_POST['mes'];
    $ano =$_POST['ano'];
    $matricula =addslashes(addslashes(trim($_POST['matricula'])));
    $curp = addslashes(addslashes(trim($_POST['curp'])));
    $pais = $_POST['pais'];
    $estado = $_POST['estado'];
    $municipio = addslashes(addslashes(trim($_POST['municipio'])));
    $colonia =addslashes(addslashes(trim($_POST['colonia'])));
    $calle = addslashes(addslashes(trim($_POST['calle'])));
    $codigopostal = addslashes(addslashes(trim($_POST['codigopostal'])));
    $telefono = addslashes(addslashes(trim($_POST['telefono'])));
    $correo = addslashes(addslashes(trim($_POST['correo'])));
    $contrasena = addslashes(addslashes(trim($_POST['contrasena'])));
    $curso = addslashes(addslashes(trim($_POST['curso'])));

    mysql_select_db($database_conamatenlinea, $conamatenlinea);

    mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Modificó un alumno', '$unixtime')");

    mysql_query("UPDATE alumnos SET matricula = '$matricula', nombrealumno = '$nombre', correo = '$correo',
    contrasena = '$contrasena', estadoalumno = '$estadoalumno', apellidomaterno = '$apellidomaterno', apellidopaterno = '$apellidopaterno', 
    sexo = '$sexo', curp = '$curp', pais = '$pais', estado = '$estado', municipio = '$municipio', colonia = '$colonia', calle = '$calle', 
    codigopostal = '$codigopostal', telefono = '$telefono', 
    curso = '$curso', dia ='$dia', mes = '$mes', ano ='$ano' WHERE id = '$idalumno'");

    header("Location: alumnos.php");


}//Fin del POST


$id = $_GET['id'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM alumnos WHERE id = '$id'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);


$nombre = stripslashes(stripslashes($row_Recordset2['nombrealumno']));
$apellidopaterno = stripslashes(stripslashes($row_Recordset2['apellidopaterno']));
$apellidomaterno = stripslashes(stripslashes($row_Recordset2['apellidomaterno']));
$sexo = $row_Recordset2['sexo'];
$dia = $row_Recordset2['dia'];
$mes = $row_Recordset2['mes'];
$ano = $row_Recordset2['año'];
$matricula = stripslashes(stripslashes($row_Recordset2['matricula']));
$curp = stripslashes(stripslashes($row_Recordset2['curp']));
$pais = $row_Recordset2['pais'];
$estado = $row_Recordset2['estado'];
$municipio = stripslashes(stripslashes($row_Recordset2['municipio']));
$colonia = stripslashes(stripslashes($row_Recordset2['colonia']));
$calle = stripslashes(stripslashes($row_Recordset2['calle']));
$codigopostal = stripslashes(stripslashes($row_Recordset2['codigopostal']));
$telefono = stripslashes(stripslashes($row_Recordset2['telefono']));
$correo = stripslashes(stripslashes($row_Recordset2['correo']));
$contrasena = stripslashes(stripslashes($row_Recordset2['contrasena']));
$curso = stripslashes(stripslashes($row_Recordset2['curso']));


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>modificaralumno</title>

    <!--Librerias-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <!--Estilos CSS-->
<style>

    body{
        margin: 0;
        background-color: #0b2c4d;
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
        background-color: white;
        padding: 30px 60px;
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
    .imagenmaestro{
        width: 100%;
        padding-bottom: 100%;
        overflow: hidden;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        border-radius: 50%;
        background-image: url("../images/iconusuario.png");
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


</style>
    <!--FIN Estilos CSS-->



<!--Javascript-->

<script type="text/javascript">

        function validaenvia(){

            var nombre = $("#nombrealumno");
            var apellidop = $("#apellidopaterno");
            var apellidom = $("#apellidomaterno");
            var correo = $("#correo");
            var contrasena = $("contrasena");
        
            if (nombre.val() == "") {
                
                alert("Introduce un nombre");
                nombre.focus();
                return false;
            
            } else if (apellidop.val() == "") {

                alert("Introduce el primer apellido del alumno");
                apellidop.focus();
                return false;

            } else if (apellidom.val() == "") {

                alert("Introduce el segundo apellido del alumno");
                apellidom.focus();
                return false;

            }else if (correo.val() == "") {

                alert("Introduce un correo");
                correo.focus();
                return false;

            }else if (contrasena.val() == "") {

                alert("Introduce el primer apellido del alumno");
                cotnrasena.focus();
                return false;
                }
            else{

                $("#formalumno").submit();
            }
        }

    </script>

<!--Fin Javascript-->
</head>

<body>
    
 <div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

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

            <div id="link">Alumnos</div>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="ayuda.php">Ayuda</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
            <a class="menu" href="biblioteca.php">Biblioteca</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="cursos.php">Cursos</a>

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

    <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">

    <a href="Javascript:void(0)" onclick="nuevo()"></a>

    <div id="seccion-form" style="width: 100%; float: left;  background-color: white; box-sizing: border-box; padding: 30px; border: 1px solid rgb(51, 51, 51); box-shadow: rgba(0, 0, 0, 0.08) 0px 0px 20px;">

        <div id="titulo" style="width: 100%; margin-bottom: 40px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Modificar alumno</div>

        
        <form id="formalumno" name="formalumno" action="modificaralumno.php" method="post" onsubmit="return(validaenvia())" enctype="multipart/form-data">

            

            <div id="nombrecompleto" style="width:100%;background: white;">

                <div id="etiquetas" style="width: 100%;font-size: 13px;text-align: center;float: left;background: white;">

                    <div style="width: 33%;text-align:left;font-family:montserrat;float: left;">Nombre</div>

                    <div style="width: 33%;text-align:left;float:left;font-family:montserrat;">Apellido Paterno</div>

                    <div style="width: 31%;text-align:left;float:left;font-family:montserrat;">Apellido Materno</div>

                </div>

                <div id="inputs" style="width:100%;float: left;background: white;">

                    <input id="nombrealumno " name="nombre" type="text" value="<?php echo $nombre; ?>" style="font-size: 12px;width: calc(33.3333% - 30px);margin: 10px 0;padding: 10px 10px;float: left;margin-right: 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                    <input id="apellidopaterno" name="apellidopaterno" type="text" value="<?php echo $apellidopaterno; ?>" style="font-size: 12px;width: calc(33.3333% - 30px);margin: 10px 0;float: left;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;margin-right: 10px;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                    <input id="apellidomaterno" name="apellidomaterno" type="text" value="<?php echo $apellidomaterno; ?>" style="font-size: 12px;width: calc(33.3333% - 20px);margin: 10px 0;float: left;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                </div>

            </div>

                 <input id="idalumno" name="idalumno" type="hidden" value="<?php echo $id; ?>">


            <div id="genero" name="genero" value="1" style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                Sexo
                <div id="opciones" style=" font-family: arial; margin-top: 10px; font-size: 14px;">
                    <input id="masculino" type="radio" name="sexo" style="margin-left: 20px;"  value="<?php echo $sexo; ?>">Masculino
                    <input id="femenino" type="radio" name="sexo" style="margin-left: 40px;"  value="<?php echo $sexo; ?>">Femenino
                </div>
            </div>

            <div id="" name="" type="text" value="" style="font-size: 12px; float:left;width: calc(100% - 40px);padding: 10px 20px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                <div id="etiqueta" style="float: left; width: 100%; line-height: 20px;">Fecha de nacimiento</div>
                <div id="dia" align="left" style="width: 220px;float:left;height:25px;padding-left:10px;line-height:25px;margin-top:10px;margin-left:10px;"><select id="dia" name="dia" style="font-family: montserrat;float: left;height: 20px;">
                        <option value="">Día</option>
                        <option value="1<?php if ($dia == "1") { echo "selected"; } ?>">01</option>
                        <option value="2<?php if ($dia == "2") { echo "selected"; } ?>">02</option>
                        <option value="3<?php if ($dia == "3") { echo "selected"; } ?>">03</option>
                        <option value="4<?php if ($dia == "4") { echo "selected"; } ?>">04</option>
                        <option value="5<?php if ($dia == "5") { echo "selected"; } ?>">05</option>
                        <option value="6<?php if ($dia == "6") { echo "selected"; } ?>">06</option>
                        <option value="7<?php if ($dia == "7") { echo "selected"; } ?>">07</option>
                        <option value="8<?php if ($dia == "8") { echo "selected"; } ?>">08</option>
                        <option value="9<?php if ($dia == "9") { echo "selected"; } ?>">09</option>
                        <option value="10<?php if ($dia == "10") { echo "selected"; } ?>">10</option>
                        <option value="11<?php if ($dia == "11") { echo "selected"; } ?>">11</option>
                        <option value="12<?php if ($dia == "12") { echo "selected"; } ?>">12</option>
                        <option value="13<?php if ($dia == "13") { echo "selected"; } ?>">13</option>
                        <option value="14<?php if ($dia == "14") { echo "selected"; } ?>">14</option>
                        <option value="15<?php if ($dia == "15") { echo "selected"; } ?>">15</option>
                        <option value="16<?php if ($dia == "16") { echo "selected"; } ?>">16</option>
                        <option value="17<?php if ($dia == "17") { echo "selected"; } ?>">17</option>
                        <option value="18<?php if ($dia == "18") { echo "selected"; } ?>">18</option>
                        <option value="19<?php if ($dia == "19") { echo "selected"; } ?>">19</option>
                        <option value="20<?php if ($dia == "20") { echo "selected"; } ?>">20</option>
                        <option value="21<?php if ($dia == "21") { echo "selected"; } ?>">21</option>
                        <option value="22<?php if ($dia == "22") { echo "selected"; } ?>">22</option>
                        <option value="23<?php if ($dia == "23") { echo "selected"; } ?>">23</option>
                        <option value="24<?php if ($dia == "24") { echo "selected"; } ?>">24</option>
                        <option value="25<?php if ($dia == "25") { echo "selected"; } ?>">25</option>
                        <option value="26<?php if ($dia == "26") { echo "selected"; } ?>">26</option>
                        <option value="27<?php if ($dia == "27") { echo "selected"; } ?>">27</option>
                        <option value="28<?php if ($dia == "28") { echo "selected"; } ?>">28</option>
                        <option value="29<?php if ($dia == "29") { echo "selected"; } ?>">29</option>
                        <option value="30<?php if ($dia == "30") { echo "selected"; } ?>">30</option>
                        <option value="31<?php if ($dia == "31") { echo "selected"; } ?>">31</option>
                    </select>

                    <select id="mes" name="mes" style="font-family: montserrat;float:left;margin-left:5px; height: 20px;" class="className">
                        <option value="">Mes</option>
                        <option value="01<?php if ($mes == "1") { echo "selected"; } ?>">Enero</option>
                        <option value="02<?php if ($mes == "2") { echo "selected"; } ?>">Febrero</option>
                        <option value="03<?php if ($mes == "3") { echo "selected"; } ?>">Marzo</option>
                        <option value="04<?php if ($mes == "4") { echo "selected"; } ?>">Abril</option>
                        <option value="05<?php if ($mes == "5") { echo "selected"; } ?>">Mayo</option>
                        <option value="06<?php if ($mes == "6") { echo "selected"; } ?>">Junio</option>
                        <option value="07<?php if ($mes == "7") { echo "selected"; } ?>">Julio</option>
                        <option value="08<?php if ($mes == "8") { echo "selected"; } ?>">Agosto</option>
                        <option value="09<?php if ($mes == "9") { echo "selected"; } ?>">Septiembre</option>
                        <option value="10<?php if ($mes == "10") { echo "selected"; } ?>">Octubre</option>
                        <option value="11<?php if ($mes == "11") { echo "selected"; } ?>">Noviembre</option>
                        <option value="12<?php if ($mes == "12") { echo "selected"; } ?>">Diciembre</option>
                    </select>

                    <select id="ano" name="ano" style="font-family: montserrat;float:left;margin-left:5px;height:20px;" class="className">
                        <option value="">Año</option>
                        <option value="2010<?php if ($ano == "1") { echo "selected"; } ?>">2010</option>
                        <option value="2009<?php if ($ano == "2") { echo "selected"; } ?>">2009</option>
                        <option value="2008<?php if ($ano == "3") { echo "selected"; } ?>">2008</option>
                        <option value="2007<?php if ($ano == "4") { echo "selected"; } ?>">2007</option>
                        <option value="2006<?php if ($ano == "5") { echo "selected"; } ?>">2006</option>
                        <option value="2005<?php if ($ano == "6") { echo "selected"; } ?>">2005</option>
                        <option value="2004<?php if ($ano == "7") { echo "selected"; } ?>">2004</option>
                        <option value="2003<?php if ($ano == "8") { echo "selected"; } ?>">2003</option>
                        <option value="2002<?php if ($ano == "9") { echo "selected"; } ?>">2002</option>
                        <option value="2001<?php if ($ano == "10") { echo "selected"; } ?>">2001</option>
                        <option value="2000<?php if ($ano == "11") { echo "selected"; } ?>">2000</option>
                        <option value="1999<?php if ($ano == "12") { echo "selected"; } ?>">1999</option>
                        <option value="1998<?php if ($ano == "13") { echo "selected"; } ?>">1998</option>
                        <option value="1997<?php if ($ano == "14") { echo "selected"; } ?>">1997</option>
                        <option value="1996<?php if ($ano == "15") { echo "selected"; } ?>">1996</option>
                        <option value="1995<?php if ($ano == "16") { echo "selected"; } ?>">1995</option>
                        <option value="1994<?php if ($ano == "17") { echo "selected"; } ?>">1994</option>
                        <option value="1993<?php if ($ano == "18") { echo "selected"; } ?>">1993</option>
                        <option value="1992<?php if ($ano == "19") { echo "selected"; } ?>">1992</option>
                        <option value="1991<?php if ($ano == "20") { echo "selected"; } ?>">1991</option>
                        <option value="1990<?php if ($ano == "21") { echo "selected"; } ?>">1990</option>
                        <option value="1989<?php if ($ano == "22") { echo "selected"; } ?>">1989</option>
                        <option value="1988<?php if ($ano == "23") { echo "selected"; } ?>">1988</option>
                        <option value="1987<?php if ($ano == "24") { echo "selected"; } ?>">1987</option>
                        <option value="1986<?php if ($ano == "25") { echo "selected"; } ?>">1986</option>
                        <option value="1985<?php if ($ano == "26") { echo "selected"; } ?>">1985</option>
                        <option value="1984<?php if ($ano == "27") { echo "selected"; } ?>">1984</option>
                        <option value="1983<?php if ($ano == "28") { echo "selected"; } ?>">1983</option>
                        <option value="1982<?php if ($ano == "29") { echo "selected"; } ?>">1982</option>
                        <option value="1981<?php if ($ano == "30") { echo "selected"; } ?>">1981</option>
                        <option value="1980<?php if ($ano == "32") { echo "selected"; } ?>">1980</option>
                        <option value="1979<?php if ($ano == "33") { echo "selected"; } ?>">1979</option>
                        <option value="1978<?php if ($ano == "34") { echo "selected"; } ?>">1978</option>
                        <option value="1977<?php if ($ano == "35") { echo "selected"; } ?>">1977</option>
                        <option value="1976<?php if ($ano == "36") { echo "selected"; } ?>">1976</option>
                        <option value="1975<?php if ($ano == "37") { echo "selected"; } ?>">1975</option>
                        <option value="1974<?php if ($ano == "38") { echo "selected"; } ?>">1974</option>
                        <option value="1973<?php if ($ano == "39") { echo "selected"; } ?>">1973</option>
                        <option value="1972<?php if ($ano == "40") { echo "selected"; } ?>">1972</option>
                        <option value="1971<?php if ($ano == "41") { echo "selected"; } ?>">1971</option>
                        <option value="1970<?php if ($ano == "42") { echo "selected"; } ?>">1970</option>
                        <option value="1969<?php if ($ano == "43") { echo "selected"; } ?>">1969</option>
                        <option value="1968<?php if ($ano == "44") { echo "selected"; } ?>">1968</option>
                        <option value="1967<?php if ($ano == "45") { echo "selected"; } ?>">1967</option>
                        <option value="1966<?php if ($ano == "46") { echo "selected"; } ?>">1966</option>
                        <option value="1965<?php if ($ano == "47") { echo "selected"; } ?>">1965</option>
                        <option value="1964<?php if ($ano == "48") { echo "selected"; } ?>">1964</option>
                        <option value="1963<?php if ($ano == "49") { echo "selected"; } ?>">1963</option>
                        <option value="1962<?php if ($ano == "50") { echo "selected"; } ?>">1962</option>
                        <option value="1961<?php if ($ano == "51") { echo "selected"; } ?>">1961</option>
                        <option value="1960<?php if ($ano == "52") { echo "selected"; } ?>">1960</option>
                        <option value="1959<?php if ($ano == "53") { echo "selected"; } ?>">1959</option>
                        <option value="1958<?php if ($ano == "54") { echo "selected"; } ?>">1958</option>
                        <option value="1957<?php if ($ano == "55") { echo "selected"; } ?>">1957</option>
                        <option value="1956<?php if ($ano == "56") { echo "selected"; } ?>">1956</option>
                        <option value="1955<?php if ($ano == "57") { echo "selected"; } ?>">1955</option>
                        <option value="1954<?php if ($ano == "58") { echo "selected"; } ?>">1954</option>
                        <option value="1953<?php if ($ano == "59") { echo "selected"; } ?>">1953</option>
                        <option value="1952<?php if ($ano == "60") { echo "selected"; } ?>">1952</option>
                        <option value="1951<?php if ($ano == "61") { echo "selected"; } ?>">1951</option>
                        <option value="1950<?php if ($ano == "62") { echo "selected"; } ?>">1950</option>
                    </select>

                </div>
            </div>

            <div style="font-size: 13px; float: left; width: calc(50% - 2%); background-color: white; float: left; padding-right: 2%;font-family: montserrat; padding-top: 10px;">Matricula
                <input id="matricula" name="matricula" type="text" value="<?php echo $matricula; ?>" style="font-size: 12px;width: calc(100% - 20px);margin-right:2%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>


            <div style="font-size: 13px; float: left; width: calc(50% - 2%); padding-top: 10px; background-color: white; float: left; padding-left: 2%; font-family: montserrat;">CURP
                <input id="curp" name="curp" type="text" value="<?php echo $curp; ?>" style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>

            <div id="" name="pais" type="text" value="" style="font-size: 12px;width: 100%;margin: 10px 0;float: left;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                Pais
                <div id="opciones" style="/* float:right; */font-family: arial;margin-top: 10px;font-size: 14px;">
                    <input type="radio" style="margin-left: 20px;" name="pais" id="mex" value="<?php echo $pais; ?>">México
                    <input type="radio" style="margin-left: 40px;" name="pais" id="op" value="<?php echo $pais; ?>">Otro país
                </div>
            </div>


            <div id="estado" name="estado" type="text" value="" style="font-size: 13px;width: 100%;margin: 10px 0;box-sizing: border-box;float: left;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;font-family: montserrat;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                
                <select id="estado" name="estado" style="font-family: montserrat;font-size: 14px;">
                    <option value="1<?php if ($estado == "1") { echo "selected"; } ?>">Aguascalientes</option>
                    <option value="2<?php if ($estado == "2") { echo "selected"; } ?>">Baja California</option>
                    <option value="3<?php if ($estado == "3") { echo "selected"; } ?>">Baja California Sur</option>
                    <option value="4<?php if ($estado == "4") { echo "selected"; } ?>">Campeche</option>
                    <option value="5<?php if ($estado == "5") { echo "selected"; } ?>">Chiapas</option>
                    <option value="6<?php if ($estado == "6") { echo "selected"; } ?>">Chihuahua</option>
                    <option value="7<?php if ($estado == "7") { echo "selected"; } ?>">Coahuila</option>
                    <option value="8<?php if ($estado == "8") { echo "selected"; } ?>">Colima</option>
                    <option value="9<?php if ($estado == "9") { echo "selected"; } ?>">Durango</option>
                    <option value="10<?php if ($estado == "10") { echo "selected"; } ?>">Estado de México</option>
                    <option value="11<?php if ($estado == "11") { echo "selected"; } ?>">Guanajuato</option>
                    <option value="12<?php if ($estado == "12") { echo "selected"; } ?>">Guerrero</option>
                    <option value="13<?php if ($estado == "13") { echo "selected"; } ?>">Hidalgo</option>
                    <option value="14<?php if ($estado == "14") { echo "selected"; } ?>">Jalisco</option>
                    <option value="15<?php if ($estado == "15") { echo "selected"; } ?>">Michoacán</option>
                    <option value="16<?php if ($estado == "16") { echo "selected"; } ?>">Morelos</option>
                    <option value="17<?php if ($estado == "17") { echo "selected"; } ?>">Nayarit</option>
                    <option value="18<?php if ($estado == "18") { echo "selected"; } ?>">Nuevo León</option>
                    <option value="19<?php if ($estado == "19") { echo "selected"; } ?>">Oaxaca</option>
                    <option value="20<?php if ($estado == "20") { echo "selected"; } ?>">Puebla</option>
                    <option value="21<?php if ($estado == "21") { echo "selected"; } ?>">Querétaro</option>
                    <option value="22<?php if ($estado == "22") { echo "selected"; } ?>">Quintana Roo</option>
                    <option value="23<?php if ($estado == "23") { echo "selected"; } ?>">San Luis Potosí</option>
                    <option value="24<?php if ($estado == "24") { echo "selected"; } ?>">Sinaloa</option>
                    <option value="25<?php if ($estado == "25") { echo "selected"; } ?>">Sonora</option>
                    <option value="26<?php if ($estado == "26") { echo "selected"; } ?>">Tabasco</option>
                    <option value="27<?php if ($estado == "27") { echo "selected"; } ?>">Tamaulipas</option>
                    <option value="28<?php if ($estado == "28") { echo "selected"; } ?>">Tlaxcala</option>
                    <option value="29<?php if ($estado == "29") { echo "selected"; } ?>">Veracruz</option>
                    <option value="30<?php if ($estado == "30") { echo "selected"; } ?>">Yucatan</option>
                    <option value="31<?php if ($estado == "31") { echo "selected"; } ?>">Zacatecas</option>
                </select>
            </div>

            <div style="font-family:Montserrat; font-size:13px;">Municipio
                <input id="municipio" name="municipio" type="text" value="<?php echo $municipio; ?>" style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>


            <div id="direccion" style="font-size: 13px;text-align: center;width:100%;font-family: montserrat;">
                <div id="colonia" style="width: 50%;text-align: left;float: left;">Colonia</div>
                <div id="calle" style="float: left;width: 50%; text-align: left;">Calle y Numero</div>
            </div>

            <input id="colonia" name="colonia" type="text" value="<?php echo $colonia; ?>" style="font-size: 12px;width: 49%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            <input id="calle" name="calle" type="text" value="<?php echo $calle; ?>" style="font-size: 12px;width: 49%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">


            <div style="font-family:Montserrat; font-size:13px;"> Codigo Postal
                <input id="codigopostal" name="codigopostal" type="text" value="<?php echo $codigopostal; ?>" style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>

            <div style="font-family:Montserrat; font-size:13px;"> Telefono
                <input id="telefono" name="telefono" type="text" value="<?php echo $telefono; ?>" style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>

            <div style="font-family:Montserrat; font-size:13px;"> Correo
                <input id="correo" name="correo" type="text" value="<?php echo $correo; ?>" style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>

            <div style="font-family:Montserrat; font-size:13px;"> Contraseña
                <input id="contrasena" value="<?php echo $contrasena; ?>" name="contrasena" type="password" style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>

            <div style="font-family:Montserrat; font-size:13px;"> Curso
                <input id="curso" name="curso" type="text" value="<?php echo $curso; ?>" style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>

            <div align="center" style="width: 100%; float: left;">

                <button type="submit" style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #7FDBFF; margin-top: 15px; width:200px; color: #7FDBFF; background-color: #1d4267;">GUARDAR</button>

            </div>

        </form>

    </div>       



 </div>


 </div>


</body>

</html>