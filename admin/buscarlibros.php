<?php require_once('../Connections/conamatenlinea.php');

session_start();

$busqueda = addslashes($_POST['userinput']);
$busquery = trim($busqueda);
$query = "SELECT * FROM biblioteca WHERE titulo LIKE '%$busquery%'";

$numSelec = $_GET['numSelec'];
$numSelect = $numSelec + 1;

if ( $numSelec > 0 ) {
	
	$contadorSelec = 1; 
	$filtro = "";
	$queryNombre = "SELECT * FROM biblioteca WHERE titulo LIKE '%$busquery%'";

	
	do {	
	
		$filtro = $filtro." AND id != ".$_SESSION['id'.$contadorSelec];
		$contadorSelec++;
	
	} while($contadorSelec <= $numSelec);

	$query = $queryNombre.$filtro;	

}
 
if ($busqueda != '') {
	
	$query = $query." LIMIT 10";
	 
	mysql_select_db($database_conamatenlinea, $conamatenlinea);
	$query_Recordset = $query; 
	$Recordset = mysql_query($query_Recordset, $conamatenlinea) or die(mysql_error());
	$row_Recordset = mysql_fetch_assoc($Recordset);
	$totalRows_Recordset = mysql_num_rows($Recordset);

	$contador = 0;
	$maxtips  = 10; // num máximo de tips que verá el usuario

if ($totalRows_Recordset > 0) {

	do {
		
		$contador++;
		$libro  = $row_Recordset['titulo'];
        $idlibro  = $row_Recordset['id'];

			
                echo '<div id="libro'.$numSelect.'" class="tip" style="font-size:12px; padding-left:3px;">'.$libro.'<input id="idlibro'.$numSelect.'" name="idlibro'.$numSelect.'" type="hidden" value="'.$idlibro.'" /></div>';
	
	} while ($row_Recordset = mysql_fetch_assoc($Recordset));
	
}
}

 
?>


