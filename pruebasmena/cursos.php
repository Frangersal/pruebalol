<?php require_once('../Connections/conamatenlinea.php');
session_start();

if($_SESSION['sesionmaestro'] == "") {
	
	header("Location: ../index.php");

} else{

    $maestro = $_SESSION['sesionmaestro'];
    $time = time();
}

$exito = $_GET['exito'];

//Necesaria para la imagen y nombre del maestro

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM maestros WHERE usuario = '$maestro'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$idmaestro = $row_Recordset1['id'];
$imagenactual = $row_Recordset1['imagen'];
$nombre = $row_Recordset1['nombre'];

//--->

$query_Recordset2 = "SELECT * FROM materiascurso WHERE idmaestro = '$idmaestro' GROUP BY idcurso";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

$idcurso = $row_Recordset2['idcurso'];

$query_Recordset3 = "SELECT * FROM cursos WHERE id = '$idcurso'";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3); 





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
    font-weight: bold;
    width: 100%;
    background-color: #0b2c4d; 
    color: white;
    height: 50px;
}
.topcell {
    float: left; 
    width: calc(25% - 2px);
    line-height: 30px;
    text-align: center;
    margin: 10px;
}
.row {
    float:left;
    width: 80%;
    background-color: whitesmoke; 
    margin:10px 10%;
}
.cell {
    font-weight: bold;
    float: left; 
    width: calc(25% - 2px);
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

.opcion:hover {
	background-color: #2a3444 !important;
	border-left: 4px solid #4a8ab1 !important;
	cursor: pointer;
}

.nombreopcion:hover {
		cursor: pointer !important;
}

#materia:hover{
    color:salmon !important;
}

.vermateria:hover{
    background: #366a95 !important;
    color: white !important;
}

.bloques:hover{
    background: #a13434 !important;
    color: white !important;
}

.calificaciones:hover{
    background: #459fe9 !important;
    color: white !important;
}

.sesiones:hover{
    background: #a76192 !important;
    color: white !important;
}

.libros:hover{
    background: #4b9b4d !important;
    color: white !important;
}
	

</style>
<!--Fin estilos CSS-->

<!--Javascript-->

<?php if ($exito != "") { ?>

<script>

$( document ).ready(function() {
    alert( "Se guardaron los cambios." );
});

</script>

<?php } ?>
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


	

function vermateria(id) {

     location.href = "modificarmateriacurso.php?id=" + id;

}

function vercontenido( id, idmateria, idmaestro, nummodulo ) {

     location.href = "cuadrodecontenido.php?id=" + id + "&idmateria=" + idmateria + "&idmaestro=" + idmaestro + "&nummodulo=" + nummodulo;

}

	
function vermateriacurso(id) {
	
    location.href = "vermateriacurso.php?id=" + id;
}
	
function agregarlibro() {

    var numlibros = parseInt($("#numlibros").val(),10) + parseInt(1,10);

    $("#numlibros").val(numlibros);

    $("#contenedorlibros").append('<div id="contenedorlibro'+numlibros+'" style="width:100%; float:left;"><select id="libro'+numlibros+'" name="libro" style="border: solid lightgray; font-size: 12px; width: 50%; margin: 10px; padding: 5px; float: left; font-weight: bold;"><?php if ($totalRows_Recordset5 == 0 ) { ?><option value="'+numlibros+'">No hay libros</option><?php } else { ?><option value="'+numlibros+'">Elegir un libro</option><?php do { $id = $row_Recordset5['id'];$titulo = stripslashes(stripslashes($row_Recordset5['titulo'])); ?><option value="<?php echo $id; ?>"><?php echo $titulo; ?></option><?php } while($row_Recordset5 = mysql_fetch_assoc($Recordset5)); ?><?php } ?></select><div id="eliminarlibro'+numlibros+'" class="boton" type="button" onclick="eliminarlibro(&#39;'+numlibros+'&#39;)" style="font-weight: bold;float: left;line-height: 30px; margin:10px; color: #f66666;cursor: pointer;">Eliminar libro</div></div>');
		
}


	

</script>
<!--Fin Javascript-->
<script>

