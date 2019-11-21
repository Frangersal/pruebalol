<?php require_once('../Connections/comercenter.php');

date_default_timezone_set('America/Mexico_City');
$fecha=date("d/m/Y");
$hora=date("H:i");
$time = time();
$id = $_GET['id'];
$u = $_GET['u'];
$dispositivo = "computadora";
$direccion = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$es_movil=FALSE; //Aquí se declara la variable falso o verdadero XD
   $usuariomovil = $_SERVER['HTTP_USER_AGENT']; //Con esta leemos la info de su navegador
 
   $usuarios_moviles = "Android, AvantGo, Blackberry, Blazer, Cellphone, Danger, DoCoMo, EPOC, EudoraWeb, Handspring, HTC, Kyocera, LG, MMEF20, MMP, MOT-V, Mot, Motorola, NetFront, Newt, Nokia, Opera Mini, Palm, Palm, PalmOS, PlayStation Portable, ProxiNet, Proxinet, SHARP-TQ-GX10, Samsung, Small, Smartphone, SonyEricsson, SonyEricsson, Symbian, SymbianOS, TS21i-10, UP.Browser, UP.Link, WAP, webOS, Windows CE, hiptop, iPhone, iPod, portalmmm, Elaine/3.0, OPWV"; //En esta cadena podemos quitar o agregar navegadores de dispositivos moviles, te recomiendo que hagas un echo $_SERVER['HTTP_USER_AGENT']; en otra pagina de prueba y veas la info que arroja para que despues agregues el navegador que quieras detectar
 
   $navegador_usuario = explode(',',$usuarios_moviles);
 
   foreach($navegador_usuario AS $navegador){ //Este ciclo es el que se encarga de detectar el navegador y devolver un TRUE si encuentra la cadena
      if(eregi(trim($navegador),$usuariomovil)){
         $es_movil=TRUE;
		 $dispositivo = "celular";
      }
   }
   
   
   if(eregi(trim("iPad"),$usuariomovil)){
         $ipad="si";
		 $dispositivo = "ipad";
		 $es_movil=TRUE;
      }

if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    elseif (isset($_SERVER['HTTP_VIA'])) {  
       $ip = $_SERVER['HTTP_VIA'];  
    }  
    elseif (isset($_SERVER['REMOTE_ADDR'])) {  
       $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    else {  
       $ip = "unknown";
    }

//initialize the session
session_start();

if ($id == "logout" && $tipo != "facebook") {

 $_SESSION['MM_Username'] = NULL;
 setcookie("login", "", time()-3600);
 $_SESSION['login2'] = "desconectado";

  header("Location: /");
  exit;

}

$usuarioemail = $_SESSION['MM_Username'];
$sesion = $_SESSION['compra'];
$tipo = $_SESSION['tipo'];

if ($_SESSION['login2'] != '') {

$login = $_SESSION['login2'];

}

mysql_select_db($database_comercenter, $comercenter);
	
if ($usuarioemail != '') {

$query_Recordset1 = "SELECT * FROM clientes WHERE email = '$usuarioemail'";
$Recordset1 = mysql_query($query_Recordset1, $comercenter) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);  

$id_cliente = $row_Recordset1['id'];
$nombre = stripslashes(stripslashes($row_Recordset1['nombre']));
$estado = $row_Recordset1['estado'];
$email = $row_Recordset1['email'];

if ($estado == "2") {
  
  $_SESSION['login2'] = "Esta cuenta está suspendida";
  $_SESSION['MM_Username'] = NULL;
  setcookie("login", "", time()-3600);

  header("Location: /");
  exit;
  
  } else if ($estado == "3") {
  
   $_SESSION['login2'] = "Esta cuenta está desactivada";
   $_SESSION['MM_Username'] = NULL;
   setcookie("login", "", time()-3600);

  header("Location: /");
  exit;
  
  } else if ($estado == "4") {
  
   $_SESSION['login2'] = "Esta cuenta ha sido eliminada";
   $_SESSION['MM_Username'] = NULL;
   setcookie("login", "", time()-3600);

  header("Location: /");
  exit;
  
  }

$sexo = "o";
if ($row_Recordset1['genero'] == "f") $sexo = "a";

$query_Recordset1a = "SELECT * FROM compras WHERE idcliente = '$id_cliente' AND vendido IS NULL";
    $Recordset1a = mysql_query($query_Recordset1a, $comercenter) or die(mysql_error());
    $row_Recordset1a = mysql_fetch_assoc($Recordset1a);
    $totalRows_Recordset1a = mysql_num_rows($Recordset1a);

} else if ($sesion != '' && $usuarioemail == '') {

    $query_Recordset1a = "SELECT * FROM compras WHERE sesion = '$sesion' AND vendido IS NULL";
    $Recordset1a = mysql_query($query_Recordset1a, $comercenter) or die(mysql_error());
    $row_Recordset1a = mysql_fetch_assoc($Recordset1a);
    $totalRows_Recordset1a = mysql_num_rows($Recordset1a);

}

if ($totalRows_Recordset1a > 0) {
		
	$idcompra = $row_Recordset1a['id'];
	
	if ($usuarioemail != '') {
	
	$query_Recordset24a = "SELECT comprasproducto.id AS ids, comprasproducto.idproducto AS idproducto, comprasproducto.idcompra AS idcompra, comprasproducto.cantidad AS cantidad, productos.estado, productos.id, compras.id, compras.vendido, compras.idcliente FROM comprasproducto, productos, compras WHERE comprasproducto.idproducto = productos.id AND productos.estado = '1' AND comprasproducto.idcompra = compras.id AND compras.vendido IS NULL AND compras.idcliente = '$id_cliente' GROUP BY comprasproducto.idproducto";
    $Recordset24a = mysql_query($query_Recordset24a, $comercenter) or die(mysql_error());
    $row_Recordset24a = mysql_fetch_assoc($Recordset24a);
    $totalRows_Recordset24a = mysql_num_rows($Recordset24a);
	
	$productos = $totalRows_Recordset24a;
	
	} else if ($sesion != '') {
	
	$query_Recordset24a = "SELECT comprasproducto.id AS ids, comprasproducto.idproducto AS idproducto, comprasproducto.idcompra AS idcompra, comprasproducto.cantidad AS cantidad, productos.estado, productos.id, compras.id, compras.vendido, compras.sesion FROM comprasproducto, productos, compras WHERE comprasproducto.idproducto = productos.id AND productos.estado = '1' AND comprasproducto.idcompra = compras.id AND compras.vendido IS NULL AND compras.sesion = '$sesion' GROUP BY comprasproducto.idproducto";
    $Recordset24a = mysql_query($query_Recordset24a, $comercenter) or die(mysql_error());
    $row_Recordset24a = mysql_fetch_assoc($Recordset24a);
    $totalRows_Recordset24a = mysql_num_rows($Recordset24a);
	
	$productos = $totalRows_Recordset24a;
	
	}
	
} 

if ($u != "") {

$query_Recordset2 = "SELECT * FROM clientes WHERE link = '$u'";
$Recordset2 = mysql_query($query_Recordset2, $comercenter) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);  

$nombreperfil = stripslashes(stripslashes($row_Recordset2['nombre']));

$titulo = $nombreperfil." en Comercenter";

} else {

$query_Recordset2 = "SELECT * FROM clientes WHERE id = '$id_cliente'";
$Recordset2 = mysql_query($query_Recordset2, $comercenter) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);  

$nombreperfil = stripslashes(stripslashes($row_Recordset2['nombre']));

$titulo = "Tu perfil en Comercenter";

}

$id_perfil = $row_Recordset2['id'];
$sexo1 = "";
if ($row_Recordset2['genero'] == "f") $sexo1 = "m";
$foto = $row_Recordset2['foto'];

$query_Recordset3 = "SELECT favoritos.idcliente, favoritos.id, favoritos.tipo, favoritos.idfavorito, productos.id, productos.foto1 AS foto1, productos.foto2 AS foto2, productos.foto3 AS foto3, productos.foto4 AS foto4, productos.foto5 AS foto5, productos.nombre AS nombre, productos.link AS link, productos.linktienda AS linktienda, tiendas.estado, productos.idtienda, tiendas.id FROM favoritos, productos, tiendas WHERE favoritos.idcliente = '$id_perfil' AND favoritos.tipo = 'producto' AND productos.estado = '1' AND productos.idtienda = tiendas.id AND tiendas.estado = '1' AND favoritos.idfavorito = productos.id ORDER BY favoritos.id DESC";
$Recordset3 = mysql_query($query_Recordset3, $comercenter) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$query_Recordset4 = "SELECT favoritos.idcliente, favoritos.tipo, favoritos.idfavorito, tiendas.id, tiendas.logo AS logo, tiendas.nombre AS nombre, tiendas.link AS link FROM favoritos, tiendas WHERE favoritos.idcliente = '$id_perfil' AND favoritos.tipo = 'tienda' AND favoritos.idfavorito = tiendas.id and tiendas.estado = '1' ORDER BY favoritos.id DESC";
$Recordset4 = mysql_query($query_Recordset4, $comercenter) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

$query_Recordset5a = "SELECT * FROM compras WHERE idcliente = '$id_perfil' AND vendido = 'si' ORDER BY id DESC";
$Recordset5a = mysql_query($query_Recordset5a, $comercenter) or die(mysql_error());
$row_Recordset5a = mysql_fetch_assoc($Recordset5a);
$totalRows_Recordset5a = mysql_num_rows($Recordset5a);

$query_Recordset6 = "SELECT * FROM tiendas WHERE idcliente = '$id_perfil'";
$Recordset6 = mysql_query($query_Recordset6, $comercenter) or die(mysql_error());
$row_Recordset6 = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);

$ciudad = stripslashes(stripslashes($row_Recordset2['ciudad']));
$empleo = stripslashes(stripslashes($row_Recordset2['empleo']));

if ($id_perfil == $id_cliente) {

$password = $row_Recordset2['password'];
$email = $row_Recordset2['email'];
$emailalterno = $row_Recordset2['email2'];
$emailelegido = $row_Recordset2['emailelegido'];
$fbid = $row_Recordset2['fbid'];
$haycontrasena = "si";
if ($password == "") $haycontrasena = "no";
$cambiofoto = $row_Recordset2['cambiofoto'];
if ($cambiofoto == "") $cambiofoto = "0";

$query_Recordset7 = "SELECT * FROM direcciones WHERE idcliente = '$id_cliente' AND activa = '1'";
$Recordset7 = mysql_query($query_Recordset7, $comercenter) or die(mysql_error());
$row_Recordset7 = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7);

$query_Recordset8 = "SELECT * FROM mensajes WHERE iddestinatario = '$id_cliente' AND estadodestinatario = '1' AND leido IS NULL";
$Recordset8 = mysql_query($query_Recordset8, $comercenter) or die(mysql_error());
$row_Recordset8 = mysql_fetch_assoc($Recordset8);
$totalRows_Recordset8 = mysql_num_rows($Recordset8);

}

if ($totalRows_Recordset6 > 0) {
$estadotienda = $row_Recordset6['estado'];
$portadatienda = $row_Recordset6['portada'];
$nombretienda = $row_Recordset6['nombre'];
$logotienda = $row_Recordset6['logo'];
$linktienda = $row_Recordset6['link'];

}

