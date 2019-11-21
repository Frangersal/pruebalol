<!DOCTYPE html>
<html lang="en">
<head>

<!--Librerias-->
<meta charset="UTF-8">
<title>Conamat en línea | Plataformaeducatica</title>
<link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
<link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<!--Estilos-->
<style>

  .table{
    color:gray;
  }

  .contain {
    display: table;
    width: 100%;
    padding-left: 20%;

  }

  * {
    box-sizing: border-box;
  }


  /* Style the header */
  .header {
    background-color: #fff;
    padding-bottom: 0px;
    padding-right: 0px;
    padding-left: 20%;
    padding-top: 20px;
    text-align: center;
    font-size: 1.5em;
    color: #354052;

  }

  /* Create three equal columns that floats next to each other */
  .column {
    float: left;
    width: calc(60% - 10px);
    border-radius: 20px;
    padding-left: 21%;
    padding-bottom: 20px;
    padding-right: 10px;
    padding-top: 10px;

    /* Should be removed. Only for demonstration */
  }

  .column-2 {
    float: left;
    width: 40%;

    border-radius: 20px;
    padding-left: 10px;
    padding-bottom: 20px;
    padding-right: 20px;
    padding-top: 10px;

    /* Should be removed. Only for demonstration */
  }


  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }

  /* Style the footer */
  .footer {
    background-color: #ddd;
    padding: 20px;
    text-align: center;
    height: auto;
    padding-left:20%;

  }

  /* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
  @media (max-width: 600px) {
    .column {
      width: 100%;
    }
  }


  /* The sticky class is added to the header with JS when it reaches its scroll position */
  .sticky {
    position: fixed;
    top: 0;
    width: 100%
  }


  /* Add some top padding to the page content to prevent sudden quick movement (as the header gets a new position at the top of the page (position:fixed and top:0) */
  .sticky+.content {
    padding-top: 102px;
  }


  body {
    margin: 0;
    font-family: "Montserrat";
  }


  /* Style the content */
  .content {
    margin-left: 200px;
    padding-left: 20px;
  }
  
  .columnone {
    font-size: 1.2em;
    font-family: 'Montserrat';
    float: left;
    width: 99%;
    border-style: solid;
    border-width: 1px;
    border: 1px solid;
    border-radius: 5px;
    border-color: #bdc3cd;
    margin: 5px;
    padding: 10px;
    background-color: #fff;
    -webkit-box-shadow: 10px 6px 28px -16px rgba(0, 0, 0, 0.44);
    -moz-box-shadow: 10px 6px 28px -16px rgba(0, 0, 0, 0.44);
    box-shadow: 10px 6px 28px -16px rgba(0, 0, 0, 0.44);

  }

  th,
  td {

    border-width: 0px;
    padding: 15px;
    width: 100%;
    font-size: 0.9em;
    border-spacing: 0px;
    text-align: justify;

  }

  tr:hover {
    background-color: #ddd;
    border-color: #ddd;

  }


  td p {
    display: none;
    border-width: 0px;

  }

  td:hover p {
    display: inline;
    margin-left: 90px;
    color: #354052;

  }

  td a:hover {
    color: "#fff";
  }


  th {
    text-align: left;
  }


  a.txtlink {
    text-decoration: none;


  }

  .txtlink a:hover {
    color: #354052;
  }


  /* Style the tab */
  .tab {
    font-family: "Montserrat";
    overflow: hidden;
    border-width: 0px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;

    background-color: #f1f1f1;
    width: 100%;
    font-family: "Montserrat";
    padding-top: 0px;
  }

  /* Style the buttons that are used to open the tab content */
  .tab button {
    font-family: "Montserrat";
    color: #354052;

    background-color: inherit;
    font-size: 1.4em;
    padding-top: 0px;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 16px 16px;
    height: 110px;
    transition: 0.3s;
    width: 16.66%;
    /* three boxes (use 25% for four, and 50% for two, etc) */
    /* if you want space between the images */
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #354052;
    color: #fff;
  }

  /* Style the tab content */

  .tabcontent {
    display: none;
    padding: 0px 0px;

    border-top: none;
    font-family: "Montserrat";
  }


  /* Style the buttons that are used to open and close the accordion panel */
  .accordion {
    font-family: 'Montserrat';
    font-size: 0.9em;
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    text-align: left;
    border-width: 0px;
    border-color: #ddd;
    outline: none;
    transition: 0.4s;
    width: 100%;
  }

  /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
  .active,
  .accordion:hover {
    background-color: #354052;
    color: #fff;

  }

  /* Style the accordion panel. Note: hidden by default */
  .panel {
    border-color: #ddd;
    width: 100%;
    padding: 18px;
    background-color: white;
    display: none;
    overflow: hidden;
    font-family: "Montserrat";

  }


  /* Reset Select */
  select {
    font-family: "Montserrat";
    font-size: 1.0em;
    text-align: center;

    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    appearance: none;
    outline: 0;
    box-shadow: none;
    border: none;
    background: #354052;
    background-image: none;
    padding-bottom: 0px;
    width: 100%
  }

  /* Remove IE arrow */
  select::-ms-expand {
    display: none;


  }

  /* Custom Select */
  .select {
    position: relative;
    display: flex;
    height: 3em;
    line-height: 3;
    background: #fff;
    overflow: hidden;
    font-size: 0.7em;
    width: 100%;

  }

  select {
    flex: 1;
    padding: 0.8em;
    color: #fff;
    cursor: pointer;

  }

  /* Arrow */
  .select::after {
    content: '\25BC';
    position: absolute;
    top: 0;
    right: 0;
    padding: 0 1em;
    background: #fff;
    cursor: pointer;
    pointer-events: none;
    -webkit-transition: .05s all ease;
    -o-transition: .05s all ease;
    transition: .05s all ease;

  }

  /* Transition */
  .select:hover::after {
    color: #354052;

  }


  .button {
    background-color: #354052;
    /* Azul */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s;
    /* Safari */
    transition-duration: 0.4s;
    font-family: "Montserrat";
  }

  .button1 {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }

  .button2:hover {
    box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
  }

  .leader {
    border-width: 1px;
    border-width-color: #ddd;
    border-color: #ddd;
  }

  table {
    border-collapse: separate;
    border-spacing: 0px;

  }

  .menu{
    font-family: 'Montserrat', sans-serif;
    float:left;
    padding: 10px;
    line-height: 30px;
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
    -webkit-box-shadow: 0 0 20px rgba(0,0,0,.08);
    box-shadow: 0 0 20px rgba(0,0,0,.08);
    background-color: white;
    padding: 10px 30px;
  }

  .progress-wrp {
    position: relative;
    border-radius: 3px;
    margin: 0px;
    text-align: left;
    background: #7FDBFF;
    color: white;
  }

  .progress-bar{
	height: 45px;
  width: 0;
  background-color: #0b2c4d;
	line-height:45px;
  }

  .status{
	top:3px;
	left:0%;
	width:100%;
	text-align:center;
	position:absolute;
	line-height:45px;
	display:inline-block;
	color: #000000;
  
  }

  .imagencurso{
    width: 100%;
    overflow: hidden;
    float: left;
    padding-bottom: 80%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;

  }

  .card a:link{
    color: black;
  }

  .card a:visited{
    color: black;
  }

  a:link{
    color: white;
    text-decoration: none;
  }

  a:visited{
    color: gray;
    text-decoration: none;

  }

  .tip:hover {
	background-color: lightblue; /* Color pendiente */
	cursor: pointer; /* reemplaza el cursor highlighter */
  }

  .delete{
    cursor: pointer;
  }
