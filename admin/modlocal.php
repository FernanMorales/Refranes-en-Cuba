<?php
include('../includes/db.php');
$des = $_POST['des'];
$codigo = $_POST['codigo'];
$localid = $_POST['localid'];
if (!empty($codigo)){
$cadena = "UPDATE localizacion SET des = '".$des."', codigo = '".$codigo."' WHERE id = ".$localid;
$resultado = $db->sql_query($cadena);

header("Location: fdetallelocal.php?refid=".$localid);
}else{
	header("Location: fdetallelocal.php");
}
?>