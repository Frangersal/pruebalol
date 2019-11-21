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

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM quienessomos";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

$quienessomos = $row_Recordset1['quienessomos'];
$imagenactual = $row_Recordset1['imagen'];
    
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
#quienessomosform a:link{
    color: black;
}
#quienessomosform a:visited{
    color: black;
}


</style>
<!--Fin estilos CSS-->

<!--Javascript-->
<script type="text/javascript" >

function guardarform() {

	var form_data = new FormData();
    form_data.append('foto' , $('#foto')[0].files[0]);
    form_data.append('quienessomos' , $("#quienessomos").val());
    //barra de progreso

    var progress_bar_id = '#progress-wrp'; //ID of an element for response output

	$("#botonfile").prop( "disabled", true); //disable submit button

	$('#progress-wrp').css("visibility", "visible");

	var proceed = true; //set proceed flag
    
	//reset progressbar
	$(progress_bar_id +" .progress-bar").css("width", "0%");
	$(progress_bar_id + " .status").text("0%");
	
$.ajax({
	url : "modificarquienessomos.php",
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
			}, true);
		}
		return xhr;
	},
   mimeType:"multipart/form-data"
    }).done(function(res){
        

        if (res.mensaje1 == "completo") {

            $("#foto").val('');
            alert("Se han guardado los cambios");
            $('#up').css('visibility','hidden');
            $(progress_bar_id).css('visibility', 'hidden')

        } else {


            $('#up').css('visibility','hidden');
            $(progress_bar_id +" .progress-bar").css("width", "0%");
            $(progress_bar_id + " .status").text("0%");
            alert(res.mensaje2);
            return false;

        }
		


});

}

function enviar() {

    var file = $("#foto")[0].files[0];

    $("#contenedorimagenactual").hide();

    var reader = new FileReader();
        
    //funcion que corre cuando ya se termino de subir el o los archivos
    reader.addEventListener("load", function(){


        var imagen = '<img id="imagenactual" src="' + reader.result  + '" style="width: 100%; float:left;" />';

        $("#contenedorimagepreview").html(imagen);
        
    }, false);

    if(file){

        reader.readAsDataURL(file);
    }

}

function validaenvia() {


    if (document.quienessomosform.quienessomos.value == "") {

        alert("Por favor escribe algo");
        document.quienessomosform.quienessomos.focus()
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

            <div id="link">Quiénes somos</div>

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

        <div id="contenedor-quienessomos" class="card" style="width:calc(90% - 100px); margin: 5%; float: left;">
            
            <div id="titulo" style="padding-top: 50px; font-family: 'Montserrat', sans-serif; padding-bottom: 50px; font-size: 35px; color: #333; font-weight: bold; padding-left: 20px; letter-spacing: 1.6px;">Quiénes somos</div>
                        
            <form id="quienessomosform" name="quienessomosform" action="quienessomos.php" enctype="multipart/form-data" method="post" onSubmit="return(validaenvia())">

                <textarea id="quienessomos" name="quienessomos" style="resize: none; background-color: #0b2c4d; height: 600px; font-size: 13px; background-color: white; width: calc(50% - 22px); padding: 10px; float: left; border: 1px solid lightgray;"><?php echo $quienessomos; ?></textarea>

                <div id="contenedorimagenactual" align="center" style="padding: 0px 10px; max-height: 400px; overflow: hidden; width: calc(50% - 20px); float: left;">

                    <img id="imagenactual" src="../images/<?php echo $imagenactual; ?>" style="width: 100%; float:left;"> 

                </div>

                <div id="contenedorimagepreview" align="center" style="padding: 0px 10px; margin-bottom: 20px; max-height: 400px; overflow: hidden; width: calc(50% - 20px); float: left;">


                </div>

                 <a href="javascript:void(0);" onclick="javascript:document.getElementById('foto').click();"><div id="botonfile" align="center" style="border: 1px solid #333; margin:15px 0px; border-radius:10px; padding:10px; cursor:pointer; width: calc(50% - 42px); margin: 0px 10px; float: left;">

                    <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; height:0px; display:block;">

                    <img id="imgboton" src="../images/fileup-icon.png" style="height:20px;" alt="">

                    <div style="font-size:12px;">Subir imagen</div>

                    <input type="file" id="foto" name="foto" onchange="javascript:enviar();" style="display: none;" accept="image/jpeg" />  

                </div></a>

                <div id="up" style="width:calc(50% - 22px); font-family: 'Montserrat', sans-serif; margin-left: 10px; color: white; margin-right: 10px; height:45px; float:left; position:relative; z-index:1; margin-top:10px; border-radius:5px; overflow:hidden; border:solid 1px #7FDBFF; margin-top:20px; visibility:hidden;">

                     <div id="progress-wrp" style="color: white;" class="progress-wrp"><div class="progress-bar"></div ><div class="status" style="color: white; font-size:20px;">0%</div></div>

                </div>

                <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 20px; margin-bottom: 20px;"><button type="button" onclick="guardarform();" style="padding: 10px 20px; background-color: #1d4267; border-color: #7FDBFF; color: #7FDBFF; cursor: pointer;">Guardar cambios</button></div>

            </form>
        
        </div>

    </div>
    
</div>


</body>
</html>