function veralumnos( idcurso ) {

    location.href = "alumnos.php?id=" + idcurso;
    

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
       
        
        <div id="contenedor" class="card" style="width: calc(100% - 60px); float: left;">

            <div id="titulo" align="center" style="padding-top: 20px; margin-bottom: 20px; font-family: 'Montserrat', sans-serif; font-size: 35px; color: #333; font-weight: bold; line-height: 90px; letter-spacing: 1.6px;">Cursos</div>



<?php

    do {
        $nombrecurso = $row_Recordset3['nombre'];

?>

    <div id="titulo" align="center" style="font-family: 'Montserrat', sans-serif; font-size: 18px; color: #333; margin-bottom: 10px;"><?php echo $nombrecurso; ?></div>


            
    <div id="centrarboton" style="width: 100%; float: left;">

        <button style="margin-left:40%; margin-right:40%; width:20%; float:left; height:30px; background-color: #4e96d3; color:white; border: 5px solid #4e96d3; border-radius:3px; margin-bottom: 20px; cursor: pointer; font-size:13px; font-weight:bold; line-height:20px; " onClick="javascript:veralumnos('<?php echo $idcurso; ?>');">Lista de alumnos</button>

    </div>
           
            <div id="tablamaterias" style="float: left; margin-bottom: 60px; width: 100%;">
 
<?php 

        $query_Recordset4 = "SELECT * FROM materiascurso WHERE idcurso = '$idcurso' AND idmaestro = '$idmaestro' ";
        $Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
        $row_Recordset4 = mysql_fetch_assoc($Recordset4);
        $totalRows_Recordset4 = mysql_num_rows($Recordset4);

        $contador = 1;

        do{

            $idmateria = $row_Recordset4['idmateria'];
            $idmateriacurso = $row_Recordset4['id'];
            $nummodulo = $row_Recordset4['nummodulo'];
			
			$query_Recordset5 = "SELECT * FROM materias WHERE id = '$idmateria'";
			$Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
			$row_Recordset5 = mysql_fetch_assoc($Recordset5);
			$totalRows_Recordset5 = mysql_num_rows($Recordset5);

			$nombre = $row_Recordset5['nombre'];
?>
                <div class="row" style="border-radius:10px; box-shadow: 1px 2px 10px;">

                    <div class="cell" style="border-left: 5px solid steelblue; margin: 5px; width: calc(10% - 15px); line-height: 70px; text-align:center; overflow:hidden; font-size:30px; color:#627899">
                        <div id="contador" style="width:100%; height: 30px; "><?php echo $nummodulo; ?></div>
                        <div id="etiqueta" style="width:100%; font-size:14px; ">Modulo</div> 
                    </div>

                    <div id="materia" class="cell" onclick="javascript:vermateriacurso('<?php echo $id; ?>', '<?php echo $idcurso; ?>');" style="width: calc(55% - 10px); cursor: pointer; letter-spacing:5px;  text-align:center; line-height:100px; margin:5px; font-size:30px; color:#627899; overflow:hidden;"><?php echo $nombre; ?></div>

                    <div id="contenedorbotones" style="width:35%; margin-top:1px; float:right">

                        <div class="cell" style="width:calc(50% - 6px); margin:3px; float:right;"><button class="bloques" style="width:100%; float:left; height:30px; background-color:whitesmoke; border: 2px solid #a13434; border-radius:3px; color:#a13434; cursor: pointer; overflow:hidden; line-height:13px; font-weight:bold; " onClick="javascript:vercontenido('<?php echo $idcurso; ?>', '<?php echo $idmateria; ?>',  '<?php echo $idmaestro; ?>', '<?php echo $nummodulo; ?>' );">Cuadro de contenido</button></div>

                        <div class="cell" style="width:calc(50% - 6px); margin:3px; float:right;"><button class="vermateria" style="width:100%; float:left; height:30px;   color:#366a95; background-color: whitesmoke; border: 2px solid #366a95; border-radius:3px; cursor: pointer; overflow:hidden; line-height:13px; font-weight:bold; " onClick="javascript:vermateria('<?php echo $idmateriacurso; ?>');">Ver Materia</button></div>

                        <div class="cell" style="width:calc(100% - 6px); margin:3px; float:right;"><button  class="calificaciones" style="width:100%; float:left; height:30px;   color:#459fe9; background-color: whitesmoke; border: 2px solid #459fe9; border-radius:3px; cursor: pointer; overflow:hidden; line-height:13px; font-weight:bold; " onClick="location.href='alumnoscalificacion.php'">Calificaciones</button></div>

                        <div class="cell" style="width:calc(50% - 6px); margin:3px; float:right;"><button class="libros" style="width:100%; float:left; height:30px;   color:#4b9b4d; background-color: whitesmoke; border: 2px solid #4b9b4d; border-radius:3px; cursor: pointer; overflow:hidden; line-height:13px; font-weight:bold; " onClick="location.href='libros.php?id=<?php echo $idmateriacurso; ?>'">Libros</button></div>
                        
                        <div class="cell" style="width:calc(50% - 6px); margin:3px; float:right;"><button class="sesiones" style="width:100%; float:left; height:30px; color:#a76192; background-color: whitesmoke; border: 2px solid #a76192; border-radius:3px; cursor: pointer;overflow:hidden; line-height:13px; font-weight:bold; " onClick="location.href='sesiones.php?id=<?php echo $idcurso; ?>&materia=<?php echo $idmateriacurso; ?>'">Sesiones</button></div>

                    </div>


            </div>



<?php
            $contador = $contador + 1;
    
        }while( $row_Recordset4 =  mysql_fetch_assoc($Recordset4));
?>

            </div>
<?php 

    }while($row_Recordset2 = mysql_fetch_assoc($Recordset2));

?>
            
        </div>

    </div>
    
</div>


</body>
</html>
