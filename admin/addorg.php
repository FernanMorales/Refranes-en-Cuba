<?php
include('../includes/db.php');
$origen = $_POST['origen'];
if (!empty($origen)){
$cadena = "INSERT INTO origen (des) VALUES('".$origen."')";
$resultado = $db->sql_query($cadena);
$cadmax = "SELECT MAX(id) AS id FROM origen";
$resmax = $db->sql_query($cadmax);
$id = $db->sql_fetchfield('id', 0, $resmax);

header("Location: fdetalleorg.php?refid=".$id);
}else{
	header("Location: fdetalleorg.php");
}
?>