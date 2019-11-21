<?php
session_start();
require_once('../Connections/conamatenlinea.php');

if ($_SESSION['usuario'] == "") {
    
    header("Location: login.php");

}else{

    $usuario = $_SESSION['usuario'];
    $time = time();

}

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM cursos";
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">  
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script
      src="https://code.jquery.com/jquery-3.3.1.js"
      integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
      crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"></link>


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
    padding: 10px 30px;
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
.imagencurso{
    width: 100%;
    overflow: hidden;
    float: left;
    padding-bottom: 80%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;

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
.tip:hover {
	background-color: lightblue; /* Color pendiente */
	cursor: pointer; /* reemplaza el cursor highlighter */
}
.delete{
    cursor: pointer;
}


</style>
<!--Fin estilos CSS-->

<!--Javascript-->
<script type="text/javascript" >


$(document).ready(function() {

    $("#fechainicio0").datepicker();
    $("#fechafinal0").datepicker();

    $("#materias").on("keyup", "#materia", function(event){

        clearTimeout($.data(this, 'timer'));
        var wait = setTimeout(search, 500);
        $(this).data('timer', wait);

    });

    $("#libros").on("keyup", "#libro", function(event){

        clearTimeout($.data(this, 'timer'));
        var wait = setTimeout(search2, 500);
        $(this).data('timer', wait);

    });


    function search() {
        var num = document.getElementById("nummaterias").value;
        $.post("buscarmaterias.php?numSelec=" + num + "", {userinput: "" + $('#materia').val() + ""}, function(data){
        if(data.length > 0) {
          $('#menucontextomateria').show();
          $('#menucontextomateria').html(data);
        }else if(data.length == 0){
          $('#menucontextomateria').hide();
        }
      });
    }

    function search2() {
        var num = document.getElementById("numlibros").value;
        $.post("buscarlibros.php?numSelec=" + num + "", {userinput: "" + $('#libro').val() + ""}, function(data){
        if(data.length > 0) {
          $('#menucontextolibro').show();
          $('#menucontextolibro').html(data);
        }else if(data.length == 0){
          $('#menucontextolibro').hide();
        }
      });
    }


    $("#materiacontenedorinput #menucontextomateria").on("click", ".tip", function(event){

    var value     = event.target.innerHTML;
    var num       = document.getElementById("nummaterias").value;
    var numasuno  = parseInt(num, 10) + 1; // este es el numero de usuarios mas 1
    var materia = $(this).find("input[id^='materia']").val(); //el selector de children = todos los input que su id empieze con 'alumno'
    var idmateria  = $(this).find("input[id^='idmateria']").val();
    $("#menucontextomateria").hide();
    var cont = '<div id="materia' + numasuno + '" name="materia' + numasuno + '" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;"><span style="margin-right:5px;">'+ value +'</span><img class="delete" src="../images/x.png" height="15" width="10" align="right"></div>';

    $("#materias").prepend(cont);
    num = parseInt(num,10)+parseInt(1,10);
    document.getElementById("nummaterias").value = num;
    $("#materia").val('');
    $("#materia").focus();
    $.post("newSelec.php?total="+num+"&id="+idmateria);

});

$("#librocontenedorinput #menucontextolibro").on("click", ".tip", function(event){

    var value     = event.target.innerHTML;
    var num       = document.getElementById("numlibros").value;
    var numasuno  = parseInt(num, 10) + 1; // este es el numero de usuarios mas 1
    var libro = $(this).find("input[id^='libro']").val(); //el selector de children = todos los input que su id empieze con 'alumno'
    var idlibro  = $(this).find("input[id^='idlibro']").val();
    $("#menucontextolibro").hide();
    var cont = '<div id="libro' + numasuno + '" name="libro' + numasuno + '" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;"><span style="margin-right:5px;">'+ value +'</span><img class="delete" src="../images/x.png" height="15" width="10" align="right"></div>';

    $("#libros").prepend(cont);
    num = parseInt(num,10)+parseInt(1,10);
    document.getElementById("numlibros").value = num;
    $("#libro").val('');
    $("#libro").focus();
    $.post("newSelec.php?total="+num+"&id="+idlibro);

});


$("#materias").on("click", ".delete", function(event){
    var num = document.getElementById("nummaterias").value;
    num = parseInt(num,10)-parseInt(1,10);
    document.getElementById("nummaterias").value = num;
    var targetid = parseInt($(this).parent().attr('id'), 10);
    var contador = 1;
    do{
        
        var newid = targetid + (contador - 1);
        var oldid = targetid + contador;
        $("#" + oldid).attr('id', newid);
        contador++;
        
    }while(contador <= num);
    $(this).parent().remove();
   
});


$("#libros").on("click", ".delete", function(event){
    var num = document.getElementById("numlibros").value;
    num = parseInt(num,10)-parseInt(1,10);
    document.getElementById("numlibros").value = num;
    var targetid = parseInt($(this).parent().attr('id'), 10);
    var contador = 1;
    do{
        
        var newid = targetid + (contador - 1);
        var oldid = targetid + contador;
        $("#" + oldid).attr('id', newid);
        contador++;
        
    }while(contador <= num);
    $(this).parent().remove();
   
});

});

function guardarform(formnumber) {

    //validamos que no esten vacíos los campos

    if ( $("#nombrecurso" + formnumber).val() == '') {
        
        alert("Por favor escribe un nombre");
        $("#nombrecurso" + formnumber).focus();
        return false;
    }

    if ( $("descripcioncurso" + formnumber).val() == '') {
        
        alert("Porfavor escribe una descripción");
        $("#descripcioncruso" + formnumber).focus()
        return false;
    }

    if (formnumber == 0 ) {
        
        if ( typeof $('#foto' + formnumber)[0].files[0] === "undefined" ) {

            alert("Por favor agrega una imagen para el nuevo curso");
            return false;
        }

    }

    //Creamos un form para enviar en post

	var form_data = new FormData();
    var foto = $('#foto' + formnumber)[0].files[0];

    form_data.append('foto' , foto);
    form_data.append('nombre' , $("#nombrecurso" + formnumber).val());
    form_data.append('descripcion' , $("#descripcioncurso" + formnumber).val());
    form_data.append('costo' , $("#costo" + formnumber).val());
    form_data.append('fechainicio' , $("#fechainicio" + formnumber).val());
    form_data.append('fechafinal' , $("#fechafinal" + formnumber).val());
    form_data.append('id' , formnumber);

    var nummaterias = $("#nummaterias").val();
    form_data.append('nummaterias', nummaterias);
    var numlibros = $("#numlibros").val();
    form_data.append('numlibros', numlibros);

    for (var i = 1; i <= nummaterias; i++) {

        form_data.append("idmateria" + i , $("#idmateria" + i).val());
        
    }

    for (var j = 1; j <= numlibros; j++) {

        form_data.append("idlibro" + j , $("#idlibro" + j).val());

    }

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

	url : "modificarcurso.php",
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
    $("#contenedor-curso0").hide();
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

    $("#contenedor-curso0").slideToggle("fast");

    var boton = $("#botonagregar");

    if (boton.text() == "Agregar curso") {

        boton.text("Cerrar")
    
    } else {

        boton.text("Agregar curso")
    
    }
    
}


function modificar(id){

    location.href="editarcurso.php?id="+id;

}

function eliminar(id) {

    if (confirm("¿Estás seguro de eliminar este curso?")==1) {

        location.href="eliminarcurso.php?id="+id;

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

            <a class="menu" href="alumnos.php">Alumnos</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="ayuda.php">Ayuda</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
            <a class="menu" href="biblioteca.php">Biblioteca</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <div id="link">Cursos</div>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="materias.php">Materias</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="pagos.php">Pagos</a>

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

    <div id="seccionprincipal" style="height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">

    <div id="contenedor-curso1" class="card" style="width:calc(100% - 60px); float: left; margin-bottom: 40px;">

        <div id="titulocurso" align="center" style="font-size: 25px; line-height: 60px; float: left; width: 100%;"><?php echo $nombre; ?> </div>
        
        <form id="cursoform" name="nuevocursoform" action="" enctype="multipart/form-data" method="post">

            <input id="idcurso" name="idcurso" value="" type="hidden">

            <div id="contienesubidaimagen" style="width: 25%; float: left;">

            <div id="contenedorimagenactual" class="imagencurso" align="center" style="background-color: #c1c1c1; background-image: url(../images/nuevocurso.png); background-size: contain; background-position: center;"></div>

                 <a href="javascript:void(0);" onclick="javascript:document.getElementById('foto1').click();"><div id="botonfile" align="center" style="border: 1px solid #1d4267; background-color: #1d4267; color: #7FDBFF; padding: 5px; cursor:pointer; margin-top: 10px; width: calc(100% - 12px); float: left;">

                    <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; height:0px; display:block; background-color: #1d4267;">

                    <div style="font-size:12px;">Elegir imagen</div>

                    <input type="file" id="foto" name="foto" onchange="javascript:enviar('1');" style="display: none;" accept="image/jpeg">  

                </div></a>

                <div id="up" style="width:calc(100% - 22px); font-family: 'Montserrat', sans-serif; margin-left: 10px; color: white; margin-right: 10px; height:45px; float:left; position:relative; z-index:1;  border-radius:5px; overflow:hidden; border:solid 1px #7FDBFF; margin-top: 10px; margin-bottom: 10px; display: none; visibility:hidden;">

                     <div id="progress-wrp" style="color: white;" class="progress-wrp"><div class="progress-bar"></div><div class="status" style="color: white; font-size:20px;">0%</div></div>

                </div>

                <div id="contenedorcaracteristicas" style="width: 100%; float:left;">

                    <div id="contenedorfechainicio" style="width: calc(50% - 10px); float: left; padding: 5px;">

                        <div class="etiquetainput" style="font-size: 13px;"> Fecha inicio <?php echo $fechainicio; ?></div>

                        <input id="fechainicio" name="fechainicio" align="center" style="width:  calc(100% - 10px); line-height: 20px; padding-left: 5px;" type="text" value="31/12/1969" class="hasDatepicker">

                    </div>

                    <div id="contenedorfechafinal" style="width: calc(50% - 10px); float: left; padding: 5px;">

                        <div class="etiquetainput" style="font-size: 13px;">Fecha final <?php echo $fechafinal; ?></div>

                        <input id="fechafinal" name="fechafinal" align="center" style="width: calc(100% - 10px); line-height: 20px; padding-left: 5px;" type="text" value="31/12/1969" class="hasDatepicker">

                    </div>


                    <div id="contenedorcosto" style="width: calc(100% - 10px); float: left; padding: 5px;">

                        <div class="etiquetainput" style="font-size: 13px;">Costo</div>

                        <input id="costo" name="costo" style="width: calc(100% - 10px); line-height: 20px; padding-left: 5px;" type="text" value="">

                    </div>

                </div>

            </div>


            <input id="nombrecurso" name="nombrecurso" placeholder="Escribe el nombre del curso" style="resize: none; background-color: #0b2c4d; font-size: 12px; background-color: white; width: calc(75% - 32px); margin-left: 10px; margin-bottom: 10px; padding: 5px; float: left; border: 1px solid lightgray;" type="text" value="">


            <textarea id="descripcioncurso" name="descripcioncurso" placeholder="Escribe la descripción del curso" style="resize: none; background-color: #0b2c4d; height: 283px; font-size: 12px; background-color: white; width: calc(75% - 32px); margin: 0px 10px; margin-bottom: 5px; padding: 5px; float: left; border: 1px solid lightgray;"></textarea>

            <!-- Fin de contenedorcaracteristicas -->

            <div id="contenedoretiquetas" style="width: 100%; float: left;">

                <div id="contenedormaterias" style="width: calc(50% - 10px);  float: left; padding: 5px;">

                    <div class="etiquetainput" style="font-size: 13px;">Materias</div>

                    <input id="nummaterias" name="nummaterias" type="hidden" value="15">

                    <div id="materias" style="width: calc(100% - 10px); float:left; border: 1px solid lightgray; margin-top: 5px; padding: 5px;">


                        <div id="materia1" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idmateria1" name="idmateria1" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia2" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idmateria2" name="idmateria2" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia3" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idmateria3" name="idmateria3" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia4" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idmateria4" name="idmateria4" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia5" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idmateria5" name="idmateria5" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia6" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">Fisica<input id="idmateria6" name="idmateria6" type="hidden" value="4"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia7" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">Matemáticas<input id="idmateria7" name="idmateria7" type="hidden" value="3"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia8" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">Fisica<input id="idmateria8" name="idmateria8" type="hidden" value="4"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia9" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">Matemáticas<input id="idmateria9" name="idmateria9" type="hidden" value="3"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia10" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">Ingeniería<input id="idmateria10" name="idmateria10" type="hidden" value="5"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia11" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">Fisica<input id="idmateria11" name="idmateria11" type="hidden" value="4"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia12" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">Matemáticas<input id="idmateria12" name="idmateria12" type="hidden" value="3"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia13" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">Fisica<input id="idmateria13" name="idmateria13" type="hidden" value="4"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia14" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">Matemáticas<input id="idmateria14" name="idmateria14" type="hidden" value="3"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materia15" name="materia" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">Ingeniería<input id="idmateria15" name="idmateria15" type="hidden" value="5"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="materiacontenedorinput" style="width: 40%; position: relative; float:left; margin-top: 5px; line-height: 14px; margin-left: 5px;">

                            <input type="text" id="materia" name="materia" style="width: calc(100% - 10px); border: none; line-height: 20px; padding-left: 5px;" placeholder="Escribe una materia" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                            <div id="menucontextomateria" style="color:#000; background-color:#fff; width:100%; background-color:#CFCECE; position:absolute; bottom: -12px; z-index:1;"></div>

                        </div>

                    </div>

                </div>


                <div id="contenedorlibros" style="width: calc(50% - 10px); float: left; padding: 5px;">

                    <div class="etiquetainput" style="font-size: 13px;">Libros</div>

                    <input id="numlibros" name="numlibros" type="hidden" value="37">

                    <div id="libros" style="width: calc(100% - 10px); float:left; border: 1px solid lightgray; margin-top: 5px; padding: 5px;">


                        <div id="libro1" name="libro1" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro1" name="idlibro1" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro2" name="libro2" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro2" name="idlibro2" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro3" name="libro3" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro3" name="idlibro3" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro4" name="libro4" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro4" name="idlibro4" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro5" name="libro5" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro5" name="idlibro5" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro6" name="libro6" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro6" name="idlibro6" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro7" name="libro7" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro7" name="idlibro7" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro8" name="libro8" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro8" name="idlibro8" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro9" name="libro9" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro9" name="idlibro9" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro10" name="libro10" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro10" name="idlibro10" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro11" name="libro11" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro11" name="idlibro11" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro12" name="libro12" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro12" name="idlibro12" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro13" name="libro13" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro13" name="idlibro13" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro14" name="libro14" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro14" name="idlibro14" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro15" name="libro15" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro15" name="idlibro15" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro16" name="libro16" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro16" name="idlibro16" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro17" name="libro17" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro17" name="idlibro17" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro18" name="libro18" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro18" name="idlibro18" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro19" name="libro19" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro19" name="idlibro19" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro20" name="libro20" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro20" name="idlibro20" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro21" name="libro21" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro21" name="idlibro21" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro22" name="libro22" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro22" name="idlibro22" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro23" name="libro23" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro23" name="idlibro23" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro24" name="libro24" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro24" name="idlibro24" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro25" name="libro25" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro25" name="idlibro25" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro26" name="libro26" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro26" name="idlibro26" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro27" name="libro27" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">estamodificado<input id="idlibro27" name="idlibro27" type="hidden" value="33"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro28" name="libro28" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">estamodificado<input id="idlibro28" name="idlibro28" type="hidden" value="33"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro29" name="libro29" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">asdasd<input id="idlibro29" name="idlibro29" type="hidden" value="32"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro30" name="libro30" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">asdasd<input id="idlibro30" name="idlibro30" type="hidden" value="32"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro31" name="libro31" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">cxvbsdfgsdfg<input id="idlibro31" name="idlibro31" type="hidden" value="30"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro32" name="libro32" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;"><input id="idlibro32" name="idlibro32" type="hidden" value=""></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro33" name="libro33" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">cxvbsdfgsdfg<input id="idlibro33" name="idlibro33" type="hidden" value="30"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro34" name="libro34" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">cxvbsdfgsdfg<input id="idlibro34" name="idlibro34" type="hidden" value="30"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro35" name="libro35" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">asdasd<input id="idlibro35" name="idlibro35" type="hidden" value="32"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro36" name="libro36" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">aveeer<input id="idlibro36" name="idlibro36" type="hidden" value="31"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>

                        <div id="libro37" name="libro37" style="float:left; font-size:12px; padding:5px; background-color:lightblue; margin-top:5px; margin-left:5px; margin-bottom:5px; display:block;">

                            <span style="margin-right:5px;">asdasd<input id="idlibro37" name="idlibro37" type="hidden" value="32"></span>

                            <img class="delete" src="../images/x.png" height="15" width="10" align="right">
                             
                        </div>



                        <div id="librocontenedorinput" style="width: 40%; position: relative; float:left; margin-top: 5px; line-height: 14px; margin-left: 5px;">

                            <input type="text" id="libro" name="libro" style="width: calc(100% - 10px); border: none; line-height: 20px; padding-left: 5px;" placeholder="Escribe un titulo" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                            <div id="menucontextolibro" style="color:#000; background-color:#fff; width:100%; background-color:#CFCECE; position:absolute; bottom: -12px; z-index:1;"></div>

                        </div>

                    </div>

                </div>

            </div>

            <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 50px; margin-bottom: 20px;"><button type="button" onclick="guardarform('');" style=" padding: 5px 15px; background-color: #1d4267; font-size: 14px; border-color: #7FDBFF; color: #7FDBFF; cursor: pointer;">Guardar cambios</button></div>

        </form>
    
    </div><!--Fin de contenedor-nuevocurso-->




</div></div>
</body>
</html>

