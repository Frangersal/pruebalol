<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conamatenlinea = "conamatenlinea2.db.14061182.9ac.hostedresource.net";
$database_conamatenlinea = "conamatenlinea2";
$username_conamatenlinea = "conamatenlinea2";
$password_conamatenlinea = "klo90#Lkp";
$conamatenlinea = mysql_pconnect($hostname_conamatenlinea, $username_conamatenlinea, $password_conamatenlinea) or trigger_error(mysql_error(),E_USER_ERROR); 

?>
