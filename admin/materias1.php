<?php require_once('../Connections/conamatenlinea.php');
session_start();

if ($_SESSION['usuario'] == "") {
    
    header("Location: login.php");

}else{

    $usuario = $_SESSION['usuario'];
    $unixtime = time();
}

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM materiascurso2 GROUP BY id DESC";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset3 = "SELECT * FROM materias";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset5 = "SELECT * FROM biblioteca";
$Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

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
	
.toprow {
    float:left;
    width: 100%;
    background-color: #0b2c4d; 
    color: white;
    min-height: 50px;
}
.topcell {
    float: left; 
    width: calc(25% - 2px);
    line-height: 50px;
    text-align: center;
}
.row {
    float:left;
    width: 100%;
    background-color: white; 
}
.cell {
    float: left; 
    width: calc(25% - 2px);
    border: 1px solid lightgray;
    line-height: 30px;
    text-align: center;
}
.nostyle:link {
    color: #222;
    text-decoration: none;
}
.nostyle:visited {
    color: #222;
    text-decoration: none;
}
#librolink:hover {
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

.boton:hover {   
	 text-decoration: underline;
}

</style>
<!--Fin estilos CSS-->

<!--Javascript-->
<script type="text/javascript">

function nuevo(){
    
    $("#contenedor-materia").slideToggle("fast");

    var boton = $("#botonagregar");

    if (boton.text() == "Agregar materia") {

        boton.text("Cerrar")
    
    } else {

        boton.text("Agregar materia")
    
    }
}


