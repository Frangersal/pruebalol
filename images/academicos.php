<?php require_once('../Connections/conamatenlinea.php');
session_start();

if ($_SESSION['usuario'] == "") {
    
    header("Location: login.php");

}else{

    $usuario = $_SESSION['usuario'];
    $time = time();

}

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM academicos";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

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
<!--Fin estilos CSS-->

<!--Javascript-->
<script type="text/javascript" >

function guardarform(formnumber) {

    //validamos que no esten vacíos los campos

    if ( $("#academiconombre" + formnumber).val() == '') {
        
        alert("Por favor escribe un nombre");
        $("#academiconombre" + formnumber).focus();
        return false;
    }

    if ( $("#academicobiografia" + formnumber).val() == '') {
        
        alert("Porfavor escribe una biografía");
        $("#academicobiografia" + formnumber).focus()
        return false;
    }

    if (formnumber == 0 ) {
        
        if ( typeof $('#foto' + formnumber)[0].files[0] === "undefined" ) {

            alert("Por favor agrega una imagen para el nuevo académico");
            return false;
        }

    }

    //Creamos un form para enviar en post

	var form_data = new FormData();
    var foto = $('#foto' + formnumber)[0].files[0];

    form_data.append('foto' , foto);
    form_data.append('nombre' , $("#academiconombre" + formnumber).val());
    form_data.append('biografia' , $("#academicobiografia" + formnumber).val());
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
	$('#progress-wrp' + formnumber).css("visibility", "visible");

	$('#up' + formnumber).css('display','block');
	$('#progress-wrp' + formnumber).css("display", "block");
	var proceed = true; //set proceed flag
    
	//reset progressbar
	$(progress_bar_id +" .progress-bar").css("width", "0%");
	$(progress_bar_id + " .status").text("0%");

	
$.ajax({

	url : "agregaracademico.php",
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
            $('#up' + formnumber).css('display','none');

        } else {

            $('#up' + formnumber).css('display','none');
            $(progress_bar_id +" .progress-bar").css("width", "0%");
            $(progress_bar_id + " .status").text("0%");
            alert(res.mensaje2);
            return false;

        }

	
});

alert("Se han guardado los cambios");

$("#up" + formnumber).hide();

if (formnumber == 0) {
    $("#contenedor-academico0").hide();
}
	

location.reload();

}

function enviar(id) {

    //carga el objeto del archivo
    var file = $("#foto" + id)[0].files[0];

    //Vista previa de la imagen

    var reader = new FileReader();
        
    //funcion que corre cuando ya se termino de subir el o los archivos
    reader.addEventListener("load", function(){

        $("#contenedorimagenactual" + id).css("background-image", "url(" + reader.result + ")");
        
    }, false);

    if(file){

        reader.readAsDataURL(file);
    }

}

function nuevo(){

    $("#contenedor-academico0").slideToggle("fast");

    var boton = $("#botonagregar");

    if (boton.text() == "Agregar académico") {

        boton.text("Cerrar")
    
    } else {

        boton.text("Agregar académico")
    
    }
    
}

function eliminar(id) {

    if (confirm("¿Estás seguro de eliminar este académico?")==1) {

        location.href="eliminaracademico.php?id="+id;

    }

}


function modificar(id) {

location.href = "modificaracademico.php?id=" + id;

}

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

