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
$query_Recordset1 = "SELECT * FROM alumnos";
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

header("Location: alumnos.php");
exit;

}

if ($_POST) {

$nombre = $_POST['nombre'];
$matricula = $_POST['matricula'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$apellidomaterno = $_POST['apellidomaterno'];
$apellidopaterno = $_POST['apellidopaterno'];
$sexo = $_POST['sexo'];
$dia = $_POST['dia'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];
$curp = $_POST['curp'];
$pais = $_POST['pais'];
$estado = $_POST['estado'];
$municipio = $_POST['municipio'];
$colonia = $_POST['colonia'];
$calle = $_POST['calle'];
$codigopostal = $_POST['codigopostal'];
$telefono = $_POST['telefono'];
$curso = $_POST['curso'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM alumnos WHERE matricula = '$matricula'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); 

if ($totalRows_Recordset2 > 0) $error = "Ya hay un alumno con esa matricula";

if ($totalRows_Recordset2 == 0) {

mysql_query("INSERT INTO alumnos( matricula, nombrealumno, correo, contrasena, estadoalumno, apellidomaterno, apellidopaterno, sexo, dia, mes, ano, curp, pais, estado, municipio, colonia, calle, codigopostal, telefono, curso) VALUES('$matricula', '$nombre', '$correo', '$contrasena', 'activo', '$apellidomaterno', '$apellidopaterno', '$sexo', '$dia', '$mes', '$ano', '$curp', '$pais', '$estado', '$municipio', '$colonia', '$calle', '$codigopostal', '$telefono', '$curso')"); 

mysql_query("INSERT INTO actividad(accion, usuario, fecha) VALUES( 'Creó alumno', '$usuario', '$unixtime')"); 

header("Location: alumnos.php");
exit;

}


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
    -webkit-box-shadow: 0 0 20px rgba(0,0,0,.08);
    box-shadow: 0 0 20px rgba(0,0,0,.08);
    background-color: white;
    padding: 30px 30px;
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
.imagencurso{
    width: 100%;
    margin-bottom: 10px;
    height: 200px;
    overflow: hidden;
    float: left;
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

	url : "modificaracademico.php",
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

    $("#seccion-form").slideToggle("fast");

    var boton = $("#botonagregar");

    if (boton.text() == "Agregar alumno") {

        boton.text("Cerrar")
    
    } else {

        boton.text("Agregar alumno")
    
    }
    
}

function eliminar(id) {

    if (confirm("¿Estás seguro de eliminar este alumno?")==1) {

        location.href="eliminaralumno.php?id="+id;

    }

}


function modificar(id) {

    location.href = "modificaralumno.php?id=" + id;

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

            <div id="link">Alumnos</div>

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

    <a href="Javascript:void(0)" onclick="nuevo()"><div id="botonagregar" align="center" style=" width: 100%; float: left; background: #305b84; padding-top: 20px; padding-bottom: 20px; cursor: pointer; font-size: 16px; font-family: 'Montserrat', sans-serif; text-decoration: underline;">Agregar alumno</div></a>

    <div id="seccion-form" style="width: 100%; display: none; float: left; margin-bottom: 40px; background-color: white; box-sizing: border-box; padding: 30px; border: 1px solid rgb(51, 51, 51); box-shadow: rgba(0, 0, 0, 0.08) 0px 0px 20px;">

        <div id="titulo" style="width: 100%; margin-bottom: 40px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Nuevo alumno</div>

        <form id="form1" name="form1" action="" method="post" onsubmit="return(validaenvia())" enctype="multipart/form-data">

            <div id="nombrecompleto" style="width:100%;">

                <div id="etiquetas" style="width: 100%; font-size: 13px; text-align: center;">

                    <div style="width: 33%;text-align:left;font-family:montserrat;float: left;">Nombre</div>

                    <div style="width: 33%;text-align:left;float:left;font-family:montserrat;">Apellido Paterno</div>

                    <div style="width: 31%;text-align:left;float:left;font-family:montserrat;">Apellido Materno</div>

                </div>

                <div id="inputs" style="width:100%; ">

                    <input id="nombre" name="nombre" type="text" value=""  style="font-size: 12px;width: calc(33.3333% - 29px);margin: 10px 0;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                        autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                    <input id="apellidopaterno" name="apellidopaterno" type="text" value=""  style="font-size: 12px;width: calc(33.3333% - 20px);margin: 10px 0;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                        autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                    <input id="apellidopaterno" name="apellidomaterno" type="text" value=""  style="font-size: 12px;width: calc(33.3333% - 20px);margin: 10px 0;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                        autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                </div>

            </div>


            <div id="genero" name="genero" value="" style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                Sexo
                <div id="opciones" style=" font-family: arial; margin-top: 10px; font-size: 14px;">
                    <input type="radio" name="sexo" style="margin-left: 20px;" id="origen_0" value="masculino">Masculino
                    <input style="margin-left: 40px;" type="radio" name="sexo" id="origen_1" value="femenino">Femenino
                </div>
            </div>

            <div id="miembro" name="miembro" type="text" value="" style="font-size: 12px; float:left;width: calc(100% - 40px);padding: 10px 20px;border: none;background-color: whitesmoke;color: gray;"
                autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                <div id="etiqueta" style="float: left; width: 100%; line-height: 20px;">Fecha de nacimiento</div>
                <div id="usuario1" align="left" style="width: 220px;float:left;height:25px;padding-left:10px;line-height:25px;margin-top:10px;margin-left:10px;"><select id="dia" name="dia" style="font-family: montserrat;float: left;height: 20px;">
                        <option value="">Día</option>
                        <option value="1" >01</option>
                        <option value="2" >02</option>
                        <option value="3" >03</option>
                        <option value="4" >04</option>
                        <option value="5" >05</option>
                        <option value="6" >06</option>
                        <option value="7" >07</option>
                        <option value="8" >08</option>
                        <option value="9" >09</option>
                        <option value="10"  >10</option>
                        <option value="11"  >11</option>
                        <option value="12"  >12</option>
                        <option value="13"  >13</option>
                        <option value="14"  >14</option>
                        <option value="15"  >15</option>
                        <option value="16"  >16</option>
                        <option value="17"  >17</option>
                        <option value="18"  >18</option>
                        <option value="19"  >19</option>
                        <option value="20"  >20</option>
                        <option value="21"  >21</option>
                        <option value="22"  >22</option>
                        <option value="23"  >23</option>
                        <option value="24"  >24</option>
                        <option value="25"  >25</option>
                        <option value="26"  >26</option>
                        <option value="27"  >27</option>
                        <option value="28"  >28</option>
                        <option value="29"  >29</option>
                        <option value="30"  >30</option>
                        <option value="31"  >31</option>
                    </select>

                    <select id="mes" name="mes" style="font-family: montserrat;float:left;margin-left:5px; height: 20px;" class="className">
                        <option value="">Mes</option>
                        <option value="01" >Enero</option>
                        <option value="02" >Febrero</option>
                        <option value="03" >Marzo</option>
                        <option value="04" >Abril</option>
                        <option value="05" >Mayo</option>
                        <option value="06" >Junio</option>
                        <option value="07" >Julio</option>
                        <option value="08" >Agosto</option>
                        <option value="09" >Septiembre</option>
                        <option value="10" >Octubre</option>
                        <option value="11" >Noviembre</option>
                        <option value="12" >Diciembre</option>
                    </select>

                    <select id="ano" name="ano" style="font-family: montserrat;float:left;margin-left:5px;height:20px;" class="className">
                        <option value="">Año</option>
                        <option value="2010" >2010</option>
                        <option value="2009" >2009</option>
                        <option value="2008" >2008</option>
                        <option value="2007" >2007</option>
                        <option value="2006" >2006</option>
                        <option value="2005" >2005</option>
                        <option value="2004" >2004</option>
                        <option value="2003" >2003</option>
                        <option value="2002" >2002</option>
                        <option value="2001" >2001</option>
                        <option value="2000" >2000</option>
                        <option value="1999" >1999</option>
                        <option value="1998" >1998</option>
                        <option value="1997" >1997</option>
                        <option value="1996" >1996</option>
                        <option value="1995" >1995</option>
                        <option value="1994" >1994</option>
                        <option value="1993" >1993</option>
                        <option value="1992" >1992</option>
                        <option value="1991" >1991</option>
                        <option value="1990" >1990</option>
                        <option value="1989" >1989</option>
                        <option value="1988" >1988</option>
                        <option value="1987" >1987</option>
                        <option value="1986" >1986</option>
                        <option value="1985" >1985</option>
                        <option value="1984" >1984</option>
                        <option value="1983" >1983</option>
                        <option value="1982" >1982</option>
                        <option value="1981" >1981</option>
                        <option value="1980" >1980</option>
                        <option value="1979" >1979</option>
                        <option value="1978" >1978</option>
                        <option value="1977" >1977</option>
                        <option value="1976" >1976</option>
                        <option value="1975" >1975</option>
                        <option value="1974" >1974</option>
                        <option value="1973" >1973</option>
                        <option value="1972" >1972</option>
                        <option value="1971" >1971</option>
                        <option value="1970" >1970</option>
                        <option value="1969" >1969</option>
                        <option value="1968" >1968</option>
                        <option value="1967" >1967</option>
                        <option value="1966" >1966</option>
                        <option value="1965" >1965</option>
                        <option value="1964" >1964</option>
                        <option value="1963" >1963</option>
                        <option value="1962" >1962</option>
                        <option value="1961" >1961</option>
                        <option value="1960" >1960</option>
                        <option value="1959" >1959</option>
                        <option value="1958" >1958</option>
                        <option value="1957" >1957</option>
                        <option value="1956" >1956</option>
                        <option value="1955" >1955</option>
                        <option value="1954" >1954</option>
                        <option value="1953" >1953</option>
                        <option value="1952" >1952</option>
                        <option value="1951" >1951</option>
                        <option value="1950" >1950</option>
                    </select>

                </div>
            </div>

            <div style="font-size: 13px; float: left; width: calc(50% - 2%); background-color: white; float: left; padding-right: 2%;font-family: montserrat; padding-top: 10px;">Matricula
                <input id="miembro" name="matricula" type="text" value=""  style="font-size: 12px;width: calc(100% - 20px);margin-right:2%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>


            <div style="font-size: 13px; float: left; width: calc(50% - 2%); padding-top: 10px; background-color: white; float: left; padding-left: 2%; font-family: montserrat;">CURP
                <input id="miembro" name="curp" type="text" value=""  style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>

            <div id="miembro" name="miembro" type="text" value="" style="font-size: 12px;width: 100%;margin: 10px 0;float: left;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                Pais
                <div id="opciones" style="/* float:right; */font-family: arial;margin-top: 10px;font-size: 14px;">
                    <input type="radio" style="margin-left: 20px;" name="origen" id="origen_0" value="mexico">México
                    <input type="radio" style="margin-left: 40px;" name="origen" id="origen_1" value="otropais">Otro país
                </div>
            </div>


            <div id="miembro" name="miembro" type="text" value="" style="font-size: 13px;width: 100%;margin: 10px 0;box-sizing: border-box;float: left;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;font-family: montserrat;"
                autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                
                <select id="estado" name="estado" style="font-family: montserrat;font-size: 14px;">
                    <option value="1">Aguascalientes</option>
                    <option value="2">Baja California</option>
                    <option value="3">Baja California Sur</option>
                    <option value="4">Campeche</option>
                    <option value="5">Chiapas</option>
                    <option value="6">Chihuahua</option>
                    <option value="7">Coahuila</option>
                    <option value="8">Colima</option>
                    <option value="9">Durango</option>
                    <option value="10">Estado de México</option>
                    <option value="11">Guanajuato</option>
                    <option value="12">Guerrero</option>
                    <option value="13">Hidalgo</option>
                    <option value="14">Jalisco</option>
                    <option value="15">Michoacán</option>
                    <option value="16">Morelos</option>
                    <option value="17">Nayarit</option>
                    <option value="18">Nuevo León</option>
                    <option value="19">Oaxaca</option>
                    <option value="20">Puebla</option>
                    <option value="21">Querétaro</option>
                    <option value="22">Quintana Roo</option>
                    <option value="23">San Luis Potosí</option>
                    <option value="24">Sinaloa</option>
                    <option value="25">Sonora</option>
                    <option value="26">Tabasco</option>
                    <option value="27">Tamaulipas</option>
                    <option value="28">Tlaxcala</option>
                    <option value="29">Veracruz</option>
                    <option value="30">Yucatan</option>
                    <option value="31">Zacatecas</option>
                </select>
            </div>

            <div style="font-family:Montserrat; font-size:13px;">Municipio
                <input id="miembro" name="municipio" type="text" value=""  style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>


            <div id="etiquetas" style="font-size: 13px;text-align: center;width:100%;font-family: montserrat;">
                <div style="width: 50%;text-align: left;float: left;">Colonia</div>
                <div style="float: left;width: 50%; text-align: left;">Calle y Numero</div>
            </div>

            <input id="miembro" name="colonia" type="text" value=""  style="font-size: 12px;width: 49%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            <input id="miembro" name="calle" type="text" value=""  style="font-size: 12px;width: 49%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">


            <div style="font-family:Montserrat; font-size:13px;"> Codigo Postal
                <input id="miembro" name="codigopostal" type="text" value=""  style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>

            <div style="font-family:Montserrat; font-size:13px;"> Telefono
                <input id="miembro" name="telefono" type="text" value=""  style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>

            <div style="font-family:Montserrat; font-size:13px;"> Correo
                <input id="miembro" name="correo" type="text" value=""  style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>

            <div style="font-family:Montserrat; font-size:13px;"> Contraseña
                <input id="contrasena" name="contrasena" type="password"  style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>

            <div style="font-family:Montserrat; font-size:13px;"> Curso
                <input id="miembro" name="curso" type="text" value="" style="font-size: 12px;width: 100%;margin: 10px 0;box-sizing: border-box;padding: 10px 10px;border: none;background-color: whitesmoke;color: gray;"
                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>

            <div align="center" style="width: 100%; float: left;">

                <button style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #7FDBFF; margin-top: 15px; width:200px; color: #7FDBFF; background-color: #1d4267;">AGREGAR</button>

            </div>

        </form>

    </div>       


<div id="seccionalumnos" style="width: 100%; background-color: #fff; text-align:center; float:left; float: left;">

    <div id="tituloseccion" style="line-height: 40px; margin-top: 10px; color:#777; border-bottom: 2px solid lightgray; margin-left: 10px; margin-right: 10px; font-size: 20px; text-align: left;">Lista de alumnos</div>

<?php 

$numcurso = 1;

if ($totalRows_Recordset1 > 0) {
    
    do{

        $nombre = $row_Recordset1['nombrealumno'];
        $apellido1 = $row_Recordset1['apellidopaterno'];
        $apellido2 = $row_Recordset1['apellidomaterno'];
        $correo = $row_Recordset1['correo'];
        $curp = $row_Recordset1['curp'];
        $imagen = $row_Recordset1['imagen'];
        $id = $row_Recordset1['id'];

?>


            <!--Noticia 1 -->
            <div id="alumno<?php echo $id; ?>" style="float: left; overflow: hidden;width:calc(100% - 20px);height: 155px;background-color:#FFF;display:inline-block; border-bottom:1px solid lightgray;padding-bottom: 20px;padding-top: 20px; margin-left: 10px;">

            <a href="" <div id="imagen<?php echo $id; ?>" style="width: 20%;height: 150px;float:left;padding-left: 10px; padding-right:10px; background-image:url('../images/<?php if ($imagen != "") {  echo $imagen;} else{ echo "silueta.png";} ?>');background-size: cover;background-position: center;background-repeat: no-repeat;"
                </div></a>

                <a href=""> <div id="title" style="padding-right: 5%;padding-left: 5%;text-align: left;letter-spacing: 1.5px;width: 65%;line-height:20px;float:left;margin-top:20px;color:black;font-size: 18px;font-weight:bold;"><?php echo $nombre; ?> <?php echo $apellido1; ?> <?php echo $apellido2; ?></div></a>

                    <div id="correo" align="center" style="text-align: left;width: 65%;padding-left:5%;overflow: hidden;padding-right:5%;float:left;margin-top:20px;color:#6A6969;font-size: 14px;">Correo: <?php echo $correo; ?></div>

                    <div id="curp" align="center" style="text-align: left;width: 65%;padding-left:5%;overflow: hidden;padding-right:5%;float:left;margin-top:10px;color:#6A6969;font-size: 14px;">Curp: <?php echo $curp; ?></div>

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
</div>
</body>
</html>