</style>
<!--Fin estilos-->

<!--Javascript-->
<script type="text/javascript">

  function changeDivContent() { 

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
      }

    }

  }

  function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";

  }
  

</script>
<!--Fin Javascript-->

</head>
<body>
    <div id="wrapper" style="width: 100%; float: left; height: 100vh;  ">

   <!--Menu plataformaeducativa-->
	<div id="seccionmenu" style="width: 20%; background-color: #354052; position: fixed; top: 0; left: 0; z-index: 999; height: 100%; box-shadow: 0px 0px 10px #000;">
	
  <a href="/plataformaeducativa/"><div id="logotipoplataforma" align="center" style="float: left; width: calc(70%); margin-top: 30px; margin-bottom: 30px; margin-left: 15%; margin-right: 15%;">
    <img src="../images/logoplataformaeducativa.png?id=<?php echo $unixtime; ?>" alt="logotipo" style="width: 100%; opacity: 0.8; float: left;">
  </div> </a>
  
  <?php if($imagenactual == "") { ?>
      
         <div id="contenedorimagenactual" align="center" style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; float: left; border: 1px solid #35405263; background-image: url(../images/iconavatar.png); background-size: cover; background-position: center;">

       </div>
        
      <?php } else if ($imagenactual != "") { ?>
      
        <div id="contenedorimagenactual" align="center" style="width: calc(100% - 40%); padding-bottom: 60%; margin-left: 20%; margin-right: 20%; margin-top: 3%; margin-bottom: 1.5%; overflow: hidden; background-color: #bec5d5; border-radius: 50%; position: relative; float: left; border: 1px solid #35405263; background-image: url(../images/<?php echo $imagenactual; ?>); background-size: cover; background-position: center;">
        
        </div>
        
      <?php } ?>
  
  <div id="nombre" align="center" style="float: left; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #abb4c1; width: 90%; letter-spacing: 0.5px; line-height: 20px; padding: 10px;">
    <?php echo $nombre ." ". $apellidopaterno ." ". $apellidomaterno; ?>
  </div>
  
  <div id="lineaseparadora1" style="width: 100%; height: 1px; background-color: #000; float: left;"></div>
  <div id="lineaseparadora2" style="width: 100%; height: 1px; background-color: #807979; float: left;"></div>
      
  <div id="opcionesmenu" style="width: 100%; float: left;">
  
    <a class="linkopcion"  href="index.php" style="text-decoration: none;">

      <div class="opcion" style="width: calc(100% - 4px); float: left; background-color: #2a3444; border-left: 4px solid #4a8ab1;">
    
        <div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
      
          <div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
            <img class="opcionicon" src="../images/iconinicio.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
          </div>
      
          <div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Inicio</div>
      
        </div>
      
      </div>

    </a>
