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
function MM_swapImgRestore() { //v3.0
	var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
	var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
	var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
	if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
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
	   <div id="titulo">Modificar clasificaci�n 
	     <div id="logout"><a href="logout.php" class="elemento logout">Salir</a></div></div>
	   <div id="cajaizq">
	     <form action="modclasif.php" method="post" name="form" id="form">
	       <div class="titulo">Clasificaci�n</div>
		   <div id="cajainsert">
<?php
if (isset($_GET['ref'])){
	$id = $_GET['ref'];
	echo '<input name="clasifid" type="hidden" value="'.$id.'" />';
	$cadref = "SELECT * FROM clasif WHERE id = ".$_GET['ref'];
	$resref = $db->sql_query($cadref);
	$des = $db->sql_fetchfield('des', 0, $resref);
	echo '<input name="clasif" type="text" value="'.$des.'"/>';
}
?>
</div>
		   <a href="#" onclick="form.submit()" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','../images/aceptarove.gif',1)" class="bacept"><img src="../images/aceptar.gif" name="Image2" width="75" height="27" border="0" align="right" id="Image2" /></a>
	     </form>
	   </div>
	 </div>
	</div></td>
  </tr>
</table>
</body>
</html>