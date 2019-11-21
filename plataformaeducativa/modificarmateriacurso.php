<?php require_once('../Connections/conamatenlinea.php');
session_start();

if ($_SESSION['sesionmaestro'] == "") {
    
    header("Location: login.php");

} else {

    $maestro = $_SESSION['sesionmaestro'];
    $time = time();
}

$unixtime = time();

$targetPath = "../images/";
$minDim = 520;

$id = $_GET['id'];

if ($_POST) {

	$introduccion = addslashes(addslashes(trim($_POST["introduccionmateria"])));
    $presentacion = addslashes(addslashes(trim($_POST["presentacionmateria"])));
	$propositos = addslashes(addslashes(trim($_POST["propositosmateria"])));
	$competencias = addslashes(addslashes(trim($_POST["competenciasmateria"])));
	$imagenactual = $_POST['imagenactual'];
	$portadaactual = $_POST['portadaactual'];
    $newFileName1 = $imagenactual;
    $newFileName2 = $portadaactual;
	
	$portada = basename($_FILES['portada']["name"]);

	if ($portada != '') {
	
	$tempFile2 = $_FILES['portada']["tmp_name"];
	$numero2 = substr(md5(rand(0,9999)), 17, /*Numero de Digitos*/5);
    $name2 = date("dmY").$numero2;
	$ext2 = pathinfo($portada, PATHINFO_EXTENSION);  //figures out the extension
	$newFileName2 = $name2.".".$ext2;
	$targetFile2 =  $targetPath . $newFileName2;
	
	if (getimagesize($tempFile2)) {

    $fn2 = $tempFile2;
	$size2 = getimagesize( $fn2 );
    $ratio2 = $size2[0]/$size2[1]; // width/height
	$width2 = $size2[0];
	$height2 = $size2[1];
   
               if ($width2 > $height2) {			   
				  $heightt = $minDim;
                $widthh = $minDim * $ratio2;
			   } else {
				$widthh = $minDim;
               $heightt = $minDim / $ratio2;
			   }
			   
			   $medida2 = "100% auto";
			   
			   $largo2 = $width2 - 300;
               $alto2 = $height2 - 200;
		
   
   if ($largo2 >= $alto2) {		   
	 $medida2 = 'auto 100%';
	}

            $src2 = imagecreatefromjpeg($fn2);
            $dst2 = imagecreatetruecolor($width2, $height2);
            imagecopyresampled( $dst2, $src2, 0, 0, 0, 0, $widthh, $heightt, $size2[0], $size2[1] );
		 	imagejpeg($dst2, $targetFile2, 80); 
   
            imagedestroy($dst2);
   
	}

    
    } 
	
	$foto = basename($_FILES['foto']["name"]);
	
	if ($foto != '') {
		
	$tempFile = $_FILES['foto']["tmp_name"];
	$numero1 = substr(md5(rand(0,9999)), 17, /*Numero de Digitos*/5);
    $name1 = date("dmY").$numero1;
	$ext = pathinfo($foto, PATHINFO_EXTENSION);  //figures out the extension
	$newFileName1 = $name1.".".$ext;
	$targetFile =  $targetPath . $newFileName1;
	
	if (getimagesize($tempFile)) {

    $fn = $tempFile;
	$size = getimagesize( $fn );
    $ratio = $size[0]/$size[1]; // width/height
	$width1 = $size[0];
	$height1 = $size[1];
   
               if ($width1 > $height1) {			   
				  $height = $minDim;
                $width = $minDim * $ratio;
			   } else {
				$width = $minDim;
               $height = $minDim / $ratio;
			   }
			   
			   $medida = "100% auto";
			   
			   $largo = $width1 - 300;
               $alto = $height1 - 200;
   
   if ($largo >= $alto) {		   
	$medida = 'auto 100%';
	}

            $src = imagecreatefromjpeg($fn);
            $dst = imagecreatetruecolor($width, $height);
            imagecopyresampled( $dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
		 	imagejpeg($dst, $targetFile, 80); 
   
            imagedestroy($dst);
   
	}


		
    }

	
mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Modificó una materia del curso', '$unixtime')"); 
	
	mysql_query("UPDATE materiascurso SET imagen = '$newFileName1', portada = '$newFileName2', introduccion = '$introduccion', presentacion = '$presentacion', propositos = '$propositos', competencias = '$competencias' WHERE id = '$id'");

header("Location: cursos.php?exito=1");

}//Fin del POST

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM maestros WHERE usuario = '$maestro'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$idmaestro = $row_Recordset1['id'];
$imagen = $row_Recordset1['imagen'];
$nombre = $row_Recordset1['nombre'];

$query_Recordset3 = "SELECT * FROM materias";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$query_Recordset4 = "SELECT * FROM materiascurso WHERE id = '$id'";
$Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4); 
    