<?php

if ($maestro != "") {
  
?>
      <a class="linkopcion" href="cursos.php" style="text-decoration: none;">
          <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
      
              <div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
          
                  <div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">

                      <img class="opcionicon" src="../images/iconcursos.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
                  </div>
          
                  <div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Cursos</div>
          
              </div>
              
          </div>
          
  </a>
  
  <a class="linkopcion" href="configuracionmaestro.php" style="text-decoration: none;">
          <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
      
              <div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
          
                  <div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">

                      <img class="opcionicon" src="../images/iconconfiguracion.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
                  </div>
          
                  <div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Configuración</div>
          
              </div>
              
          </div>
          
      </a>

      <a class="linkopcion" href="../logout.php" style="text-decoration: none;">

              <div class="opcion" style="width: calc(100% - 4px); cursor: pointer; float: left; border-left: 4px solid #354052;">
    
        <div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden; float: left;">
      
          <div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
            <img class="opcionicon" src="../images/iconsalir.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
          </div>
      
          <div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Salir</div>
      
        </div>
      
              </div>

          </a>


<?php } else { ?>

    <a class="linkopcion"  href="configuracion.php" style="text-decoration: none;">
    
      <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
      
        <div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

          <div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
            <img class="opcionicon" src="../images/iconconfiguracion.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
          </div>
      
          <div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Configuración</div>
      
        </div>
      
      </div>
      
    </a>
    
    
    <a class="linkopcion"  href="pagos.php" style="text-decoration: none;">
      <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
      
        <div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">

          <div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
            <img class="opcionicon" src="../images/iconpagos.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
          </div>
      
          <div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Pagos</div>
      
        </div>
      
      </div>
    
    </a>
    
      
    <a class="linkopcion"  href="curso.php" style="text-decoration: none;">
      <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
    
        <div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
      
          <div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
            <img class="opcionicon" src="../images/iconcursos.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
          </div>
      
          <div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Curso</div>
      
        </div>
        
      </div>
      
    </a>

 
      <div class="opcionactual" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
    
        <div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
      
          <div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
                  <img class="opcionicon" src="../images/iconeditar.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
                </div>
      
          <div class="nombreopcionactual" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Calificacion</div>
      
        </div>
        
      </div>
    
    
    <a class="linkopcion"  href="biblioteca.php" style="text-decoration: none;">
      <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
    
        <div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
      
          <div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
            <img class="opcionicon" src="../images/iconbiblioteca.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
          </div>
      
          <div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Biblioteca</div>
      
        </div>
      </div>	
    </a>
    
    <a class="linkopcion"  href="ayuda.php" style="text-decoration: none;">
      <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
    
        <div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
      
          <div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
            <img class="opcionicon" src="../images/iconayuda.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
          </div>
      
          <div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; cursor: default; margin-bottom: 10px; float: left; text-transform: uppercase;  overflow: hidden;">Ayuda</div>
      
        </div>
        
      </div>
      
    </a>
    
      
    <a class="linkopcion"  href="../logout.php" style="text-decoration: none;">
      
      <div class="opcion" style="width: calc(100% - 4px); float: left; border-left: 4px solid #354052;">
      
        <div class="contenedoropcion" style="width: calc(100% - 30px); padding-left: 15px; padding-right: 15px; padding-top: 10px; overflow: hidden;">
      
          <div class="contenedoricon" style="width: 17px; height: 16px; position: absolute; margin-right: 10px; float: left;">
            <img class="opcionicon" src="../images/iconsalir.png?id=<?php echo $unixtime; ?>" style="width: 100%; position: absolute;" />
          </div>
      
          <div class="nombreopcion" style="font-family: 'Montserrat', sans-serif; color: #a0acbf; padding-left: 30px; padding-right: 20px; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px; float: left; text-transform: uppercase; overflow: hidden;">Salir</div>
          
        </div>
      
      </div>
      
    </a>

<?php

} 

