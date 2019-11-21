<?php require_once('../Connections/conamatenlinea.php');

mysql_select_db($database_conamatenlinea, $conamatenlinea);
$query_Recordset1 = "SELECT * FROM quienessomos";
$Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:image" content="../images/conamatlogo.jpg" />
    <title>Conamat en línea | Quiénes somos</title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<!-- Estilos CSS-->
<style>
body{
    margin: 0;
    font-family: 'Open Sans', sans-serif;
}
a:link{
    text-decoration: none;
    color: white;
}
a:visited{
    text-decoration: none;
    color: white;
}
.menu>*{
    font-weight: normal;
}
.menu>*:hover{
    color: #FF4136 !important;
}
.menu{
    color: black;
    font-size: 20px;
    float: left;
    margin-top: 25px;
}
#buscar:hover{
    color: #0074D9 !important;
    border-color: #0074D9 !important;
}
.imagencurso{
    margin-top: 10px;
    width: 100%;
    height: 400px;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
.descripcionquienessomos{
    padding-left: 5%;
    padding-right: 5%;
    margin-top: 2%
}
@media screen and (max-width: 994px) {
    #menus{
        padding-top: 10px !important; 
        padding-bottom: 10px !important; 
    }
    #wrapper{
        width: calc(100% - 40px) !important;
        padding: 0px 20px 0 20px !important;
        margin-bottom: 0px !important;
    }
    #menumovil{
        display: block !important;
    }
    #navegacion{
        display: none !important;
    }
    #imagenlogotipo{
        height: 55px !important;
    }
    #logotipo{
        margin-left: 10px !important;
        padding-top: 10px !important;
    }
    #titulo{
        padding-left: 0px !important;
        text-align: center !important;
        font-size: 35px !important; 
        padding-top: 20px !important;
        padding-bottom: 30px !important;
    }
    .menunav{
        padding: 15px 20px !important;
        font-size: 13px !important;
        float: left;
        width: 100%;
        text-align: left;
        color: #1d4267 !important;
        font-weight: bold !important;
        border-bottom: 1px solid rgba(244,244,244,0.5) !important;
    }
    #footer-conamat{
        height: auto !important;
    }
    #logo-footer{
        width: 100% !important;
        height: auto !important;
    }
    #logo-footer img{
        width: 50% !important;
        margin-left: 25% !important;
    }
    #linksfooterprincipales{
    
        margin-left: 0px !important;
    }
    a.menu-footer-principal {
        width: calc(50% - 30px) !important;
        height: 40px !important;
        line-height: 40px !important;
        
    }
    #columna-izquierda{
        width: 100% !important;
        padding-left: 0px !important;
        height: auto !important;
        margin-bottom: 50px !important;
    }
    #columna-derecha{
        width: 100% !important;
        padding-left: 0px !important;
        margin-right: 0px !important;
        margin-bottom: 50px !important;
    }
    #contenido-contacto{
        width: 80% !important;
        margin-left: 10% !important;
        margin-right: 10% !important;
        margin-top: 50px !important;
    }
    #informacion{
        padding: 10px 0px !important;
        width: 100% !important;
    }
    #contenedorimagen{
        padding: 30px 0px !important;
        width: 100% !important;
    }


}
 


</style>

<script type="text/javascript">

    $(document).ready(function(){

        //Mostrar Login
        var login = $('#login');
        var formlogin = $('#formlogin');
        var textoboton = $('#textoboton');
        var barrabusqueda = $('#barrabusqueda');

        login.click(function(){
            formlogin.toggle();
        });

    });
</script>
<script>

$(document).ready(function(){
    //Mostrar Login
    var login = $('#login');
    var formlogin = $('#formlogin');

    login.click(function(){
        formlogin.toggle();
    });

});
</script>
<script>
function menumovil() {
    $("#menudesplegable").animate({
        right: '0'
    }, 'fast');
}

function cerrarmenumovil() {
    $("#menudesplegable").animate({
        right: '-100%'
    }, 'fast');
}

</script>
<script>
$('html').bind('touchstart mousedown', function(e){

 if (e.target.id != 'menudesplegable' && e.target.id != 'imagenmovil' && e.target.id != 'inicio' && e.target.id != '' && e.target.id != 'equis') {

$( "#menudesplegable" ).animate({
    right: "-100%"
  }, 'fast' );

    }
});
</script>


</head>
<body>

