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
<script type="text/javascript">
<!--
function marca(nombre){
} 

function formsubmit(orden){
document.getElementById('forden').value=orden;
document.form2.submit();
} 
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
				<table width="570" border="0" cellspacing="0" cellpadding="0">
<?php
$cadorigen = "SELECT * FROM origen ORDER BY des ASC";
$resorigen = $db->sql_query($cadorigen);
$cantorigen = $db->sql_numrows($resorigen);
if ($cantorigen > 0){	
?>
  <tr>
    <td width="718"><img src="images/bordesup1.jpg" width="586" height="5" /></td>
  </tr>
  <tr>
    <td>
	<div id="cajabusca"><form id="form2" name="form2" method="post" action="buscador/borigen.php">
	<input name="forden" type="hidden" id="forden" />
      <h2>Origen</h2>
      <br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="33%" valign="top"><?php
$i = 0;
if (isset($_GET['q']))
$marc = $_GET['q'];
else
$marc = -1;
	$temp = round($cantorigen/3);
	while ($i < $cantorigen) {
	$id = $db->sql_fetchfield('id', $i, $resorigen);
	$des = $db->sql_fetchfield('des', $i, $resorigen);
	if (($marc == -1) or ($marc == $id)){
	$marc = $id;
	$desfinal = $des;
	echo '<input name="origen" type="radio" id="'.$id.'" class="check" checked="checked" value="'.$id.'" />'.$des;
	}else
	echo '<input name="origen" type="radio" id="'.$id.'" class="check" value="'.$id.'" />'.$des;
	$ii++;
	if ($ii == $temp){
	echo '</td><td width="33%" valign="top">';
	$ii = 0;
	}else
	echo '<br />';
	$i++;
	}
?></td>
                </tr>
              </table>
	<div id="cajabtnes">
                <input name="popular" type="image" class="btbuscar" id="popular" value="Submit" onclick="formsubmit('popular');" src="images/btpopular.jpg" />
				<input name="todos" type="image" class="btbuscar" id="todos" value="Submit" onclick="formsubmit('todos');" src="images/btbuscar1.jpg" />
              </div>
    </form></div>
	</td>
  </tr>
  <tr>
    <td><img src="images/bordeinf1.jpg" width="586" height="6" /></td>
  </tr>
<?php
}
?>
</table>                
			  </div>
			  <?php
			  if (isset($_GET['q'])){
			  if ($_GET['ford'] == 'popular')
echo '<div id="contenido" >El sistema buscó los refranes de origen '.$desfinal.' que fueron recogidos mayor cantidad de veces</div>';	
else		  
echo '<div id="contenido" >El sistema buscó los refranes de origen '.$desfinal.'</div>';
			  if (isset($_GET['res'])){
			  ?>
			  <div id="contenido">No existen refranes pertenecientes a este origen.</div>
			  <?php
			  }else
			   include('buscador/resultado.php');
			   }
			   ?>
			  </td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