mysql_query("INSERT INTO visitas(ip, fecha, seccion, url, dispositivo, usuario, idvisitado) VALUES('$ip', '$time', 'perfil', '$direccion', '$dispositivo', '$id_cliente', '$id_perfil')");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="HandheldFriendly" content="true">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
<meta charset="UTF-8">
<?php if($es_movil!=TRUE){ ?>
<link rel="stylesheet" type="text/css" href="../css/main.css" />
<?php } ?>
<title><?php echo $titulo; ?></title>
<link rel="shortcut icon" type="image/x-icon" href="../images/ico.ico" />
<meta name="keywords" content="tienda, productos, comercio, ofertas, ecommerce, compras, centro comercial, mexico" />
<meta name="description" content="El primer centro comercial del mundo, compra, renta un local y empieza a vender" />
<link rel="image_src" href="https://comercenter.com.mx/images/logoim.jpg" />
<meta name="image" content="https://comercenter.com.mx/images/logoim.png" />
<meta property="og:image" content="https://comercenter.com.mx/images/logoim.jpg" />
<link rel="icon" type="image/jpeg" sizes="234x234" href="https://comercenter.com.mx/images/logoim.jpg">
<link rel="icon" type="image/png" sizes="16x16" href="https://comercenter.com.mx/images/logoim16.png">
<link rel="icon" type="image/png" sizes="32x32" href="https://comercenter.com.mx/images/logoim32.png">
<link rel="icon" type="image/jpeg" sizes="96x96" href="https://comercenter.com.mx/images/logoim96.jpg">
<meta property="og:url"           content="https://comercenter.com.mx" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="Comercenter" />
<meta property="og:description"   content="Centro comercial en línea. Compra, crea tu tienda y vende directamente a tus clientes." />
<meta property="fb:app_id"  content="1465679836802181" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META NAME="Creator" CONTENT="Eduardo Murueta">
<META NAME="Robots" CONTENT="all,index,follow">
<META NAME="distribution" CONTENT="global">
<meta name="copyright" content="Eduardo Murueta" />
<?php if ($estado == "2") { ?>
<script language="javascript" type="text/javascript">
alert('Tu cuenta está suspendida');
</script>
<?php

if ($_SESSION['MM_Username'] != '') {

$_SESSION['MM_Username'] = NULL;
 setcookie("login", "", time()-3600);
 $_SESSION['login2'] = "desconectado";
 
}
 
 ?>
 <script>
window.location.href = "/";
</script>
<?php } ?>
<?php if ($estado == "3") { ?>
<script language="javascript" type="text/javascript">
alert('Tu cuenta está desactivada, actívala desde "¿Olvidaste contraseña?"');
</script>
<?php

if ($_SESSION['MM_Username'] != '') {

$_SESSION['MM_Username'] = NULL;
 setcookie("login", "", time()-3600);
 $_SESSION['login2'] = "desconectado";
 
}

?>
<script>
window.location.href = "/";
</script>
<?php } ?>
<?php if ($login == 'desactivada') { ?>
<script language="javascript" type="text/javascript">
alert('Tu cuenta ha sido desactivada, para recuperarla ve a recuperar cuenta o contraseña');
</script>
<?php } else if ($login == "suspendida") { ?>
<script language="javascript" type="text/javascript">
alert('Tu cuenta ha sido suspendida');
window.location.href="http://www.google.com";
</script>
<?php } else if ($login == 'fberror') { ?>
<script language="javascript" type="text/javascript">
alert('Hubo un error en tu registro, por favor inténtalo de nuevo más tarde');
</script>
<?php } else if ($login == "activado") { ?>
<script language="javascript" type="text/javascript">
alert('Tu cuenta ha sido activada');
</script>
<?php } else if ($login == "activada") { ?>
<script language="javascript" type="text/javascript">
alert('Tu cuenta ha sido re-activada');
</script>
<?php } else if ($login == "erroractivacion") { ?>
<script language="javascript" type="text/javascript">
alert('Esta cuenta no existe, fue suspendida o ya está activada');
</script>
<?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
<script>

function valida_envia() {

if (document.buscador.buscar.value == '') {
    alert("Por favor escribe algo para buscar");
	 document.buscador.buscar.focus()
	 return false;  
}

}

</script>
<script type="text/javascript">
    function checkFile() {
     var fileName = document.getElementById('foto1').value;
	 var cambio = document.getElementById('cambiofoto').value;
     var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
	 if (fileNameExt != "jpg" && fileNameExt == "JPG" && fileNameExt == "jpeg" && fileNameExt == "JPEG"){ 
	 alert("Sólo se aceptan archivos jpg");
	 document.getElementById('foto1').value='';
     return false;
	 } else {
	
	event.preventDefault();
	var proceed = true;
	$("#oscuro").show();
	$("#loading14").show();
	
	var form_data = new FormData();
    form_data.append('foto1', $('#foto1')[0].files[0]);
	form_data.append('idcliente', $('#idcliente').val());
	
	$.ajax({
	url : "agregarimagen.php",
	type: "POST",
	data : form_data,
	contentType: false,
	cache: false,
	dataType: 'json',
	processData:false,
	mimeType:"multipart/form-data"
}).done(function(res){ //

if (res.mensaje1 == "completo") {

document.getElementById('cambiofoto').value = res.mensaje4;
$("#oscuro").hide();
$("#loading14").hide();
$('#foto').css("background-image", "url('../images/usuarios/"+res.mensaje2+"')");

} else {

alert(res.mensaje2);
$("#oscuro").hide();
$("#loading14").hide();

}
		
});
	
	 }
    }
</script>
<script>

function cambiarnombre() {

var error = "";

if (document.form1.nuevonombre.value == '') {
    alert("Por favor escribe el nuevo nombre");
	 document.form1.nuevonombre.focus();
	 error = "si";
	 return false;  
}

if (error == "") {

$("#pantalla").show();

var form_data = new FormData();
form_data.append('idcliente', $('#idcliente').val());
form_data.append('nuevonombre', $('#nuevonombre').val());
form_data.append('nombreoriginal', $('#nombreoriginal').val());

$.ajax({
	url : "cambiarnombre.php",
	type: "POST",
	data : form_data,
	contentType: false,
	cache: false,
	dataType: 'json',
	processData:false,
	mimeType:"multipart/form-data"
}).done(function(res) { //

if (res.mensaje1 == "completo") {

window.location.href = "/perfil";

} else {

alert(res.mensaje2);
$("#pantalla").hide();

}
		
});

}

}

</script>
<script>

function cambiarcontrasena() {

var error = "";
re = /^\w+$/;

<?php if ($password != '') { ?>
if (document.form1.passwordactual.value == '') {
    alert("Por favor escribe la contraseña actual");
	 document.form1.passwordactual.focus();
	 error = "si";
	 return false;  
}
if (document.form1.passwordactual.value.length < 6) {
        alert("Error: La contraseña tiene más de 5 caracteres");
       document.form1.passwordactual.focus();
        return false;
      }
if(!re.test(document.form1.passwordactual.value)) {
      alert("Error: La contraseña sólo contiene letras y números");
      document.form1.passwordactual.focus();
      return false;
    }
<?php } ?>

if (document.form1.passwordnuevo.value == '') {
    alert("Por favor escribe la nueva contraseña");
	 document.form1.passwordnuevo.focus();
	 error = "si";
	 return false;  
}

if (document.form1.passwordnuevo.value.length < 6) {
        alert("Error: La contraseña debe contener más de 5 caracteres");
       document.form1.passwordnuevo.focus();
        return false;
      }

    if(!re.test(document.form1.passwordnuevo.value)) {
      alert("Error: La contraseña sólo debe contener letras y números");
      document.form1.passwordnuevo.focus();
      return false;
    }

if (document.form1.repasswordnuevo.value == '') {
    alert("Por favor re-escribe la nueva contraseña");
	 document.form1.repasswordnuevo.focus();
	 error = "si";
	 return false;  
}

if (document.form1.repasswordnuevo.value.length < 6) {
        alert("Error: La contraseña debe contener más de 5 caracteres");
       document.form1.repasswordnuevo.focus();
        return false;
      }

    if(!re.test(document.form1.repasswordnuevo.value)) {
      alert("Error: La contraseña sólo debe contener letras y números");
      document.form1.repasswordnuevo.focus();
      return false;
    }

if (document.form1.passwordnuevo.value != document.form1.repasswordnuevo.value) {
    alert("Las contraseñas nuevas no coinciden");
	 document.form1.passwordnuevofocus();
	 error = "si";
	 return false;  
}

if (error == "") {

$("#pantalla").show();

var form_data = new FormData();
form_data.append('idcliente', $('#idcliente').val());
form_data.append('haycontrasena', '<?php echo $haycontrasena; ?>');
<?php if ($password != '') { ?>
form_data.append('password', $('#passwordactual').val());
<?php } ?>
form_data.append('passwordnuevo', $('#passwordnuevo').val());

$.ajax({
	url : "cambiarcontrasena.php",
	type: "POST",
	data : form_data,
	contentType: false,
	cache: false,
	dataType: 'json',
	processData:false,
	mimeType:"multipart/form-data"
}).done(function(res) { //

if (res.mensaje1 == "completo") {

document.getElementById("form1").reset();
$("#pantalla").hide();
alert("Contraseña cambiada");
window.location.href = "/perfil";

} else {

alert(res.mensaje2);
$("#pantalla").hide();

}
		
});

}

}

</script>
<script>

function cambiar(id) {

if (id == "email") {

var valor = $('#'+id).val();

if (valor == "") {
alert("Por favor escribe el email");
$('#email').focus();
return false;
}
    var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
    if (!filter.test(valor)) {
	alert("Ese no es un email");     
    document.form1.email.focus() 
	return false;
  }

}

if (id == "ciudad") {

var valor = $('#'+id).val();

if (valor == "") {
alert("Por favor escribe el nombre de la ciudad");
$('#ciudad').focus();
return false;
}

}

if (id == "empleo") {

var valor = $('#'+id).val();

if (valor == "") {
alert("Por favor escribe el empleo");
$('#empleo').focus();
return false;
}

}

$("#pantalla").show();

var doStuff = function () {
var form_data = new FormData();
form_data.append('idcliente', $('#idcliente').val());
form_data.append('id', id);
form_data.append(id, $('#'+id).val());

$.ajax({
	url : "cambiar.php",
	type: "POST",
	data : form_data,
	contentType: false,
	cache: false,
	dataType: 'json',
	processData:false,
	mimeType:"multipart/form-data"
}).done(function(res) { //

if (res.mensaje1 == "completo") {

if (res.mensaje2 == "sesion") {
alert("Cambio agregado, por favor inicia sesión nuevamente");
window.location.href = "/index.php?id=logout";
} else {

$("#pantalla").hide();
alert("Cambio agregado");
window.location.href = "/perfil";
}

} else {

alert(res.mensaje2);
$("#pantalla").hide();

}
		
});

};

setTimeout(doStuff, 2000);

}

</script>
<script>

function cambiaremail() {

var valor = $('#emailnuevo1').val();
var ealterno = "<?php echo $emailalterno; ?>";
var pre = "";

if ($('#predeterminado').is(":checked")) {
 pre = "si"; 
}

if (ealterno == "") {
if (valor == "") {
alert("Por favor escribe el email");
$('#emailnuevo1').focus();
return false;
}

var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
    if (!filter.test(valor)) {
	alert("Ese no es un email");     
    document.form1.emailnuevo1.focus() 
	return false;
  }

}

$("#pantalla").show();

var doStuff2 = function () {
var form_data = new FormData();
form_data.append('idcliente', $('#idcliente').val());
form_data.append('email', $('#emailnuevo1').val());
form_data.append('predeterminado', pre);

$.ajax({
	url : "cambiaremail.php",
	type: "POST",
	data : form_data,
	contentType: false,
	cache: false,
	dataType: 'json',
	processData:false,
	mimeType:"multipart/form-data"
}).done(function(res) { //

if (res.mensaje1 == "completo") {

alert("Cambio agregado");
window.location.href = "/perfil";

} else {

alert(res.mensaje2);
$("#pantalla").hide();

}
		
});

};

setTimeout(doStuff2, 2000);

}

</script>
<script>
function eliminarcuenta() {

var id = $('#idcliente').val();

if (confirm("¿Estás seguro de eliminar tu cuenta?")==1){

$("#pantalla").show();

var doStuff3 = function () {
var form_data = new FormData();
form_data.append('idcliente', $('#idcliente').val());

$.ajax({
	url : "eliminarcuenta.php",
	type: "POST",
	data : form_data,
	contentType: false,
	cache: false,
	dataType: 'json',
	processData:false,
	mimeType:"multipart/form-data"
}).done(function(res) { //

if (res.mensaje1 == "completo") {

alert("Cuenta eliminada");
window.location.href = "/index.php?id=logout";

} else {

alert(res.mensaje2);
$("#pantalla").hide();

}
		
});

};

setTimeout(doStuff3, 2000);

}

}
</script>
<script>

function agregardi() {

var error = "";

if (document.form1.direccionnombre.value == '') {
    alert("Por favor escribe el nombre de a quién va dirigido el pedido");
	 document.form1.direccionnombre.focus();
	 error = "si";
	 return false;  
}

if (document.form1.direccionemail.value == '') {
    alert("Por favor escribe el email para recibir los detalles del pedido");
	 document.form1.direccionnombre.focus();
	 error = "si";
	 return false;  
}

var str=document.form1.direccionemail.value;
    var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
    if (!filter.test(str)) {
	alert("Este no es un email válido");
document.form1.direccionemail.focus();
return false;
}

if (document.form1.calle.value == '') {
    alert("Por favor escribe el nombre de la calle");
	 document.form1.calle.focus();
	 error = "si";
	 return false;  
}

if (document.form1.numero.value == '') {
    alert("Por favor escribe el número");
	 document.form1.numero.focus();
	 error = "si";
	 return false;  
}

if (document.form1.colonia.value == '') {
    alert("Por favor escribe el nombre de la colonia");
	 document.form1.colonia.focus();
	 error = "si";
	 return false;  
}

if (document.form1.cp.value == '') {
    alert("Por favor escribe el código postal");
	 document.form1.cp.focus();
	 error = "si";
	 return false;  
}

if (document.form1.direccionciudad.value == '') {
    alert("Por favor escribe el nombre de la ciudad");
	 document.form1.direccionciudad.focus();
	 error = "si";
	 return false;  
}

if (error == "") {

$("#pantalla").show();

var doStuff4 = function () {
var form_data = new FormData();
form_data.append('idcliente', $('#idcliente').val());
form_data.append('nombre', $('#direccionnombre').val());
form_data.append('email', $('#direccionemail').val());
form_data.append('calle', $('#calle').val());
form_data.append('numero', $('#numero').val());
form_data.append('interior', $('#interior').val());
form_data.append('colonia', $('#colonia').val());
form_data.append('cp', $('#cp').val());
form_data.append('ciudad', $('#direccionciudad').val());
form_data.append('estado', $('#direccionestado').val());
form_data.append('iddireccion', $('#iddireccion').val());

$.ajax({
	url : "direccion.php",
	type: "POST",
	data : form_data,
	contentType: false,
	cache: false,
	dataType: 'json',
	processData:false,
	mimeType:"multipart/form-data"
}).done(function(res) { //

if (res.mensaje1 == "completo") {

if (res.mensaje2 == "agregada") {
$("#pantalla").hide();
alert("Dirección agregada");
window.location.href = "/perfil";
} else {
$("#pantalla").hide();
alert("Dirección modificada");
window.location.href = "/perfil";
}

} else {

alert(res.mensaje2);
$("#pantalla").hide();

}
		
});

};

setTimeout(doStuff4, 2000);

}

}

</script>
<script>

function modificardireccion(id) {

$("#pantalla").show();

var bot = $('.botonagregar').val();

var doStuff5 = function() {

var form_data = new FormData();
form_data.append('idcliente', $('#idcliente').val());
form_data.append('id', id);

$.ajax({
	url : "modificardireccion.php",
	type: "POST",
	data : form_data,
	contentType: false,
	cache: false,
	dataType: 'json',
	processData:false,
	mimeType:"multipart/form-data"
}).done(function(res) { //

if (res.mensaje1 == "completo") {
$('#direccionnombre').val(res.nombre);
$('#direccionemail').val(res.email);
$('#calle').val(res.calle);
$('#numero').val(res.numero);
$('#interior').val(res.interior);
$('#colonia').val(res.colonia);
$('#cp').val(res.cp);
$('#direccionciudad').val(res.ciudad);
$('#direccionestado').val(res.estado);
$('#iddireccion').val(id);
$('.botonagregar').val("Cerrar");
$("#agregardireccion").show();
$("#pantalla").hide();

} else {

alert(res.mensaje2);
$("#pantalla").hide();

}

var height = $("#form1").height();
contenedor(height);
		
});

};

setTimeout(doStuff5, 2000);

}

</script>
<script>

function eliminardireccion(id) {

if (confirm("¿Estás seguro de eliminar esta dirección?")==1) {

window.location.href = "eliminardireccion.php?id="+id;

}
}

</script>
<script>

function enviarmensaje() {

var error = "";

if ($('#asunto').val() == '') {
    alert("Por favor escribe el asunto del mensaje");
	 $('#asunto').focus();
	 error = "si";
	 return false;  
}

if ($('#cuerpomensaje').val() == '') {
    alert("Por favor escribe algo en el mensaje");
	 $('#cuerpomensaje').focus();
	 error = "si";
	 return false;  
}

if (error == "") {

$("#pantalla").show();

var doStuff7 = function () {
var form_data = new FormData();
form_data.append('idcliente', $('#idcliente').val());
form_data.append('idperfil', $('#idperfil').val());
form_data.append('tema', $('#asunto').val());
form_data.append('mensaje', $('#cuerpomensaje').val());

$.ajax({
	url : "mensaje.php",
	type: "POST",
	data : form_data,
	contentType: false,
	cache: false,
	dataType: 'json',
	processData:false,
	mimeType:"multipart/form-data"
}).done(function(res) { //

if (res.mensaje1 == "completo") {

$("#pantalla").hide();
alert("Mensaje enviado");
window.location.reload();

} else {

alert(res.mensaje2);
$("#pantalla").hide();

}
		
});

};

setTimeout(doStuff7, 2000);

}

}

</script>
<script>

function enviarmensaje1() {

var error = "";

if ($('#asunto').val() == '') {
    alert("Por favor escribe el asunto del mensaje");
	 $('#asunto').focus();
	 error = "si";
	 return false;  
}

if ($('#cuerpomensaje').text() == '') {
    alert("Por favor escribe algo en el mensaje");
	 $('#cuerpomensaje').focus();
	 error = "si";
	 return false;  
}

if (error == "") {

$("#pantalla").show();

var doStuff9 = function () {

var set = $('#cuerpomensaje').html();

var form_data = new FormData();
form_data.append('idcliente', $('#idcliente').val());
form_data.append('idperfil', $('#idperfil').val());
form_data.append('tema', $('#asunto').val());
form_data.append('mensaje', $('#cuerpomensaje').html());

$.ajax({
	url : "mensaje.php",
	type: "POST",
	data : form_data,
	contentType: false,
	cache: false,
	dataType: 'json',
	processData:false,
	mimeType:"multipart/form-data"
}).done(function(res) { //

if (res.mensaje1 == "completo") {

$("#pantalla").hide();
alert("Mensaje enviado");
window.location.reload();

} else {

alert(res.mensaje2);
$("#pantalla").hide();

}
		
});

};

setTimeout(doStuff9, 2000);

}

}

</script>
<script>
function detectar() {

    if ($('.marcado:checked').length > 0) {
       //do something
    $("#lik3a").show();
	
	} else {
	
	$("#lik3a").hide();
	
	}

}

</script>
<script>

function eliminarbox() {

var doStuff10 = function () {

var seccion = $('#seccion').val();
	
var elim = [];

$("input[name='marcado']:checked").each(function(){
            elim.push(this.value);
        });

var dataString = 'elim='+ elim; 

$.ajax({
	url : "eliminarmensaje.php",
	type: "POST",
	data : dataString,
	cache: false,
    success: function(res) { //

if (res == "completo") {

if (seccion == "enviados") {
enviados();
$("#pantalla").hide();
} else if (seccion == "mensajes") {
inbox();
$("#pantalla").hide();
}


} else {

alert(res);
$("#pantalla").hide();

}

}
		
});

};

if(confirm("Estás seguro de eliminar esto")==1) {
	
$("#pantalla").show();
setTimeout(doStuff10, 2000);

}

}

</script>
<script>
function eliminarmensaje(id) {

var doStuff11 = function() {

var seccion = $('#seccion').val();
var tipo = $('#tipousuario').val();
var archivo = "";

if (tipo == "remitente") {
archivo = "1";
}

$.post("eliminarmensaje"+archivo+".php", {elim: "" + id + ""}, function(data){
    if(data == "completo") {
	
if (seccion == "enviados") {
enviados();
$("#pantalla").hide();
} else if (seccion == "mensajes") {
inbox();
$("#pantalla").hide();
}

    } else {
    alert(data);
    $("#pantalla").hide();
    }
  });

}

if(confirm("Estás seguro de eliminar esto")==1) {
	
$("#pantalla").show();
setTimeout(doStuff11, 2000);

}

}
</script>
<script>

function enviarreporte() {

var error = "";

if ($('#cuerpomensaje1').val() == '') {
    alert("Por favor escribe algo en el reporte");
	 $('#cuerpomensaje1').focus();
	 error = "si";
	 return false;  
}

if (error == "") {

$("#pantalla").show();

var doStuff13 = function () {

var form_data = new FormData();
form_data.append('idcliente', $('#idcliente').val());
form_data.append('idperfil', $('#idperfil').val());
form_data.append('tipo', 'cliente');
form_data.append('reporte', $('#cuerpomensaje1').val());

$.ajax({
	url : "reporte.php",
	type: "POST",
	data : form_data,
	contentType: false,
	cache: false,
	dataType: 'json',
	processData:false,
	mimeType:"multipart/form-data"
}).done(function(res) { //

if (res.mensaje1 == "completo") {

$("#pantalla").hide();
alert("Reporte enviado. En la sección de reportes de tu perfil te haremos llegar nuestra respuesta");
window.location.reload();

} else {

alert(res.mensaje2);
$("#pantalla").hide();

}
		
});

};

setTimeout(doStuff13, 2000);

}

}

</script>
 <script>
 $(document).ready(function() {
 
		$("#agregardireccion").hide();
 
});
 </script>
 <script type="text/javascript">
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	alert("Sólo se aceptan números");
        return false;
	} else { 
    return true; }
}
</script>
<?php if($es_movil!=TRUE){ ?>
<script>
$(document).ready(function(){ 

var alto = $(window).height();
var ancho = $(window).width();

$('#pantalla').height(alto);
$('#pantalla').width(ancho);

});

</script>
<script>
function inicio() {

<?php if ($id_perfil == $id_cliente) { ?>
$(".2linka").show();
$("#2link").hide();
$("#form1").hide();
document.getElementById("form1").reset();
$("#agregardireccion").hide();
$('#inboxwrapp').load("mensajes.php");
<?php } ?>
$("#1link").show();
$(".1linka").hide();
$("#3link").hide();
$(".3linka").show();
$("#4link").hide();
$(".4linka").show();
$("#favoritas").show();
$("#mensajes").hide();
$("#reportes").hide();
var height = $("#favoritas").height();
contenedor(height);

}
</script>
<script>
function editar() {

$("#1link").hide();
$(".1linka").show();
$(".2linka").hide();
$("#2link").show();
$("#3link").hide();
$(".3linka").show();
$("#4link").hide();
$(".4linka").show();
$("#favoritas").hide();
$("#form1").show();
var height = $("#form1").height();
$('#inboxwrapp').load("mensajes.php");
$("#mensajes").hide();
$("#reportes").hide();
contenedor(height);

}
</script>
<script>
function mensajes() {
<?php if ($id_perfil == $id_cliente) { ?>
$("#inboxwrapp").load("mensajes.php");
$("#2link").hide();
$(".2linka").show();
document.getElementById("form1").reset();
$("#agregardireccion").hide();
$("#form1").hide();
<?php } ?>
$("#1link").hide();
$(".1linka").show();
$("#3link").show();
$(".3linka").hide();
$("#4link").hide();
$(".4linka").show();
$("#favoritas").hide();
$("#mensajes").show();
$("#reportes").hide();
var height = $("#mensajes").height();
contenedor(height);

}
</script>
<script>
function reportes() {

<?php if ($id_perfil == $id_cliente) { ?>
$("#reporteswrapp").load("reportes.php");
document.getElementById("form1").reset();
$("#agregardireccion").hide();
$("#form1").hide();
$("#2link").hide();
$(".2linka").show();
$('#inboxwrapp').load("mensajes.php");
<?php } ?>
$("#1link").hide();
$(".1linka").show();
$("#3link").hide();
$(".3linka").show();
$("#4link").show();
$(".4linka").hide();
$("#favoritas").hide();
$("#mensajes").hide();
$("#reportes").show();
var height = $("#reportes").height();
contenedor(height);

}
</script>
<script>

function mensaje(id,seccion) {

$('#inboxwrapp').load("mensaje1.php?id="+id+"&s="+seccion, function() {
  var height = $("#mensajes").height();
  contenedor(height);
});
$("#lik1a").show();
$("#lik1").hide();
$("#lik2a").show();
$("#lik2").hide();
$("#lik3a").hide();

}

</script>
<script>
function direccion(esto) {
	var bot = esto.value;
    $("#agregardireccion").toggle();
	if (bot == "Agregar") {
	
	esto.value = "Cerrar";
	} else {
	esto.value = "Agregar";
	document.getElementById("form1").reset();
	}
	var height = $("#form1").height();
    contenedor(height);
	}
</script>
<script>

function enviados() {

$('#inboxwrapp').load("enviados.php", function() {
  var height = $("#mensajes").height();
  contenedor(height);
});
$("#lik1").hide();
$("#lik1a").show();
$("#lik2").show();
$("#lik2a").hide();
$("#lik3a").hide();

}

</script>
<script>

function inbox() {

$('#inboxwrapp').load("mensajes.php", function() {
  var height = $("#mensajes").height();
  contenedor(height);
});
$("#lik1a").hide();
$("#lik1").show();
$("#lik2a").show();
$("#lik2").hide();
$("#lik3a").hide();

}

</script>
<script>
$(document).ready(function(){ 

setTimeout(doStuff133, 2000);

});

function doStuff133() {
var leftcontent = $("#leftcontent").height();
var rightcontent = $("#rightcontent").height();

$("#alturaleft").val(leftcontent);

if (leftcontent >= rightcontent) {

$("#rightcontent").height(leftcontent);

} else {

$("#leftcontent").height(rightcontent);

}

};

</script>
<script>

function responder(id) {

$("#pantalla").show();

var doStuff8 = function () {
var form_data = new FormData();
form_data.append('id', id);

$.ajax({
	url : "mensaje2.php",
	type: "POST",
	data : form_data,
	contentType: false,
	cache: false,
	dataType: 'json',
	processData:false,
	mimeType:"multipart/form-data"
}).done(function(res) { //

if (res.mensaje1 == "completo") {

$('#idperfil').val(res.idperfil)
$("#inboxwrapp").html('<div id="titulo11" align="left" style="width:69%; margin-left:15%; height:30px; line-height:30px; font-size:14px; font-weight:bold; color:#333; margin-top:30px;">Respondiendo a '+res.respondiendo+'</div><input type="text" id="asunto" name="asunto" style="width:69%; margin-left:15%; border:#777 solid 1px; padding-left:1%; float:left; height:30px; line-height:30px; margin-top:10px;" placeholder="Asunto" value="'+res.asunto+'" /><div contenteditable="true" align="left" id="cuerpomensaje1" name="cuerpomensaje1" style="width:68%; padding:1%; float:left; margin-left:15%; margin-top:5px; height:300px; overflow-y:scroll; overfow-x:hidden; background-color:#fff; border:solid 1px #777;"><div contenteditable="true" align="left" id="cuerpomensaje" name="cuerpomensaje" style="width:100%;"><p>'+res.cuerpo+'</p></div></div><div id="nombre" align="center" style="width:100%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:30px;"><div id="centrar" align="center" style="width:160px; margin-left:auto; margin-right:auto;"><input type="button" id="enviar2" name="enviar2" value="Enviar" onclick="javascript:enviarmensaje1();" style="width:150px;" /></div></div>');
$('#cuerpomensaje1').focus();
$("#pantalla").hide();

} else {

alert(res.mensaje2);
$("#pantalla").hide();

}
		
});

};

setTimeout(doStuff8, 2000);

}

</script>
<script>

function contenedor(altura) {

var leftcontent = $("#leftcontent").height();
var rightcontent = $("#rightcontent").height();
if (altura === void(0)) {
altura = 0;
}

altura = Number(altura);

var alturaleft = $("#alturaleft").val();
alturaleft = Number(alturaleft);

if (altura > alturaleft) {

$("#leftcontent").height(altura);
$("#rightcontent").height(altura);

} else {

$("#leftcontent").height(alturaleft);
$("#rightcontent").height(alturaleft);

}

}

</script>
<style type="text/css">
<!--
body {
	font-family:Helvetica, Arial, sans-serif;

}
a:link {
	color: #7FA0E7;
	text-decoration: none;
}
a:visited {
	color: #7FA0E7;
	text-decoration: none;
}
a:hover {
	color: #7FA0E7;
	text-decoration: underline;
}
a:active {
	color: #7FA0E7;
	text-decoration: none;
}
#menu a:link {
	display:block;
	color:#fff;
	text-decoration:none;
	padding-left:50px; padding-right:50px;
}
#menu a:active {
	display:block;
	color:#fff;
	text-decoration:none;
	padding-left:50px; padding-right:50px;
}
#menu a:visited {
	display:block;
	color:#fff;
	text-decoration:none;
	padding-left:50px; padding-right:50px;
}
#menu a:hover {
    color:#fff;
	text-decoration:none;
	display:block;
	background-color:#1D2654;
	padding-left:50px; padding-right:50px;
}

#titulo3 a:link {
	color:#000;
	text-decoration:none;
	font-weight:300;
}
#titulo3 a:active {
	color:#000;
	text-decoration:none;
	font-weight:300;
}
#titulo3 a:visited {
	text-decoration: none;
	color: #000;
	font-weight:300;
}
#titulo3 a:hover {
	text-decoration:underline;
	font-weight:300;
}
#link1 a:link {
	background-image:url(../images/tienda.png?id=<?php echo $time; ?>);
	background-position:-4px -55px;
	background-repeat:no-repeat;
	font-weight:100;
}
#link1 a:active {
	background-position:-4px -55px;
}
#link1 a:visited {
	background-position:-4px -55px;
}
#link1 a:hover {
	font-weight:bold;
	background-position:-4px 0px;
	border:none;
}
#link2 a:link {
	background-image:url(../images/silueta40<?php if ($sexo == "m") echo "m"; ?>.png?id=<?php echo $time; ?>);
	background-position:0px 0px;
	background-repeat:no-repeat;
	font-weight:100;
}
#link2 a:active {
	background-position:0px 0px;
}
#link2 a:visited {
	background-position:0px 0px;
}
#link2 a:hover {
	background-position:0px -55px;
	border:none;
	font-weight:bold;
}
#link3 a:link {
	background-image:url(../images/desconectar.png?id=<?php echo $time; ?>);
	background-position:0px 0px;
	background-repeat:no-repeat;
	font-weight:100;
}
#link3 a:active {
	background-position:0px 0px;
}
#link3 a:visited {
	background-position:0px 0px;
}
#link3 a:hover {
	background-position:0px -55px;
	border:none;
	font-weight:bold;
}
#link4 a:link {
	background-image:url(../images/carrito.png?id=<?php echo $time; ?>);
	background-position:0px 0px;
	font-weight:100;
}
#link4 a:active {
	background-position:0px 0px;
}
#link4 a:visited {
	background-position:0px 0px;
}
#link4 a:hover {
	background-position:0px -55px;
	border:none;
	font-weight:bold;
}
#link5 a:link {
	background-image:url(../images/vender.png?id=<?php echo $time; ?>);
	background-position:0px 0px;
	font-weight:100;
}
#link5 a:active {
	background-position:0px 0px;
}
#link5 a:visited {
	background-position:0px 0px;
}
#link5 a:hover {
	background-position:0px -55px;
	border:none;
	font-weight:bold;
}
.link a:link, .link a:active, .link a:visited, .link a:hover {
	color:#000;
	font-size:11px;
	height:55px;
	background-repeat:no-repeat;
	border:none;
	display:block;
	font-weight:bold;
}
@media screen and (min-width: 1085px) {
#rightcontent {

width: 68%;

}

