<?php
include('../includes/db.php');
$origen = $_POST['origen'];
$orgid = $_POST['orgid'];
if (!empty($origen)){
$cadena = "UPDATE origen SET des = '".$origen."' WHERE id = ".$orgid;
$resultado = $db->sql_query($cadena);

header("Location: fdetalleorg.php?refid=".$orgid);
}else{
	header("Location: fdetalleorg.php");
}
?>