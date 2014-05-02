<?php
session_start();
include('../includes/db.php');
include('clasifclass.php');
$nohay = true;
if (isset($_POST['preferencia']))
$preferencia = $_POST['preferencia'];
else
$preferencia = 1;
switch ($preferencia){
	case 1:
		$final = "codigo = '".$_POST['codigo']."')";
		break;
	case 2:
		$final = "LEFT(codigo, 5) = '".substr($_POST['codigo'], 0, 5)."')";
		break;
	case 3:
		$final = "LEFT(codigo, 2) = '".substr($_POST['codigo'], 0, 2)."')";
		break;
}
$cadclas = "SELECT DISTINCT idrefran FROM varlocaliza WHERE idlocaliza IN (SELECT id FROM localizacion WHERE ".$final;
$resclas = $db->sql_query($cadclas);
$cantclas = $db->sql_numrows($resclas);
$arrtemp = array();
if ($cantclas > 0){
	$i = 0;
	while ($i < $cantclas) {
		$id = $db->sql_fetchfield('idrefran', $i, $resclas);
		$arrtemp[$id] += 1;
		$i++;
	}
}
	$cadref = "SELECT DISTINCT idrefran FROM refranlocaliza WHERE idlocaliza IN (SELECT id FROM localizacion WHERE ".$final;
	$resref = $db->sql_query($cadref);
	$cantref = $db->sql_numrows($resref);
	if ($cantref > 0){
		$i = 0;
		while ($i < $cantref) {
			$id = $db->sql_fetchfield('idrefran', $i, $resref);
			$arrtemp[$id] += 1;
			$i++;
		}
}
		if (count($arrtemp) > 0){
			$listaref = new listaref();
			arsort($arrtemp);
			reset($arrtemp);
				$nohay = false;
				if ($_POST['forden'] == 'popular'){
					$i = 0;
					reset($arrtemp);
					while ($i < count($arrtemp)) {
						$idrefran = key($arrtemp);
						$cantper = 0;
						$cadcantper = "SELECT SUM(cantper) AS cantper FROM refranlocaliza WHERE idrefran = ".$idrefran;
						$rescantper = $db->sql_query($cadcantper);
						$cantper = $db->sql_fetchfield('cantper', 0, $rescantper);
						$cadcantper = "SELECT SUM(cantper) AS cantper FROM varlocaliza WHERE idrefran = ".$idrefran;
						$rescantper = $db->sql_query($cadcantper);
						$cantper = $cantper + $db->sql_fetchfield('cantper', 0, $rescantper);
						$arrtemp[$idrefran] = $cantper;
						next($arrtemp);
						$i++;
					}
				}
				$i = 0;
				asort($arrtemp);
				reset($arrtemp);
				if (count($arrtemp) > 10)
				$cantref = 10;
				else
				$cantref = count($arrtemp);
				while ($i < $cantref) {
					$idrefran = key($arrtemp);
					$cadref = "SELECT * FROM refranes WHERE id = ".$idrefran;
					$resref = $db->sql_query($cadref);
					$des = $db->sql_fetchfield('des', 0, $resref);
					$listaref->addref($idrefran, $des);
					next($arrtemp);
					$i++;
					if (current($arrtemp) < $maximo)
					break;
				}
				$_SESSION['resultado'] = serialize($listaref);
			}else {
				$nohay = true;
			}
	$pregunta = $_POST['codigo'];
	$forden = $_POST['forden'];
	if ($nohay)
	header("Location: ../fbzona.php?res=1&q=".$pregunta);
	else
	header("Location: ../fbzona.php?q=".$pregunta."&pref=".$preferencia."&ford=".$forden);
?>