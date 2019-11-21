<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"></link>

    <title>Sesion</title>

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
</head>
<body>

<!--Wrapper-->
        <div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

                <!--Menu del admin-->
<div id="seccionmenu" style="width: 20%; background-color: #354052; position: fixed; top: 0; left: 0; z-index: 999; height: 100%; box-shadow: 0px 0px 10px #000;">
	
		<a href="/plataformaeducativa/"><div id="logotipoplataforma" align="center" style="float: left; width: calc(70%); margin-top: 30px; margin-bottom: 30px; margin-left: 15%; margin-right: 15%;">
			<img src="../images/logoplataformaeducativa.png?id=" alt="logotipo" style="width: 100%; opacity: 0.8; float: left;">
		</div> </a>
		
						
					<div id="contenedorimagenactual" align="center" style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; position: relative; float: left; border: 1px solid #35405263; background-image: url(../images/06052019cfb93.jpeg); background-size: cover; background-position: center;">
					
					</div>
					
						
		<div id="nombre" align="center" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #abb4c1; width: 90%; letter-spacing: 0.5px; line-height: 20px; padding: 10px;">
			Deyanira Alcantara Varela  		</div>
		
		<div id="lineaseparadora1" style="width: 100%; height: 1px; background-color: #000; float: left;"></div>
		<div id="lineaseparadora2" style="width: 100%; height: 1px; background-color: #807979; float: left;"></div>
				
		<div id="opcionesmenu" style="width: 100%; float: left;">
			
            <a class="linkopcion" href="index.php" style="text-decoration: none;">

                <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconinicio.png?id=" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Inicio</div>
				
					</div>
				
                </div>

            </a>

            <div class="opcionactual" style=" width: calc(100% - 4px); float: left; background-color: #2a3444; border-left: 4px solid #4a8ab1;">

				<div class="opcion" style="width: calc(100% - 4px); float: left;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">

							<img class="opcionicon" src="../images/iconcursos.png?id=" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Sesiones</div>
				
					</div>
					
				</div>
				
			</div>

            <a class="linkopcion" href="../logout.php" style="text-decoration: none;">

                <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
			
					<div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
				
						<div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
							<img class="opcionicon" src="../images/iconsalir.png?id=" style="width: 100%; position: absolute;" />
						</div>
				
						<div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Salir</div>
				
					</div>
				
                </div>

            </a>



		</div>

			
	</div>
                <!--FIN menu admin-->


<div id="seccionprinpal" style="width:80%; margin-left: 20%; float: left; background: white; ">


                        <div id="contenedor" style="width: calc(100% - 40px);float:left;padding: 20px;position: relative;">

                            <div id="titulomateria" style="text-align: center; font-size: 22px; font-weight: bold; margin: 20px 0px; padding: 5px; color: #187ba8; width: calc(100% - 10px);">SESION N</div>






<div id="contenedorsesion" class="card" style="width: calc(80% - 100px); float: left; margin-left: 10%;">

                <div id="seccion-form" align="center" style="width: calc(100% - 2px); background-color: white; margin-bottom: 50px; float: left;">
            
                        <form id="form1" name="form1" style="width: 90%;" action="" method="post" enctype="multipart/form-data">
            
                            <input id="id" name="id" value="" type="hidden">
            
                            <input id="titulosesion" name="titulosesion" type="text" value="" placeholder="Ingresa el título de la sesión" style="font-size: 12px; width: 100%; margin: 10px 0; box-sizing: border-box; margin-bottom: 10px; padding: 10px 10px; border: none; background-color: #DDE3EC; color: gray;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            
                            <textarea id="respuesta" name="respuesta" type="text" value="" placeholder="Ingresa texto" style="font-size: 12px;width: 100%;margin: 10px 0px;box-sizing: border-box;height: 150px;padding: 10px 10px;border: none;background-color: #DDE3EC;color: gray;resize: none;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"> </textarea>

                            <div id="titulo" style="width: 100%;text-align: center;font-size: 15px;color: #58575d;font-weight: bold;letter-spacing: 1.6;">Agregar una imagen a este texto</div>

                            <a href="javascript:void();" onclick="javascript:document.getElementById('').click();"><div id="botonfile" align="center" style="border-radius: 5px;margin: 0px 330px;border: 1px solid #1d4267;background-color: #1d4267;color: #7FDBFF;padding: 5px;cursor:pointer;width: 100px;float: left;">
            
                                    <input type="button" id="enviarfoto" name="enviarfoto" style="border:0px; background-color: #1d4267; height:0px; display:block;">
                
                                    <div style="font-size:12px;">Elegir imagen</div>
                
                                    <input type="file" id="foto0" name="foto0" onchange="javascript:enviar('0');" style="display: none;" accept="image/jpeg">  
                
                                </div></a>

                            <a href="javascript:void();" onclick="javascript:agregartexto();"><div id="botonfile" align="center" style="border-radius: 5px;margin: 10px;border: 1px solid #1d4267;background-color: #1d4267;color: #7FDBFF;padding:10px;cursor:pointer;width: 150px;float: left;">
            
                    
                                        <div style="font-size:12px;">+Agregar mas texto</div>
                    
                                        <input type="file" id="foto0" name="foto0" onchange="javascript:enviar('');" style="display: none;" accept="image/jpeg">  
                    
                                    </div></a>
            
                        </form>
            
                    </div>
        
        </div>









                   
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

        </div>
         
    </div>
    <!--FIN Wrapper-->
</body>
</html>