?>

      
  </div>
    
</div>
<!--Fin menu plataforma educativa-->


<div class="header" id="myHeader">
  <h2>Mis Cursos</h2>
  <div><div class="select">
  <select name="slct" id="slct">
    <option selected disabled>Seleccionar Curso</option>
    <option value="1">Preparatoria en linea</option>
    <option value="2">Lic. en Matematicas</option>
    <option value="3">Comunicacion y relaciones publicas</option>
    <option value="4">Lic en derecho</option>
  </select>
</div>
</div>
</div>

<div class="row">
  <div class="column">


<div><h2>Sesiones</h2><h4>Selecciona un Módulo</h4></div>







<!-- Tab links -->
<div class="tab">
  
  <button class="tablinks" onclick="openCity(event, 'uno')" id="defaultOpen"><h5>1</h5></button>
  <button class="tablinks" onclick="openCity(event, 'dos')"><h5>2</h5></button>
  <button class="tablinks" onclick="openCity(event, 'tres')"><h5>3</h5></button>
  <button class="tablinks" onclick="openCity(event, 'cuatro')"><h5>4</h5></button>
  <button class="tablinks" onclick="openCity(event, 'cinco')"><h5>5</h5></button>
  <button class="tablinks" onclick="openCity(event, 'seis')"><h5>6</h5></button>
</div>

<!-- Tab content -->
<div id="seis" class="tabcontent">
 

<button class="accordion">Materia 1</button>
<div class="panel">
  <p><table>
    <CENTER><h2>SESIONES DE LA MATERÍA</h2></CENTER>
  <tr style="background-color: #354052; color: #fff;">
    <th>Sesión</th>
    <th>Estatus</th>
    <th>Calificación</th>
 
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 1
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 2
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 3
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 4
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
   
  </tr>

  <tr>
    <td><a href="" class="txtlink">Sesión 5
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
   
  </tr>


</table></p>
</div>

<button class="accordion">Materia 2</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 3</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 4</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 5</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 6</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 7</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>


</div>

<div id="cinco" class="tabcontent">


<button class="accordion">Materia 1</button>
<div class="panel">
  <p><table>
    <CENTER><h2>SESIONES DE LA MATERÍA</h2></CENTER>
  <tr style="background-color: #354052; color: #fff;">
    <th>Sesión</th>
    <th>Estatus</th>
    <th>Calificación</th>
 
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 1
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 2
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 3
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 4
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
   
  </tr>

  <tr>
    <td><a href="" class="txtlink">Sesión 5
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
   
  </tr>

  <tr style="color: #354052">
    <td></td>
<td style="color: #354052"><strong>TOTAL</strong></td>
<td style="color: #354052"><strong>100%</strong></td>
  </tr>
</table></p>
</div>

<button class="accordion">Materia 2</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 3</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 4</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 5</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 6</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 7</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>



</div>

<div id="cuatro" class="tabcontent">

