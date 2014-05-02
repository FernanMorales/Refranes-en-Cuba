<?php
session_start();
include('includes/db.php');
include('buscador/clasifclass.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Refranes cubanos</title>
<link href="style/srefranes.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="acordion/toggleElements.css" />

<script type="text/javascript" src="acordion/jquery-latest.pack.js"></script>
<script type="text/javascript" src="acordion/pluginpage.js"></script>
<script type="text/javascript" src="acordion/jquery.toggleElements.pack.js"></script>
<script type="text/JavaScript">
<!--

	$(document).ready(function(){
		$('div.toggler-1, div.toggler-2').toggleElements( );
		
	});
	

//-->
</script>
</head>

<body>
<table width="849" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="images/arrimg.jpg" width="800" height="137" /></td>
      </tr>
      <tr>
        <td><div id="barranar">
            <div id="menu"><a href="index.php">Inicio</a> | <a href="sobreref.php">Sobre los refranes</a> | <a href="fcolaborar.php">¿Cómo colaborar? </a></div><div id="contacto">Contacto: <a href="#">contacto@refranes.com</a></div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#ebfeff"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="0%" valign="top"><?php include('menu.php');?></td>
              <td width="100%" valign="top"><div id="contenido">                
				<?php
if (isset($_GET['refid'])){
	$refid = $_GET['refid'];
	$cadref = "SELECT * FROM refranes WHERE id = ".$refid;
	$resref = $db->sql_query($cadref);
	$des = $db->sql_fetchfield('des', 0, $resref);
	$idorigen = $db->sql_fetchfield('idorigen', 0, $resref);
	echo '<div id="detalles"><h3>'.$des.'</h3></div>';
	$cadrefl = "SELECT * FROM refranlocaliza WHERE idrefran = ".$refid." ORDER BY idlocaliza ASC";
	$resrefl = $db->sql_query($cadrefl);
	$cantrefl = $db->sql_numrows($resrefl);
	if ($cantrefl > 0){
?>
		   <div class="toggler-1" style="padding-left:0px" title="Zonas geográficas donde se recogio">
		   <div id="detalles1">
  <table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#999999" class="tablaficha">
    <tr>
      <td width="69%">Zona geogr&aacute;fica <span class="notapeque">(Lugar habitado, Municipio, Provincia)</span></td>
      <td width="21%">Cantidad de informantes </td>
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
$totaltemp = $totaltemp + $cantper;
?>    
    <tr>
      <td class="detficha"><?php echo $desloca; ?></td>
      <td class="detficha"><?php echo $cantper; ?></td>
      <td class="detficha"><?php echo $totaltemp; ?></td>
    </tr>
  </table>
		   </div>
		   </div>
<?php
	$cadorg = "SELECT * FROM origen WHERE id = ".$idorigen;
	$resorg = $db->sql_query($cadorg);
	$desorigen = $db->sql_fetchfield('des', 0, $resorg);
	echo '<div id="detalles"><strong>Origen:</strong> '.$desorigen.'</div>';
	$cadclasif = "SELECT * FROM refranclasif WHERE idrefran = ".$refid;
	$resclasif = $db->sql_query($cadclasif);
	$cantclasif = $db->sql_numrows($resclasif);
	$i = 0;
	/*if ($cantclasif > 0){
		echo '<div id="detalles"><strong>Temática:</strong> ';
		
		while ($i < $cantclasif) {
			$idclasif = $db->sql_fetchfield('idclasif', $i, $resclasif);
			$cadclas = "SELECT * FROM clasif WHERE id = ".$idclasif;
			$resclas = $db->sql_query($cadclas);
			$desclasif = $db->sql_fetchfield('des', 0, $resclas);
			echo '<a href="fbtema.php?q='.$idclasif.'" class="tematica">'.$desclasif.'</a>';
			$i++;
			if ($i < $cantclasif)
			echo ', ';
		}
		echo '</div>';
	}*/
	}
	$cadvar = "SELECT * FROM variante WHERE idrefran = ".$refid." ORDER BY LEFT(des,4) ASC";
	$resvar = $db->sql_query($cadvar);
	$cantvar = $db->sql_numrows($resvar);
if ($cantvar > 0){
$temp = array();
$i = 0;
	while ($i < $cantvar) {
		$temp[$db->sql_fetchfield('id', $i, $resvar)] = stripslashes($db->sql_fetchfield('des', $i, $resvar));
		$i++;
//
}
echo '<div id="cajavar">';
	echo '<div class="titulo1">Variantes de este refrán</div>';
	//echo '<div id="cajavar">';
	$i = 0;
	asort($temp);
	reset($temp);
	while ($i < $cantvar) {
		/*$idvar = $db->sql_fetchfield('id', $i, $resvar);
		$desvar = stripslashes($db->sql_fetchfield('des', $i, $resvar));*/
		$idvar = key($temp);
		$desvar = current($temp);
		$cadvloca = "SELECT * FROM varlocaliza WHERE idvariante = ".$idvar." ORDER BY idlocaliza ASC";
		$resvloca = $db->sql_query($cadvloca);
		$cantvloca = $db->sql_numrows($resvloca);


		echo '<div id="detallesvar" ><h4>'.$desvar.'</h4></div>';
		if ($cantvloca > 0){
			echo '<div class="toggler-1" title="Zonas geográficas donde se recogio">';
			echo '<div id="detalles1">';
?>
<table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#999999" class="tablaficha">
<tr>
      <td width="69%">Zona geogr&aacute;fico <span class="notapeque">(Lugar habitado, Municipio, Provincia)</span></td>
      <td width="21%">Cantidad de informantes</td>
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
$totaltemp = $totaltemp + $cantper;
?>
    <tr>
      <td class="detficha"><?php echo $desloca; ?></td>
      <td class="detficha"><?php echo $cantper; ?></td>
      <td class="detficha"><?php echo $totaltemp; ?></td>
    </tr>
  </table>
		   
<?php
echo ' </div></div>';
		}
$i++;
next($temp);
//
}
//echo ' </div>';
}
echo ' </div>';
}
?>                
			  </div>
			  </td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
