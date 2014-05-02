<?php
session_start();
include('../includes/db.php');
include('../includes/varclass.php');
include('../includes/localclass.php');
if ($_POST['Submit'] == 'Submit'){
	if ((!empty($_POST['variantetxt'])) and (isset($_SESSION['tlocacionesvar']))){
		$variantetxt = $_POST['variantetxt'];
		/*$variantetxt = preg_replace('/<p[^>]*>/', '', $variantetxt);
		$variantetxt = ereg_replace('</p>', '<br />', $variantetxt);
		$variantetxt = ereg_replace('</p>', '<br />',$_POST['variantetxt']);
		$variantetxt = str_replace('<p>', '',$variantetxt);
		$variantetxt = str_replace('</p>', '',$variantetxt);*/
		if (isset($_SESSION['variantes']))
		$variantes = unserialize($_SESSION['variantes']);
		else
		$variantes = new variantes;

		$locacionesvartemp = unserialize($_SESSION['tlocacionesvar']);
		$totall = $locacionesvartemp->totalitem();
		if (isset($_SESSION['locacionesvar']))
		$locacionesvar = unserialize($_SESSION['locacionesvar']);
		else{
			$locacionesvar = new locacionesvar;
			$locacionesvar->items = array();
		}
		$idmod = $variantes->modificando();
		if ($idmod >= 0){
			$variantes->addvariante($idmod, $variantetxt, 0);
			$locacionesvar->items[$idmod] = $locacionesvartemp->items;
		}else{
			array_push($locacionesvar->items, $locacionesvartemp->items);
			$variantes->addvariante($locacionesvar->ultimo(), $variantetxt, 0);
		}
		//$variantes->actualmod();
		$_SESSION['variantes'] = serialize($variantes);
		unset($_SESSION['tlocacionesvar']);
	}
} else if (substr($_POST['Submit'], 0, 3) == 'dee'){
	$codigo = substr($_POST['Submit'], 3);
	$variantes = unserialize($_SESSION['variantes']);
	$variantes->delvariante($codigo);
	if ($variantes->totalvariante() <= 0)
	unset($_SESSION['variantes']);
	if (isset($_SESSION['locacionesvar'])){
		$locacionesvar = unserialize($_SESSION['locacionesvar']);
		$locacionesvar->dellocvar($codigo);
	}

}
if (isset($_SESSION['variantes'])){
	$i = 0;
	if (substr($_POST['Submit'], 0, 3) == 'mod'){
		$variantes = unserialize($_SESSION['variantes']);
		$codigo = substr($_POST['Submit'], 3);
		$variantes->actualmod();
		$variantes->cambiamod($codigo, 1);
		if (isset($_SESSION['locacionesvar']))
		$locacionesvar = unserialize($_SESSION['locacionesvar']);
	}
	$cantvar = $variantes->totalvariante();
	if ((substr($_POST['Submit'], 0, 3) == 'mod') and ($cantvar == 1))
	$cantvar = 0;

	if ($cantvar > 0){
		$varid = $variantes->primero();
		while ($i < $cantvar) {
			if ($variantes->modvariante($varid) == 0){
				$desvar = stripslashes($variantes->desvariante($varid));
				$localizaciones = '';
				if (isset($locacionesvar))
				$totall = $locacionesvar->totalitem($varid);
				else
				$totall = 0;
				if ($totall > 0){
					$j = 0;
					$localtemp = $locacionesvar->item($varid);
					ksort($localtemp);
					reset($localtemp);
					while ($j < $totall) {
						$actual = current($localtemp);
						$codigogeo = key($localtemp);
						$cant = $actual['num'];
						if ($cant == 1)
						$cant = ' / 1 vez';
						else
						$cant = ' / '.$cant.' veces';
						$localizaciones = $localizaciones.$actual["des"].$cant.'<br />';
						next($localtemp);
						$j++;
					}
				}
?>
<div id="barvariante">
<div><img src="../images/barvararr.gif" width="516" height="4" /></div>
<div id="bdelvar"><a href="javascript:;" id="dee<?php echo $varid; ?>" class="delvarb"><img src="../images/bdel.gif" border="0"></a></div>
<div class="txtbarvar"><a href="javascript:;" class="titulobarvar" id="<?php echo $varid; ?>" ><?php echo $desvar; ?></a><input name="inter<?php echo $varid; ?>" type="hidden" id="inter<?php echo $varid; ?>" value="<?php echo $i; ?>" />

<br />
<?php echo $localizaciones ?></div>
<img src="../images/barvarabj.gif" width="516" height="3" align="left" /></div>
<?php
			}
			$varid = $variantes->prox($varid);
			$i++;
		}
	}

	$_SESSION['locacionesvar'] = serialize($locacionesvar);
	$_SESSION['variantes'] = serialize($variantes);
?>
<script type="text/javascript">
<!--
$(document).ready(function() {
	$("a.titulobarvar").click(function(event){
		var actual = 'mod'+this.id;
		var intermedio = 'inter'+this.id;
		modificando = this.id;
		document.getElementById('varactual').value = this.id;
		$('#reflocalvar').ajaxSubmit({
			// target identifies the element(s) to update with the server response
			target: '#varlocal',
			beforeSubmit:  devuelta4(document.getElementById(intermedio).value),
			// success identifies the function to invoke when the server response
			// has been received; here we apply a fade-in effect to the new content
			success: function() {
				//document.formreflocal.codigogeo.options[document.formreflocal.codigogeo.selectedIndex] = null;
				$('#formvar').ajaxSubmit({
					// target identifies the element(s) to update with the server response
					target: '#variantes' ,
					data: { Submit: actual }
				});
				$('#varlocal').slideDown('slow');
			}
		});



	});
	$("a.delvarb").click(function(event){
		//alert(document.getElementById(intermedio).value);
		var actual = this.id;
		var intermedio = 'inter'+this.id.substr(3);
		//alert(intermedio);
		$('#formvar').ajaxSubmit({
			// target identifies the element(s) to update with the server response
			target: '#variantes' ,
			data: { Submit: actual },
			beforeSubmit:  function() {devuelta3(document.getElementById(intermedio).value)},
			// success identifies the function to invoke when the server response
			// has been received; here we apply a fade-in effect to the new content
			success: function() {
				$('#variantes').slideDown('slow');
			}
		});
	});
});
</script>
<?php
}
	?>