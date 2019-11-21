<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <script
  src="https://code.jquery.com/jquery-3.4.0.min.js"
  integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
  crossorigin="anonymous"></script>

<script>

function completalafrase() {

    $("#actividades").hide();
    $("#titulo").hide();

    $('body').load("actividades.html");



}

</script>
</head>
<style>

    #actividades>div:hover{
        background-color: darkorange; 
        color: white;
    }

</style>
<body>

   <div id="titulo" align="center" style="padding-top: 20px; font-family: 'Montserrat', sans-serif; font-size: 35px; color: #333; font-weight: bold; padding-left: 20px; line-height: 90px; letter-spacing: 1.6px;">Nueva actividad</div> 

    <div id="actividades" align="center" style="width: 100%;">

        <div id="actividad1" onclick="completalafrase();" style="width: 300px; font-size: 14px; line-height: 20px; cursor: pointer; height: 20px; margin-left: 5px; border: 1px solid #eee;">Completa la frase</div>

    </div>
</body>
</html>
