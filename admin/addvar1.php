<?php
session_start();
include('../includes/db.php');
include('../includes/localclass.php');
include('../includes/varclass.php');

if (isset($_SESSION['tlocacionesvar']))
$locaciones = unserialize($_SESSION['tlocacionesvar']);
else
$locaciones = new locaciones;
if (isset($_POST['Submit'])){
	if ($_POST['Submit'] != 'Submit'){
		$codigo = substr($_POST['Submit'], 3);
		$accion = substr($_POST['Submit'], 0, 3);
		if ($accion == 'add'){
			$locaciones->unomas($codigo, 1);
		}else if ($accion == 'del'){
			$locaciones->delitem($codigo, 1);
		}else{
			$locaciones->deleteitem($codigo);
		}
		//$cadzona = "SELECT codigo, des FROM localizacion WHERE id=".$codigo;
	}else if (isset($_POST['codigogeovar'])){
		$cadzona = "SELECT codigo, des FROM localizacion WHERE id=".$_POST['codigogeovar'];
		$reszona = $db->sql_query($cadzona);
		$codigogeo = $db->sql_fetchfield('codigo', 0, $reszona);
		$desgeo = $db->sql_fetchfield('des', 0, $reszona);
		if (empty($desgeo))
		$desgeo = $codigogeo;
		else
		$desgeo = $codigogeo.'-'.$desgeo;

		$codigogeo = $_POST['codigogeovar'];
		$veces = $_POST['veces'];
		$locaciones->additem($codigogeo, $desgeo, $veces);
	}
} else if (isset($_POST['varactual'])){
	//$locacionesvar = new locacionesvar;
	$locacionesvar = unserialize($_SESSION['locacionesvar']);
	$locaciones = new locaciones;
	$locaciones->items = array();
	$locaciones->items = $locacionesvar->items[$_POST['varactual']];
	/*$locacionesvar->dellocvar($_POST['varactual']);
	if ($locacionesvar->totalvar() > 0)
	$_SESSION['locacionesvar'] = serialize($locacionesvar);
	else
	unset($_SESSION['locacionesvar']);*/
}
$total = $locaciones->totalitem();
if ($total > 0){
$i = 0;
$locaciones->ordenar();
$locaciones->reset();
while ($i < $total) {
	$actual = $locaciones->item();
	$codigogeo = $locaciones->index();
	$cant = $actual['num'];
	if ($cant == 1){
		$cant = '1 vez&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<div id="barrazul" ><div id="localdes1">'.$actual["des"].' / <span class="veces">'.$cant.' </span><input name="Submit" class="bmas" type="image" value="add'.$codigogeo.'" src="../images/bmas.gif"/><input type="image" class="bmas" src="../images/bmenosd.gif"/></div><div id="bdel1"><input name="Submit" type="image" value="dee'.$codigogeo.'" src="../images/bdel.gif" /></div></div>';
	}else {
		$cant = $cant.' veces';
		echo '<div id="barrazul"><div id="localdes1">'.$actual["des"].' / <span class="veces">'.$cant.' </span><input name="Submit" class="bmas" type="image" value="add'.$codigogeo.'" src="../images/bmas.gif"/><input name="Submit" class="bmas" type="image" value="del'.$codigogeo.'" src="../images/bmenos.gif"/></div><div id="bdel1"><input name="Submit" type="image" value="dee'.$codigogeo.'" src="../images/bdel.gif" /></div></div>';
	}
	$locaciones->next();
	$i++;
}

$_SESSION['tlocacionesvar'] = serialize($locaciones);
}else 
unset($_SESSION['tlocacionesvar']);
?>
