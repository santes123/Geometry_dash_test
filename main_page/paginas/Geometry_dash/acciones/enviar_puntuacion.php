<?php
if(isset($_GET['puntuacion'])){
	include_once '../../../admin/conection/conection.php';
	session_start();
	$puntuacion = $_GET['puntuacion'];
	$usuario = $_SESSION['usuario'];
	$nivel = $_GET['nivel'];
	echo $puntuacion.", ".$usuario.", ".$nivel;

	//recuperamos el id del usuario
	$db = "geometryDash";
	$query = "select id from datos_usuario where usuario = \"$usuario\";";
	//$array_campos = array("usuario","contrasenha");
	$conexion = new Conection('localhost',"root","",$db);
	$result = $conexion->consulta($query);
	$array_usuarios = [];

	while ($row = $result->fetch_object()){
		array_push($array_usuarios, $row);
	}
	$idUser = $array_usuarios[0]->id;
	//ahora insertamos el registro
	$query = "insert into puntuaciones (puntuacion,nivel,user_id) values('$puntuacion','$nivel','$idUser')";
	$result = $conexion->insert_puntuacion($query);
}

?>