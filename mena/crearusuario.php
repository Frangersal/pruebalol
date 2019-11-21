<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>crearusuario</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!----Estilos CSS----->
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    }

    th {
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

        $("#formcrearusuario").submit(function(){
		
	    });


    });

</script>

</head>
<body>
    <div id="titulo" style="padding-top: 50px; font-family: 'Montserrat', sans-serif; padding-bottom: 50px; border-bottom: 1px solid lightgray; font-size: 35px; color: #333; font-weight: bold; padding-left: 20px; letter-spacing: 1.6px; border-bottom: gray;">
        USUARIOS
    </div>
    <div id="agregarusuario" style="cursor: pointer; background:green; width:200px; padding: 10px; text-align: center; margin-bottom: 5px; float: right; color: white;">
       + Agregar usuario
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Modificar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">1</td>
                    <td>Frank</td>
                    <td class="lista"><a href="javascript:datos(73);" class="fas fa-user-alt"></a></td>
                    <td class="lista"><a href="javascript:eliminar(73);" class="fas fa-trash-alt"></a></td>

                </tr>
            </tbody>
        </table>
    </div>
    <div id="formcrearusuario" style="z-index: 2; top: 38px; right: 10px; padding: 20px; background-color: rgb(11, 44, 77); width: 356px; position: absolute; margin-top: -4px; margin-right: 214px; display: none;">
    
            <div id="etiquetallenado" style="float:left;padding-right: 10px;width: calc(25% - 13px);text-align: right;">
                <div style="padding: 5px 5px;height: 20px;width: 100%;border: none;color: white;float: right;">
                    Usuario:
                </div>
        
                <div style="padding: 5px 5px;height: 20px;width: 100%;border: none;margin-top: 20px;color: white;float: right;">
                    Contraseña:
                </div>
        
            </div>
        
            <div id="llenado" style="float:left;width: calc(65% - 10px);padding-left: 10px;">
                <input id="usuario" name="usuario" type="text" style="padding: 5px 5px;height: 20px;width: 100%;border: none;float:right;"> 
        
                <input id="password" name="password" type="password" style="padding: 5px 5px;height: 20px;border: none;margin-top: 20px;width: 100%;float: right;">
            </div>
        
            <div id="contenedorboton" style="width:100%; float: left; align:center;">
                <button type="submit" style="color: #0b2c4d; background-color: white; height: 30px; padding: 5px 5px; border: none; font-weight: bold; margin-left: 10px; margin-top:10px; cursor: pointer; ">
                    CREAR
                    <input type="submit" value="Entrar" style="display:none;" />
                </button>
            </div>
        </div>
</body>
</html>