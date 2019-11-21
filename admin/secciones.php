<?php require_once('../Connections/conamatenlinea.php');
session_start();

if ($_SESSION['usuario'] == "") {
    
    header("Location: login.php");

}else{

    $usuario = $_SESSION['usuario'];
    $time = time();

}

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$permiso = $row_Recordset2['permiso'];

if ($permiso == 3) {

header("Location: index.php");
exit;

}

$query_Recordset1 = "SELECT * FROM secciones";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

$titulo1 = $row_Recordset1['titulo'];
$informacion1 = $row_Recordset1['informacion'];
$imagen1 = $row_Recordset1['imagen'];
$id1 = $row_Recordset1['id'];

$row_Recordset1 = mysql_fetch_assoc($Recordset1);

$titulo2 = $row_Recordset1['titulo'];
$informacion2 = $row_Recordset1['informacion'];
$imagen2 = $row_Recordset1['imagen'];
$id2 = $row_Recordset1['id'];

$row_Recordset1 = mysql_fetch_assoc($Recordset1);

$titulo3 = $row_Recordset1['titulo'];
$informacion3 = $row_Recordset1['informacion'];
$imagen3 = $row_Recordset1['imagen'];
$id3 = $row_Recordset1['id'];
    
?>
<!DOCTYPE html>
<html lang="es"><head>
    <meta charset="UTF-8">
    <title>Conamat en línea | Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script
      src="https://code.jquery.com/jquery-3.3.1.js"
      integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
      crossorigin="anonymous"></script>

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
    text-decoration: none;
    font-size: 18px;
    float:left;
    color: white;
    width: calc(100% - 20px);
}
.menu:hover{
    color: #0b2c4d !important;
    background-color: #7FDBFF !important;
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

.card a:link{
    color: black;
}
.card a:visited{
    color: black;
}


</style>
<!--Fin estilos CSS-->

<!--Javascript-->
<script type="text/javascript" >

function guardarform(formnumber) {

	var form_data = new FormData();
    var foto = $('#foto' + formnumber)[0].files[0];

    form_data.append('foto' , foto);
    form_data.append('titulo' , $("#secciontitulo" + formnumber).val());
    form_data.append('informacion' , $("#seccioninfo" + formnumber).val());
    form_data.append('id' , formnumber);
    
    if (typeof foto !== "undefined") {
        
        form_data.append('imagen' , 'verdadero');
    
    } else {

        form_data.append('imagen' , 'falso');
    
    }
    

    //barra de progreso

    var progress_bar_id = '#progress-wrp' + formnumber; //ID of an element for response output

	$("#botonfile").prop( "disabled", true); //disable submit button

	$('#up' + formnumber).css('visibility','visible');
	$('#progress-wrp').css("visibility", "visible");
	var proceed = true; //set proceed flag
    
	//reset progressbar
	$(progress_bar_id +" .progress-bar").css("width", "0%");
	$(progress_bar_id + " .status").text("0%");

	
$.ajax({
	url : "modificarsecciones.php",
	type: "POST",
	data : form_data,
	cache: false,
    contentType: false,
    processData:false,
    dataType: 'json',
    xhr: function(){
		//upload Progress
		var xhr = $.ajaxSettings.xhr();
		if (xhr.upload) {
			xhr.upload.addEventListener('progress', function(event) {
				var percent = 0;
				var position = event.loaded || event.position;
				var total = event.total;
				if (event.lengthComputable) {
					percent = Math.ceil(position / total * 100);
				}
				//update progressbar
				$(progress_bar_id +" .progress-bar").css("width", + percent +"%");
				$(progress_bar_id + " .status").text(percent +"%");
				if (percent == "100") {
                    //indicacion de que termino de subir la imagen
				}
			}, true);
		}
		return xhr;
	},
   mimeType:"multipart/form-data"
    }).done(function(res){

        if (res.mensaje1 == "completo") {

            $("#foto" + formnumber).val('');
            $("#up" + formnumber).css('visibility', 'hidden');
            alert(res.mensaje2);

        } else {

            $('#up' + formnumber).css('visibility','hidden');
            $(progress_bar_id +" .progress-bar").css("width", "0%");
            $(progress_bar_id + " .status").text("0%");
            alert(res.mensaje2);
            return false;

        }

		
});


}

function enviar(id) {

    //carga el objeto del archivo
    var file = $("#foto" + id)[0].files[0];

    //Vista previa de la imagen

    var reader = new FileReader();
        
    //funcion que corre cuando ya se termino de subir el o los archivos
    reader.addEventListener("load", function(){


    var imagen = '<img id="imagenactual" src="' + reader.result  + '" style="width: 100%; float:left;" />';

    $("#contenedorimagenactual" + id).html(imagen);
        
    }, false);

    if(file){

        reader.readAsDataURL(file);
    }

}

function validaenvia(form) {

    var form = document.getElementById(form);

    if (form.seccioninfo.value == "") {

        alert("Por favor escribe alguna información para la sección");
        form.seccioninfo.focus()
        return false;

    }

    if (form.secciontitulo.value == "") {

        alert("Por favor escribe un título para la sección");
        form.secciontitulo.focus()
        return false;

    }



}


</script>
<!--Fin Javascript-->

</head>
<body>

<div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

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


            <div id="link">Secciones</div>

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

            <a class="menu" href="materias.php">Materias</a>

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

        <div id="contenedor-seccion1" class="card" style="width:calc(90% - 100px); margin: 5%; float: left;">
            
            <div id="titulo" style="padding-top: 50px; font-family: 'Montserrat', sans-serif; padding-bottom: 50px; font-size: 35px; color: #333; font-weight: bold; padding-left: 20px; letter-spacing: 1.6px;">Sección 1</div>
                        
            <form id="seccionform1" name="seccionform1" action="secciones.php" enctype="multipart/form-data" method="post" onSubmit="return(validaenvia('seccionform1'))">

                <input id="idseccion" name="idseccion" value="<?php echo $id1; ?>" type="hidden">

                <input id="secciontitulo1" name="secciontitulo1" placeholder="Escriba un titulo para esta sección" style="resize: none; background-color: #0b2c4d; font-size: 20px; background-color: white; width: calc(100% - 22px); margin-bottom: 30px; padding: 10px; float: left; border: 1px solid lightgray;" type="text" value="<?php echo $titulo1; ?>">

                <textarea id="seccioninfo1" name="seccioninfo1" placeholder="Escribe la información de la sección" style="resize: none; background-color: #0b2c4d; height: 600px; font-size: 13px; background-color: white; width: calc(50% - 22px); padding: 10px; float: left; border: 1px solid lightgray;"><?php echo $informacion1; ?></textarea>

                <div id="contenedorimagenactual1" align="center" style="padding: 0px 10px; max-height: 400px; overflow: hidden; width: calc(50% - 20px); float: left; margin-bottom: 10px;">

                    <img id="imagenactual" src="../images/<?php echo $imagen1; ?>" style="width: 100%; float:left;"/>

                </div>

                 <a href="javascript:void(0);" onclick="javascript:document.getElementById('foto1').click();"><div id="botonfile" align="center" style="border: 1px solid #333; margin:15px 0px; border-radius:10px; padding:10px; cursor:pointer; width: calc(50% - 42px); margin: 0px 10px; float: left;">

                    <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; height:0px; display:block;">

                    <img id="imgboton" src="../images/fileup-icon.png" style="height:20px;" alt="">

                    <div style="font-size:12px;">Subir imagen</div>

                    <input type="file" id="foto1" name="foto1" onchange="javascript:enviar('1');" style="display: none;" accept="image/jpeg" />  

                </div></a>

                <div id="up1" style="width:calc(50% - 22px); font-family: 'Montserrat', sans-serif; margin-left: 10px; color: white; margin-right: 10px; height:45px; float:left; position:relative; z-index:1; margin-top:10px; border-radius:5px; overflow:hidden; border:solid 1px #7FDBFF; margin-top:20px; visibility:hidden;">

                     <div id="progress-wrp1" style="color: white;" class="progress-wrp"><div class="progress-bar"></div ><div class="status" style="color: white; font-size:20px;">0%</div></div>

                </div>

                <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 20px; margin-bottom: 20px;"><button type="button" onclick="guardarform('1');" style="padding: 10px 20px; background-color: #1d4267; border-color: #7FDBFF; color: #7FDBFF; cursor: pointer;">Guardar cambios</button></div>

            </form>
        
        </div><!--Fin de contenedor-seccion1-->

        <div id="contenedor-seccion2" class="card" style="width:calc(90% - 100px); margin: 5%; float: left;">
            
            <div id="titulo" style="padding-top: 50px; font-family: 'Montserrat', sans-serif; padding-bottom: 50px; font-size: 35px; color: #333; font-weight: bold; padding-left: 20px; letter-spacing: 1.6px;">Sección 2</div>
                        
            <form id="seccionform2" name="seccionform2" action="secciones.php" enctype="multipart/form-data" method="post" onSubmit="return(validaenvia('seccionform2'))">

            <input id="idseccion" name="idseccion" value="<?php echo $id2; ?>" type="hidden">

            <input id="secciontitulo2" name="secciontitulo2" placeholder="Escriba un titulo para esta sección" style="resize: none; background-color: #0b2c4d; font-size: 20px; background-color: white; width: calc(100% - 22px); margin-bottom: 30px; padding: 10px; float: left; border: 1px solid lightgray;" type="text" value="<?php echo $titulo2; ?>">

                <textarea id="seccioninfo2" name="seccioninfo2" placeholder="Escribe la información de la sección" style="resize: none; background-color: #0b2c4d; height: 600px; font-size: 13px; background-color: white; width: calc(50% - 22px); padding: 10px; float: left; border: 1px solid lightgray;"><?php echo $informacion2; ?></textarea>

                <div id="contenedorimagenactual2" align="center" style="padding: 0px 10px; max-height: 400px; overflow: hidden; width: calc(50% - 20px); float: left;">

                <img id="imagenactual" src="../images/<?php echo $imagen2; ?>" style="width: 100%; float:left;">

                </div>

                <div id="contenedorimagepreview" align="center" style="padding: 0px 10px; margin-bottom: 20px; max-height: 400px; overflow: hidden; width: calc(50% - 20px); float: left;">

                    <div id="mensajevistaprevia" align="center" style=" float: left; width: 100%; line-height: 40px; font-size: 20px; color: #777;  font-family: 'Montserrat', sans-serif; display: none;">Vista previa</div>
                

                </div>

                 <a href="javascript:void(0);" onclick="javascript:document.getElementById('foto2').click();"><div id="botonfile" align="center" style="border: 1px solid #333; margin:15px 0px; border-radius:10px; padding:10px; cursor:pointer; width: calc(50% - 42px); margin: 0px 10px; float: left;">

                    <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; height:0px; display:block;">

                    <img id="imgboton" src="../images/fileup-icon.png" style="height:20px;" alt="">

                    <div style="font-size:12px;">Subir imagen</div>

                    <input type="file" id="foto2" name="foto2" onchange="javascript:enviar('2');" style="display: none;" accept="image/jpeg" />  

                </div></a>

                <div id="up2" style="width:calc(50% - 22px); font-family: 'Montserrat', sans-serif; margin-left: 10px; color: white; margin-right: 10px; height:45px; float:left; position:relative; z-index:1; margin-top:10px; border-radius:5px; overflow:hidden; border:solid 1px #7FDBFF; margin-top:20px; visibility:hidden;">

                     <div id="progress-wrp2" style="color: white;" class="progress-wrp"><div class="progress-bar"></div ><div class="status" style="color: white; font-size:20px;">0%</div></div>

                </div>

                <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 20px; margin-bottom: 20px;"><button type="button" onclick="guardarform('2');" style="padding: 10px 20px; background-color: #1d4267; border-color: #7FDBFF; color: #7FDBFF; cursor: pointer;">Guardar cambios</button></div>

            </form>
        
        </div>

        <div id="contenedor-seccion3" class="card" style="width:calc(90% - 100px); margin: 5%; float: left;">
            
            <div id="titulo" style="padding-top: 50px; font-family: 'Montserrat', sans-serif; padding-bottom: 50px; font-size: 35px; color: #333; font-weight: bold; padding-left: 20px; letter-spacing: 1.6px;">Sección 3</div>
                        
            <form id="seccionform3" name="seccionform3" action="secciones.php" enctype="multipart/form-data" method="post" onSubmit="return(validaenvia('seccionform3'))">

            <input id="idseccion" name="idseccion" value="<?php echo $id3; ?>" type="hidden">

            <input id="secciontitulo3" name="secciontitulo3" placeholder="Escriba un titulo para esta sección" style="resize: none; background-color: #0b2c4d; font-size: 20px; background-color: white; width: calc(100% - 22px); margin-bottom: 30px; padding: 10px; float: left; border: 1px solid lightgray;" type="text" value="<?php echo $titulo3; ?>">

                <textarea id="seccioninfo3" name="seccioninfo3" placeholder="Escribe la información de la sección" style="resize: none; background-color: #0b2c4d; height: 600px; font-size: 13px; background-color: white; width: calc(50% - 22px); padding: 10px; float: left; border: 1px solid lightgray;"><?php echo $informacion3; ?></textarea>

                <div id="contenedorimagenactual3" align="center" style="padding: 0px 10px; max-height: 400px; overflow: hidden; width: calc(50% - 20px); float: left;">

                    <img id="imagenactual" src="../images/<?php echo $imagen3; ?>" style="width: 100%; float:left;">

                </div>

                <div id="contenedorimagepreview" align="center" style="padding: 0px 10px; margin-bottom: 20px; max-height: 400px; overflow: hidden; width: calc(50% - 20px); float: left;">

                    <div id="mensajevistaprevia" align="center" style=" float: left; width: 100%; line-height: 40px; font-size: 20px; color: #777;  font-family: 'Montserrat', sans-serif; display: none;">Vista previa</div>
                

                </div>

                 <a href="javascript:void(0);" onclick="javascript:document.getElementById('foto3').click();"><div id="botonfile" align="center" style="border: 1px solid #333; margin:15px 0px; border-radius:10px; padding:10px; cursor:pointer; width: calc(50% - 42px); margin: 0px 10px; float: left;">

                    <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; height:0px; display:block;">

                    <img id="imgboton" src="../images/fileup-icon.png" style="height:20px;" alt="">

                    <div style="font-size:12px;">Subir imagen</div>

                    <input type="file" id="foto3" name="foto3" onchange="javascript:enviar('3');" style="display: none;" accept="image/jpeg" />  

                </div></a>

                <div id="up3" style="width:calc(50% - 22px); font-family: 'Montserrat', sans-serif; margin-left: 10px; color: white; margin-right: 10px; height:45px; float:left; position:relative; z-index:1; margin-top:10px; border-radius:5px; overflow:hidden; border:solid 1px #7FDBFF; margin-top:20px; visibility:hidden;">

                     <div id="progress-wrp3" style="color: white;" class="progress-wrp"><div class="progress-bar"></div ><div class="status" style="color: white; font-size:20px;">0%</div></div>

                </div>

                <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 20px; margin-bottom: 20px;"><button type="button" onclick="guardarform('3');" style="padding: 10px 20px; background-color: #1d4267; border-color: #7FDBFF; color: #7FDBFF; cursor: pointer;">Guardar cambios</button></div>

            </form>
        
        </div>





    </div>

    
</div>


</body>
</html>
