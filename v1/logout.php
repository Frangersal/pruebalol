<?php

session_start();
if ($_SESSION['usuario'] != NULL){
	$_SESSION['usuario'] = NULL;
}
if ($_SESSION['sesionalumno'] != NULL){
	$_SESSION['sesionalumno'] = NULL;
}
if ($_SESSION['sesionmaestro'] != NULL){
	$_SESSION['sesionmaestro'] = NULL;
}

header("Location: /");
exit;

?>
