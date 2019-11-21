<?php require_once('../Connections/conamatenlinea.php');
session_start();

if ($_SESSION['usuario'] == "") {
    
    header("Location: login.php");

}else{

    $usuario = $_SESSION['usuario'];
    $unixtime = time();

}

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM materias GROUP BY id DESC";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$permiso = $row_Recordset2['permiso'];

if ($permiso == 2) {

header("Location: index.php");
exit;

}
if ($_POST) { 

    $nombre = $_POST['nombremateria'];
    $clave = $_POST['clavemateria'];
    $id = $_POST['idmateria'];

    mysql_select_db($database_conamatenlinea, $conamatenlinea);
    $query_Recordset3 = "SELECT * FROM materias WHERE nombre = '$nombre'";
    $Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
    $row_Recordset3 = mysql_fetch_assoc($Recordset3);
    $totalRows_Recordset3 = mysql_num_rows($Recordset3);

    if ($totalRows_Recordset3 > 0) $error = "Ya hay una materia con ese nombre";

    if ($totalRows_Recordset3 == 0) {

           mysql_query("INSERT INTO materias(nombre, clave) VALUES('$nombre', '$clave')");

           mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Modificó materia', '$unixtime')"); 
    }

   header("Location: materias.php");
   exit;
}
   
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
    background-color: white;
    padding: 20px 50px;
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
#librolink:hover{
    background-color: #0b2c4d; 
    color: white;
}

</style>
<!--Fin estilos CSS-->

<!--Javascript-->
<script type="text/javascript" >

function nuevo(){
    
    $("#seccion-form").slideToggle("fast");

    var boton = $("#botonagregar");

    if (boton.text() == "Agregar materia") {

        boton.text("Cerrar")
    
    } else {

        boton.text("Agregar materia")
    
    }
 

}

function eliminar(id) {

    if (confirm("¿Estás seguro de eliminar esta materia?") == 1) {

        location.href="eliminarmateria.php?id="+id;

    }

}

function modificar(id) {

    location.href="modificarmateria.php?id="+id;

}


</script>
<!--Fin Javascript-->

</head>
<body>

<div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

    <div id="adminmenu" style="float: left; box-shadow: 0px 0px 10px #000; overflow: scroll; width: 20%; background-color: #1d4267; position: fixed; height: 100%; overflow: scroll;">

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

            <a class="menu" href="biblioteca.php">Biblioteca</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="cursos.php">Cursos</a>
            
            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="maestros.php">Maestros</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <div id="link">Materias</div>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="pagos.php">Pagos</a>

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

    <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">

        <a href="Javascript:void(0)" onclick="nuevo()"><div id="botonagregar" align="center" style="color: white; width: 100%; float: left; padding-top: 20px; padding-bottom: 20px; cursor: pointer; font-size: 16px; font-family: 'Montserrat', sans-serif; background: #305b84;text-decoration: underline;">Agregar materia</div></a>

        <div id="contenedoragregar" align="center" style="width: 100%; float: left;">

            <div id="seccion-form" style="width: calc(100% - 62px); background-color: white; padding: 30px; margin-bottom: 40px; float: left; display: none;">
    
                <div id="titulo" style="width: 100%; margin-bottom: 20px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Nueva materia</div>
                 
                 <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data">

                    <input id="nombremateria" name="nombremateria" type="text" value="" placeholder="Ingresa un nombre para la materia" style="font-size: 12px; width: 100%; margin: 10px 0; box-sizing: border-box; margin-bottom: 10px; padding: 10px 10px; border: none; background-color: #DDE3EC; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>

                    <input id="clavemateria" name="clavemateria" type="text" value="" placeholder="Ingresa la clave de la materia" style="font-size: 12px; width: 100%; margin: 10px 0; box-sizing: border-box; margin-bottom: 10px; padding: 10px 10px; border: none; background-color: #DDE3EC; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>

                    <div align="center" style="width: 100%; float: left;">

                        <button style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #7FDBFF; margin-top: 15px; width:200px; color: white; background-color: #244267;">AGREGAR</button>

                    </div>
         
                </form>

            </div>

        </div>
 

        <div id="contenedor-materias" class="card" style="width:calc(100% - 100px); float: left;">

            <div id="titulo" align="center" style="padding-top: 20px; font-family: 'Montserrat', sans-serif; font-size: 35px; color: #333; font-weight: bold; padding-left: 20px; line-height: 90px; letter-spacing: 1.6px;">Materias</div>
           
            <div id="tablamaterias" style="float: left; margin-bottom: 100px; width: 100%;">
    
                <div class="toprow">
                    <div class="topcell" style="width: 10%;">No.</div>
                    <div class="topcell" style="width: 40%;">Nombre</div>
                    <div class="topcell" style="width: 20%;">Clave</div>
                    <div class="topcell" style="width: 15%;"></div>
                    <div class="topcell" style="width: 15%;"></div>
                </div>

<?php 

    if($totalRows_Recordset1 > 0){
        
        $contador = 1;

        do{
        
 
            $nombre = $row_Recordset1['nombre'];
            $clave = $row_Recordset1['clave'];
            $id = $row_Recordset1['id'];

?>
                <div class="row">
                    <div class="cell" style="width: calc(10% - 2px);"><?php echo $contador; ?></div>
                    <div id="materia" class="cell" style="width: calc(40% - 2px);"><?php echo $nombre; ?></div>
                    <div id="clave" class="cell" style="width: calc(20% - 2px);"><?php echo $clave; ?></div>
                    <div class="cell" style="width: calc(15% - 2px);"><button style="width:100%; float:left; height:30px; line-height:30px; background-color: #3D9970; color:white; border: none; cursor: pointer;" onClick="javascript:modificar('<?php echo $id; ?>');">Modificar</button></div>
                    <div class="cell" style="width: calc(15% - 2px);"><button style="width:100%; float:left; height:30px; line-height:30px; background-color:#FF4136; border: none; color:white; cursor: pointer;" onClick="javascript:eliminar('<?php echo $id; ?>');">Eliminar</button></div>
                </div>

<?php
            $contador = $contador + 1;
    
        }while( $row_Recordset1 =  mysql_fetch_assoc($Recordset1));

    } else {

?>

    <div id="nohay" style="float: left; line-height: 50px; width: 100%; text-align: center;">No se encontraron materias registradas.</div>

<?php

    }

?>

            </div>
            
        </div>

    </div>
    
</div>


</body>
</html>
