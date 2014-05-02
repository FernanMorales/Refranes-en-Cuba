<?php
include('../includes/db.php');
$clasif = $_POST['clasif'];
if (!empty($clasif)){
$cadena = "INSERT INTO clasif (des) VALUES('".$clasif."')";
$resultado = $db->sql_query($cadena);
$cadmax = "SELECT MAX(id) AS id FROM clasif";
$resmax = $db->sql_query($cadmax);
$id = $db->sql_fetchfield('id', 0, $resmax);

header("Location: fdetalleclasif.php?refid=".$id);
}else{
	header("Location: fdetalleclasif.php");
}
?>