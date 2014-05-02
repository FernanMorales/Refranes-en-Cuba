<?php
session_start();
//include('../includes/db.php');
include('../includes/localclass.php');

if (isset($_SESSION['locaciones'])){
$locaciones = unserialize($_SESSION['locaciones']);
if (isset($_POST['ordenlocal'])){
	$accion = substr($_POST['ordenlocal'], 0, 3);
	$codigo = substr($_POST['ordenlocal'], 3);
	if ($accion == 'add'){
		$locaciones->unomas($codigo, 1);
	}else if ($accion == 'del'){
		$locaciones->delitem($codigo, 1);
	}else if ($accion == 'dee'){
		$locaciones->deleteitem($codigo);
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
		echo '<div id="barragris"><div id="localdes">'.$actual["des"].' / <span class="veces">'.$cant.' </span><a href="javascript:;" id="add'.$codigogeo.'" class="bmas"><img src="../images/bmas.gif"/ border="0"></a><a href="javascript:;" id="den'.$codigogeo.'" class="bmas"><img src="../images/bmenosd.gif" border="0"/></a></div><div id="bdel"><a href="javascript:;" id="dee'.$codigogeo.'" class="bdel"><img src="../images/bdel.gif" border="0"/></a></div></div>';
	}else {
		$cant = $cant.' veces';
		echo '<div id="barragris"><div id="localdes">'.$actual["des"].' / <span class="veces">'.$cant.' </span><a href="javascript:;" id="add'.$codigogeo.'" class="bmas"><img src="../images/bmas.gif"/ border="0"></a><a href="javascript:;" id="del'.$codigogeo.'" class="bmas"><img src="../images/bmenos.gif" border="0"/></a></div><div id="bdel"><a href="javascript:;" id="dee'.$codigogeo.'" class="bdel"><img src="../images/bdel.gif" border="0"/></a></div></div>';
	}
	$locaciones->next();
	$i++;
}

$_SESSION['locaciones'] = serialize($locaciones);
}
//header("Location: addrefranp.php");
?>
<script type="text/javascript">
<!--
$(document).ready(function() {
	$("a.bmas").click(function(event){
		document.getElementById('ordenlocal').value = this.id;
		$('#modreflocal').ajaxSubmit({
			// target identifies the element(s) to update with the server response
			target: '#reflocal'
		});
	});
	$("a.bdel").click(function(event){
		document.getElementById('ordenlocal').value = this.id;
		$('#modreflocal').ajaxSubmit({
			// target identifies the element(s) to update with the server response
			target: '#reflocal',
			success:  delreflocal
		});
	});
	});
</script>