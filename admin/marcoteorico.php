<?php require_once('../Connections/conamatenlinea.php');

session_start();
$usuario = $_SESSION['usuario'];
$error = "";
date_default_timezone_set('America/Mexico_City');
$unixtime = time();

if ($usuario == "") {
    
    header("Location: login.php");
	exit;

}

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

$permiso = $row_Recordset1['permiso'];

if ($permiso == 2) {

header("Location: index.php");
exit;

}

$id = $_GET['id'];

$query_Recordset2 = "SELECT * FROM ayuda WHERE id = '$id'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$pregunta = stripslashes(stripslashes($row_Recordset2['pregunta']));
$respuesta = stripslashes(stripslashes($row_Recordset2['respuesta']));

if ($_POST) {

    $pregunta = addslashes(addslashes($_POST['pregunta']));
    $respuesta = addslashes(addslashes($_POST['respuesta']));
    $id = addslashes(addslashes($_POST['id']));

    mysql_select_db($database_conamatenlinea, $conamatenlinea);
    $query_Recordset3 = "SELECT * FROM ayuda WHERE pregunta = '$pregunta' AND id != '$id'";
    $Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
    $row_Recordset3 = mysql_fetch_assoc($Recordset3);
    $totalRows_Recordset3 = mysql_num_rows($Recordset3);

    if ($totalRows_Recordset3 > 0) $error = "Esa pregunta ya está registrada";

    if ($totalRows_Recordset3 == 0) {

        mysql_query("UPDATE ayuda SET pregunta = '$pregunta', respuesta = '$respuesta' WHERE id = '$id'"); 

        mysql_query("INSERT INTO actividad(accion, usuario, fecha) VALUES( 'Modificó pregunta', '$usuario', '$unixtime')"); 


        header("Location: ayuda.php");
        exit;

    }

}

?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Conamat en línea | Admin</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">

    <!--Libreria de las fuentes-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">

    <!--Libreria jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!--Libreria de los iconos-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">

    <!--Estilos CSS-->
    <style>
        body{
        margin: 0;
        background-color: #0b2c4d;
        font-family: 'Open Sans', sans-serif; 
    }
    .menu{
        font-family: 'Montserrat', sans-serif;
        padding: 10px;
        line-height: 30px;
        text-decoration: none;
        font-size: 18px;
        float:left;
        color: white;
        width: calc(100% - 20px);
    }
    .menu:hover{
        background-color: #7FDBFF !important;
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
        padding: 20px 50px;
        border-radius: 10px;
    }
    
    
    </style>
    <!--Fin estilos CSS-->

    <script type="text/javascript">

        function validaenvia(){

            var pregunta = $("#pregunta");
            var respuesta =  $("#respuesta");
        
            if (nombre.val() == "") {
                
                alert("Por favor introduce una pregunta");
                nombre.focus();
                return false;
            
            } else if (clave.val() == "") {

                alert("Por favor introduce una respuesta");
                clave.focus();
                return false;

            } else {

                $("#seccion-form").submit();
            }
        }

    </script>

</head>

<body>

    <!--Wraper contenedor -->
    <div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

<div id="adminmenu" style="float: left; box-shadow: 0px 0px 10px #000; width: 20%; background-color: #1d4267; position: fixed; height: 100%; overflow: scroll;">

        <div id="logotipo" align="center" style="float: left; width: calc(100% - 60px); padding-top: 50px; padding-bottom: 50px; padding-left: 30px; padding-right: 30px;"><img src="../images/logotipo.png" alt="logotipo" style="width: 100%;"></div>

        <div id="etiquetaadmin" style="font-family: 'Montserrat', sans-serif; float: left; width: calc(80% - 20px); margin-left: 10%; margin-top: 20px; margin-bottom: 50px; text-align: center; padding: 10px; border: 1px solid white; color: white; font-size: 18px; border-radius: 20px;">Menú admin</div>

        <div id="navegacion" style="width: 100%; float: left; margin-bottom: 20px;">
                    
            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="index.php">Inicio</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