#left {

width:25%;

}

}
@media screen and (max-width: 1084px) {

#rightcontent {

width: 53%;

}

#left {

width:40%;

}
}
@media screen and (max-width: 964px) {
#logo {
	width:278px;
	height:70px;
	margin-left:auto;
	margin-right:auto;
	margin-top:5px;
	background-image:url(../images/logohorizontal.png);
	background-size: 278px;
}
.headerinside {

float:left; 
width:100%; 
height:140px;	

}

.headerinside2 {

float:left; 
width:100%; 
height:80px;
position:relative;	

}

#buscador {
width:80%; 
height:50px; 
float:left;  
margin-top:13px;
margin-left:10%; 
overflow:hidden;
text-align:center;

}

#buscadortext {
float:left; 
width:80%;  
height:60px; 
margin-top:5px;
margin-left:5%;

}

#menu {

display: none;

}
#menuinside {

display: table; margin: 0 auto;

}
#menuusuario {

width:100%;
margin-right:0%;

}
}
.zoom {

transition: all .3s ease;

}
.zoom:hover {
    transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
@media screen and (min-width: 940px) {
#mail {

width:860px; 

}
#contacto2 {

margin-left:20px;

}
#contacto3 {

margin-left:20px;

}
.inputname {

width:49%; 

}
#inputname2 {

 margin-left:2%;
 margin-top:0px;

}
#ventana {
	width:300px;
	height:150px;
	top:50%;
	left:50%;
	margin-top:-95px;
	margin-left:-170px;
	font-size:18px;
}
#comentarios {

margin-left:-2px;

}
#inputenviar {
margin-top:10px;
margin-left:14px;
}
}
@media screen and (max-width: 939px) {

#mail {

width:540px; 

}

#contacto2 {

margin-left:20px;

}

.inputname {

width:49%; 

}

#inputname2 {

 margin-left:2%;
 margin-top:0px;

}
#ventana {
	width:250px;
	height:120px;
	top:50%;
	left:50%;
	margin-top:-80px;
	margin-left:-145px;
	font-size:16px;
}
#comentarios {

margin-left:-2px;

}
#inputenviar {
margin-top:0px;
margin-left:10px;
}
}
@media screen and (max-width: 612px) {

#mail {

width:220px; 

}

#contacto2 {

margin-left:0px;

}

.inputname {

width:100%; 

}

#inputname2 {

 margin-left:0px;
 margin-top:20px;

}
#ventana {
	width:150px;
	height:120px;
	top:50%;
	left:50%;
	margin-top:-80px;
	margin-left:-95px;
	font-size:16px;
}
#comentarios {

margin-left:4px;

}
#enviar {

margin-left:4px;

}
#inputenviar {
margin-top:0px;
margin-left:0px;
}
}
#cam a:link {

background-image:url(../images/cam.png?id=<?php echo $time; ?>);
background-position: 0px 0px;
background-size:30px 60px;
display:block;
height:30px;

}
#cam a:hover {

background-position: 0px 30px;

}
#enviar {
transition: all .3s ease; width:100%; text-align:center; height:35px; line-height:28px; font-size:16px; color:#fff; float:left; border:solid 2px #Fff; background-color:transparent; border-radius:3px; -webkit-appearance: none;
}
#enviar:hover {
    transition: all .3s ease;
	background-color:#FFF;
	color:#333;
	cursor:pointer;
	border-radius:3px;
	border:solid 2px #FFF;
}
#enviar:active {
    transition: all .3s ease;
	background-color:#FFFF;
	color:#333;
	cursor:pointer;
	border-radius:3px;
	border:solid 2px #FFF;
}
#enviar1 {
transition: all .3s ease; width:100%; text-align:center; height:35px; line-height:28px; font-size:16px; color:#fff; float:left; border:solid 2px #Fff; background-color:transparent; border-radius:3px; -webkit-appearance: none;
}
#enviar1:hover {
    transition: all .3s ease;
	background-color:#FFF;
	color:#333;
	cursor:pointer;
	border-radius:3px;
	border:solid 2px #FFF;
}
#enviar1:active {
    transition: all .3s ease;
	background-color:#FFFF;
	color:#333;
	cursor:pointer;
	border-radius:3px;
	border:solid 2px #FFF;
}
#enviar2 {
transition: all .3s ease;
width:130px; text-align:center; height:30px; line-height:24px; font-size:16px; color:#FB9500; float:left; border:solid 2px #FB9500; background-color:transparent; border-radius:3px; -webkit-appearance: none;
}
#enviar2:hover {
    transition: all .3s ease;
	background-color:#FB9500;
	color:#fff;
	cursor:pointer;
	border-radius:3px;
	border:solid 2px #FB9500;
}
#enviar2:active {
    transition: all .3s ease;
	background-color:#FB9500;
	color:#fff;
	cursor:pointer;
	border-radius:3px;
	border:solid 2px #FB9500;
}
#enviar3 {
transition: all .3s ease; width:100%; text-align:center; height:35px; line-height:28px; font-size:16px; color:#fff; float:left; border:solid 2px #Fff; background-color:transparent; border-radius:3px; -webkit-appearance: none;
}
#enviar3:hover {
    transition: all .3s ease;
	background-color:#FFF;
	color:#333;
	cursor:pointer;
	border-radius:3px;
	border:solid 2px #FFF;
}
#enviar3:active {
    transition: all .3s ease;
	background-color:#FFFF;
	color:#333;
	cursor:pointer;
	border-radius:3px;
	border:solid 2px #FFF;
}
#enviar4 {
transition: all .3s ease;
width:230px; text-align:center; height:30px; line-height:22px; font-size:16px; color:#B60104; float:left; border:solid 2px #B60104; background-color:transparent; border-radius:3px; -webkit-appearance: none;
}
#enviar4:hover {
    transition: all .3s ease;
	background-color:#B60104;
	color:#fff;
	cursor:pointer;
	border-radius:3px;
	border:solid 2px #B60104;
}
#enviar4:active {
    transition: all .3s ease;
	background-color:#B60104;
	color:#fff;
	cursor:pointer;
	border-radius:3px;
	border:solid 2px #B60104;
}
#enviar5 {
transition: all .3s ease;
width:100%; text-align:center; height:30px; line-height:22px; font-size:16px; color:#fff; float:left; border:solid 2px #fff; background-color:transparent; border-radius:3px; -webkit-appearance: none;
}
#enviar5:hover {
    transition: all .3s ease;
	background-color:#FF3D40;
	color:#fff;
	cursor:pointer;
	border-radius:3px;
	border:solid 2px #FF3D40;
}
#enviar5:active {
    transition: all .3s ease;
	background-color:#FF3D40;
	color:#fff;
	cursor:pointer;
	border-radius:3px;
	border:solid 2px #fff;
}
#menuinside2 a:link {

width:100%;
height:50px;
display:block;
float:left;
transition: all .3s ease;
opacity:0.7;
background-repeat:no-repeat; 
background-position:95% 50%; 
background-size:15px 15px;

}
#menuinside2 a:hover {

width:100%;
display:block;
float:left;
background-color:#416BAE;
transition: all .3s ease;
opacity:1;
background-image:url(../images/arrow.png); 
background-repeat:no-repeat; 
background-position:95% 50%; 
background-size:15px 15px;

}
#menuinside2 a:active {

width:100%;
display:block;
float:left;
transition: all .3s ease;

}
#menuinside2 a:visited {

width:100%;
display:block;
float:left;
transition: all .3s ease;

}

.button_example {
border:1px solid #d1dcdf; -webkit-border-radius: 3px; -moz-border-radius: 3px;border-radius: 3px;font-size:12px;padding: 10px 10px 10px 10px; text-decoration:none; font-weight:bold; color: #333;
 background-color: #f2f5f6; background-image: -webkit-gradient(linear, left top, left bottom, from(#f2f5f6), to(#c8d7dc));
 background-image: -webkit-linear-gradient(top, #f2f5f6, #c8d7dc);
 background-image: -moz-linear-gradient(top, #f2f5f6, #c8d7dc);
 background-image: -ms-linear-gradient(top, #f2f5f6, #c8d7dc);
 background-image: -o-linear-gradient(top, #f2f5f6, #c8d7dc);
 background-image: linear-gradient(to bottom, #f2f5f6, #c8d7dc);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#f2f5f6, endColorstr=#c8d7dc);
}

.button_example:hover {
 border:1px solid #b6c7cc;
 background-color: #d4dee1; background-image: -webkit-gradient(linear, left top, left bottom, from(#d4dee1), to(#a9c0c8));
 background-image: -webkit-linear-gradient(top, #d4dee1, #a9c0c8);
 background-image: -moz-linear-gradient(top, #d4dee1, #a9c0c8);
 background-image: -ms-linear-gradient(top, #d4dee1, #a9c0c8);
 background-image: -o-linear-gradient(top, #d4dee1, #a9c0c8);
 background-image: linear-gradient(to bottom, #d4dee1, #a9c0c8);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#d4dee1, endColorstr=#a9c0c8);
}
input.states {
background-image:url(../images/loginsubmit.png);
color:#fff;
border-radius:2px;
}
input.states:active {
    background-position: 0px -35px;
	color: #fff;
}
#modificar a:link {

color:#0B4E87;
text-decoration:none;

}
#modificar a:visited {

color:#0B4E87;
text-decoration:none;

}
#modificar a:active {

color:#0B4E87;
text-decoration:none;

}
#modificar a:hover {

color:#0B4E87;
text-decoration:underline;

}
.lik1 a:link {

color:#333;
text-decoration:none;

}
.lik1 a:visited {

color:#333;
text-decoration:none;

}
.lik1 a:active {

color:#333;
text-decoration:none;

}
.lik1 a:hover {

color:#333;
text-decoration:underline;

}
#emails a:link {

display:block;
float:left;
color:#0B4E87;
text-decoration:none;
width:100%;

}
#emails a:visited {

display:block;
color:#0B4E87;
text-decoration:none;

}
#emails a:active {

display:block;
color:#0B4E87;
text-decoration:none;

}
#emails a:hover {

display:block;
background-color:#D6D5B4;
color:#0B4E87;
text-decoration:none;

}
#email a:link {

color:#333;
text-decoration:none;

}
#email a:active {

color:#333;
text-decoration:none;

}
#email a:visited {

color:#333;
text-decoration:none;

}
#email a:hover {

color:#333;
text-decoration:underline;

}
#emailres a:link {
background-color:#C9C8C8;
display:block;
text-decoration:none;
height:30px;
}
#emailres a:visited {
background-color:#C9C8C8;
display:block;
text-decoration:none;
height:30px;
}
#emailres a:active {
background-color:#C9C8C8;
display:block;
text-decoration:none;
height:30px;
}
#emailres a:hover {
background-color:#B5B1B1;
display:block;
text-decoration:none;
height:30px;
}
#nom a:link {

color:#333;
text-decoration:none;

}
#nom a:active {

color:#333;
text-decoration:none;

}
#nom a:visited {

color:#333;
text-decoration:none;

}
#nom a:hover {

color:#333;
text-decoration:underline;

}
-->
</style>
</head>

<body>

<div id="pantalla" style="position:fixed; z-index:4; display:none;">

<div id="oscuro2" style="width:100%; height:100%; position:absolute; background-color:#000; opacity:0.5; top:0px; left:0px; z-index:1;"></div> 
      
      <div id="loading15" style="width:20%; margin-left:-10%; margin-top:-10%; left:50%; position:absolute; top:50%; z-index:2; background-color: rgba(229,0,0,0);"><img src="../images/loading_apple.gif" border="0" width="100%" /></div>
      
      
</div>      
<div id="header1">

 <div id="headerizquierda" class="headerinside">
 
  <a href="/"><div id="logo">
   
  </div></a><!--Termina logo-->
  
  <div id="right" style="overflow: auto; margin-left:30px; margin-top:10px;">
  
  <form id="buscador" name="buscador" action="../buscar.php" method="post" onsubmit="return(valida_envia())">
   
     <div id="buscadortext">
     
     <input type="text" id="buscar" name="buscar" value="" placeholder="Buscar productos o tiendas" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
     
     </div><!--Termina buscador text-->
     
     <div id="search"><input type="submit" class="submit" value=""></div>
   
   </form><!--Termina buscador-->
   
   </div>
  
 </div><!--Termina headerizquierda-->
 
 <div id="headerderecha" class="headerinside2">
 
  <div id="menuusuario" style="height:50px; line-height:20px; font-size:12px; margin-top:15px; overflow:hidden; float:right; font-weight:100;">
  
  <div id="menuinside" style="">
  
      <div id="link4" class="link" style="width:55px; height:55px; float:right; position:relative; overflow:hidden;"><a href="/compra">
      
      <div id="circulo" style="width:20px; height:20px; position:absolute; top:0px; right:0px;">
   
   <div id="circuloinside" align="center" style="width:17px; height:17px; overflow:hidden; background-color:#838383; border:3px solid #fff; color:#fff; text-align:center; font-size:12px; line-height:17px; font-weight:bold; border-radius:13px;<?php if ($productos == 0) { ?> display:none;<?php } ?>"><?php echo $productos; ?></div>
   
   </div>
    
    <div id="titulolink1" class="link" align="center" style="width:100%; color:#333; position:absolute; bottom:0px; left:0px; height:20px; line-height:20px;">Carrito</div>
    
    </a></div>
    
    <div id="linea" style="width:1px; background-color:#ccc; float:right; margin-right:7px; margin-left:7px; height:42px; margin-top:7px;"></div>
    
    <?php if ($row_Recordset1['nombre'] != '') { ?>
    <div id="link3" class="link" style="width:55px; height:55px; float:right; position:relative; overflow:hidden;"><a href="index.php?id=logout">
    
    <div id="titulolink1" align="center" style="width:100%; color:#333; position:absolute; bottom:0px; left:0px; height:20px; line-height:20px; font-size:11px;">Salir</div>
    
    </a></div>
    
    <div id="linea" style="width:1px; background-color:#ccc; float:right; margin-right:7px; margin-left:7px; height:42px; margin-top:7px;"></div>
    
    <?php if ($id_cliente == $id_perfil) { ?>
    <div id="link2" class="link" style="width:55px; height:55px; float:right; position:relative; overflow:hidden; background-image:url(../images/silueta40<?php if ($sexo == "m") echo "m"; ?>.png?id=<?php echo $time; ?>);
	background-position:0px -55px; background-repeat:no-repeat;">
    
    <div id="titulolink1" align="center" style="width:100%; color:#333; position:absolute; bottom:0px; left:0px; height:20px; line-height:20px; font-size:11px; font-weight:bold;">Mi perfil</div>
    
    </div>
    <?php } else { ?>
    <div id="link2" class="link" style="width:55px; height:55px; float:right; position:relative; overflow:hidden;">
    <a href="/perfil">
    <div id="titulolink1" align="center" style="width:100%; color:#333; position:absolute; bottom:0px; left:0px; height:20px; line-height:20px; font-size:11px;">Mi perfil</div>
    </a>
    </div>
    
    <?php } ?>
    
    
    <div id="linea" style="width:1px; background-color:#ccc; float:right; margin-right:7px; margin-left:7px; height:42px; margin-top:7px;"></div>
    
    <div id="link1" class="link" align="center" style="width:55px; height:55px; float:right; position:relative; overflow:hidden;"><a href="/tienda">
    
    <div id="titulolink1" align="center" style="width:100%; color:#333; position:absolute; bottom:0px; left:0px; height:20px; line-height:20px; font-size:11px;">Mi tienda</div>
    
    </a></div>
     <?php } else { ?>
     
     <div id="link5" class="link" style="width:55px; height:55px; float:right; position:relative; overflow:hidden;"><a href="/vender">
    
    <div id="titulolink1" class="link" align="center" style="width:100%; color:#333; position:absolute; bottom:0px; left:0px; height:20px; line-height:20px; font-size:11px;">Vende</div>
    
    </a></div>
     
     <?php } ?>
     
     </div>
    
    </div>
 </div><!--Termina headercentro-->
 
</div><!--Termina header1-->

<div id="menu" style="width:100%; height:40px; line-height:40px; float:left; background-color:#0B4E87; color:#fff;">

<div id="menuinside" style="display: table; margin: 0 auto;">

<div id="inicio" class="menu" style="height:40px; line-height:40px; float:left; font-size:12px;"><a href="/">INICIO</a></div>

<div id="linea" style="width:1px; height:16px; float:left; margin-top:12px; background-color:#fff;"></div>

<div id="inicio" class="menu" style="height:40px; line-height:40px; float:left; font-size:12px;"><a href="/acercade">ACERCA DE</a></div>

<div id="linea" style="width:1px; height:16px; float:left; margin-top:12px; background-color:#fff;"></div>

<div id="inicio" class="menu" style="height:40px; line-height:40px; float:left; font-size:12px;"><a href="/preguntasfrecuentes">PREGUNTAS FRECUENTES</a></div>

<div id="linea" style="width:1px; height:16px; float:left; margin-top:12px; background-color:#fff;"></div>

<div id="inicio" class="menu" style="height:40px; line-height:40px; float:left; font-size:12px;"><a href="/contacto">CONTACTO</a></div>

<div id="linea" style="width:1px; height:16px; float:left; margin-top:12px; background-color:#fff;"></div>

<div id="inicio" class="menu" style="height:40px; line-height:40px; float:left; font-size:12px;"><a href="/ayuda">AYUDA</a></div>

</div>

</div>

<div id="contenido" style="width:100%; float:left; background-color:#FFF;">

