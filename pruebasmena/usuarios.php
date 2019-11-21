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
$query_Recordset7 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset7 = mysql_query($query_Recordset7, $conamatenlinea) or die(mysql_error());
$row_Recordset7 = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7); 

$permiso = $row_Recordset7['permiso'];

if ($permiso != 1) {

header("Location: index.php");
exit;

}

if ($_POST) {

$usuario11 = $_POST['miembro'];
$pass = $_POST['contra'];
$permiso = $_POST['permiso'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM usuarios WHERE usuario = '$usuario11'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

if ($totalRows_Recordset2 > 0) $error = "Ya hay un usuario con ese nombre";

if ($totalRows_Recordset2 == 0) {

mysql_query("INSERT INTO usuarios(usuario, contrasena, permiso) VALUES('$usuario11', '$pass', '$permiso')"); 

mysql_query("INSERT INTO actividad(accion, usuario, fecha) VALUES( 'Creó usuario', '$usuario', '$unixtime')"); 

header("Location: usuarios.php");
exit;

}


}

        mysql_select_db($database_conamatenlinea, $conamatenlinea);
        $query_Recordset1 = "SELECT * FROM usuarios";
        $Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
        $row_Recordset1 = mysql_fetch_assoc($Recordset1);
        $totalRows_Recordset1 = mysql_num_rows($Recordset1); 

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
<title>Conamat en línea | admin</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
 
$(document).ready(function(){
 
        $("#seccion-form").hide();
 
    $('#agregar').click(function(){
	 var agr = $('#agregar').text();
	 if (agr == "Agregar usuario") {
	 $('#agregar').html('<a href="javascript:void()" id="agregar">Cerrar</a>')
	 } else {
	 $('#agregar').html('<a href="javascript:void()" id="agregar">Agregar usuario</a>')
	 }
    $("#seccion-form").slideToggle( "slow" );
    });
 
});
 
</script>
<script>
function validaenvia() {

if (document.form1.miembro.value == "") {
alert("Por favor escribe el nombre del usuario");
document.form1.miembro.focus();
return false;
}

if (document.form1.contra.value == "") {
alert("Por favor escribe la contraseña");
document.form1.contra.focus();
return false;
}

}
</script>
<script>

function eliminar(id) {

if (confirm("¿Estás seguro de eliminar este usuario?")==1) {

location.href="eliminarusuario.php?id="+id;

}

}

</script>
<script>

function modificar(id) {

location.href="modificarusuario.php?id="+id;

}

</script>
</head>
<style>
html,body{height:100%;margin:0;padding:0;
    font-family: 'Montserrat', sans-serif; background-color: #0b2c4d;}
body:before{
    width:100%;
    height:100%;
    display:block;
    font-family: 'Montserrat';
}
	
.titulo{
    text-transform: uppercase;
    font-family: 'Montserrat', sans-serif;
    padding: 20px 0px;
    text-align: center;
    font-size: 30px;
}

.subtitulo{
    font-family: 'Montserrat', sans-serif;
    margin: 10px 0px;
    text-align: center;
    font-size: 18px;
}	
	
.menu-card {
    border-radius: 5px;
    border: 0px solid transparent;
    -webkit-box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
    width: 23%;
    box-sizing: border-box;
    padding: 15px 10px;
    margin: 0 1%; 
    background-color: #fff;
    float: left;

}
.mensajes-row{
    color: #343a40;
    font-size: 14px;
    padding: 5px 10px;
    float: left;
    width: 100%;
    box-sizing: border-box;
    border-bottom: 1px solid #efefef;

}
.row{
    float:left;
    width: 100%;
    background-color: white; 
    height: 30px;
}
.cell{
    float: left; 
    width: calc(20% - 2px);
    border: 1px solid lightgray;
    line-height: 30px;
    text-align: center;
}
.linea{
    border-bottom: 1px solid #7FDBFF;
    height: 0px;
    width: 100%;
    float: left;
}

#link{
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

.mensajes-row{
    color: #343a40;
    font-size: 14px;
    padding: 5px 10px;
    float: left;
    width: 100%;
	border-bottom:2px #333 solid;
	background-color:#efefef;
    box-sizing: border-box;

}
.nostyle a:link{
    text-decoration: none;
    color: black;
}

.nostyle a:visited{
    text-decoration: none;
    color: black;
}
.toprow{
    float:left;
    width: 100%;
    background-color: #0b2c4d; 
    color: white;
    height: 50px;
}
.topcell{
    float: left; 
    width: calc(20% - 2px);
    line-height: 50px;
    text-align: center;
}
.row{
    height: 50px;
    float:left;
    width: 100%;
    background-color: white; 
}
.cell{
    float: left; 
    width: calc(20% - 2px);
    border: 1px solid lightgray;
    line-height: 50px;
    height: 50px;
    text-align: center;
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



</style>
<body>

<div id="wrapper" style="width:100%; background-color: #0b2c4d; float:left; margin:0px; height:100%;">

<!--Menu del admin-->
<div id="adminmenu" style="float: left; box-shadow: 0px 0px 10px #000; width: 20%; background-color: #1d4267; position: fixed; height: 100%; overflow: scroll;">

        <div id="logotipo" align="center" style="float: left; width: calc(100% - 60px); padding-top: 50px; padding-bottom: 30px; padding-right: 30px; padding-left: 30px;"><img src="../images/logotipo.png" alt="logotipo" style="width: 100%;"></div>


        <div id="etiquetaadmin" style="font-family: 'Montserrat', sans-serif; float: left; width: calc(80% - 20px); margin-left: 10%; margin-top: 20px; margin-bottom: 50px; text-align: center; padding: 10px; border: 1px solid white; color: white; font-size: 18px; border-radius: 20px;">Menú admin</div>

        <div id="navegacion" style="width: 100%; float: left; margin-bottom: 20px;">
                    
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
            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="actividad.php">Actividad</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <div id="link">Usuarios</div>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
            <a class="menu" href="logout.php">Salir</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

        </div>

    </div>


<div id="seccion-main" style="width: 80%; float: left; height:100%; margin-left:20%;"><!-- Fin seccion-form --><!-- Fin de menu-card -->

<div class="menu-card" style="float: left; width: 90%; margin: 0 5%; box-sizing: border-box; margin-top: 20px;">

                <div id="tituloprincipal" align="center" style="padding-top: 50px; font-family: 'Montserrat', sans-serif; padding-bottom: 50px; font-size: 30px; color: #333; padding-left: 20px; letter-spacing: 1.6px;">Usuarios registrados</div>
                
                <div id="agregar" class="nostyle" align="center" style="font-size: 16px; margin-bottom: 20px; font-weight:bold;"><a href="javascript:void(0);" id="agregar">Agregar usuario</a></div>
                
                <div id="seccion-form" style="width: calc(50% - 62px); height: 360px; background-color: white; padding: 30px; margin-left: 25%; margin-bottom: 20px; float: left; border-radius: 15px; border:1px solid #333;  box-shadow: 0 0 20px rgba(0, 0, 0, 0.08); margin-top: 20px;">
		
		<div id="titulo" style="width: 100%; margin-bottom: 20px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Crear usuario</div>
		 
		 <form id="form1" name="form1" action="usuarios.php" method="post" onSubmit="return(validaenvia())" enctype="multipart/form-data">

        	<input id="miembro" name="miembro" type="text" value="<?php echo $usuario11; ?>" placeholder="Escribe un nombre de usuario" style="font-size: 12px; width: 100%; margin: 10px 0; box-sizing: border-box; padding: 10px 10px; border: none; background-color: #DDE3EC; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>

        	<input id="contra" name="contra" type="password" placeholder="Escribe una contraseña" style="font-size: 12px; width: 100%; margin: 10px 0; box-sizing: border-box; padding: 10px 10px; border: none; background-color: #DDE3EC; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        	
        	<div id="subtitulo" style="width: 100%; margin-top: 10px; text-align: left; font-size: 13px; color: #58575d;">Selecciona un tipo permiso para el nuevo usuario.</div>
		 
        	<select id="permiso" name="permiso" style="float: left; width: 100%; margin: 10px 0; box-sizing: border-box; padding: 10px 10px; font-size: 15px; color: gray;">
        		
        		<option value="1">Total</option>

                <option value="2">Contenido página</option>

                <option value="3">Plataforma educativa</option>

        	</select>

            <div align="center" style="width: 100%; float: left;">

                <button style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #7FDBFF; margin-top: 15px; width:200px; color: white; background-color: #244267;">AGREGAR</button>

            </div>
 
		</form>
    	
    </div> <!-- Fin seccion-form -->

                    <div class="toprow">

                        <div class="topcell">No.</div>
                        <div class="topcell">NOMBRE</div>
                        <div class="topcell">PERMISOS</div>       
                        <div class="topcell"></div>
                        <div class="topcell"></div>

                    </div>
                    
                     <?php if ($totalRows_Recordset1 > 0) { ?>
                     
                     <?php $n = 0; do { $n = $n + 1; ?>
                      <div class="row">
                        <div class="cell"><?php echo $n; ?></div>
                        <div class="cell"><?php echo $row_Recordset1['usuario']; ?></div>   
                        <div class="cell"><?php 
                        if ($row_Recordset1['permiso'] == 1){

                            echo "Total";

                        } else if ($row_Recordset1['permiso'] == 2) {

                            echo "Contenido";

                        } else {

                            echo "Plataforma";
                        
                        }
                         
                        

                        ?></div>  
                        <div class="cell"><?php if ($usuario != $row_Recordset1['usuario']) { ?><button style="width:80%; float:left; margin-left:10%; height:36px; line-height:36px; background-color: #3D9970; color:white; cursor: pointer; margin-top:5px;" onClick="javascript:modificar('<?php echo $row_Recordset1['id']; ?>');">Modificar</button><?php } ?></div>
                        <div class="cell"><?php if ($usuario != $row_Recordset1['usuario']) { ?><button style="width:80%; float:left; margin-left:10%; height:36px; line-height:36px; background-color:#FF4136; color:white; margin-top:5px; cursor: pointer;" onClick="javascript:eliminar('<?php echo $row_Recordset1['id']; ?>');">Eliminar</button><?php } ?></div>
                        </div>
                     <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                     <?php } ?>
    
</div> <!-- Fin seccion main--> 

</div>

</div>
</body>
</html>
<?php if ($error != '') { ?>
<script>
alert("<?php echo $error; ?>");
</script>
<?php } ?>
