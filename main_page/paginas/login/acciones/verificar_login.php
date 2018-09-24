<?php
	include_once '../../../admin/conection/conection.php';
	$usuario = $_POST['usuario'];
	$contrasenha = $_POST['contrasenha'];
	$contrasenha_md5  = md5($contrasenha);
	$db = "geometryDash";
	$query = "select usuario,contrasenha as pass from usuario where usuario = \"$usuario\";";
	//$array_campos = array("usuario","contrasenha");
	$acceso = new Conection('localhost',"root","",$db);
	$result = $acceso->verificar_usuario($query,$contrasenha_md5);
	
?>