<div id="left" style="width:100%; padding-bottom:20px; float:left; background-color:#414853; overflow:hidden; position:relative;">


  <div id="contenidoin" style="float:left; width:100%;">
  
  <?php if ($usuarioemail != "") { ?>
  
  <div id="left" style="float:left; margin-left:3%; margin-top:10px;">
    
    <div id="leftcontent" style="width:100%; padding-bottom:20px; float:left; background-color:#0B4E87; overflow:hidden; position:relative;">
    
    <div id="fotowrapp" style="margin-left:25%; width:50%; padding-bottom:50%; float:left; margin-top:40px; position:relative;">
    
<?php if ($foto != '') { 
   $img = "usuarios/".$foto;
 } else { 
	  
	  $img = "silueta". $sexo1 ."500.jpg";
	  
} ?>
    
      <div id="foto" align="center" style="width:100%; height:100%; border:solid 10px #416BAE; overflow:hidden; border-radius:50%; float:left; background-color:#000; position:absolute; background-image:url(../images/<?php echo $img; ?>); background-size:cover;">
      
      <div id="oscuro" style="width:100%; height:100%; position:absolute; background-color:#000; opacity:0.5; top:0px; left:0px; z-index:1; display:none;"></div> 
      
      <div id="loading14" style="width:50%; left:25%; position:absolute; top:25%; z-index:0; background-color: rgba(229,0,0,0); display:none;"><img src="../images/loading3.gif" border="0" width="100%" /></div>
    
      </div>
      <input type="hidden" id="idcliente" name="idcliente" value="<?php echo $id_cliente; ?>">
      <input type="hidden" id="idperfil" name="idperfil" value="<?php echo $id_perfil; ?>">
      <?php if ($id_perfil == $id_cliente) { ?>
      <div id="cam" style="width:30px; height:30px; position:absolute; bottom:-15px; right:-30px;"><a href="javascript:void(0);" onclick="document.getElementById('foto1').click();"></a></div>
      
      <input type="file" id="foto1" name="foto1" style="display:none" onchange="return checkFile();" accept="image/jpg, image/jpeg" />
      
      <input type="hidden" id="cambiofoto" name="cambiofoto" value="<?php echo $cambiofoto; ?>">
      
      <?php } ?>
      
     </div>
      
      <?php if ($id_perfil != '') { ?>
      <div id="nombreper" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; padding-left:5%; color:#7FA0E7; margin-top:40px; font-weight:bold;"><?php echo strtoupper($nombreperfil); ?></div>
      
      <?php if ($empleo != '') { ?>
      <div id="nombreper" align="center" style="width:90%; float:left; font-size:18px; line-height:25px; padding-left:5%; color:#7FA0E7; margin-top:10px; font-weight:300;"><?php echo strtoupper($empleo); ?></div>
      <?php } ?>
      
      <?php if ($ciudad != '') { ?>
      <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; padding-left:5%; color:#7FA0E7; text-align:center;">
    
    <div id="menuinside" style="display: table; margin: 0 auto;">
    
    <div id="clock" style="width:15px; height:15px; margin-top:5px; float:left;"><img src="../images/location.png" width="15" /></div>

    <div id="texto" align="left" style="line-height:20px; font-size:14px; float:left; margin-left:5px; margin-top:5px;"><?php echo $ciudad; ?></div>
    
    </div>
    
    </div>
    <?php } ?>
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; padding-left:5%; color:#7FA0E7; text-align:center;">
    
    <div id="menuinside" style="display: table; margin: 0 auto;">
    
    <div id="clock" style="width:15px; height:15px; margin-top:5px; float:left;"><img src="../images/clock.png" width="15" /></div>
    <?php
	
	$fechadesde = $row_Recordset2['fecha'];
	
	$dia = date("j", $fechadesde);
	$mes = date("m", $fechadesde);
	$ano = date("Y", $fechadesde);
	
	if ($mes == "01") $mes1 = "ene";
	else if ($mes == "02") $mes1 = "feb";
	else if ($mes == "03") $mes1 = "mar";
	else if ($mes == "04") $mes1 = "abr";
	else if ($mes == "05") $mes1 = "may";
	else if ($mes == "06") $mes1 = "jun";
	else if ($mes == "07") $mes1 = "jul";
	else if ($mes == "08") $mes1 = "ago";
	else if ($mes == "09") $mes1 = "sept";
	else if ($mes == "10") $mes1 = "oct";
	else if ($mes == "11") $mes1 = "nov";
	else if ($mes == "12") $mes1 = "dic";
	
	?>
    <div id="texto" align="left" style="line-height:20px; font-size:14px; float:left; margin-left:5px; margin-top:5px;">Se unió el <?php echo $dia; ?> de <?php echo $mes1; ?> de <?php echo $ano; ?></div>
    
    </div>
    
    </div>
    
    <?php if ($id_perfil == $id_cliente) { ?>
    
    <div id="menuinside2" style="width:100%; float:left; margin-top:20px;">
    
    <a href="javascript:inicio();" class="1linka" style="display:none;"><div id="1linka" class="1linka" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-top:solid 1px #416BAE; border-bottom:solid 1px #416BAE; display:none;">
 
 <div id="xxs" style="width:19px; height:15px; float:left; margin-left:20px; margin-top:15px;"><img src="../images/home.png" height="15" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:10px;">Inicio</div>

 </div></a>
    
 <div id="1link" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-top:solid 1px #416BAE; border-bottom:solid 1px #416BAE; background-color:#416BAE; background-image:url(../images/arrow.png); background-repeat:no-repeat; background-position:95% 50%; background-size:15px 15px;">
 
 <div id="xxs" style="width:19px; height:15px; float:left; margin-left:20px; margin-top:15px;"><img src="../images/home.png" height="15" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:10px;">Inicio</div>

 </div>
 
 <div id="2link" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-bottom:solid 1px #416BAE; background-color:#416BAE; background-image:url(../images/arrow.png); background-repeat:no-repeat; background-position:95% 50%; background-size:15px 15px; display:none;">
 
 <div id="xxs" style="width:15px; height:15px; float:left; margin-left:20px; margin-top:15px;"><img src="../images/edit.png" height="15" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:14px;">Editar</div>

 </div>
 
 <a href="javascript:editar();" class="2linka"><div id="2linka" class="2linka" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-bottom:solid 1px #416BAE;">
 
 <div id="xxs" style="width:15px; height:15px; float:left; margin-left:20px; margin-top:15px;"><img src="../images/edit.png" height="15" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:14px;">Editar</div>

 </div></a>
 
 <div id="3link" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-bottom:solid 1px #416BAE; background-color:#416BAE; background-image:url(../images/arrow.png); background-repeat:no-repeat; background-position:95% 50%; background-size:15px 15px; display:none;">
 
 <div id="xxs" style="width:16px; height:15px; float:left; margin-left:20px; margin-top:18px;"><img src="../images/contacto.png" height="12" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:15px;">Mensajes</div>
 
 <?php if ($totalRows_Recordset8 > 0) { ?>
 <div id="circulo" align="center" style="float:left; margin-left:10px; width:26px; height:26px; background-color:#fff; line-height:26px; border-radius:15px; font-size:12px; margin-top:12px; overflow:hidden; color:#414853; font-weight:bold; text-align:center;"><?php echo $totalRows_Recordset8; ?></div>
 <?php } ?>
 
 </div>
 
 <a href="javascript:mensajes();" class="3linka"><div id="3linka" class="3linka" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-bottom:solid 1px #416BAE;">
 
 <div id="xxs" style="width:16px; height:15px; float:left; margin-left:20px; margin-top:18px;"><img src="../images/contacto.png" height="12" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:15px;">Mensajes</div>
 
 <?php if ($totalRows_Recordset8 > 0) { ?>
 <div id="circulo" align="center" style="float:left; margin-left:10px; width:26px; height:26px; background-color:#fff; line-height:26px; border-radius:15px; font-size:12px; margin-top:12px; overflow:hidden; color:#414853; font-weight:bold; text-align:center;"><?php echo $totalRows_Recordset8; ?></div>
 <?php } ?>

 </div></a>
 
 <div id="4link" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-bottom:solid 1px #416BAE; background-color:#416BAE; background-image:url(../images/arrow.png); background-repeat:no-repeat; background-position:95% 50%; background-size:15px 15px; display:none;">
 
 <div id="xxs" style="width:14px; height:15px; float:left; margin-left:20px; margin-top:18px;"><img src="../images/report.png" height="18" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:15px;">Reportes</div>

 </div>
 
 <a href="javascript:reportes();" class="4linka"><div id="4linka" class="4linka" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-bottom:solid 1px #416BAE;">
 
 <div id="xxs" style="width:14px; height:15px; float:left; margin-left:20px; margin-top:18px;"><img src="../images/report.png" height="18" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:15px;">Reportes</div>

 </div></a>
    
    
    </div><!--Termina menupropio-->
    
    <?php } else { ?>
    
   <div id="menuinside2" style="width:100%; float:left; margin-top:20px;">
    
    <a href="javascript:inicio();" class="1linka" style="display:none;"><div id="1linka" class="1linka" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-top:solid 1px #416BAE; border-bottom:solid 1px #416BAE; display:none;">
 
 <div id="xxs" style="width:19px; height:15px; float:left; margin-left:20px; margin-top:15px;"><img src="../images/home.png" height="15" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:10px;">Inicio</div>

 </div></a>
    
 <div id="1link" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-top:solid 1px #416BAE; border-bottom:solid 1px #416BAE; background-color:#416BAE; background-image:url(../images/arrow.png); background-repeat:no-repeat; background-position:95% 50%; background-size:15px 15px;">
 
 <div id="xxs" style="width:19px; height:15px; float:left; margin-left:20px; margin-top:15px;"><img src="../images/home.png" height="15" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:10px;">Inicio</div>

 </div>
 
 <div id="3link" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-bottom:solid 1px #416BAE; background-color:#416BAE; background-image:url(../images/arrow.png); background-repeat:no-repeat; background-position:95% 50%; background-size:15px 15px; display:none;">
 
 <div id="xxs" style="width:16px; height:15px; float:left; margin-left:20px; margin-top:18px;"><img src="../images/contacto.png" height="12" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:15px;">Enviar mensaje</div>
 
 </div>
 
 <a href="javascript:mensajes();" class="3linka"><div id="3linka" class="3linka" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-bottom:solid 1px #416BAE;">
 
 <div id="xxs" style="width:16px; height:15px; float:left; margin-left:20px; margin-top:18px;"><img src="../images/contacto.png" height="12" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:15px;">Enviar mensaje</div>

 </div></a>
 
 <div id="4link" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-bottom:solid 1px #416BAE; background-color:#416BAE; background-image:url(../images/arrow.png); background-repeat:no-repeat; background-position:95% 50%; background-size:15px 15px; display:none;">
 
 <div id="xxs" style="width:14px; height:15px; float:left; margin-left:20px; margin-top:18px;"><img src="../images/report.png" height="18" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:15px;">Reportar</div>

 </div>
 
 <a href="javascript:reportes();" class="4linka"><div id="4linka" class="4linka" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden; border-bottom:solid 1px #416BAE;">
 
 <div id="xxs" style="width:14px; height:15px; float:left; margin-left:20px; margin-top:18px;"><img src="../images/report.png" height="18" /></div>
 
 <div id="xx" align="left" style="height:50px; float:left; line-height:50px; font-size:14px; color:#fff; margin-left:15px;">Reportar</div>

 </div></a>
 
 </div>
    
    <?php } ?>
      
      </div>
      
      <?php } ?>
    
    </div>
    
    <div id="rightcontent" style="margin-left:1%; float:left; padding-bottom:20px; margin-top:10px; background-color:#F4F4F4; position:relative;">
    
    <?php if ($id_cliente == $id_perfil) { ?>
    <form id="form1" name="form1" action="" onsubmit="return(valida_envia2())" method="post" style="width:100%; float:left; display:none;">
    
    <div id="titulo11" align="center" style="width:100%; height:30px; line-height:30px; font-size:16px; font-weight:bold; color:#fff; background-color:#97BF3C; margin-top:0px; ">EDITAR PERFIL</div>
    
    <div id="titulo" style="width:96%; float:left; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:20px;">DIRECCIONES</div>
    
    <div id="titulo" style="width:96%; float:left; height:16px; line-height:16px; font-size:11px; font-weight:300; color:#0B4E87; margin-left:20px;">Direcciones para entrega de tus pedidos. No se muestra publicamente más que al vendedor.</div>
    
    <?php if ($totalRows_Recordset7 == 0) { ?>
   <div id="titulo" style="width:96%; float:left; height:16px; line-height:16px; font-size:11px; font-weight:300; color:#0B4E87; margin-left:20px; margin-top:10px;">No tienes direcciones agregadas.</div>
   <?php } else { ?>
   <div id="direc2" style="float:left; margin-left:20px; margin-right:20px; display:block;">
   <?php do { ?>
   <div id="direccion<?php echo $row_Recordset7['id']; ?>" style="float:left; margin-right:10px; line-height:18px; font-size:12px; color:#0B4E87; margin-top:10px; border:solid 1px #0B4E87; padding:10px; border-radius:7px; position:relative;">
   <?php if ($row_Recordset7['nombre'] != '') { ?>
   <strong>Nombre:</strong> <?php echo $row_Recordset7['nombre']; ?><br/>
   <?php } ?>
   <?php if ($row_Recordset7['email'] != '') { ?>
   <strong>Email:</strong> <?php echo $row_Recordset7['email']; ?><br/>
   <?php } ?>
   <strong>Calle y número:</strong> <?php echo $row_Recordset7['calle']; ?> No. <?php echo $row_Recordset7['numero']; ?><?php if ($row_Recordset7['interior'] != '') { ?> <strong>Int.</strong> <?php echo $row_Recordset7['interior']; ?><?php } ?><br/>
   <strong>Colonia:</strong> <?php echo $row_Recordset7['colonia']; ?><br/>
   <strong>Código postal:</strong> <?php echo $row_Recordset7['cp']; ?><br/>
   <strong>Ciudad y estado:</strong> <?php echo $row_Recordset7['ciudad']; ?>, <?php echo $row_Recordset7['estado']; ?>
   <br/><br/>
   
   <div id="botones" style="width:100%; position:absolute; bottom:0px; left:0px; height:20px; line-height:20px;">
   
   <div id="modificar" align="center" style="width:50%; float:left; height:20px; line-height:20px; color:#0B4E87;"><a href="javascript:void(0);" onclick="javascript:modificardireccion('<?php echo $row_Recordset7['id']; ?>');">Modificar</a></div>
   
   <div id="modificar" align="center" style="width:50%; float:left; height:20px; line-height:20px; color:#0B4E87;"><a href="javascript:void(0);" onclick="javascript:eliminardireccion('<?php echo $row_Recordset7['id']; ?>');">Eliminar</a></div>
   
   </div>
   
   </div>
   <?php } while ($row_Recordset7 = mysql_fetch_assoc($Recordset7));  ?>
   </div>
   <?php } ?>
   
   <div id="agregardireccion" style="width:96%; float:left; margin-left:20px; margin-top:10px;">
   
     <div id="direccionround" style="width:50%; padding:10px; float:left; border:solid 1px #0B4E87; border-radius:7px;">
     
     <div id="titulo" style="width:96%; float:left; height:16px; line-height:16px; font-size:11px; font-weight:300; color:#0B4E87;">*Sólo aceptamos direcciones en la República Mexicana.</div>
     
     <input type="text" id="direccionnombre" name="direccionnombre" placeholder="Nombre de destinatario" style="width:65%; float:left; height:25px; line-height:25px; padding-left:10px; padding-right:9px;" />
     
     <input type="text" id="direccionemail" name="direccionemail" placeholder="Email" style="width:65%; float:left; height:25px; line-height:25px; padding-left:10px; padding-right:9px; margin-top:5px;" />
   
     <input type="text" id="calle" name="calle" placeholder="Calle" style="width:65%; float:left; height:25px; line-height:25px; padding-left:10px; padding-right:9px; margin-top:5px;" />
     
     <input type="number" id="numero" name="numero" placeholder="No." style="width:15%; margin-left:5px; float:left; height:25px; line-height:25px; text-align:center; margin-top:5px;" />
     
     <input type="text" id="interior" name="interior" placeholder="Interior" style="width:25%; float:left; height:25px; line-height:25px; margin-top:5px; padding-left:10px;" />
     
     <input type="text" id="colonia" name="colonia" placeholder="Colonia" style="width:55%; margin-left:5px; float:left; height:25px; line-height:25px; padding-left:10px; margin-top:5px;" />
     
     <input type="text" id="cp" name="cp" placeholder="Código postal" style="width:25%; float:left; height:25px; line-height:25px; margin-top:5px; padding-left:10px;" onkeypress="return isNumberKey(event)" />
     
     <input type="text" id="direccionciudad" name="direccionciudad" placeholder="Ciudad" style="width:55%; margin-left:5px; float:left; height:25px; line-height:25px; padding-left:10px; margin-top:5px;" />
   
   <div id="cotent" style="float:left; width:100%;">
   <select id="direccionestado" name="direccionestado" class="button_example" style="height:25px; padding-right:10px; margin-top:5px; line-height:25px; float:left;">
    <option value="Aguascalientes">Aguascalientes</option>
    <option value="Baja California">Baja California Norte</option>
    <option value="Baja California Sur">Baja California Sur</option>
    <option value="Campeche">Campeche</option>
    <option value="Chiapas">Chiapas</option>
    <option value="Chihuahua">Chihuahua</option>
    <option value="Ciudad de México">Ciudad de México</option>
    <option value="Coahuila">Coahuila</option>
    <option value="Colima">Colima</option>
    <option value="Durango">Durango</option>
    <option value="Guanajuato">Guanajuato</option>
    <option value="Guerrero">Guerrero</option>
    <option value="Hidalgo">Hidalgo</option>
    <option value="Estado de México">Estado de México</option>
    <option value="Jalisco">Jalisco</option>
    <option value="Michoacán">Michoacán</option>
    <option value="Morelos">Morelos</option>
    <option value="Nayarit">Nayarit</option>
    <option value="Nuevo León">Nuevo León</option>
    <option value="Oaxaca">Oaxaca</option>
    <option value="Puebla">Puebla</option>
    <option value="Querétaro">Querétaro</option>
    <option value="Quintana Roo">Quintana Roo</option>
    <option value="San Luís Potosí">San Luís Potosí</option>
    <option value="Sinaloa">Sinaloa</option>
    <option value="Sonora">Sonora</option>
    <option value="Tabasco">Tabasco</option>
    <option value="Tamaulipas">Tamaulipas</option>
    <option value="Tlaxcala">Tlaxcala</option>
    <option value="Veracruz">Veracruz</option>
    <option value="Yucatán">Yucatán</option>
    <option value="Zacatecas">Zacatecas</option>
    
   </select>
   
   <select id="pais" name="pais" class="button_example" style="height:25px; padding-right:30px; margin-top:5px; line-height:25px; float:left; margin-left:5px;">
    <option value="México">México</option>
   </select>
   
   </div>
   <input type="hidden" id="iddireccion" name="iddireccion" value="">
   <div id="cotent" style="float:left; width:100%;">
   
   <div id="centrar" style="width:164px; margin-left:auto; margin-right:auto;">
   <input type="button" value="Enviar" class="states" onclick="agregardi();" style="width:160px; height:30px; float:left; text-align:center; line-height:20px; font-size:14px; background-repeat:repeat-x; border-radius:2px; border:solid 1px #C56F00; vertical-align:middle; -webkit-appearance:button; cursor:pointer; margin-top:10px;">
   </div>
   
   </div>
   
     </div>
   
   </div>
   
   <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:10px; text-align:center; margin-left:20px;">
       <input type="button" class="botonagregar" id="enviar2" name="enviar2" value="Agregar" onclick="javascript:direccion(this);" style="width:150px;" />
       </div>
    
    <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
    
    <div id="titulo" style="width:96%; float:left; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:20px;">¿EN QUÉ CIUDAD VIVES?</div>
    
     <div id="titulo" style="width:96%; float:left; height:16px; line-height:16px; font-size:11px; font-weight:300; color:#0B4E87; margin-left:20px;">*Sólo agrégala si quieres que se muestre en tu perfil</div>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:5px; margin-left:20px;"><input type="text" id="ciudad" name="ciudad" placeholder="Ciudad y estado" value="<?php echo $ciudad; ?>" style="width:50%; height:30px; line-height:30px; padding-left:10px;"></div>
    
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:10px; text-align:center; margin-left:20px;">
       <input type="button" id="enviar2" name="enviar2" value="Enviar" onclick="javascript:cambiar('ciudad');" style="width:150px;" />
       </div>
    
    <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
   
   <div id="titulo" style="width:96%; float:left; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:20px;">EMPLEO ACTUAL</div>
   
    <div id="titulo" style="width:96%; float:left; height:16px; line-height:16px; font-size:11px; font-weight:300; color:#0B4E87; margin-left:20px;">*Sólo agrégalo si quieres que se muestre en tu perfil</div>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:5px; margin-left:20px;"><input type="text" id="empleo" name="empleo" placeholder="Puesto y/o compañía" value="<?php echo $empleo; ?>" style="width:50%; height:30px; line-height:30px; padding-left:10px;"></div>
    
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:10px; text-align:center; margin-left:20px;">
       <input type="button" id="enviar2" name="enviar2" value="Enviar" onclick="javascript:cambiar('empleo');" style="width:150px;" />
       </div>
       
       <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
    
    <?php if ($fbid == '') { ?>
    <div id="titulo" style="width:96%; float:left; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:20px;">CAMBIAR EMAIL</div>
    
    <div id="titulo" style="width:96%; float:left; height:16px; line-height:16px; font-size:11px; font-weight:300; color:#0B4E87; margin-left:20px;"><strong>Tu email actual es:</strong> <?php echo $email; ?></div>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:5px; margin-left:20px;"><input type="email" id="email" name="email" placeholder="Email nuevo" style="width:50%; height:30px; line-height:30px; padding-left:10px;"></div>
    
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:10px; text-align:center; margin-left:20px;">
       <input type="button" id="enviar2" name="enviar2" value="Cambiar" onclick="javascript:cambiar('email');" style="width:150px;" />
       </div>
       
       <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
              
       <?php } ?>
       
       <div id="titulo" style="width:96%; float:left; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:20px;">EMAIL ALTERNO</div>
    
    <div id="titulo" style="width:96%; float:left; height:16px; line-height:16px; font-size:11px; font-weight:300; color:#0B4E87; margin-left:20px;"><?php if ($emailalterno != '') { ?><strong>Tu email alterno es:</strong> <?php echo $emailalterno; ?><?php } else { ?>No tienes email alterno<?php } ?>. Úsalo en caso de que no puedas usar tu email principal con el que te registraste.</div>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:5px; margin-left:20px;"><input type="email" id="emailnuevo1" name="emailnuevo1" placeholder="Email nuevo" value="<?php echo $emailalterno; ?>" style="width:50%; height:30px; line-height:30px; padding-left:10px;"></div>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:5px; margin-left:20px;">
    <div id="clock" style="width:20px; height:20px; line-height:20px; margin-top:5px; float:left;"><input type="checkbox" id="predeterminado" name="predeterminado" class="predeterminado" value="si"<?php if ($emailalterno == $emailelegido && $emailalterno != '') echo " checked"; ?> style="width:20px; height:20px; float:left;"></div>

    <div id="texto" align="left" style="line-height:20px; height:20px; font-size:12px; float:left; margin-left:5px; margin-top:8px; font-weight:300;">Hacer de éste mi email de correspondencia de Comercenter</div>
    </div>
    
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:10px; text-align:center; margin-left:20px;">
       <input type="button" id="enviar2" name="enviar2" value="<?php if ($emailalterno != '') { ?>Cambiar<?php } else { ?>Agregar<?php } ?>" onclick="javascript:cambiaremail();" style="width:150px;" />
       </div>
       
       <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
    
    <div id="titulo" style="width:96%; float:left; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:20px;"><?php if ($password != '') { ?>CAMBIAR CONTRASEÑA<?php } else { ?>TU CUENTA NO TIENE CONTRASEÑA, AGREGA UNA<?php } ?></div>
    
    <?php if ($password != '') { ?>
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:5px; margin-left:20px;"><input type="password" id="passwordactual" name="passwordactual" placeholder="Contraseña actual" style="width:50%; height:30px; line-height:30px; padding-left:10px;"></div>
    <?php } ?>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:5px; margin-left:20px;"><input type="password" id="passwordnuevo" name="passwordnuevo" placeholder="Contraseña nueva" style="width:50%; height:30px; line-height:30px; padding-left:10px;"></div>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:5px; margin-left:20px;"><input type="password" id="repasswordnuevo" name="repasswordnuevo" placeholder="Repite contraseña nueva" style="width:50%; height:30px; line-height:30px; padding-left:10px;"></div>
    
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:10px; text-align:center; margin-left:20px;">
       <input type="button" id="enviar2" name="enviar2" value="Cambiar" onclick="javascript:cambiarcontrasena();" style="width:150px;" />
       </div>

    
    <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
    
    <div id="titulo" style="width:96%; float:left; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:20px;">CAMBIAR NOMBRE</div>
    
    <div id="titulo" style="width:96%; float:left; height:16px; line-height:16px; font-size:11px; font-weight:300; color:#0B4E87; margin-left:20px;">*Sólo puedes cambiar tu nombre una vez cada 3 meses</div>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:5px; margin-left:20px;"><input type="text" id="nuevonombre" name="nuevonombre" placeholder="Nuevo nombre" style="width:50%; height:30px; line-height:30px; padding-left:10px;"></div>
    
    <input type="hidden" id="nombreoriginal" name="nombreoriginal" value="<?php echo $nombreperfil; ?>">
    
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:10px; text-align:center; margin-left:20px;">
       <input type="button" id="enviar2" name="enviar2" value="Cambiar" onclick="javascript:cambiarnombre();" style="width:150px;" />
       </div>
       
       <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
    
    <div id="titulo" style="width:96%; float:left; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:20px;">CERRAR TU CUENTA</div>
       
       <div id="titulo" style="width:96%; float:left; line-height:16px; font-size:12px; font-weight:300; color:#0B4E87; margin-left:20px;">
     <p>¿Qué sucede cuando cierras tu cuenta?</p>
<li>Tu perfil y tu tienda no aparecerán en ningún lugar de Comercenter.</li><br/>

<li>Las personas que intenten ver tu perfil, tu tienda o alguno de tus artículos verán un mensaje de "página no disponible".</li><br/>

<li>Los reportes que hayas enviado se cerrarán.</li><br/>

<li>Puedes volver a abrir tu cuenta cuando quieras.</li><br/>

<li>Para ello, solo tienes que reactivar tu cuenta recuperando tu contraseña en Comercenter cuando quieras volver.</li><br/>
 
<li>También puedes ponerte en contacto con nuestro equipo de asistencia para que te ayuden a reabrir tu cuenta.</li><br/>
 
<li>Nadie podrá usar tu nombre de usuario y la configuración de tu cuenta quedará intacta.</li></div>

<div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#B60104; margin-top:20px; text-align:center; margin-left:20px;">
       <input type="button" id="enviar4" name="enviar4" value="Cerrar cuenta" onclick="javascript:eliminarcuenta();" style="width:200px;" />
       </div>
    
    </form>
    
    <div id="mensajes" style="width:100%; float:left; display:none; min-height:600px;">
    <div id="titulo11" align="center" style="width:100%; height:30px; line-height:30px; font-size:16px; font-weight:bold; color:#fff; background-color:#20A2B2; margin-top:0px; ">MENSAJES</div>
    
    <div id="recuadro" style="width:96%; float:left; margin-left:2%; margin-top:20px; border:solid 1px #ccc; border-radius:7px; padding-bottom:20px; overflow:hidden;">
    
    <div id="upban" style="width:100%; height:50px; line-height:50px; float:left; background-color:#C9C8C8;">
    
     <div id="lik1" style="padding-left:20px; padding-right:20px; height:50px; float:left; line-height:50px; font-size:#333; font-weight:bold; font-size:18px;">Inbox</div>
     
     <div id="lik1a" class="lik1" style="padding-left:20px; padding-right:20px; height:50px; float:left; line-height:50px; font-size:#333; font-size:18px; display:none;"><a href="javascript:inbox();">Inbox</a></div>
     
     <div id="lik2a" class="lik1" style="padding-left:20px; padding-right:20px; height:50px; float:left; line-height:50px; font-size:#333; font-size:18px;"><a href="javascript:enviados();">Enviados</a></div>
     
     <div id="lik2" style="padding-left:20px; padding-right:20px; height:50px; float:left; line-height:50px; font-size:#333; font-size:18px; display:none; font-weight:bold;">Enviados</div>
     
     <div id="lik3a" class="lik1" style="padding-left:20px; padding-right:20px; height:50px; float:left; line-height:50px; font-size:#333; font-size:18px; display:none;"><a href="javascript:eliminarbox();">Eliminar</a></div>
     
     </div>
     
     <div id="inboxwrapp" style="width:100%; float:left;">
     
     
     
     </div>
    
    
    </div>
    
    
    </div>
    
    <div id="reportes" style="width:100%; float:left; display:none; min-height:600px;">
    <div id="titulo11" align="center" style="width:100%; height:30px; line-height:30px; font-size:16px; font-weight:bold; color:#fff; background-color:#760204; margin-top:0px;">REPORTES</div>
    
    <div id="reporteswrapp" style="width:100%; float:left;">
     
      
     
     </div>
    
    
    </div>
    
    <?php } else { ?>
    
    <div id="mensajes" style="width:100%; float:left; display:none; padding-bottom:20px;">
    <div id="titulo11" align="center" style="width:100%; height:30px; line-height:30px; font-size:16px; font-weight:bold; color:#fff; background-color:#20A2B2; margin-top:0px; ">ENVIAR MENSAJE A <?php echo strtoupper($nombreperfil); ?></div>
    
    <div id="recuadro" style="width:96%; float:left; margin-left:2%; margin-top:20px; border:solid 1px #ccc; border-radius:7px; padding-bottom:20px; overflow:hidden;">
    
    <input type="text" id="asunto" name="asunto" style="width:69%; margin-left:15%; border:#777 solid 1px; padding-left:1%; float:left; height:30px; line-height:30px; margin-top:30px;" placeholder="Asunto" />
    
    <textarea id="cuerpomensaje" name="cuerpomensaje" placeholder="Mensaje" style="width:68%; padding:1%; float:left; margin-left:15%; margin-top:5px; resize:none; height:200px;"></textarea>
    
    <div id="nombre" align="center" style="width:100%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:10px; text-align:center;">
       <div id="centrar" align="center" style="width:160px; margin-left:auto; margin-right:auto;">
       <input type="button" id="enviar2" name="enviar2" value="Enviar" onclick="javascript:enviarmensaje();" style="width:150px;" />
       </div>
       </div>


    </div>
    
    
    </div>
    
    <div id="reportes" style="width:100%; float:left; display:none; padding-bottom:20px;">
    <div id="titulo11" align="center" style="width:100%; height:30px; line-height:30px; font-size:16px; font-weight:bold; color:#fff; background-color:#760204; margin-top:0px;">REPORTAR A <?php echo strtoupper($nombreperfil); ?></div>
    
    <div id="recuadro" style="width:96%; float:left; margin-left:2%; margin-top:20px; border:solid 1px #ccc; border-radius:7px; padding-bottom:20px; overflow:hidden;">
    
    <div style="width:69%; margin-left:15%; float:left; font-size:12px; #333; line-height:20px; margin-top:30px;">
    Platicanos por qué quieres reportar a <?php echo $nombreperfil; ?><br/>
    <span style="font-size:11px;">*No te preocupes, el reporte es anónimo y nadie más se enterará sobre él.<br/>Puedes reportar al usuario por ejemplo por:<br/><li>Acosarte</li>
    <li>Enviar publicidad no solicitada o promociones, solicitudes de donaciones, o mensajes no deseados</li>
<li>Acosar, abusar o violar nuestra Política de uso de la plataforma</li>
<li>Ponerse en contacto contigo después de que le hayas pedido explícitamente que no lo haga</li>
<li>Interferir con una transacción o negocio</li><br/></span>
    </div>
    
    <textarea id="cuerpomensaje1" name="cuerpomensaje1" placeholder="Descripción del reporte" style="width:68%; padding:1%; float:left; margin-left:15%; margin-top:5px; resize:none; height:200px;"></textarea>
    
    <div id="nombre" align="center" style="width:100%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:10px; text-align:center;">
       <div id="centrar" align="center" style="width:160px; margin-left:auto; margin-right:auto;">
       <input type="button" id="enviar2" name="enviar2" value="Enviar" onclick="javascript:enviarreporte();" style="width:150px;" />
       </div>
       </div>
       
      </div>
    
    </div>
    
    <?php } ?>
    <div id="favoritas" style="width:100%; float:left;">
    <?php if ($id_perfil != '') { ?>
    
    <?php if ($totalRows_Recordset6 > 0 && $estadotienda == "1") { 
		
		if ($portadatienda == "") $portadatienda = "portadatienda.jpg";
		
		?>
      <div id="tiendamovil" style="width:100%; float:left;">

      <div id="portada" style="float:left; width:100%; background-image:url(../images/portadas/<?php echo $portadatienda; ?>); background-repeat:no-repeat; background-position:top left; background-size:100%; position:relative;">
      <img src="../images/portadas/<?php echo $portadatienda; ?>" width="100%" style="float:left; visibility:hidden; margin-bottom:70px;" />
      
      <div id="titulos" style="width:100%; position:absolute; top:100%; margin-top:-122px; left:2%; height:112px;">
      
      <div id="silueta" style="height:102px; float:left; overflow:hidden; background-color:#fff; border:solid 5px #fff;"><a href="/tienda/<?php echo $linktienda; ?>"><img src="<?php if ($logotienda != '') { ?>../images/logotipos/<?php echo $logotienda; ?><?php } else { ?>../images/logotienda.png<?php } ?>" height="100" style="border:1px solid #ccc;" /></a></div>
    
    <div id="nombreper" align="left" style="float:left; display:block; width:auto; overflow:hidden; color:#3D3D3D; margin-top:77px; font-weight:bold; margin-left:10px; height:35px;">
    
    <div id="nom" style="line-height:20px; width:100%; font-size:20px; float:left; height:20px;"><a href="/tienda/<?php echo $linktienda; ?>"><?php echo $nombretienda ?></a></div>
    
    <div id="nombreper" align="left" style="float:left; width:100%; font-size:12px; height:15px; overflow:hidden; line-height:15px; color:#3D3D3D; margin-top:0px; font-weight:300;">Tienda</div>
    
    </div>
    
    
     </div><!--Termina titulos-->
      
      </div>
      
      </div>
      <?php } ?>
    
    <?php if ($id_cliente == $id_perfil) { ?>
    <div id="titulo" style="width:96%; float:left; margin-left:2%; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px;">MIS COMPRAS (<?php echo $totalRows_Recordset5a; ?>)</div>
    
    <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:5px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
   
   <div id="titulo" style="width:96%; float:left; margin-left:2%; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-bottom:20px;">
   <?php if ($totalRows_Recordset5a == 0) { ?>
   No tienes compras aún
   <?php } else { ?>
   
   <?php } ?>
   </div>
   
    <?php } ?>
    <div id="titulo" style="width:96%; float:left; margin-left:2%; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px;">PRODUCTOS FAVORITOS (<?php echo $totalRows_Recordset3; ?>)</div>
    
    <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:5px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
   
   <?php if ($totalRows_Recordset3 > 0) { ?>
   
   <?php do { ?>
   <?php 
   
 $nombreproducto = stripslashes(stripslashes($row_Recordset3['nombre']));

$foto1 = "";
  if ($row_Recordset3['foto1'] != '') $foto1 = $row_Recordset3['foto1'];
  else if ($row_Recordset3['foto2'] != '') $foto1 = $row_Recordset3['foto2'];
  else if ($row_Recordset3['foto3'] != '') $foto1 = $row_Recordset3['foto3'];
  else if ($row_Recordset3['foto4'] != '') $foto1 = $row_Recordset3['foto4'];
  else if ($row_Recordset3['foto5'] != '') $foto1 = $row_Recordset3['foto5'];
  
  if ($foto1 == "") $foto = "fotoproducto.jpg";
  else if ($foto1 != '') $foto = $foto1;


$link = $row_Recordset3['link'];
$linktienda = $row_Recordset3['linktienda'];


$medida = 'width="100%"';

if ($foto != "fotoproducto.jpg") { 
	
  $size = getimagesize( "../images/productos/".$foto );
  $ratio = $size[0]/$size[1];
  $width1 = $size[0];
  $height1 = $size[1];
   
   if ($width1 >= $height1) {		   
	 $medida = 'height="100%"';
	} 
	
}

	
	?>
    <div id="fotothumb" class="foto2" style="float:left; width:calc(20% - 12px); overflow:hidden; padding-bottom:calc(18% + 20px); position:relative; margin-top:10px; margin-left:10px;">
    
    <a href="/tienda/<?php echo $linktienda ?>/<?php echo $link; ?>" style="width:calc(100% - 4px); height:calc(100% - 24px); position:absolute; top:0px; left:0px; overflow:hidden; z-index:2; border:#000 solid 2px;">
    <img src="../images/productos/<?php echo $foto; ?>" <?php echo $medida; ?> style="float:left;" />
    </a>
    
    <div id="nombretienda" align="center" style="width:100%; height:20px; line-height:20px; color:#333; font-size:12px; font-weight:bold; position:absolute; bottom:0px; left:0px;"><?php echo $row_Recordset3['nombre']; ?></div>
    
    </div>
   
   <?php } while($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
   
   <?php } else { ?>
   
   <div id="titulo" style="width:96%; float:left; margin-left:2%; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px;">No tiene<?php if ($id_cliente == $id_perfil) { ?>s<?php } ?> productos favoritos aún</div>
   
   <?php } ?>
   
   <div id="titulo" style="width:96%; float:left; margin-left:2%; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:30px;">TIENDAS FAVORITAS (<?php echo $totalRows_Recordset4; ?>)</div>
    
    <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:5px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
   
   <?php if ($totalRows_Recordset4 > 0) { ?>
   
   <?php do { ?>
   <?php 
   
 $nombretienda = stripslashes(stripslashes($row_Recordset4['nombre']));
$logotienda = $row_Recordset4['logo'];
if ($logotienda == "") $logopublicado = "logoim.jpg";
else if ($logotienda != "") $logopublicado = "logotipos/".$logotienda;
$linktienda = $row_Recordset4['link'];
$medida = 'width="100%"';

  if ($logotienda != '') {
  
  list($width, $height, $type, $attr) = getimagesize("../images/logotipos/".$logotienda);
		$fn = "../images/logotipos/".$logotienda;
		 $size = getimagesize( $fn );
        $ratio = $size[0]/$size[1]; // width/height
		$width1 = $size[0];
		$height1 = $size[1];
		$completados = $completados + 1;
			
if ($width1 < $height1) {

$medida = 'height="100%"';

} 
  
  } else {
	
  $logotienda = "logotienda.jpg";  
   
  }

	
	?>
    <div id="fotothumb" class="foto2" style="float:left; width:calc(20% - 12px); overflow:hidden; padding-bottom:calc(18% + 20px); position:relative; margin-top:10px; margin-left:10px;">
    
    <a href="/tienda/<?php echo $row_Recordset4['link']; ?>" style="width:calc(100% - 4pX); height:calc(100% - 24px); position:absolute; top:0px; left:0px; overflow:hidden; z-index:2; border:#000 solid 2px;">
    <img src="../images/<?php echo $logopublicado; ?>" <?php echo $medida; ?> style="float:left;" />
    </a>
    
    <div id="nombretienda" align="center" style="width:100%; height:20px; line-height:20px; color:#333; font-size:12px; font-weight:bold; position:absolute; bottom:0px; left:0px;"><?php echo $row_Recordset4['nombre']; ?></div>
    
    </div>
   
   <?php } while($row_Recordset4 = mysql_fetch_assoc($Recordset4)); ?>
   <?php } else { ?>
   
   <div id="titulo" style="width:96%; float:left; margin-left:2%; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px;">No tiene<?php if ($id_cliente == $id_perfil) { ?>s<?php } ?> tiendas favoritas aún</div>
   
   <?php } ?>
   
   <?php } else { ?>
   
   <div id="titulo" align="center" style="width:96%; float:left; margin-left:2%; height:30px; line-height:30px; font-size:20px; font-weight:bold; color:#0B4E87; margin-top:40px;">ESTE PERFIL NO EXISTE</div>
   
   <?php } ?>
   </div><!--Termina favoritos-->
    
    </div>
  
  <?php } else { ?>
  
  <div id="centro" style="width:100%; float:left; margin-top:40px; margin-bottom:40px;">
  
    <div id="centrado" style="width:426px; height:376px; margin-left:auto; margin-right:auto; background-color:#0B4E87;">
    
    
     <div id="necesitas" style="width:400px; height:350px; float:left; border:#FFF solid 4px; background-color:#0B4E87; margin-left:9px; margin-top:8px;">
     
     <div id="debes" style="height:30px; line-height:30px; float:left; border-bottom:solid #fff 2px; margin-left:10px; color:#fff; margin-top:10px; font-size:20px;">PARA VER ESTA PÁGINA</div>
     
     <div id="loggear" style="width:380px; line-height:35px; font-size:25px; color:#F77D00; float:left; margin-left:10px; margin-top:10px;">DEBES HACER LOG IN PRIMERO EN LA PÁGINA DE INICIO</div>
     
     <div id="candado" style="width:100px; height:130px; float:left; margin-left:150px; margin-top:20px;"><img src="../images/lock.png?id=<?php echo $time; ?>" width="100" /></div>
     
     </div>
    
    </div>
    
    
    </div>
    <?php } ?>
    
   </div>

</div>

<div id="linea" style="width:100%; float:left; background-color:#CCCCCC; height:1px;"></div>

 <div id="footer" style="width:100%; float:left; height:100px; background-color:#fff;">
<a href="/"><div id="logo2">
   
  </div></a><!--Termina logo-->
  
  <div id="titulo3" style="float:right; margin-right:3%; height:20px; line-height:20px; font-size:12px; margin-top:35px;"><a href="/avisodeprivacidad">Privacidad</a></div>
  
  <div id="titulo3" style="float:right; margin-right:15px; height:20px; line-height:20px; font-size:12px; margin-top:35px;"><a href="/ayuda/terminos">Condiciones de uso</a></div>
  
  <div id="titulo3" style="float:right; margin-right:15px; height:20px; line-height:20px; font-size:12px; margin-top:35px;">© 2018 Comercenter</div>

</div>
<input type="hidden" id="alturaleft" name="alturaleft" value="">
</div><!--Termina contenido-->
<?php } else { 

$query_Recordset5 = "SELECT * FROM categorias ORDER BY categoria ASC";
$Recordset5 = mysql_query($query_Recordset5, $comercenter) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

?>
<style type="text/css">
<!--
body {
	background-color: #FFF;
	margin: 0;
	font-family:Geneva, Arial,Helvetica, sans-serif;
}
#header1 {
width:100%; 
background-color:#fff; 
float:left;
}

