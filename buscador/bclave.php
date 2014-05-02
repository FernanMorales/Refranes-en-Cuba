<?php
session_start();
include('../includes/db.php');
include('clasifclass.php');
function eliminaarticulos($palabras){
	$articulos = array('en', 'el', 'al', 'la', 'lo', 'le', 'de', 'del', 'las', 'los', 'les', 'y', 'a', 'que', 'no');
	$aux = $palabras;
	foreach ($aux as $llave=>$valor){
		if (in_array(strtolower($valor), $articulos)) {
			unset($palabras[$llave]);
		}
	}
	return $palabras;
}

$nohay = true;
if (isset($_POST['buscar'])){
	$clave = $_POST['buscar'];
	$listaref = new listaref();
	$arrtemp = array();
	//$contorigen = 1;
	$pregunta = $clave;
	$palabras = explode(" ", $pregunta);
	if (count($palabras)>1)
	$palabras = eliminaarticulos($palabras);
	$cadreforigen = "SELECT * FROM refranes";
	$resreforigen = $db->sql_query($cadreforigen);
	$cantreforigen = $db->sql_numrows($resreforigen);
	if ($cantreforigen > 0){
		$j = 0;
		while ($j < $cantreforigen) {
			$idrefran = $db->sql_fetchfield('id', $j, $resreforigen);
			$des = $db->sql_fetchfield('desm', $j, $resreforigen);
			$listaref->addref($idrefran, $des);
			$j++;
		}
		$j = 0;
		while ($j < count($palabras)) {
			$resultado = $listaref->buscar(current($palabras), false, $resultado);
			//$resultado = $listaref->buscar(current($palabras), true, $resultado);
			next($palabras);
			$j += 1;
		}
		$i = 0;
		arsort($resultado);
		reset($resultado);
		$cant = count($resultado);
		$listaref1 = new listaref();
		while ($i < $cant){
			$idrefran = key($resultado);
			if ($resultado[$idrefran]['num'] == 0)
			break;
			$des = $listaref->desref($idrefran);
			$listaref1->addref($idrefran, $des);
			$nohay = false;
			next($resultado);
			$i += 1;
		}
		if ($listaref->total() > 0)
		$_SESSION['resultado'] = serialize($listaref1);
	}
}
if ($nohay)
header("Location: ../fbclave.php?res=1&q=".$pregunta);
else
header("Location: ../fbclave.php?q=".$pregunta);
?>