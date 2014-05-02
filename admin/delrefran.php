<?php
include('../includes/db.php');
$cadref = "SELECT * FROM refranes";
$resref = $db->sql_query($cadref);
$cantref = $db->sql_numrows($resref);
if ($cantref > 0){
	$i = 0;
	while ($i < $cantref) {
		$id = $db->sql_fetchfield('id', $i, $resref);
		if (isset($_POST[$id])){
			$caddelref = "DELETE FROM refranes WHERE id = '".$id."'";
			$resdelref = $db->sql_query($caddelref);
			$caddelloc = "DELETE FROM refranlocaliza WHERE idrefran = '".$id."'";
			$resdelloc = $db->sql_query($caddelloc);
			$caddelclasif = "DELETE FROM refranclasif WHERE idrefran = '".$id."'";
			$resdelclasif = $db->sql_query($caddelclasif);
			$cadvar = "SELECT * FROM variante WHERE idrefran = ".$id;
			$resvar = $db->sql_query($cadvar);
			$cantvar = $db->sql_numrows($resvar);
			if ($cantvar > 0){
				$j = 0;
				while ($j < $cantvar) {
					$idv = $db->sql_fetchfield('id', $j, $resvar);
					$caddelvloc = "DELETE FROM varlocaliza WHERE idvariante = ".$idv;
					$resdelvloc = $db->sql_query($caddelvloc);
					$j++;
				}
				$caddelvar = "DELETE FROM variante WHERE idrefran = ".$id;
				$resdelvar = $db->sql_query($caddelvar);				
			}
			}
			$i++;
	}
}

			header("Location: fdelrefran.php");
?>