#buscadortext input[type=text] {
width:97%; 
height:33px;
line-height:30px;
border-radius:7px;
border: solid #ccc 1px;
font-size:14px;
color:#333;
padding-left:3%;
}
#buscadortext input[type=text]:focus {
outline:none;
}
#search {
width:15%; 
height:36px;
float:left;
margin-top:5px;
}
.submit {
	background-image:url(../images/search.png);
	width:100%;
	height:42px;
	background-size:30px 30px;
	background-position:center;
	background-repeat:no-repeat;
	outline-style: none;
	border:none;
	cursor:pointer;
	background-color:#0B4E87;
	border-top-right-radius: 7px;
	border-bottom-right-radius: 7px;
}
.headerinside {

float:left; 
width:100%; 
height:140px;	

}

.headerinside2 {

float:left; 
width:100%; 
height:80px;
position:relative;	

}

#buscador {
width:96%; 
height:50px; 
float:left;  
margin-top:13px;
margin-left:2%; 
overflow:hidden;
text-align:center;

}

#buscadortext {
float:left; 
width:85%;  
height:60px; 
margin-top:5px;

}
#titulo2 a:link {
	text-decoration:none;
	font-weight:bold;
	display:block;
	color:#fff;
	background-color:#0B4E87;
}
#titulo2 a:active {
	text-decoration:none;
	font-weight:bold;
	display:block;
	color:#fff;
	background-color:#0B4E87;
}
#titulo2 a:visited {
	text-decoration:none;
	font-weight:bold;
	display:block;
	color:#fff;
	background-color:#0B4E87;
}
#titulo2 a:hover {
	text-decoration:none;
	font-weight:bold;
	display:block;
	color:#fff;
	background-color:#0B4E87;
}
#titulo1 a:link {
	color:#0B4E87;
	text-decoration:none;
	font-weight:bold;
}
#titulo1 a:active {
	color:#0B4E87;
	text-decoration:none;
	font-weight:bold;
}
#titulo1 a:visited {
	text-decoration: none;
	color: #0B4E87;
	font-weight:bold;
}
#titulo1 a:hover {
	text-decoration:underline;
	font-weight:bold;
}
.botonlogin1 a:link {
	text-decoration: none;
	color: #333;
	font-weight:100;
	font-size:20px;
	font-weight:300;
	display:block;
	width:99%;  
	line-height:40px; 
	float:left; 
	background-color:#D1CFCF; 
	border:solid #B7B5B5 1px; 
	border-bottom-right-radius:7px;
}
.botonlogin1 a:visited {
	text-decoration: none;
	color: #333;
	font-weight:100;
	font-size:20px;
	font-weight:300;
	display:block;
}
.botonlogin1 a:hover {
	text-decoration: none;
	color: #333;
	font-size:20px;
	font-weight:300;
	display:block;
	background-color:#F3F3F1;
}
.botonlogin2 {
width:49%;
line-height:40px; 
font-size:20px;
font-weight:300; 
float:left; color:#333; 
background-color:#F3F3F1; 
border-top-left-radius:7px; 
margin-left:1px;
}
.botonlogin1 {
width:50%; 
line-height:40px; 
font-size:20px;
font-weight:300;
float:left; color:#333; 
background-color:#F3F3F1;  
}
.botonlogin2a {
width:49%;  
line-height:40px; 
font-size:20px;
font-weight:300; 
float:left; color:#333; 
background-color:#D1CFCF; 
border-bottom-left-radius:7px; 
border:solid #B7B5B5 1px;
}
.botonlogin2a a:link {
	text-decoration: none;
	color: #333;
	font-size:20px;
	font-weight:300;
	display:block;
	width:99%; 
	height:40px; 
	line-height:40px; 
	float:left; 
	background-color:#D1CFCF; 
	border:solid #B7B5B5 1px; 
	border-bottom-left-radius:7px;
}
.botonlogin2a a:visited {
	text-decoration: none;
	color: #333;
	font-size:20px;
	font-weight:300;
	display:block;
}
.botonlogin2a a:hover {
	text-decoration: none;
	color: #333;
	font-size:20px;
	font-weight:300;
	display:block;
	background-color:#F3F3F1;
}