<?php

    if ($permiso == 1) {

?>

            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">CONTENIDO PÁGINA</div>

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

            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">PLATAFORMA EDUCATIVA</div>

            <a class="menu" href="alumnos.php">Alumnos</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <div id="link">Ayuda</div>

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

<?php

    }

    if ($permiso == 1) {

?>
            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">MENÚ ADMIN</div>

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


    <div id="seccionmain" style="float: left; width: 80%; margin-left: 20%; position: relative; min-height: 100vh;">

        <!--Contenedor global-->
        <div id="contenedor" class="card" style="width: calc(80% - 100px); margin-top: -195px; left: 50%; top: 50%; position: absolute; margin-left: -40%;">

                <div id="seccion-form" align="center" style="width: calc(100% - 2px); background-color: white; margin-bottom: 50px; float: left; padding-top: 50px;">
            
                        <form id="form1" name="form1" style="width: 90%;" action="" method="post" enctype="multipart/form-data">
            
                            <input id="id" name="id" value="<?php echo $id; ?>" type="hidden">
        
                            <div id="titulo" style="width: 100%; margin-bottom: 40px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Marco Teórico</div> 
            
                            <input id="actividad" name="pregunta" type="text" value="" placeholder="Ingresa una actividad" style="font-size: 12px; width: 100%; margin: 10px 0; box-sizing: border-box; margin-bottom: 10px; padding: 10px 10px; border: none; background-color: #DDE3EC; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            
                            <div id="titulo" style="width: 100%;text-align: center;font-size: 15px;color: #58575d;font-weight: bold;letter-spacing: 1.6;">Agregar una imagen a este texto</div> 
            
                            <a href="javascript:void();" onclick="javascript:document.getElementById('').click();"><div id="botonfile" align="center" style="border-radius: 5px;margin: 0px 330px;border: 1px solid #1d4267;background-color: #1d4267;color: #7FDBFF;padding: 5px;cursor:pointer;width: 100px;float: left;">
            
                                    <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; background-color: #1d4267; height:0px; display:block;">
                
                                    <div style="font-size:12px;">Elegir imagen</div>
                
                                    <input type="file" id="foto0" name="foto0" onchange="javascript:enviar('');" style="display: none;" accept="image/jpeg">  
                
                                </div></a>
            
                            <textarea id="respuesta" name="respuesta" type="text" value="" placeholder="Ingresa texto" style="font-size: 12px;width: 100%;margin: 10px 0px;box-sizing: border-box;height: 150px;padding: 10px 10px;border: none;background-color: #DDE3EC;color: gray;resize: none;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"> </textarea>

                            <div id="titulo" style="width: 100%;text-align: center;font-size: 15px;color: #58575d;font-weight: bold;letter-spacing: 1.6;">Agregar una imagen a este texto</div>

                            <a href="javascript:void();" onclick="javascript:document.getElementById('').click();"><div id="botonfile" align="center" style="border-radius: 5px;margin: 0px 330px;border: 1px solid #1d4267;background-color: #1d4267;color: #7FDBFF;padding: 5px;cursor:pointer;width: 100px;float: left;">
            
                                    <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; background-color: #1d4267; height:0px; display:block;">
                
                                    <div style="font-size:12px;">Elegir imagen</div>
                
                                    <input type="file" id="foto0" name="foto0" onchange="javascript:enviar('0');" style="display: none;" accept="image/jpeg">  
                
                                </div></a>

                            <a href="javascript:void();" onclick="javascript:document.getElementById('').click();"><div id="botonfile" align="center" style="border-radius: 5px;margin: 10px;border: 1px solid #1d4267;background-color: #1d4267;color: #7FDBFF;padding:10px;cursor:pointer;width: 150px;float: left;">
            
                                        <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; background-color: #1d4267; height:0px; display:block;">
                    
                                        <div style="font-size:12px;">+Agregar mas texto</div>
                    
                                        <input type="file" id="foto0" name="foto0" onchange="javascript:enviar('');" style="display: none;" accept="image/jpeg">  
                    
                                    </div></a>
            
                            <div align="center" style="width: calc(100% - 40%);margin-left: 25%;float: left;margin-top: 5%;">
            
                                    <button type="submit" style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #7FDBFF; margin-top: 15px; width:150px; color: #fff; background-color: #1d4267; float: left; margin-right: 50px;">GUARDAR</button>
                                    
                                    <input type="button" name="Cancelar" value="Cancelar" onclick="window.location='alumnos.php'" style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #848a90; margin-top: 15px; width: 150px; color: #fff; background-color: #838e98; float: left; text-transform: uppercase;">
                                   
                            </div>
                 
                        </form>
            
                    </div>
        
        </div>
        <!--fin contenedor global-->

    </div>
    <!--Fin seccion main -->

</div>
<!--Fin del wraper contenedor -->

</body>

</html>
