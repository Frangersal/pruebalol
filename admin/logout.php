<?php

session_start();
$_SESSION['usuario'] = NULL;
header("Location: login.php");
exit;

?>