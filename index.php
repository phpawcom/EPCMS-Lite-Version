<?php
include('includes/global.php');
!isset($_REQUEST['ajax'])? include('templates/header.php') : false;
try {
	if(!$script->loadModule($_REQUEST['module']))
	   throw new Exception('Cannot load file '.$script->safeinput($_REQUEST['module']).'!');
}catch(Exception $e){
	include('homepage.php');
}
!isset($_REQUEST['ajax'])? include('templates/footer.php') : false;
?>