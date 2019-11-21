<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Conamat en línea | Contacto</title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>

<style>
	
body {
    font-size: 14px;
    margin: 0px 0px;
    font-family: 'Open Sans', sans-serif;
    width: 100%;
}

input:focus {
	box-shadow: 0px 0px 5px #0b2c4d !important;
	border: 1px solid #0b2c4d !important;
}
	
textarea:focus {
	box-shadow: 0px 0px 5px #0b2c4d !important;
	border: 1px solid #0b2c4d !important;
}

.menu{
    color: white;
    font-size: 20px;
    float: left;
    margin-top: 25px;
}
.menu>*:hover{
    color: #FF4136 !important;
}
	
a:link{
    text-decoration: none;
    color: white;
}
a:visited{
    text-decoration: none;
    color: white;
}	
@media screen and (max-width: 994px) {
    #wrapper{
        width: calc(100% - 40px) !important;
        padding: 0px 20px 0 20px !important;
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
        font-size: 40px !important; 
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



}
@media screen and (max-width: 764px) {
    #menus{
        padding-top: 10px !important;
        padding-bottom: 10px !important;
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
        font-size: 40px; 
    }

}
 


</style>
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

<body>

<div id="inicio" style="width: 100%; float: left;">

    <div id="menus" style="border-top: 3px solid #FF4136; width: 100%; font-family: 'Montserrat', sans-serif; float: left; padding-top: 30px; padding-bottom: 30px; background-color: #0b2c4d;">

        <div id="logotipo" style="margin-left: 40px; min-height: 72px; float: left;"><a href="../"><img id="imagenlogotipo" src="../images/logotipo.png" alt="logotipo" style="height: 70px;"></a></div>

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

            <a class="menunav" href="../quienessomos">QUIÉNES SOMOS</a>

            <a class="menunav" style="background-color: #afa496;">CONTACTO</a>
 

        </div>

        <div id="navegacion" style="float: right;">

            <div class="menu" align="center" style="width: 120px;"><a href="../">INICIO</a></div>

            <div class="menu" align="center" style="width: 120px;"><a href="../cursos">CURSOS</a></div>
            <div class="menu" align="center" style="width: 170px;"><a href="../academicos">ACADÉMICOS</a></div>
            <div class="menu" align="center" style="width: 200px;"><a href="../quienessomos">QUIÉNES SOMOS</a></div>
            <div class="menu" align="center" style="width: 150px; cursor: default; color: #FF4136;">CONTACTO</div>
            <button id="buscar" style="color: white; display: none; font-family: 'Montserrat', sans-serif; background: none; cursor: pointer; margin-right: 20px; font-size: 20px; float: left; text-align: center; margin-top: 13px;">
            
                <img src="../images/buscar.png" style="float: left; height: 23px;">

                <div id="textoboton" style="float: left; margin-right: 5px;">BUSCAR</div>

            </button>

        </div>
    
    <div id="barrabusqueda" style="display:none; position: absolute; float: right; top: 110px; width: calc(100% - 40px); background-color: white; padding: 20px;">

        <button value="Buscar" style="height: 34px; color: white; border: none; float: right; padding: 5px; background-color: #B0040A;" type="submit"><img src="../images/buscar.png" style="height: 23px;"></button>
        
        <input placeholder="Escribe tu búsqueda" style="padding: 5px; width: 300px; float: right; height: 20px;" type="text">

    </div>
	</div>
</div><!--Fin de Menus-->


<div id="wraper-contacto" style="float: left; width: 100%; background-color: white;">
         
        <div id="contenido-contacto" style="float: left; width: 90%; margin-left: 5%; margin-right: 5%; margin-top: 60px;">
          
            <div id="columna-izquierda" style="float: left; width: 45%; line-height: 1.6; height: 550px; font-size: 13px; padding-left: 50px; overflow: hidden;">

                <div align="left" class="titulo" style="letter-spacing: 5px; font-size: 30px; font-family: 'Open Sans', sans-serif; font-weight: 600; color: #42474c;">Contacto</div>
                    
                <div id="linea" style="border-bottom: 2px solid #4d647c; width: 60px; height: 0px; margin-top: 20px; margin-bottom: 30px;"></div>

                <div  align="left" style="font-size: 18px; color: #555555;">Conoce las diferentes maneras de contactarnos.</div>

                <div id="info-contacto" style="margin-top: 50px; font-size: 16px;">

                    <div id="contenedor-direccion" style="margin: 20px 0px;">

                        <div id="contenedor-imagen" style="height: 40px; float: left;"><img src="../images/ubicacionicon.png" style="width: 22px; height: 25px; float: left; padding-right: 15px; padding-top: 10px;"></div>
                    
                        <div id="direccion" style="padding-top: 5px;">Av. Cuauhtémoc 607<br>Fraccionamiento Marroquín</div>

                    </div>

                    <div id="contenedor-correo" style="height: 30px; margin: 20px 0px; font-size: 16px;">

                        <div id="contenedor-imagen" style="height: 40px; float: left;"><img src="../images/emailicon.png" style="width: 26px; height: 18px; float: left; padding-right: 15px; padding-top: 4px;"></div>

                        <div id="correo">info@conamatacapulco.com</div>

                    </div>

                    <div id="contenedor-telefono" style="height: 40px; margin: 20px 0px; font-size: 15px;">

                        <div id="contenedor-imagen" style="height: 40px; float: left;"><img src="../images/telefonoicon.png" style=" width: 25px; height: 25px; float: left; padding-right: 16px; padding-top: 10px;"></div>

                        <div id="telefono1" style="padding-top: 4px;">4 85 93 10</div>

                        <div id="telefono2">4 85 19 43</div>

                    </div>

                </div>

            </div>
               
            <div id="columna-derecha" style="float: left; width: 45%; line-height: 1.6; height: 550px; font-size: 13px; padding-left: 20px; overflow: hidden; margin-right: 10px;">

                 <div align="left" class="titulo" style="letter-spacing: 5px; font-size: 30px; font-family: 'Open Sans', sans-serif; font-weight: 600; color: #42474c;">Déjanos un mensaje</div>
                    
                 <div id="linea" style="border-bottom: 2px solid #4d647c; width: 60px; height: 0px; margin-top: 20px; margin-bottom: 30px;"></div>
                 

                <form id="enviarcorreo" name="enviarcorreo" method="post" action="enviarcorreo.php">
                    
                    <input id="nombre" class="nombre" placeholder="Nombre*" type="text" style="border: 2px solid #d5d5d7; margin: 10px 0px; padding: 10px 10px; font-size: 16px; width: calc(100% - 24px); float: left;">

                    <input id="correo" class="correo" placeholder="Correo*" type="text" style="border: 2px solid #d5d5d7; margin: 10px 0px; padding: 10px 10px; font-size: 16px; width: calc(100% - 24px); float: left;">

                    <textarea id="mensaje" name="mensaje" cols="30" rows="7" placeholder="Mensaje" style="border: 2px solid #d5d5d7; resize: none; margin: 10px 0px; padding: 10px 10px; font-size: 16px; width: calc(100% - 24px); float: left; font-family: 'Open Sans', sans-serif;"></textarea>

                    <button onclick="enviarmensaje()" style="border-radius: 20px; padding: 20px 20px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #4d647c; margin-top: 15px; color: white; background-color: #0b2c4d;">ENVIAR MENSAJE</button>

                </form>
                
            </div>
            
         </div>
</div> <!-- Fin wraper contacto -->

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
