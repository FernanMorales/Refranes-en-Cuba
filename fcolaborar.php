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
            <div id="menu"><a href="index.php">Inicio</a> | <a href="sobreref.php">Sobre los refranes</a> | <a href="fcolaborar.php">�C�mo colaborar? </a></div><div id="contacto">Contacto: <a href="#">contacto@refranes.com</a></div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#ebfeff"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="0%" valign="top"><?php include('menu.php');?></td>
              <td width="100%" valign="top"><div id="contenido">                
				<table width="570" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="718"><img src="images/bordesup1.jpg" width="586" height="5" /></td>
  </tr>
  <tr>
    <td>
	<div id="cajabusca">
	  <h3>&iquest;C&oacute;mo colaborar?</h3>
      <br />
      <table width="97%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top">Con este sitio  nos proponemos mostrar, no solo los refranes  colectados junto a sus variantes en las m&aacute;s diversas zonas de la isla,  sino tambi&eacute;n crear una plataforma de comunicaci&oacute;n que permita  actualizar constantemente esta informaci&oacute;n. Por ello usted puede ser una pieza clave en este empe&ntilde;o y ser uno de los protagonistas en la recopilaci&oacute;n de informacion. Por eso, si conoce algun refr&aacute;n que no haya encontrado aqu&iacute; o alguna variante de alguno que ya este incluido, haganosla llegar. Colaborar es muy f&aacute;cil, pero reportar&aacute; un gran beneficio, as&iacute; que no lo dude, si tiene alg&uacute;n refr&aacute;n o variante llene el formulario que esta debajo y envielo. Su sugerencia puede aparecer en nuestro sitio. </td>
                </tr>
              </table>
			  <form id="form2" name="form2" method="post" action="enviar.php">
			    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td valign="top">Nombre:</td>
                  </tr>
                  <tr>
                    <td valign="top"><input name="nombre" type="text" class="email" id="nombre" /></td>
                  </tr>
                  <tr>
                    <td valign="top">Email:</td>
                  </tr>
                  <tr>
                    <td valign="top"><input name="email" type="text" class="email" id="email" /></td>
                  </tr>
                  <tr>
                    <td>Asunto:</td>
                  </tr>
                  <tr>
                    <td><input name="asunto" type="text" class="email" id="asunto" /></td>
                  </tr>
                  <tr>
                    <td>Mensaje:</td>
                  </tr>
                  <tr>
                    <td valign="top"><textarea name="mensaje" class="mensaje" id="mensaje"></textarea></td>
                  </tr>
                </table>
	<div id="cajabtnes">
	  <input name="todos" type="image" class="btbuscar" id="todos" value="Submit" src="images/btenviar.jpg" />
              </div>
    </form></div>
	</td>
  </tr>
  <tr>
    <td><img src="images/bordeinf1.jpg" width="586" height="6" /></td>
  </tr>
</table>                
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
