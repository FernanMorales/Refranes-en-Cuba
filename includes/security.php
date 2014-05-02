<?php
session_start();
if(empty($_SESSION["usr"])){
header("Location:index.php");
exit;
}