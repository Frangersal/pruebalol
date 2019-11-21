<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Contacto</title>
 <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>

<script>
    function enviarmensaje(){

    }
	
</script>

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
    text-align: center;
    margin-top: 15px;
    padding-left: 20px;
    padding-right: 20px;
}
.menu>*:hover{
    color: #0074D9 !important;
}
	
a:link{
    text-decoration: none;
    color: white;
}
a:visited{
    text-decoration: none;
    color: white;
}
	
</style>

<body>

<div id="topbar" style="width: 100%; float: left; font-family: 'Montserrat', sans-serif; padding-top: 10px; padding-bottom: 10px; background-color: #0b2c4d;">
 
    <div id="login"  style="float: right; cursor: pointer; letter-spacing: 1.6px; padding-right: 20px; color: white; padding-left: 10px;"> Log In </div>
    
    <div id="formlogin" style="display: none; position: absolute; z-index: 2; top: 38px; right: 10px; padding: 20px; background-color: #002f7e; width: 350px;">

       <input placeholder="Nombre" id="usuario" name="usuario" type="text" style="padding: 5px 5px; height: 20px; border: none;">

        <input placeholder="Contraseña" id="password" name="password" type="password" style="padding: 5px 5px; height: 20px; border: none;"> <br>

        <button style="color: #002f7e; background-color: #7FDBFF; height: 30px; padding: 5px 5px; border: none; font-weight: bold; margin-left: 10px; margin-top:5px; cursor: pointer;">ENTRAR</button>

    </div>

</div> <!--Fin topbar -->

<div id="inicio" style="width: 100%; float: left;">

    <div id="menus" style="width: 100%; font-family: 'Montserrat', sans-serif; float: left; padding-top: 30px; padding-bottom: 30px; background-color: #0b2c4d;">

        <div id="logotipo" style="margin-left: 40px; float: left;"><img src="images/logotipo.png" alt="logotipo" style="height: 50px;"></div>

        <div id="navegacion" style="float: right;">

            <div class="menu"><a href="">INICIO</a></div>
            <div class="menu"><a href="">CURSOS</a></div>
            <div class="menu"><a href="">ACADÉMICOS</a></div>
            <div class="menu"><a href="">QUIENES SOMOS</a></div>
            <div class="menu"><a href="">CONTACTO</a></div>
            <button id="buscar" style="color: white; font-family: 'Montserrat', sans-serif; background: none; cursor: pointer; margin-right: 20px; font-size: 20px; float: left; text-align: center; margin-top: 13px;">
            
                <img src="images/buscar.png" style="float: left; height: 23px;">

                <div id="textoboton" style="float: left; margin-right: 5px;">BUSCAR</div>

            </button>

        </div>
    
    <div id="barrabusqueda" style="display:none; position: absolute; float: right; top: 110px; width: calc(100% - 40px); background-color: white; padding: 20px;">

        <button value="Buscar" style="height: 34px; color: white; border: none; float: right; padding: 5px; background-color: #B0040A;" type="submit"><img src="images/buscar.png" style="height: 23px;"></button>
        
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

                <div id="info-contacto" style="margin-top: 50px; font-size: 15px;">

                    <div id="contenedor-direccion" style="margin: 20px 0px;">

                        <div id="contenedor-imagen" style="height: 40px; float: left;"><img src="images/ubicacionicon.png" style="width: 22px; height: 25px; float: left; padding-right: 15px; padding-top: 10px;"></div>
                    
                        <div id="direccion" style="padding-top: 5px;">Av. Cuauhtémoc 607<br>Fraccionamiento Marroquín</div>

                    </div>

                    <div id="contenedor-correo" style="height: 30px; margin: 20px 0px; font-size: 15px;">

                        <div id="contenedor-imagen" style="height: 40px; float: left;"><img src="images/emailicon.png" style="width: 26px; height: 18px; float: left; padding-right: 15px; padding-top: 4px;"></div>

                        <div id="correo">info@conamatacapulco.com</div>

                    </div>

                    <div id="contenedor-telefono" style="height: 40px; margin: 20px 0px; font-size: 15px;">

                        <div id="contenedor-imagen" style="height: 40px; float: left;"><img src="images/telefonoicon.png" style=" width: 25px; height: 25px; float: left; padding-right: 15px; padding-top: 10px;"></div>

                        <div id="telefono1" style="padding-top: 4px;">4 85 93 10</div>

                        <div id="telefono2">4 85 19 43</div>

                    </div>

                </div>

            </div>
               
            <div id="columna-derecha" style="float: left; width: 45%; line-height: 1.6; color: #42474c; color: white; height: 550px; font-size: 13px; padding-left: 20px; overflow: hidden; margin-right: 10px;">

                 <div align="left" class="titulo" style="letter-spacing: 5px; font-size: 30px; font-family: 'Open Sans', sans-serif; font-weight: 600; color: #42474c;">Déjanos un mensaje</div>
                    
                 <div id="linea" style="border-bottom: 2px solid #4d647c; width: 60px; height: 0px; margin-top: 20px; margin-bottom: 30px;"></div>
                 

                <form id="enviarcorreo" name="enviarcorreo" method="post" action="enviarcorreo.php">
                    
                    <input id="nombre" class="nombre" placeholder="Nombre*" type="text" style="border: 2px solid #d5d5d7; margin: 10px 0px; padding: 10px 10px; font-size: 16px; width: 95%; float: left;">

                    <input id="correo" class="correo" placeholder="Correo*" type="text" style="border: 2px solid #d5d5d7; margin: 10px 0px; padding: 10px 10px; font-size: 16px; width: 95%; float: left;">

                    <textarea id="mensaje" name="mensaje" cols="30" rows="7" placeholder="Mensaje" style="border: 2px solid #d5d5d7; resize: none; margin: 10px 0px; padding: 10px 10px; font-size: 16px; width: 95%; float: left; font-family: 'Open Sans', sans-serif;"></textarea>

                    <button onclick="enviarmensaje()" style="border-radius: 20px; padding: 20px 20px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #4d647c; margin-top: 15px; color: white; background-color: #0b2c4d;">ENVIAR MENSAJE</button>

                </form>
                
            </div>
            
         </div>
