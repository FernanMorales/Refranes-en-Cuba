<?php
session_start();
include('../includes/db.php');
include('clasifclass.php');
$nohay = true;
$cadorigen = "SELECT * FROM origen WHERE id = ".$_POST['origen'];
$resorigen = $db->sql_query($cadorigen);
$cantorigen = $db->sql_numrows($resorigen);
if ($cantorigen > 0){
	$id = $_POST['origen'];
	$listaref = new listaref();
	$arrtemp = array();
	$contorigen = 1;
	$pregunta = $id;
	$cadreforigen = "SELECT * FROM refranes WHERE idorigen = ".$id." ORDER BY des ASC";
	$resreforigen = $db->sql_query($cadreforigen);
	$cantreforigen = $db->sql_numrows($resreforigen);
	if ($cantreforigen > 0){
		$j = 0;
		while ($j < $cantreforigen) {
			$idrefran = $db->sql_fetchfield('id', $j, $resreforigen);
			$arrtemp[$idrefran] += 1;
			$j++;
		}
	}
	if (count($arrtemp) > 0){
		arsort($arrtemp);
		reset($arrtemp);
		$maximo = current($arrtemp);
			$nohay = false;
			$arrtemp = array_keys($arrtemp);
			$arrtemp = array_flip($arrtemp);
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
}

	$forden = $_POST['forden'];
if ($nohay)
header("Location: ../fborigen.php?res=1&q=".$pregunta);
else
header("Location: ../fborigen.php?q=".$pregunta."&ford=".$forden);
?>