<?php session_start(); unset($_SESSION['status']); session_destroy();?>
<?php header('Location: index.php');?>
