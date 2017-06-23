<?php

$conn_error = 'Greska';
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = 'admin';
$mysql_db = 'prodaja';
$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);

if(!$con || !mysqli_select_db($con, $mysql_db)) {
    die($conn_error);
}
?>