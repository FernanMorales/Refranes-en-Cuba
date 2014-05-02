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
	$codigogeo = $_POST['codigogeovar'];
	$zonasgeo = unserialize($_SESSION['zonasgeo']);
	$desgeo = $zonasgeo->desgeo($codigogeo);
$veces = $_POST['veces'];
$locaciones->additem($codigogeo, $desgeo, $veces);
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
$i = 0;
$locaciones->ordenar();
$locaciones->reset();
while ($i < $total) {
	$actual = $locaciones->item();
	$codigogeo = $locaciones->index();
	$cant = $actual['num'];
	if ($cant == 1){
		$cant = '1 vez&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<div id="barrazul"><div id="localdes1">'.$actual["des"].' / <span class="veces">'.$cant.' </span><a href="javascript:;" id="add'.$codigogeo.'" class="bmasv"><img src="../images/bmas.gif"/ border="0"></a><a href="javascript:;" id="den'.$codigogeo.'" class="bmasv"><img src="../images/bmenosd.gif" border="0"/></a></div><div id="bdel1"><a href="javascript:;" id="dee'.$codigogeo.'" class="bdelv"><img src="../images/bdel.gif" border="0"/></a></div></div>';
	}else {
		$cant = $cant.' veces';
		echo '<div id="barrazul"><div id="localdes1">'.$actual["des"].' / <span class="veces">'.$cant.' </span><a href="javascript:;" id="add'.$codigogeo.'" class="bmasv"><img src="../images/bmas.gif"/ border="0"></a><a href="javascript:;" id="del'.$codigogeo.'" class="bmasv"><img src="../images/bmenos.gif" border="0"/></a></div><div id="bdel1"><a href="javascript:;" id="dee'.$codigogeo.'" class="bdelv"><img src="../images/bdel.gif" border="0"/></a></div></div>';
	}
	$locaciones->next();
	$i++;
}

$_SESSION['tlocacionesvar'] = serialize($locaciones);
?>
<script type="text/javascript">
<!--
$(document).ready(function() {
	$("a.bmasv").click(function(event){
		document.getElementById('ordenlocalvar').value = this.id;
		$('#modvarlocal').ajaxSubmit({
			// target identifies the element(s) to update with the server response
			target: '#varlocal'
		});
	});
	$("a.bdelv").click(function(event){
		document.getElementById('ordenlocalvar').value = this.id;
		$('#modvarlocal').ajaxSubmit({
			// target identifies the element(s) to update with the server response
			target: '#varlocal',
			success:  delvarlocal
		});
	});
	});
</script>