<?php

    if ($permiso == 1) {

?>

            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">CONTENIDO PÁGINA</div>

<?php 

    }

    if ($permiso == 2 || $permiso == 1) {

?>

            <div id="link">Académicos</div>

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

    <a href="Javascript:void(0)" onclick="nuevo()"><div id="botonagregar" align="center" style=" width: 100%; float: left; padding-top: 20px; padding-bottom: 20px; cursor: pointer; font-size: 16px; font-family: 'Montserrat', sans-serif; background: #305b84;text-decoration: underline;">Agregar académico</div></a>

    <div id="contenedor-academico0" class="card" align="center" style="width:calc(70% - 120px); margin-left: 15%; float: left; display: none; margin-bottom: 40px;">
        
        <form id="academicoform0" name="nuevoacademicoform" action="academicos.php" enctype="multipart/form-data" method="post">

            <div id="titulo" style="width: 100%; margin-bottom: 40px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Nuevo académico</div>

            <input id="idacademico0" name="idacademico0" value="0" type="hidden">

            <div id="contenedorsubidaimagen" style="float: left; width: calc(30% - 20px); margin-right: 20px;">

                <div id="contenedorimagenactual0" class="imagenmaestro" align="center" style="background-color: lightgray;"></div>

                 <a href="javascript:void(0);" onclick="javascript:document.getElementById('foto0').click();"><div id="botonfile" align="center" style="border: 1px solid #1d4267; background-color: #1d4267; margin-top: 20px; color: #7FDBFF; padding:10px; cursor:pointer; width: calc(100% - 22px); float: left;">

                    <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; background-color: #1d4267; height:0px; display:block;">

                    <div style="font-size:12px;">Elegir imagen</div>

                    <input type="file" id="foto0" name="foto0" onchange="javascript:enviar('0');" style="display: none;" accept="image/jpeg" />  

                </div></a>

            </div>

            <div id="up0" style="width:calc(100% - 22px); font-family: 'Montserrat', sans-serif; margin-left: 10px; color: white; margin-right: 10px; height:45px; float:left; position:relative; z-index:1;  border-radius:5px; overflow:hidden; border:solid 1px #7FDBFF; margin-top: 10px; margin-bottom: 10px; display: none; visibility:hidden;">

                 <div id="progress-wrp0" style="color: white;" class="progress-wrp"><div class="progress-bar"></div ><div class="status" style="color: white; ">0%</div></div>

            </div>

            <input id="academiconombre0" name="academiconombre0" placeholder="Escribe un nombre" style="resize: none; background-color: #0b2c4d; font-size: 12px; background-color: white; width: calc(70% - 12px); margin-bottom: 10px; padding: 5px; float: left; border: 1px solid lightgray;" type="text" value="">

            <textarea id="academicobiografia0" name="academicobiografia0" placeholder="Escribe una biografía" style="resize: none; background-color: #0b2c4d; height: 170px; font-size: 12px; background-color: white; width: calc(70% - 12px); padding: 5px; float: left; border: 1px solid lightgray;"></textarea>

            <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 20px; margin-bottom: 20px;"><button type="button" onclick="guardarform('0');" style="border-radius: 10px; line-height: 30px; background-color: #1d4267; border-color: #7FDBFF; padding-left: 20px; padding-right: 20px; margin-top: 20px; color: #7FDBFF; cursor: pointer;">Guardar cambios</button></div>

        </form>
    
    </div><!--Fin de contenedor-nuevoacademico-->

<div id="seccionacademicos" style="width: 100%; background-color: #fff; text-align:center; float:left; float: left;">

    <div id="tituloseccion" style="line-height: 40px; margin-top: 10px; color:#777; border-bottom: 2px solid lightgray; margin-left: 10px; margin-right: 10px; font-size: 20px; text-align: left;">Lista de académicos</div>

<?php 

$numcurso = 1;

if ($totalRows_Recordset1 > 0) {
    
    do{

        $nombre = $row_Recordset1['nombre'];
        $biografia = $row_Recordset1['biografia'];
        $imagen = $row_Recordset1['imagen'];
        $id = $row_Recordset1['id'];

?>


            <!--Noticia 1 -->
            <div id="academico<?php $id; ?>" style="float: left; overflow: hidden;width:calc(100% - 20px);height: 155px;background-color:#FFF;display:inline-block; border-bottom:1px solid lightgray;padding-bottom: 20px;padding-top: 20px; margin-left: 10px;">

                <a href=""><div id="imagen<?php $id; ?>" style="width: 20%;height: 150px;float:left;padding-left: 10px;padding-right: 10px;background-image:url('../images/<?php echo $imagen; ?>');background-size: cover;background-position: center;background-repeat: no-repeat;">
                </div></a>

                <a href=""> <div id="title" style="padding-right: 5%;padding-left: 5%;text-align: left;letter-spacing: 1.5px;width: 65%;line-height:20px;float:left;margin-top:20px;color:black;font-size: 18px;font-weight:bold;"><?php echo $nombre; ?></div></a>

                <div id="biografia" align="center" style="text-align: left;width: 65%;padding-left:5%;height: 55px;overflow: hidden;padding-right:5%;float:left;margin-top:20px;color:#6A6969;font-size: 14px;"><?php echo $biografia; ?></div>

                <div id="botonesdeedicion" style="float:right; margin-top: 10px; margin-right: 10px; margin-left: 10px;"> 

                    <button id="botoneliminar" type="button" onclick="javascript:eliminar('<?php echo $id; ?>');" style="font-family: montserrat;border: solid #ed0000 2px;background: #f50000b5;float: right;border-radius: 5px;width: 100px;margin-left: 10px; cursor: pointer; font-size: 12px;color: white;padding-top: 10px; padding-bottom: 10px;">Eliminar</button>

                    <button id="botonmodificar" type="button" onclick="javascript:modificar('<?php echo $id; ?>');" style="font-family: montserrat;border: solid #595f61 2px;background: #00020287;float: right;border-radius: 5px;width: 100px;font-size: 12px;cursor: pointer;color: white;padding-top: 10px;padding-bottom: 10px;">Modificar</button>

                </div>

            </div>

<?php 

    $numcurso = $numcurso + 1;

    }while($row_Recordset1 = mysql_fetch_assoc($Recordset1));

} else {
?>

    <div id="nohay" align="center" style="float: left; width: 100%; color: #fff; line-height: 300px; ">No se encontraron cursos registrados</div>

<?php
}

?>

</div>
</body>
</html>
