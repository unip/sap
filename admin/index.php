<?php
session_start();
ob_start();

include_once "koneksi.php";
include_once "module.php";

if(isset($_SESSION['login']) && isset($_SESSION['id']) && $_SESSION['login']=='admin') {
	if(isset($_GET['ajax'])) {
		include_once "ajax.".$_SESSION['login'].".".$_GET['ajax'].".php";
	} else {
  		include_once "template.".$_SESSION['login'].".php";
	}
} else {
  include_once "template.login.php";
}

?>