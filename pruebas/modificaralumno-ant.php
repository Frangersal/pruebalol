<?php require_once('../Connections/conamatenlinea.php');

session_start();
$usuario = $_SESSION['usuario'];
$error = "";
date_default_timezone_set('America/Mexico_City');
$unixtime = time();

if ($usuario == "") {

    header("Location: index.php");
    exit;

}

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$permiso = $row_Recordset1['permiso'];

if ($permiso == 2) {

    header("Location: alumno.php");
    exit;

}

if ($_POST) {

    $nombre = addslashes(addslashes(trim($_POST['nombre'])));
    $idalumno = addslashes(addslashes(trim($_POST['idalumno'])));
    $apellidopaterno = addslashes(addslashes(trim($_POST['apellidopaterno'])));
    $apellidomaterno = addslashes(addslashes(trim($_POST['apellidomaterno'])));
    $sexo =$_POST['sexo'];
    $dia =$_POST['dia'];
    $mes =$_POST['mes'];
    $ano =$_POST['ano'];
    $matricula = addslashes(addslashes(trim($_POST['matricula'])));
    $curp = addslashes(addslashes(trim($_POST['curp'])));
    $pais = $_POST['pais'];
    $estado = $_POST['estado'];
    $municipio = addslashes(addslashes(trim($_POST['municipio'])));
    $colonia = addslashes(addslashes(trim($_POST['colonia'])));
    $calle = addslashes(addslashes(trim($_POST['calle'])));
    $codigopostal = addslashes(addslashes(trim($_POST['codigopostal'])));
    $telefono = addslashes(addslashes(trim($_POST['telefono'])));
    $correo = addslashes(addslashes(trim($_POST['correo'])));
    $contrasena = addslashes(addslashes(trim($_POST['contrasena'])));
    $curso = addslashes(addslashes(trim($_POST['curso'])));
	$grupo = addslashes(addslashes(trim($_POST['grupo'])));
    
	$fecha = $unixtime;

    mysql_select_db($database_conamatenlinea, $conamatenlinea);

    mysql_query("INSERT INTO actividad(usuario, accion, fecha) VALUES('$usuario', 'Modificó un alumno', '$unixtime')");

    mysql_query("UPDATE alumnos SET matricula = '$matricula', nombrealumno = '$nombre', correo = '$correo',
    contrasena = '$contrasena', estadoalumno = '$estadoalumno', apellidomaterno = '$apellidomaterno', apellidopaterno = '$apellidopaterno', 
    sexo = '$sexo', curp = '$curp', pais = '$pais', estado = '$estado', municipio = '$municipio', colonia = '$colonia', calle = '$calle', 
    codigopostal = '$codigopostal', telefono = '$telefono', curso = '$curso', idgrupo = '$grupo', dia ='$dia', mes = '$mes', ano ='$ano' WHERE id = '$idalumno'");
	
    mysql_query("INSERT INTO inscripciones(idcurso, grupo) VALUES ($curso', $grupo')"); 
    
    header("Location: alumnos.php");


}//Fin del POST


$id = $_GET['id'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset2 = "SELECT * FROM alumnos WHERE id = '$id'";
$Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);


$nombre = stripslashes(stripslashes($row_Recordset2['nombrealumno']));
$apellidopaterno = stripslashes(stripslashes($row_Recordset2['apellidopaterno']));
$apellidomaterno = stripslashes(stripslashes($row_Recordset2['apellidomaterno']));
$sexo = $row_Recordset2['sexo'];
$dia = $row_Recordset2['dia'];
$mes = $row_Recordset2['mes'];
$ano = $row_Recordset2['ano'];
$matricula = stripslashes(stripslashes($row_Recordset2['matricula']));
$curp = stripslashes(stripslashes($row_Recordset2['curp']));
$pais = $row_Recordset2['pais'];
$estado = $row_Recordset2['estado'];
$municipio = stripslashes(stripslashes($row_Recordset2['municipio']));
$colonia = stripslashes(stripslashes($row_Recordset2['colonia']));
$calle = stripslashes(stripslashes($row_Recordset2['calle']));
$codigopostal = stripslashes(stripslashes($row_Recordset2['codigopostal']));
$telefono = stripslashes(stripslashes($row_Recordset2['telefono']));
$correo = stripslashes(stripslashes($row_Recordset2['correo']));
$contrasena = stripslashes(stripslashes($row_Recordset2['contrasena']));
$curso = $row_Recordset2['curso'];
$grupo = $row_Recordset2['idgrupo'];

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset3 = "SELECT * FROM cursos";
$Recordset3 = mysql_query($query_Recordset3, $conamatenlinea) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset4 = "SELECT * FROM grupos";
$Recordset4 = mysql_query($query_Recordset4, $conamatenlinea) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>modificaralumno</title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
    <!--Librerias-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

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
<!--FIN Estilos CSS-->



<!--Javascript-->
<script type="text/javascript">

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
    
    if (document.form1.codigopostal.value == "") {
    
        alert("Por favor escribe el código postal");
        document.form1.codigopostal.focus();
        return false;
    }
    
    if (document.form1.municipio.value == "") {
    
        alert("Por favor escribe el municipio ");
        document.form1.unicipio.focus();
        return false;
    }
    
    if (document.form1.estado.value == "") {
    
        alert("Por favor escribe el estado");
        document.form1.estado.focus();
        return false;
    }
    
    if (document.form1.correo.value == "") {
    
        alert("Por favor escribe un correo");
        document.form1.correo.focus();
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
    
    $("#form1").submit();
    
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


            <div id="tituloseccion" align="center" style="color: #fff; background-color: #000; font-size: 12px; font-weight: bold; line-height: 30px; float: left; width: 100%;">MENÚ ADMIN</div>

            <a class="menu" href="actividad.php">Actividad</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="usuarios.php">Usuarios</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            <a class="menu" href="logout.php">Salir</a>

            <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

        </div>

    </div>

    <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">

    <a href="Javascript:void(0)" onclick="nuevo()"></a>

    <!--Seccion form-->
    <div id="seccion-form<?php echo $id; ?>" style="width: 100%; float: left; margin-bottom: 40px; background-color: white; box-sizing: border-box; padding: 30px; border: 1px solid rgb(51, 51, 51); box-shadow: rgba(0, 0, 0, 0.08) 0px 0px 20px;">

            <div id="titulo" style="width: 100%; margin-bottom: 40px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Modificar alumno</div>
    
            <form id="form1<?php echo $id; ?>" name="form1<?php echo $id; ?>" action="" method="post" onsubmit="return(valida_envia())" enctype="multipart/form-data">


                <input id="idalumno" name="idalumno" type="hidden" value="<?php echo $id; ?>">

                <div id="imagen<?php echo $id; ?>"  style="width:100px; height:100px; float:left; background-image:url('../images/<?php if ($imagen != "") {  echo $imagen;} else{ echo "silueta.png";} ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; margin:0px calc(50% - 50px);"></div>
    
                <div id="nombrecompleto" style="width:100%; float:left;">
    
                    <div id="etiquetas" style="width: 100%; font-size: 13px; text-align: center; float:left; margin-top:5px;">
    
                        <div style="width: 33.3%; text-align:left; float: left;">Nombre (s)</div>
    
                        <div style="width: 33.3%; text-align:left; float:left;">Apellido paterno</div>
    
                        <div style="width: 33.3%; text-align:left; float:left;">Apellido materno</div>
    
                    </div>
    
                    <div id="inputs" style="width:100%; float:left; margin-top:5px;">
    
                        <input id="nombre<?php echo $id; ?>" name="nombre" type="text" value="<?php echo $nombre; ?>" style="font-size: 12px;width: calc(33.3333% - 36px); padding: 10px; border: 1px solid #e8e1e1;background-color: whitesmoke;color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
    
                        <input id="apellidopaterno<?php echo $id; ?>" name="apellidopaterno" type="text" value="<?php echo $apellidopaterno; ?>" style="font-size: 12px;width: calc(33.3333% - 36px); margin-left:10px; padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
    
                        <input id="apellidomaterno<?php echo $id; ?>" name="apellidomaterno" type="text" value="<?php echo $apellidomaterno; ?>" style="font-size: 12px;width: calc(33.3333% - 26px); margin-left: 10px; padding: 10px; border: 1px solid #e8e1e1;background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
    
                    </div>
    
                </div>
                
                <div id="etiquetas" style="width: 100%; font-size: 13px; text-align: center; float:left; margin-top:10px;">
    
                        <div style="width: calc(50% - 5px); text-align:left; float: left;">Sexo</div>
    
                        <div style="width: calc(50% - 15px); text-align:left; float:left; margin-left:10px;">Fecha de nacimiento</div>
    
                    </div>
    
    
                <div id="genero" name="genero" value="" style="font-size: 12px; height:30px; width: calc(50% - 33px); padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray; float:left; margin-top:5px;">
       
                    <div id="opciones" style=" font-family: arial; font-size: 14px; height:30px; line-height:30px;">
                        <input type="radio" name="sexo" style="margin-left: 20px;" id="origen_0" value="masculino"<?php if ($sexo == 'masculino') {echo 'checked'; } ?>><label for="origen_0" style="margin-left:5px;">Masculino</label>
                        <input style="margin-left: 40px;" type="radio" name="sexo" id="origen_1" value="femenino"<?php if ($sexo == 'femenino') {echo 'checked'; } ?>><label for="origen_1" style="margin-left:5px;">Femenino</label>
                    </div>
                </div>
    
                <div id="fechan" name="fechan" type="text" value="" style="font-size: 12px; height:30px; float:left;width: calc(50% - 33px); padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray;  margin-top:5px; margin-left:16px;">
                    <select id="dia" name="dia" style="float: left; width:50px; height:36px; -webkit-appearance:select; float:left;">
                            <option value="">Día</option>
                            <option value="1" <?php if ($dia == '1') {echo 'selected'; } ?> >01</option>
                            <option value="2"<?php if ($dia == '2') {echo 'selected'; } ?> >02</option>
                            <option value="3"<?php if ($dia == '3') {echo 'selected'; } ?> >03</option>
                            <option value="4"<?php if ($dia == '4') {echo 'selected'; } ?> >04</option>
                            <option value="5"<?php if ($dia == '5') {echo 'selected'; } ?> >05</option>
                            <option value="6"<?php if ($dia == '6') {echo 'selected'; } ?> >06</option>
                            <option value="7"<?php if ($dia == '7') {echo 'selected'; } ?> >07</option>
                            <option value="8"<?php if ($dia == '8') {echo 'selected'; } ?> >08</option>
                            <option value="9"<?php if ($dia == '9') {echo 'selected'; } ?> >09</option>
                            <option value="10"<?php if ($dia == '10') {echo 'selected'; } ?> >10</option>
                            <option value="11"<?php if ($dia == '11') {echo 'selected'; } ?> >11</option>
                            <option value="12"<?php if ($dia == '12') {echo 'selected'; } ?> >12</option>
                            <option value="13"<?php if ($dia == '13') {echo 'selected'; } ?> >13</option>
                            <option value="14"<?php if ($dia == '14') {echo 'selected'; } ?> >14</option>
                            <option value="15"<?php if ($dia == '15') {echo 'selected'; } ?> >15</option>
                            <option value="16"<?php if ($dia == '16') {echo 'selected'; } ?> >16</option>
                            <option value="17"<?php if ($dia == '17') {echo 'selected'; } ?> >17</option>
                            <option value="18"<?php if ($dia == '18') {echo 'selected'; } ?> >18</option>
                            <option value="19"<?php if ($dia == '19') {echo 'selected'; } ?> >19</option>
                            <option value="20"<?php if ($dia == '20') {echo 'selected'; } ?> >20</option>
                            <option value="21"<?php if ($dia == '21') {echo 'selected'; } ?> >21</option>
                            <option value="22"<?php if ($dia == '22') {echo 'selected'; } ?> >22</option>
                            <option value="23"<?php if ($dia == '23') {echo 'selected'; } ?> >23</option>
                            <option value="24"<?php if ($dia == '24') {echo 'selected'; } ?> >24</option>
                            <option value="25"<?php if ($dia == '25') {echo 'selected'; } ?> >25</option>
                            <option value="26"<?php if ($dia == '26') {echo 'selected'; } ?> >26</option>
                            <option value="27"<?php if ($dia == '27') {echo 'selected'; } ?> >27</option>
                            <option value="28"<?php if ($dia == '28') {echo 'selected'; } ?> >28</option>
                            <option value="29"<?php if ($dia == '29') {echo 'selected'; } ?> >29</option>
                            <option value="30"<?php if ($dia == '30') {echo 'selected'; } ?> >30</option>
                            <option value="31"<?php if ($dia == '31') {echo 'selected'; } ?> >31</option>
                        </select>
    
                        <select id="mes" name="mes" style="float:left; margin-left:5px; width:150px; height:36px; -webkit-appearance:select;" class="className">
                            <option value="">Mes</option>
                            <option value="01"<?php if ($mes == '1') {echo 'selected'; } ?> >Enero</option>
                            <option value="02"<?php if ($mes == '2') {echo 'selected'; } ?> >Febrero</option>
                            <option value="03"<?php if ($mes == '3') {echo 'selected'; } ?> >Marzo</option>
                            <option value="04"<?php if ($mes == '4') {echo 'selected'; } ?> >Abril</option>
                            <option value="05"<?php if ($mes == '5') {echo 'selected'; } ?> >Mayo</option>
                            <option value="06"<?php if ($mes == '6') {echo 'selected'; } ?> >Junio</option>
                            <option value="07"<?php if ($mes == '7') {echo 'selected'; } ?> >Julio</option>
                            <option value="08"<?php if ($mes == '8') {echo 'selected'; } ?> >Agosto</option>
                            <option value="09"<?php if ($mes == '9') {echo 'selected'; } ?> >Septiembre</option>
                            <option value="10"<?php if ($mes == '10') {echo 'selected'; } ?> >Octubre</option>
                            <option value="11"<?php if ($mes == '11') {echo 'selected'; } ?> >Noviembre</option>
                            <option value="12"<?php if ($mes == '12') {echo 'selected'; } ?> >Diciembre</option>
                        </select>
    
                        <select id="ano" name="ano" style="float:left; margin-left:5px; width:80px; height:36px; -webkit-appearance:select;" class="className">
                            <option value="">Año</option>
                            <option value="2010"<?php if ($ano == '2010') {echo 'selected'; } ?> >2010</option>
                            <option value="2009"<?php if ($ano == '2009') {echo 'selected'; } ?> >2009</option>
                            <option value="2008"<?php if ($ano == '2008') {echo 'selected'; } ?> >2008</option>
                            <option value="2007"<?php if ($ano == '2007') {echo 'selected'; } ?> >2007</option>
                            <option value="2006"<?php if ($ano == '2006') {echo 'selected'; } ?> >2006</option>
                            <option value="2005"<?php if ($ano == '2005') {echo 'selected'; } ?> >2005</option>
                            <option value="2004"<?php if ($ano == '2004') {echo 'selected'; } ?> >2004</option>
                            <option value="2003"<?php if ($ano == '2003') {echo 'selected'; } ?> >2003</option>
                            <option value="2002"<?php if ($ano == '2002') {echo 'selected'; } ?> >2002</option>
                            <option value="2001"<?php if ($ano == '2001') {echo 'selected'; } ?> >2001</option>
                            <option value="2000"<?php if ($ano == '2000') {echo 'selected'; } ?> >2000</option>
                            <option value="1999"<?php if ($ano == '1999') {echo 'selected'; } ?> >1999</option>
                            <option value="1998"<?php if ($ano == '1998') {echo 'selected'; } ?> >1998</option>
                            <option value="1997"<?php if ($ano == '1997') {echo 'selected'; } ?> >1997</option>
                            <option value="1996"<?php if ($ano == '1996') {echo 'selected'; } ?> >1996</option>
                            <option value="1995"<?php if ($ano == '1995') {echo 'selected'; } ?> >1995</option>
                            <option value="1994"<?php if ($ano == '1994') {echo 'selected'; } ?> >1994</option>
                            <option value="1993"<?php if ($ano == '1993') {echo 'selected'; } ?> >1993</option>
                            <option value="1992"<?php if ($ano == '1992') {echo 'selected'; } ?> >1992</option>
                            <option value="1991"<?php if ($ano == '1991') {echo 'selected'; } ?> >1991</option>
                            <option value="1990"<?php if ($ano == '1990') {echo 'selected'; } ?> >1990</option>
                            <option value="1989"<?php if ($ano == '1989') {echo 'selected'; } ?> >1989</option>
                            <option value="1988"<?php if ($ano == '1988') {echo 'selected'; } ?> >1988</option>
                            <option value="1987"<?php if ($ano == '1987') {echo 'selected'; } ?> >1987</option>
                            <option value="1986"<?php if ($ano == '1986') {echo 'selected'; } ?> >1986</option>
                            <option value="1985"<?php if ($ano == '1985') {echo 'selected'; } ?> >1985</option>
                            <option value="1984"<?php if ($ano == '1984') {echo 'selected'; } ?> >1984</option>
                            <option value="1983"<?php if ($ano == '1983') {echo 'selected'; } ?> >1983</option>
                            <option value="1982"<?php if ($ano == '1982') {echo 'selected'; } ?> >1982</option>
                            <option value="1981"<?php if ($ano == '1981') {echo 'selected'; } ?> >1981</option>
                            <option value="1980"<?php if ($ano == '1980') {echo 'selected'; } ?> >1980</option>
                            <option value="1979"<?php if ($ano == '1979') {echo 'selected'; } ?> >1979</option>
                            <option value="1978"<?php if ($ano == '1978') {echo 'selected'; } ?> >1978</option>
                            <option value="1977"<?php if ($ano == '1977') {echo 'selected'; } ?> >1977</option>
                            <option value="1976"<?php if ($ano == '1976') {echo 'selected'; } ?> >1976</option>
                            <option value="1975"<?php if ($ano == '1975') {echo 'selected'; } ?> >1975</option>
                            <option value="1974"<?php if ($ano == '1974') {echo 'selected'; } ?> >1974</option>
                            <option value="1973"<?php if ($ano == '1973') {echo 'selected'; } ?> >1973</option>
                            <option value="1972"<?php if ($ano == '1972') {echo 'selected'; } ?> >1972</option>
                            <option value="1971"<?php if ($ano == '1971') {echo 'selected'; } ?> >1971</option>
                            <option value="1970"<?php if ($ano == '1970') {echo 'selected'; } ?> >1970</option>
                            <option value="1969"<?php if ($ano == '1969') {echo 'selected'; } ?> >1969</option>
                            <option value="1968"<?php if ($ano == '1968') {echo 'selected'; } ?> >1968</option>
                            <option value="1967"<?php if ($ano == '1967') {echo 'selected'; } ?> >1967</option>
                            <option value="1966"<?php if ($ano == '1966') {echo 'selected'; } ?> >1966</option>
                            <option value="1965"<?php if ($ano == '1965') {echo 'selected'; } ?> >1965</option>
                            <option value="1964"<?php if ($ano == '1964') {echo 'selected'; } ?> >1964</option>
                            <option value="1963"<?php if ($ano == '1963') {echo 'selected'; } ?> >1963</option>
                            <option value="1962"<?php if ($ano == '1962') {echo 'selected'; } ?> >1962</option>
                            <option value="1961"<?php if ($ano == '1961') {echo 'selected'; } ?> >1961</option>
                            <option value="1960"<?php if ($ano == '1960') {echo 'selected'; } ?> >1960</option>
                            <option value="1959"<?php if ($ano == '1959') {echo 'selected'; } ?> >1959</option>
                            <option value="1958"<?php if ($ano == '1958') {echo 'selected'; } ?> >1958</option>
                            <option value="1957"<?php if ($ano == '1957') {echo 'selected'; } ?> >1957</option>
                            <option value="1956"<?php if ($ano == '1956') {echo 'selected'; } ?> >1956</option>
                            <option value="1955"<?php if ($ano == '19955') {echo 'selected'; } ?> >1955</option>
                            <option value="1954"<?php if ($ano == '1954') {echo 'selected'; } ?> >1954</option>
                            <option value="1953"<?php if ($ano == '1953') {echo 'selected'; } ?> >1953</option>
                            <option value="1952"<?php if ($ano == '1952') {echo 'selected'; } ?> >1952</option>
                            <option value="1951"<?php if ($ano == '1951') {echo 'selected'; } ?> >1951</option>
                            <option value="1950"<?php if ($ano == '1950') {echo 'selected'; } ?> >1950</option>
                        </select>
    
                    
                </div>
    
                <div id="nombrecompleto" style="width:100%; float:left;">
    
                    <div id="etiquetas" style="width: 100%; font-size: 13px; text-align: center; float:left; margin-top:10px;">
    
                        <div style="width: 50%; text-align:left; float: left;">Matrícula</div>
    
                        <div style="width: calc(50% - 10px); margin-left:10px; text-align:left; float:left;">CURP</div>
                        
                    </div>
                    
                     <div id="inputs" style="width:100%; float:left; margin-top:5px;">
    
                        <input id="matricula<?php echo $id; ?>" name="matricula" type="text" value="<?php echo $matricula; ?>" style="font-size: 12px;width: calc(50% - 31px); padding: 10px; border: 1px solid #e8e1e1;background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
    
                        <input id="curp<?php echo $id; ?>" name="curp" type="text" value="<?php echo $curp; ?>" style="font-size: 12px;width: calc(50% - 31px); margin-left:10px; padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
    
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
    
                        <input id="calle<?php echo $id; ?>" name="calle" type="text" value="<?php echo $calle; ?>" style="font-size: 12px; width: calc(50% - 132px); padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                        
                        <input id="numero<?php echo $id; ?>" name="numero" type="text" value="<?php echo $numero; ?>" style="font-size: 12px; width: 30px; padding: 10px; text-align:center; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray; margin-left:10px; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                        
                        <input id="interior<?php echo $id; ?>" name="interior" type="text" value="<?php echo $interior; ?>" style="font-size: 12px; width: 30px; padding: 10px; text-align:center; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray; margin-left:10px; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
    
                        <input id="colonia<?php echo $id; ?>" name="colonia" type="text" value="<?php echo $colonia; ?>" style="font-size: 12px;width: calc(50% - 50px); padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray; margin-left:10px; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
    
                    </div>
                    
                    
                     <div id="nombrecompleto" style="width:100%; float:left; margin-top:10px;">
    
                    <div id="etiquetas" style="width: 100%; font-size: 13px; text-align: center; float:left; margin-top:5px;">
    
                        <div style="width: 25%; text-align:left; float: left;">Teléfono</div>
    
                        <div style="width: 25%; text-align:left; float:left;">Código postal</div>
    
                        <div style="width: 25%; text-align:left; float:left;">Municipio</div>
                        
                        <div style="width: 25%; text-align:left; float:left;">Estado</div>
    
                    </div>
    
                    <div id="inputs" style="width:100%; float:left; margin-top:5px;">
    
                        <input id="telefono<?php echo $id; ?>" name="telefono" type="text" value="<?php echo $telefono; ?>" style="font-size: 12px;width: calc(25% - 31px); padding: 10px; border: 1px solid #e8e1e1;background-color: whitesmoke;color: gray; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
    
                        <input id="codigopostal<?php echo $id; ?>" name="codigopostal" type="text" value="<?php echo $codigopostal; ?>" style="font-size: 12px;width: calc(25% - 36px); margin-left:10px; padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
    
                        <input id="municipio<?php echo $id; ?>" name="municipio" type="text" value="<?php echo $municipio; ?>" style="font-size: 12px;width: calc(25% - 31px); margin-left: 10px; padding: 10px; border: 1px solid #e8e1e1;background-color: whitesmoke; color: gray; float:left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                        
                        <select id="estado" name="estado" style="font-size: 14px; float:left; width:calc(25% - 6px); height:36px; margin-left: 10px; -webkit-appearance:select;">
                        <option value="">Estado</option>    
                        <option value="aguascalientes"<?php if ($estado == 'aguascalientes') {echo 'selected'; } ?>>Aguascalientes</option>
                        <option value="baja california"<?php if ($estado == 'baja california') {echo 'selected'; } ?>>Baja California</option>
                        <option value="baja california sur"<?php if ($estado == 'baja california sur') {echo 'selected'; } ?>>Baja California Sur</option>
                        <option value="campeche"<?php if ($estado == 'campeche') {echo 'selected'; } ?>>Campeche</option>
                        <option value="cdmx"<?php if ($estado == 'cdmx') {echo 'selected'; } ?>>Ciudad de México</option>
                        <option value="chiapas"<?php if ($estado == 'chiapas') {echo 'selected'; } ?>>Chiapas</option>
                        <option value="chihuahua"<?php if ($estado == 'chihuahua') {echo 'selected'; } ?>>Chihuahua</option>
                        <option value="coahuila"<?php if ($estado == 'coahuila') {echo 'selected'; } ?>>Coahuila</option>
                        <option value="colima"<?php if ($estado == 'colima') {echo 'selected'; } ?>>Colima</option>
                        <option value="durango"<?php if ($estado == 'durango') {echo 'selected'; } ?>>Durango</option>
                        <option value="estado de mexico"<?php if ($estado == 'estado de mexico') {echo 'selected'; } ?>>Estado de México</option>
                        <option value="guanajuato"<?php if ($estado == 'guanajuato') {echo 'selected'; } ?>>Guanajuato</option>
                        <option value="guerrero"<?php if ($estado == 'guerrero') {echo 'selected'; } ?>>Guerrero</option>
                        <option value="hidalgo"<?php if ($estado == 'hidalgo') {echo 'selected'; } ?>>Hidalgo</option>
                        <option value="jalisco"<?php if ($estado == 'jalisco') {echo 'selected'; } ?>>Jalisco</option>
                        <option value="michoacan"<?php if ($estado == 'michoacan') {echo 'selected'; } ?>>Michoacán</option>
                        <option value="morelos"<?php if ($estado == 'morelos') {echo 'selected'; } ?>>Morelos</option>
                        <option value="nayarit"<?php if ($estado == 'nayarit') {echo 'selected'; } ?>>Nayarit</option>
                        <option value="nuevo leon"<?php if ($estado == 'nuevo leon') {echo 'selected'; } ?>>Nuevo León</option>
                        <option value="oaxaca"<?php if ($estado == 'oaxaca') {echo 'selected'; } ?>>Oaxaca</option>
                        <option value="puebla"<?php if ($estado == 'puebla') {echo 'selected'; } ?>>Puebla</option>
                        <option value="queretaro"<?php if ($estado == 'queretaro') {echo 'selected'; } ?>>Querétaro</option>
                        <option value="quintana roo"<?php if ($estado == 'quintana roo') {echo 'selected'; } ?>>Quintana Roo</option>
                        <option value="san luis potosi"<?php if ($estado == 'san luis potosi') {echo 'selected'; } ?>>San Luis Potosí</option>
                        <option value="sinaloa"<?php if ($estado == 'sinaloa') {echo 'selected'; } ?>>Sinaloa</option>
                        <option value="sonora"<?php if ($estado == 'sonora') {echo 'selected'; } ?>>Sonora</option>
                        <option value="tabasco"<?php if ($estado == 'tabasco') {echo 'selected'; } ?>>Tabasco</option>
                        <option value="tamaulipas"<?php if ($estado == 'tamaulipas') {echo 'selected'; } ?>>Tamaulipas</option>
                        <option value="tlaxcala"<?php if ($estado == 'tlaxcala') {echo 'selected'; } ?>>Tlaxcala</option>
                        <option value="veracruz"<?php if ($estado == 'veracruz') {echo 'selected'; } ?>>Veracruz</option>
                        <option value="yucatan"<?php if ($estado == 'yucatan') {echo 'selected'; } ?>>Yucatán</option>
                        <option value="zacatecas"<?php if ($estado == 'zacatecas') {echo 'selected'; } ?>>Zacatecas</option>
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
    
                        <input id="correo<?php echo $id; ?>" name="correo" type="text" value="<?php echo $correo; ?>" style="font-size: 12px;width: calc(33% - 31px); padding: 10px; border: 1px solid #e8e1e1;background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
    
                        <input id="contrasena<?php echo $id; ?>" name="contrasena" type="password" value="<?php echo $contrasena; ?>" style="font-size: 12px;width: calc(33% - 31px); margin-left:10px; padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                        
                        <input id="repassword<?php echo $id; ?>" name="repassword" type="password" value="<?php echo $contrasena; ?>" style="font-size: 12px;width: calc(33% - 31px); margin-left:10px; padding: 10px; border: 1px solid #e8e1e1; background-color: whitesmoke; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
    
                    </div>
                    
                    </div>
                    
                    
                    <div id="titulo" align="center" style="width:100%; float:left; margin-top:30px;">Inscribir</div>
    
                <div id="contenedorcurso" style="width: calc(50% - 5px); float: left; margin-top:5px;">
                 
                    <div style="font-size:13px; float:left; width:100%;">Curso</div>
    
                    <select id="curso" name="curso" style="font-size: 12px; width: calc(100% - 2px); float:left; height:36px; font-size:14px; -webkit-appearance:select; margin-top:5px;">
                    
                        <option value="">Elegir</option>                  
                        <?php 
                    
                    do{

                        $idcurso = stripslashes(stripslashes($row_Recordset3['id']));
                        $nombrecurso = stripslashes(stripslashes($row_Recordset3['nombre']));
                
                ?>
                    
                <option value="<?php echo $idcurso; ?>" <?php if ($idcurso == $curso) {echo 'selected'; } ?>><?php echo $nombrecurso; ?></option>

                <?php }while($row_Recordset3 = mysql_fetch_assoc($Recordset3)) ?>
        
                    </select>
    
                </div>
                        
                <div id="contenedorgrupo" style="width: calc(50% - 10px); float: left; margin-left: 10px; margin-top:5px;">
    
                    <div style="font-size:13px; float:left; width:100%;">Grupo</div>
                        
                    <select id="grupo" name="grupo" style="font-size: 12px;width: 100%; font-size:14px; float:left; height:36px; -webkit-appearance:select; margin-top:5px;">
                   
                        <option value="">Grupo</option>

                        <?php 
                    
                    do{

                        $idgrupo = stripslashes(stripslashes($row_Recordset4['id']));
                        $nombregrupo = stripslashes(stripslashes($row_Recordset4['grupo']));
                
                ?>
                    
                <option value="<?php echo $idgrupo; ?>" <?php if ($idgrupo == $grupo) {echo 'selected'; } ?>><?php echo $nombregrupo; ?></option>

                <?php }while($row_Recordset4 = mysql_fetch_assoc($Recordset4)) ?>
    
                    </select>
    
                </div>
                 
                <div align="center" style="width: 100%; float: left; margin-top:30px;">
    
                        <button type="submit" onclick="valida_envia('<?php echo $id; ?>');" style="margin: 0px 10px;border-radius: 5px;padding: 10px 10px;font-weight: 900;font-size: 13px;cursor: pointer;border: 1px solid #7FDBFF;margin-top: 15px;width:200px;color: #7FDBFF;background-color: #1d4267;">GUARDAR CAMBIOS</button>
    
                        <button style="margin: 0px 10px;border-radius: 5px;padding: 10px 10px;font-weight: 900;font-size: 13px;cursor: pointer;border: 1px solid #cccccc;margin-top: 15px;width:200px;color: #f6f6f6;background-color: #878b8f;" onclick="window.location.href='./alumnos.php';">CANCELAR</button>
        
                </div>
    
            </form>
    
        </div>
    <!--Fin seccion form-->    

</div>


</div>


</body>

</html>
