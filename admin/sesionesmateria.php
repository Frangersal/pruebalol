<?php require_once('../Connections/conamatenlinea.php');

session_start();
$usuario = $_SESSION['usuario'];
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
    padding: 20px 30px;
}
	
.progress-wrp {
            position: relative;
            border-radius: 3px;
            margin: 0px;
            text-align: left;
            background: #7FDBFF;
            color: white;
        }

.progress-bar {
            height: 45px;
            width: 0;
            background-color: #0b2c4d;
            line-height: 45px;
        }

.status {
            top: 3px;
            left: 0%;
            width: 100%;
            text-align: center;
            position: absolute;
            line-height: 45px;
            display: inline-block;
            color: #000000;
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

 #botonagregar:hover{
    text-decoration: underline;
}
#cerrar:hover{
    text-decoration: underline
}

</style>
<!--Fin estilos CSS-->

<!--Javascript-->
<script type="text/javascript" >
	
	function guardarform() {
		
        if ($("#nombreactividad").val() == '') {

            alert("Por favor escribe el nombre de la actividad");
            $("#nombreactividad").focus();
            return false;

        }

        if ($("#tipoactividad").val() == '') {

            alert("Por favor el tipo de actividad de la materia");
            $("#tipoactividad").focus();
            return false;

        }

        if (document.actividadform.bloque.checked == "") {

            alert("Por favor selecciona los bloques en los que estara la actividad");
            document.actividadform.bloque.focus();
            return false;

        }

        alert("Se ha agregado la actividad correctamente");

        $("#ventana-actividad").hide();
        
        location.reload();

	}
	
	function agregar_sesion() {

        var numsesiones = parseInt($("#numsesiones").val()) + 1;

        $("#numsesiones").val(numsesiones);

        $("#seccionprincipal").append('<div id="contenedorsesion'+numsesiones+'" align="center" style="width: 90%;margin-left: 25%;float: left;margin-top: 20px;margin-bottom: 20px;margin: 20px 5%;"> <div id="sesion'+numsesiones+'" align="center" style="width: calc(100% - 28px);float: left;border: 4px double #ccc;padding: 10px;margin-bottom: 40px;border-radius: 6px;"> <div id="cerrar" style="float:right; cursor:pointer; color:red; font-weight: bold;" onclick="eliminarsesion('+numsesiones+')">Eliminar sesion</div> <div id="titulosesion'+numsesiones+'" align="center" style="width: 100%; float: left; font-size: 18px; text-transform: uppercase; font-family: Montserrat, sans-serif; margin-top: 20px; margin-bottom: 20px; font-weight: bold; letter-spacing: 2px; color: #000;">Sesión '+numsesiones+'</div> <div id="contenedorboton'+numsesiones+'" align="center" style="width: 100%; float: left; margin-top: 30px; margin-bottom: 30px;"> <button type="button" onclick="agregar_actividad('+numsesiones+');" style="border-radius: 10px; line-height: 30px; background-color: #1d4267; border-color: #7FDBFF; padding-left: 20px; padding-right: 20px; color: #7FDBFF; cursor: pointer;">Agregar actividad</button> </div> </div> </div>');

	}

    function eliminarsesion() {

        alert("¿Deseas eliminar esta sesion?");

        var numsesiones = parseInt($("#numsesiones").val());

            $("#contenedorsesion"+numsesiones).remove();
        
            numsesiones = numsesiones - 1;

            $("#numsesiones").val(numsesiones);

    }
	
	function agregar_actividad() {
		
        $("#ventana-actividad").show();

	}

    function cancelar() {
        $("#ventana-actividad").hide();
    }
	
