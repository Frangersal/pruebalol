<?php
session_start();
date_default_timezone_set('America/Mexico_City');
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

    $(function() {
	$.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $("#fechainicio0").datepicker({dateFormat: "yy-mm-dd"});
});

    $(function() {
	$.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $("#fechafinal0").datepicker({dateFormat: "yy-mm-dd"});
});


});

function guardarform(formnumber) {


    /*

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

     */

    //Creamos un form para enviar en post

	var form_data = new FormData();

    var foto = $('#foto' + formnumber)[0].files[0];

    if (typeof foto !== "undefined") {
        
        form_data.append('imagen' , 'verdadero');
    
    } else {

        form_data.append('imagen' , 'falso');
    
    }


    form_data.append('foto' , foto);
    form_data.append('nombre' , $("#nombrecurso" + formnumber).val());
    form_data.append('descripcion' , $("#descripcioncurso" + formnumber).val());
    form_data.append('costo' , $("#costo").val());
    form_data.append('sesiones' , $("#sesiones").val());
    form_data.append('fechainicio' , $("#fechainicio" + formnumber).val());
    form_data.append('fechafinal' , $("#fechafinal" + formnumber).val());
    form_data.append('id' , formnumber);

    //materias y modulos

    var nummaterias = 0;
    var modulosmaterias = [];
    var modulosmaestros = [];
    
    var nummodulos = $("#nummodulos").val();

    for(var i = 1; i <= nummodulos; i++) {

        var idmaterias = [];
        var idmaestros = [];

        nummaterias = $("#nummaterias" + i).val();

        for(var j = 1; j <= nummaterias; j++) {

            idmaterias[j-1] = $("#materias" + i + " #materia" + j).val();

            idmaestros[j-1] = $("#materias" + i + " #maestro" + j).val();

        }

        modulosmaterias[i-1] = idmaterias;

        modulosmaestros[i-1] = idmaestros;
        
    }

    form_data.append('nummodulos' , nummodulos);
    form_data.append('modulosmaterias' , JSON.stringify(modulosmaterias));
    form_data.append('modulosmaestros' , JSON.stringify(modulosmaestros));


$.ajax({

	url : "modificarcurso.php",
	type: "POST",
	data: form_data,
	cache: false,
    contentType: false,
    processData:false,
    dataType: 'json',
    mimeType:"multipart/form-data"

    }).done(function (){
        location.reload();
    });



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


function valida_envia() {

    if ($("#materia1").val() == '') {

    alert("Porfavor especifica una materia del curso");
    $("#materia1").focus();
    return false;
    }

    if ($("#maestro1").val() == '') {

    alert("Porfavor especifica un maestro para el curso");
    $("#maestro1").focus();
    return false;
    }

    if ($("#grupo").val() == '') {

    alert("Porfavor especifica un grupo para el curso");
    $("#grupo").focus();
    return false;
    }

}


    $(document).ready(function(){

    $('#agregarmodulo').click(function() {

    var nummodulos = parseInt($("#nummodulos").val()) + 1;

    $("#nummodulos").val(nummodulos);
     
    $('#contienemodulos').append('<div id="contenedormodulo'+nummodulos+'" style="width: 70%; float: left; margin-bottom: 10px; margin-left: 15%; margin-right: 15%;"> <div id="modulo'+nummodulos+'" name="contenedormodulo" style="font-size: 12px;  width: calc(100% - 22px); padding: 10px; float: left; border: 1px solid lightgray;"> <div id="nombremod" style="width:100%; float: left; font-size: 14px; text-transform: uppercase; font-weight: bold;">  Módulo '+nummodulos+' </div> <div id="contenedorbotones" align="center" style="padding: 0px 20px; margin: 20px 20px; float: left; width: calc(100% - 80px);"> <button id="botonagregar'+nummodulos+'" type="button" onclick="javascript:agregarmateria('+nummodulos+');" style="border-radius: 7px;float: left;margin: 5px 15%;padding: 5px 15px;background-color: #23a11b;font-size: 14px;border-color: #028401eb;color: #e4ffe7;cursor: pointer;width: 150px;">Agregar materia</button> <button id="botoneliminar'+nummodulos+'" type="button" onclick="javascript:eliminarmateria('+nummodulos+');" style="border-radius: 7px; float: left; margin: 5px 40px; padding: 5px 15px; background-color: #d70707; font-size: 14px; border-color: #b80a0a; color: #f8e6e6; cursor: pointer; width: 150px; height: 30px; display:none;">Eliminar materia</button> </div> <div id="materias'+nummodulos+'"> <input type="hidden" id="nummaterias'+nummodulos+'" name="nunmaterias'+nummodulos+'" value="'+1+'"> <div id="contenedormateria1" style="width: 100%; float: left; margin: 5px 0px;"> <select id="materia1" name="materia1" style="height: 40px; font-size: 12px; width: calc(50% - 14px); height: 40px; box-sizing: border-box; padding:10px; border: 2px solid lightgray; background-color: whitesmoke; color: gray; float: left;"><option value="">Selecciona una materia</option><?php

$query_Recordset3 = "SELECT * FROM materias";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3); 

if ($totalRows_Recordset3 > 0) {

do {

$id = $row_Recordset3['id'];
$nombre = $row_Recordset3['nombre'];

?><option value="<?php echo $id; ?>"><?php echo $nombre; ?></option><?php

}while($row_Recordset3 = mysql_fetch_assoc($Recordset3));


}

?></select> <div id="lineaunion" style="width: 25px; border: 1px solid #c1c3c7; float: left; margin-top: 20px;"> </div> <select id="maestro1" name="maestro1" style="font-size: 12px; height: 40px; width: calc(50% - 14px); box-sizing: border-box; padding:10px; border: 2px solid lightgray; background-color: whitesmoke; color: gray; float: left;"><option value="">Selecciona un maestro</option><?php

$query_Recordset4 = "SELECT * FROM maestros";
$Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4); 

if ($totalRows_Recordset4 > 0) {

do {

$idmaestro = $row_Recordset4['id'];
$nombremaestro = $row_Recordset4['nombre'];

?><option value="<?php echo $idmaestro; ?>"><?php echo $nombremaestro; ?></option><?php

}while($row_Recordset4 = mysql_fetch_assoc($Recordset4));


}

?></select> </div> </div> </div> </div>');

    if (nummodulos > 1) {
        $('#eliminarmodulo').show();
    }

});  

$('#eliminarmodulo').click(function() {

    var nummodulos = parseInt($("#nummodulos").val());

    $('#contenedormodulo'+nummodulos).remove();

    nummodulos = nummodulos - 1 ;

    $("#nummodulos").val(nummodulos);

    if (nummodulos == 1) {
        $("#eliminarmodulo").hide();
    }
            
});


});  

