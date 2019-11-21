<?php require_once('../Connections/conamatenlinea.php');


session_start();

if ($_SESSION['usuario'] != "") {
    
    header("Location: index.php");

}

mysql_select_db($database_conamatenlinea, $conamatenlinea);

$error = "";

if ($_POST){

    $codigo = $_POST['codigo'];

    if ($codigo != $_SESSION['keyreg']) {

        $error = "El código captcha es incorrecto, intentalo de nuevo";
    
    } else {

        $usuario = $_POST['usuario'];

        $query_Recordset1 = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
        $row_Recordset1 = mysql_fetch_assoc($Recordset1);
        $totalRows_Recordset1 = mysql_num_rows($Recordset1);  

        if($totalRows_Recordset1 == 0) {

            $error = "El usuario no existe.";

        } else {
            
            $password =  $_POST['password'];

            $query_Recordset2 = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$password'";
            $Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
            $row_Recordset2 = mysql_fetch_assoc($Recordset2);
            $totalRows_Recordset2 = mysql_num_rows($Recordset2);  

            if($totalRows_Recordset2 == 0) {

                $error = "La contraseña es incorrecta.";

            } else { 

                session_start();
                $_SESSION['usuario'] = $usuario;
                header("Location: index.php");
         
            }

        }

    }

}

?>


<html>
<head>
<meta charset="utf-8">
<title>CONAMAT | Admin</title>
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
</head>

<style>

body{
    margin: 0;
    font-size: 12px;
    font-family: 'Montserrat', sans-serif;
}
#seccion-main{
    background-image: url('../images/background.jpg');
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 800px;
    width: 100%;
    float: left;
    position: relative;
}
#overlay{
    min-width: 100%;
    background: black;
    opacity: 0.3;
    min-height: 100%;
    position: absolute;
    top: 0px;
    left: 0px;
    right: 0px;
    z-index: 1;
}
	
</style>

<script>

function validaenvia() {

if (document.login.usuario.value == "") {
alert("Por favor escribe tu usuario.");
document.login.usuario.focus();
return false;

}

if (document.login.password.value == "") {
alert("Por favor escribe tu contraseña.");
document.login.password.focus();
return false;

}

if (document.login.codigo.value == "") {
alert("Por favor escribe el código de la imagen.");
document.login.codigo.focus();
return false;

}

}

</script>
<body>

<div id="seccion-main" style="position: relative; width: 100%; height: 100vh;">

<div id="logo" style="width:370px; height:110px; position:absolute; top:20px; left:50%; margin-left:-185px; z-index:999;"><img src="../images/logotipo.png" style="float:left; width: 100%;" /></div>

<div id="overlay"></div>

<div id="seccion-form" style="width: 30%; position: absolute; z-index:1; top: 50%; margin-top: -160px; left: 50%; margin-left: -15%; background-color: white; box-sizing: border-box; padding-bottom: 50px;">

<div id="titulo" align="center" style="width: 100%; float:left; background-color:#0b2c4d; color:#fff; font-weight:bold; height:30px; line-height:30px; margin-bottom:30px;">ADMIN</div>

    <div id="linea" style="border-bottom: 1px solid #080032; width: 60px; height: 0px; margin: 10px  0;"></div>


	<?php 

    	if ($error != "") {

	?>

    <div id="subtitulo" align="center" style="width: 100%; color: #FF4136; margin-bottom: 20px; text-align: center; font-size: 13px;"><?php echo $error; ?></div>

	<?php } ?>


    <form id="login" name="login" action="login.php" method="post" enctype="multipart/form-data" style="width:80%; margin-left:10%;" onSubmit="return(validaenvia())">

        <input id="usuario" name="usuario" type="text" placeholder="Usuario" value="<?php echo $usuario; ?>" style="font-size: 15px; width: 100%; margin: 10px 0; box-sizing: border-box; padding: 10px 10px; border: 1px solid #c4ccda; background-color: #DDE3EC; color: gray;" />

        <input id="pass" name="password" type="password" placeholder="Contraseña" style="font-size: 15px; width: 100%; margin: 5px 0; box-sizing: border-box; padding: 10px 10px; border: 1px solid #c4ccda; background-color: #DDE3EC; color: gray;" />

        <input type="text" id="codigo" name="codigo" placeholder="Código" style="font-size: 15px; width: 45%; margin: 10px 0; margin-right: 5%; box-sizing: border-box; box-sizing: border-box; padding: 10px 10px; border: 1px solid #c4ccda; background-color: #DDE3EC; color: gray; float: left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
 
        <div id="captchainput" style="width: 50%; height: 40px; overflow: hidden; float:left; margin-top: 10px;">

        	<img src="../captcha2/captcha.php" width="100%" height="36" border="1" style="float:left; border-color:#B7B5B5;" />
 		</div>

        <div align="center" style="width: 100%; float: left;">
        	<button style="padding: 10px 40px; border: none; background-color: #244261; color: white; margin-top: 20px; font-weight: bold; cursor: pointer;">ENTRAR</button>
        </div>

    </form>

</div>

</div><!--Fin de seccion-main-->
    
</body>
</html>
