<?php
	if(isset($_GET['idComentario'])){
		$idComentario = $_GET['idComentario'];
		$user = $_GET['user'];
		$seccion = $_GET['seccion'];
		$texto_nuevo = $_POST['comentario'];
		//echo "id = ".$idComentario."<br>user = ".$user;

		include_once("../../../admin/conection/conection.php");

		//recuperamos el id de la discusion
		$conexion = new Conection("localhost","root","","geometrydash");

		$query = "select id from discusiones where nombre_discusion='".$seccion."';";
		$array_discusiones = [];
		$result = $conexion->consulta($query);
		while ($row = $result->fetch_object()){
			array_push($array_discusiones, $row);
		}
		//actualizamos los datos en la bbdd
		$query2 = "update comentarios_entradas_foro set comentario='".$texto_nuevo."' where id=".$idComentario.";";

		$result2 = $conexion->update_entrada_comentario($query2,$seccion,$array_discusiones[0]->id);
	}else{
		echo "No tienes acceso a este contenido";
		echo "<input type='button' onclick='javascript: history.back()' value='Volver'>";
	}
?>