function agregarmateria( nummodulo ) {

var nummaterias = parseInt($("#nummaterias"+nummodulo).val()) + 1;

$("#nummaterias"+nummodulo).val(nummaterias);

$('#materias' + nummodulo).append('<div id="contenedormateria'+ nummaterias +'" style="width: 100%; float: left; margin:5px 0px"> <select id="materia'+ nummaterias +'" name="materia'+ nummaterias +'" style="font-size: 12px; width: calc(50% - 14px); height: 40px;  box-sizing: border-box; padding:10px; border: 2px solid lightgray; background-color: whitesmoke; color: gray; float: left;">Materias<option value="">Selecciona una materia</option><?php

$query_Recordset5 = "SELECT * FROM materias";
$Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5); 

if ($totalRows_Recordset5 > 0) {

do {

$id = $row_Recordset5['id'];
$nombre = $row_Recordset5['nombre'];

?><option value="<?php echo $id; ?>"><?php echo $nombre; ?></option><?php

}while($row_Recordset5 = mysql_fetch_assoc($Recordset5));


}

?></select><div id="lineaunion" style="width: 25px; border: 1px solid #c1c6c7; float: left; margin-top: 20px;"></div><select id="maestro'+ nummaterias +'" name="maestro'+ nummaterias +'" style="font-size: 12px; width: calc(50% - 14px); height: 40px; box-sizing: border-box; padding:10px; border: 2px solid lightgray; background-color: whitesmoke; color: gray; float: left;"><option value="">Selecciona un maestro</option><?php

$query_Recordset6 = "SELECT * FROM maestros";
$Recordset6 = mysql_query($query_Recordset6, $conamatenlinea) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6); 

