<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quienes somos</title>
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
.menu{
    color: black;
    font-size: 20px;
    float: left;
    text-align: center;
    font-weight: bold;
    margin-top: 15px;
    padding-left: 20px;
    padding-right: 20px;
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
.tituloquienessomos{
    padding-left: 5%;
    padding-right: 5%;
    margin-top: 10%
}

.descripcionquienessomos{
    padding-left: 5%;
    padding-right: 5%;
    margin-top: 2%
}

</style>

<script type="text/javascript">

    $(document).ready(function(){

    //Mostrar Login
    var login= $('#login');
        var formlogin = $('#formlogin');
        var textoboton = $('#textoboton');
        var barrabusqueda = $('#barrabusqueda');

        login.click(function(){
            formlogin.css("display","block");
        });

        //Ocultar Login
         login.dblclick(function(){
            formlogin.css("display","none");
        });

        //Mostrar busqueda    
        textoboton.click(function(){
            barrabusqueda.css("display","block");   
        });

        //Ocultar busqueda
        textoboton.dblclick(function(){
            barrabusqueda.css("display","none");   
        });

    });
</script>

</head>
<body>
<div id="topbar" style="width: 100%; float: left; font-family: 'Montserrat', sans-serif; padding-top: 10px; padding-bottom: 10px; background-color: #002f7e; position: relative;">
 
 <div onclick="" style="float: right; cursor: pointer; letter-spacing: 1.6px; padding-right: 20px; color: white; padding-left: 10px;">Log In</div>
 
 <div id="formlogin" style="display: none; position: absolute; z-index: 1; top: 38px; right: 10px; padding: 20px; background-color: #002f7e; width: 350px;">

     <input id="usuario" name="usuario" type="text" style="padding: 5px 5px; height: 20px; border: none;">

     <input id="password" name="password" type="password" style="padding: 5px 5px; height: 20px; border: none;">

     <button style="color: #002f7e; background-color: #7FDBFF; height: 30px; padding: 5px 5px; border: none; font-weight: bold; margin-left: 10px; cursor: pointer;">ENTRAR</button>

 </div>

</div>

<div id="inicio" style="width: 100%; float: left;">

 <div id="menus" style="width: 100%; font-family: 'Montserrat', sans-serif; float: left; border-top: 3px solid #7FDBFF; background-color: rgba(0, 47, 126, 0.6); border-bottom: 1px solid gray; padding-top: 30px; padding-bottom: 30px; position: relative; z-index: 1;">

     <div id="logotipo" style="margin-left: 40px; float: left;"><img src="images/logotipo.png" alt="logotipo" style="height: 50px;"></div>

     <div id="navegacion" style="float: right;">

         <div class="menu"><a href="">INICIO</a></div>
         <div class="menu"><a href="">CURSOS</a></div>
         <div class="menu"><a href="">ACADÉMICOS</a></div>
         <div class="menu"><a href="">QUIENES SOMOS</a></div>
         <div class="menu"><a href="">CONTACTO</a></div>
         
     </div>

 </div><!--Fin de Menus-->

    <h1 class="tituloquienessomos">¿Quiénes somos?</h1>
    <hr>
    <h2 class="descripcionquienessomos">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
            scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
            electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
            of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like
            Aldus PageMaker including versions of Lorem Ipsum.</p>
    </h2>

    <!-- Pie de pagina-->
    <div id="footer-conamat" style="width: 100%; height: 170px; background-color: #0b2c4d; margin-top: 100px; float: left;">
	   
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
<!-- Fin de Pie de pagina-->

</body>
</html>