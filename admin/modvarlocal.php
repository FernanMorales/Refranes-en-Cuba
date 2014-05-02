<?php
session_start();
//include('../includes/db.php');
include('../includes/localclass.php');

if (isset($_SESSION['tlocacionesvar'])){
$locaciones = unserialize($_SESSION['tlocacionesvar']);
if (isset($_POST['ordenlocalvar'])){
	$accion = substr($_POST['ordenlocalvar'], 0, 3);
	$codigo = substr($_POST['ordenlocalvar'], 3);
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
		echo '<div id="barrazul"><div id="localdes1">'.$actual["des"].' / <span class="veces">'.$cant.' </span><a href="javascript:;" id="add'.$codigogeo.'" class="bmasv"><img src="../images/bmas.gif"/ border="0"></a><a href="javascript:;" id="den'.$codigogeo.'" class="bmasv"><img src="../images/bmenosd.gif" border="0"/></a></div><div id="bdel1"><a href="javascript:;" id="dee'.$codigogeo.'" class="bdelv"><img src="../images/bdel.gif" border="0"/></a></div></div>';
	}else {
		$cant = $cant.' veces';
		echo '<div id="barrazul"><div id="localdes1">'.$actual["des"].' / <span class="veces">'.$cant.' </span><a href="javascript:;" id="add'.$codigogeo.'" class="bmasv"><img src="../images/bmas.gif"/ border="0"></a><a href="javascript:;" id="del'.$codigogeo.'" class="bmasv"><img src="../images/bmenos.gif" border="0"/></a></div><div id="bdel1"><a href="javascript:;" id="dee'.$codigogeo.'" class="bdelv"><img src="../images/bdel.gif" border="0"/></a></div></div>';
	}
	$locaciones->next();
	$i++;
}

$_SESSION['tlocacionesvar'] = serialize($locaciones);
}
//header("Location: addrefranp.php");
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