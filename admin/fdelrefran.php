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
<script type="text/javascript">
<!--



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

function marcar(id) 
{
if (document.getElementById(id).checked)
document.getElementById(id).checked = false;
else
document.getElementById(id).checked = true;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
</head>

<body>
<table width="725" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="main">
	 <div id="contenido">
	  <?php include('menu.php') ?>
	   <div id="titulo">Listado de refranes <div id="logout"><a href="logout.php" class="elemento logout">Salir</a></div></div>
	   <div id="cajaizq">
		 <form action="delrefran.php" method="post" name="form1" id="form1">
		 <div class="titulo">Refr&aacute;n modelo o tipo</div>
<?php
$cadref = "SELECT * FROM refranes ORDER BY desm ASC";
$resref = $db->sql_query($cadref);
$cantref = $db->sql_numrows($resref);
if ($cantref > 0){
$i = 0;
	while ($i < $cantref) {	
	$id = $db->sql_fetchfield('id', $i, $resref);
	$des = $db->sql_fetchfield('des', $i, $resref);
	echo '<div id="barragris" ><input name="'.$id.'" type="checkbox" class="check" id="'.$id.'" value="'.$id.'" /><a href="fdetallerefran2.php?refid='.$id.'" class="lista1">'.$des.'</a></div>';
	//echo '<br />';
	$i++;
	}
}else{
echo 'No existen refranes registrados.';
}
?>
<div style="margin-top:20px"><input name="Submit" type="image" value="Submit" src="../images/beliminar.gif" /></div>
		 </form>
	   </div>
	 </div>
	</div></td>
  </tr>
</table>
</body>
</html>