if ($totalRows_Recordset6 > 0) {

do {

$idmaestro = $row_Recordset6['id'];
$nombremaestro = $row_Recordset6['nombre'];

?><option value="<?php echo $idmaestro; ?>"><?php echo $nombremaestro; ?></option><?php

}while($row_Recordset6 = mysql_fetch_assoc($Recordset6));


}

?></select></div>');//Termina append

if (nummaterias > 1) {
$("#botoneliminar"+nummodulo).show();
}

}

function eliminarmateria(nummodulo) {

    nummaterias = parseInt($("#nummaterias"+nummodulo).val());

    $('#materias' + nummodulo +' #materia'+nummaterias).parent().remove();

    nummaterias = nummaterias - 1;

    $("#nummaterias"+nummodulo).val(nummaterias);

    if (nummaterias == 1) {
        $("#botoneliminar"+nummodulo).hide();
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

            <div id="link">Cursos</div>
            
            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="maestros.php">Maestros</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="materias.php">Materias</a>

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

    <div id="seccionprincipal" style="height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">

    <a href="Javascript:void(0)" onclick="nuevo()"><div id="botonagregar" align="center" style=" width: 100%; float: left; background: #305b84; padding-top: 20px; padding-bottom: 20px; cursor: pointer; font-size: 16px; font-family: 'Montserrat', sans-serif; text-decoration: underline;">Agregar curso</div></a>

    <div id="contenedor-curso0" class="card" style="width:calc(100% - 60px); float: left; display: none; margin-bottom: 40px;">

        <div id="titulocurso" align="center" style="font-size: 25px; line-height: 60px; float: left; width: 100%;">Nuevo curso</div>
        
        <form id="cursoform0" name="nuevocursoform" action="" enctype="multipart/form-data" method="post">

            <input id="idcurso" name="idcurso" value="0" type="hidden">

            <div id="contienesubidaimagen" style="width: 25%; float: left;">

                <div id="contenedorimagenactual0" class="imagencurso" align="center" style="background-color: #c1c1c1; background-image: url(../images/nuevocurso.png); background-size: contain; background-position: center;"></div>

                 <a href="javascript:void(0);" onclick="javascript:document.getElementById('foto0').click();"><div id="botonfile" align="center" style="border: 1px solid #1d4267; background-color: #1d4267; color: #7FDBFF; padding: 5px; cursor:pointer; margin-top: 10px; width: calc(100% - 12px); float: left;">

                    <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; height:0px; display:block; background-color: #1d4267;">

                    <div style="font-size:12px;">Elegir imagen</div>

                    <input type="file" id="foto0" name="foto0" onchange="javascript:enviar('0');" style="display: none;" accept="image/jpeg" />  

                </div></a>

                <div id="up0" style="width:calc(100% - 22px); font-family: 'Montserrat', sans-serif; margin-left: 10px; color: white; margin-right: 10px; height:45px; float:left; position:relative; z-index:1;  border-radius:5px; overflow:hidden; border:solid 1px #7FDBFF; margin-top: 10px; margin-bottom: 10px; display: none; visibility:hidden;">

                     <div id="progress-wrp0" style="color: white;" class="progress-wrp"><div class="progress-bar"></div ><div class="status" style="color: white; font-size:20px;">0%</div></div>

                </div>

                <div id="contenedorcaracteristicas" style="width: 100%; float:left;">

                    <div id="contenedorfechainicio" style="width: calc(50% - 10px); float: left; padding: 5px;">

                        <div class="etiquetainput" style="font-size: 13px;">Fecha inicio</div>

                        <input id="fechainicio0" name="fechainicio0" align="center" style="width:  calc(100% - 10px); line-height: 20px; padding-left: 5px;" type="text">

                    </div>

                    <div id="contenedorfechafinal" style="width: calc(50% - 10px); float: left; padding: 5px;">

                        <div class="etiquetainput" style="font-size: 13px;">Fecha final</div>

                        <input id="fechafinal0" name="fechafinal0" align="center" style="width: calc(100% - 10px); line-height: 20px; padding-left: 5px;" type="text">

                    </div>

                    <div id="contenedorcosto" style="width: calc(50% - 10px);float: left;padding: 5px;">

                            <div class="etiquetainput" style="font-size: 13px;">Costo</div>

                            <input id="costo" name="costo" value="<?php echo $costo; ?>" style="width: calc(100% - 10px);line-height: 20px; padding-left: 5px;" type="text">

                        </div>

                        <div id="contenedorsesiones" style="width: calc(50% - 10px);padding: 5px;float:left;font-size: 13px;">

                                <div class="etiquetainput" style="font-size: 13px;">Sesiones</div>

                                <select name="sesiones" id="sesiones" style="width: 100%;line-height: 20px;padding-left: 5px;height: 26px;float: left;">

                                    <option value=""></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>

                                </select>
                            
                        </div>


                </div>

            </div>


            <input id="nombrecurso0" name="nombrecurso0" placeholder="Escribe el nombre del curso" style="resize: none; background-color: #0b2c4d; font-size: 12px; background-color: white; width: calc(75% - 32px); margin-left: 10px; margin-bottom: 10px; padding: 5px; float: left; border: 1px solid lightgray;" type="text" value="">


            <textarea id="descripcioncurso0" name="descripcioncurso0" placeholder="Escribe la descripción del curso" style="resize: none; background-color: #0b2c4d; height: 283px; font-size: 12px; background-color: white; width: calc(75% - 32px); margin: 0px 10px; margin-bottom: 5px; padding: 5px; float: left; border: 1px solid lightgray;"></textarea>

     <div id="titulocurso" align="center" style="font-size: 25px; line-height: 60px; float: left; width: 100%; font-weight: bold;">Modulos del curso</div>

     <div id="contieneboton" style="width: 100%;float:left;margin: 15px 0px;" align="center">
            <button type="button" id="agregarmodulo" style="margin: 0px 5px;border-radius: 7px; padding: 5px 15px; background-color: #0576a9; font-size: 14px;border-color: #2196F3; color: #ffffff;cursor: pointer; text-transform: uppercase;">Agregar módulo</button>
            <button type="button" id="eliminarmodulo" style="margin: 0px 5px;border-radius: 7px; padding: 5px 15px; background-color: #9E9E9E; font-size: 14px; border-color: #bcbcbc; color: #fffafa; cursor: pointer; text-transform: uppercase; display: none;">Eliminar módulo</button>
     </div>

     <!-- Modulos -->
     <input type="hidden" name="nummodulos" id="nummodulos" value="1">

     <div id="contienemodulos" style="width:100%; float:left; " align="center">

        <div id="contenedormodulo" style="width: 70%;float: left;margin-bottom: 10px;margin-left: 15%;margin-right: 15%;">

            <div id="modulo" name="contenedormcodulo" style="font-size: 12px;width: calc(100% - 22px);padding: 10px;float: left;border: 1px solid lightgray;">

                <div id="nombremod" style="width:100%; float: left; font-size: 14px; text-transform: uppercase; font-weight: bold;">
                    Módulo 1
                </div>

                <div id="contenedorbotones" align="center" style="padding: 0px 20px; margin: 20px 20px; float: left; width: calc(100% - 80px);">

                    <button id="botonagregar" type="button" onclick="agregarmateria(1);" style="border-radius: 7px;float: left;margin: 5px 15%;padding: 5px 15px;background-color: #23a11b;font-size: 14px;border-color: #028401eb;color: #e4ffe7;cursor: pointer;width: 150px;">Agregar materia</button>

                    <button id="botoneliminar1" type="button" onclick="javascript:eliminarmateria(1);" style="display: none; border-radius: 7px; float: left; margin: 5px 40px; padding: 5px 15px; background-color: rgb(215, 7, 7); font-size: 14px; border-color: rgb(184, 10, 10); color: rgb(248, 230, 230); cursor: pointer; width: 150px; height: 30px;">Eliminar materia</button>
                </div>

                <form id="modulosform" name="modulosform" action="" enctype="multipart/form-data" method="post" onsubmit="return(valida_envia())">

                <div id="materias1">

                    <input type="hidden" id="nummaterias1" name="nummaterias1" value="1">

                    <div id="contenedormateria1" style="width: 100%; float: left; margin: 5px 0px;">

                        <select id="materia1" name="materia1" style="font-size: 12px;width: calc(50% - 14px); height: 40px; box-sizing: border-box; padding:10px; border: 2px solid lightgray; background-color: whitesmoke; color: gray; float: left;">
                            <option value="">Selecciona una materia</option>
<?php

$query_Recordset7 = "SELECT * FROM materias";
$Recordset7 = mysql_query($query_Recordset7, $conamatenlinea) or die(mysql_error());
$row_Recordset7 = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7); 

$options = "";

if ($totalRows_Recordset7 > 0) {

do {

$id = $row_Recordset7['id'];
$nombre = $row_Recordset7['nombre'];

?><option value="<?php echo $id; ?>"><?php echo $nombre; ?></option><?php


}while($row_Recordset7 = mysql_fetch_assoc($Recordset7));


}

?>
                        </select>

                        <div id="lineaunion" style="width: 25px; border: 1px solid #c1c3c7; float: left; margin-top: 20px;">
                        </div>

                        <select id="maestro1" name="maestro1" style="font-size: 12px;width: calc(50% - 14px); height: 40px; box-sizing: border-box; padding:10px; border: 2px solid lightgray; background-color: whitesmoke; color: gray; float: left;">

                            <option value="">Selecciona un maestro</option>

<?php

$query_Recordset8 = "SELECT * FROM maestros";
$Recordset8 = mysql_query($query_Recordset8, $conamatenlinea) or die(mysql_error());
$row_Recordset8 = mysql_fetch_assoc($Recordset8);
$totalRows_Recordset8 = mysql_num_rows($Recordset8); 

$options = "";

if ($totalRows_Recordset8 > 0) {

do {

$id = $row_Recordset8['id'];
$nombre = $row_Recordset8['nombre'];

?><option value="<?php echo $id; ?>"><?php echo $nombre; ?></option><?php


}while($row_Recordset8 = mysql_fetch_assoc($Recordset8));


}

?>

                        </select>

                    </div>
                    
                </div>     

            </div>

        </div>

    </div>


            <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 50px; margin-bottom: 20px;"><button type="button" onclick="guardarform(0);" style=" padding: 5px 15px; background-color: #1d4267; font-size: 14px; border-color: #7FDBFF; color: #7FDBFF; cursor: pointer;">Guardar cambios</button></div>

        </form>
    
    </div><!--Fin de contenedor-nuevocurso-->


<div id="seccioncursos" style="width: 100%; background-color: #fff; text-align:center; float:left; float: left;">

<div id="tituloseccion" style="line-height: 40px; margin-top: 10px; color:#777; border-bottom: 2px solid lightgray; margin-left: 10px; margin-right: 10px; font-size: 20px; text-align: left;">Lista de cursos (<?php echo $totalRows_Recordset1; ?>)</div>

<?php 

$numcurso = 1;

if ($totalRows_Recordset1 > 0) {
    
    do{

        $nombre = $row_Recordset1['nombre'];
        $unixinicio = $row_Recordset1['fechainicio'];
        $unixfinal = $row_Recordset1['fechafinal'];

        $diainicio = date("d", $unixinicio);

        $mesinicio = date("m", $unixinicio);

        if ($mesinicio == 1 ){

            $mesinicio = "Enero";

        }else if ($mesinicio == 2){

            $mesinicio = "Febrero";

        }else if ($mesinicio == 3){

            $mesinicio = "Marzo";

        }else if ($mesinicio == 4){

            $mesinicio = "Abril";

        }else if ($mesinicio == 5){

            $mesinicio = "Mayo";

        }else if ($mesinicio == 6){

            $mesinicio = "Junio";

        }else if ($mesinicio == 7){

            $mesinicio = "Julio";

        }else if ($mesinicio == 8){

            $mesinicio = "Agosto";

        }else if ($mesinicio == 9){

            $mesinicio = "Septiembre";

        }else if ($mesinicio == 10){

            $mesinicio = "Octubre";

        }else if ($mesinicio == 11){

            $mesinicio = "Noviembre";

        }else if ($mesinicio == 12){

            $mesinicio = "Diciembre";
        }

        $anoinicio = date("Y", $unixinicio);

        $diafinal = date("d", $unixfinal);
        $mesfinal = date("m", $unixfinal);

        if ($mesfinal == 1 ){

            $mesfinal = "Enero";

        }else if ($mesfinal == 2){

            $mesfinal = "Febrero";

        }else if ($mesfinal == 3){

            $mesfinal = "Marzo";

        }else if ($mesfinal == 4){

            $mesfinal = "Abril";

        }else if ($mesfinal == 5){

            $mesfinal = "Mayo";

        }else if ($mesfinal == 6){

            $mesfinal = "Junio";

        }else if ($mesfinal == 7){

            $mesfinal = "Julio";

        }else if ($mesfinal == 8){

            $mesfinal = "Agosto";

        }else if ($mesfinal == 9){

            $mesfinal = "Septiembre";

        }else if ($mesfinal == 10){

            $mesfinal = "Octubre";

        }else if ($mesfinal == 11){

            $mesfinal = "Noviembre";

        }else if ($mesfinal == 12){

            $mesfinal = "Diciembre";
        }



        $anofinal = date("Y", $unixfinal);


        $fechainicio = $diainicio . " de " . $mesinicio . " del " . $anoinicio;
        $fechafinal = $diafinal . " de " . $mesfinal . " del " . $anofinal;

        $id = $row_Recordset1['id'];

?>


                    <!--Cursos -->
                    <div id="curso<?php echo $numcurso; ?>" style="overflow: hidden; width: 100%; background-color:#FFF; border-bottom:1px solid lightgray; position: relative;">
                        
                            <div id="botonesdeedicion" style="position:absolute; top:10px; right:10px;">
        
                                <button id="botoneliminar" type="button" onclick="javascript:eliminar('<?php echo $id; ?>');" style="font-family: montserrat;border: solid #ed0000 2px;background: #f50000b5;float: right;border-radius: 5px;width: 100px;margin-left: 10px; cursor: pointer; font-size: 12px;color: white;padding-top: 10px; padding-bottom: 10px;">Eliminar</button>
        
                                <button id="botonmodificar" type="button" onclick="javascript:modificar('<?php echo $id; ?>');" style="margin-left: 10px;font-family: montserrat;border: solid #595f61 2px;background: #00020287;float: right;border-radius: 5px;width: 100px;font-size: 12px;cursor: pointer;color: white;padding-top: 10px;padding-bottom: 10px;">Modificar</button>
        
                            </div>
        
        
                            <a href="vercurso.php?id=<?php echo $id; ?>" style="float: left; color: black; width: 100%; display: block;">
                
                            <div class="title" align="left" style="width: calc(100% - 110px); line-height:20px; float:left; margin-top:10px; font-size: 18px; font-weight:bold; margin-left:10px;"><?php echo $nombre; ?></div>

                                    <div id="contenedorestadocurso" style="width: 100%; float: left;">
                                        <div id="etiqueta" style="margin: 10px; line-height:20px; float: left; font-size: 14px;font-weight:bold;">Estado del curso :  </div>
                                        <div id="estadocurso" style="float: left; margin: 10px; line-height: 20px; font-size: 14px; font-weight: bold; margin-left: 35px; color:skyblue">En curso</div>
                                    </div>
                
                                    <div id="fechainicio" style="width: 100%; float: left;">
                                        <div id="etiqueta" style="margin: 10px; line-height:20px; float: left; font-size: 14px;font-weight:bold;">Fecha de inicio: </div>
                                        <div id="fecha" style="float: left; margin: 10px; line-height: 20px; font-size: 14px; font-weight: bold;"><?php echo $fechainicio; ?></div>
                                    </div>
                                            
                                    <div id="fechafinal" style="width: 100%; float: left;">
                                        <div id="etiqueta" style="margin: 10px; line-height:20px; float: left; font-size: 14px;font-weight:bold;">Fecha final: </div>
                                        <div id="fecha" style="float: left; margin: 10px; line-height: 20px; font-size: 14px; font-weight: bold; margin-left: 35px;"><?php echo $fechafinal; ?></div>
                                    </div>

        
                                </a>  
                            
                    </div>
                    <!--FIN Cursos -->

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
