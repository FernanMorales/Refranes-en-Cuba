<?php
include('../includes/db.php');
$cadref = "SELECT * FROM origen";
$resref = $db->sql_query($cadref);
$cantref = $db->sql_numrows($resref);
if ($cantref > 0){
	$i = 0;
	while ($i < $cantref) {
		$id = $db->sql_fetchfield('id', $i, $resref);
		if (isset($_POST[$id])){
			$caddelref = "DELETE FROM origen WHERE id = '".$id."'";
			$resdelref = $db->sql_query($caddelref);
			}
			$i++;
	}
}

 header("Location: fdelorigen.php");
?>