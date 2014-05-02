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
<link rel="stylesheet" type="text/css" href="acomplete/jquery.autocomplete.css" />
<script src="jform/jquery.js"></script>
<script type='text/javascript' src='acomplete/lib/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='acomplete/lib/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='acomplete/lib/thickbox-compressed.js'></script>
<script type='text/javascript' src='acomplete/jquery.autocomplete.js'></script>
<script type='text/javascript' src='acomplete/lodata.php'></script>
<script type="text/javascript">
<!--
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
	$("#suggest13").autocomplete(zonas, {
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
			return row.name;
		}
	});
	$("#suggest13").result(function(event, data, formatted) {
		//var hidden = $(this).parent().next().find(">:input");
		//hidden.val( (hidden.val() ? hidden.val() + ";" : hidden.val()) + data[1]);
		//if (data) {
		document.getElementById('codigo').value=data.to;
		//alert('ahora '+data.to);
		
		//}
	});
});

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
$cadclasif = "SELECT * FROM clasif ORDER BY des ASC";
$resclasif = $db->sql_query($cadclasif);
$cantclasif = $db->sql_numrows($resclasif);
if ($cantclasif > 0){
if (isset($_GET['q']))
$marc = $_GET['q'];
else
$marc = -1;
?>
  <tr>
    <td width="718"><img src="images/bordesup1.jpg" width="586" height="5" /></td>
  </tr>
  <tr>
    <td>
	<div id="cajabusca"><form id="form2" name="form2" method="post" action="buscador/bzona.php">
	<input name="forden" type="hidden" id="forden" />
      <h2>Zonas geogr&aacute;ficas</h2>
      <span class="notapeque">(Lugar habitado, Municipio, Provincia)</span><br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="33%" valign="top">
				  <?php
				  if (isset($_GET['q'])){
				  $cadref = "SELECT * FROM localizacion WHERE codigo = '".$_GET['q']."'";
			  $resref = $db->sql_query($cadref);
			  $cantref = $db->sql_numrows($resref);
			  if ($cantref > 0){
			  $des = $db->sql_fetchfield('des', 0, $resref);?>
				  <input name="codigo" type="hidden" id="codigo" value="<?php echo $_GET['q']; ?>"/>
				  <input name="codigogeo" type="text" class="editgrande" id="suggest13" value="<?php echo $des; ?>"/>
				  <?php
				  }else{?>
				  <input name="codigo" type="hidden" id="codigo" />
				  <input name="codigogeo" type="text" class="editgrande" id="suggest13" />
				  <?php
				  }
				  }else{?>
				  <input name="codigo" type="hidden" id="codigo" />
				  <input name="codigogeo" type="text" class="editgrande" id="suggest13" />
				  <?php
				  }?>
                    <br />
                    <span class="notaalpie">Escriba aqu&iacute; la localidad de su preferencia</span></td>
                </tr>
                <tr>
                  <td valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top"><p>
                    <label>
                      <input name="preferencia" type="radio" value="1" checked="checked" />
                      en esta localidad</label>
                    <br />
                    <label>
                      <input type="radio" name="preferencia" value="2" />
                      en todo el municipio</label>
                    <br />
                    <label>
                      <input type="radio" name="preferencia" value="3" />
                      en toda la provincia</label>
                    <br />
                  </p></td>
                </tr>
              </table>
	<div id="cajabtnes">
                <input name="popular" type="image" class="btbuscar" id="popular" value="Submit" onclick="formsubmit('popular');" src="images/btpopular.jpg" />
				<input name="todos" type="image" class="btbuscar" id="todos" value="Submit" onclick="formsubmit('todos');" src="images/btbuscar1.jpg" />
              </div>
    </form>
	</div>
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
			  	if (isset($_GET['pref']))
$preferencia = $_GET['pref'];
else
$preferencia = 1;
$arrtemp = explode(",", $des);
switch ($preferencia){
	case 1:
		$final = $arrtemp[0].", municipio ".$arrtemp[1].", provincia ".$arrtemp[2];
		break;
	case 2:
		$final = "todo el municipio".$arrtemp[1].", provincia".$arrtemp[2];
		break;
	case 3:
		$final = "toda la provincia".$arrtemp[2];
		break;
}
if ($_GET['ford'] == 'popular')
echo '<div id="contenido" >El sistema buscó los refranes recogidos en '.$final.' que fueron informados mayor cantidad de veces</div>';	
else		  
echo '<div id="contenido" >El sistema buscó los refranes recogidos en '.$final.'</div>';
			  if (isset($_GET['res'])){
			  echo '<div id="contenido">No existen refranes recogidos en '.$final.'.</div>';
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