<button class="accordion">Materia 1</button>
<div class="panel">
  <p><table>
    <CENTER><h2>SESIONES DE LA MATERÍA</h2></CENTER>
  <tr style="background-color: #354052; color: #fff;">
    <th>Sesión</th>
    <th>Estatus</th>
    <th>Calificación</th>
 
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 1
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 2
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 3
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 4
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
   
  </tr>

  <tr>
    <td><a href="" class="txtlink">Sesión 5
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
   
  </tr>

  <tr style="color: #354052">
    <td></td>
<td style="color: #354052"><strong>TOTAL</strong></td>
<td style="color: #354052"><strong>100%</strong></td>
  </tr>
</table></p>
</div>

<button class="accordion">Materia 2</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 3</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 4</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 5</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 6</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 7</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>


</div>

<div id="tres" class="tabcontent">
 

<button class="accordion">Materia 1</button>
<div class="panel">
  <p><table>
    <CENTER><h2>SESIONES DE LA MATERÍA</h2></CENTER>
  <tr style="background-color: #354052; color: #fff;">
    <th>Sesión</th>
    <th>Estatus</th>
    <th>Calificación</th>
 
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 1
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 2
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 3
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 4
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
   
  </tr>

  <tr>
    <td><a href="" class="txtlink">Sesión 5
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
   
  </tr>

  <tr style="color: #354052">
    <td></td>
<td style="color: #354052"><strong>TOTAL</strong></td>
<td style="color: #354052"><strong>100%</strong></td>
  </tr>
</table></p>
</div>

<button class="accordion">Materia 2</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 3</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 4</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 5</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 6</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 7</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

</div>


<div id="dos" class="tabcontent">
 
 <button class="accordion">Materia 1</button>
<div class="panel">
  <p><table>
    <CENTER><h2>SESIONES DE LA MATERÍA</h2></CENTER>
  <tr style="background-color: #354052; color: #fff;">
    <th>Sesión</th>
    <th>Estatus</th>
    <th>Calificación</th>
 
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 1
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 2
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 3
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 4
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
   
  </tr>

  <tr>
    <td><a href="" class="txtlink">Sesión 5
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
   
  </tr>

  <tr style="color: #354052">
    <td></td>
<td style="color: #354052"><strong>TOTAL</strong></td>
<td style="color: #354052"><strong>100%</strong></td>
  </tr>
</table></p>
</div>

<button class="accordion">Materia 2</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 3</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 4</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 5</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 6</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 7</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

</div>

<div id="uno" class="defaultOpen">



   <button class="accordion">Materia 1</button>
<div class="panel">
  <p><table>
    <CENTER><h2>SESIONES DE LA MATERÍA</h2></CENTER>
  <tr style="background-color: #354052; color: #fff;">
    <th>Sesión</th>
    <th>Estatus</th>
    <th>Calificación</th>
 
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 1
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 2
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 3
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td><a href="" class="txtlink">Sesión 4
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
   
  </tr>

  <tr>
    <td><a href="" class="txtlink">Sesión 5
        <p class="txtlink">Abrir sesión</p>
    </a></td>
    <td>Completada</td>
    <td>20%</td>
   
  </tr>

  <tr style="color: #354052">
    <td></td>
<td style="color: #354052"><strong>TOTAL</strong></td>
<td style="color: #354052"><strong>100%</strong></td>
  </tr>
</table></p>
</div>

<button class="accordion">Materia 2</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 3</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 4</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 5</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 6</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Materia 7</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>

    
</div>















</div>

  <div class="column-2"> <div class="gfg"><table>
    <CENTER><h2>Calificaciones</h2><h4>Módulo 1</h4></CENTER>
  <tr style="background-color: #354052; color: #fff;">
    <th>Materia</th>
    <th>Maestro</th>
    <th>Calificación</th>
 
  </tr>
  <tr>
    <td>Matematicas</td>
    <td>Fernando Garcia</td>
    <td>20%</td>
    
  </tr>
  <tr>
    <td>Español</td>
    <td>Erick Castrejón</td>
    <td>15%</td>
    
  </tr>
  <tr>
    <td>Biología</td>
    <td>Enrique Liberato</td>
    <td>10%</td>
    
  </tr>
  <tr>
    <td>Historia</td>
    <td>Alexis Bello</td>
    <td>13%</td>
   
  </tr>

  <tr>
    <td><strong>TOTAL</strong></td>
<td></td>
<td><strong>100%</strong></td>
  </tr>
</table></div>

</div>


  </div>

<div class="footer">
  <button class="button button2">Volver a Inicio</button>
</div>


</div>
</body>
</html>
