<?php
session_start();
include('../includes/db.php');
include('clasifclass.php');
$cadclas = "SELECT * FROM clasif ORDER BY des ASC";
$resclas = $db->sql_query($cadclas);
$cantclas = $db->sql_numrows($resclas);
if ($cantclas > 0){
	$listaref = new listaref();
	$arrtemp = array();
	$contclas = 0;
	$i = 0;
	$pregunta = '';
	while ($i < $cantclas) {
		$id = $db->sql_fetchfield('id', $i, $resclas);
		$clasdes = $db->sql_fetchfield('id', $i, $resclas);
		if (isset($_POST[$id])){
			$contclas += 1;
			if (!empty($pregunta))
			$pregunta = $pregunta.',';
			$pregunta = $pregunta.$id;
			$cadrefclas = "SELECT * FROM refranclasif WHERE idclasif = ".$id." ORDER BY idrefran ASC";
			$resrefclas = $db->sql_query($cadrefclas);
			$cantrefclas = $db->sql_numrows($resrefclas);
			if ($cantrefclas > 0){
				$j = 0;
				while ($j < $cantrefclas) {
					$idrefran = $db->sql_fetchfield('idrefran', $j, $resrefclas);
					$arrtemp[$idrefran] += 1;
					$j++;
				}
			}
		}
		$i++;
	}
	if (count($arrtemp) > 0){
		arsort($arrtemp);
		reset($arrtemp);
		$maximo = current($arrtemp);
		if ($maximo == $contclas){
			$nohay = false;
			$arrtemp = array_keys($arrtemp, $maximo);
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
}
if ($nohay)
header("Location: ../fbtema.php?res=1&q=".$pregunta);
else
header("Location: ../fbtema.php?q=".$pregunta);
?>