input.states {
background-image:url(images/loginsubmit.png);
color:#fff;
border-radius:2px;
}
input.states:active {
    background-position: 0px -35px;
	color: #fff;
}
#link1 a:link {
	background-image:url(../images/tienda.png?id=<?php echo $time; ?>);
	background-position:0px 7px;
	background-repeat:no-repeat;
}
#link1 a:active {
	background-position:0px 7px;
}
#link1 a:visited {
	background-position:0px 7px;
}
#link2 a:link {
	background-image:url(../images/silueta40<?php if ($sexo == "m") echo "m"; ?>.png?id=<?php echo $time; ?>);
	background-position:0px -49px;
	background-repeat:no-repeat;
}
#link2 a:active {
	background-position:0px -49px;
}
#link2 a:visited {
	background-position:0px -49px;
}
#link3 a:link {
	background-image:url(../images/desconectar.png?id=<?php echo $time; ?>);
	background-position:-3px -49px;
	background-repeat:no-repeat;
}
#link3 a:active {
	background-position:-3px -49px;
}
#link3 a:visited {
	background-position:-3px -49px;
}
#link4 a:link {
	background-image:url(../images/carrito.png?id=<?php echo $time; ?>);
	background-position:-3px -49px;
}
#link4 a:active {
	background-position:-3px -49px;
}
#link4 a:visited {
	background-position:-3px -49px;
}
#link5 a:link {
	background-image:url(../images/vender.png?id=<?php echo $time; ?>);
	background-position:-3px -49px;
}
#link5 a:active {
	background-position:0px -49px;
}
#link5 a:visited {
	background-position:0px -49px;
}
.link a:link, .link a:active, .link a:visited, .link a:hover {
	width:51px;
	color:#000;
	font-size:11px;
	height:55px;
	background-repeat:no-repeat;
	border:none;
	display:block;
	font-weight:bold;
}
.example-2 {
  overflow: hidden;
  width: 100%;
  position: relative;
}

.example-2 ul {
  overflow: hidden;
  width:104%;
  zoom: 1;
}

.example-2 ul li { float: left; width:100%; overflow:hidden; }

.example-2 ul li img { 
height: 100%;
float:left;
 }

ul {
  padding-left: 0;
  list-style: none;
}

.dots-1 {
  position: absolute;
  bottom: 10px;
  right: 10px;
  margin: 0;
  padding: 0;
  text-align: center;
}

.dots-1 li {
  display: inline-block;
 *display: inline;
 *zoom: 1;
  width: 15px;
  height: 15px;
  margin: 0 5px;
  background: #0B4E87;
  border:solid #fff 1px;
  cursor: pointer;
}

.dots-1 li:hover, .dots-1 li.active { background: #000; }
@media screen and (max-width: 664px) {
#logo {
	width:318px;
	height:70px;
	margin-left:auto;
	margin-right:auto;
	margin-top:5px;
	background-image:url(../images/logohorizontal.png);
	background-size: 278px; background-position:right;
	background-repeat:no-repeat;
}
}
@media screen and (min-width: 665px) {
#logo {
	width:278px;
	height:70px;
	margin-left:auto;
	margin-right:auto;
	margin-top:5px;
	background-image:url(../images/logohorizontal.png);
	background-size: 278px;
	background-repeat:no-repeat;
}
}
.menuinside2 {

    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* The main point: */
    overflow-y: auto;
    /* Optional but highly reccomended: enables momentum scrolling on iOS */
    -webkit-overflow-scrolling: touch;

}
#titulo3 a:link {
	color:#000;
	text-decoration:none;
	font-weight:300;
}
#titulo3 a:active {
	color:#000;
	text-decoration:none;
	font-weight:300;
}
#titulo3 a:visited {
	text-decoration: none;
	color: #000;
	font-weight:300;
}
#titulo3 a:hover {
	text-decoration:underline;
	font-weight:300;
}
#menuinside2 a:link {

width:100%;
display:block;
background-image:url(../images/menuback.jpg); 
background-repeat:repeat-x;
float:left;
-webkit-tap-highlight-color:#FB7B00;
-webkit-text-fill-color: #fff;

}
#menuinside2 a:hover {

width:100%;
display:block;
background-image:url(../images/menuback.jpg); 
background-repeat:repeat-x;
float:left;

}
#menuinside2 a:active {

width:100%;
display:block;
background-image:url(../images/menuback.jpg); 
background-repeat:repeat-x;
float:left;

}
#menuinside2 a:focus {

width:100%;
display:block;
background-image:url(../images/menuback.jpg); 
background-repeat:repeat-x;
float:left;

}
#menuinside2 a:visited {

width:100%;
display:block;
background-image:url(../images/menuback.jpg); 
background-repeat:repeat-x;
float:left;

}
#barrasuperior a:link {

display:block;
background-color:#0B4E87;
background-image: none;

}
#barrasuperior a:active {

display:block;
background-color:#0B4E87;
background-image: none;

}
#barrasuperior a:hover {

display:block;
background-color:#0B4E87;
background-image: none;

}
#barrasuperior a:visited {
display:block;
background-color:#0B4E87;
background-image: none;

}
#logo2 {
	width:178px;
	height:45px;
	float:left; 
	margin-left:3%;
	margin-top:25px;
	background-image:url(../images/logohorizontal.png);	
	background-size: 178px 45px;
}
#mail {

width:220px; 

}

#contacto2 {

margin-left:0px;

}

.inputname {

width:100%; 

}

#inputname2 {

 margin-left:0px;
 margin-top:20px;

}
#ventana {
	width:150px;
	height:120px;
	top:50%;
	left:50%;
	margin-top:-80px;
	margin-left:-95px;
	font-size:16px;
}
#comentarios {

margin-left:4px;

}
#enviar {

margin-left:4px;

}
#inputenviar {
margin-top:0px;
margin-left:0px;
}
#cam a:link {

background-image:url(../images/cam.png?id=<?php echo $time; ?>);
background-position: 0px 0px;
background-size:50px 100px;
display:block;
height:50px;

}
#nom a:link {

color:#333;
text-decoration:none;

}
#nom a:active {

color:#333;
text-decoration:none;

}
#nom a:visited {

color:#333;
text-decoration:none;

}
#enviar2 {
transition: all .3s ease;
width:130px; text-align:center; height:30px; line-height:24px; font-size:16px; color:#FFF; float:left; border:solid 2px #FB9500; background-color:#FB9500; border-radius:3px; -webkit-appearance: none;
}
#enviar2:active {
    transition: all .3s ease;
	background-color:#FB9500;
	color:#fff;
	cursor:pointer;
	border-radius:3px;
	border:solid 2px #FB9500;
}
#modificar a:link {

color:#0B4E87;
text-decoration:none;

}
#modificar a:visited {

color:#0B4E87;
text-decoration:none;

}
#modificar a:active {

color:#0B4E87;
text-decoration:none;

}
#modificar a:hover {

color:#0B4E87;
text-decoration:underline;

}
#enviar4 {
transition: all .3s ease;
width:230px; text-align:center; height:40px; line-height:32px; font-size:16px; color:#FFF; float:left; border:solid 2px #B60104; background-color:#B60104; border-radius:3px; -webkit-appearance: none;
}
#emails a:link {

display:block;
float:left;
color:#0B4E87;
text-decoration:none;
width:100%;

}
#emails a:visited {

display:block;
color:#0B4E87;
text-decoration:none;

}
#emails a:active {

display:block;
color:#0B4E87;
text-decoration:none;

}
.lik1 a:link {

color:#333;
text-decoration:none;

}
.lik1 a:visited {

color:#333;
text-decoration:none;

}
.lik1 a:active {

color:#333;
text-decoration:none;

}
.lik1 a:hover {

color:#333;
text-decoration:underline;

}
#emailres a:link {
background-color:#C9C8C8;
float:left;
text-decoration:none;
}
#emailres a:visited {
background-color:#C9C8C8;
text-decoration:none;
}
#emailres a:active {
background-color:#C9C8C8;
text-decoration:none;
}

-->
</style>
<script type="text/javascript">
 
$(document).ready(function(){
 
 
    $('.show_hide').click(function(){
    
	 $( "#menulateral" ).animate({
    left: "0px"
  }, 'fast' );
	
    });
	
});

</script>
<script>
$('html').bind('touchstart mousedown', function(e){

 if (e.target.id != 'menulateral' && e.target.id != 'show_hide' && e.target.id != 'imagenmovil' && e.target.id != 'inicio' && e.target.id != '' && e.target.id != 'equis') {

$( "#menulateral" ).animate({
    left: "-270px"
  }, 'fast' );
    }
});
</script>
<script>
$('.equis').click(function(){

$( "#menulateral" ).animate({
    left: "-270px"
  }, 'fast' );
});
</script>
<script>
function inicio() {

<?php if ($id_perfil == $id_cliente) { ?>
$(".menumovil2a").show();
$("#menumovil2").hide();
$("#form1").hide();
$("#reportes").html("");
inbox();
<?php } ?>
$("#menumovil1").show();
$(".menumovil1a").hide();
$("#menumovil3").hide();
$(".menumovil3a").show();
$("#menumovil4").hide();
$(".menumovil4a").show();
$("#favoritas").show();
$("#mensajes").hide();
$("#reportes").hide();

}
</script>
<script>
function editar() {

<?php if ($id_perfil == $id_cliente) { ?>
$(".menumovil2a").hide();
$("#menumovil2").show();
$("#form1").show();
$("#reportes").html("");
inbox();
<?php } ?>
$("#menumovil1").hide();
$(".menumovil1a").show();
$("#menumovil3").hide();
$(".menumovil3a").show();
$("#menumovil4").hide();
$(".menumovil4a").show();
$("#favoritas").hide();
$("#mensajes").hide();
$("#reportes").hide();

}
</script>
<script>
function mensajes() {

<?php if ($id_perfil == $id_cliente) { ?>
$(".menumovil2a").show();
$("#menumovil2").hide();
$("#form1").hide();
document.getElementById("form1").reset();
$("#inboxwrapp").load("mensajesmovil.php");
$("#reportes").html("");
<?php } ?>
$("#menumovil1").hide();
$(".menumovil1a").show();
$("#menumovil3").show();
$(".menumovil3a").hide();
$("#menumovil4").hide();
$(".menumovil4a").show();
$("#favoritas").hide();
$("#mensajes").show();
$("#reportes").hide();

}
</script>
<script>
function reportes() {

<?php if ($id_perfil == $id_cliente) { ?>
$(".menumovil2a").show();
$("#menumovil2").hide();
$("#form1").hide();
inbox();
$("#reportes").load("reportesmovil.php");
<?php } ?>
$("#menumovil1").hide();
$(".menumovil1a").show();
$("#menumovil3").hide();
$(".menumovil3a").show();
$("#menumovil4").show();
$(".menumovil4a").hide();
$("#favoritas").hide();
$("#mensajes").hide();
$("#reportes").show();

}
</script>
<script>
function direccion(esto) {
	var bot = esto.value;
    $("#agregardireccion").toggle();
	if (bot == "Agregar") {
	
	esto.value = "Cerrar";
	} else {
	esto.value = "Agregar";
	document.getElementById("form1").reset();
	}
	}
</script>
<script>

function enviados() {

$("#inboxwrapp").load("enviadosmovil.php");
$("#lik1").hide();
$("#lik1a").show();
$("#lik2").show();
$("#lik2a").hide();
$("#lik3a").hide();

}

</script>
<script>

function inbox() {

$("#inboxwrapp").load("mensajesmovil.php");
$("#lik1a").hide();
$("#lik1").show();
$("#lik2a").show();
$("#lik2").hide();
$("#lik3a").hide();

}

</script>
<script>

function responder(id) {

$("#pantalla").show();

var doStuff8 = function () {
var form_data = new FormData();
form_data.append('id', id);

$.ajax({
	url : "mensaje2.php",
	type: "POST",
	data : form_data,
	contentType: false,
	cache: false,
	dataType: 'json',
	processData:false,
	mimeType:"multipart/form-data"
}).done(function(res) { //

if (res.mensaje1 == "completo") {

$('#idperfil').val(res.idperfil)
$("#inboxwrapp").html('<div id="titulo11" align="left" style="width:90%; margin-left:4%; height:30px; line-height:30px; font-size:14px; font-weight:bold; color:#333; margin-top:30px;">Respondiendo a '+res.respondiendo+'</div><input type="text" id="asunto" name="asunto" style="width:90%; margin-left:4%; border:#777 solid 1px; padding-left:1%; float:left; height:30px; line-height:30px; margin-top:10px;" placeholder="Asunto" value="'+res.asunto+'" /><div contenteditable="true" align="left" id="cuerpomensaje1" name="cuerpomensaje1" style="width:90%; padding:1%; float:left; margin-left:4%; margin-top:5px; height:300px; overflow-y:scroll; overfow-x:hidden; background-color:#fff; border:solid 1px #777;"><div contenteditable="true" align="left" id="cuerpomensaje" name="cuerpomensaje" style="width:100%;"><p>'+res.cuerpo+'</p></div></div><div id="nombre" align="center" style="width:100%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:30px;"><div id="centrar" align="center" style="width:160px; margin-left:auto; margin-right:auto;"><input type="button" id="enviar2" name="enviar2" value="Enviar" onclick="javascript:enviarmensaje1();" style="width:150px;" /></div></div>');
$('#cuerpomensaje1').focus();
$("#pantalla").hide();

} else {

alert(res.mensaje2);
$("#pantalla").hide();

}
		
});

};

setTimeout(doStuff8, 2000);

}

</script>
<script>

function mensaje(id, seccion) {

$("#inboxwrapp").load("mensaje1movil.php?id="+id+"&s="+seccion);
$("#lik1a").show();
$("#lik1").hide();
$("#lik2a").show();
$("#lik2").hide();
$("#lik3a").hide();

}

</script>
<script>
$(document).ready(function(){ 

var alto = $(window).height();
var ancho = $(window).width();

alto = parseInt(alto,10) + parseInt(60,10);

$('#pantalla').height(alto);
$('#pantalla').width(ancho);

});

</script>
</head>
<body leftmargin="auto" rightmargin="auto" topmargin="0" marginwidth="0" marginheight="0" align="center">
<div id="pantalla" style="position:fixed; z-index:4; display:none;">

<div id="oscuro2" style="width:100%; height:100%; position:absolute; background-color:#000; opacity:0.5; top:0px; left:0px; z-index:1;"></div> 
      
      <div id="loading15" style="width:20%; margin-left:-10%; margin-top:-10%; left:50%; position:absolute; top:50%; z-index:2; background-color: rgba(229,0,0,0);"><img src="../images/loading_apple.gif" border="0" width="100%" /></div>
      
      
</div> 
<div id="wrapper" style="width:100%; height:480px; position:relative;">

<div id="menumovil" class="movil" style="width:40px; height:29px; position:absolute; top:25px; left:5px; z-index:1;">
<a href="javascript:void(0);" id="show_hide" class="show_hide"><img src="../images/menumovil.png" height="29" id="imagenmovil" /></a>
</div>

<div id="menulateral" style="width:250px; height:100%; position:fixed; top:0px; left:-270px; background-color:#353535; z-index:9999; box-shadow: 0 10px 6px 6px #000;">

 <div id="menuinside2" class="menuinside2">

<div id="barrasuperior" style="width:100%; height:50px; float:left;">
<a href="javascript:void(0);" class="equis" style="text-decoration:none; float:left;"><div id="equis22" style="height:50px; line-height:50px; float:left; font-size:14px; font-weight:bold; color:#fff; margin-left:20px;">Cerrar X</div></a>

</div>

 <a href="/"><div id="inicio" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden;">
 
 <div id="home" style="width:26px; height:20px; float:left; margin-left:20px; margin-top:15px;"><img src="../images/home.png" height="20" /></div>
 
 <div id="equis" align="left" style="height:50px; float:left; line-height:50px; font-size:16px; color:#fff; margin-left:10px;">Inicio</div>

 </div></a>
 
 <div id="linea" style="width:100%; height:1px; background-color:#171717; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#434343; margin-top:0px; float:left;"></div>
 
 <a href="/acercade">
 <div id="inicio" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden;">
 
   <div id="home" style="width:26px; height:20px; float:left; margin-left:20px; margin-top:15px;"><img src="../images/acercade.png" height="20" /></div>
 
 <div id="equis" align="left" style="height:50px; float:left; line-height:50px; font-size:16px; font-weight:100; color:#fff; margin-left:10px;">Acerca de</div>
 
 </div>
 </a>
 
 <div id="linea" style="width:100%; height:1px; background-color:#171717; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#434343; margin-top:0px; float:left;"></div>
 
  <a href="/preguntasfrecuentes"><div id="inicio" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden;">
 
   <div id="home" style="width:26px; height:20px; float:left; margin-left:20px; margin-top:15px;"><img src="../images/faq.png" height="20" /></div>
 
 <div id="equis" align="left" style="height:50px; float:left; line-height:50px; font-size:16px; font-weight:100; color:#fff; margin-left:10px;">Preguntas frecuentes</div>
 
 </div>
 </a>
 
 <div id="linea" style="width:100%; height:1px; background-color:#171717; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#434343; margin-top:0px; float:left;"></div>
 
 <a href="/contacto">
<div id="inicio" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden;">
 
   <div id="home" style="width:26px; height:14px; float:left; margin-left:20px; margin-top:18px;"><img src="../images/contacto.png" height="14" /></div>
 
 <div id="equis" align="left" style="height:50px; float:left; line-height:50px; font-size:16px; font-weight:100; color:#fff; margin-left:10px;">Contacto</div>
 
 </div>
</a>

<div id="linea" style="width:100%; height:1px; background-color:#171717; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#434343; margin-top:0px; float:left;"></div>
 
  <a href="/ayuda" class="menulink"><div id="inicio" style="float:left; width:100%; height:50px; line-height:50px; overflow:hidden;">
 
   <div id="home" style="width:26px; height:20px; float:left; margin-left:20px; margin-top:15px;"><img src="../images/ayuda.png" height="20" /></div>
 
 <div id="equis" align="left" style="height:50px; float:left; line-height:50px; font-size:16px; font-weight:100; color:#fff; margin-left:10px;">Ayuda</div>
 
 </div>
 </a>
 
 <div id="linea" style="width:100%; height:1px; background-color:#171717; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#434343; margin-top:0px; float:left;"></div>
   
   <div id="inicio" style="float:left; width:100%; height:30px; line-height:30px; overflow:hidden;">
 
   <div id="home" style="width:26px; height:12px; float:left; margin-left:20px; margin-top:9px;"><img src="../images/categorias.png" height="12" /></div>
 
 <div id="equis" align="left" style="height:30px; float:left; line-height:30px; font-size:13px; font-weight:bold; color:#fff; margin-left:10px;">CATEGORÍAS</div>
 
 </div>
 
 <div id="linea" style="width:100%; height:1px; background-color:#171717; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#434343; margin-top:0px; float:left;"></div>
   
   <?php if ($totalRows_Recordset5 > 0) { ?>
   
   <?php do { ?>
<a href="/productos/<?php echo $row_Recordset5['link']; ?>"><div id="inicio" style="float:left; width:100%;overflow:hidden; display:flex; flex-direction:row;">
 
   <div id="home" style="width:26px; height:20px; float:left; flex:0; margin-left:10px; margin-top:20px;"><img src="../images/pointer2.png" height="8" /></div>
 
 <div id="equis" align="left" style="width: auto; flex:1; margin-top:12px; margin-bottom:12px; line-height:24px; font-size:16px; font-weight:100; color:#fff; padding-right:5px; margin-left:10px; float:left;"><?php echo ucfirst($row_Recordset5['categoria']); ?></div>
 
 </div>
 </a>
 
 <div id="linea" style="width:100%; height:1px; background-color:#171717; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#434343; margin-top:0px; float:left;"></div>
   <?php } while ($row_Recordset5 = mysql_fetch_assoc($Recordset5));  ?>
   
   <?php } ?>
   
   </div>

</div>

