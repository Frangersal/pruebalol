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

if ($permiso != "administrador") {
header("Location: index.php");
exit;
}

if ($_POST) {

$usuario11 = $_POST['usuario'];
$pass = $_POST['contrasena'];
$permiso = $_POST['permiso'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM usuarios WHERE usuario = '$usuario11'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

if ($totalRows_Recordset2 > 0) $error = "Ya hay un usuario con ese nombre";

if ($totalRows_Recordset2 == 0) {

mysql_query("INSERT INTO usuarios(usuario, contrasena, permiso, fecha) VALUES('$usuario11', '$pass', '$permiso')"); 

header("Location: usuariosbd.php");
exit;

}

}

        mysql_select_db($database_conamatenlinea, $conamatenlinea);
        $query_Recordset1 = "SELECT * FROM usuarios";
        $Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
        $row_Recordset1 = mysql_fetch_assoc($Recordset1);
        $totalRows_Recordset1 = mysql_num_rows($Recordset1);?> 
<!--Fin del PHP-->

<!doctype html>

<html>

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Usuarios</title>

 <!--Librerias-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

 <!--Javascript-->
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
        
        //
        function validaenvia() {

        if (document.form1.usuario.value == "") {
        alert("Por favor escribe el nombre del usuario");
        document.form1.usuario.focus();
        return false;
        }

        if (document.form1.pass.value == "") {
        alert("Por favor escribe la contraseña");
        document.form1.pass.focus();
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

        location.href="editarusuario.php?id="+id;

        }

    </script>

    <SCript>
        
            $('#adminmenu').hover("background","black");
        }
    </SCript>

</head>

 <!--Fin del Javascript-->

<!--Estilos CSS-->
<style>
html,body{height:100%;margin:0;padding:0;font-size: 12px;
    font-family: 'Montserrat', sans-serif;}
body:before{
    width:100%;
    height:100%;
    display:block;
}
	
.titulo{
    text-transform: uppercase;
    font-family: 'Montserrat', sans-serif;
    padding: 20px 0px;
    text-align: center;
    font-size: 30px;
    font-weight: bold;
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
.top-row{
    background: rgb(232, 233, 239);
    color: rgb(134, 142, 150);
    font-size: 12px;
    text-transform: uppercase;
    width: 100%;
    padding: 5px 10px;
    float: left;
    width: 100%;
    box-sizing: border-box;

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
.cell{
    text-align: center;
    float: left;
    width: 20%;
    line-height: 50px;
    max-height: 70;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}
.top-cell{
    text-align: center;
    float: left;
    width: 20%;
}

#menuadmin a:link {
	display:block;
	padding-left:10px;
	width:calc(100% - 10px);
	height:40px;
	line-height:40px;
	color: #080032;
	text-decoration:none;
	font-size:16px;
	font-weight:bold;
}

#menuadmin a:active {
	display:block;
	height:40px;
	padding-left:10px;
	width:calc(100% - 10px);
	line-height:40px;
	color: #080032;
	text-decoration:none;
	font-size:16px;
	font-weight:bold;
}

#menuadmin a:visited {
	display:block;
	height:40px;
	line-height:40px;
	padding-left:10px;
	width:calc(100% - 10px);
	color: #080032;
	text-decoration:none;
	font-size:16px;
	font-weight:bold;
}

#menuadmin a:hover {
	display:block;
	background-color:#080032;
	color: #fff;
	text-decoration:none;
}

