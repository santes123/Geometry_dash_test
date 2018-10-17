<?php
	if(isset($_POST['id_entrada'])){
		//recuperamos los datos de la entrada
		echo $_POST['id_entrada'];
		echo "<br>".$_POST['seccion'];
		$id_entrada = $_POST['id_entrada'];
		$seccion = $_POST['seccion'];

		include_once("../../../admin/conection/conection.php");
		//recuperamos la id de la discusion(seccion)
		$conexion = new Conection("localhost","root","","geometrydash");
		$query = "select id from discusiones where nombre_discusion = '".$seccion."';";

		$result = $conexion->consulta($query);
		$array_discusiones = [];
		while ($row = $result->fetch_object()){
			array_push($array_discusiones, $row);
		}
		echo "<br>".$array_discusiones[0]->id;
		//borramos la entrada
		$query2 = "delete from entradas_discusiones where id = '".$id_entrada."';";

		$result2 = $conexion->delete_entrada($query2,$seccion,$array_discusiones[0]->id);
		//echo $seccion.", ".$array_discusiones[0]->id;
	}else{
		echo "No tienes acceso a este contenido";
		echo "<input type='button' onclick='javascript: history.back()' value='Volver'>";
	}
	
?>
