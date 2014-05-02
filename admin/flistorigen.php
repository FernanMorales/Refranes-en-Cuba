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

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>

<body onload="MM_preloadImages('../images/aceptarove.gif')">
<table width="725" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="main">
	 <div id="contenido">
	  <?php include('menu.php') ?>
	   <div id="titulo">Modificar origen 
	     <div id="logout"><a href="logout.php" class="elemento logout">Salir</a></div></div>
	   <div id="cajaizq">
		 <div class="titulo">Origen</div>
         <?php
$cadref = "SELECT * FROM origen ORDER BY des ASC";
$resref = $db->sql_query($cadref);
$cantref = $db->sql_numrows($resref);
if ($cantref > 0){
$i = 0;
	while ($i < $cantref) {	
	$id = $db->sql_fetchfield('id', $i, $resref);
	$des = $db->sql_fetchfield('des', $i, $resref);
	echo '<div id="barragris"><a href="fmodorigen.php?ref='.$id.'" class="lista">'.$des.'</a></div>';
	$i++;
	}
}else{
echo 'No existen origenes registrados.';
}
?>
		  
	   </div>
	 </div>
	</div></td>
  </tr>
</table>
</body>
</html>