$idmateriaseleccionada = $row_Recordset4['idmateria'];
$imagenactual = $row_Recordset4['imagen'];
$portada = $row_Recordset4['portada'];
$portadaactual = $row_Recordset4['portada'];
$presentacion = $row_Recordset4['presentacion'];
$introduccion = $row_Recordset4['introduccion'];
$competencias = $row_Recordset4['competencias'];
$propositos = $row_Recordset4['propositos'];

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
    /*background-color: #0b2c4d;*/
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
#librolink:hover{
    background-color: #0b2c4d; 
    color: white;
}

.imagenmateria {
     width: 100%;
	 height: 200px;
     float: left;
     border: 1px solid #ccc;
	background-size: cover;
	background-position: center;
	margin-bottom: 10px;
}

	.portadamateria {
		width: calc(100% - 2px);
		height: 220px;
		float: left;
		border: 1px solid #ccc;
		background-image: url(../images/headerciencia.jpg);
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
	}

 #botonagregar:hover{
            text-decoration: underline;
        }

</style>
<!--Fin estilos CSS-->

<script type="text/javascript" >
	
function valida_envia() {
	
    if ( $("#idmateria").val() == '') {

                alert("Por favor escribe un nombre");
                $("#idmateria").focus();
                return false;
    }
	
	if ( $("#presentacionmateria").val() == '') {

                alert("Por favor escribe una presentación");
                $("#presentacionmateria" + id).focus();
                return false;
    }
	
	if ( $("#introduccionmateria").val() == '') {

                alert("Por favor escribe una introducción");
                $("#introduccionmateria").focus();
                return false;
    }
	
	
	if ( $("#competenciasmateria").val() == '') {

                alert("Por favor escribe las competencias");
                $("#competenciasmateria").focus();
                return false;
    }
	
	
	if (formnumber == 0) {

           if (typeof $('#foto'+ id)[0].files[0]  == "undefined") {

               alert("Por favor agrega una imagen para la nueva materia");
               return false;
           }
		
		   
		   if (typeof $('#portada' + id)[0].files[0] == "undefined") {
			   
			   alert("Por favor agrega una portada para la nueva materia");
			   return false;
		   }
    }

	
}
	
function enviar() {

    //carga el objeto del archivo
    var file = $("#foto")[0].files[0];
	var file1 = $("#portada")[0].files[0];

    //Vista previa de la imagen

    var reader = new FileReader();
	var reader1 = new FileReader();

    //funcion que corre cuando ya se termino de subir el o los archivos
    reader.addEventListener("load", function () {

        var image = new Image();

        image.src = reader.result;

        image.onload = function() {

        if(image.width < 400 && image.height < 600)
				{
					alert("La imagen es demasiado pequeña, sube otra imagen por favor");
					return false;
					
				} else {
			 
        			$("#contenedorimagenactual").css("background-image", "url(" + reader.result + ")");
				}
		};
		
    }, false);

    if (file) {

         reader.readAsDataURL(file);
     }
	
	reader1.addEventListener("load", function () {
		
		var portada = new Image();

        portada.src = reader1.result;

        portada.onload = function() {

        if(portada.width < 1000 && portada.height < 600)
			
				{
					alert("La imagen es demasiado pequeña, sube otra imagen por favor ( min 1000x600px )");
					return false;
					
				} else {
			 
        			$("#contenedorportadaactual").css("background-image", "url(" + reader1.result + ")");
				}
		};
		
	}, false);
	
	if (file1) {
		
		reader1.readAsDataURL(file1);
	}
}

</script>

</head>
<body>
<div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

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
            
            <a class="linkopcion" href="./configuracionmaestro.php" style="text-decoration: none;">

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
    	
    	<!--Contenedor-nuevamateria-->
             <div id="contenedor-materia<?php echo $id; ?>" class="card" style="width: calc(100% - 60px); float: left; margin-bottom: 40px; display: block;">
    
                <div id="titulomateria" align="center" style="font-size: 25px; line-height: 60px; float: left; width: 100%;">Modificar materia</div>
    
                    <div id="contenedornuevamateria<?php echo $id; ?>" style="width: 100%; float: left;">
 
                    <form id="materiaform" name="materiaform" action="modificarmateriacurso.php?id=<?php echo $id; ?>" enctype="multipart/form-data" method="post">

