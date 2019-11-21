<?php require_once('../Connections/conamatenlinea.php');
session_start();

if ($_SESSION['usuario'] == "") {
    
    header("Location: login.php");

}else{

    $usuario = $_SESSION['usuario'];

}

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM biblioteca GROUP BY id DESC";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$permiso = $row_Recordset2['permiso'];

if ($permiso == 2) {

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

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
    padding: 20px 50px;
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

</style>
<!--Fin estilos CSS-->

<!--Javascript-->
<script type="text/javascript" >

function nuevo(){
    
    $("#seccion-form").slideToggle("fast");

    var boton = $("#botonagregar");

    if (boton.text() == "Agregar libro") {

        boton.text("Cerrar")
    
    } else {

        boton.text("Agregar libro")
    
    }
 

}

function guardarform() {

    //validamos que no esten vacíos los campos
	
    if ( $("#titulolibro").val() == '') {
        
        alert("Por favor escribe un libro");
        $("#titulolibro").focus();
        return false;
    }

        
    if ( typeof $('#archivo')[0].files[0] === "undefined" ) {

        alert("Por favor agrega una archivo");
        return false;
    }

    //Creamos un form para enviar en post

	var form_data = new FormData();

    var archivo = $('#archivo')[0].files[0];

    form_data.append('archivo' , archivo);
    form_data.append('titulo' , $("#titulolibro").val());

    //barra de progreso

    var progress_bar_id = '#progress-wrp'; //ID of an element for response output

	$("#botonfile").prop( "disabled", true); //disable submit button


	$('#up').css('visibility','visible');
	$('#progress-wrp').css("visibility", "visible");

	var proceed = true; //set proceed flag
    
	//reset progressbar
	$(progress_bar_id +" .progress-bar").css("width", "0%");
	$(progress_bar_id + " .status").text("0%");
   
$.ajax({

	url : "agregarlibro.php",
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

            $("#archivo").val('');
            $('#up').css('display','none');
			alert("Se han guardado los cambios");
			window.location.reload();
			
        } else {

            $('#up').css('display','none');
            $(progress_bar_id +" .progress-bar").css("width", "0%");
            $(progress_bar_id + " .status").text("0%");
            alert(res.mensaje2);
            return false;

        }

	
});
	
}

function eliminar(id) {

    if (confirm("¿Estás seguro de eliminar este libro?")==1) {

        location.href="eliminarlibro.php?id="+id;

    }

}

function modificar(id) {

location.href="modificarlibro.php?id="+id;

}


</script>
<!--Fin Javascript-->

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
            <div id="link">Biblioteca</div>

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

        <a href="Javascript:void(0)" onclick="nuevo()"><div id="botonagregar" align="center" style="color: white; width: 100%; float: left; padding-top: 20px; padding-bottom: 20px; cursor: pointer; font-size: 16px; font-family: 'Montserrat', sans-serif; background: #305b84;text-decoration: underline;">Agregar libro</div></a>

                <div id="contenedoragregar" align="center" style="width: 100%; margin-bottom: 50px; float: left;">

                    <div id="seccion-form" style="width: calc(100% - 62px); background-color: white; padding: 30px; margin-bottom: 40px; float: left; display: none;">
            
            <div id="titulo" style="width: 100%; margin-bottom: 20px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Nuevo libro</div>
             
             <form id="form1" name="form1" action="agregarlibro.php" method="post" enctype="multipart/form-data" style="width: 80%; float: left; margin-left: 10%;">

                <input id="titulolibro" name="titulolibro" type="text" value="" placeholder="Ingresa un título para el libro" style="font-size: 12px; width: 100%; margin: 10px 0; box-sizing: border-box; margin-bottom: 10px; padding: 10px 10px; border: none; background-color: #DDE3EC; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>

                <input id="archivo" name="archivo" type="file" accept="application/pdf" style="width: 100%; margin-bottom: 20px;">

                <div id="up" style="width:calc(100% - 22px); font-family: 'Montserrat', sans-serif; margin-left: 10px; color: white; margin-right: 10px; height:45px; float:left; position:relative; z-index:1;  border-radius:5px; overflow:hidden; border:solid 1px #7FDBFF; margin-top: 10px; margin-bottom: 10px; visibility:hidden;">

                     <div id="progress-wrp" style="color: white;" class="progress-wrp"><div class="progress-bar"></div ><div class="status" style="color: white; font-size:20px;">0%</div></div>

                </div>

                <div align="center" style="width: 100%; float: left;">

                    <button type="button" onclick="javascript:guardarform()" style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #7FDBFF; margin-top: 15px; width:200px; color: white; background-color: #244267;">AGREGAR</button>

                </div>
     
            </form>
     

            </div>



        <div id="contenedor-biblioteca" class="card" style="width:calc(100% - 100px); float: left;">
           
            <div id="titulo" align="center" style="padding-top: 20px; font-family: 'Montserrat', sans-serif; font-size: 35px; color: #333; font-weight: bold; padding-left: 20px; line-height: 90px; letter-spacing: 1.6px;">Biblioteca</div>

            <div id="tablabiblioteca" style="float: left; margin-bottom: 100px; width: 100%;">

                <div class="toprow">
                    <div class="topcell" style="width: 10%;">No.</div>
                    <div class="topcell" style="width: 60%;">Titulo</div>
                    <div class="topcell" style="width: 15%;"></div>
                    <div class="topcell" style="width: 15%;"></div>
                </div>

<?php 

    if($totalRows_Recordset1 > 0){
        
        $contador = 1;

        do{
        
 
            $titulo = $row_Recordset1['titulo'];
            $archivo = $row_Recordset1['archivo'];
            $id = $row_Recordset1['id'];

?>
                <div class="row">
                    <div class="cell" style="width: calc(10% - 2px);"><?php echo $contador; ?></div>
                    <a class="nostyle" target="_blank" style="cursor: pointer;" href="../libros/<?php echo $archivo; ?>"><div id="librolink" class="cell" style="width: calc(60% - 2px);"><?php echo $titulo; ?></div></a>
                    <div class="cell" style="width: calc(15% - 2px);"><button style="width:100%; float:left; height:30px; line-height:30px; background-color: #3D9970; color:white; border: none; cursor: pointer;" onClick="javascript:modificar('<?php echo $id; ?>');">Modificar</button></div>
                    <div class="cell" style="width: calc(15% - 2px);"><button style="width:100%; float:left; height:30px; line-height:30px; background-color:#FF4136; border: none; color:white; cursor: pointer;" onClick="javascript:eliminar('<?php echo $id; ?>');">Eliminar</button></div>
                </div>

<?php
            $contador = $contador + 1;
    
        }while( $row_Recordset1 =  mysql_fetch_assoc($Recordset1));

    }

?>

            </div>
            
        </div>

    </div>
    
</div>


</body>
</html>
