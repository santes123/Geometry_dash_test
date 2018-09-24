<?php
	include_once '../../../admin/conection/conection.php';
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$email = $_POST['email'];
	$usuario = $_POST['usuario'];
	$contrasenha = $_POST['contrasenha'];
	$contrasenha_md5 = md5($contrasenha);
	$db = "geometryDash";
	$query = "insert into datos_usuario (nombre,apellidos,email,usuario,contrasenha) values ('$nombre','$apellidos','$email','$usuario','$contrasenha_md5')";
	$query2 = "insert into usuario (usuario,contrasenha) values ('$usuario','$contrasenha_md5')";
	//$array_campos = array("usuario","contrasenha");
	$acceso = new Conection('localhost',"root","",$db);
	$result = $acceso->insert_usuario($query,$query2);
	
?>