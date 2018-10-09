<?php
	include_once '../../admin/conection/conection.php';

	$query = "select email from datos_usuario order by email desc;";
	$conexion = new Conection('localhost',"root","","geometryDash");
	$result = $conexion->consulta($query);
	$arrayCorreos = [];
	while ($row = $result->fetch_object()){
		array_push($arrayCorreos, $row);
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
	<title> Register </title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="css/sign_up.css">
</head>
<body>
	<header>

	</header>
	<nav id="nav">
		<ul id="nav_ul" class="nav">
			<li class="li_ul"><a href="../../index.php">Index</a></li>
			<li class="li_ul"><a href="login.php">Geometry Dash</a></li>
			<li class="li_ul"><a href="#">Opciones</a>
				<ul>
					<li class="sub_li"><a href="#">Tus puntuaciones</a></li>
					<li class="sub_li"><a href="#">Mejores puntuaciones</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<section>
		<form method="POST" action="acciones/verificar_sign_up.php">
			<fieldset>

			<legend id="formulario">Sign up</legend>
			<div>
				<label>Nombre : </label><input type="text" name="nombre"maxlength="50" style="width: 200px;" autofocus="autofocus"><br><br>
			</div>
			<div>
				<label>Apellidos : </label> <input type="text" name="apellidos" maxlength="80" style="width: 200px;" maxlength="255"><br><br>
			</div>
			<div class="tooltip">
				<label>Email : </label><input id="email" type="email" name="email" maxlength="100" value="" style="width: 200px;" onblur="revisarCorreo(this.value)">
				<span id="tooltiptext" style="color: red;">Este correo ya existe,elige otro!</span>
				<br><br>
			</div>
			<div>
				<label>Usuario : </label><input type="text" name="usuario" maxlength="50" style="width: 200px;"><br><br>
			</div>
			<div>
				<label>Contraseña : </label><input type="password" name="contrasenha" maxlength="50" style="width: 200px;"><br><br>
			</div>
			<br>
			<input type="checkbox" name="checkbox" value="checkbox_condiciones" required> He leido y acepto las Policitas de privacidad<br></br>
			<input type="submit" name="enviar" value="Registrar" style="width: 120px; height: 30px; font-size: 14pt;" />
			</fieldset>
		</form>
	</section>
</body>
<!-- archivos js necesarios-->
<script type="text/javascript">
	function revisarCorreo (correoEscrito) {
		var texto_flotante = document.getElementById("tooltiptext");
		texto_flotante.style.visibility = 'hidden';
		texto_flotante.style.opacity = '0'
		<?php 
		for($i = 0;$i < count($arrayCorreos);$i++){
			$correoActual = $arrayCorreos[$i];
		?>
		if(correoEscrito=="<?php echo $correoActual->email; ?>"){
			//alert("este correo ya existe,cambialo!");
			document.getElementById("email").focus();
			texto_flotante.style.visibility = "visible";
			texto_flotante.style.opacity = "1";
		}
		<?php 
			} 
		?>

	}
</script>
</html>