<?php session_start();

require_once('../Connections/conamatenlinea.php');

if ($_SESSION['sesionalumno'] != "") {
    
    header("Location: index.php");
}

mysql_select_db($database_conamatenlinea, $conamatenlinea);

$error = "";

if ($_POST){

    $codigo = $_POST['codigo'];

    if ($codigo != $_SESSION['keyreg']) {

        $error = "El código captcha es incorrecto, intentalo de nuevo";
    
    } else {

        $matricula = $_POST['matricula'];

        $query_Recordset1 = "SELECT * FROM alumnos WHERE matricula = '$matricula'";
        $Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
        $row_Recordset1 = mysql_fetch_assoc($Recordset1);
        $totalRows_Recordset1 = mysql_num_rows($Recordset1); 
         
        $query_Recordset5 = "SELECT * FROM maestros WHERE usuario = '$matricula'";
        $Recordset5 = mysql_query($query_Recordset5, $conamatenlinea) or die(mysql_error());
        $row_Recordset5 = mysql_fetch_assoc($Recordset5);
        $totalRows_Recordset5 = mysql_num_rows($Recordset5); 

        if($totalRows_Recordset1 == 0 && $totalRows_Recordset5 == 0) {

            $error = "El usuario " . $matricula . " no existe.";

        } else {
            
            $password =  $_POST['password'];

            $query_Recordset2 = "SELECT * FROM alumnos WHERE matricula = '$matricula' AND contrasena = '$password'";
            $Recordset2 = mysql_query($query_Recordset2, $conamatenlinea) or die(mysql_error());
            $row_Recordset2 = mysql_fetch_assoc($Recordset2);
            $totalRows_Recordset2 = mysql_num_rows($Recordset2);  

            $query_Recordset6 = "SELECT * FROM maestros WHERE usuario = '$matricula' AND contrasena = '$password'";
            $Recordset6 = mysql_query($query_Recordset6, $conamatenlinea) or die(mysql_error());
            $row_Recordset6 = mysql_fetch_assoc($Recordset6);
            $totalRows_Recordset6 = mysql_num_rows($Recordset6);  

            if($totalRows_Recordset2 == 0 && $totalRows_Recordset6 == 0) {

                $error = "La contraseña es incorrecta.";

            } else { 

                session_start();
                $_SESSION['sesionalumno'] = $matricula;

                if ( $totalRows_Recordset6 > 0 ) {

                    $_SESSION['sesionmaestro'] = $matricula;

                
                }
 
                header("Location: index.php");
         
            }

        }

    }

}

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Conamat | Plataforma Educativa</title>
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<style>

body {
	margin: 0;
}
		
</style>

<script>

function validaenvia() {

	if (document.login.matricula.value == "") {
		alert("Por favor escribe tu matrícula.");
		document.login.matricula.focus();
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
</head>
<body>

<div id="wrapper" style="width: 100%; height: 100vh; background-image: url('../images/blurbackgroundlogin.jpg'); background-repeat: no-repeat; background-position: center; background-size: cover; float: left;">
	
	
	<div id="seccion-form" style="width: 30%; position: absolute; top: 20%; margin-top: -80px; left: 50%; margin-left: -15%; background-color: transparent; box-sizing: border-box; border: 1px solid #a9bec9; border-radius: 10px;">
		
		<div id="logo" align="center" style="width:130px; position:relative; top:20px; left:50%; margin-left:-65px; float: left;">
			<img src="../images/logoplataformaeducativa.png" style="float:left; width: 100%;" />
		</div>
		
		<div id="contenedoravatar" style="float: left; width: calc(100% - 280px); margin-left: 140px; margin-right: 140px; margin-top: 40px;">
			
			<div id="avataralumno" align="center" style="background-color: #84a8b8; width: 100%; border-radius: 100%; margin-left: auto; margin-right: auto; float: left;">
				<img src="../images/iconusuario.png" style="width: 100%; object-fit: cover; float: left;" />
			</div>
			
		</div>
		
		<div id="titulo" align="center" style="width: 100%; float:left; color:#ebf5fb; font-weight:bold; letter-spacing: 1.7px; line-height:30px; margin-top: 10px; margin-bottom: 10px; font-family: 'Montserrat', sans-serif; font-size: 14px;">INICIAR SESIÓN</div>

		<?php 

    	if ($error != "") {

		?>

    	<div id="subtitulo" align="center" style="width: 50%; float: left; margin-left: 25%; margin-right: 25%; color: #b7dceb; text-align: center; font-size: 12px; padding: 5px; font-family: 'Montserrat', sans-serif; background-color: #334b5b;"><?php echo $error; ?></div>

		<?php } ?>


    	<form id="login" name="login" action="login.php" method="post" enctype="multipart/form-data" style="width:80%; margin-left:10%; margin-right: 10%; margin-top: 20px; margin-bottom: 20px; overflow: hidden; float: left;" onSubmit="return(validaenvia())">

        	<input id="matricula" name="matricula" type="text" placeholder="Usuario" value="<?php echo $matricula; ?>" style="font-size: 15px; width: 90%; margin-top: 10px;  margin-bottom: 15px; overflow: hidden; padding: 10px 10px; border: none; background-color: #dde9ef; color: #567489; border-radius: 5px;" />

        	<input id="pass" name="password" type="password" placeholder="Contraseña" style="font-size: 15px; width: 90%; margin-bottom: 10px; overflow: hidden; padding: 10px 10px; border: none; background-color: #dde9ef; color: #567489; border-radius: 5px;" />

        	<input type="text" id="codigo" name="codigo" placeholder="Código" style="font-size: 15px; width: 45%; margin: 10px 0; margin-right: 5%; overflow: hidden; padding: 10px 10px; border: none; background-color: #dde9ef; color: #567489; border-radius: 5px; float: left;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
 
        	<div id="captchainput" style="width: 40%; height: 40px; overflow: hidden; float:left; margin-top: 10px; border-radius: 5px;">

        		<img src="../captcha1/captcha.php" width="100%" height="36" border="1" style="float:left; border-color: #8ca9b7; border-radius: 5px;" />
 			</div>

        	<div align="center" style="width: 100%; float: left;">
        		<button style="padding: 10px 40px; border: none; background-color: #4e6f86; color: white; margin-top: 30px; cursor: pointer; font-weight: 600; font-family: 'Montserrat', sans-serif; font-size: 12px; border-radius: 5px;">ENTRAR</button>
        	</div>

    	</form>

	</div>

</div><!--Fin de seccion-main-->
    
</body>
</html>
