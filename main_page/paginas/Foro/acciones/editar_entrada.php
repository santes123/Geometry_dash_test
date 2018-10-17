<?php
	if(isset($_GET['idEntrada'])){
		$idEntrada = $_GET['idEntrada'];
		$user = $_GET['user'];
		$seccion = $_GET['seccion'];
		$titulo_nuevo = $_POST['titulo'];
		$cuerpo_nuevo = $_POST['cuerpo'];
		//echo "id = ".$idEntrada."<br>user = ".$user."<br>seccion = ".$seccion."<br>titulo = ".$titulo_nuevo."<br>cuerpo = ".$cuerpo_nuevo;

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
		$query2 = "update entradas_discusiones set titulo_entrada = '".$titulo_nuevo."', texto='".$cuerpo_nuevo."' where id=".$idEntrada.";";
		//echo $query2;
		$result2 = $conexion->update_entrada_comentario($query2,$seccion,$array_discusiones[0]->id);
		
	}else{
		echo "No tienes acceso a este contenido";
		echo "<input type='button' onclick='javascript: history.back()' value='Volver'>";
	}
?>