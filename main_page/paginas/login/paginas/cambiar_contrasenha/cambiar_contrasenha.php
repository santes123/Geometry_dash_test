<?php
	//desactivamos los reportes de error
	//error_reporting(0);

	include_once '../../../../admin/conection/conection.php';
	if(isset($_POST['nuevaContrasenha'])){
		$contrasenha = $_POST['nuevaContrasenha'];
		$query = "UPDATE datos_usuario SET contrasenha = md5(".$contrasenha.") where usuario='".$_POST['usuario_anterior']."';";
		echo "<br>";
		//echo $query;
		//echo $contrasenha;
		$conexion = new Conection('localhost',"root","","geometryDash");
		$result = $conexion->update($query);
	}
	if(isset($_GET['usuario'])){
		$query = "select id from datos_usuario where usuario='".$_GET['usuario']."';";
		$conexion = new Conection('localhost',"root","","geometryDash");
		$result = $conexion->consulta($query);
		$arrayUsuarios = [];
		while ($row = $result->fetch_object()){
			array_push($arrayUsuarios, $row);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
  	<meta name="keywords" content="">
 	<meta name="author" content="Antonio González">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Cambiar contraseña </title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="../../css/cambiar_contrasenha.css">
</head>
<body>
	<header>

	</header>
	<nav id="nav">

	</nav>
	<section>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div id="div_aviso" style="border: 2px solid black; border-radius: 20px; height: 50px; width: 250px; margin-left: 250px; 
			padding: 5px; background-color: lightgreen; margin-top: 10px; display: none;">
				Se ha actualizado tu contraseña, gracias por usar nuestro servicio!.
			</div>
			<fieldset>

			<legend id="formulario"> Cambiar contraseña </legend>
			<p style="border: 2px solid black; width: 300px; background-color: grey;">Escribe y confirme la nueva contraseña</p>
			<div class="tooltip">
				<label>Nueva contraseña : </label><input id="nuevaContrasenha" type="password" name="nuevaContrasenha" maxlength="100" value="" style="width: 200px;" onblur="revisarCorreo(this.value)" required="required">
				<span id="tooltiptext" style="color: red;">Este correo NO existe!</span>
				<br><br>
			</div>
			<div>
				<label>Repetir contraseña : </label><input id="contrasenha_verified" type="password" name="contrasenha_verified" maxlength="50" style="width: 200px;" required="required"><br><br>
			</div>
			<div>
				<input id="usuario" type="hidden" name="usuario_anterior" maxlength="50" value="<?php echo $_GET['usuario'] ?>" style="width: 200px;" required="required"><br><br>
			</div>
			<br>
			<input type="submit" value="Enviar" style="width: 120px; height: 30px; font-size: 14pt;" />
			</fieldset>
		</form>
	</section>
</body>
<!-- archivos js necesarios-->
<script type="text/javascript">

</script>
</html>
<?php
	if(isset($_POST['nuevaContrasenha'])){
		echo "<script type=\"text/javascript\">";
		echo "document.getElementById(\"div_aviso\").style.display = 'block'; ";
		echo "</script>";
	}
?>