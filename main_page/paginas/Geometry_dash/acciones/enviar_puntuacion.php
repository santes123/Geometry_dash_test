<?php
if(isset($_GET['puntuacion'])){
	include_once '../../../admin/conection/conection.php';
	session_start();
	$puntuacion = $_GET['puntuacion'];
	$usuario = $_SESSION['usuario'];
	$nivel = $_GET['nivel'];
	$saltos = $_GET['saltos'];

	//recuperamos el id del usuario
	$db = "geometryDash";
	$query = "select id from datos_usuario where usuario = \"$usuario\";";
	$conexion = new Conection('localhost',"root","",$db);
	$result = $conexion->consulta($query);
	$array_usuarios = [];

	while ($row = $result->fetch_object()){
		array_push($array_usuarios, $row);
	}
	
	$idUser = $array_usuarios[0]->id;
	//ahora insertamos el registro
	$query = "insert into puntuaciones (puntuacion,nivel,user_id) values('$puntuacion','$nivel','$idUser')";
	//verificamos si el usuario es la 1º vez que juega a GD y enviamos puntuacion a la vez
	$query2 = "select nombre_logro,lg.idUsuario from logros_juegos as lg join usuario as u on(lg.idUsuario=u.idUsuario) where usuario = '".$usuario."';";


	//verificamos si ya hay saltos guardados de ese y sino luego en el metodo los insertamos
	$query3 = "select nombre_variable,valor from variables_geometry_dash_usuarios as vgdu join variables_geometry_dash as vgd on(vgdu.idVariable = vgd.id) 
	join usuario as u on(vgdu.idUsuario=u.idUsuario) where usuario = '".$usuario."' and nombre_variable = 'saltos';";
	$resultSaltos = $conexion->consulta($query3);

	if($resultSaltos->num_rows <= 0){
		//insertamos el valor de la variable saltos si no existe para ese usuario
		$query4 = "insert into variables_geometry_dash_usuarios (idVariable,valor,idUsuario) values(1,'".$saltos."','".$idUser."');";
		$resultSaltos2 = $conexion->consulta($query4);
		$result = $conexion->insert_puntuacion($query,$query2);
	}else{
		//actualizamos el valor de la varible saltos si ya existe para ese usuario
		$query5 = "update variables_geometry_dash_usuarios set valor = valor + ".$saltos." where idVariable = '1' and idUsuario = '".$idUser."';";
		$resultSaltos3 = $conexion->consulta($query5);
		$result = $conexion->insert_puntuacion($query,$query2);
	}
	//$result = $conexion->insert_puntuacion($query,$query2);
}

?>