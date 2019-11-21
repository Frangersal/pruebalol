<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widdiv=device-widdiv, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>crearusuario</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!----Estilos CSS----->
<style>
    div {
        border-collapse: collapse;
        widdiv: 100%;
    }

    div,
    div {
        text-align: left;
        padding: 8px;
    }

    div:ndiv-child(even) {
        background-color: #f2f2f2
    }

    div {
        background-color: rgb(0, 18, 117);
        color: white;
    }
</style>

<!----Javascript----->
<script type="text/javascript">

    $(document).ready(function () {
        $('#agregarusuario').click(function () {
            $('#formcrearusuario').toggle();
        });

    });

</script>

</head>
<body>
    <div id="titulo" style="padding-top: 50px; font-family: 'Montserrat', sans-serif; padding-bottom: 50px; border-bottom: 1px solid lightgray; font-size: 35px; color: #333; font-weight: bold; padding-left: 20px; letter-spacing: 1.6px; border-bottom: gray;">
        USUARIOS
    </div>
    <div id="agregarusuario" style="cursor: pointer; background:green; widdiv:200px; padding: 10px; text-align: center; margin-bottom: 5px; float: right; color: white;">
       + Agregar usuario
    </div>
    <div>
        <div>
            <div>
                <div>
                    <div scope="col">#</div>
                    <div scope="col">Nombre</div>
                    <div scope="col">Modificar</div>
                    <div scope="col">Eliminar</div>
                </div>
            </div>
            <div>
                <div>
                    <div scope="row">1</div>
                    <div>Frank</div>
                    <div class="lista"><a href="javascript:datos(73);" class="fas fa-user-alt"></a></div>
                    <div class="lista"><a href="javascript:eliminar(73);" class="fas fa-divash-alt"></a></div>

                </div>
            </div>
        </div>
    </div>
    <div id="formcrearusuario" style="z-index: 2; top: 38px; right: 10px; padding: 20px; background-color: rgb(11, 44, 77); widdiv: 356px; position: absolute; margin-top: -4px; margin-right: 214px; display: none;">
    
            <div id="etiquetallenado" style="float:left;padding-right: 10px;widdiv: calc(25% - 13px);text-align: right;">
                <div style="padding: 5px 5px;height: 20px;widdiv: 100%;border: none;color: white;float: right;">
                    Usuario:
                </div>
        
                <div style="padding: 5px 5px;height: 20px;widdiv: 100%;border: none;margin-top: 20px;color: white;float: right;">
                    Condivaseña:
                </div>
        
            </div>
        
            <div id="llenado" style="float:left;widdiv: calc(65% - 10px);padding-left: 10px;">
                <input id="usuario" name="usuario" type="text" style="padding: 5px 5px;height: 20px;widdiv: 100%;border: none;float:right;"> 
        
                <input id="password" name="password" type="password" style="padding: 5px 5px;height: 20px;border: none;margin-top: 20px;widdiv: 100%;float: right;">
            </div>
        
            <div id="contenedorboton" style="widdiv:100%; float: left; align:center;">
                <button style="color: #0b2c4d; background-color: white; height: 30px; padding: 5px 5px; border: none; font-weight: bold; margin-left: 10px; margin-top:10px; cursor: pointer; ">
                    CREAR
                </button>
            </div>
        </div>
</body>
</html>