function guardarform( formnumber ) {
     //validamos que no esten vacíos los campos

    if ( $("#nombremateria").val() == '') {

                alert("Por favor selecciona un nombre");
                $("#nombremateria").focus();
                return false;
    }
	
	if ( $("#presentacionmateria").val() == '') {

                alert("Por favor escribe una presentación");
                $("#presentacionmateria").focus();
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

           if (typeof $('#foto')[0].files[0]  == "undefined") {

               alert("Por favor agrega una imagen para la nueva materia");
               return false;
           }
		
		   
		   if (typeof $('#portada')[0].files[0] == "undefined") {
			   
			   alert("Por favor agrega una portada para la nueva materia");
			   return false;
		   }
    }
	
	
	var form_data = new FormData();
    var foto = $('#foto')[0].files[0];
	var portada = $('#portada')[0].files[0];
	
	form_data.append('foto', foto);
	form_data.append('portada', portada);
    form_data.append('nombre', $("#nombremateria").val());
	form_data.append('presentacion', $("#presentacionmateria").val());
    form_data.append('introduccion', $("#introduccionmateria").val());
	form_data.append('propositos', $("#propositosmateria").val());
	form_data.append('competencias', $("#competenciasmateria").val());
	form_data.append('id', formnumber);

	if (typeof foto !== "undefined") {

        form_data.append('imagen', 'verdadero');

    } else {

    	form_data.append('imagen', 'falso');
    }
	
	if (typeof portada !== "undefined") {

        form_data.append('portada', 'verdadero');

    } else {

    	form_data.append('portada', 'falso');
    }

    var proceed = true; //set proceed flag

	
	 $.ajax({

                url: "agregarmateriacurso.php",
                type: "POST",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
               mimeType: "multipart/form-data"
            });

			alert("Se han guardado los cambios");
	
location.href = "materias1.php";

}
	
	
function enviar(id) {

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
	

function modificar(id) {

     location.href = "modificarmateriacurso.php?id=" + id;

}

function eliminar(id) {

    if (confirm("¿Estás seguro de eliminar esta materia?") == 1) {

        location.href = "eliminarmateriacurso.php?id=" + id;

	}

}

	
function vermateriacurso(id) {
	
    location.href = "vermateriacurso.php?id=" + id;
}
	
function agregarlibro() {

    var numlibros = parseInt($("#numlibros").val(),10) + parseInt(1,10);

    $("#numlibros").val(numlibros);

    $("#contenedorlibros").append('<div id="contenedorlibro'+numlibros+'" style="width:100%; float:left;"><select id="libro'+numlibros+'" name="libro" style="border: solid lightgray; font-size: 12px; width: 50%; margin: 10px; padding: 5px; float: left; font-weight: bold;"><?php if ($totalRows_Recordset5 == 0 ) { ?><option value="'+numlibros+'">No hay libros</option><?php } else { ?><option value="'+numlibros+'">Elegir un libro</option><?php do { $id = $row_Recordset5['id'];$titulo = stripslashes(stripslashes($row_Recordset5['titulo'])); ?><option value="<?php echo $id; ?>"><?php echo $titulo; ?></option><?php } while($row_Recordset5 = mysql_fetch_assoc($Recordset5)); ?><?php } ?></select><div id="eliminarlibro'+numlibros+'" class="boton" type="button" onclick="eliminarlibro(&#39;'+numlibros+'&#39;)" style="font-weight: bold;float: left;line-height: 30px; margin:10px; color: #f66666;cursor: pointer;">Eliminar libro</div></div>');
		
}

function eliminarlibro(id) {

    var numlibros = parseInt($("#numlibros").val());

    $("#contenedorlibro"+id).remove();

    numlibros = numlibros - 1;

    $("#numlibros").val(numlibros);

    
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

        <a href="Javascript:void(0)" onclick="nuevo()"><div id="botonagregar" class="boton" align="center" style="color: white; width: 100%; float: left; padding-top: 20px; padding-bottom: 20px; cursor: pointer; font-size: 16px; font-family: 'Montserrat', sans-serif; background: #305b84; ">Agregar materia</div></a>
        
		 <!--Contenedor-nuevamateria-->
             <div id="contenedor-materia" class="card" style="width: calc(100% - 60px); float: left; margin-bottom: 40px; display: none;">
    
                <div id="titulomateria" align="center" style="font-size: 25px; line-height: 60px; float: left; width: 100%;">Nueva materia</div>
    
                    <div id="contenedornuevamateria" style="width: calc(100% - 160px); margin-left: 80px; float: left;">
 
                       <form id="materiaform" name="materiaform" action="" enctype="multipart/form-data" method="post" onsubmit="return(valida_envia())">
        
                                <input id="idmateria" name="idmateria" value="" type="hidden">
                                
                                <div id="contienesubidaportada" style="width: 859px; height: 220px; float: left; border: 1px solid #ccc;">
        
                                    <div id="contenedorportadaactual" class="portadamateria" align="center">
                                    
        
                                    <a href="javascript:void('');" onclick="javascript:document.getElementById('portada').click('');"><div id="botonfileportada" align="center" style="color:#7FDBFF; cursor: pointer; margin-top: 5px; float: left; margin-left: 5px; background-color: #fff; padding: 3px;">
        
                                        <input type="button" id="enviarportada" name="enviarportada" style="border:0px; height:0px; display:block; background-color: #fff; width: 120px;">
                                        
                                        <div id="iconeditarimagen" style="width: 17px; float: left; margin-left: 5px;">
                                        	
                                        	<img src="../images/iconfoto.png?id=<?php echo $unixtime; ?>" style="width: 100%; float: left;">
                                        	
                                        </div>
        
                                        <div style="font-size: 12px; color: #5e696d; margin-top: 1px;">Elegir portada</div>
        
                                        <input type="file" id="portada" name="portada" value="" onchange="javascript:enviar();" style="display: none;" accept="image/jpeg">
        
                                    </div></a>
									</div>
        
                                        <div id="up" style="width:calc(100% - 22px); font-family: 'Montserrat', sans-serif; margin-left: 10px; color: white; margin-right: 10px; height:45px; float:left; position:relative; z-index:1;  border-radius:5px; overflow:hidden; border:solid 1px #7FDBFF; margin-top: 10px; margin-bottom: 10px; display: none; visibility:hidden;">
        
                                            <div id="progress-wrp" style="color: white;" class="progress-wrp">
                                                <div class="progress-bar"></div>
                                                <div class="status" style="color: white; font-size:20px;">0%</div>
                                            </div>
        
                                        </div>

                                     </div>
       						
        						
                               <div id="datosbasicos" align="center" style="float: left; width: calc(100% - 400px); margin-left: 200px; font-size: 20px; text-transform: uppercase; font-family: 'Montserrat', sans-serif; margin-bottom: 40px; margin-top: 40px; color: #000; font-weight: bold; letter-spacing: 2px;">DATOS BÁSICOS</div>
                               
                                <div id="contienesubidaimagen" style="width: 30%; float: left;">
        
                                    <div id="contenedorimagenactual" class="imagenmateria" align="center" style="background-color: #c1c1c1; background-image: url(../images/nuevocurso.png); background-size: cover; background-position: center; background-repeat: no-repeat;">
                                    </div>
        
                                    <a href="javascript:void('');" onclick="javascript:document.getElementById('foto').click('');"><div id="botonfile" align="center" style="border: 1px solid #1d4267; background-color: #1d4267; color: #7FDBFF; padding: 5px; cursor:pointer; margin-top: 10px; width: calc(100% - 12px); float: left;">
        
                                        <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; height:0px; display:block; background-color: #1d4267;">
        
                                            <div style="font-size:12px;">Elegir imagen</div>
        
                                            <input type="file" id="foto" name="foto" value="" onchange="javascript:enviar();" style="display: none;" accept="image/jpeg">
        
                                    </div></a>
        
                                        <div id="up" style="width:calc(100% - 22px); font-family: 'Montserrat', sans-serif; margin-left: 10px; color: white; margin-right: 10px; height:45px; float:left; position:relative; z-index:1;  border-radius:5px; overflow:hidden; border:solid 1px #7FDBFF; margin-top: 10px; margin-bottom: 10px; display: none; visibility:hidden;">
        
                                            <div id="progress-wrp" style="color: white;" class="progress-wrp">
                                                <div class="progress-bar"></div>
                                                <div class="status" style="color: white; font-size:20px;">0%</div>
                                            </div>
        
                                        </div>

                                     </div>
        
                                   
                                    <select id="nombremateria" name="nombremateria" style="font-size: 12px; width: 67%; margin-left: 10px; margin-bottom: 10px; padding: 5px; float: left;">
                                    
                                    	<?php if ($totalRows_Recordset3 == 0) {
										
										?>
               								
               								<option value="">No hay materias</option>
               									<?php } else { ?>
                							
                							<option value="">Elegir una materia</option>
											<?php 
                    
												do{
    
												$id = stripslashes(stripslashes($row_Recordset3['id']));
                            					$nombre = stripslashes(stripslashes($row_Recordset3['nombre']));
                    
                    						?>
                        
                    						<option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
    
                    						<?php }while($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
               								<?php } ?>
               								
               						</select>
                                    
                                    <textarea id="presentacionmateria" name="presentacionmateria" value="" placeholder="Escribe la presentación de la materia" style="resize: none; background-color: #0b2c4d;height: 198px;font-size: 12px;background-color: white; width: 67%; padding: 5px;float: left;border: 1px solid lightgray; margin-left: 10px;"></textarea>
                                    
                                    <div id="datosbasicos" align="center" style="float: left; width: calc(100% - 400px); margin-left: 200px; font-size: 20px; text-transform: uppercase; font-family: 'Montserrat', sans-serif; margin-bottom: 30px; margin-top: 40px; color: #000; font-weight: bold; letter-spacing: 2px;">DATOS GENERALES</div>
                                    
                                    <textarea id="introduccionmateria" name="introduccionmateria" value="" placeholder="Escribe la introducción de la materia" style="resize: none; background-color: #0b2c4d; height: 200px; font-size: 12px; background-color: white; width: 48%; margin-right: 10px; margin-bottom: 5px; padding: 5px; float: left; border: 1px solid lightgray;"></textarea>
                                    
                                    <textarea id="propositosmateria" name="propositosmateria" value="" placeholder="Escribe los propósitos de la materia" style="resize: none; background-color: #0b2c4d; height: 200px; font-size: 12px; background-color: white; width: 48%; margin-bottom: 5px; padding: 5px; float: left; border: 1px solid lightgray;"></textarea>
                                    
                                    <textarea id="competenciasmateria" name="competenciasmateria" value="" placeholder="Escribe las competencias de la materia" style="resize: none; background-color: #0b2c4d; height: 200px; font-size: 12px; background-color: white; width: 99%; margin-bottom: 5px; padding: 5px; float: left; border: 1px solid lightgray; margin-top: 5px;"></textarea>
                
                					<div id="contenedorbiblioteca" align="center" style="border: 1px solid lightgray;float: left;width: 100%;">
                						
                						<div id="datosbasicos" align="center" style="float: left;width: 100%;font-size: 20px;text-transform: uppercase;font-family: 'Montserrat', sans-serif;margin: 20px 0px;color: #000;font-weight: bold;letter-spacing: 2px;">BIBLIOTECA</div>
										
										<div id="contenedorboton" align="center" style="float: left;width: calc(100% - 30px);margin: 15px;">
						            
						            		<button type="button" onclick="agregarlibro()" style="border-radius: 10px;line-height: 30px;background-color: #1d4267;border-color: #7FDBFF;padding: 0px 20px;color: #7FDBFF;cursor: pointer;">Agregar libro</button>		
						            	
						   				</div>
                						
                                    <div id="contenedorlibros" style="width: calc(100% - 20px);float: left;margin: 10px;">
                                        
                                        <input id="numlibros" type="hidden" name="numlibros" value="1">
                							
                                    </div>
                						
                					</div> 
                					
						            <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 20px; margin-bottom: 20px;">
						            
						            	<button type="button" onclick="guardarform('0');" style="border-radius: 10px; line-height: 30px; background-color: #1d4267; border-color: #7FDBFF; padding-left: 20px; padding-right: 20px; margin-top: 20px; color: #7FDBFF; cursor: pointer;">Guardar cambios</button>
						            	
						   			</div>
					</form>
		</div>
		
	</div>
                <!--Fin de contenedor-nuevocurso-->      
       
        
        <div id="contenedor-materias" class="card" style="width:calc(100% - 100px); float: left;">

            <div id="titulo" align="center" style="padding-top: 20px; font-family: 'Montserrat', sans-serif; font-size: 35px; color: #333; font-weight: bold; padding-left: 20px; line-height: 90px; letter-spacing: 1.6px;">Materias</div>
           
            <div id="tablamaterias" style="float: left; margin-bottom: 100px; width: 100%;">
    
                <div class="toprow">
                    <div class="topcell" style="width: 10%;">No.</div>
                    <div class="topcell" style="width: 60%;">Nombre</div>
                </div>

<?php 

    if($totalRows_Recordset1 > 0){
        
        $contador = 1;

        do{
        
 
            $idmateria = $row_Recordset1['idmateria'];
			$imagen = $row_Recordset1['imagen'];
			$portada = $row_Recordset1['portada'];
            $presentacion = $row_Recordset1['presentacion'];
			$introduccion = $row_Recordset1['introduccion'];
			$propositos = $row_Recordset1['propositos'];
			$competencias = $row_Recordset1['competencias'];
            $id = $row_Recordset1['id'];
			
			$query_Recordset4 = "SELECT * FROM materias WHERE id = '$idmateria' GROUP BY id DESC";
			$Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
			$row_Recordset4 = mysql_fetch_assoc($Recordset4);
			$totalRows_Recordset4 = mysql_num_rows($Recordset4);

			$nombre = $row_Recordset4['nombre'];
?>
                <div class="row">
                    <div class="cell" style="width: calc(10% - 2px);"><?php echo $contador; ?></div>
                    <div id="materia" class="cell" onclick="javascript:vermateriacurso('<?php echo $id; ?>');" style="width: calc(60% - 2px); cursor: pointer;"><?php echo $nombre; ?></div>
                    <div id="clave" style="width: calc(20% - 2px);"><?php echo $clave; ?></div>
                    <div class="cell" style="width: calc(15% - 2px);"><button style="width:100%; float:left; height:30px; line-height:30px; background-color: #3D9970; color:white; border: none; cursor: pointer;" onClick="javascript:modificar('<?php echo $id; ?>');">Modificar</button></div>
                    <div class="cell" style="width: calc(15% - 2px);"><button style="width:100%; float:left; height:30px; line-height:30px; background-color:#FF4136; border: none; color:white; cursor: pointer;" onClick="javascript:eliminar('<?php echo $id; ?>');">Eliminar</button></div>
                </div>

<?php
            $contador = $contador + 1;
    
        }while( $row_Recordset1 =  mysql_fetch_assoc($Recordset1));

    } else {

?>

    <div id="nohay" style="float: left; line-height: 50px; width: 100%; text-align: center;">No se encontraron materias registradas.</div>

<?php

    }

?>

            </div>
            
        </div>

    </div>
    
</div>


</body>
</html>
