<?php
include('../includes/db.php');
$codigo = $_POST['codigo'];
$des = $_POST['des'];
if (!empty($codigo)){
$cadena = "INSERT INTO localizacion (codigo, des) VALUES('".$codigo."', '".$des."')";
$resultado = $db->sql_query($cadena);
$cadmax = "SELECT MAX(id) AS id FROM localizacion";
$resmax = $db->sql_query($cadmax);
$id = $db->sql_fetchfield('id', 0, $resmax);

header("Location: fdetallelocal.php?refid=".$id);
}else{
	header("Location: fdetallelocal.php");
}
?>