#link {
	display:block;
	background-color:#080032;
	color: #fff;
	text-decoration:none;
	padding-left:10px;
	width:calc(100% - 10px);
	height:40px;
	line-height:40px;
	font-size:16px;
	font-weight:bold;
}
.top-row{
    background: #000;
    color: #fff;
    font-size: 12px;
    text-transform: uppercase;
    width: 100%;
    padding: 5px 10px;
    float: left;
    width: 100%;
    box-sizing: border-box;
	margin-top:20px;

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
.cell{
    text-align: center;
    float: left;
    width: 20%;
    line-height: 50px;
    max-height: 70;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.top-cell{
    text-align: center;
    float: left;
    width: 20%;
}
a:link {
color:#333;
}
a:visited {
color:#333;
}
a:active {
	color:#333;
}
a:hover {
	color:#333;
}

</style>
<!--Fin estilos CSS-->

<body>

<div id="wrapper" style="width:100%; float:left; margin:0px; height:100%;">

<div id="adminmenu" style="background-color: white; float: left; width: calc(20% - 2px); height:100%; display:block; border-right:solid 2px #000; position:fixed;">

    <div id="adminlogo" align="center" style="padding: 50px;">

        <a href="index.php"><img src="../images/logo.png" style="width: 100%;" alt=""></a>

		<div id="titulo" style="width: 100%; margin-top: 10px; text-align: center; font-size: 20px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Menu del Admin</div>

    <div id="linea" style="border-bottom: 2px solid #333; height: 0px; width: 20%; margin: 10px 0;"></div>

    </div>

    <div id="linea" style="border-bottom: 1px solid #d0d0d0; height: 0px; width: 100%;"></div>
    
    <div id="menuadmin" style="width:100%; float:left;">
    
    <a href="index.php">Inicio</a>
    
     <div id="linea" style="border-bottom: 1px solid #d0d0d0; height: 0px; width: 100%;"></div>
     
     <a href="actividades.php">Actividades</a>
     
     <div id="linea" style="border-bottom: 1px solid #d0d0d0; height: 0px; width: 100%;"></div>

    <a href="email.php">Email</a>
    
    <div id="linea" style="border-bottom: 1px solid #d0d0d0; height: 0px; width: 100%;"></div>

    <a href="historia.php">Historia</a>
    
    <div id="linea" style="border-bottom: 1px solid #d0d0d0; height: 0px; width: 100%;"></div>

    <a href="planteles.php">Planteles</a>
    
    <div id="linea" style="border-bottom: 1px solid #d0d0d0; height: 0px; width: 100%;"></div>
    
    <a href="secciones.php">Secciones</a>
    
    <div id="linea" style="border-bottom: 1px solid #d0d0d0; height: 0px; width: 100%;"></div>
    
    <div id="link">Usuarios</div>
    
    <div id="linea" style="border-bottom: 1px solid #d0d0d0; height: 0px; width: 100%;"></div>
    
    <a href="logout.php">Salir</a>
    
    <div id="linea" style="border-bottom: 1px solid #d0d0d0; height: 0px; width: 100%;"></div>

</div>
</div>

<div id="seccion-main" style="width: 80%; float: left; background-color: #080032; height:100%; margin-left:20%;"><!-- Fin seccion-form -->

<div class="menu-card" style="float: left; width: 90%; margin: 0 5%; box-sizing: border-box; margin-top: 20px;">

               	<h3 align="center" style="font-size: 20px;">Usuarios Registrados</h3>
                
                <div id="agregar" align="center" style="font-size: 16px; margin-top:20px; font-weight:bold;"><a href="javascript:void(0);" id="agregar">Agregar usuario</a></div>
                
                <div id="seccion-form" style="width: 50%; height: 360px; background-color: white; box-sizing: border-box; padding: 30px; margin: 5%; border-radius: 15px; border:#333 solid 1px; margin: 0 auto; box-shadow: 0 0 20px rgba(0, 0, 0, 0.08); margin-top: 20px;">
		
		<div id="titulo" style="width: 100%; margin-bottom: 20px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Crear usuario</div>
		 
		 <form id="form1" name="form1" action="usuariosbd.php" method="post" onSubmit="return(validaenvia())" enctype="multipart/form-data">

        	<input id="miembro" name="miembro" type="text" value="<?php echo $usuario11; ?>" placeholder="Escribe un nombre de usuario" style="font-size: 12px; width: 100%; margin: 10px 0; box-sizing: border-box; padding: 10px 10px; border: none; background-color: #DDE3EC; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>

        	<input id="contra" name="contra" type="password" placeholder="Escribe una contraseña" style="font-size: 12px; width: 100%; margin: 10px 0; box-sizing: border-box; padding: 10px 10px; border: none; background-color: #DDE3EC; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        	
        	<div id="subtitulo" style="width: 100%; margin-top: 10px; text-align: left; font-size: 13px; color: #58575d;">Selecciona un tipo permiso para el nuevo usuario.</div>
		 
        	<select id="permiso" name="permiso" style="float: left; width: 100%; margin: 10px 0; box-sizing: border-box; padding: 10px 10px; font-size: 15px; color: gray;">
        		
        		<option value="administrador">Administrador</option>
                <option value="editor">Editor</option>
        	</select>

            <div align="center" style="width: 100%; float: left;">

                <button style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #43c077; margin-top: 15px; width:200px; color: white; background-color: #43c077;">AGREGAR</button>

            </div>
 
		</form>
    	
    </div> 
    <!-- Fin seccion-form -->

                    <div class="top-row">

                        <div class="top-cell" style="width: 20%;">No.</div>
                        <div class="top-cell" style="width: 20%;">NOMBRE</div>
                        <div class="top-cell" style="width: 20%;">PERMISOS</div>       
                        <div class="top-cell" style="width: 20%;">EDITAR</div>
                        <div class="top-cell" style="width: 20%;">ELIMINAR</div>

                    </div>
                    
                     <?php if ($totalRows_Recordset1 > 0) { ?>
                     
                     <?php $n = 0; 
                     do { $n = $n + 1; ?>
                      <div class="mensajes-row">
                        <div class="cell" style="width: 20%; he"><?php echo $n; ?></div>
                        <div class="cell" style="width: 20%;"><?php echo $row_Recordset1['usuario']; ?></div>   
                        <div class="cell" style="width: 20%;"><?php echo $row_Recordset1['permiso']; ?></div>  
                        <div class="cell" style="width: 20%;"><?php if ($usuario != $row_Recordset1['usuario']) { ?><button  class="fas fa-edit" style="width:80%; float:left; margin-left:10%; height:36px; line-height:36px; background-color:#366730; color:#fff; margin-top:5px;" onClick="javascript:modificar('<?php echo $row_Recordset1['id']; ?>');">Modificar</button><?php } ?></div>
                        <div class="cell" style="width: 20%;"><?php if ($usuario != $row_Recordset1['usuario']) { ?><button style="width:80%; float:left; margin-left:10%; height:36px; line-height:36px; background-color:#810103; color:#fff; margin-top:5px;" onClick="javascript:eliminar('<?php echo $row_Recordset1['id']; ?>');">Eliminar</button><?php } ?></div>
                        </div>
                     <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
                     ?>
                     <?php } ?>
    
</div> 
<!-- Fin seccion main--> 

</div>

</div>
</body>
</html>

<?php if ($error != '') { ?>

    <script>
    alert("<?php echo $error; ?>");
    </script>

<?php } ?>
