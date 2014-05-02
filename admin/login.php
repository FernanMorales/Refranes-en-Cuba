<?php
include('../includes/db.php');
session_start();

$usr = $_POST["usr"];
$pass = md5($_POST["pass"]);
//$pass = $_POST["pass"];
$cadena = "SELECT idusr, user FROM users WHERE user = '".$usr."' and pass = '".$pass."'";
$resultado = $db->sql_query($cadena);
$cant = $db->sql_numrows($resultado);
if ($cant == 0){
	header("Location:index.php");
	exit;
}else{
	
			session_register("usr");
			session_register("idusr");
			$_SESSION['idusr'] = $db->sql_fetchfield('idusr',0 ,$resultado);
			$_SESSION['usr'] = $db->sql_fetchfield('user',0 ,$resultado);
			header("Location: faddrefran.php");
			exit;
}
?>