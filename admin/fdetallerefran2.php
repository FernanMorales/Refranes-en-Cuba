<?php
include("../includes/security.php");
include('../includes/db.php');
include('../includes/localclass.php');
include('../includes/varclass.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administracion Sitio refranes</title>
<link href="../style/refranes.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

function calcHeight(nombre)
{
	//find the height of the internal page
	var the_height=
	document.getElementById(nombre).contentWindow.
	document.body.scrollHeight+200;
	//alert(the_height);
	//change the height of the iframe
	document.getElementById(nombre).height=
	the_height;
}

function redireccionar(dir)
{
	window.parent.contenido.location.href = dir;
}

</script>
</head>

<body>
<table width="725" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="765"><div id="main">
	 <div id="contenido">
	  <?php include('menu.php') ?>
	   <div id="titulo">Detalle refr&aacute;n <div id="logout"><a href="logout.php" class="elemento logout">Salir</a></div></div>
	   	  <div id="cajaizq">
<?php
if (isset($_GET['refid'])){
	$refid = $_GET['refid'];
	$cadref = "SELECT * FROM refranes WHERE id = ".$refid;
	$resref = $db->sql_query($cadref);
	$des = stripslashes($db->sql_fetchfield('des', 0, $resref));
$comentario = stripslashes($db->sql_fetchfield('comentario', 0, $resref));
	$idorigen = $db->sql_fetchfield('idorigen', 0, $resref);
	echo '<div class="titulo">Refr&aacute;n modelo o tipo</div>';
	echo '<div id="detalles" style="font-size:12pt">'.$des.'</div>';
	echo '<div class="titulo">Comentario</div>';
echo '<div id="detalles">'.$comentario.'</div>';
	$cadorg = "SELECT * FROM origen WHERE id = ".$idorigen;
	$resorg = $db->sql_query($cadorg);
	$desorigen = $db->sql_fetchfield('des', 0, $resorg);
	echo '<div class="titulo1">Origen</div>';
	echo '<div id="detalles">'.$desorigen.'</div>';
	$cadclasif = "SELECT * FROM refranclasif WHERE idrefran = ".$refid;
	$resclasif = $db->sql_query($cadclasif);
	$cantclasif = $db->sql_numrows($resclasif);
	$i = 0;
	if ($cantclasif > 0){
		echo '<div class="titulo1">Clasificacion</div><div id="detalles">';
		while ($i < $cantclasif) {
			$idclasif = $db->sql_fetchfield('idclasif', $i, $resclasif);
			$cadclas = "SELECT * FROM clasif WHERE id = ".$idclasif;
			$resclas = $db->sql_query($cadclas);
			$desclasif = $db->sql_fetchfield('des', 0, $resclas);
			echo $desclasif.'<br />';
			$i++;
		}
		echo '</div>';
	}

	$cadrefl = "SELECT * FROM refranlocaliza WHERE idrefran = ".$refid." ORDER BY idlocaliza ASC";
	$resrefl = $db->sql_query($cadrefl);
	$cantrefl = $db->sql_numrows($resrefl);

	if ($cantrefl > 0){
		echo '<div class="titulo1">Localización geográfica</div>';
?>
		   <div id="detalles">
  <table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#999999" class="tablaficha">
    <tr>
      <td width="69%">C&oacute;digo geogr&aacute;fico</td>
      <td width="21%">Cantidad de veces</td>
      <td width="10%" class="total">TOTAL</td>
    </tr>
<?php
$i = 0;
$totaltemp = 0;
if ($cantrefl > 1){
while ($i < $cantrefl) {
	$idloca = $db->sql_fetchfield('idlocaliza', $i, $resrefl);
	$cantper = $db->sql_fetchfield('cantper', $i, $resrefl);
	$cadloca = "SELECT * FROM localizacion WHERE id = ".$idloca." ORDER BY codigo ASC";
	$resloca = $db->sql_query($cadloca);
	$desloca = $db->sql_fetchfield('des', 0, $resloca);
	$codigogeo = $db->sql_fetchfield('codigo', 0, $resloca);
	if (empty($desloca))
	$desloca = $codigogeo;
	else
	$desloca = $codigogeo.'-'.$desloca;
	$totaltemp = $totaltemp + $cantper;
?>
    <tr>
      <td class="detficha"><?php echo $desloca; ?></td>
      <td class="detficha"><?php echo $cantper; ?></td>
      <td class="detficha">&nbsp;</td>
    </tr>
<?php
$i++;
if (!($i < $cantrefl-1))
break;
}
}
$idloca = $db->sql_fetchfield('idlocaliza', $i, $resrefl);
$cantper = $db->sql_fetchfield('cantper', $i, $resrefl);
$cadloca = "SELECT * FROM localizacion WHERE id = ".$idloca." ORDER BY codigo ASC";
$resloca = $db->sql_query($cadloca);
$desloca = $db->sql_fetchfield('des', 0, $resloca);
$codigogeo = $db->sql_fetchfield('codigo', 0, $resloca);
if (empty($desloca))
$desloca = $codigogeo;
else
$desloca = $codigogeo.'-'.$desloca;
$totaltemp = $totaltemp + $cantper;
?>    
    <tr>
      <td class="detficha"><?php echo $desloca; ?></td>
      <td class="detficha"><?php echo $cantper; ?></td>
      <td class="detficha"><?php echo $totaltemp; ?></td>
    </tr>
  </table>
		   </div>
<?php
$totalgral = $totalgral + $totaltemp;
	}

	$cadvar = "SELECT * FROM variante WHERE idrefran = ".$refid." ORDER BY des";
	$resvar = $db->sql_query($cadvar);
	$cantvar = $db->sql_numrows($resvar);


if ($cantvar > 0){
	echo '<div class="titulo1">Variantes</div>';
	echo '<div class="detallevar" id="cajavar" style="padding:5px">';
	//$totalgral = 0;
	$i = 0;
	while ($i < $cantvar) {
		$idvar = $db->sql_fetchfield('id', $i, $resvar);
		$desvar = stripslashes($db->sql_fetchfield('des', $i, $resvar));
		$cadvloca = "SELECT * FROM varlocaliza WHERE idvariante = ".$idvar." ORDER BY idlocaliza ASC";
		$resvloca = $db->sql_query($cadvloca);
		$cantvloca = $db->sql_numrows($resvloca);


		echo '<div id="detallesvar" >'.$desvar.'</div>';
		if ($cantvloca > 0){
			echo '<div class="titulo1">Localización geográfica</div>';
			echo '<div id="detalles" style="padding:0px; width:518px">';
?>
<table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#999999" class="tablaficha">
<tr>
      <td width="69%">C&oacute;digo geogr&aacute;fico</td>
      <td width="21%">Cantidad de veces</td>
      <td width="10%" class="total">TOTAL</td>
    </tr>
<?php
$j = 0;
$totaltemp = 0;
if ($cantvloca > 1){
while ($j < $cantvloca) {
	$cantper = $db->sql_fetchfield('cantper', $j, $resvloca);
	$idloca = $db->sql_fetchfield('idlocaliza', $j, $resvloca);
	$cadloca = "SELECT * FROM localizacion WHERE id = ".$idloca." ORDER BY codigo ASC";
$resloca = $db->sql_query($cadloca);
$desloca = $db->sql_fetchfield('des', 0, $resloca);
$codigogeo = $db->sql_fetchfield('codigo', 0, $resloca);
if (empty($desloca))
$desloca = $codigogeo;
else
$desloca = $codigogeo.'-'.$desloca;	
$totaltemp = $totaltemp + $cantper;
?>  
    <tr>
      <td class="detficha"><?php echo $desloca; ?></td>
      <td class="detficha"><?php echo $cantper; ?></td>
      <td class="detficha">&nbsp;</td>
    </tr>
<?php
$j++;

if ($j >= $cantvloca-1)
break;
}
}

		$idloca = $db->sql_fetchfield('idlocaliza', $j, $resvloca);
	$cantper = $db->sql_fetchfield('cantper', $j, $resvloca);
		$cadloca = "SELECT * FROM localizacion WHERE id = ".$idloca." ORDER BY codigo ASC";
$resloca = $db->sql_query($cadloca);
$desloca = $db->sql_fetchfield('des', 0, $resloca);
$codigogeo = $db->sql_fetchfield('codigo', 0, $resloca);
if (empty($desloca))
$desloca = $codigogeo;
else
$desloca = $codigogeo.'-'.$desloca;	
$totaltemp = $totaltemp + $cantper;
$totalgral = $totalgral + $totaltemp;
?>
    <tr>
      <td class="detficha"><?php echo $desloca; ?></td>
      <td class="detficha"><?php echo $cantper; ?></td>
      <td class="detficha"><?php echo $totaltemp; ?></td>
    </tr>
  </table>
		   
<?php
echo ' </div>';
		}
$i++;
//
}
echo ' </div>';
}

if ($totalgral > 0){
?>
<div id="detalles" style="margin-top:10px; width:528px">
<table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#999999" class="tablaficha">
<tr>
      <td class="detficha" width="68%">&nbsp;</td>
      <td width="21%" class="detficha"><strong>TOTAL</strong></td>
      <td width="11%" class="total"><?php echo $totalgral; ?></td>
    </tr>
  </table>
 </div>
<?php
}
echo '<div id="refran1"><br /><a href="fmodrefran.php?ref='.$refid.'" class="elemento">Modificar este refr&aacute;n</a><br /></div>';
}else{
	echo '<br />Ocurrio un problema en la adición de este refran. Intentelo nuevamente.';
	echo '<div id="refran1" style="height:500px"><a href="fmodrefran.php?ref='.$refid.'" class="elemento">Modificar este refr&aacute;n</a></div>';
}
?>

	</div>   	  
	</div>
	</div></td>
  </tr>
</table>
</body>
</html>
