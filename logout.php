<?php 
session_start();
unset($_SESSION['idusuariologado']);
header("Location: login.php");
?>