<?php
include('../includes/db.php');
$clasif = $_POST['clasif'];
$clasifid = $_POST['clasifid'];
if (!empty($clasif)){
$cadena = "UPDATE clasif SET des = '".$clasif."' WHERE id = ".$clasifid;
$resultado = $db->sql_query($cadena);

header("Location: fdetalleclasif.php?refid=".$clasifid);
}else{
	header("Location: fdetalleclasif.php");
}
?>