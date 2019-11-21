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

$nombre = addslashes(addslashes(trim($_POST['nombre'])));
$matricula = addslashes(addslashes(trim($_POST['matricula'])));
$correo = addslashes(addslashes(trim($_POST['correo'])));
$contrasena = addslashes(addslashes(trim($_POST['contrasena'])));
$apellidomaterno = addslashes(addslashes(trim($_POST['apellidomaterno'])));
$apellidopaterno = addslashes(addslashes(trim($_POST['apellidopaterno'])));
$sexo = $_POST['sexo'];
$dia = $_POST['dia'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];
$curp = addslashes(addslashes(trim($_POST['curp'])));
$pais = $_POST['pais'];
$estado = $_POST['estado'];
$municipio = addslashes(addslashes(trim($_POST['municipio'])));
$colonia = addslashes(addslashes(trim($_POST['colonia'])));
$calle = addslashes(addslashes(trim($_POST['calle'])));
$codigopostal = addslashes(addslashes(trim($_POST['codigopostal'])));
$telefono = addslashes(addslashes(trim($_POST['telefono'])));
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

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset3 = "SELECT * FROM cursos";
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
	

function inscripcion(id) {

    location.href = "inscripcion.php?id=" + id;

}
</script>
<script>

function valida_envia() {
	
if (document.form1.nombre.value == "") {

    alert("Por favor escribe el o los nombres del alumno");
    document.form1.nombre.focus();
    return false;
}

if (document.form1.apellidopaterno.value == "") {

    alert("Por favor escribe el apellido paterno del alumno");
    document.form1.apellidopaterno.focus();
    return false;
}

if (document.form1.apellidomaterno.value == "") {

    alert("Por favor escribe el apellido materno del alumno");
    document.form1.apellidomaterno.focus();
    return false;
}

if (document.form1.sexo.value == "") {

    alert("Por favor selecciona el sexo del alumno");
    document.form1.origen_0.focus();
    return false;
}

if (document.form1.dia.value == "") {

    alert("Por favor selecciona el dia de nacimiento del alumno");
    document.form1.dia.focus();
    return false;
}

if (document.form1.mes.value == "") {

    alert("Por favor selecciona el mes de nacimiento del alumno");
    document.form1.mes.focus();
    return false;
}

if (document.form1.ano.value == "") {

    alert("Por favor selecciona el año de nacimiento del alumno");
    document.form1.ano.focus();
    return false;
}

if (document.form1.matricula.value == "") {

    alert("Por favor escribe la matrícula");
    document.form1.matricula.focus();
    return false;
}

if (document.form1.curp.value == "") {

    alert("Por favor escribe la curp");
    document.form1.curp.focus();
    return false;
}

if (document.form1.calle.value == "") {

    alert("Por favor escribe la calle");
    document.form1.calle.focus();
    return false;
}

if (document.form1.numero.value == "") {

    alert("Por favor escribe el número de la calle");
    document.form1.numero.focus();
    return false;
}

if (document.form1.interior.value == "") {

    alert("Por favor escribe el número de interior");
    document.form1.interior.focus();
    return false;
}

if (document.form1.colonia.value == "") {

    alert("Por favor escribe el nombre de la colonia");
    document.form1.colonia.focus();
    return false;
}

if (document.form1.telefono.value == "") {

    alert("Por favor escribe un número de telefono");
    document.form1.telefono.focus();
    return false;
}

if (document.form1.cp.value == "") {

    alert("Por favor escribe el código postal");
    document.form1.cp.focus();
    return false;
}

if (document.form1.ciudad.value == "") {

    alert("Por favor escribe la ciudad ");
    document.form1.ciudad.focus();
    return false;
}

if (document.form1.estado.value == "") {

    alert("Por favor escribe el estado");
    document.form1.estado.focus();
    return false;
}

if (document.form1.email.value == "") {

    alert("Por favor escribe un email");
    document.form1.email.focus();
    return false;
}

if (document.form1.password.value == "") {

    alert("Por favor escribe una contraseña");
    document.form1.password.focus();
    return false;
}

if (document.form1.repassword.value == "") {

    alert("Por favor vuelve a escribir la contraseña");
    document.form1.repassword.focus();
    return false;
}

if (document.form1.curso.value == "") {

    alert("Por favor selecciona un curso");
    document.form1.curso.focus();
    return false;
}

if (document.form1.grupo.value == "") {

    alert("Por favor selecciona un grupo");
    document.form1.grupo.focus();
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

    <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">

    <a href="Javascript:void()" onclick="nuevo()"><div id="botonagregar" align="center" style=" width: 100%; float: left; background: #305b84; padding-top: 20px; padding-bottom: 20px; cursor: pointer; font-size: 16px; font-family: 'Montserrat', sans-serif; text-decoration: underline;">Agregar alumno</div></a>

    <div id="seccion-form" style="width: 100%; display: none; float: left; margin-bottom: 40px; background-color: white; box-sizing: border-box; padding: 30px; border: 1px solid rgb(51, 51, 51); box-shadow: rgba(0, 0, 0, 0.08) 0px 0px 20px;">

        <div id="titulo" style="width: 100%; margin-bottom: 40px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Nuevo alumno</div>

        <form id="form1" name="form1" action="" method="post" onsubmit="return(valida_envia())" enctype="multipart/form-data">

            <div id="nombrecompleto" style="width:100%; float:left;">

                <div id="etiquetas" style="width: 100%; font-size: 13px; text-align: center; float:left; margin-top:5px;">

                    <div style="width: 33.3%; text-align:left; float: left;">Nombre (s)</div>

                    <div style="width: 33.3%; text-align:left; float:left;">Apellido paterno</div>

                    <div style="width: 33.3%; text-align:left; float:left;">Apellido materno</div>

                </div>

                <div id="inputs" style="width:100%; float:left; margin-top:5px;">

                    <input id="nombre" name="nombre" type="text" value=""  style="font-size: 12px;width: calc(33.3333% - 36px); padding: 10px; border: 1px solid #e8e1e1;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                    <input id="apellidopaterno" name="apellidopaterno" type="text" value=""  style="font-size: 12px;width: calc(33.3333% - 36px); margin-left:10px; padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                    <input id="apellidomaterno" name="apellidomaterno" type="text" value=""  style="font-size: 12px;width: calc(33.3333% - 26px); margin-left: 10px; padding: 10px; border: 1px solid #e8e1e1;background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                </div>

            </div>
            
            <div id="etiquetas" style="width: 100%; font-size: 13px; text-align: center; float:left; margin-top:10px;">

                    <div style="width: calc(50% - 5px); text-align:left; float: left;">Sexo</div>

                    <div style="width: calc(50% - 15px); text-align:left; float:left; margin-left:10px;">Fecha de nacimiento</div>

                </div>


            <div id="genero" name="genero" value="" style="font-size: 12px; height:30px; width: calc(50% - 33px); padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray; float:left; margin-top:5px;">
   
                <div id="opciones" style=" font-family: arial; font-size: 14px; height:30px; line-height:30px;">
                    <input type="radio" name="sexo" style="margin-left: 20px;" id="origen_0" value="masculino"><label for="origen_0" style="margin-left:5px;">Masculino</label>
                    <input style="margin-left: 40px;" type="radio" name="sexo" id="origen_1" value="femenino"><label for="origen_1" style="margin-left:5px;">Femenino</label>
                </div>
            </div>

            <div id="fechan" name="fechan" type="text" value="" style="font-size: 12px; height:30px; float:left;width: calc(50% - 33px); padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray;  margin-top:5px; margin-left:16px;">
                <select id="dia" name="dia" style="float: left; width:50px; height:36px; -webkit-appearance:select; float:left;">
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

                    <select id="mes" name="mes" style="float:left; margin-left:5px; width:150px; height:36px; -webkit-appearance:select;" class="className">
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

                    <select id="ano" name="ano" style="float:left; margin-left:5px; width:80px; height:36px; -webkit-appearance:select;" class="className">
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

            <div id="nombrecompleto" style="width:100%; float:left;">

                <div id="etiquetas" style="width: 100%; font-size: 13px; text-align: center; float:left; margin-top:10px;">

                    <div style="width: 50%; text-align:left; float: left;">Matrícula</div>

                    <div style="width: calc(50% - 10px); margin-left:10px; text-align:left; float:left;">CURP</div>
                    
                </div>
                
                 <div id="inputs" style="width:100%; float:left; margin-top:5px;">

                    <input id="matricula" name="matricula" type="text" value=""  style="font-size: 12px;width: calc(50% - 31px); padding: 10px; border: 1px solid #e8e1e1;background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                    <input id="curp" name="curp" type="text" value=""  style="font-size: 12px;width: calc(50% - 31px); margin-left:10px; padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                </div>
                
                </div>
                
                
                <div id="titulo" align="center" style="width:100%; float:left; margin-top:30px;">Dirección</div>
                
                
                <div id="etiquetas" style="font-size: 13px; float:left; margin-top:10px; width:100%;">
                
                <div style="width:calc(50% - 110px); text-align: left; float: left;">Calle</div>
                
                <div align="center" style="float: left; width: 52px; margin-left:10px;">No.</div>
                
                <div align="center" style="float: left; width: 52px; margin-left:10px;">Int.</div>
                
                <div style="width:calc(50% - 24px); text-align: left; float: left; margin-left:10px;">Colonia</div>
                
            </div>
            
              <div id="inputs" style="width:100%; float:left; margin-top:5px;">

                    <input id="calle" name="calle" type="text" value=""  style="font-size: 12px; width: calc(50% - 132px); padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                    
                    <input id="numero" name="numero" type="text" value=""  style="font-size: 12px; width: 30px; padding: 10px; text-align:center; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray; margin-left:10px; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                    
                    <input id="interior" name="interior" type="text" value=""  style="font-size: 12px; width: 30px; padding: 10px; text-align:center; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray; margin-left:10px; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                    <input id="colonia" name="colonia" type="text" value=""  style="font-size: 12px;width: calc(50% - 50px); padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray; margin-left:10px; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                </div>
                
                
                 <div id="nombrecompleto" style="width:100%; float:left; margin-top:10px;">

                <div id="etiquetas" style="width: 100%; font-size: 13px; text-align: center; float:left; margin-top:5px;">

                    <div style="width: 25%; text-align:left; float: left;">Teléfono</div>

                    <div style="width: 25%; text-align:left; float:left;">Código postal</div>

                    <div style="width: 25%; text-align:left; float:left;">Ciudad</div>
                    
                    <div style="width: 25%; text-align:left; float:left;">Estado</div>

                </div>

                <div id="inputs" style="width:100%; float:left; margin-top:5px;">

                    <input id="telefono" name="telefono" type="text" value=""  style="font-size: 12px;width: calc(25% - 31px); padding: 10px; border: 1px solid #e8e1e1;background-color: whitesmoke;color: gray; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                    <input id="cp" name="cp" type="text" value=""  style="font-size: 12px;width: calc(25% - 36px); margin-left:10px; padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                    <input id="ciudad" name="ciudad" type="text" value=""  style="font-size: 12px;width: calc(25% - 31px); margin-left: 10px; padding: 10px; border: 1px solid #e8e1e1;background-color: whitesmoke; color: gray; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                    
                    <select id="estado" name="estado"
                    style="font-size: 14px; float:left; width:calc(25% - 6px); height:36px; margin-left: 10px; -webkit-appearance:select;">
                    <option value="">Estado</option>
                   <option value="baja california">Baja California</option>     
                    <option value="aguascalientes">Aguascalientes</option>
                    <option value="baja california">Baja California</option>
                    <option value="baja california sur">Baja California Sur</option>
                    <option value="campeche">Campeche</option>
                    <option value="cdmx">Ciudad de México</option>
                    <option value="chiapas">Chiapas</option>
                    <option value="chihuahua">Chihuahua</option>
                    <option value="coahuila">Coahuila</option>
                    <option value="colima">Colima</option>
                    <option value="durango">Durango</option>
                    <option value="estado de mexico">Estado de México</option>
                    <option value="guanajuato">Guanajuato</option>
                    <option value="guerrero">Guerrero</option>
                    <option value="hidalgo">Hidalgo</option>
                    <option value="jalisco">Jalisco</option>
                    <option value="michoacan">Michoacán</option>
                    <option value="morelos">Morelos</option>
                    <option value="nayarit">Nayarit</option>
                    <option value="nuevo leon">Nuevo León</option>
                    <option value="oaxaca">Oaxaca</option>
                    <option value="puebla">Puebla</option>
                    <option value="queretaro">Querétaro</option>
                    <option value="quintana roo">Quintana Roo</option>
                    <option value="san luis potosi">San Luis Potosí</option>
                    <option value="sinaloa">Sinaloa</option>
                    <option value="sonora">Sonora</option>
                    <option value="tabasco">Tabasco</option>
                    <option value="tamaulipas">Tamaulipas</option>
                    <option value="tlaxcala">Tlaxcala</option>
                    <option value="veracruz">Veracruz</option>
                    <option value="yucatan">Yucatán</option>
                    <option value="zacatecas">Zacatecas</option>
                </select>

                </div>

            </div>
            
            <div id="titulo" align="center" style="width:100%; float:left; margin-top:30px;">Acceso al portal</div>
            
            <div id="nombrecompleto" style="width:100%; float:left; margin-top:10px;">

                <div id="etiquetas" style="width: 100%; font-size: 13px; text-align: center; float:left;">

                    <div style="width: 33%; text-align:left; float: left;">Email</div>
                    
                    <div style="width: calc(33% - 10px); text-align:left; float: left; margin-left:10px;">Contraseña</div>

                    <div style="width: calc(33% - 10px); margin-left:10px; text-align:left; float:left;">Re-escribe la contraseña</div>
                    
                </div>
                
                 <div id="inputs" style="width:100%; float:left; margin-top:5px;">

                    <input id="email" name="email" type="text" value=""  style="font-size: 12px;width: calc(33% - 31px); padding: 10px; border: 1px solid #e8e1e1;background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                    <input id="password" name="password" type="password" value=""  style="font-size: 12px;width: calc(33% - 31px); margin-left:10px; padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                    
                    <input id="repassword" name="repassword" type="password" value=""  style="font-size: 12px;width: calc(33% - 31px); margin-left:10px; padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                </div>
                
                </div>
                
                
                <div id="titulo" align="center" style="width:100%; float:left; margin-top:30px;">Inscribir</div>

            <div id="contenedorcurso" style="width: calc(50% - 5px); float: left; margin-top:5px;">
             
                <div style="font-size:13px; float:left; width:100%;">Curso</div>

                <select id="curso" name="curso" style="font-size: 12px; width: calc(100% - 2px); float:left; height:36px; font-size:14px; -webkit-appearance:select; margin-top:5px;">
                
               <?php if ($totalRows_Recordset3 == 0) { ?>
               <option value="">No hay cursos</option>
               <?php } else { ?>
                <option value="">Elegir</option>
				<?php 
                    
                        do{
    
                            $idcurso = stripslashes(stripslashes($row_Recordset3['id']));
                            $nombrecurso = stripslashes(stripslashes($row_Recordset3['nombre']));
                    
                    ?>
                        
                    <option value="<?php echo $idcurso; ?>"><?php echo $nombrecurso; ?></option>
    
                    <?php }while($row_Recordset3 = mysql_fetch_assoc($Recordset3)) ?>
               <?php } ?>
                </select>

            </div>
                    
            <div id="contenedorgrupo" style="width: calc(50% - 10px); float: left; margin-left: 10px; margin-top:5px;">

                <div style="font-size:13px; float:left; width:100%;">Grupo</div>
                    
                <select id="grupo" name="grupo" style="font-size: 12px;width: 100%; font-size:14px; float:left; height:36px; -webkit-appearance:select; margin-top:5px;">
               
                    <option value="">Grupo</option>

               
                </select>

            </div>
             
            <div align="center" style="width: 100%; float: left; margin-top:30px;">

                <button style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #7FDBFF; margin-top: 15px; width:200px; color: #7FDBFF; background-color: #1d4267;">AGREGAR</button>

            </div>

        </form>

    </div>       


<div id="seccionalumnos" style="width: 100%; background-color: #fff; text-align:center; float:left; float: left;">

    <div id="tituloseccion" style="line-height: 40px; margin-top: 10px; color:#777; border-bottom: 2px solid lightgray; margin-left: 10px; margin-right: 10px; font-size: 20px; text-align: left;">Lista de alumnos</div>

<?php 

$numcurso = 1;

if ($totalRows_Recordset1 > 0) {
    
    do {

        $nombre = $row_Recordset1['nombrealumno'];
        $apellido1 = $row_Recordset1['apellidopaterno'];
        $apellido2 = $row_Recordset1['apellidomaterno'];
        $correo = $row_Recordset1['correo'];
        $curp = $row_Recordset1['curp'];
        $imagen = $row_Recordset1['imagen'];
        $id = $row_Recordset1['id'];

?>


            <!--Noticia 1 -->
            <div id="alumno<?php echo $id; ?>" style="float:left; overflow:hidden; width:calc(100% - 20px); height: 100px; background-color:#FFF; border-bottom:1px solid lightgray; position:relative;">

            <a href=""><div id="imagen<?php echo $id; ?>" style="width:80px; height:80px; float:left; margin-top:10px; background-image:url('../images/<?php if ($imagen != "") {  echo $imagen;} else{ echo "silueta.png";} ?>');background-size: cover; background-position: center; background-repeat: no-repeat; margin-left: 10px;"></div></a>

                <a href=""><div id="title" align="left" style="width: calc(100% - 110px); line-height:20px; float:left; margin-top:10px; color:#000; font-size: 14px; font-weight:bold; margin-left:10px;"><?php echo $nombre; ?> <?php echo $apellido1; ?> <?php echo $apellido2; ?></div></a>

                    <div id="title" align="left" style="width: calc(100% - 110px); line-height:20px; float:left; margin-top:5px;color:#000; font-size: 12px; margin-left:10px;">Correo: <?php echo $correo; ?></div>

                    <div id="botonesdeedicion" style="position:absolute; top:10px; right:10px;"> 

                        <button id="botoneliminar" type="button" onclick="javascript:eliminar('<?php echo $id; ?>');" style="font-family: montserrat;border: solid #ed0000 2px;background: #f50000b5;float: right;border-radius: 5px;width: 100px;margin-left: 10px; cursor: pointer; font-size: 12px;color: white;padding-top: 10px; padding-bottom: 10px;">Eliminar</button>

                        <button id="botonmodificar" type="button" onclick="javascript:modificar('<?php echo $id; ?>');" style="font-family: montserrat;border: solid #595f61 2px;background: #00020287;float: right;border-radius: 5px;width: 100px;font-size: 12px;cursor: pointer;color: white;padding-top: 10px;padding-bottom: 10px;">Modificar</button>
                        
                        <button id="botoninscribir" type="button" onclick="javascript:inscripcion('<?php echo $id; ?>');" style="font-family: montserrat;border: solid #275490 2px;background: #3e678e;float: right;border-radius: 5px;width: 100px;font-size: 12px;cursor: pointer;color: white;padding-top: 10px;padding-bottom: 10px; margin-right: 10px;">Inscribir</button>

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

</div>
</body>
</html>
