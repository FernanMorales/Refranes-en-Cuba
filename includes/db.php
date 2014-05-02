<?php
include('mysql.php');
include('config.php');
// crear la conexion
$db = new sql_db($dbhost, $dbuser, $dbpasswd, $dbname, false);
if(!$db->db_connect_id){
die("Could not connect to the database eureka");
}