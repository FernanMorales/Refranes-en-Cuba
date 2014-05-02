<?php
include("../includes/security.php");
include('../includes/db.php');
include('../includes/localclass.php');
unset($_SESSION['locaciones']);
unset($_SESSION['tlocacionesvar']);
unset($_SESSION['locacionesvar']);
unset($_SESSION['variantes']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administracion Sitio refranes</title>
<link href="../style/refranes.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../acomplete/jquery.autocomplete.css" />
<script src="../jform/jquery.js"></script>

<script type='text/javascript' src='../acomplete/lib/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='../acomplete/lib/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='../acomplete/lib/thickbox-compressed.js'></script>
<script type='text/javascript' src='../acomplete/jquery.autocomplete.js'></script>
<script type='text/javascript' src='../acomplete/localdata.php'></script>
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script src="../jform/jquery.form.js"></script>

<script type="text/javascript">
<!--
function txtvar(text){
this.text = text;
}

function varloc(value){
this.value = value;
}

var txtvars = new Array();
var varlocs = new Array();
var modificando = -1;

$().ready(function() {
function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}
	
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	$("#suggest13, #suggest14").autocomplete(emails, {
		minChars: 0,
		max: 12,
		width: 400,
		matchContains: "word",
		autoFill: false,
		formatItem: function(row, i, max) {
			return row.name;
		},
		formatMatch: function(row, i, max) {
			return row.name + " " + row.to;
		},
		formatResult: function(row) {
			return row.to;
		}
	});
	
		$('#variante.tinymce, #comentario.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '../tinymce/jscripts/tiny_mce/tiny_mce.js',

			// General options
			theme : "advanced",
			//force_br_newlines : true,
        //force_p_newlines : false,
        forced_root_block : '',
			verify_html : true,
			plugins : "style,inlinepopups,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras",

			// Theme options
			theme_advanced_buttons1 : "undo,redo,|,bold,italic,underline,|,forecolor,backcolor",
			
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : false,
			theme_advanced_resizing : false,
			//paste_auto_cleanup_on_paste : false,
			paste_retain_style_properties : "color, background-color",
			paste_preprocess : function(pl, o) {
            // Content string containing the HTML from the clipboard
            //alert(o.content);
			o.content = o.content.replace(/>\s</g, '>&nbsp;<');
            //o.content = "-: CLEANED :-\n" + o.content;
        },
			// Example content CSS (should be your site CSS)
			content_css : "../tinymce/examples/css/content.css",

			// Drop lists for link/image/media/template dialogs
			//template_external_list_url : "lists/template_list.js",
			//external_link_list_url : "lists/link_list.js",
			//external_image_list_url : "lists/image_list.js",
			//media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	
	$('#refran.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '../tinymce/jscripts/tiny_mce/tiny_mce.js',

			// General options
			theme : "advanced",
			verify_html : true,
			plugins : "style,inlinepopups,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras",

			// Theme options
			theme_advanced_buttons1 : "undo,redo,|,bold,italic,underline,|,forecolor,backcolor",
			
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : false,
			theme_advanced_resizing : false,
			//paste_auto_cleanup_on_paste : false,
			paste_retain_style_properties : "color, background-color",
			paste_preprocess : function(pl, o) {
            // Content string containing the HTML from the clipboard
			o.content = o.content.replace(/>\s</g, '>&nbsp;<');
        },
			onchange_callback : function(inst) {
            // Content string containing the HTML from the clipboard
			//alert("The HTML is now:" + inst.getContent({format : 'text'}));
			document.getElementById('hrefran').value = inst.getContent({format : 'text'});
        },
			// Example content CSS (should be your site CSS)
			content_css : "../tinymce/examples/css/content.css",

			// Drop lists for link/image/media/template dialogs
			//template_external_list_url : "lists/template_list.js",
			//external_link_list_url : "lists/link_list.js",
			//external_image_list_url : "lists/image_list.js",
			//media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	});
	
$(document).ready(function() {
    // bind form using ajaxForm 
    $('#formreflocal').ajaxForm({ 
        // target identifies the element(s) to update with the server response         
		target: '#reflocal', 
		resetForm: true,
		beforeSubmit:  devuelta,
        // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
        success: function() { 
		//document.formreflocal.codigogeo.options[document.formreflocal.codigogeo.selectedIndex] = null;	
		$('#reflocal').slideDown('slow');
        } 
    }); 
	
	$('#reflocalvar').ajaxForm({ 
        // target identifies the element(s) to update with the server response 
        target: '#varlocal',
		resetForm: true,
		beforeSubmit:  devuelta1,
        // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
        success: function() { 
		//document.formreflocal.codigogeo.options[document.formreflocal.codigogeo.selectedIndex] = null;
		
         $('#varlocal').slideDown('slow');
        } 
    }); 
	
	$('#formaddvar').ajaxForm({ 
        // target identifies the element(s) to update with the server response 
        target: '#variantes',
		beforeSubmit:  devuelta2,
        // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
        success: function() { 
		//document.formreflocal.codigogeo.options[document.formreflocal.codigogeo.selectedIndex] = null;		
         $('#variantes').slideDown('slow');
		 $('#varlocal').slideUp('fast');
		 $('#variante').tinymce().setContent("");
        } 
    });	
});

function delreflocal() {
var seleccion = document.getElementById('ordenlocal').value.substr(3);
//alert(salvalocs.indexOf(seleccion));
		for (i=0; i<salvalocs.length; i++){
		if (salvalocs[i].value == seleccion){
		salvalocs[i].del=0;
		break;
		}
		}
}

function delvarlocal() {
var seleccion = document.getElementById('ordenlocalvar').value.substr(3);
		for (i=0; i<salvavarlocs.length; i++){		
		if (salvavarlocs[i].value == seleccion){
		salvavarlocs[i].del=0;
		break;
		}
		}
}

function devuelta(formData, jqForm, options) {
var encontre = false;
		if (formData[2].value == 'Submit'){
choiceid=document.formreflocal.codigogeo.value;
		for (i=0; i<salvalocs.length; i++){
		if ((salvalocs[i].text == choiceid) & (salvalocs[i].del != 1)){
		salvalocs[i].del = 1;
		formData[0].value = salvalocs[i].value;
		encontre = true;
		break;
		}
		}
		}
		return encontre;
		}
		
function devuelta1(formData, jqForm, options) {
var encontre = false;
		if (formData[3].value == 'Submit'){
choiceid=document.reflocalvar.codigogeovar.value;
		for (i=0; i<salvavarlocs.length; i++){
		if ((salvavarlocs[i].text == choiceid) & (salvavarlocs[i].del != 1)){		
		salvavarlocs[i].del = 1;
		formData[0].value = salvavarlocs[i].value;
		encontre = true;
		break;
		}		
		}		
		}
		return encontre;
		}
		
function devuelta2(formData, jqForm, options) {
		var encontre = false;
		var variante = false;
		var retorno = false;
		var varnum;
		//alert(modificando);
		if (modificando == -1)
		varnum = txtvars.length;
		else
		varnum = modificando;
		//alert($('#variante').html());
		if ($('#variante').html() != '')
		variante = true;
		if (variante){
		for (i=0; i<salvavarlocs.length; i++){
		if (salvavarlocs[i].del == 1){
		encontre = true;
		break;
		}
		}
		}
		if (encontre){
		varlocs[varnum] = new Array();
		for (i=0; i<salvavarlocs.length; i++){
		if (salvavarlocs[i].del == 1){
		//alert(varnum);
		varlocs[varnum][salvavarlocs[i].value] = new varloc(1);
		//alert(varlocs[varnum][j].value);
		}
		salvavarlocs[i].del = 0;
		}
		}
		if (encontre && variante){
		txtvars[varnum] = new txtvar($('#variante').html());
		document.getElementById('variantetxt').value = txtvars[varnum].text;
		formData[0].value = txtvars[varnum].text;
		modificando = -1;
		retorno = true;		
		}
		return retorno;
		}

function delvarlocs(valor){
var temparr = new Array();
var j = 0;
//alert(valor);
for (i=0; i<varlocs.length; i++){
if (i != valor){
temparr[j] = new Array();

for (k=0; k<(varlocs[valor]).length; k++){
temparr[j][k] = varlocs[i][k];
}
j++;
}
}
varlocs = null;
varlocs = temparr;
}

function delvartxt(valor){
var temparr = new Array();
var j = 0;
//alert(valor);
for (i=0; i<txtvars.length; i++){
if (i != valor){
//alert('valor '+valor+' i '+ i);
temparr[j] = txtvars[i];
j++;
}
}
txtvars = temparr;
}

function devuelta3(valor) {
delvarlocs(valor);
delvartxt(valor);
return true;
}

function devuelta4(valor) {
//alert(modificando);
$('#variante').tinymce().setContent("");
$('#variante').tinymce().execCommand('mceInsertContent', false, txtvars[valor].text);
document.getElementById('variantetxt').value = txtvars[valor].text;
for (i=0; i<salvavarlocs.length; i++){
		if (varlocs[valor][salvavarlocs[i].value]){
		salvavarlocs[i].del = 1;
		}
		}
//delvarlocs(valor);
//delvartxt(valor);
}
		
function getWindowData(n,i){
    var ifr=document.getElementById(i).contentWindow.document || document.getElementById(i).contentDocument;
    var widthViewport,heightViewport,xScroll,yScroll,widthTotal,heightTotal;
    if (typeof window.frames[n].innerWidth != 'undefined'){
        heightViewport= window.frames[n].innerHeight;
    }else if(typeof ifr.documentElement != 'undefined' && typeof ifr.documentElement.clientWidth !='undefined' && ifr.documentElement.clientWidth != 0){
        heightViewport=ifr.documentElement.clientHeight;
    }else{
        heightViewport=ifr.getElementsByTagName('body')[0].clientHeight;
    }
    heightTotal=Math.max(ifr.documentElement.scrollHeight,ifr.body.scrollHeight,heightViewport);
    return heightTotal;
}

function resizeIframe(ID,NOMBRE){
document.getElementById(ID).height=null;
//window.location='#';//necesario para safari
var m=getWindowData(NOMBRE,ID);
//alert(m); 
document.getElementById(ID).height=m;
} 

function redireccionar(dir) 
{
window.parent.contenido.location.href = dir;
}

function actualtxt(){
alert($('#variante').html());
document.getElementById('variantetxt').value = $('#variante').html();
}

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
        <div id="titulo">Adicionar refr&aacute;n
          <div id="logout"><a href="logout.php" class="elemento logout">Salir</a></div>
        </div>
        <div id="cajaizq">
          <form action="addrefran.php" method="post" name="mainform" id="mainform">
            <div class="titulo">Refr&aacute;n modelo o tipo</div>
            <div id="divtinymce"><textarea class="tinymce" name="refran" id="refran" style="width:540px" ></textarea></div>
			<div class="titulo">Comentario</div>
			<div id="divtinymce"><textarea name="comentario" class="tinymce" id="comentario" style="width:540px" ></textarea></div>
			<input name="hrefran" type="hidden" id="hrefran" value="" />
            <?php
$cadorigen = "SELECT * FROM origen ORDER BY des ASC";
$resorigen = $db->sql_query($cadorigen);
$cantorigen = $db->sql_numrows($resorigen);
if ($cantorigen > 0){	
?>
            <div class="titulo">Origen</div>
            <div id="cajainsert1">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="50%" valign="top" ><?php
$i = 0;
	while ($i < $cantorigen) {	
	$id = $db->sql_fetchfield('id', $i, $resorigen);
	$des = $db->sql_fetchfield('des', $i, $resorigen);
	if ($i == 0)
	echo '<input name="origen" type="radio" class="check" value="'.$id.'" checked="checked" />'.$des;
	else
	echo '<input name="origen" type="radio" class="check" value="'.$id.'" />'.$des;
	$temp = round($cantorigen/2);
	$ii = $i+1;
	if ($ii == $temp)
	echo '</td><td width="50%" valign="top">';
	else 
	echo '<br />';
	$i++;
	}
?></td>
                </tr>
              </table>
            </div>
            <?php
}
$cadclasif = "SELECT * FROM clasif ORDER BY des ASC";
$resclasif = $db->sql_query($cadclasif);
$cantclasif = $db->sql_numrows($resclasif);
if ($cantclasif > 0){	
?>
            <div class="titulo">Clasificaci&oacute;n</div>
            <div id="cajainsert1">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="50%" valign="top"><?php
$i = 0;
	while ($i < $cantclasif) {	
	$id = $db->sql_fetchfield('id', $i, $resclasif);
	$des = $db->sql_fetchfield('des', $i, $resclasif);
	echo '<input name="'.$id.'" type="checkbox" class="check" value="'.$id.'" />'.$des;
	$temp = round($cantclasif/2);
	$ii = $i+1;
	if ($ii == $temp)
	echo '</td><td width="50%" valign="top">';
	else 
	echo '<br />';
	$i++;
	}
?></td>
                </tr>
              </table>
            </div>
            <?php
}
?>
          </form>
		  <form action="modreflocal.php" method="post" id="modreflocal" name="modreflocal"><input name="ordenlocal" type="hidden" id="ordenlocal" value="" /></form>
		  <div id="reflocal"></div>
          <form action="addreflocal.php" method="post" id="formreflocal" name="formreflocal">
<?php
$cadzona = "SELECT * FROM localizacion ORDER BY codigo ASC";
$reszona = $db->sql_query($cadzona);
$cantz = $db->sql_numrows($reszona);
if ($cantz > 0){
?>
            <div id="cajainsert">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="55%">C&oacute;digo geogr&aacute;fico                    
                    <input name="codigogeo" type="text" id="suggest13" /></td>
                  <td width="35%">Cantidad de veces
                    <input name="veces" type="text" class="editpeque" id="veces" value="1"/></td>
                  <td width="10%"><input name="Submit" id="addloc" type="image" value="Submit" src="../images/bcheck.gif" /></td>
                </tr>
              </table>
            </div>
            <?php
}
if ($cantz <= 0) 
echo 'Es necesario insertar zonas geograficas en el sistema para completar esta información';
?>
          </form>
          <?php
if ($cantz > 0){
?>
          <div class="titulo">Variantes </div>
          <div id="cajavar">
            <form action="addvar.php" method="post" id="formvar" name="formvar">
              <div id="variantes" style="display:none"></div>
            </form>
            <div class="titulo" style="margin-top:0px">Variante</div>
            <div id="divtinymce">
            <textarea name="variante" class="tinymce" id="variante" style="width:515px" ></textarea>
            </div>
			<form action="modvarlocal.php" method="post" id="modvarlocal" name="modvarlocal"><input name="ordenlocalvar" type="hidden" id="ordenlocalvar" value="" /></form>
			<div id="varlocal" style="display:none"></div>
            <form action="addvarlocal.php" method="post" id="reflocalvar" name="reflocalvar">
              <div id="cajainsert2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="55%">C&oacute;digo geogr&aacute;fico
                      <input name="codigogeovar" type="text" id="suggest14" /></td>
                    <td width="35%">Cantidad de veces
                      <input name="veces" type="text" class="editpeque" id="veces" value="1"/></td>
                    <td width="10%"><input name="Submit" id="addloc" type="image" value="Submit" src="../images/bcheck.gif" />
                      <input name="varactual" type="hidden" id="varactual" value="0" /></td>
                  </tr>
                </table>
              </div>
            </form>
            <form action="addvar.php" method="post" id="formaddvar" name="formaddvar">
              <table width="130" height="60" border="0" align="right" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="154"><input name="Submit" id="addloc" type="image" value="Submit" src="../images/baddvar.gif" /></td>
                </tr>
              </table>
              <input name="variantetxt" type="hidden" id="variantetxt" />
            </form>
          </div>
          <?php
}
?>
          <a href="#" onclick="mainform.submit()" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','../images/aceptarove.gif',1)" class="bacept"><img src="../images/aceptar.gif" name="Image2" width="75" height="27" border="0" align="right" id="Image2" /></a> </div>
      </div>
    </div></td>
  </tr>
</table>
<script type="text/javascript">
<!--
<?php
if ($cantz > 0){
	$zonasgeo = new zonasgeo();
	$i = 0;
	$j = 0;
	while ($i < $cantz) {
		$id = $db->sql_fetchfield('id', $i, $reszona);
		$codigo = $db->sql_fetchfield('codigo', $i, $reszona);
		$des = $db->sql_fetchfield('des', $i, $reszona);
		if (empty($des))
		$des = $codigo;
		else
		$des = $codigo.'-'.$des;
		$zonasgeo->addgeo($id, $des);
		$i++;
	}
	$_SESSION['zonasgeo'] = serialize($zonasgeo);
}
?>
//salvavarlocs = salvalocs;

</script>
</body>
</html>
