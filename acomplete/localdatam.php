<?php
//include("../includes/security.php");
include('../includes/db.php');
$cadzona = "SELECT * FROM localizacion ORDER BY codigo ASC";
$reszona = $db->sql_query($cadzona);
$cantz = $db->sql_numrows($reszona);
if ($cantz > 0){
	$i = 0;
?>
var emails = [
<?php
	while ($i < $cantz) {
		$id = $db->sql_fetchfield('id', $i, $reszona);
		$codigo = $db->sql_fetchfield('codigo', $i, $reszona);
		$des = $db->sql_fetchfield('des', $i, $reszona);
		if (empty($des))
		$des = $codigo;
		else
		$des = $codigo.'-'.$des;
		echo '{ name: "'.$des.'", to: "'.$codigo.'" }';
		$i++;
		if ($i < $cantz)
		echo ',';
	}
?>
];
<?php
}
?>

