<?php 

session_start();

$id = $_GET['id'];
$total = $_GET['total'];



    $nombre = "id".$total;
    $_SESSION[$nombre] = $id;

?>1
