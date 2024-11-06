<?php
//$hostname = 'localhost';
$hostname = 'localhost';
//$dbname   = 'inventory_management';
$dbname   = 'ticket_management_system';
//$dbusername = 'u227620396_rajcom';
//$dbusername = 'u227620396_rajcom';
$dbusername = 'root';
//$dbpassword = 'Rajcom0@@';
$dbpassword = '';
$connection = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
if(!$connection)
{
    die("database connection failed." . mysql_error());
}
?>