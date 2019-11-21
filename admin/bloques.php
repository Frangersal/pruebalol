<!DOCTYPE html>
<html lang="en">
<head>

    <!---Librerias-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"></link>

    <title>Bloques</title>

    <!--Estilos-->
    <style>
            body{
                margin: 0;
                background-color: #0b2c4d;
                font-family: 'Montserrat', sans-serif; 
            }
            .menu{
                font-family: 'Montserrat', sans-serif;
                padding: 10px;
                line-height: 30px;
                float:left;
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
                padding: 20px 30px;
            }
                
             .progress-wrp {
                        position: relative;
                        border-radius: 3px;
                        margin: 0px;
                        text-align: left;
                        background: #7FDBFF;
                        color: white;
                    }
            
                    .progress-bar {
                        height: 45px;
                        width: 0;
                        background-color: #0b2c4d;
                        line-height: 45px;
                    }
            
            .status {
                        top: 3px;
                        left: 0%;
                        width: 100%;
                        text-align: center;
                        position: absolute;
                        line-height: 45px;
                        display: inline-block;
                        color: #000000;
                    }
                
            .toprow{
                float:left;
                width: 100%;
                background-color: #0b2c4d; 
                color: white;
                min-height: 50px;
            }
            .topcell{
                float: left; 
                width: calc(25% - 2px);
                line-height: 50px;
                text-align: center;
            }
            .row{
                float:left;
                width: 100%;
                background-color: white; 
            }
            .cell{
                float: left; 
                width: calc(25% - 2px);
                border: 1px solid lightgray;
                line-height: 30px;
                text-align: center;
            }
            .nostyle:link{
                color: #222;
                text-decoration: none;
            }
            .nostyle:visited{
                color: #222;
                text-decoration: none;
            }

            .tophead:hover{
                text-decoration: underline;
            }

              
    </style>

    <!--Javascript-->
    <script type="text/javascript">

        function agregarbloque() {

            var numbloques = parseInt($("#numbloques").val()) + 1;

            $("#numbloques").val(numbloques);

            $('#tablamod').append('<div id="topheadi'+numbloques+'" onclick="agregarleccion('+numbloques+')" class="tophead" style="color: #00959594; width: 25%; float: left; font-weight: bold; margin: 2px; cursor: pointer; margin-left: calc(30% + 15px);"> +Agregar leccion</div> <div id="topheadd'+numbloques+'" onclick="eliminarleccion('+numbloques+')" class="tophead" style="color: #d16c6cbd; width: 25%; float: left; font-weight: bold; margin: 2px; cursor: pointer; display: none;"> -Eliminar leccion </div>  <div id="toprow'+numbloques+'" style="width: calc(100% - 10px);float:left;padding: 5px;">  <div id="bloquei'+numbloques+'" style="padding: 10px;height: 100px;width: calc(30% - 30px);float:left;margin: 5px;background: #afdaff;">Bloque '+numbloques+' </div> <input id="numlecciones'+numbloques+'" type="hidden" name="numlecciones'+numbloques+'" value="'+numbloques+'"> <div id="bloqued'+numbloques+'" style="background: aliceblue;padding: 10px;font-size: 10px;height: 100px;width: calc(70% - 30px);float:left;margin: 5px;">  <div id="topdescd'+numbloques+'" style="width:calc(100% - 6px); float: left; margin: 3px;">1. Whats your name?</div> </div> </div>');

            if (numbloques > 1) {
                $("#topheade").show();
            }
            
        }

        function eliminarbloque() {

            var numbloques = parseInt($("#numbloques").val());

            $("#toprow"+numbloques).remove();
            $("#topheadd"+numbloques).remove();
            $("#topheadi"+numbloques).remove();

            numbloques = numbloques - 1;
            $("#numbloques").val(numbloques);

            if (numbloques == 1) {
                $("#topheade").hide();
            }

        }

        function agregarleccion(numbloques) {

            var numlecciones = parseInt($("#numlecciones").val()) + 1;

            $("#numlecciones").val(numlecciones);

            $('#bloqued'+numbloques).append('<div id="topdescd'+numlecciones+'"  style="width:calc(100% - 6px); float: left; margin: 3px;">1. Whats your name?</div>');

            if (numlecciones > 1) {
                $("#topheadd" +numbloques).show();

            }

        }

        function eliminarleccion(numbloques) {
            
           var numlecciones = parseInt($("#numlecciones").val());

            $("#topdescd"+numlecciones).remove();

            numlecciones = numlecciones - 1;

            $("#numlecciones").val(numlecciones);

            if (numlecciones == 1) {
                $("#topheadd"+numbloques).hide();
            }

        }
    
    </script>

