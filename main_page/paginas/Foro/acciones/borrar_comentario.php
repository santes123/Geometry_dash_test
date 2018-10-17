<?php
	if(isset($_GET['id_comentario'])){
		//recuperamos los datos del comentario
		$id_comentario = $_GET['id_comentario'];
		$seccion = $_GET['seccion'];

		include_once("../../../admin/conection/conection.php");
		//recuperamos el id de la discusion
		$conexion = new Conection("localhost","root","","geometrydash");

		$query = "select id from discusiones where nombre_discusion='".$seccion."';";
		$array_discusiones = [];
		$result = $conexion->consulta($query);
		while ($row = $result->fetch_object()){
			array_push($array_discusiones, $row);
		}
		//realizamos el borrado de datos
		$query2 = "delete from comentarios_entradas_foro where id = '".$id_comentario."';";

		$result2 = $conexion->delete_comentario($query2,$seccion,$array_discusiones[0]->id);
		//echo $seccion.", ".$array_discusiones[0]->id;
	}else{
		echo "No tienes acceso a este contenido";
		echo "<input type='button' onclick='javascript: history.back()' value='Volver'>";
	}
?>