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

if ($permiso != 1) {

header("Location: index.php");
exit;

}

$idusuario = $_GET['id'];

$query_Recordset2 = "SELECT * FROM usuarios WHERE id = '$idusuario'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$usuarioactual = $row_Recordset2['usuario'];
$contrasenaactual = $row_Recordset2['contrasena'];
$permisoactual = $row_Recordset2['permiso'];

if ($_POST) {

    $usuario11 = $_POST['miembro'];
    $pass = $_POST['contra'];
    $permiso = $_POST['permiso'];
    $id= $_POST['idusuario'];

    mysql_select_db($database_conamatenlinea, $conamatenlinea);
    $query_Recordset3 = "SELECT * FROM usuarios WHERE usuario = '$usuario11' AND id != '$id'";
    $Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
    $row_Recordset3 = mysql_fetch_assoc($Recordset3);
    $totalRows_Recordset3 = mysql_num_rows($Recordset3);

    if ($totalRows_Recordset3 > 0) $error = "Ya hay un usuario con ese nombre";

    if ($totalRows_Recordset3 == 0) {

        mysql_query("UPDATE usuarios SET usuario = '$usuario11', contrasena = '$pass', permiso = '$permiso' WHERE id = '$id'"); 

        mysql_query("INSERT INTO actividad(accion, usuario, fecha) VALUES( 'Modificó usuario', '$usuario', '$unixtime')"); 


        header("Location: usuarios.php");
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

            var usuarioinput = $("#miembro");
            var contrasenaainput =  $("#password");
        
            if (usuarioinput.val() == "") {
                
                alert("Por favor introduce un nombre para el usuario");
                usuarioinput.focus();
                return false;
            
            } else if (contrasenaainput.val() == "") {

                alert("Por favor introduce una contraseña para el usuario");
                passwordinput.focus();
                return false;

            } else {

                $("#formmodificarusuario").submit();
            }
        }

    </script>

</head>

<body>

   
    <div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

     <!--Menu admin -->
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
<?php

    }

    if ($permiso == 1) {

?>
            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">MENÚ ADMIN</div>

            <a class="menu" href="actividad.php">Actividad</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <div id="link">Usuarios</div>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
 
<?php 

    }

?>
            <a class="menu" href="logout.php">Salir</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

        </div>

    </div>
     <!--Fin menu admin -->


    <div id="seccionmain" style="float: left; width: 80%; margin-left: 20%; position: relative; min-height: 100vh;">

        <!--Contenedor global-->
        <div id="contenedor-usuarios" class="card" style="width: calc(40% - 100px); margin-top: -195px; left: 50%; top: 50%; height: 350px; position: absolute; margin-left: -20%;">

            <!--Encabezado de la seccion-->
            <div id="titulo" align="center" style="padding-top: 30px; font-family: 'Montserrat', sans-serif; padding-bottom: 30px; overflow: hidden; height: 40px; font-size: 20px; color: #333; font-weight: bold; letter-spacing: 1.6px;">Modificar usuario</div>
            <!--Fin encabezado seccion-->

            <!--Formulario editar usuario-->
            <form id="formmodificarusuario" name="formmodificarusuario" method="post" action="">

            <input id="idusuario" name="idusuario" value="<?php echo $idusuario; ?>" type="hidden">

                <div id="globalnombreinput">

                    <div id="nombreetiquetas" style="float: left; width: 30%; height: 90px;">

                        <div style="padding: 15px 0px; font-size: 14px;">
                            Usuario:
                        </div>

                        <div style="padding: 15px 0px; font-size: 14px;">
                            Contraseña:
                        </div>

                    </div>

                    <div id="inputetiquetas" style="float: left; width: 70%; height: 90px;">

                        <div id="divinput" style="width: calc(100% - 20px); padding: 10px;">
                            <input id="miembro" value="<?php echo $usuarioactual; ?>" name="miembro" type="text" style="padding: 5px; width: 100%; font-size: 14px;">
                        </div>

                        <div id="divinput" style="padding: 10px; width: calc(100% - 20px);">
                            <input id="password" name="contra" type="password" value="<?php echo $contrasenaactual; ?>" style="padding: 5px; width: 100%; font-size: 14px;">
                        </div>
                    </div>
                </div>

                <div id="permiso" style="margin-top: 20px; margin-bottom: 30px; float: left; width: 100%;">

                    <div style="float: left; padding: 5px 0px; width: 30%; font-size: 14px;">Permiso:</div>

                    <div>
                        <select name="permiso" id="tipopermiso" style="float: left; margin: 5px 10px; width: calc(70% - 20px); font-size: 14px;">
                        <option value="1" <?php if ($permisoactual == "1") { echo "selected"; } ?>>Total</option>
                            <option value="2" <?php if ($permisoactual == "2") { echo "selected"; } ?>>Contenido página</option>
                            <option value="3" <?php if ($permisoactual == "3") { echo "selected"; } ?>>Plataforma educativa</option>

                        </select>
                    </div>

                </div>


                <div id="contenedorboton" align="center" style="width: calc(100% - 10%); margin-left: 8%; float: left;">
                   
                    <button id="contenedorboton" type="button" onclick="validaenvia()" style="padding: 10px 10px; background-color: #1d4267; border-color: #7FDBFF; color: #7FDBFF; cursor: pointer; float: left; margin-right: 30px;">Guardar cambios</button>
                    
                    <input type="button" name="Cancelar" value="Cancelar" onclick="window.location='materias.php'" style="float: left; width: 100px; margin-bottom: 20px; padding: 10px 0px; background-color: #00020287; border-color: #b8bfc1; color: #d8dfe2; cursor: pointer;">

                </div>

            </form>
            <!--Fin formulario editar usuario-->

        </div><!--fin de seccionmain-->

    </div>
        <!--Fin contenedor global -->

</div>
    <!--Fin del wraper contenedor -->

</body>

</html>
