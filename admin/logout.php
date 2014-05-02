<?php 
session_start();
session_unset();
/*if(!empty($_SESSION["usr"])){
 unset($_SESSION["usr"]);
 unset($_SESSION['level']);
 unset($_SESSION["evalua"]);
 unset($_SESSION["evalua1"]); 
 unset($_SESSION['idusr']);
 unset($_SESSION['group']);
 unset($_SESSION['groupid']);
 unset($_SESSION['step']);
 unset($_SESSION['productionid']);
 unset($_SESSION['pctionyear']);
}*/
header("Location: index.php");
?>