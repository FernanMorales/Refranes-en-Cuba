<?php
session_start();
session_unset();
include('../includes/db.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administracion Sitio refranes</title>
<style type="text/css">
<!--
body {
	background-color: #CCCCCC;
	margin-top: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="../style/refranes.css" rel="stylesheet" type="text/css" />

<script type="text/JavaScript">
<!--
function MM_setTextOfTextfield() { //v3.0
  document.form1.pass.value='';
  document.form1.usr.value='';
  document.form1.usr.focus();
}

function borrar(){
document.form1.pass.value='';
}

window.onload = MM_setTextOfTextfield;

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

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es necesario.\n'; }
  } if (errors) alert('A ocurrido el siguiente error:\n'+errors);
  document.MM_returnValue = (errors == '');
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>

</head>

<body onload="MM_preloadImages('../images/aceptarove.gif')">
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="147" height="550" valign="top">&nbsp;</td>
    <td width="553" valign="top"><table width="200" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td valign="top">&nbsp;</td>
        <td width="406"><br />
          <br /></td>
      </tr>
      <tr>
        <td width="107" valign="top"><img src="../images/computer.gif" width="73" height="71" hspace="10" vspace="20" /></td>
        <td bgcolor="#eeeeee"><form action="login.php" method="post" name="form1" id="form1" onsubmit="MM_validateForm('usr','','R','pass','','R');return document.MM_returnValue">
            <table width="150" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td width="691" height="10"></td>
              </tr>
              <tr>
                <td><div class="titulo" style="width:150px">Usuario:</div></td>
              </tr>
              <tr>
                <td><input name="usr" type="text" id="usr" /></td>
              </tr>
              
              <tr>
                <td><div class="titulo" style="width:150px">Contrase&ntilde;a:</div></td>
              </tr>
              <tr>
                <td><input name="pass" type="password" id="pass" onfocus="borrar();"/></td>
              </tr>
              
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>
                  <input name="Submit" type="image" value="Submit" src="../images/aceptarove.gif" />             </td>
              </tr>
            </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
