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
if (isset($_SESSION['locaciones']))
$locaciones = unserialize($_SESSION['locaciones']);
else
$locaciones = new locaciones;
$total = $locaciones->totalitem();
if ($total > 0){
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
$locaciones->reset();
if ($total > 1){
while ($i < $total) {
	$actual = $locaciones->item();
	$cant = $actual['num'];
	$totaltemp = $totaltemp + $cant;
?>
    <tr>
      <td class="detficha"><?php echo $actual["des"]; ?></td>
      <td class="detficha"><?php echo $cant; ?></td>
      <td class="detficha">&nbsp;</td>
    </tr>
<?php
$locaciones->next();
$i++;
if (!($i < $total-1))
break;
}
}
$actual = $locaciones->item();
	$cant = $actual['num'];
	$totaltemp = $totaltemp + $cant;
?>    
    <tr>
      <td class="detficha"><?php echo $actual["des"]; ?></td>
      <td class="detficha"><?php echo $cant; ?></td>
      <td class="detficha"><?php echo $totaltemp; ?></td>
    </tr>
  </table>
		   </div>
<?php
}
if (isset($_SESSION['variantes'])){
$variantes = unserialize($_SESSION['variantes']);
$cantvar = $variantes->totalvariante();

if ($cantvar > 0){
echo '<div class="titulo1">Variantes</div>';
echo '<div class="detallevar" id="cajavar" style="padding:5px">';
$j = 0;
//$varactual = $variantes->primero();
$variantes->ordenar();
		$variantes->reset();
		$varid = $variantes->index();
$totalgral = 0;
while ($j < $cantvar){
$desvar = stripslashes($variantes->desvariante($varid));
echo '<div id="detallesvar" >'.$desvar.'</div>';
if (isset($_SESSION['locacionesvar'])){
$locacionesvar = unserialize($_SESSION['locacionesvar']);
$total = $locacionesvar->totalitem($varid);
if ($total > 0){
echo '<div class="titulo1">Localización geográfica</div>';
echo '<div id="detalles" style="padding:0px; width:525px">';
?>
<table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#999999" class="tablaficha">
<tr>
      <td width="69%">C&oacute;digo geogr&aacute;fico</td>
      <td width="21%">Cantidad de veces</td>
      <td width="10%" class="total">TOTAL</td>
    </tr>
<?php
$i = 0;
$localtemp = $locacionesvar->item($varid);
ksort($localtemp);
reset($localtemp);
$totalgral = $totalgral + $totaltemp;
$totaltemp = 0;
if ($total > 1){
while ($i < $total) {
	$actual = current($localtemp);
	$codigogeo = key($localtemp);
	$cant = $actual['num'];
	$totaltemp = $totaltemp + $cant;
?>  
    <tr>
      <td class="detficha"><?php echo $actual["des"]; ?></td>
      <td class="detficha"><?php echo $cant; ?></td>
      <td class="detficha">&nbsp;</td>
    </tr>
<?php
next($localtemp);
$i++;
if ($i >= $total-1)
break;
}
}
$actual = current($localtemp);
	$cant = $actual['num'];
	$totaltemp = $totaltemp + $cant;
?>
    <tr>
      <td class="detficha"><?php echo $actual["des"]; ?></td>
      <td class="detficha"><?php echo $cant; ?></td>
      <td class="detficha"><?php echo $totaltemp; ?></td>
    </tr>
  </table>
		   </div>
<?php
}
}
$j++;
$variantes->next();
$varid = $variantes->index();
//$varactual = $variantes->prox($varactual);
}
echo ' </div>';
$totalgral = $totalgral + $totaltemp;
}
}
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
echo '<div id="refran1"><br /><a href="faddrefran.php" class="elemento">Adicionar otro refr&aacute;n</a><br /></div>';
}else{
	echo '<br />Ocurrio un problema en la adición de este refran. Intentelo nuevamente.';
	echo '<div id="refran1" style="height:500px"><a href="faddrefran.php" class="elemento">Adicionar otro refr&aacute;n</a></div>';
}
/*unset($_SESSION["locaciones"]);
unset($_SESSION["variantes"]);
unset($_SESSION["locacionesvar"]);
unset($_SESSION["zonasgeo"]);
unset($_SESSION["zonasgeovar"]);*/
?>

	   	  </div>
	 </div>
	</div></td>
  </tr>
</table>
</body>
</html>
