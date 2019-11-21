<?php require_once('../Connections/conamatenlinea.php');
session_start();

if ($_SESSION['sesionmaestro'] == "") {
    
    header("Location: login.php");

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

    //unlink("../images/" . $portadaactual);
    
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


    //unlink("../images/" . $imagenactual);
		
	}

	
mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Modificó una materia del curso', '$unixtime')"); 
	
	mysql_query("UPDATE materiascurso SET imagen = '$newFileName1', portada = '$newFileName2', introduccion = '$introduccion', presentacion = '$presentacion', propositos = '$propositos', competencias = '$competencias' WHERE id = '$id'");

header("Location: cursos.php");

}//Fin del POST


mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset3 = "SELECT * FROM materias";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$query_Recordset4 = "SELECT * FROM materiascurso WHERE id = '$id'";
$Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4); 
    
$idmateriaseleccionada = $row_Recordset4['idmateria'];
$imagen = $row_Recordset4['imagen'];
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
		width: 859px;
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
     //validamos que no esten vacíos los campos
    //
    /*
	
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
	
	if ( $("#propositosmateria").val() == '') {

                alert("Por favor escribe los propósitos");
                $("#propositosmateria").focus();
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

    */


	
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

        if(image.width < 300 && image.height < 300)
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

        if(portada.width < 800 && portada.height < 600)
			
				{
					alert("La imagen es demasiado pequeña, sube otra imagen por favor");
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

    <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">
    	
    	<!--Contenedor-nuevamateria-->
             <div id="contenedor-materia<?php echo $id; ?>" class="card" style="width: calc(100% - 60px); float: left; margin-bottom: 40px; display: block;">
    
                <div id="titulomateria" align="center" style="font-size: 25px; line-height: 60px; float: left; width: 100%;">Modificar materia</div>
    
                    <div id="contenedornuevamateria<?php echo $id; ?>" style="width: calc(100% - 160px); margin-left: 80px; float: left;">
 
                    <form id="materiaform" name="materiaform" action="modificarmateriacurso.php?id=<?php echo $id; ?>" enctype="multipart/form-data" method="post">

<!--onsubmit="return(valida_envia())"-->
        
                       <input id="id" name="id" value="<?php echo $id; ?>" type="hidden">
                                
                                <input id="portadaactual" name="portadaactual" value="<?php echo $portadaactual; ?>" type="hidden">
                                
                                <input id="imagenactual" name="imagenactual" value="<?php echo $imagenactual; ?>" type="hidden">
                                
                                
                                
                                <div id="contienesubidaportada" style="width: 859px; height: 220px; float: left; border: 1px solid #ccc;">
        
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
       						
        						
                               <div id="datosbasicos" align="center" style="float: left; width: calc(100% - 400px); margin-left: 200px; font-size: 20px; text-transform: uppercase; font-family: 'Montserrat', sans-serif; margin-bottom: 40px; margin-top: 40px; color: #000; font-weight: bold; letter-spacing: 2px;">DATOS BÁSICOS</div>
                               
                                <div id="contienesubidaimagen" style="width: 30%; float: left;">
        
                                    <div id="contenedorimagenactual" class="imagenmateria" align="center" style="background-color: #c1c1c1; background-image: url(../images/<?php echo $imagen; ?>); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
        
                                    <a href="javascript:void('');" onclick="javascript:document.getElementById('foto').click('');"><div id="botonfile" align="center" style="border: 1px solid #1d4267; background-color: #1d4267; color: #7FDBFF; padding: 5px; cursor:pointer; margin-top: 10px; width: calc(100% - 12px); float: left;">
        
                                        <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; height:0px; display:block; background-color: #1d4267;">
        
                                            <div style="font-size:12px;">Elegir imagen</div>
                                            
                                            <input type="file" id="foto" name="foto" value="" onchange="javascript:enviar('');" style="display: none;" accept="image/jpeg">
        
                                    </div></a>
        
                                     </div>
                                   
                                    <label for="presentacionmateria" style="float:left; margin-left:15px; padding:7px 0px;">Escribe la presentacion de la materia</label>
                                    <textarea id="presentacionmateria" name="presentacionmateria" placeholder="Escribe la presentación de la materia" style="resize: none;height: 206px;font-size: 12px;background-color: white;width: 66%;padding: 5px;float: left;border: 1px solid lightgray;margin-left: 10px;"><?php echo $presentacion; ?></textarea>
                                    
                                    <div id="datosbasicos" align="center" style="float: left; width: calc(100% - 400px); margin-left: 200px; font-size: 20px; text-transform: uppercase; font-family: 'Montserrat', sans-serif; margin-bottom: 40px; margin-top: 40px; color: #000; font-weight: bold; letter-spacing: 2px;">DATOS GENERALES</div>


                                <div id="contieneintroduccion" style="width:100%; float:left; margin:5px;">  
                                    <label for="introduccionmateria" style="float:left;  padding:7px 0px;">Escribe la Introducción de la materia</label>
                                    <textarea id="introduccionmateria" name="introduccionmateria" placeholder="Escribe la introducción de la materia" style="resize: none;height: 200px;font-size: 12px;background-color: white;width: 100%;padding: 5px;float: left;border: 1px solid lightgray;"><?php echo $introduccion; ?></textarea>
                                </div>  

                                <div id="contienepropositos" style="width:100%; float:left; margin:5px;">
                                    <label for="propositosmateria" style="float:left;  padding:7px 0px;">Escribe los propósitos de la materia</label> 
                                    <textarea id="propositosmateria" name="propositosmateria" placeholder="Escribe los propósitos de la materia" style="resize: none;height: 200px;font-size: 12px;background-color: white;width: 100%;padding: 5px;float: left;border: 1px solid lightgray;"><?php echo $propositos; ?></textarea>

                                </div>

                                <div id="contienecompetencias" style="width:100%; float:left; margin:5px;">
                                    <label for="competenciasmateria" style="float:left;  padding:7px 0px;">Escribe las competencias de la materia</label>
                                    <textarea id="competenciasmateria" name="competenciasmateria" placeholder="Escribe las competencias de la materia" style="resize: none;height: 200px;font-size: 12px;background-color: white;width: 100%;padding: 5px;float: left;border: 1px solid lightgray;"><?php echo $competencias; ?></textarea>

                                </div>  
        
                    <!--Fin de contenedor-nuevocurso-->
    
						            <div id="contenedorboton" align="center" style="width: 60%; margin-left: 30%; margin-top: 60px; float: left;">
						            
						            	<button type="submit" style="float: left; border-radius: 10px; line-height: 30px; background-color: #1d4267; border-color: #7FDBFF; padding-left: 20px; padding-right: 20px; margin-top: 20px; color: #7FDBFF; cursor: pointer;">Guardar cambios</button>
						            	
						                <input type="button" name="Cancelar" value="Cancelar" onclick="window.location='materias1.php'" style="float: left; width: 100px; margin-top: 20px; padding: 10px 0px; background-color: #00020287; border-color: #b8bfc1; color: #d8dfe2; cursor: pointer; border-radius: 10px; margin-left: 50px;">

						            	
						  		 </div>

				</form>
		</div>
		
	</div>
    
	</div>
	
</div>
	
</body>

</html>
