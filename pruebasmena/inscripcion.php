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


$id = $_GET['id'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM alumnos WHERE id = '$id'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$idalumno = $row_Recordset2['id'];
$nombre = stripslashes(stripslashes($row_Recordset2['nombrealumno']));
$apellidopaterno = stripslashes(stripslashes($row_Recordset2['apellidopaterno']));
$apellidomaterno = stripslashes(stripslashes($row_Recordset2['apellidomaterno']));
$sexo = $row_Recordset2['sexo'];
$dia = $row_Recordset2['dia'];
$mes = $row_Recordset2['mes'];
$ano = $row_Recordset2['ano'];
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

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset3 = "SELECT * FROM cursos";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);


mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset4 = "SELECT * FROM inscripciones";
$Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset3 = mysql_num_rows($Recordset4);

if ($_POST) {

    $curso =$_POST['idcurso'];
	$fecha = $unixtime;
	$observaciones = addslashes(addslashes(trim($_POST['observaciones'])));
    $grupo =$_POST['grupo'];
   
    mysql_select_db($database_conamatenlinea, $conamatenlinea);

    mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Inscribió un alumno', '$unixtime')");
	
    mysql_query("UPDATE inscripciones SET idalumno = '$id', idcurso = '$curso', fecha = '$fecha',
    observaciones = '$observaciones', grupo = '$grupo' WHERE id = '$idalumno'");
    

    header("Location: alumnos.php");


}//Fin del POST





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conamatenlinea | admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />

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
        background-color: white;
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
                contrasena.focus();
                return false;
                }
            else{

                $("#inscripcion").submit();
            }
        }

    </script>

<!--Fin Javascript-->
</head>

<body>

<!--Wrapper-->
 <div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: white; position: relative;">

    <!--Admin Menu-->
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

            <a class="menu" href="maestros.php">Maestros</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="materias.php">Materias</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="pagos.php">Pagos</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="sesiones.php">Sesiones</a>

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
    <!--Fin menu admin-->

    <!--Seccion principal-->
    <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">

    <a href="Javascript:void(0)" onclick="nuevo()"></a>

    <div id="seccion-form" style="width: 100%; float: left;  background-color: white; box-sizing: border-box; padding: 30px; border: 1px solid rgb(51, 51, 51); box-shadow: rgba(0, 0, 0, 0.08) 0px 0px 20px;">

        <div id="titulo" style="width: 100%; margin-bottom: 40px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Inscribir alumno</div>
                     
        <form id="inscribir" name="forminscribir" action="inscripcion.php" method="post" onsubmit="return(validaenvia())" enctype="multipart/form-data">
        
            <input id="idalumno" name="idalumno" type="hidden" value="<?php echo $id; ?>">  

            <div id="contenedorcurso" style="width: calc(50% - 10px); float: left; margin-right: 10px;">
             
                <div style="font-family:Montserrat; font-size:13px;">Curso </div>

                <select id="curso" name="curso" style="font-size: 12px;width: 100%; margin: 10px 0; box-sizing: border-box; padding: 10px 10px; border: none; background-color: whitesmoke; color: gray;">Curso
               
                    <?php 
                    
                        do{
    
                            $idcurso = stripslashes(stripslashes($row_Recordset3['id']));
                            $nombrecurso = stripslashes(stripslashes($row_Recordset3['nombre']));
                    
                    ?>
                        
                    <option value="<?php echo $idcurso; ?>"><?php echo $nombrecurso; ?></option>
    
                    <?php }while($row_Recordset3 = mysql_fetch_assoc($Recordset3)) ?>
               
                </select>

            </div>
                    
            <div id="contenedorgrupo" style="width: calc(50% - 10px); float: left; margin-left: 10px;">

                <div style="font-family: Montserrat; font-size:13px;">Grupo </div>
                    
                <select id="grupo" name="grupo" style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;">
               
                    <option value="1">Grupo 1</option>
                    <option value="2">Grupo 2</option>

               
                </select>

            </div>
                    
                    <div id="contenedorobservaciones" style="float: left; width: 100%; font-size: 13px; font-family: 'Montserrat', sans-serif; margin-bottom: 10px; margin-top: 10px;">Observaciones</div>
                     
                        <textarea id="observaciones" name="observaciones" rows="10" style="float: left; width: 100%; resize: none; color:black; font-size: 13px; font-family: 'Open Sans', sans-serif; border: 1px solid #ccc; background-color: whitesmoke;"><?php echo $observaciones; ?></textarea> 
                    
                    
                    <div align="center" style="width: calc(100% - 60%); margin-left: 30%; float: left;">

                        <button type="submit" style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #7FDBFF; margin-top: 15px; width:150px; color: #fff; background-color: #1d4267; float: left; margin-right: 50px;">GUARDAR</button>
                        
                        <input type="button" name="Cancelar" value="Cancelar" onclick="window.location='alumnos.php'" style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #7e8388; margin-top: 15px; width: 150px; color: #fff; background-color: #00020287; float: left; text-transform: uppercase;">
                       
                        </div>
                </div>

        
        </form>
        

    </div>  
    <!--Fin seccion-->     



 </div>
 <!--Fin Wrapper-->


 </div>


</body>

</html>
