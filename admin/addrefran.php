<?php
session_start();
include('../includes/db.php');
include('../includes/localclass.php');
include('../includes/varclass.php');

$refran = $_POST['refran'];
if (!empty($refran)){
	$refran = str_replace('<p>', '',$refran);
	$refran = str_replace('</p>', '',$refran);
	$refran = addslashes($refran);
	$origen = $_POST['origen'];
	$hrefran = $_POST['hrefran'];
	//$refran = stristr($refran, '<strong>');
	$pos1 = stripos($refran, '<strong>');
	$pos2 = stripos($refran, '</strong>');
	$largo = $pos2 - $pos1-8;
	if (($pos1 !== false) and ($pos2 !== false)){
	$clave = substr($refran, $pos1+8, $largo);
	$clave = str_replace('&', '',$clave);
	}else
	$clave = "";
	$comentario = str_replace('<p>', '',$_POST['comentario']);
	$comentario = str_replace('</p>', '',$comentario);
	$comentario = addslashes($comentario);
	$cadena = "INSERT INTO refranes (des, idorigen, comentario, desm, clave) VALUES('".$refran."', ".$origen.", '".$comentario."', '".$hrefran."', '".$clave."')";
	$resultado = $db->sql_query($cadena);
	$cadmax = "SELECT MAX(id) AS id FROM refranes";
	$resmax = $db->sql_query($cadmax);
	$id = $db->sql_fetchfield('id', 0, $resmax);
	$cadclasif = "SELECT id FROM clasif";
	$resclasif = $db->sql_query($cadclasif);
	$cantclasif = $db->sql_numrows($resclasif);
	$i = 0;
	while ($i < $cantclasif) {
		$idclasif = $db->sql_fetchfield('id', $i, $resclasif);
		if (isset($_POST[$idclasif])){
			$cadena1 = "INSERT INTO refranclasif (idrefran, idclasif) VALUES('".$id."', ".$idclasif.")";
			$resultado1 = $db->sql_query($cadena1);
		}
		$i++;
	}
	if (isset($_SESSION['locaciones'])){
		$locaciones = unserialize($_SESSION['locaciones']);
		$total = $locaciones->totalitem();
		if ($total > 0){
			$i = 0;
			$locaciones->reset();
			while ($i < $total) {
				$actual = $locaciones->item();
				$codigogeo = $locaciones->index();
				$cantper = $actual['num'];
				$cadena2 = "INSERT INTO refranlocaliza (idrefran, idlocaliza, cantper) VALUES('".$id."', ".$codigogeo.", ".$cantper.")";
				$resultado2 = $db->sql_query($cadena2);
				$i++;
				$locaciones->next();
			}
		}
	}
	if (isset($_SESSION['variantes'])){
		$variantes = unserialize($_SESSION['variantes']);
		if (isset($_SESSION['locacionesvar']))
		$locacionesvar = unserialize($_SESSION['locacionesvar']);
		$totalvar = $variantes->totalvariante();
		$i = 0;
		$varactual = $variantes->primero();
		while ($i < $totalvar) {
			$tempdes = addslashes($variantes->desvariante($varactual));
			if (!empty($tempdes)){
				$cadena3 = "INSERT INTO variante (idrefran, des) VALUES('".$id."', '".$tempdes."')";
				$resultado3 = $db->sql_query($cadena3);
				if (isset($locacionesvar)){
					$totalloca = $locacionesvar->totalitem($varactual);
					if ($totalloca > 0){
						$cadmaxv = "SELECT MAX(id) AS id FROM variante";
						$resmaxv = $db->sql_query($cadmaxv);
						$idv = $db->sql_fetchfield('id', 0, $resmaxv);
						$j = 0;
						$locacionestemp = $locacionesvar->item($varactual);
						reset($locacionestemp);
						while ($j < $totalloca) {
							$locactual = current($locacionestemp);
							$idloca = key($locacionestemp);
							$cadena4 = "INSERT INTO varlocaliza (idvariante, idrefran, idlocaliza, cantper) VALUES('".$idv."', '".$id."', '".$idloca."', '".$locactual['num']."')";
							$resultado4 = $db->sql_query($cadena4);
							$j++;
							next($locacionestemp);
						}
					}
				}
			}
			$varactual = $variantes->prox($varactual);
			$i++;
		}
	}

	header("Location: fdetallerefran.php?refid=".$id);
}else{
	header("Location: fdetallerefran.php");
}
?>