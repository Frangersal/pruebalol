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

if ($permiso != '1') {

header("Location: index.php");
exit;

}

   
if ($_POST) { 
    $titulo = $_POST['titulolibro'];
    $archivo = basename($_FILES['archivo']['name']);
    $archivoactual = $_POST['archivoactual'];
    $id = $_POST['idlibro'];
    $targetPath = "../libros/";

    mysql_select_db($database_conamatenlinea, $conamatenlinea);
    $query_Recordset3 = "SELECT * FROM biblioteca WHERE titulo = '$titulo'";
    $Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
    $row_Recordset3 = mysql_fetch_assoc($Recordset3);
    $totalRows_Recordset3 = mysql_num_rows($Recordset3);

    if ($totalRows_Recordset3 > 0) $error = "Ya hay un libro con ese titulo";

    if ($totalRows_Recordset3 == 0) {


        if ($archivo != "") {

            $tempFile = $_FILES["archivo"]["tmp_name"];
            $numero1 = substr(md5(rand(0,9999)), 17, /*Numero de Digitos*/5);
            $name1 = date("dmY").$numero1.$h."1";
            $ext = pathinfo($archivo, PATHINFO_EXTENSION);  //figures out the extension
            $newFileName1 = $name1.".".$ext;
            $targetFile =  $targetPath . $newFileName1;
        
           move_uploaded_file($tempFile, $targetFile);
       
           unlink("../libros/" . $archivoactual);

           mysql_query("UPDATE biblioteca SET titulo = '$titulo', archivo = '$newFileName1' WHERE id = '$id'");

        } else {

           mysql_query("UPDATE biblioteca SET titulo = '$titulo', archivo = '$archivoactual' WHERE id = '$id'");

        }

       mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Modificó libro', '$unixtime')"); 


    }


   header("Location: biblioteca.php");
   exit;
}

$idlibro = $_GET['id'];

$query_Recordset2 = "SELECT * FROM biblioteca WHERE id = '$idlibro'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$tituloactual = $row_Recordset2['titulo'];
$archivoactual = $row_Recordset2['archivo'];
 

?>
<!DOCTYPE html>
<html lang="es"><head>
    <meta charset="UTF-8">
    <title>Conamat en línea | Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<!--Estilos CSS-->
<style>
body{
    margin: 0;
    background-color: #0b2c4d;
    font-family: 'Montserrat', sans-serif; 
}
.menu{
    font-family: 'Montserrat', sans-serif;
    padding: 10px;
    line-height: 30px;
    float:left;
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
    padding: 20px 50px;
    border-radius: 10px;
}
.toprow{
    float:left;
    width: 100%;
    background-color: #0b2c4d; 
    color: white;
    min-height: 50px;
}
.topcell{
    float: left; 
    width: calc(25% - 2px);
    line-height: 50px;
    text-align: center;
}
.row{
    float:left;
    width: 100%;
    background-color: white; 
}
.cell{
    float: left; 
    width: calc(25% - 2px);
    border: 1px solid lightgray;
    line-height: 30px;
    text-align: center;
}
.nostyle:link{
    color: #222;
    text-decoration: none;
}
.nostyle:visited{
    color: #222;
    text-decoration: none;
}

</style>
<!--Fin estilos CSS-->
<?php if ($error != '') { ?>
<script>
alert("<?php echo $error; ?>");
</script>
<?php } ?>
<!--Javascript-->
<script type="text/javascript" >

function guardarform() {

    //validamos que no esten vacíos los campos

    if ( $("#titulolibro").val() == '') {
        
        alert("Por favor escribe el título del libro");
        $("#titulolibro").focus();
        return false;
    }

    document.getElementById("form1").submit();
}

function eliminar(id) {

    if (confirm("¿Estás seguro de eliminar este libro?")==1) {

        location.href="eliminarlibro.php?id="+id;

    }

}


</script>
<!--Fin Javascript-->

</head>
<body>

<div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

    <!--Menu admin-->
    <div id="adminmenu" style="float: left; box-shadow: 0px 0px 10px #000; width: 20%; background-color: #1d4267; position: fixed; height: 100%; overflow: scroll;">

        <div id="logotipo" align="center" style="float: left; width: calc(100% - 60px); padding-top: 50px; padding-bottom: 30px; padding-right: 30px; padding-left: 30px;"><img src="../images/logotipo.png" alt="logotipo" style="width: 100%;"></div>

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

            <div id="link">Biblioteca</div>

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
    <!--Fin Menu admin-->

    <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">

        <div id="contenedor-biblioteca" class="card" style="width: calc(70% - 102px); margin-top: -195px; left: 50%; top: 50%; position: absolute; margin-left: -34%;">

            <div id="seccion-form" style="width: calc(100% - 62px); background-color: white; padding: 30px; margin-bottom: 20px; float: left; border-radius: 15px; margin-top: 20px;">
            
                <div id="titulo" style="width: 100%; margin-bottom: 20px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Modificar libro</div>
             
                 <form id="form1" name="form1" action="modificarlibro.php" method="post" enctype="multipart/form-data">

                 <input id="idlibro"  name="idlibro" value="<?php echo $idlibro; ?>" type="hidden">

                 <input id="archivoactual"  name="archivoactual" value="<?php echo $archivoactual; ?>" type="hidden">

                    <input id="titulolibro" name="titulolibro" type="text" value="<?php echo $tituloactual; ?>" placeholder="Ingresa un título para el libro" style="font-size: 12px; width: 100%; margin: 10px 0; box-sizing: border-box; margin-bottom: 10px; padding: 10px 10px; border: none; background-color: #DDE3EC; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>

                    <input id="archivo" name="archivo" type="file" accept="application/pdf" style="width: 100%; margin-bottom: 20px;">

                    <div align="center" style="width: calc(100% - 40%); margin-left: 25%; float: left;">

                        <button type="submit" style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #7FDBFF; margin-top: 15px; width:150px; color: #fff; background-color: #1d4267; float: left; margin-right: 50px;">GUARDAR</button>
                        
                        <input type="button" name="Cancelar" value="Cancelar" onclick="window.location='biblioteca.php'" style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #848a90; margin-top: 15px; width: 150px; color: #fff; background-color: #838e98; float: left; text-transform: uppercase;">
                       
                </div>
     
                </form>
     
            </div>

        </div>

    </div>

</div>


</body>
</html>

