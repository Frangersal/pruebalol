<?php require_once('../Connections/conamatenlinea.php');

session_start();
date_default_timezone_set('America/Mexico_City');

$usuario = $_SESSION['usuario'];
$error = "";
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
    <title>Ver alumno</title>
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

    .atributo{
        color:white;
        font-weight: bold;
        font-size: 14px;
        background: #1d4267;
        padding: 3px;
        width: calc(100% - 6px);
        text-align: center;
    }

    .seccion{
        font-weight: bold;
        color: #9b909b;
        font-size: 25px;
        letter-spacing: 2.0px;
        margin: 20px 0px;
    }

    .dato{
        font-weight: bold;
        font-size: 14px;
        padding: 0px 3px;
        text-align: center;
    }


</style>
<!--FIN Estilos CSS-->


<!--Javascript-->
<script type="text/javascript">       
</script>

<!--Fin Javascript-->
</head>

<body>
    
 <div id="wrapper" style="width: 100%; float: left; height: 100vh;  position: relative;">

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
    
      <div id="contenedordatos" style="margin-left:10%; margin-right:10%; width: 80%; float: left; background-color: #fff;">
    
        <div id="titulo" class="seccion" style="width: 100%; text-align: center; ">Información del alumno</div>
        
        <div id="imagen<?php echo $id; ?>" style="width: 180px; height: 180px; float:left; background-image:url('../images/<?php if ($imagen != "") {  echo $imagen;} else{ echo "silueta.png";} ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; border-radius: 50%; margin: 10px;"></div>
		 
		<!--<div id="datosbasicos" align="center" style="width: %; font-size: 18px; float:left; margin-top: 10px; margin-bottom: 10px; text-transform: uppercase; font-weight: bold; margin-left: 20px; margin-bottom: 20px; letter-spacing: 2px;">Datos básicos del alumno</div>-->
		
		<div id="contenedor1" style="float: left; width: calc(100% - 220px) ;margin:10px;">
			
			<div id="contenedornombre" style="width: calc(50% - 10px); float: left; padding: 5px;">
			
				<div id="etiquetanombre" class="atributo" style=" float: left; text-transform: uppercase; letter-spacing: 1.5px;">Nombre del alumno </div>
    
            	<div id="nombre" class="dato" style=" float: left; padding:0px 5px"><?php echo $nombre; ?></div>
    
            	<div id="apellidopat" class="dato" style="float: left; padding:0px 5px"><?php echo $apellidopaterno; ?></div>
    
           	 	<div id="apellidomat" class="dato" style="float: left; padding:0px 5px"><?php echo $apellidomaterno; ?></div>
            
		 	</div>
     
     		<div id="contenedorgenero" style="width: calc(50% - 10px); font-size: 13px; float:left; padding: 5px;">
    
            	<div id="etiquetagenero" class="atributo" style=" float:left; text-transform: uppercase; font-weight: bold; letter-spacing: 1.5px;">Sexo</div>
    
                <div id="genero" class="dato" style="width: 100%;  float:left;"><?php echo $sexo; ?></div>
    
        	</div>
      
		</div>
			
    	
        <div id="contenedor2" style="width: calc(100% - 220px); float: left; margin:10px;">
        
            <div id="contenedorfecha" style="float: left; width: calc(33.333% - 10px); padding:5px;">
                
                <div id="etiquetafecha" class="atributo" style="float: left; text-transform: uppercase; letter-spacing: 1.5px;">Fecha de nacimiento</div>

                <div id="dia" class="dato" style=" float:left; padding: 0px 5px;"><?php echo $dia; ?></div> 
                
                <div id="de" class="dato" style="  float: left; padding: 0px 5px;">/</div>
                
                <div id="mes" class="dato" style=" float:left; padding: 0px 5px;"><?php echo $mes; ?></div> 
                
                <div id="del" class="dato" style=" float: left; padding: 0px 5px;">/</div>
                
                <div id="ano" class="dato" style=" float:left; padding: 0px 5px;"><?php echo $ano; ?></div> 
        
            </div>
    		
    		<div id="contenedormatricula" style="padding: 5px; width: calc(33.333% - 10px); font-size: 13px; text-align: center;float:left;">
    		
    		    <div id="etiquetamatricula"  class="atributo" style="float: left; text-transform: uppercase; letter-spacing: 1.5px;">Matrícula</div>
    		    
    		   	<div id="matricula" class="dato" style="width: 100%;  float: left;"><?php echo $matricula; ?></div>
    		
			</div>
   		
   			<div id="contenedorcurp" style="padding: 5px; width: calc(33.333% - 10px); font-size: 13px;  float:left;">
    		
    		    <div id="etiquetacurp" class="atributo" style=" float: left;">CURP</div>
    		    
    		   	<div id="curp" class="dato" style="width: 100%;  float: left;"><?php echo $curp; ?></div>
    		
			</div>
    		
        </div> <!--Fin contenedor 2-->
        
        <div id="tituloportal" class="seccion" align="center" style="width: 100%; float: left;  margin-top: 0px; ">Direccion del alumno</div>
    	
    	<div id="contenedor3" style="width: calc(100% - 20px); float: left;  margin: 10px;">
   	
                <div id="contenedorcolonia" style="float: left; width: calc(25% - 10px); padding: 5px;">
					
                            <div id="etiquetacolonia" class="atributo" style=" float: left;">Colonia</div>
                        
                            <div id="colonia" class="dato" style="width: 100%;  float: left;"><?php echo $colonia; ?></div>
                            
                </div>

                <div id="contenedorcalle" style="float: left; width: calc(25% - 10px);  padding: 5px;">
					
                        <div id="etiquetacalle" class="atributo" style=" float: left;">Calle</div>
                    
                        <div id="calle" class="dato" style="width: 100%;  float: left;"><?php echo $calle; ?></div>
                        
                </div>
  
   		    	<div id="contenedorext" style="float: left; width: calc(25% - 10px); padding: 5px;">
   		    	
    		    	<div id="etiquetaext" class="atributo" style="float: left;">No. Ext</div>
    		    
    		   		<div id="numext" class="dato" style="width: 100%; float: left;"><?php echo $numeroext; ?></div>
    		   		
				</div>
				
   		
   				<div id="contenedorint" style="float: left; width: calc(25% - 10px);  padding: 5px;">
   		    	
    		    	<div id="etiquetaint" class="atributo" style=" float: left;">No. Int</div>
    		    
    		   		<div id="numint" class="dato" style="width: 100%; ; float: left;"><?php echo $numeroint; ?></div>
    		   		
                </div>
                			
    	
		</div> <!--Fin contenedor 3-->
    
    	
    	<div id="contenedor4" style="width: calc(100% - 20px); float: left; margin: 10px;">
    		
    		<div id="contenedortel" style="width: calc(25% - 10px); float: left; padding: 5px;">
    			
    			<div id="etiquetatel" class="atributo" style="float: left;">Teléfono</div>
    		    
    		   	<div id="telefono" class="dato" style="width: 100%; float: left;"><?php echo $telefono; ?></div>
    		   	
    		</div>
    		
    		<div id="contenedorcp" style="width: calc(25% - 10px); float: left; padding: 5px;">
    			
    			<div id="etiquetacp" class="atributo" style="  float: left;">Código postal</div>
    		    
    		   	<div id="cp" class="dato" style="width: 100%; float: left;"><?php echo $codigopostal; ?></div>
    		   	
    		</div>
    		
    		<div id="contenedorestado" style="width: calc(25% - 10px); float: left; padding: 5px;">
    			
    			<div id="etiquetaestado" class="atributo" style=" float: left;">Estado</div>
    		    
    		   	<div id="estado" class="dato" style="width: 100%; float: left;"><?php echo $estado; ?></div>
    		   	
    		</div>
    		
    		<div id="contenedormunicipio" style="width: calc(25% - 10px); float: left; padding: 5px;">
    			
    			<div id="etiquetamunicipio" class="atributo" style="  float: left;">Municipio</div>
    		    
    		   	<div id="municipio" class="dato" style="width: 100%; float: left;"><?php echo $municipio; ?></div>
    		   	
    		</div>
    		
    	</div> <!--Fin contenedor 4-->
    	
    	<div id="tituloportal" class="seccion" align="center" style="width: 100%; float: left; ">Plataforma educativa</div>
    	
    	<div id="contenedor5" style="width: calc(100% - 20px); float: left; margin: 10px;">
    		
    		<div id="contenedorcorreo" style="width: calc(50% - 10px); float: left; padding: 5px;">
    			
    			<div id="etiquetacorreo" class="atributo" style=" float: left; ">Email</div>
    			
    			<div id="correo" class="dato" style="width: 100%; float: left;"><?php echo $correo; ?></div>
    		
    		</div>
    		
    		<div id="contenedorcontrasena" style="width: calc(50% - 10px); float: left; padding: 5px;">
    			
    			<div id="etiquetacontrasena" class="atributo" style=" float: left; ">Contraseña</div>
    			
    			<div id="contrasena" name="contrasena" style="width: 100%; float: left; border: 0; letter-spacing: 1.5px; font-size: 14px; text-align: center;" value="">*******</div>
			
		  	</div>
			
	    </div> <!--Fin contenedor 5-->

     <div id="contenedorboton" align="center" style="width: 100%; float: left; margin-top:30px;">
     
		<button style="margin: 0px 10px;border-radius: 5px;padding: 10px 10px;font-weight: 900;font-size: 13px;cursor: pointer;border: 1px solid #cccccc;margin-top: 15px; width:200px;color: #f6f6f6;background-color: #878b8f; margin-bottom: 30px;" onclick="window.location.href='./alumnos.php';">REGRESAR</button>
		
	 </div>

   </div> <!--Fin contenedor datos-->
	
</div> <!--Fin sección principial-->

</div> <!--Fin del wrapper-->

</body>

</html>
