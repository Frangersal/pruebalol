<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Conamat | Admin | Usuarios</title>

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
    .menu{
        font-family: 'Montserrat', sans-serif;
        padding: 10px;
        line-height: 50px;
        text-decoration: none;
        font-size: 18px;
        color: white;
    }
    .menu:hover{
        color: #7FDBFF !important;
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
    .toprow{
        float:left;
        width: 100%;
        background-color: #0b2c4d; 
        color: white;
        height: 50px;
    }
    .topcell{
        float: left; 
        width: calc(20% - 2px);
        border: 1px solid lightgray;
        line-height: 50px;
        text-align: center;
    }
    .row{
        float:left;
        width: 100%;
        background-color: white; 
        height: 50px;
    }
    .cell{
        float: left; 
        width: calc(20% - 2px);
        border: 1px solid lightgray;
        line-height: 50px;
        text-align: center;
    }
    
    </style>
    <!--Fin estilos CSS-->

    <!--Javascript-->
    <script>
        $(document).ready(function () {

            $('#agregarusuario').click(function () {
                $('#formcrearusuario').toggle();


            });

            $("#seccion-form").hide();
    
    $('#agregar').click(function(){
    var agr = $('#agregar').text();
    if (agr == "Agregar usuario") {
    $('#agregar').html('<a href="javascript:void()" id="agregar">Cerrar</a>')
    } else {
    $('#agregar').html('<a href="javascript:void()" id="agregar">Agregar usuario</a>')
    }
    $("#seccion-form").slideToggle( "slow" );
    });

    });

</script>


<script>
    
    //
    function validaenvia() {

    if (document.form1.usuario.value == "") {
    alert("Por favor escribe el nombre del usuario");
    document.form1.usuario.focus();
    return false;
    }

    if (document.form1.pass.value == "") {
    alert("Por favor escribe la contraseña");
    document.form1.pass.focus();
    return false;
    }

    }
</script>

<script>

    function eliminar(id) {

    if (confirm("¿Estás seguro de eliminar este usuario?")==1) {

    location.href="eliminarusuario.php?id="+id;

    }

    }

</script>

<script>

    function modificar(id) {

    location.href="editarusuario.php?id="+id;

    }

</script>


        });


    <script>

        /*$("#agregar").click(function(){
            $usuarioregistrado =  $("#usuario").val();
        
            if (!!$usuarioregistrado) {
        
            $nuevafila = '<div class="row">'+
                      '  <div class="cell" style="width: calc( 20% - 2px)">1</div>'
                      +'<div class="cell" style="width: calc( 20% - 2px)">'+$usuarioregistrado+'</div>'
                        +'<div class="cell" style="width: calc( 20% - 2px)">Admin</div>'
                        +'<div class="cell" style="width: calc( 20% - 2px)"><a style="font-size: 20px; color: black; margin-top: 15px; margin-bottom: 14px;" href="../admin/editarusuario.php" class="fas fa-user-edit"></a></div>'
                        +'<div class="cell" style="width: calc( 20% - 2px)"><a style="font-size: 20px; color: black; margin-top: 15px; margin-bottom: 14px;" href="#;" class="fas fa-trash-alt"></a></div>'
                    +'</div> '
        
            $('#tablaactividad').append($nuevafila);
        
            $('#formcrearusuario').toggle();
            } 
            else {
                alert("Error, llena los campos requeridos");
            }   
         
        }); */


        //Agregar usuarios desde la base
        $('#agregar').click(function () {

            var agr = $('#agregar').text();
            if (agr == "Agregar usuario") {
                $('#agregar').html('<a href="javascript:void()" id="agregar">Cerrar</a>')
            } else {
                $('#agregar').html('<a href="javascript:void()" id="agregar">Agregar usuario</a>')
            }
            $("#seccion-form").slideToggle("slow");

        });

    </script>

<script>
        
        $('#adminmenu').hover(function{
            $(this).css("background-color", "yellow");
        });
    }
</script>

    <!--Fin del Javascript-->

</head>

