<?php
$message = $_POST['mensaje'];
$miemail = 'correo@refranes.com';
$cabeceras = "From: ".$_POST['email']." \r\n" ."Reply-To: ".$_POST['email']."\r\n" .'X-Mailer: PHP/' . phpversion();
mail($miemail, $_POST['asunto'], $message, $cabeceras);
header("Location: enviado.php");
exit;
?>