<div id="header1">

 <div id="headerizquierda" class="headerinside">
 
  <a href="/"><div id="logo">
   
  </div></a><!--Termina logo-->
  
  <div id="right" style="width:100%;">
  
  <form id="buscador" name="buscador" action="../buscar.php" method="post" onsubmit="return(valida_envia())">
   
     <div id="buscadortext">
     
     <input type="text" id="buscar" name="buscar" value="" placeholder="Buscar productos o tiendas" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
     
     </div><!--Termina buscador text-->
     
     <div id="search"><input type="submit" class="submit" value=""></div>
   
   </form><!--Termina buscador-->
   
   </div>
  
 </div><!--Termina headerizquierda-->
 
 </div><!--Termina header1-->
 
   <div id="menuusuario" align="center" style="width:90%; height:60px; float:left; line-height:20px; font-size:12px; margin-left:5%; margin-top:15px;">
   
   <div id="menuinside" style="display: table; margin: 0 auto;">
  
      <div id="link4" class="link" style="width:55px; height:60px; float:right; position:relative; overflow:hidden;"><a href="/compra">
      
      <div id="circulo" style="width:20px; height:20px; position:absolute; top:5px; right:7px;">
   
   <div id="circuloinside" align="center" style="width:17px; height:17px; overflow:hidden; background-color:#4168A8; border:3px solid #fff; color:#fff; text-align:center; font-size:12px; line-height:17px; font-weight:bold; border-radius:13px;<?php if ($productos == 0) { ?> display:none;<?php } ?>"><?php echo $productos; ?></div>
   
   </div>
    
    <div id="titulolink1" class="link" align="center" style="width:100%; color:#333; position:absolute; bottom:0px; left:0px; height:20px; line-height:20px;">Carrito</div>
    
    </a></div>
    
    <div id="linea" style="width:1px; background-color:#ccc; float:right; margin-right:7px; margin-left:7px; height:42px; margin-top:7px;"></div>
    
    <?php if ($row_Recordset1['nombre'] != '') { ?>
    <div id="link3" class="link" style="width:55px; height:60px; float:right; position:relative; overflow:hidden;"><a href="../index.php?id=logout">
    
    <div id="titulolink1" align="center" style="width:100%; color:#333; position:absolute; bottom:0px; left:0px; height:20px; line-height:20px; font-size:11px;">Salir</div>
    
    </a></div>
    
    <div id="linea" style="width:1px; background-color:#ccc; float:right; margin-right:7px; margin-left:7px; height:42px; margin-top:7px;"></div>
    
    <div id="link2" class="link" style="width:55px; height:60px; float:right; position:relative; overflow:hidden;"><a href="/perfil">
    
    <div id="titulolink1" align="center" style="width:100%; color:#333; position:absolute; bottom:0px; left:0px; height:20px; line-height:20px; font-size:11px;">Mi perfil</div>
    
    </a></div>
    
    
    <div id="linea" style="width:1px; background-color:#ccc; float:right; margin-right:7px; margin-left:7px; height:42px; margin-top:7px;"></div>
    
    <div id="link1" class="link" align="center" style="width:55px; height:60px; float:right; position:relative; overflow:hidden;"><a href="/tienda">
    
    <div id="titulolink1" align="center" style="width:100%; color:#333; position:absolute; bottom:0px; left:0px; height:20px; line-height:20px; font-size:11px;">Mi tienda</div>
    
    </a></div>
  <?php } else { ?>
     
     <div id="link5" class="link" style="width:55px; height:60px; float:right; position:relative; overflow:hidden;"><a href="/vender">
    
    <div id="titulolink1" class="link" align="center" style="width:100%; color:#333; position:absolute; bottom:0px; left:0px; height:20px; line-height:20px; font-size:11px;">Vende</div>
    
    </a></div>
     
     <?php } ?>
   
     </div>
     
     </div>
     
     <div id="linea" style="width:100%; float:left; background-color:#CCCCCC; height:1px;margin-top:20px;"></div>
     
     <div id="right" style="float:left; width:100%; background-color:#F3F3F1;">
     
     <div id="registra" align="left" style="width:100%; float:left;">
    
    <?php if ($usuarioemail != "") { ?>
  
    <div id="logincategorias" style="width:100%; padding-bottom:20px; float:left; background-color:#0B4E87; overflow:hidden; position:relative;">
    
    <div id="fotowrapp" style="margin-left:25%; width:50%; padding-bottom:50%; float:left; margin-top:20px; position:relative;">
    
<?php if ($foto != '') { 
   $img = "usuarios/".$foto;
 } else { 
	  
	  $img = "silueta". $sexo1 ."500.jpg";
	  
} ?>
    
      <div id="foto" align="center" style="width:100%; height:100%; border:solid 10px #416BAE; overflow:hidden; border-radius:50%; float:left; background-color:#000; position:absolute; background-image:url(../images/<?php echo $img; ?>); background-size:cover;">
      
      <div id="oscuro" style="width:100%; height:100%; position:absolute; background-color:#000; opacity:0.5; top:0px; left:0px; z-index:1; display:none;"></div> 
      
      <div id="loading14" style="width:50%; left:25%; position:absolute; top:25%; z-index:0; background-color: rgba(229,0,0,0); display:none;"><img src="../images/loading3.gif" border="0" width="100%" /></div>
    
      </div>
      <input type="hidden" id="idcliente" name="idcliente" value="<?php echo $id_cliente; ?>">
      <input type="hidden" id="idperfil" name="idperfil" value="<?php echo $id_perfil; ?>">
      
      <?php if ($id_perfil == $id_cliente) { ?>
      
      <div id="cam" style="width:50px; height:50px; position:absolute; bottom:-25px; right:-40px;"><a href="javascript:void(0);" onclick="document.getElementById('foto1').click();"></a></div>
      
      <input type="file" id="foto1" name="foto1" style="display:none" onchange="return checkFile();" accept="image/jpg, image/jpeg" />
      
      <input type="hidden" id="cambiofoto" name="cambiofoto" value="<?php echo $cambiofoto; ?>">
      
      <?php } ?>
      
     </div>
     
      <?php if ($totalRows_Recordset2 == 0) { ?>
      <div id="nombreper" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; padding-left:5%; color:#7FA0E7; margin-top:40px; font-weight:bold;">Este perfil no existe o el usuario está suspendido</div>
      <?php } ?>
      
      <?php if ($id_perfil != '') { ?>
      <div id="nombreper" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; padding-left:5%; color:#7FA0E7; margin-top:40px; font-weight:bold;"><?php echo strtoupper($nombreperfil); ?></div>
      
      <?php if ($empleo != '') { ?>
      <div id="nombreper" align="center" style="width:90%; float:left; font-size:18px; line-height:25px; padding-left:5%; color:#7FA0E7; margin-top:10px; font-weight:300;"><?php echo strtoupper($empleo); ?></div>
      <?php } ?>
      
      <?php if ($ciudad != '') { ?>
      <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; padding-left:5%; color:#7FA0E7; text-align:center;">
    
    <div id="menuinside" style="display: table; margin: 0 auto;">
    
    <div id="clock" style="width:15px; height:15px; margin-top:5px; float:left;"><img src="../images/location.png" width="15" /></div>

    <div id="texto" align="left" style="line-height:20px; font-size:14px; float:left; margin-left:5px; margin-top:5px;"><?php echo $ciudad; ?></div>
    
    </div>
    
    </div>
    <?php } ?>
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; padding-left:5%; color:#7FA0E7; text-align:center;">
    
    <div id="menuinside" style="display: table; margin: 0 auto;">
    
    <div id="clock" style="width:15px; height:15px; margin-top:8px; float:left;"><img src="../images/clock.png" width="15" /></div>
    <?php
	
	$fechadesde = $row_Recordset2['fecha'];
	
	$dia = date("j", $fechadesde);
	$mes = date("m", $fechadesde);
	$ano = date("Y", $fechadesde);
	
	if ($mes == "01") $mes1 = "ene";
	else if ($mes == "02") $mes1 = "feb";
	else if ($mes == "03") $mes1 = "mar";
	else if ($mes == "04") $mes1 = "abr";
	else if ($mes == "05") $mes1 = "may";
	else if ($mes == "06") $mes1 = "jun";
	else if ($mes == "07") $mes1 = "jul";
	else if ($mes == "08") $mes1 = "ago";
	else if ($mes == "09") $mes1 = "sept";
	else if ($mes == "10") $mes1 = "oct";
	else if ($mes == "11") $mes1 = "nov";
	else if ($mes == "12") $mes1 = "dic";
	
	?>
    <div id="texto" align="left" style="line-height:20px; font-size:14px; float:left; margin-left:5px; margin-top:5px;"><?php if ($id_cliente == $id_perfil) { ?>Te uniste<?php } else { ?>Se unió<?php } ?> el <?php echo $dia; ?> de <?php echo $mes1; ?> de <?php echo $ano; ?></div>
    
    </div>
    
    </div>
    <?php } ?>
      
      </div>  <!--Termina cuadro azul-->
      <?php if ($id_perfil != '') { ?>
      <div id="menumovil" style="width:100%; float:left; background-color:#F4F4F4;">
      <?php if ($id_cliente == $id_perfil) { ?>
      <div id="menumovil1" style="width:calc(25% - 2px); height:70px; float:left; border:solid 1px #3D3D3D; position:relative; background-color:#3D3D3D;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:15px;"><img src="../images/home.png" width="30" />
         
         <div id="titulo" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#fff; margin-top:5px;">Inicio</div>
         
         </div>
         
         </div>
         
         <a href="javascript:inicio();" class="menumovil1a"><div id="menumovil1a" class="menumovil1a" style="width:calc(25% - 2px); height:70px; float:left; border:solid 1px #E2E2E2; position:relative; display:none;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:15px;"><img src="../images/homemovil.png" width="30" />
         
         <div id="titulo" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#3D3D3D; margin-top:5px;">Inicio</div>
         
         </div>
         
         </div></a>
      
       <a href="javascript:editar();" class="menumovil2a"><div id="menumovil2a" class="menumovil2a" style="width:calc(25% - 2px); height:70px; float:left; border:solid 1px #E2E2E2; position:relative;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:10px;"><img src="../images/editmovil.png" width="30"/>
         
         <div id="titulo" align="center" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#3D3D3D; margin-top:5px;">Editar</div>
         
         </div>
         
         </div></a>
         
         <div id="menumovil2" style="width:calc(25% - 2px); height:70px; float:left; border:solid 1px #3D3D3D; position:relative; background-color:#3D3D3D; display:none;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:10px;"><img src="../images/editmovil1.png" width="30"/>
         
         <div id="titulo" align="center" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#fff; margin-top:5px;">Editar</div>
         
         </div>
         
         </div>
         
         <a href="javascript:mensajes();" class="menumovil3a"><div id="menumovil3a" class="menumovil13a" style="width:calc(25% - 2px); height:70px; float:left; border:solid 1px #E2E2E2; position:relative;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:15px;"><img src="../images/contactomovil.png" width="30" />
         
         <div id="titulo" align="center" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#3D3D3D; margin-top:7px;">Mensajes</div>
         
         </div>
         
         </div></a>
         
         <div id="menumovil3" class="menumovil13" style="width:calc(25% - 2px); height:70px; float:left; border:solid 1px #3D3D3D; position:relative; background-color:#3D3D3D; display:none;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:15px;"><img src="../images/contacto.png" width="30" />
         
         <div id="titulo" align="center" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#fff; margin-top:7px;">Mensajes</div>
         
         </div>
         
         </div>
         
         <a href="javascript:reportes();" class="menumovil4a"><div id="menumovil4a" class="menumovil4a" style="width:calc(25% - 2px); height:70px; float:left; border:solid 1px #E2E2E2; position:relative;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:10px;"><img src="../images/reportmovil.png" width="25" />
         
         <div id="titulo" align="center" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#3D3D3D; margin-top:5px;">Reportes</div>
         
         </div>
         
         </div></a>
         
         <div id="menumovil4" class="menumovil4" style="width:calc(25% - 2px); height:70px; float:left; border:solid 1px #3D3D3D; background-color:#3D3D3D; position:relative; display:none;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:10px;"><img src="../images/report.png" width="25" />
         
         <div id="titulo" align="center" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#fff; margin-top:5px;">Reportes</div>
         
         </div>
         
         </div>
         <?php } else { ?>
         
         <div id="menumovil1" style="width:calc(34% - 2px); height:70px; float:left; border:solid 1px #3D3D3D; position:relative; background-color:#3D3D3D;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:15px;"><img src="../images/home.png" width="30" />
         
         <div id="titulo" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#fff; margin-top:5px;">Inicio</div>
         
         </div>
         
         </div>
         
         <a href="javascript:inicio();" class="menumovil1a"><div id="menumovil1a" class="menumovil1a" style="width:calc(34% - 2px); height:70px; float:left; border:solid 1px #E2E2E2; position:relative; display:none;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:15px;"><img src="../images/homemovil.png" width="30" />
         
         <div id="titulo" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#3D3D3D; margin-top:5px;">Inicio</div>
         
         </div>
         
         </div></a>
         
         <div id="menumovil3" style="width:calc(33% - 2px); height:70px; float:left; border:solid 1px #3D3D3D; position:relative; background-color:#3D3D3D; display:none;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:15px;"><img src="../images/contacto.png" width="30" />
         
         <div id="titulo" align="center" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#fff; margin-top:7px;">Mensaje</div>
         
         </div>
         
         </div> 
         
         <a href="javascript:mensajes();" class="menumovil3a"><div id="menumovil3a" class="menumovil3a" style="width:calc(33% - 2px); height:70px; float:left; border:solid 1px #E2E2E2; position:relative;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:15px;"><img src="../images/contactomovil.png" width="30" />
         
         <div id="titulo" align="center" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#3D3D3D; margin-top:7px;">Mensaje</div>
         
         </div>
         
         </div></a>
         
         <div id="menumovil4" style="width:calc(33% - 2px); height:70px; float:left; border:solid 1px #3D3D3D; position:relative; background-color:#3D3D3D; display:none;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:10px;"><img src="../images/report.png" width="25" />
         
         <div id="titulo" align="center" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#fff; margin-top:5px;">Reportar</div>
         
         </div>
         
         </div>
         
         <a href="javascript:reportes();" class="menumovil4a"><div id="menumovil4a" class="menumovil4a" style="width:calc(33% - 2px); height:70px; float:left; border:solid 1px #E2E2E2; position:relative;">
         
         <div id="imagen" align="center" style="width:100%; height:50px; float:left; text-align:center; margin-top:10px;"><img src="../images/reportmovil.png" width="25" />
         
         <div id="titulo" align="center" style="width:100%; height:15px; float:left; line-height:15px; font-size:12px; color:#3D3D3D; margin-top:5px;">Reportar</div>
         
         </div>
         
         </div></a>
         
         <?php } ?>
      </div><!--Termina menumovil-->
      <?php } ?>
      <div id="favoritas" style="width:100%; float:left; padding-bottom:40px;">
      
        <?php if ($totalRows_Recordset6 > 0 && $estadotienda == "1") { 
		
		if ($portadatienda == "") $portadatienda = "portada.jpg";
		
		?>
      <div id="tiendamovil" style="width:100%; float:left;">

      <div id="portada" style="float:left; width:100%; background-image:url(../images/portadas/<?php echo $portadatienda; ?>); background-repeat:no-repeat; background-position:top left; background-size:100%; position:relative; margin-top:0px;">
      <img src="../images/portadas/<?php echo $portadatienda; ?>" width="100%" style="float:left; visibility:hidden; margin-bottom:70px;" />
      
      <div id="titulos" style="width:100%; position:absolute; top:100%; margin-top:-126px; left:10px; height:112px;">
      <div id="silueta" style="height:102px; float:left; overflow:hidden; background-color:#fff; border:solid 5px #fff;"><a href="/tienda/<?php  echo $linktienda; ?>"><img src="<?php if ($logotienda != '') { ?>../images/logotipos/<?php echo $logotienda; ?><?php } else { ?>../images/logotienda.png<?php } ?>" height="100" style="border:1px solid #ccc;" /></a></div>
    
    <div id="nombreper" align="left" style="float:left; display:block; width:auto; overflow:hidden; color:#3D3D3D; margin-top:65px; font-weight:bold; margin-left:10px; height:40px;">
    
    <div id="nom" style="line-height:25px; width:100%; font-size:20px; overflow:hidden; float:left; height:25px;"><a href="/tienda/<?php echo $linktienda; ?>"><?php echo $nombretienda ?></a></div>
    
    <div id="nombreper" align="left" style="float:left; width:100%; font-size:15px; height:15px; overflow:hidden; line-height:15px; color:#3D3D3D; margin-top:0px; font-weight:300;">Tienda</div>
    
    </div><!--Termina nombreper-->
    
    </div><!--Termina titulos-->
      
      </div><!--Termina portada-->
      
      </div><!--Termina tiendamovil-->
      
      <?php } ?>
      
      <?php if ($id_cliente == $id_perfil) { ?>
    <div id="titulo" style="width:96%; float:left; margin-left:2%; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px;">MIS COMPRAS (<?php echo $totalRows_Recordset5a; ?>)</div>
    
    <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:5px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
   
   <div id="titulo" style="width:96%; float:left; margin-left:2%; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-bottom:20px;">
   <?php if ($totalRows_Recordset5a > 0) { ?>
   
   <?php } else { ?>
   No tienes compras aún
   <?php } ?>
   
   </div>
   
    <?php } ?>
    <div id="titulo" style="width:96%; float:left; margin-left:2%; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px;">PRODUCTOS FAVORITOS (<?php echo $totalRows_Recordset3; ?>)</div>
    
    <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:5px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
   
   <?php if ($totalRows_Recordset3 > 0) { ?>
   
   <?php do { ?>
   <?php 
   
 $nombreproducto = stripslashes(stripslashes($row_Recordset3['nombre']));

$foto1 = "";
  if ($row_Recordset3['foto1'] != '') $foto1 = $row_Recordset3['foto1'];
  else if ($row_Recordset3['foto2'] != '') $foto1 = $row_Recordset3['foto2'];
  else if ($row_Recordset3['foto3'] != '') $foto1 = $row_Recordset3['foto3'];
  else if ($row_Recordset3['foto4'] != '') $foto1 = $row_Recordset3['foto4'];
  else if ($row_Recordset3['foto5'] != '') $foto1 = $row_Recordset3['foto5'];
  
  if ($foto1 == "") $foto = "fotoproducto.jpg";
  else if ($foto1 != '') $foto = $foto1;


$link = $row_Recordset3['link'];
$linktienda = $row_Recordset3['linktienda'];


$medida = 'width="100%"';

if ($foto != "fotoproducto.jpg") { 
	
  $size = getimagesize( "../images/productos/".$foto );
  $ratio = $size[0]/$size[1];
  $width1 = $size[0];
  $height1 = $size[1];
   
   if ($width1 >= $height1) {		   
	 $medida = 'height="100%"';
	} 
	
}

	
	?>
    <div id="fotothumb" class="foto2" style="float:left; width:calc(25% - 12px); overflow:hidden; padding-bottom:calc(20% + 35px); position:relative; margin-top:10px; margin-left:10px;">
    
    <a href="/tienda/<?php echo $linktienda ?>/<?php echo $link; ?>" style="width:calc(100% - 4px); height:calc(100% - 39px); position:absolute; top:0px; left:0px; overflow:hidden; z-index:2; border:#000 solid 2px;">
    <img src="../images/productos/<?php echo $foto; ?>" <?php echo $medida; ?> style="float:left;" />
    </a>
    
    <div id="nombretienda" align="center" style="width:100%; height:30px; line-height:15px; color:#333; font-size:12px; font-weight:bold; position:absolute; bottom:0px; left:0px;"><?php echo $row_Recordset3['nombre']; ?></div>
    
    </div>
   
   <?php } while($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
   
   <?php } else { ?>
   
   <div id="titulo" style="width:96%; float:left; margin-left:2%; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px;">No tiene<?php if ($id_cliente == $id_perfil) { ?>s<?php } ?> productos favoritos aún</div>
   
   <?php } ?>
   
   <div id="titulo" style="width:96%; float:left; margin-left:2%; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:30px;">TIENDAS FAVORITAS (<?php echo $totalRows_Recordset4; ?>)</div>
    
    <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:5px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
   
   <?php if ($totalRows_Recordset4 > 0) { ?>
   
   <?php do { ?>
   <?php 
   
 $nombretienda = stripslashes(stripslashes($row_Recordset4['nombre']));
$logotienda = $row_Recordset4['logo'];
if ($logotienda == "") $logopublicado = "logoim.jpg";
else if ($logotienda != "") $logopublicado = "logotipos/".$logotienda;
$linktienda = $row_Recordset4['link'];
$medida = 'width="100%"';

  if ($logotienda != '') {
  
  list($width, $height, $type, $attr) = getimagesize("../images/logotipos/".$logotienda);
		$fn = "../images/logotipos/".$logotienda;
		 $size = getimagesize( $fn );
        $ratio = $size[0]/$size[1]; // width/height
		$width1 = $size[0];
		$height1 = $size[1];
		$completados = $completados + 1;
			
if ($width1 < $height1) {

$medida = 'height="100%"';

} 
  
  } else {
	
  $logotienda = "logotienda.jpg";  
   
  }

	
	?>
    <div id="fotothumb" class="foto2" style="float:left; width:calc(25% - 12px); overflow:hidden; padding-bottom:calc(20% + 35px); position:relative; margin-top:10px; margin-left:10px;">
    
    <a href="/tienda/<?php echo $row_Recordset4['link']; ?>" style="width:calc(100% - 4px); height:calc(100% - 39px); position:absolute; top:0px; left:0px; overflow:hidden; z-index:2; border:#000 solid 2px;">
    <img src="../images/<?php echo $logopublicado; ?>" <?php echo $medida; ?> style="float:left;" />
    </a>
    
    <div id="nombretienda" align="center" style="width:100%; height:30px; line-height:15px; color:#333; font-size:12px; font-weight:bold; position:absolute; bottom:0px; left:0px;"><?php echo $row_Recordset4['nombre']; ?></div>
    
    </div>
   
   <?php } while($row_Recordset4 = mysql_fetch_assoc($Recordset4)); ?>
   
   <?php } else { ?>
   
   <div id="titulo" style="width:96%; float:left; margin-left:2%; height:20px; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-bottom:30px;">No tiene<?php if ($id_cliente == $id_perfil) { ?>s<?php } ?> tiendas favoritas aún</div>
   
   <?php } ?>
      
      </div><!--Termina favoritas-->
      <?php if ($id_perfil == $id_cliente) { ?>
      <form id="form1" name="form1" style="width:100%; float:left; min-height:200px; display:none; padding-bottom:40px;">
      
      <div id="titulo" style="width:96%; float:left; height:20px; line-height:20px; font-size:18px; font-weight:bold; color:#0B4E87; margin-top:20px; margin-left:2%;">DIRECCIONES</div>
    
    <div id="titulo" style="width:96%; float:left; line-height:16px; font-size:14px; font-weight:300; color:#0B4E87; margin-left:2%; margin-top:5px;">Direcciones para entrega de tus pedidos. No se muestra publicamente más que al vendedor.</div>
    
    <?php if ($totalRows_Recordset7 == 0) { ?>
   <div id="titulo" style="width:96%; float:left; line-height:16px; font-size:14px; font-weight:300; color:#0B4E87; margin-left:2%; margin-top:10px;">No tienes direcciones agregadas.</div>
   <?php } else { ?>
   <div id="direc2" style="float:left; margin-left:2%; width:94%; margin-right:2%; display:block;">
   <?php do { ?>
   <div id="direccion<?php echo $row_Recordset7['id']; ?>" style="float:left; margin-right:10px; line-height:18px; font-size:14px; color:#0B4E87; width:96%; margin-top:10px; border:solid 1px #0B4E87; padding:10px; border-radius:7px; position:relative; padding-bottom:20px;">
      <?php if ($row_Recordset7['nombre'] != '') { ?>
   <strong>Nombre:</strong> <?php echo $row_Recordset7['nombre']; ?><br/>
   <?php } ?>
   <?php if ($row_Recordset7['email'] != '') { ?>
   <strong>Email:</strong> <?php echo $row_Recordset7['email']; ?><br/>
   <?php } ?>
   <strong>Calle y número:</strong> <?php echo $row_Recordset7['calle']; ?> No. <?php echo $row_Recordset7['numero']; ?><?php if ($row_Recordset7['interior'] != '') { ?> <strong>Int.</strong> <?php echo $row_Recordset7['interior']; ?><?php } ?><br/>
   <strong>Colonia:</strong> <?php echo $row_Recordset7['colonia']; ?><br/>
   <strong>Código postal:</strong> <?php echo $row_Recordset7['cp']; ?><br/>
   <strong>Ciudad y estado:</strong> <?php echo $row_Recordset7['ciudad']; ?>, <?php echo $row_Recordset7['estado']; ?>
   <br/><br/>
   
   <div id="botones" style="width:100%; position:absolute; bottom:5px; left:0px; height:20px; line-height:20px;">
   
   <div id="modificar" align="center" style="width:50%; float:left; height:20px; line-height:20px; color:#0B4E87; font-size:18px;"><a href="javascript:void(0);" onclick="javascript:modificardireccion('<?php echo $row_Recordset7['id']; ?>');">Modificar</a></div>
   
   <div id="modificar" align="center" style="width:50%; float:left; height:20px; line-height:20px; color:#0B4E87; font-size:18px;"><a href="javascript:void(0);" onclick="javascript:eliminardireccion('<?php echo $row_Recordset7['id']; ?>');">Eliminar</a></div>
   
   </div>
   
   </div>
   <?php } while ($row_Recordset7 = mysql_fetch_assoc($Recordset7));  ?>
   </div>
   <?php } ?>
   
   <div id="agregardireccion" style="width:96%; float:left; margin-left:2%; margin-top:10px;">
   
     <div id="direccionround" style="width:94%; padding:10px; float:left; border:solid 1px #0B4E87; border-radius:7px;">
     
     <div id="titulo" style="width:96%; float:left; height:16px; line-height:16px; font-size:11px; font-weight:300; color:#0B4E87;">*Sólo aceptamos direcciones en la República Mexicana.</div>
     
     <input type="text" id="direccionnombre" name="direccionnombre" placeholder="Nombre del destinatario" style="width:65%; float:left; height:25px; line-height:25px; padding-left:10px; padding-right:9px; margin-top:10px; font-size:14px;" />
     
     <input type="text" id="direccionemail" name="direccionemail" placeholder="Email" style="width:65%; float:left; height:25px; line-height:25px; padding-left:10px; padding-right:9px; margin-top:10px; font-size:14px; margin-top:10px;" />
   
     <input type="text" id="calle" name="calle" placeholder="Calle" style="width:65%; float:left; height:25px; line-height:25px; padding-left:10px; padding-right:9px; margin-top:10px; font-size:14px; margin-top:10px;" />
     
     <input type="number" id="numero" name="numero" placeholder="No." style="width:20%; margin-left:10px; float:left; height:25px; line-height:25px; text-align:center; margin-top:10px; font-size:14px;" />
     
     <input type="text" id="interior" name="interior" placeholder="Interior" style="width:25%; float:left; height:25px; line-height:25px; padding-left:10px; margin-top:10px; font-size:14px;" />
     
     <input type="text" id="colonia" name="colonia" placeholder="Colonia" style="width:60%; margin-left:10px; float:left; height:25px; line-height:25px; padding-left:10px; margin-top:10px; font-size:14px;" />
     
     <input type="text" id="cp" name="cp" placeholder="Código postal" style="width:25%; float:left; height:25px; line-height:25px; margin-top:10px; padding-left:10px; font-size:14px;" onkeypress="return isNumberKey(event)" />
     
     <input type="text" id="direccionciudad" name="direccionciudad" placeholder="Ciudad" style="width:60%; margin-left:10px; float:left; height:25px; line-height:25px; padding-left:10px; margin-top:10px; font-size:14px;" />
   
   <div id="cotent" style="float:left; width:100%;">
   <select id="direccionestado" name="direccionestado" class="button_example" style="height:25px; padding-right:10px; margin-top:10px; line-height:25px; float:left; font-size:16px;">
    <option value="Aguascalientes">Aguascalientes</option>
    <option value="Baja California">Baja California Norte</option>
    <option value="Baja California Sur">Baja California Sur</option>
    <option value="Campeche">Campeche</option>
    <option value="Chiapas">Chiapas</option>
    <option value="Chihuahua">Chihuahua</option>
    <option value="Ciudad de México">Ciudad de México</option>
    <option value="Coahuila">Coahuila</option>
    <option value="Colima">Colima</option>
    <option value="Durango">Durango</option>
    <option value="Guanajuato">Guanajuato</option>
    <option value="Guerrero">Guerrero</option>
    <option value="Hidalgo">Hidalgo</option>
    <option value="Estado de México">Estado de México</option>
    <option value="Jalisco">Jalisco</option>
    <option value="Michoacán">Michoacán</option>
    <option value="Morelos">Morelos</option>
    <option value="Nayarit">Nayarit</option>
    <option value="Nuevo León">Nuevo León</option>
    <option value="Oaxaca">Oaxaca</option>
    <option value="Puebla">Puebla</option>
    <option value="Querétaro">Querétaro</option>
    <option value="Quintana Roo">Quintana Roo</option>
    <option value="San Luís Potosí">San Luís Potosí</option>
    <option value="Sinaloa">Sinaloa</option>
    <option value="Sonora">Sonora</option>
    <option value="Tabasco">Tabasco</option>
    <option value="Tamaulipas">Tamaulipas</option>
    <option value="Tlaxcala">Tlaxcala</option>
    <option value="Veracruz">Veracruz</option>
    <option value="Yucatán">Yucatán</option>
    <option value="Zacatecas">Zacatecas</option>
    
   </select>
   
   <select id="pais" name="pais" class="button_example" style="height:25px; padding-right:30px; margin-top:10px; line-height:25px; float:left; width: margin-left:10px; font-size:16px;">
    <option value="México">México</option>
   </select>
   
   </div>
   <input type="hidden" id="iddireccion" name="iddireccion" value="">
   <div id="cotent" style="float:left; width:100%;">
   
   <div id="centrar" style="width:164px; margin-left:auto; margin-right:auto;">
   <input type="button" value="Enviar" class="states" onclick="agregardi();" style="width:160px; height:30px; float:left; text-align:center; line-height:20px; color:#FFF; font-size:14px; background-color:#FB9500; border-radius:2px; border:solid 2px #FB9500; vertical-align:middle; -webkit-appearance:button; cursor:pointer; margin-top:10px;">
   </div>
   
   </div>
   
     </div>
   
   </div>
   
   <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:15px; text-align:center; margin-left:2%;">
       <input type="button" class="botonagregar" id="enviar2" name="enviar2" value="Agregar" onclick="javascript:direccion(this);" style="width:150px; -webkit-appearance:button;" />
       </div>
    
    <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
    
    <div id="titulo" style="width:96%; float:left; line-height:20px; font-size:18px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%;">¿EN QUÉ CIUDAD VIVES?</div>
    
     <div id="titulo" style="width:96%; float:left; line-height:20px; font-size:14px; font-weight:300; color:#0B4E87; margin-left:2%; margin-top:5px;">*Sólo agrégala si quieres que se muestre en tu perfil</div>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:14px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%;"><input type="text" id="ciudad" name="ciudad" placeholder="Ciudad y estado" value="<?php echo $ciudad; ?>" style="width:50%; height:30px; line-height:30px; padding-left:10px; font-size:14px;"></div>
    
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:15px; text-align:center; margin-left:2%;">
       <input type="button" id="enviar2" name="enviar2" value="Enviar" onclick="javascript:cambiar('ciudad');" style="width:150px;" />
       </div>
    
    <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
   
   <div id="titulo" style="width:96%; float:left; line-height:20px; font-size:18px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%;">EMPLEO ACTUAL</div>
   
    <div id="titulo" style="width:96%; float:left; line-height:20px; font-size:14px; font-weight:300; color:#0B4E87; margin-left:2%; margin-top:5px;">*Sólo agrégalo si quieres que se muestre en tu perfil</div>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:14px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%;"><input type="text" id="empleo" name="empleo" placeholder="Puesto y/o compañía" value="<?php echo $empleo; ?>" style="width:50%; height:30px; line-height:30px; padding-left:10px; font-size:14px;"></div>
    
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:15px; text-align:center; margin-left:2%;">
       <input type="button" id="enviar2" name="enviar2" value="Enviar" onclick="javascript:cambiar('empleo');" style="width:150px;" />
       </div>
       
       <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
    
    <?php if ($fbid == '') { ?>
    <div id="titulo" style="width:96%; float:left; line-height:20px; font-size:18px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%;">CAMBIAR EMAIL</div>
    
    <div id="titulo" style="width:96%; float:left; line-height:20px; font-size:14px; font-weight:300; color:#0B4E87; margin-left:2%; margin-top:5px;"><strong>Tu email actual es:</strong> <?php echo $email; ?></div>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:5px; margin-left:2%;"><input type="email" id="email" name="email" placeholder="Email nuevo" style="width:50%; height:30px; line-height:30px; padding-left:10px; font-size:14px;"></div>
    
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:15px; text-align:center; margin-left:2%;">
       <input type="button" id="enviar2" name="enviar2" value="Cambiar" onclick="javascript:cambiar('email');" style="width:150px;" />
       </div>
       
       <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
              
       <?php } ?>
       
       <div id="titulo" style="width:96%; float:left; line-height:20px; font-size:18px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%;">EMAIL ALTERNO</div>
    
    <div id="titulo" style="width:96%; line-height:20px; float:left; font-size:14px; font-weight:300; color:#0B4E87; margin-left:2%; margin-top:10px;"><?php if ($emailalterno != '') { ?><strong>Tu email alterno es:</strong> <?php echo $emailalterno; ?><?php } else { ?>No tienes email alterno<?php } ?>. Úsalo en caso de que no puedas usar tu email principal con el que te registraste.</div>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%; margin-top:5px;"><input type="email" id="emailnuevo1" name="emailnuevo1" placeholder="Email nuevo" value="<?php echo $emailalterno; ?>" style="width:50%; height:30px; line-height:30px; padding-left:10px; font-size:14px;"></div>
    
    <div id="titulo" style="width:96%; float:left; line-height:20px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:5px; margin-left:2%;">
    <div id="clock" style="width:20px; height:20px; line-height:20px; margin-top:5px; float:left; margin-right:10px;"><input type="checkbox" id="predeterminado" name="predeterminado" class="predeterminado" value="si"<?php if ($emailalterno == $emailelegido && $emailalterno != '') echo " checked"; ?> style="width:20px; height:20px; float:left;"></div>

    <div id="texto" align="left" style="line-height:18px; width:100%; font-size:14px; margin-top:5px; font-weight:300;">Hacer de éste mi email de correspondencia de Comercenter</div>
    </div>
    
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:15px; text-align:center; margin-left:2%;">
       <input type="button" id="enviar2" name="enviar2" value="<?php if ($emailalterno != '') { ?>Cambiar<?php } else { ?>Agregar<?php } ?>" onclick="javascript:cambiaremail();" style="width:150px;" />
       </div>
       
       <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
    
    <div id="titulo" style="width:96%; float:left; height:20px; line-height:20px; font-size:18px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%;"><?php if ($password != '') { ?>CAMBIAR CONTRASEÑA<?php } else { ?>TU CUENTA NO TIENE CONTRASEÑA, AGREGA UNA<?php } ?></div>
    
    <?php if ($password != '') { ?>
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:14px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%;"><input type="password" id="passwordactual" name="passwordactual" placeholder="Contraseña actual" style="width:50%; height:30px; line-height:30px; padding-left:10px; font-size:14px;"></div>
    <?php } ?>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:14px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%;"><input type="password" id="passwordnuevo" name="passwordnuevo" placeholder="Contraseña nueva" style="width:50%; height:30px; line-height:30px; padding-left:10px; font-size:14px;"></div>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-size:12px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%;"><input type="password" id="repasswordnuevo" name="repasswordnuevo" placeholder="Repite contraseña nueva" style="width:50%; height:30px; line-height:30px; padding-left:10px; font-size:14px;"></div>
    
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:15px; text-align:center; margin-left:2%;">
       <input type="button" id="enviar2" name="enviar2" value="Cambiar" onclick="javascript:cambiarcontrasena();" style="width:150px;" />
       </div>

    
    <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
    
    <div id="titulo" style="width:96%; float:left; height:20px; line-height:20px; font-size:18px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%;">CAMBIAR NOMBRE</div>
    
    <div id="titulo" style="width:96%; float:left; line-height:20px; font-size:14px; font-weight:300; color:#0B4E87; margin-left:2%; margin-top:10px;">*Sólo puedes cambiar tu nombre una vez cada 3 meses</div>
    
    <div id="titulo" style="width:96%; float:left; height:35px; line-height:35px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%;"><input type="text" id="nuevonombre" name="nuevonombre" placeholder="Nuevo nombre" style="width:50%; height:30px; line-height:30px; padding-left:10px; font-size:14px;"></div>
    
    <input type="hidden" id="nombreoriginal" name="nombreoriginal" value="<?php echo $nombreperfil; ?>">
    
    <div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:15px; text-align:center; margin-left:2%;">
       <input type="button" id="enviar2" name="enviar2" value="Cambiar" onclick="javascript:cambiarnombre();" style="width:150px;" />
       </div>
       
       <div id="linea" style="width:100%; height:1px; background-color:#333333; margin-top:20px; float:left;"></div>
   <div id="linea" style="width:100%; height:1px; background-color:#FFFFFF; margin-top:0px; float:left;"></div>
    
    <div id="titulo" style="width:96%; float:left; height:20px; line-height:20px; font-size:18px; font-weight:bold; color:#0B4E87; margin-top:10px; margin-left:2%;">CERRAR TU CUENTA</div>
       
       <div id="titulo" style="width:96%; float:left; line-height:20px; font-size:14px; font-weight:300; color:#0B4E87; margin-left:2%; margin-top:5px;">
    <h1 style="font-size:16px;"> ¿Qué sucede cuando cierras tu cuenta?</h1>
<li>Tu perfil y tu tienda no aparecerán en ningún lugar de Comercenter.</li><br/>

<li>Las personas que intenten ver tu perfil, tu tienda o alguno de tus artículos verán un mensaje de "página no disponible".</li><br/>

<li>Los reportes que hayas enviado se cerrarán.</li><br/>

<li>Puedes volver a abrir tu cuenta cuando quieras.</li><br/>

<li>Para ello, solo tienes que reactivar tu cuenta recuperando tu contraseña en Comercenter cuando quieras volver.</li><br/>
 
<li>También puedes ponerte en contacto con nuestro equipo de asistencia para que te ayuden a reabrir tu cuenta.</li><br/>
 
<li>Nadie podrá usar tu nombre de usuario y la configuración de tu cuenta quedará intacta.</li><br/></div>

<div id="nombre" align="center" style="width:90%; float:left; font-size:20px; line-height:25px; color:#B60104; margin-top:10px; text-align:center; margin-left:2%;">
       <input type="button" id="enviar4" name="enviar4" value="Cerrar cuenta" onclick="javascript:eliminarcuenta();" style="width:200px;" />
       </div>      
      
      </form>
      
      <div id="mensajes" style="width:100%; float:left; min-height:200px; display:none; padding-bottom:40px;">

    <div id="upban" style="width:100%; height:50px; line-height:50px; float:left; background-color:#C9C8C8;">
    
     <div id="lik1" style="padding-left:20px; padding-right:20px; height:50px; float:left; line-height:50px; font-size:#333; font-weight:bold; font-size:18px;">Inbox</div>
     
     <div id="lik1a" class="lik1" style="padding-left:20px; padding-right:20px; height:50px; float:left; line-height:50px; font-size:#333; font-size:18px; display:none;"><a href="javascript:inbox();">Inbox</a></div>
     
     <div id="lik2a" class="lik1" style="padding-left:20px; padding-right:20px; height:50px; float:left; line-height:50px; font-size:#333; font-size:18px;"><a href="javascript:enviados();">Enviados</a></div>
     
     <div id="lik2" style="padding-left:20px; padding-right:20px; height:50px; float:left; line-height:50px; font-size:#333; font-size:18px; display:none; font-weight:bold;">Enviados</div>
     
     <div id="lik3a" class="lik1" style="padding-left:20px; padding-right:20px; height:50px; float:left; line-height:50px; font-size:#333; font-size:18px; display:none;"><a href="javascript:eliminarbox();">Eliminar</a></div>
     
     </div>
     
     <div id="inboxwrapp" style="width:100%; float:left;">
     
     </div>
      
      </div>
      
      <div id="reportes" style="width:100%; float:left; min-height:200px; padding-bottom:30px; display:none;">
      
      
      </div>
      
      <?php } else { ?>
      
      <div id="mensajes" style="width:100%; float:left; display:none; padding-bottom:20px;">
    <div id="titulo11" align="center" style="width:100%; height:30px; line-height:30px; font-size:16px; font-weight:bold; color:#fff; background-color:#20A2B2; margin-top:0px; ">ENVIAR MENSAJE A <?php echo strtoupper($nombreperfil); ?></div>
    
    <div id="recuadro" style="width:96%; float:left; margin-left:2%; margin-top:20px; border:solid 1px #ccc; border-radius:7px; padding-bottom:20px; overflow:hidden;">
    
    <input type="text" id="asunto" name="asunto" style="width:94%; border:#777 solid 1px; padding-left:1%; float:left; height:30px; line-height:30px; margin-top:5px; margin-left:2%;" placeholder="Asunto" />
    
    <textarea id="cuerpomensaje" name="cuerpomensaje" placeholder="Mensaje" style="width:94%; padding:1%; float:left; margin-left:2%; margin-top:5px; resize:none; height:200px;"></textarea>
    
    <div id="nombre" align="center" style="width:100%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:10px; text-align:center;">
       <div id="centrar" align="center" style="width:160px; margin-left:auto; margin-right:auto;">
       <input type="button" id="enviar2" name="enviar2" value="Enviar" onclick="javascript:enviarmensaje();" style="width:150px;" />
       </div>
       </div>


    </div>
    
    
    </div>
    
    <div id="reportes" style="width:100%; float:left; display:none; padding-bottom:20px;">
    <div id="titulo11" align="center" style="width:100%; height:30px; line-height:30px; font-size:16px; font-weight:bold; color:#fff; background-color:#760204; margin-top:0px;">REPORTAR A <?php echo strtoupper($nombreperfil); ?></div>
    
    <div id="recuadro" style="width:96%; float:left; margin-left:2%; margin-top:20px; border:solid 1px #ccc; border-radius:7px; padding-bottom:20px; overflow:hidden; font-size:14px;">
    
    <div style="width:94%; margin-left:2%; float:left; font-size:14px; #333; line-height:20px; margin-top:5px;">
    Platicanos por qué quieres reportar a <?php echo $nombreperfil; ?><br/><br/>
    <span style="font-size:12px;">*No te preocupes, el reporte es anónimo y nadie más se enterará sobre él.<br/><br/>Puedes reportar al usuario por ejemplo por:<br/><li>Acosarte</li>
    <li>Enviar publicidad no solicitada o promociones, solicitudes de donaciones, o mensajes no deseados</li>
<li>Acosar, abusar o violar nuestra Política de uso de la plataforma</li>
<li>Ponerse en contacto contigo después de que le hayas pedido explícitamente que no lo haga</li>
<li>Interferir con una transacción o negocio</li><br/></span>
    </div>
    
    <textarea id="cuerpomensaje1" name="cuerpomensaje1" placeholder="Descripción del reporte" style="width:92%; padding:2%; float:left; margin-top:5px; resize:none; height:200px; margin-left:2%; font-size:14px;"></textarea>
    
    <div id="nombre" align="center" style="width:100%; float:left; font-size:20px; line-height:25px; color:#7FA0E7; margin-top:10px; text-align:center;">
       <div id="centrar" align="center" style="width:160px; margin-left:auto; margin-right:auto;">
       <input type="button" id="enviar2" name="enviar2" value="Enviar" onclick="javascript:enviarreporte();" style="width:150px;" />
       </div>
       </div>
       
      </div>
    
    </div>
      
      <?php } ?>
  
  <?php } else { ?>
     <div id="necesitas" style="width:100%; height:350px; float:left; background-color:#0B4E87;">
     
     <div id="debes" style="height:30px; line-height:30px; float:left; border-bottom:solid #fff 2px; margin-left:5%; color:#fff; margin-top:10px; font-size:20px;">PARA VER ESTA PÁGINA</div>
     
     <div id="loggear" style="width:90%; line-height:35px; font-size:25px; color:#F77D00; float:left; margin-left:5%; margin-top:10px;">DEBES HACER LOG IN PRIMERO EN LA PÁGINA DE INICIO</div>
     
     <div id="candado" align="center" style="width:100%; float:left; margin-top:20px;"><img src="../images/lock.png?id=<?php echo $time; ?>" width="100" style="margin-left:auto; margin-right:auto;" /></div>
    
   </div>
   <?php } ?>
  
  </div>
     
  </div>
     
     <div id="linea" style="width:100%; float:left; background-color:#CCCCCC; height:1px;"></div>
 <div id="footer" style="width:100%; float:left;">
<a href="/"><div id="logo2">
   
  </div></a><!--Termina logo-->
  
    <div id="titulo3" style="float:right; margin-right:15px; height:20px; line-height:20px; font-size:12px; margin-top:35px;">© 2018 Comercenter</div>
  
  </div>
   <div id="footer" style="width:100%; float:left; margin-top:20px; margin-bottom:20px;">
  <div id="menuinside3" style="display: table; margin: 0 auto;">
  
    <div id="titulo3" align="center" style="float:left; padding-left:10px; padding-right:10px; height:20px; line-height:20px; font-size:12px;"><a href="/ayuda/terminos">Condiciones de uso</a></div>
  
  <div id="titulo3" align="center" style="float:right; height:20px; line-height:20px; font-size:12px; padding-left:10px; padding-right:10px; "><a href="/avisodeprivacidad">Privacidad</a></div>
  
  </div>

</div>
     
   </div>
</body>
<?php } ?>
<?php mysql_close($comercenter); ?>
</html>