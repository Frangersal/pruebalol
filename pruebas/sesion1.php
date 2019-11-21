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

    <title>Sesiones</title>

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

            #subtema{
            font-size: 22px;
            font-weight: bold;
            margin: 10px 0px;
            padding: 5px;
            width: calc(100% - 10px);
            color: #187ba8;

        }

        #sesion{
            font-size: 16px;
            margin: 10px 0px;
            padding: 5px;
            text-align: justify;
            font-weight: bold;
			color: #187ba8;
        }
		
		#porcentaje{
            font-size: 16px;
            margin: 10px 0px;
            padding: 5px;
            text-align: justify;
            font-weight: bold;
        }
		
		#estatus{
            font-size: 16px;
            margin: 10px 0px;
            padding: 5px;
            text-align: justify;
            font-weight: bold;
        }

        #agregaractividad:hover {
            text-decoration: underline ;
        }

        #sesion:hover{
            background: lightblue;
            cursor: pointer
        }

              
    </style>

    <!--Javascript-->
    <script type="text/javascript">

        function agregaractividad() {
            $('#ventanaemergente').show();
        }

        function cerrar() {
            $('#ventanaemergente').hide();
        }

        function mostraractividad() {
            $('#seccionactividad').show();
        }

        function valida_envia() {
      
            if ($("#indicaciones").val()=='') {
                alert("Especifica las indicaciones de la actividad");
                $("#indicaciones").focus();
                return false;
            }

            var radios = document.getElementsByName("bloque");
            var formValid = false;

            var i = 0;
            while (!formValid && i < radios.length) {
                if (radios[i].checked) formValid = true;
                i++;        
            }

            if (!formValid) alert("Selecciona un bloque");
                return false;
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

                        <div id="contenedor" style="width: calc(100% - 40px);float:left;padding: 20px;position: relative;">

                            <div id="titulomateria" style="text-align: center; font-size: 22px; font-weight: bold; margin: 20px 0px; padding: 5px; color: #187ba8; width: calc(100% - 10px);">SESION N</div>
                   
                                <div id="contieneagregaractividad" style="width: 100%; float: left;">
                                        
                                    <div id="agregaractividad" onclick="agregaractividad()" style="text-align: center;width: 100%;float: left;cursor: pointer;color: green;font-weight: bold;">+Agregar actividad</div>
                                        
                                </div>
                            
                                <div id="ventanaemergente" align="center" style="border: 2px solid skyblue; width: calc(50% - 14px); float: left; padding: 5px; margin: 10px 25%; background: rgb(191, 232, 248); display: none;">

                                        <form id="formsesion" action="" enctype="multipart/form-data" method="post" onsubmit="return(valida_envia())">
    
                                            <div id="cerrar" onclick="cerrar()" style="color:red; font-weight: bold; float:right; cursor:pointer">X</div>
                                            <div style="font-weight: bold;"> Selecciona el tipo de actividad</div>
                                                <select name="acttividades" id="actividades" style="margin: 5px 0px;background: #00b1ce;border: 2px solid #00aeca;width: 50%;height: 30px;color: white;font-weight: bold;">
                                                    <option value="">Actvidad</option>
                                                    <option value="">Crucigrama</option>
                                                    <option value="">Sopa de letras</option>
                                                    <option value="">Preguntas abiertas</option>
                                                    <option value="">Opcion multiple</option>
                                                    <option value="">Acompleta la frase</option>
                                                    <option value="">Verdadero-falso</option>
                                                </select>
                                            <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 50px; margin-bottom: 20px;">   
                                                <button type="button" onclick="mostraractividad()" style="margin: 0px 10px;border-radius: 7px;padding: 5px 10px;background-color: #1d4267;font-size: 14px;border-color: #7FDBFF;color: #7FDBFF;cursor: pointer;">SIGUIENTE</button>
                                            </div>
    
                                            <div id="seccionactividad" align="center" style="border: 2px solid rgb(166, 212, 231);width: calc(100% - 14px);float: left;padding: 5px;background: aliceblue; display:none;">
                                                    
                                                    <div style="font-size: 20px;margin: 5px 0px;font-weight: bold;">Nueva actividad</div>
    
                                                    <div style="margin-top: 10px;font-size: 15px;margin: 2px 0px;">Indicaciones</div>
    
                                                    <textarea name="indicaciones" id="indicaciones" cols="30" rows="10" value="" style="margin: 0px; width: 445px; height: 63px;"></textarea>
    
                                                    <div style="margin-top: 10px;font-size: 13px;">Seleciona a que bloques pertenecera a la actividad</div>
    
                                                    <div id="contienebloques" style="font-weight: bold;font-size: 15px;width:100%;float:left;margin: 2px 0px;">
    
                                                        <input id="bloque" type="radio" value="1" name="bloque" > <label for="bloque">Bloque 1</label> 
                                                        <input id="bloque" type="radio" value="2" name="bloque" > <label for="bloque">Bloque 2</label> 
                                                        <input id="bloque" type="radio" value="3" name="bloque" > <label for="bloque">Bloque 3</label> 
                                                        <input id="bloque" type="radio" value="4" name="bloque" > <label for="bloque">Bloque 4</label> 
                                                        <input id="bloque" type="radio" value="5" name="bloque" > <label for="bloque">Bloque 5</label> 
                                                    
                                                    </div>
                                                    
                                                    <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 50px; margin-bottom: 20px;">   
                                                        <button type="submit" onclick="location.href='sesion1.php'" style="margin: 0px 10px;border-radius: 7px;padding: 5px 10px;background-color: #1d4267;font-size: 14px;border-color: #7FDBFF;color: #7FDBFF;cursor: pointer;">GUARDAR</button>
                                                    </div>
    
                                            </div>
    
                                        </form>
    
                                    </div>
  
                        </div>
    
                    <div id="contenedorboton" align="center" style="float: left; width: 100%; margin-top: 50px; margin-bottom: 20px;">
                        <button type="button" onclick="window.location='materias1.php'" style="margin: 0px 10px; border-radius: 7px; padding: 10px 15px; background-color: #8a8f95; font-size: 14px; border-color: #dedfdf; color: #ffffff; cursor: pointer;">CANCELAR</button>
                        <button type="button" onclick="window.location='materias1.php'" style="margin: 0px 10px;border-radius: 7px;padding: 10px 15px;background-color: #1d4267;font-size: 14px;border-color: #7FDBFF;color: #7FDBFF;cursor: pointer;">GUARDAR</button>
                    </div>
    
    
                </div>
                <!--FIN seccion principal-->   
                
        </div>
         
    </div>
    <!--FIN Wrapper-->

</body>
</html>