<div id="inicio" style="width: 100%; float: left;">

 <div id="menus" style="width: 100%; font-family: 'Montserrat', sans-serif; float: left; border-top: 3px solid #ff4136; background-color: #0b2c4d; border-bottom: 1px solid gray; padding-top: 30px; padding-bottom: 30px; position: relative; z-index: 1;">

     <div id="logotipo" style="margin-left: 40px; min-height: 72px; float: left;"><a href="../"><img  id="imagenlogotipo" src="../images/logotipo.png" alt="logotipo" style="height: 70px;"></a></div>

        <a href="javascript:void(0);" onclick="javascript:menumovil();" id="menumovil" style="display: none; padding: 10px; position: relative; z-index: 1; float: right; margin-top: 10px; margin-right: 10px;">

            <img src="../images/menumovil.png" style="height: 40px;" alt="">

        </a>

        <div id="menudesplegable" style="width: 80%; z-index: 2; background-color: #dad7cb; position: fixed; border-top: 3px solid #FF4136; top: 0px; bottom: 0px; right: -100%;">

            <a href="javascript:void(0);" onclick="javascript:cerrarmenumovil();" style="float: right; padding: 5px;">

                <img id="cerrar" style="height: 30px; float: right;" src="../images/x.png" alt="">

            </a>

            <img src="../images/logotipoazul.png?id=<?php echo $unixtime; ?>" style="width: 90%; margin-left: 5%; margin-top: 30px; margin-bottom: 30px;" alt="">

            <a class="menunav" style="border-top: 1px solid rgba(244,244,244,0.5);" href="../">INICIO</a>

            <a class="menunav" href="../cursos">CURSOS</a>

            <a class="menunav" href="../academicos">ACADÉMICOS</a>

            <a class="menunav" style="background-color: #afa496;">QUIÉNES SOMOS</a>

            <a class="menunav" href="../contacto">CONTACTO</a>

        </div>

      	<div id="navegacion" style="float: right;">

            <div class="menu" align="center" style="width: 120px;"><a href="../">INICIO</a></div>

			<div class="menu" align="center" style="width: 120px;"><a href="../cursos">CURSOS</a></div>
            <div class="menu" align="center" style="width: 170px;"><a href="../academicos">ACADÉMICOS</a></div>
            <div class="menu" align="center" style="width: 200px; cursor: default; color: #FF4136;">QUIÉNES SOMOS</a></div>

            <div class="menu" align="center" style="width: 150px;"><a href="../contacto">CONTACTO</a></div>
            
        </div>

</div><!--Fin de Menus-->

<div id="wrapper" style="float: left; background-color: white; width: calc(100% - 100px); padding: 0px 50px 50px 50px; margin-bottom: 100px;">

    <div id="titulo" style="padding-top: 50px; font-family: 'Montserrat', sans-serif; padding-bottom: 50px; border-bottom: 1px solid lightgray; font-size: 35px; color: #333; padding-left: 20px; letter-spacing: 1.6px; font-weight: bold;">QUIÉNES SOMOS</div>

    <div id="contenedorimagen" style="float: right; width: calc(50% - 40px); padding-left: 20px; padding-right: 20px; padding-top: 30px;">

    <div id="imagen" style="background-image: url(../images/<?php echo $row_Recordset1['imagen']; ?>); padding-bottom: 100%; background-position: center; background-repeat: no-repeat; background-size: cover; width: 100%;"></div>

    </div>

    <div id="informacion" style="float: left; width: calc(50% - 40px); padding-left: 20px; padding-right: 20px; padding-top: 10px;">

    <div class="textoinformacion" style="margin-top: 20px;"><?php echo nl2br(stripslashes(stripslashes($row_Recordset1['quienessomos']))); ?></div>
        
    </div><!---Fin de informacion-->



</div>


<div id="footer-conamat" style="width: 100%; height: 170px; background-color: #0b2c4d; float: left;">
	   
	   <div id="contenido-footer" style="width:90%; float:left; margin-top: 40px; margin-left: 5%; margin-right: 5%;">
	   
	    	<div id="logo-footer" style="width: 260px; height: 80px;  float:left;">
            	<img src="../images/logotipo.png" style="width: 100%;">
        	</div>
        	
        	<div id="linksfooterprincipales" style="float:left; margin-left: 70px; font-size: 18px; margin-bottom: 35px; font-family:'Source Sans Pro', sans-serif; line-height: 1.2px; margin-top: 40px;">
       		 
        		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color: white; padding-left: 30px;" href="/">Inicio</a>
        		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color: white; padding-left: 30px;" href="/cursos/">Cursos</a>
        		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color: white; padding-left: 30px;" href="/academicos/">Académicos</a>
        		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color: white; padding-left: 30px;" href="/quienessomos/">Quiénes Somos</a>
        		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color: white; padding-left: 30px;" href="/contacto/">Contacto</a>
        		 
        	</div>
	</div>
</div> 

</body>
</html>