</head>
<body>

        <!--Wrapper-->
        <div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

                <!--Menu del admin-->
                <div id="adminmenu" style="float: left; box-shadow: 0px 0px 10px #000; overflow: scroll; width: 20%; background-color: #1d4267; position: fixed; height: 100%; overflow: scroll;">
            
                    <div id="logotipo" align="center" style="float: left; width: calc(100% - 60px); padding-top: 50px; padding-bottom: 30px; padding-right: 30px; padding-left: 30px;"><img src="../images/logotipo.png" alt="logotipo" style="width: 100%;"></div>
            
                    <div id="etiquetaadmin" style="font-family: 'Montserrat', sans-serif; float: left; width: calc(80% - 20px); margin-left: 10%; margin-top: 20px; margin-bottom: 50px; text-align: center; padding: 10px; border: 1px solid white; color: white; font-size: 18px; border-radius: 20px;">Menú admin</div>
            
                    <div id="navegacion" style="width: 100%; float: left; margin-bottom: 20px;">
                                
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
            
                        <a class="menu" href="alumnos.php">Alumnos</a>
            
                        <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
            
                        <a class="menu" href="ayuda.php">Ayuda</a>
            
                        <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
            
                        <a class="menu" href="biblioteca.php">Biblioteca</a>
            
                        <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
            
                        <a class="menu" href="cursos.php">Cursos</a>
                        
                        <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
            
                        <a class="menu" href="maestros.php">Maestros</a>
            
                        <div class="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
            
                        <div id="link">Materias</div>
            
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
                <!--FIN menu admin-->

                <!--Seccion principal-->
                <div id="seccionprinpal" style="width:80%; margin-left: 20%; float: left; background: white; ">

                    <div id="contenedor" style="width: calc(100% - 10px);float:left; padding: 5px;position:relative;">

                        <div id="titulo" style="text-align: center; font-size: 30px; font-weight: bold;margin: 20px 0px; padding: 5px; color: #187ba8; width: calc(100% - 10px);">Bloques  de la materia</div>
                    
                        <div id="tablamod" style="width:100%;  float: left; font-weight: bold;">

                            <input id="numbloques" type="hidden" name="numbloques" value="1">

                            <div id="toph" style="width: calc(100% - 20px); float:left; padding: 0px 10px;">

                                <div id="contiene-agregareliminar" style="width:30%; float:left;">

                                    <div id="topheada" class="tophead" onclick="agregarbloque('1')" style="color: #009595;width: calc(50% - 4px);float:left;font-weight: bold;margin: 2px;cursor:pointer;">+Agregar bloque</div>
                                    
                                    <div id="topheade" class="tophead" onclick="eliminarbloque('1')" style="color: #d16c6c;width: calc(50% - 4px);float:left;font-weight: bold;margin: 2px;cursor:pointer; display: none;">-Eliminar bloque</div>

                                </div>
                               
                                <div id="topheadi" class="tophead" onclick="agregarleccion('1')" style="color: #00959594; width: 25%; float: left; font-weight: bold; margin: 2px; cursor: pointer; ">+Agregar leccion</div>
                                <div id="topheadd1" class="tophead" onclick="eliminarleccion('1')" style="color: #d16c6cbd; width: 25%; float: left; font-weight: bold; margin: 2px; cursor: pointer; display: none;">-Eliminar leccion</div>
                            </div>
                            
                            <input id="numlecciones" type="hidden" name="numlecciones" value="1">
                            <div id="toprow" style="width: calc(100% - 10px); float:left; padding: 5px;">
                                <div id="bloquei" style="padding: 10px; height: 100px; width: calc(30% - 30px); float:left; margin: 5px;background: #afdaff;">Bloque 1</div>

                                    <div id="bloqued1" style="background: aliceblue;padding: 10px; font-size: 10px;height: 100px; width: calc(70% - 30px); float:left; margin: 5px;">
                                         <div id="topdescd1" style="width: 100%; float: left; margin: 3px;">1. What's your name?</div>
                                        
                                    </div>
                            </div>      
                                            
                            </div>
      
                        </div>

                <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 50px; margin-bottom: 20px;">
                    <button type="button" onclick="window.location='cursos.php'" style="margin: 0px 10px; border-radius: 7px; padding: 10px 15px; background-color: #8a8f95; font-size: 14px; border-color: #dedfdf; color: #ffffff; cursor: pointer;">CANCELAR</button>
                    <button type="button" onclick="window.location='materias1.php'" style="margin: 0px 10px;border-radius: 7px;padding: 10px 15px;background-color: #1d4267;font-size: 14px;border-color: #7FDBFF;color: #7FDBFF;cursor: pointer;">SIGUIENTE</button>
                </div>


            </div>
                
        </div>
        <!--FIN seccion principal-->
         
    </div>
    <!--FIN Wrapper-->

</body>
</html>