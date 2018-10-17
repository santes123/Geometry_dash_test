<?php
	include_once '../../../admin/conection/conection.php';
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$email = $_POST['email'];
	$usuario = $_POST['usuario'];
	$contrasenha = $_POST['contrasenha'];
	$contrasenha_md5 = md5($contrasenha);
	$fecha_actual = date("Y/m/d");
	$db = "geometryDash";

	$query = "insert into datos_usuario (nombre,apellidos,email,usuario,contrasenha) values ('$nombre','$apellidos','$email','$usuario','$contrasenha_md5')";
	$query2 = "insert into usuario (usuario,contrasenha) values ('$usuario','$contrasenha_md5')";
	$query3 = "insert into img_usuario_servidor (src) values('img_silueta.jpg');";
	//$array_campos = array("usuario","contrasenha");
	$acceso = new Conection('localhost',"root","",$db);
	$result = $acceso->insert_usuario($query,$query2,$query3);

	
	//recuperamos el id de usuario insertado anteriormente y verificamos el logro
	$query4 = "select idUsuario from usuario where usuario = '".$usuario."';";
	$result2 = $acceso->consulta($query4);
	$array_usuarios = [];

	while ($row = $result2->fetch_object()){
		array_push($array_usuarios,$row);
	}
	
	$query5 = "insert into logros_generales (nombre_logro,dia_conseguido,idUsuario) values('registro completado!','".$fecha_actual."','".$array_usuarios[0]->idUsuario."');";
	$result3 = $acceso->verificar_logro_registro($query5);
	
	
?>