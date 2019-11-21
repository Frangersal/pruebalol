<?php require_once('../Connections/conamatenlinea.php');

session_start();
date_default_timezone_set('America/Mexico_City');

$usuario = $_SESSION['usuario'];
$error = "";
$unixtime = time();


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

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset5 = "SELECT * FROM materiascurso ";
$Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

$idinscrito = $row_Recordset5['idcurso'];;

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

<!--Menu plataforma educativa-->
<div id="seccionmenu" style="width: 20%; background-color: #354052; position: fixed; top: 0; left: 0; z-index: 999; height: 100%; box-shadow: 0px 0px 10px #000;">
	
		<a href="/plataformaeducativa/"><div id="logotipoplataforma" align="center" style="float: left; width: calc(70%); margin-top: 30px; margin-bottom: 30px; margin-left: 15%; margin-right: 15%;">
			<img src="../images/logoplataformaeducativa.png?id=<?php echo $unixtime; ?>" alt="logotipo" style="width: 100%; opacity: 0.8; float: left;">
		</div> </a>
		
		<?php if($imagenactual == "") { ?>
				
					 <div id="contenedorimagenactual" align="center" style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; float: left; border: 1px solid #35405263; background-image: url(../images/iconavatar.png); background-size: cover; background-position: center;">

				 </div>
					
				<?php } else if ($imagenactual != "") { ?>
				
					<div id="contenedorimagenactual" align="center" style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; position: relative; float: left; border: 1px solid #35405263; background-image: url(../images/<?php echo $imagenactual; ?>); background-size: cover; background-position: center;">
					
					</div>
					
				<?php } ?>
		
		<div id="nombre" align="center" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #abb4c1; width: 90%; letter-spacing: 0.5px; line-height: 20px; padding: 10px;">
			<?php echo $nombre ." ". $apellidopaterno ." ". $apellidomaterno; ?>
		</div>
		
		<div id="lineaseparadora1" style="width: 100%; height: 1px; background-color: #000; float: left;"></div>
		<div id="lineaseparadora2" style="width: 100%; height: 1px; background-color: #807979; float: left;"></div>
				
		<div id="opcionesmenu" style="width: 100%; float: left;">
			
            <a class="linkopcion" href="index.php" style="text-decoration: none;">

                <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconinicio.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Inicio</div>
				
					</div>
				
                </div>

            </a>

            <div class="opcionactual" style=" width: calc(100% - 4px); float: left; background-color: #2a3444; border-left: 4px solid #4a8ab1;">

				<div class="opcion" style="width: calc(100% - 4px); float: left;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">

							<img class="opcionicon" src="../images/iconcursos.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Cursos</div>
				
					</div>
					
				</div>
				
            </div>
            
            <a class="linkopcion" href="../configuracion.php" style="text-decoration: none;">

                <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconconfiguracion.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Configuracion</div>
				
					</div>
				
                </div>

            </a>

            <a class="linkopcion" href="../logout.php" style="text-decoration: none;">

                <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconsalir.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Salir</div>
				
					</div>
				
                </div>

            </a>



		</div>

			
    </div>
    <!--FIN Menu plataforma educativa-->

    <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">
    
      <div id="contenedordatos" style="margin-left:10%; margin-right:10%; width: 80%; float: left; background-color: #fff;">
    
        <div id="titulo" class="seccion" style="width: 100%; text-align: center; ">Información del alumno</div>
        
        <div id="imagen<?php echo $id; ?>" style="width: 180px; height: 180px; float:left; background-image:url('../images/<?php if ($imagen != "") {  echo $imagen;} else{ echo "silueta.png";} ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; border-radius: 50%; margin: 10px;"></div>
		 
		<!--<div id="datosbasicos" align="center" style="width: %; font-size: 18px; float:left; margin-top: 10px; margin-bottom: 10px; text-transform: uppercase; font-weight: bold; margin-left: 20px; margin-bottom: 20px; letter-spacing: 2px;">Datos básicos del alumno</div>-->
		
		<div id="contenedor1" style="float: left; width: calc(100% - 220px) ;margin:10px; margin-bottom:30px;">
			
			<div id="contenedornombre" style="width: calc(50% - 10px); float: left; padding: 5px;">
			
                <div id="etiquetanombre" class="atributo" style=" float: left; text-transform: uppercase; letter-spacing: 1.5px;">Nombre del alumno </div>
                
                <div id="nombrecompleto" style="width:100%; float:left;">
    
                    <div id="nombre" class="dato" style=" float: left;  width:33.3333%;"><?php echo $nombre; ?></div>
        
                    <div id="apellidopat" class="dato" style="float: left;  width:33.3333%;"><?php echo $apellidopaterno; ?></div>
        
                    <div id="apellidomat" class="dato" style="float: left;  width:33.3333%;"><?php echo $apellidomaterno; ?></div>
                        
                </div>
            
		 	</div>
     
     		<div id="contenedorgenero" style="width: calc(50% - 10px); font-size: 13px; float:left; padding: 5px;">
    
            	<div id="etiquetagenero" class="atributo" style=" float:left; text-transform: uppercase; font-weight: bold; letter-spacing: 1.5px;">Sexo</div>
    
                <div id="genero" class="dato" style="width: 100%;  float:left;"><?php echo $sexo; ?></div>
    
        	</div>
      
		</div>
			
    	
        <div id="contenedor2" style="width: calc(100% - 220px); float: left; margin:10px;">
        
            <div id="contenedorfecha" style="float: left; width: calc(33.333% - 10px); padding:5px;">
                
                <div id="etiquetafecha" class="atributo" style="float: left; text-transform: uppercase; letter-spacing: 1.5px;">Fecha de nacimiento</div>

                <div id="dia" class="dato" style=" float:left; width:20%;"><?php echo $dia; ?></div> 
                
                <div id="de" class="dato" style="  float: left; width:20%;">/</div>
                
                <div id="mes" class="dato" style=" float:left; width:20%;"><?php echo $mes; ?></div> 
                
                <div id="del" class="dato" style=" float: left; width:20%;">/</div>
                
                <div id="ano" class="dato" style=" float:left; width:20%;"><?php echo $ano; ?></div> 
        
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
        

     <div id="contenedorboton" align="center" style="width: 100%; float: left; margin-top:30px;">
     
                    <div id="contenedorboton" align="center" style="float: left; width: 100%; margin: 40px 0px;">
                            
                            <button type="button" onclick="window.location.href='alumnos.php'" style="border-radius: 5px;line-height: 30px;background-color: #7f8081;border-color: #7f8081;padding: 0px 20px;color: white;cursor: pointer;font-size: 12px;font-weight: bold;border-style: none;">REGRESAR</button>
                            
                    </div>
		
	 </div>

   </div> <!--Fin contenedor datos-->
	
</div> <!--Fin sección principial-->

</div> <!--Fin del wrapper-->

</body>

</html>
