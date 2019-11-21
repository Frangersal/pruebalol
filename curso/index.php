<?php require_once('../Connections/conamatenlinea.php');

$link = $_GET['link'];

if ($link != "") {

    mysql_select_db($database_conamatenlinea, $conamatenlinea);
    $query_Recordset1 = "SELECT * FROM cursos WHERE link = '$link'";
    $Recordset1 = mysql_query($query_Recordset1, $conamatenlinea) or die(mysql_error());
    $row_Recordset1 = mysql_fetch_assoc($Recordset1);
    $totalRows_Recordset1 = mysql_num_rows($Recordset1);

    $nombre = stripslashes(stripslashes($row_Recordset1['nombre']));
    $descripcion = stripslashes(stripslashes($row_Recordset1['descripcion']));
    $imagen = stripslashes(stripslashes($row_Recordset1['imagen']));
    $costo = stripslashes(stripslashes($row_Recordset1['costo']));
    $unixinicio = $row_Recordset1['fechainicio'];
    $unixfinal = $row_Recordset1['fechafinal'];
    $fechainicio = date("d/m/Y", $unixinicio);
    $fechafinal = date("d/m/Y", $unixfinal);

}
    

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Conamat | Curso</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
<style>
body{
    margin: 0;
    font-family: 'Montserrat', sans-serif;
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
#botoninscripcion:hover{
    background-color: #ca0510 !important;
}
.zoom{
	transition: all .3s ease;
}
.zoom:hover{
    transform: scale(1.1);
}
.curso {
    border: 1px solid #ccc;
    float: left;
    width: 21%;
    margin-left: calc(2% - 1px);
    margin-right: calc(2% - 1px);
    margin-top: 2%;
	box-shadow: 1px 4px 7px rgba(46,45,41,0.35);
}
.imagencurso{
    height: 400px;
    width: 100%;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
.nombreCurso {
    text-align: left;
    padding: 10px 15px;
    font-family: helvetica;
    color: #0b2c4d;
    height: 16px;
    overflow: hidden;
    font-size: 16px;
	font-weight: bold;

}
#titulocurso{
    padding-left: 0px !important;
    text-align: center !important;
    font-size: 40px !important; 
}
#encabezado {
    text-align: center;
    font-family: helvetica;
}
.contenidoCurso {
    height: 150px;
    overflow: hidden;
    font-size: 13px;
    color: black;
    margin: 10px;
}
.contenedorCursos{
    width: 100%;
    float: left;
    margin-bottom: 30px;
    font-family: helvetica;
} 
p{
    font-family: helvetica;
}
@media screen and (max-width: 994px) {
    #menus{
        padding-top: 10px !important; 
        padding-bottom: 10px !important; 
    }

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
    .curso{
        width: 46% !important;
        margin-top: 10% !important;
    }
    .nombreCurso{
        text-align: center;
        font-size: 18px !important; 
    }
    .contenidoCurso{
        font-size: 15px !important; 
        color: black;

    }
    #titulo{
        padding-top: 20px !important;
        padding-bottom: 20px !important;
    }
    #titulocurso{
        padding-left: 0px !important;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
        text-align: center !important;
        font-size: 20px !important; 
        line-height: 25px !important;
    }
    #informacion{
        width: 100% !important;
        padding-left: 0px !important;
        padding-right: 0px !important;
    }
    #contenedorinformacion{
        width: 100% !important;
        padding-left: 0px !important;
        padding-right: 0px !important;
    }
    #inscripcion{
        width: 100% !important;
        margin-bottom: 10px !important;
    }



}
@media screen and (max-width: 764px) {
    .curso{
        width: 96% !important;
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
</head>
<body>

<div id="inicio" style="width: 100%; float: left;">

    <div id="menus" style="width: 100%; font-family: 'Montserrat', sans-serif; float: left; border-top: 3px solid #FF4136; background-color: #0b2c4d;; border-bottom: 1px solid gray; padding-top: 30px; padding-bottom: 30px; position: relative; z-index: 1;">

        <div id="logotipo" style="margin-left: 40px; min-height: 72px; float: left;"><a href="../"><img id="imagenlogotipo" src="../images/logotipo.png" alt="logotipo" style="height: 70px;"></a></div>

        <a href="javascript:void(0);" onclick="javascript:menumovil();" id="menumovil" style="display: none; padding: 10px; position: relative; z-index: 1; float: right; margin-top: 10px; margin-right: 10px;">

            <img  src="../images/menumovil.png" style="height: 40px;" alt="">

        </a>

        <div id="menudesplegable" style="width: 80%; z-index: 2; background-color: #dad7cb; position: fixed; border-top: 3px solid #FF4136; top: 0px; bottom: 0px; right: -100%;">

            <a href="javascript:void(0);" onclick="javascript:cerrarmenumovil();" style="float: right; padding: 5px;">

                <img id="cerrar" style="height: 30px; float: right;" src="../images/x.png" alt="">

            </a>

            <img src="../images/logotipoazul.png?id=<?php echo $unixtime; ?>" style="width: 90%; margin-left: 5%; margin-top: 30px; margin-bottom: 30px;" alt="">

            <a class="menunav" style="border-top: 1px solid rgba(244,244,244,0.5);" href="../">INICIO</a>

            <a class="menunav" style="../cursos">CURSOS</a>

            <a class="menunav" href="../academicos">ACADÉMICOS</a>

            <a class="menunav" href="../quienessomos">QUIÉNES SOMOS</a>

            <a class="menunav" href="../contacto">CONTACTO</a>
 

        </div>

        <div id="navegacion" style="float: right;">

            <div class="menu" align="center" style="width: 120px;"><a href="../">INICIO</a></div>

            <div class="menu" align="center" style="width: 120px;"><a href="../cursos">CURSOS</a></div>
            <div class="menu" align="center" style="width: 170px;"><a href="../academicos">ACADÉMICOS</a></div>
            <div class="menu" align="center" style="width: 200px;"><a href="../quienessomos">QUIÉNES SOMOS</a></div>
            <div class="menu" align="center" style="width: 150px;"><a href="../contacto">CONTACTO</a></div>
            
        </div>




    </div><!--Fin de Menus-->

</div>

<div id="wrapper" style="float: left; width: calc(100% - 100px); padding: 0px 50px 50px 50px;">

<?php if ($totalRows_Recordset1 > 0) { ?>

<div id="titulocurso" style="padding-top: 50px; font-family: 'Montserrat', sans-serif; padding-bottom: 50px; border-bottom: 1px solid lightgray;  color: #333; font-weight: bold; padding-left: 20px; letter-spacing: 1.6px;"><?php echo $nombre; ?></div>

    <div id="inscripcion" style="width: 50%; float: right; margin-top: 20px; box-shadow: 0 1px 10px 1px rgba(46,45,41,0.2); font-family: 'Source Sans Pro', sans-serif;">

        <div id="barratop" style="float: right; background-color: #2e2d29; color: white; padding-top: 10px; padding-bottom: 10px; width: 100%;">
            <img id="estadocurso" src="../images/greendot.png" style="margin-right: 15px; float: left; margin-top: 5px; margin-left: 15px; height: 10px;">
           <div id="titulotop" style="float: left;">Inscripciones Abiertas</div>
        
        </div>

        <div id="contenedor-inscripcion" style="background-color: #eee; padding: 30px;">

            <div id="contieneboton" align="center" style="padding-top: 50px; padding-bottom: 50px;"><button id="botoninscripcion" style="background-color: #b1040e; cursor: pointer; font-weight:  bold; font-size: 28px; font-family: 'Source Sans Pro', sans-serif; color: white; padding: 20px 40px;">INSCRIBIRME</button></div>

            <div id="contenedorcosto" style="margin-top: 10px;">
    
                <span id="etiquetacosto" style="font-weight: bold;">Costo: </span> 
                <span id="costo"><?php echo $costo;?></span>

            </div>

            <div id="contenedortiempo" style="padding-top: 10px; padding-bottom: 10px; width: 100%;">

                <div id="contienefechainicio" style="float: left; width: 50%;">

                    <span id="etiquetatiempo" style="font-weight: bold;">Fecha Inicio: </span> 
                    <span id="fechainicio"><?php echo $fechainicio; ?></span>

                </div>

                <div id="contienefechafinal" style="float: left; width: 50%; text-align: right;">

                    <span id="etiquetatiempo" style="font-weight: bold;">Fecha Final: </span> 
                    <span id="fechafinal"><?php echo $fechafinal; ?></span>

                </div>

            </div>

        </div>

    </div>

    <div id="informacion" style="float: left; width: calc(50% - 40px); padding-left: 20px; padding-right: 20px; padding-top: 10px;">

    <div class="imagencurso" style="background-image: url(../images/<?php echo $imagen; ?>);"></div>

        <div class="tituloinformacion" style="font-size: 20px; font-weight: bold; padding-top: 20px; padding-bottom: 10px;">MATERIAS</div>
        <div class="textoinformacion" style="padding-left: 10px;">
            Matemáticas
<br>
            Biología
<br>
            Historia
<br>
            Cultura de la legalidad
        </div>


        <div class="tituloinformacion" style="font-size: 20px; font-weight: bold; padding-top: 20px; padding-bottom: 10px;">DESCRIPCIÓN</div>
        <div class="textoinformacion"><?php echo $descripcion; ?></div>

    </div><!---Fin de informacion-->


<?php } else { ?>

    <div id="nohay" style="font-size: 25px; text-align: center; line-height: 300px;">No se encontraron cursos con ese nombre</div>


<?php } ?>

</div> <!--Fin del wrapper -->

<div id="footer-conamat" style="width: 100%; height: 170px; background-color: #0b2c4d; margin-top: 30px; float: left;">
	   
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
</div> <!-- Fin del footer -->

</body>
</html>