</div> <!-- Fin wraper contacto -->

<div id="footer-conamat" style="width: 100%; height: 170px; background-color: #0b2c4d; margin-top: 50px; float: left;">
	   
	   <div id="contenido-footer" style="width:90%; float:left; margin-top: 40px; margin-left: 5%; margin-right: 5%;">
	   
	    	<div id="logo-footer" style="width: 260px; height: 80px;  float:left;">
            	<img src="images/logotipo.png" style="width: 100%;">
        	</div>
        	
        	<div id="linksfooterprincipales" style="float:left; margin-left: 70px; font-size: 18px; margin-bottom: 35px; font-family:'Source Sans Pro', sans-serif; line-height: 1.2px; margin-top: 22px;">
       		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color:white; padding-left: 30px;" href="https://conamatacapulco.com/">Página Principal</a>
        		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color: white; padding-left: 30px;" href="paginaprincipal">Otro título</a>
        		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color: white; padding-left: 30px;" href="paginaprincipal">Otro título</a>
        		 
        		 <a class="menu-footer-principal" style="float: left; text-decoration: none; color: white; padding-left: 30px;" href="paginaprincipal">Otro título</a>
        		 
        	</div>
        	
        	<div id="linksfootersecundarios" style="float: left; margin-left: 79px; font-size: 16px; margin-bottom: 10px; font-family:'Source Sans Pro', sans-serif; line-height: 1.2px;">
        		
        		 <a class="menu-footer-secundario" style="float: left; text-decoration: none; color:white; padding-left: 20px;" href="https://conamatacapulco.com/">Link secundario</a>
        		 
        		 <a class="menu-footer-secundario" style="float: left; text-decoration: none; color: white; padding-left: 20px;" href="paginaprincipal">Link secundario</a>
        		 
        		 <a class="menu-footer-secundario" style="float: left; text-decoration: none; color: white; padding-left: 20px;" href="paginaprincipal">Link secundario</a>
        		 
        		 <a class="menu-footer-secundario" style="float: left; text-decoration: none; color: white; padding-left: 20px;" href="paginaprincipal">Link secundario</a>
        		 
        		 <a class="menu-footer-secundario" style="float: left; text-decoration: none; color: white; padding-left: 20px;" href="paginaprincipal">Link secundario</a>
        		 
        	</div>
        	
        	<div id="copyconamat" style="float: left; margin-left: 100px; font-size: 15px; color: white; margin-top: 20px; font-family:'Source Sans Pro', sans-serif; line-height: 1.2px; letter-spacing: 1px;">© CONAMAT ACAPULCO</div>
        	
	</div>
</div>

</body>
</html>