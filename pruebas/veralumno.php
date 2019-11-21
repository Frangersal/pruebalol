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

$nombre = stripslashes(stripslashes($row_Recordset2['nombrealumno']));
$apellidopaterno = stripslashes(stripslashes($row_Recordset2['apellidopaterno']));
$apellidomaterno = stripslashes(stripslashes($row_Recordset2['apellidomaterno']));
$sexo = $row_Recordset2['sexo'];
$dia = $row_Recordset2['dia'];
$mes = $row_Recordset2['mes'];
$ano = $row_Recordset2['ano'];
$matricula = stripslashes(stripslashes($row_Recordset2['matricula']));
$curp = stripslashes(stripslashes($row_Recordset2['curp']));
$calle = stripslashes(stripslashes($row_Recordset2['calle']));
$numeroext = stripslashes(stripslashes($row_Recordset2['numeroext']));
$numeroint = stripslashes(stripslashes($row_Recordset2['numeroint']));
$colonia = stripslashes(stripslashes($row_Recordset2['colonia']));
$telefono = stripslashes(stripslashes($row_Recordset2['telefono']));
$codigopostal = stripslashes(stripslashes($row_Recordset2['codigopostal']));
$municipio = stripslashes(stripslashes($row_Recordset2['municipio']));
$estado = $row_Recordset2['estado'];
$correo = stripslashes(stripslashes($row_Recordset2['correo']));
$contrasena = stripslashes(stripslashes($row_Recordset2['contrasena']));
$curso = $row_Recordset2['curso'];
$grupo = $row_Recordset2['idgrupo'];
$pais = $row_Recordset2['pais'];
$imagen = $row_Recordset2['imagen'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset3 = "SELECT * FROM cursos";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset4 = "SELECT * FROM grupos";
$Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>modificaralumno</title>
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

    <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">
    
      <div id="contenedordatos" style="width: 100%; float: left; background-color: #fff;">
    
        <div id="titulo" style="width: 100%; margin-top: 30px; margin-bottom: 40px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6px;">Información del alumno</div>
        
        <div id="imagen<?php echo $id; ?>" style="width: 180px; height: 180px; float:left; margin-top:50px; background-image:url('../images/<?php if ($imagen != "") {  echo $imagen;} else{ echo "silueta.png";} ?>');background-size: cover; background-position: center; background-repeat: no-repeat; border-radius: 50%; margin-left: 70px; margin-bottom: 20px;"></div>
		 
		<!--<div id="datosbasicos" align="center" style="width: %; font-size: 18px; float:left; margin-top: 10px; margin-bottom: 10px; text-transform: uppercase; font-weight: bold; margin-left: 20px; margin-bottom: 20px; letter-spacing: 2px;">Datos básicos del alumno</div>-->
		
		<div id="contenedor1" style="float: left; width: calc(100% - 310px); margin-left: 30px; margin-right: 30px;">
			
			<div id="contenedornombre" style="width: 60%; float: left; margin-top: 60px;">
			
				<div id="etiquetanombre" style="width: 100%; font-size: 14px; float: left; margin-bottom: 10px; text-transform: uppercase; font-weight: bold; margin-left: 20px; letter-spacing: 1.5px;">Nombre del alumno: </div>
    
            	<div id="nombre" style="width: 20%; text-align:left; float: left; margin-left: 20px; margin-right: 20px;"><?php echo $nombre; ?></div>
    
            	<div id="apellidopat" style="width: 20%; float: left; margin-right: 10px;"><?php echo $apellidopaterno; ?></div>
    
           	 	<div id="apellidomat" style="width: 20%; float: left; margin-right: 10px;"><?php echo $apellidomaterno; ?></div>
            
		 	</div>
     
     		<div id="contenedorgenero" style="width: 20%; font-size: 13px; float:left; margin-top: 60px;">
    
            	<div id="etiquetagenero" style="width: 100%; font-size: 14px; float:left; margin-bottom: 10px; text-transform: uppercase; font-weight: bold;letter-spacing: 1.5px;">Sexo:</div>
    
                <div id="genero" style="width: 100%; text-align:left; float:left;"><?php echo $sexo; ?></div>
    
        	</div>
      
		  </div>
       
        	
        	<div id="contenedorfecha" style="width: 50%; font-size: 13px; text-align: center; float:left; margin-top:10px;">
        	
        		<div id="etiquetafecha" style="width: calc(25% - 5px); text-align:left; float: left;">Fecha de nacimiento:</div>
    
                <div id="dia" style="width: calc(7% - 15px); text-align: left; float:left; margin-left:10px;"><?php echo $dia; ?></div> 
                
                <div id="de" style="width: calc(2% - 10px); float: left; margin-left: 5px; margin-right: 5px;">de</div>
                
                <div id="mes" style="width: calc(7% - 15px); text-align:left; float:left; margin-left:10px;"><?php echo $mes; ?></div> 
                
                <div id="del" style="width: calc(2% - 10px); float: left; margin-left: 5px; margin-right: 5px;">del</div>
                
                <div id="ano" style="width: calc(7% - 15px); text-align:left; float:left; margin-left:10px;"><?php echo $ano; ?></div> 
        
			</div>
			
    	
    	<div id="contenedor2" style="width: 100%; float: left;">
    		
    		<div id="contenedormatricula" style="width: 50%; font-size: 13px; text-align: center; float:left; margin-top:10px;">
    		
    		    <div id="etiquetamatricula" style="width: calc(25% - 5px); text-align:left; float: left;">Matrícula:</div>
    		    
    		   	<div id="matricula" style="width: calc(25% - 5px); text-align:left; float: left;"><?php echo $matricula; ?></div>
    		
			</div>
   		
   			<div id="contenedorcurp" style="width: 50%; font-size: 13px; text-align: center; float:left; margin-top:10px;">
    		
    		    <div id="etiquetacurp" style="width: calc(25% - 5px); text-align:left; float: left;">CURP:</div>
    		    
    		   	<div id="curp" style="width: calc(25% - 5px); text-align:left; float: left;"><?php echo $curp; ?></div>
    		
			</div>
    		
    	</div> <!--Fin contenedor 2-->
    	
    	<div id="contenedor3" style="width: 100%; float: left;">
    		
    		<div id="contenedorcalle" style="width: calc(40% - 20px); font-size: 13px; text-align: center; float:left; margin-top:10px; margin-right: 20px;">
    		
    		    <div id="etiquetacalle" style="width: 100%; text-align:left; float: left;">CURP:</div>
    		    
    		   	<div id="curp" style="width: 100%; text-align:left; float: left;"><?php echo $curp; ?></div>
    		
			</div>
   	
   			<div id="contenedornumeros" style="width: calc(8% - 20px); font-size: 13px; text-align: center; float:left; margin-top:10px; margin-right: 20px;">
  
   		    	<div id="contenedorext" style="float: left; width: 50%;">
   		    	
    		    	<div id="etiquetaext" style="width: 50%; text-align:left; float: left;">No. Ext:</div>
    		    
    		   		<div id="numext" style="width: 50%; text-align:left; float: left;"><?php echo $numeroext; ?></div>
    		   		
				</div>
				
   		
   				<div id="contenedorint" style="float: left; width: 50%;">
   		    	
    		    	<div id="etiquetaint" style="width: 50%; text-align:left; float: left;">No. Int:</div>
    		    
    		   		<div id="numint" style="width: 50%; text-align:left; float: left;"><?php echo $numeroint; ?></div>
    		   		
				</div>
				
			</div> <!--Fin contenedor números-->
			
				<div id="contenedorcolonia" style="float: left; width: 52%;">
					
					<div id="etiquetacolonia" style="width: 100%; text-align:left; float: left;">Colonia:</div>
    		    
    		   		<div id="colonia" style="width: 100%; text-align: left; float: left;"><?php echo $colonia; ?></div>
					
				</div>
    	
		</div> <!--Fin contenedor 3-->
    
    	
    	<div id="contenedor4" style="width: 100%; float: left">
    		
    		<div id="contenedortel" style="width: calc(25% - 10px); float: left; margin-right: 10px;">
    			
    			<div id="etiquetatel" style="width: 100%; text-align: left; float: left;">Teléfono:</div>
    		    
    		   	<div id="telefono" style="width: 100%; text-align: left; float: left;"><?php echo $telefono; ?></div>
    		   	
    		</div>
    		
    		<div id="contenedorcp" style="width: calc(25% - 10px); float: left; margin-right: 10px;">
    			
    			<div id="etiquetacp" style="width: 100%; text-align: left; float: left;">Código postal:</div>
    		    
    		   	<div id="cp" style="width: 100%; text-align: left; float: left;"><?php echo $codigopostal; ?></div>
    		   	
    		</div>
    		
    		<div id="contenedorestado" style="width: calc(25% - 10px); float: left; margin-right: 10px;">
    			
    			<div id="etiquetaestado" style="width: 100%; text-align: left; float: left;">Estado:</div>
    		    
    		   	<div id="estado" style="width: 100%; text-align: left; float: left;"><?php echo $estado; ?></div>
    		   	
    		</div>
    		
    		<div id="contenedormunicipio" style="width: calc(25% - 10px); float: left; margin-right: 10px;">
    			
    			<div id="etiquetamunicipio" style="width: 100%; text-align: left; float: left;">Municipio:</div>
    		    
    		   	<div id="municipio" style="width: 100%; text-align: left; float: left;"><?php echo $municipio; ?></div>
    		   	
    		</div>
    		
    	</div> <!--Fin contenedor 4-->
    	
    	<div id="tituloportal" align="center" style="width: 100%; float: left; margin-top: 30px; margin-bottom: 20px; font-family: 'Montserrat', sans-serif;">Acceso a la plataforma educativa</div>
    	
    	<div id="contenedor 5" style="width: 100%; float: left;">
    		
    		<div id="contenedorcorreo" style="width: calc(33.3% - 15px); float: left;">
    			
    			<div id="etiquetacorreo" style="width: 100%; float: left; text-align: left;">Email:</div>
    			
    			<div id="correo" style="width: 100%; text-align: left; float: left;"><?php echo $correo; ?></div>
    		
    		</div>
    		
    		<div id="contenedorcontrasena" style="width: calc(33.3% - 15px); float: left;">
    			
    			<div id="etiquetacontrasena" style="width: 100%; float: left; text-align: left;">Contraseña:</div>
    			
    			<input id="contrasena" name="contrasena" type="password" style="width: 100%; text-align: left; float: left; border: 0; letter-spacing: 1.5px; font-size: 14px;" value="<?php echo $contrasena; ?>">
			
		  	</div>
			
	 </div> <!--Fin contenedor 5-->

     <div id="contenedorboton" align="center" style="width: 100%; float: left; margin-top:30px;">
     
		<button style="margin: 0px 10px;border-radius: 5px;padding: 10px 10px;font-weight: 900;font-size: 13px;cursor: pointer;border: 1px solid #cccccc;margin-top: 15px; width:200px;color: #f6f6f6;background-color: #878b8f; margin-bottom: 30px;" onclick="window.location.href='./alumnos.php';">CANCELAR</button>
		
	 </div>

   </div> <!--Fin contenedor datos-->
	
</div> <!--Fin sección principial-->

</div> <!--Fin del wrapper-->

</body>

</html>