<!--onsubmit="return(valida_envia())"-->
        
                       <input id="id" name="id" value="<?php echo $id; ?>" type="hidden">
                                
                                <input id="portadaactual" name="portadaactual" value="<?php echo $portadaactual; ?>" type="hidden">
                                
                                <input id="imagenactual" name="imagenactual" value="<?php echo $imagenactual; ?>" type="hidden"> 
                                
                                <div id="contienesubidaportada" style="    width: 100%; height: 220px; float: left; border: 1px solid #ccc;">
        
                                    <div id="contenedorportadaactual" class="portadamateria" align="center" style="background-image: url(../images/<?php echo $portada; ?>);">
                                    
                                    <a href="javascript:void('');" onclick="javascript:document.getElementById('portada').click();"><div id="botonfileportada" align="center" style="color:#7FDBFF; cursor: pointer; margin-top: 5px; float: left; margin-left: 5px; background-color: #fff; padding: 3px;">
        
                                        <input type="button" id="enviarportada" name="enviarportada" style="border:0px; height:0px; display:block; background-color: #fff; width: 120px;">
                                        
                                        <div id="iconeditarimagen" style="width: 17px; float: left; margin-left: 5px;">
                                        	
                                        	<img src="../images/iconfoto.png?id=<?php echo $unixtime; ?>" style="width: 100%; float: left;">
                                        	
                                        </div>
        
                                        <div style="font-size: 12px; color: #5e696d; margin-top: 1px;">Elegir portada</div>
        
                                        <input type="file" id="portada" name="portada" value="" onchange="javascript:enviar();" style="display: none;" accept="image/jpeg">
        
                                    </div></a>
									</div>
        
                                     </div>
       						
        						
                               <div id="datosbasicos" align="center" style="float: left; width: 100%; font-size: 20px; text-transform: uppercase;font-family: 'Montserrat', sans-serif; color: #000; font-weight: bold;letter-spacing: 2px; background: whitesmoke; height: 50px; line-height: 50px; margin-top: 30px; margin-bottom: 10px;">DATOS BÁSICOS</div>
                               
                                <div id="contienesubidaimagen" style="width: 30%; float: left;">
        
                                    <div id="contenedorimagenactual" class="imagenmateria" align="center" style="background-color: #c1c1c1; background-image: url(../images/<?php echo $imagenactual; ?>); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
        
                                    <a href="javascript:void('');" onclick="javascript:document.getElementById('foto').click('');"><div id="botonfile" align="center" style="border: 1px solid #1d4267; background-color: #1d4267; color: #7FDBFF; padding: 5px; cursor:pointer; margin-top: 10px; width: calc(100% - 12px); float: left;">
        
                                        <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; height:0px; display:block; background-color: #1d4267;">
        
                                            <div style="font-size:12px;">Elegir imagen</div>
                                            
                                            <input type="file" id="foto" name="foto" value="" onchange="javascript:enviar('');" style="display: none;" accept="image/jpeg">
        
                                    </div></a>
        
                                </div>

                                <div id="contienepresentacion" style="width:70%; float:left;">
                                   
                                    <label for="presentacionmateria" style="float:left; margin-left:15px; padding:7px 0px; width:calc(100% - 15px); ">Presentación de la materia</label>

                                    <textarea id="presentacionmateria" name="presentacionmateria" placeholder="Escribe la presentación de la materia" style="resize: none; height: 206px; font-size: 12px;background-color: white; width: calc(100% - 24px); padding: 5px; float: left; border: 2px solid #1d4267; margin-left: 10px;"><?php echo $presentacion; ?></textarea>

                                </div>
                                    
                                <div id="datosbasicos" align="center" style=" float: left; width: 100%; font-size: 20px; text-transform: uppercase; font-family: 'Montserrat', sans-serif; color: #000; font-weight: bold; letter-spacing: 2px; background: whitesmoke; height: 50px; line-height: 50px; margin-top: 30px;">DATOS GENERALES</div>


                                <div id="contieneintroduccion" style="width:calc(100% - 10px); float:left; margin:5px;">  
                                    <label for="introduccionmateria" style="float:left;  padding:7px 0px; width:100%; ">Introducción de la materia</label>
                                    <textarea id="introduccionmateria" name="introduccionmateria" placeholder="Escribe la introducción de la materia" style="resize: none; height: 200px; font-size: 12px; background-color: white; width: calc(100% - 14px); padding: 5px; float: left; border: 2px solid #4182b6;"><?php echo $introduccion; ?></textarea>
                                </div>  


                                <div id="contienecompetencias" style="    width: calc(100% - 10px); float: left; margin: 5px;">
                                    <label for="competenciasmateria" style="float:left;  padding:7px 0px; width:100%; ">Competencias de la materia</label>
                                    <textarea id="competenciasmateria" name="competenciasmateria" placeholder="Escribe las competencias de la materia" style="resize: none; height: 200px; font-size: 12px; background-color: white; width: calc(100% - 14px); padding: 5px; float: left; border: 2px solid #539bd5;"><?php echo $competencias; ?></textarea>

                                </div>  
        
                    <!--Fin de contenedor-nuevocurso-->
    
                    <div id="contenedorboton" align="center" style="float: left; width: 100%; margin: 40px 0px;">
                            <button type="button" onclick="guardarform(); " style="border-radius: 5px;line-height: 30px;background-color: #1d4267;border-color: #1d4267;padding: 0px 20px;color: white;cursor: pointer;font-weight: bold;font-size: 12px;border-style: none;">GUARDAR CAMBIOS</button>
                            <button type="button" onclick="window.location.href='cursos.php'" style="border-radius: 5px;line-height: 30px;background-color: #7f8081;border-color: #7f8081;padding: 0px 20px;color: white;cursor: pointer;font-size: 12px;font-weight: bold;border-style: none;">REGRESAR</button>
                    </div>

				</form>
		</div>
		
	</div>
    
	</div>
	
</div>
	
</body>

</html>