</script>
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

    <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%; background-color: #fff;">
    	
    	<div id="tituloseccion" align="center" style="width: 100%; float: left; font-size: 18px; text-transform: uppercase; font-family: 'Montserrat', sans-serif; margin-top: 30px; margin-bottom: 30px; font-weight: bold; letter-spacing: 2px;">SESIONES DE LA MATERIA</div>
    	
    	<div id="contenedorboton" align="center" style="width: 100%; float: left; margin-top: 30px; margin-bottom: 30px;">
    		
    		<button type="button" onclick="agregar_sesion();" style="border-radius: 10px; line-height: 30px; background-color: #1d4267; border-color: #7FDBFF; padding-left: 20px; padding-right: 20px; color: #7FDBFF; cursor: pointer;">Agregar sesión</button>
    		
        </div>
        
        <input type="hidden" id="numsesiones" name="numsesiones" value="1">
		
		<div id="contenedorsesion" align="center" style="width: 90%;margin-left: 25%; float: left; margin-top: 20px; margin-bottom: 20px; margin: 20px 5%;">
		
            <div id="sesion" align="center" style="width: calc(100% - 28px); float: left; border: 4px double #ccc;padding: 10px; margin-bottom: 40px; border-radius: 6px;"> 
				
				<div id="titulosesion" align="center" style="width: 100%; float: left; font-size: 18px; text-transform: uppercase; font-family: 'Montserrat', sans-serif; margin-top: 20px; margin-bottom: 20px; font-weight: bold; letter-spacing: 2px; color: #000;">Sesión 1</div>
				
				<div id="contenedorboton" align="center" style="width: 100%; float: left; margin-top: 30px; margin-bottom: 30px;">
    		
    				<button type="button" onclick="agregar_actividad();" style="border-radius: 10px; line-height: 30px; background-color: #1d4267; border-color: #7FDBFF; padding-left: 20px; padding-right: 20px; color: #7FDBFF; cursor: pointer;">Agregar actividad</button>
    		
    			</div>
				
				
			</div>
			
		</div> <!--Fin contenedor sesión-->
		
		<div id="ventana-actividad" style="width: 60%; margin-left: 22%; margin-top: 20px; float: left;margin-bottom: 20px; display:none; border: 1px solid rgb(204, 204, 204); position: absolute; top: 20%; background: aliceblue; box-shadow: 1px 4px 7px rgba(46,45,41,0.50);">
		
		<form id="actividadform" name="actividadform" action="" enctype="multipart/form-data" method="post" onsubmit="return(guardarform())">
		
			<div id="tituloactividad" align="center" style="width: 100%; float: left; font-size: 18px; text-transform: uppercase; font-family: 'Montserrat', sans-serif; margin-top: 20px; margin-bottom: 20px; font-weight: bold; letter-spacing: 2px; color: #000;">Actividad</div>
			
            <div id="contenedornombre" align="center" style="width: 70%; margin-left: 15%; margin-right: 15%; float: left;">
         
				<div id="titulo" style="float: left; width: 26%; font-size: 14px; font-family: 'Open Sans', sans-serif; margin-right: 10px; margin-top: 5px; color: #000; text-align: left;">Nombre</div>
				
				<input id="nombreactividad" name="nombreactividad" placeholder="Escribe un nombre" style="width: 69%; resize: none; font-size: 12px; margin-bottom: 10px; padding: 5px; float: left; border: 1px solid #ccc;" type="text" value="">
				
			</div>
			
		   
		   <div id="contenedortipo" align="center" style="width: 70%; margin-left: 15%; margin-right: 15%; float: left;">
				
				<div id="titulotipo" style="float: left; width: 26%; font-size: 14px; font-family: 'Open Sans', sans-serif; margin-right: 10px; margin-top: 5px; color: #000; text-align: left;">Tipo de actividad</div>
				
				<select id="tipoactividad" name="nombreactividad" style="width: 71%; resize: none; font-size: 12px; margin-bottom: 10px; padding: 5px; float: left; border: 1px solid #ccc;">
				
					<option value="">Selecciona una opción</option>
                    <option value="1">Crucigrama</option>
                    <option value="2">Sopa de letras</option>
                    <option value="3">Completa la frase</option>
                    
			   </select>
			   
		   </div>
		   
		   
		   <div id="bloquespertenecientes" align="center" style="width: 70%; margin-left: 15%; margin-right: 15%; float: left;">
		   
				<div id="titulo" align="center" style="float: left; width: 100%; font-size: 14px; font-family: 'Open Sans', sans-serif; margin-right: 10px; margin-top: 10px; color: #000; margin-bottom: 10px;">Bloques a los que pertenece la actividad</div>
				
				<div id="opciones" align="center" style="width: 100%; float: left; color: #000; font-family: 'Montserrat', sans-serif; font-size: 12px;">
			   		
					<div class="opcion" style="float: left; margin-right: 15px;">
					
						<input id="bloque" type="checkbox" checked="checked">Bloque 1.
						
					</div>
					
			   		<div class="opcion" style="float: left; margin-right: 15px;">
					
						<input type="checkbox" checked="checked">Bloque 2.
						
					</div>
			   	
			   		
			   		<div class="opcion" style="float: left; margin-right: 15px;">
					
						<input type="checkbox" checked="unchecked">Bloque 3.
						
					</div>
			   	
			   		
			   		<div class="opcion" style="float: left; margin-right: 15px;">
					
						<input type="checkbox">Bloque 4.
						
					</div>
			   	
			   		
			   		<div class="opcion" style="float: left; margin-right: 15px;">
					
						<input type="checkbox">Bloque 5.
						
					</div>

			   	</div>
		   
		  </div>
	   	
	   	  <div id="contenedorboton" align="center" style="width: 100%; float: left; margin-top: 30px; margin-bottom: 30px;">
    		
                    <button type="button" onclick="guardarform('0');" style="border-radius: 10px; line-height: 30px; background-color: #1d4267; border-color: #7FDBFF; padding-left: 20px; padding-right: 20px; color: #7FDBFF; cursor: pointer;">Guardar</button>
                    
                    <button type="button" onclick="cancelar('');" style="border-radius: 10px;line-height: 30px;background-color: #979a9d;border-color: #d9d9d9;padding-left: 20px;padding-right: 20px;color: #ebebeb;cursor: pointer;">Cancelar</button>
    		
    	 </div>
		   	
	</form>	
		
		</div> <!--Fin de ventana actividad-->
    	
	</div> <!--Fin de sección principal-->
	
</div> <!--Fin wrapper-->

</body>
</html>