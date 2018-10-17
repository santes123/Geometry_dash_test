<?php
	if(isset($_POST['enviar'])){
		$titulo = $_POST['titulo'];
		$cuerpo = $_POST['cuerpo'];
		$idUsuario = $_GET['userId'];
		$idDiscusion = $_GET['idDiscusion'];

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
		$conexion = new Conection("localhost","root","","geometrydash");

		$query = "insert into entradas_discusiones (titulo_entrada,texto,idUsuario,idDiscusion) values('$titulo','$cuerpo','$idUsuario','$idDiscusion')";

		$result = $conexion->insert_entrada($query,$array_discusiones[0]->nombre_discusion,$idDiscusion);
	}else{
		echo "No tienes acceso a este contenido";
		echo "<input type='button' onclick='javascript: history.back()' value='Volver'>";
	}
?>