<?php
include("../includes/security.php");
include('../includes/db.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administracion Sitio refranes</title>
<link href="../style/refranes.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="725" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="765"><div id="main">
	 <div id="contenido">
	  <?php include('menu.php') ?>
	   <div id="titulo">Detalle clasificación 
	     <div id="logout"><a href="logout.php" class="elemento logout">Salir</a></div></div>
	   <div id="cajaizq">	   
<?php
if (isset($_GET['refid'])){
$refid = $_GET['refid'];
$cadref = "SELECT * FROM clasif WHERE id = ".$refid;
$resref = $db->sql_query($cadref);
$des = $db->sql_fetchfield('des', 0, $resref);
echo '<div class="titulo">Clasificación</div>';
echo '<div id="detalles">'.$des.'</div>';
}else{
	echo '<br />Ocurrio un problema en la adición de esta clasificación. Intentelo nuevamente.';
	echo '<div id="refran1" style="height:500px"><a href="faddclasif.php" class="elemento">Adicionar clasificación</a></div>';
}
?>
	   </div>	  
	 </div>
	</div></td>
  </tr>
</table>
</body>
</html>
