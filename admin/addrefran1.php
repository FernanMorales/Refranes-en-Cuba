<?php
session_start();
include('../includes/db.php');
include('../includes/localclass.php');

if (isset($_SESSION['locaciones']))
$locaciones = unserialize($_SESSION['locaciones']);
else
$locaciones = new locaciones;
if (isset($_POST['Submit'])){
if ($_POST['Submit'] != 'Submit'){
	$codigo = substr($_POST['Submit'], 3);
	$cadzona = "SELECT codigo, des FROM localizacion WHERE id=".$codigo;
}else if (isset($_POST['codigogeo']))
$cadzona = "SELECT codigo, des FROM localizacion WHERE id=".$_POST['codigogeo'];
$reszona = $db->sql_query($cadzona);
$codigogeo = $db->sql_fetchfield('codigo', 0, $reszona);
$desgeo = $db->sql_fetchfield('des', 0, $reszona);
if (empty($desgeo))
$desgeo = $codigogeo;
else
$desgeo = $codigogeo.'-'.$desgeo;
if ($_POST['Submit'] != 'Submit'){
	$accion = substr($_POST['Submit'], 0, 3);
	if ($accion == 'add'){
		$locaciones->additem($codigo, $desgeo, 1);
	}else if ($accion == 'del'){
		$locaciones->delitem($codigo, 1);
	}else{
		$locaciones->deleteitem($codigo);
	}
}else{
	$codigogeo = $_POST['codigogeo'];
	$veces = $_POST['veces'];
	$locaciones->additem($codigogeo, $desgeo, $veces);
}
}
$total = $locaciones->totalitem();
$i = 0;
$locaciones->ordenar();
$locaciones->reset();
while ($i < $total) {
	$actual = $locaciones->item();
	$codigogeo = $locaciones->index();
	$cant = $actual['num'];
	if ($cant == 1){
		$cant = '1 vez&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<div id="barragris"><div id="localdes">'.$actual["des"].' / <span class="veces">'.$cant.' </span><input name="Submit" class="bmas" type="image" value="add'.$codigogeo.'" src="../images/bmas.gif"/><input type="image" class="bmas" src="../images/bmenosd.gif"/></div><div id="bdel"><input name="Submit" type="image" value="dee'.$codigogeo.'" src="../images/bdel.gif" /></div></div>';
	}else {
		$cant = $cant.' veces';
		echo '<div id="barragris"><div id="localdes">'.$actual["des"].' / <span class="veces">'.$cant.' </span><input name="Submit" class="bmas" type="image" value="add'.$codigogeo.'" src="../images/bmas.gif"/><input name="Submit" class="bmas" type="image" value="del'.$codigogeo.'" src="../images/bmenos.gif"/></div><div id="bdel"><input name="Submit" type="image" value="dee'.$codigogeo.'" src="../images/bdel.gif" /></div></div>';
	}
	$locaciones->next();
	$i++;
}

$_SESSION['locaciones'] = serialize($locaciones);
//header("Location: addrefranp.php");
?>
