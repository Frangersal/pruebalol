<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Conamat | Admin | Editar-Usuarios</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">

    <!--Libreria de las fuentes-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">

    <!--Libreria jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!--Libreria de los iconos-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">

    <!--Estilos CSS-->
    <style>
        body{
        margin: 0;
        background-color: #0b2c4d;
        font-family: 'Open Sans', sans-serif; 
    }
   
   
    #link{
        font-family: 'Montserrat', sans-serif;
        padding-left: 10px;
        padding-right: 10px;
        line-height: 50px;
        text-decoration: none;
        font-size: 18px;
        color: white;
        cursor: default;
    }
    .card{
        border: 0 solid transparent;
        -webkit-box-shadow: 0 0 20px rgba(0,0,0,.08);
        box-shadow: 0 0 20px rgba(0,0,0,.08);
        background-color: white;
        padding: 20px 50px;
        border-radius: 10px;
    }
    
    
    </style>
    <!--Fin estilos CSS-->

    <script type="text/javascript">

        $("#contenedorboton").onClick(function(){
            alert("¿Deseas guardar los cambios?");
        });

    </script>

</head>

<body>

    <!--Wraper contenedor -->
    <div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

        <!--Contenedor global-->
        <div id="contenedor-usuarios" class="card" style="width: calc(40% - 100px); margin-top: -195px; left: 50%; top: 50%; height: 350px; position: absolute; margin-left: -20%;">


            <!--Encabezado de la seccion-->
            <div id="titulo" align="center" style="padding-top: 30px; font-family: 'Montserrat', sans-serif; padding-bottom: 30px; overflow: hidden; height: 40px; font-size: 35px; color: #333; font-weight: bold; letter-spacing: 1.6px;">
                Editar Usuarios

            </div>
            <!--Fin encabezado seccion-->

            <!--Formulario editar usuario-->
            <div id="formcrearusuario">

                <div id="globalnombreinput">

                    <div id="nombreetiquetas" style="float: left; width: 30%; height: 90px;">

                        <div style="padding: 15px 0px; font-size: 14px;">
                            Usuario:
                        </div>

                        <div style="padding: 15px 0px; font-size: 14px;">
                            Contraseña:
                        </div>

                    </div>

                    <div id="inputetiquetas" style="float: left; width: 70%; height: 90px;">

                        <div id="divinput" style="width: calc(100% - 20px); padding: 10px;">
                            <input id="usuario" name="usuario" type="text" style="padding: 5px; width: 100%; font-size: 14px;">
                        </div>

                        <div id="divinput" style="padding: 10px; width: calc(100% - 20px);">
                            <input id="password" name="password" type="password" style="padding: 5px; width: 100%; font-size: 14px;">
                        </div>
                    </div>
                </div>

                <div id="permiso" style="margin-top: 20px; margin-bottom: 30px; float: left; width: 100%;">

                    <div style="float: left; padding: 5px 0px; width: 30%; font-size: 14px;">Permiso:</div>

                    <div>
                        <select name="tipopermiso" id="tipopermiso" style="float: left; margin: 5px 10px; width: calc(70% - 20px); font-size: 14px;">
                            <option value="volvo">Administrador</option>
                            <option value="saab">Editor</option>

                        </select>
                    </div>

                </div>


                <div  align="center" style="float: left; width: 100%; margin-top: 20px; margin-bottom: 20px;">
                    <button id="contenedorboton" style="padding: 10px 20px; background-color: #1d4267; border-color: #7FDBFF; color: #7FDBFF; cursor: pointer;" href="#">
                        Guardar cambios
                    </button>
                </div>

                

            </div>
            <!--Fin formulario editar usuario-->


        </div>
        <!--Fin contenedor global -->

    </div>
    <!--Fin del wraper contenedor -->

</body>

</html>
