<?php
	if(isset($_POST['comentario'])){
		$comentario = $_POST['comentario'];
		$idUsuario = $_GET['userId'];
		$idDiscusion = $_GET['id'];
		$idEntrada = $_GET['idEntrada'];

		include_once("../../../admin/conection/conection.php");
		//recuperamos el nombre de la discusion
		$conexion = new Conection("localhost","root","","geometrydash");
		$query = "select nombre_discusion from discusiones where id=".$idDiscusion.";";
		$array_discusiones = [];
		$result = $conexion->consulta($query);
		while ($row = $result->fetch_object()){
			array_push($array_discusiones, $row);
		}

		//insertamos los datos

		$query2 = "insert into comentarios_entradas_foro (idUsuario,comentario,idDiscusion,idEntrada) values('$idUsuario','$comentario','$idDiscusion','$idEntrada');";

		$result2 = $conexion->insert_comentario($query2,$array_discusiones[0]->nombre_discusion,$idDiscusion);
	}else{
		echo "No tienes acceso a este contenido";
		echo "<input type='button' onclick='javascript: history.back()' value='Volver'>";
	}
?>