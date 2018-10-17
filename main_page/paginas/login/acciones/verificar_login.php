<?php
	include_once '../../../admin/conection/conection.php';
	$usuario = $_POST['usuario'];
	$contrasenha = $_POST['contrasenha'];
	$contrasenha_md5  = md5($contrasenha);
	$db = "geometryDash";
	$query = "select idUsuario,usuario,contrasenha as pass from usuario where usuario = \"$usuario\";";
	//$array_campos = array("usuario","contrasenha");
	$acceso = new Conection('localhost',"root","",$db);
	$result = $acceso->verificar_usuario($query,$contrasenha_md5);

	
	if($result === true){
		//recuperamos el id del usuario y llamamos a la funcion donde verificamos el logro
		$query2 = "select idUsuario from usuario where usuario = '".$usuario."';";
		$result2 = $acceso->consulta($query2);
		$array = [];

		while ($row = $result2->fetch_object()){
			array_push($array, $row);
		}
		$query_verificar_logro = "select * from logros_generales where idUsuario = '".$array[0]->idUsuario."' and nombre_logro = 'primer login completado!';";
		$result3 = $acceso->verificar_logro_primer_login($query_verificar_logro,$array[0]->idUsuario);
		
	}
	
	
?>