<body>
    <!--Wraper contenedor -->
    <div id="wrapper" style="width: 100%; float: left; height: 100vh; background-color: #0b2c4d; position: relative;">

        <!--Menu del admin-->
        <div id="adminmenu" style="float: left; box-shadow: 0px 0px 10px #000; width: 20%; background-color: #1d4267; position: fixed; top: 0px; bottom: 0px; left: 0px;">

            <div id="logotipo" align="center" style="float: left; width: calc(100% - 60px); padding-top: 50px; padding-bottom: 30px; padding-right: 30px; padding-left: 30px;"><img
                    src="../images/logotipo.png" alt="logotipo" style="width: 100%;"></div>

            <div id="etiquetaadmin" style="font-family: 'Montserrat', sans-serif; float: left; width: calc(80% - 20px); margin-left: 10%; margin-top: 20px; margin-bottom: 50px; text-align: center; padding: 10px; border: 1px solid white; color: white; font-size: 18px; border-radius: 20px;">Menú
                admin</div>

            <div id="navegacion" style="width: 100%; float: left;">

                <div id="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>
                <a class="menu" href="index.php">Inicio</a>

                <div id="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <a class="menu" href="usuarios.php">Usuarios</a>

                <div id="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <a class="menu" href="banner.php">Banner</a>

                <div id="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <a class="menu" href="academicos.php">Académicos</a>

                <div id="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <a class="menu" href="quienessomos.php">Quienes somos</a>

                <div id="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <div id="link">Actividad</div>

                <div id="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

                <a class="menu" href="logout.php">Salir</a>

                <div id="linea" style="border-bottom: 1px solid #7FDBFF; height: 0px; width: 100%;"></div>

            </div>

        </div>
        <!--Fin menu admin-->

        <!--Cuerpo de la seccion -->
        <div id="seccionprincipal" style=" height: 100vh; float: left; width: 80%; position: relative; margin-left: 20%;">

            <!--Contenedor de los usuarios -->
            <div class="menu-card" style="float: left; width: 90%; margin: 0 5%; box-sizing: border-box; margin-top: 20px;">

                <h3 align="center" style="font-size: 20px;">Usuarios Registrados</h3>

                <div id="agregar" align="center" style="font-size: 16px; margin-top:20px; font-weight:bold;"><a href="javascript:void(0);"
                        id="agregar">Agregar usuario</a></div>

                <div id="seccion-form" style="width: 50%; height: 360px; background-color: white; box-sizing: border-box; padding: 30px; border-radius: 15px; border: 1px solid rgb(51, 51, 51); margin: 20px auto 0px; box-shadow: rgba(0, 0, 0, 0.08) 0px 0px 20px; display: none;">

                    <div id="titulo" style="width: 100%; margin-bottom: 20px; text-align: center; font-size: 25px; color: #58575d; font-weight: bold; letter-spacing: 1.6;">Crear
                        usuario</div>

                    <form id="form1" name="form1" action="usuariosbd.php" method="post" onsubmit="return(validaenvia())"
                        enctype="multipart/form-data">

                        <input id="miembro" name="miembro" type="text" value="" placeholder="Escribe un nombre de usuario"
                            style="font-size: 12px; width: 100%; margin: 10px 0; box-sizing: border-box; padding: 10px 10px; border: none; background-color: #DDE3EC; color: gray;"
                            autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                        <input id="contra" name="contra" type="password" placeholder="Escribe una contraseña" style="font-size: 12px; width: 100%; margin: 10px 0; box-sizing: border-box; padding: 10px 10px; border: none; background-color: #DDE3EC; color: gray;"
                            autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

                        <div id="subtitulo" style="width: 100%; margin-top: 10px; text-align: left; font-size: 13px; color: #58575d;">Selecciona
                            un tipo permiso para el nuevo usuario.</div>

                        <select id="permiso" name="permiso" style="float: left; width: 100%; margin: 10px 0; box-sizing: border-box; padding: 10px 10px; font-size: 15px; color: gray;">

                            <option value="administrador">Administrador</option>
                            <option value="editor">Editor</option>
                        </select>

                        <div align="center" style="width: 100%; float: left;">

                            <button style="border-radius: 5px; padding: 10px 10px; font-weight: 900; font-size: 13px; cursor: pointer; border: 1px solid #43c077; margin-top: 15px; width:200px; color: white; background-color: #43c077;">AGREGAR</button>

                        </div>

                    </form>

                </div>
                <!-- Fin seccion-form -->

                <div class="top-row">
                <div class="top-row">

                <div class="top-cell" style="width: 20%;">No.</div>
                <div class="top-cell" style="width: 20%;">NOMBRE</div>
                <div class="top-cell" style="width: 20%;">PERMISOS</div>       
                <div class="top-cell" style="width: 20%;">EDITAR</div>
                <div class="top-cell" style="width: 20%;">ELIMINAR</div>

                </div>

                <?php if ($totalRows_Recordset1 > 0) { ?>

                <?php $n = 0; 
                do { $n = $n + 1; ?>
                <div class="mensajes-row">
                <div class="cell" style="width: 20%; he"><?php echo $n; ?></div>
                <div class="cell" style="width: 20%;"><?php echo $row_Recordset1['usuario']; ?></div>   
                <div class="cell" style="width: 20%;"><?php echo $row_Recordset1['permiso']; ?></div>  
                <div class="cell" style="width: 20%;"><?php if ($usuario != $row_Recordset1['usuario']) { ?><button  class="fas fa-edit" style="width:80%; float:left; margin-left:10%; height:36px; line-height:36px; background-color:#366730; color:#fff; margin-top:5px;" onClick="javascript:modificar('<?php echo $row_Recordset1['id']; ?>');">Modificar</button><?php } ?></div>
                <div class="cell" style="width: 20%;"><?php if ($usuario != $row_Recordset1['usuario']) { ?><button style="width:80%; float:left; margin-left:10%; height:36px; line-height:36px; background-color:#810103; color:#fff; margin-top:5px;" onClick="javascript:eliminar('<?php echo $row_Recordset1['id']; ?>');">Eliminar</button><?php } ?></div>
                </div>
                <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); 
                ?>
                <?php } ?>


            </div>
            <!--Fin contenedor usuarios -->

        </div>
        <!--Fin del cuerpo de la seccion -->

    </div>
    <!--Fin del wraper contenedor -->


</body>

</html>