<?php
	if(isset($_POST['update'])){
		//var_dump($_POST);
		//tabla datos_usuario
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$email = $_POST['email'];
		$usuario = $_POST['usuario'];
		$contrasenha = md5($_POST['contrasenha']);
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$biografia = $_POST['biografia'];

		//tabla img_usuario_servidor
		$src = $_POST['img_perfil'];
		//echo $src;

		include_once("../../../admin/conection/conection.php");

		$conexion = new Conection("localhost","root","","geometrydash");
		$query = "UPDATE datos_usuario SET id = '$id', 
											nombre = '$nombre', 
											apellidos = '$apellidos', 
											email = '$email', 
											usuario = '$usuario', 
											contrasenha = '$contrasenha', 
											telefono = '$telefono', 
											direccion = '$direccion',
											biografia = '$biografia' WHERE id = $id;";

		$query2 = "UPDATE img_usuario_servidor SET idUsuario = '$id', src = '$src' WHERE idUsuario = $id;";
		$result = $conexion->update_usuario($query,$query2);
		var_dump($result);

		if($result == true){
			echo "<script type=\"text/javascript\">";
			echo "setTimeout(function(){ ".header("location: ../tu_perfil.php?update=true")." }, 3000);";
			echo "</script>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Actualizado</title>
</head>
<body>
	<section>
		<input type="submit" name="update" value="Update" style="width: 120px; height: 30px; font-size: 14pt; border-radius: 10px; background-color: yellow; border: 2px solid black;" />
	</section>
</body>
</html>