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
	$grupo = addslashes(addslashes(trim($_POST['grupo'])));
	$observaciones = addslashes(addslashes(trim($_POST['observaciones'])));
	$fecha = $unixtime;

    mysql_select_db($database_conamatenlinea, $conamatenlinea);

    mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Modificó un alumno', '$unixtime')");

    mysql_query("UPDATE alumnos SET matricula = '$matricula', nombrealumno = '$nombre', correo = '$correo',
    contrasena = '$contrasena', estadoalumno = '$estadoalumno', apellidomaterno = '$apellidomaterno', apellidopaterno = '$apellidopaterno', 
    sexo = '$sexo', curp = '$curp', pais = '$pais', estado = '$estado', municipio = '$municipio', colonia = '$colonia', calle = '$calle', 
    codigopostal = '$codigopostal', telefono = '$telefono', dia ='$dia', mes = '$mes', ano ='$ano' WHERE id = '$idalumno'");
	
	mysql_query("INSERT INTO inscripciones(idcurso, grupo) VALUES ($curso', $grupo')"); 
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
    <!--Fin menu admin-->

    <!--Seccion principal-->
    <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">

    <a href="Javascript:void(0)" onclick="nuevo()"></a>

    <div id="seccion-form" style="width: 100%; float: left;  background-color: white; box-sizing: border-box; padding: 30px; border: 1px solid rgb(51, 51, 51); box-shadow: rgba(0, 0, 0, 0.08) 0px 0px 20px;">

        <div id="titulo" style="width: 100%; margin-bottom: 40px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Inscribir alumno</div>
              
        
    <form id="inscribir" name="forminscribir" action="modificaralumno.php" method="post" onsubmit="return(validaenvia())" enctype="multipart/form-data">

        <div style="font-family:Montserrat; font-size:13px;">Curso </div>
                <select id="curso" name="curso" style="font-size: 12px;width: 50%; margin: 10px 0; box-sizing: border-box; padding: 10px 10px; border: none; background-color: whitesmoke; color: gray;">Curso
               
              		<?php 
					
						do{
	
							$idcurso = stripslashes(stripslashes($row_Recordset3['id']));
							$nombrecurso = stripslashes(stripslashes($row_Recordset3['nombre']));
					
					?>
              			
					<option value="<?php echo $idcurso; ?>"><?php echo $nombrecurso; ?></option>
	
					<?php }while($row_Recordset3 = mysql_fetch_assoc($Recordset3)) ?>
					
				
               
                </select>
                            <div id="grupo"> </div>
            <div style="font-family:Montserrat; font-size:13px;">Grupo </div>
                <select id="grupo" name="grupo" style="font-size: 12px;width: 50%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;">Grupo</select>
                
                <?php 
					
                    do{

                        $idgrupo = stripslashes(stripslashes($row_Recordset3['id']));
                        $nombregrupo = stripslashes(stripslashes($row_Recordset3['nombregrupo']));
                
                ?>
                      
                <option value="<?php echo $idcurso; ?>"><?php echo $nombregrupo; ?></option>

                <?php }while($row_Recordset3 = mysql_fetch_assoc($Recordset3)) ?>

                    <button type="submit" style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #7FDBFF; margin-top: 15px; width:200px; color: #7FDBFF; background-color: #1d4267;">GUARDAR</button>

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