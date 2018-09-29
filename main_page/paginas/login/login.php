<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
  	<meta name="keywords" content="">
 	<meta name="author" content="Antonio González">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Login </title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="css/login.css">

	<!-- archivos js necesarios-->
	<!--
	<script type="text/javascript" src="js/"></script>
	-->
</head>
<body>
	<header>

	</header>
	<nav id="nav">
		<ul id="nav_ul" class="nav">
			<li class="li_ul"><a href="../../index.php">Index</a></li>
			<li class="li_ul"><a href="login.php">Geometry Dash</a></li>
			<li class="li_ul"><a href="#">Opciones</a>
				<ul id="sublista">
					<li class="sub_li"><a href="#">Tus puntuaciones</a></li>
					<li class="sub_li"><a href="../Geometry_dash/puntuaciones/puntuaciones.php">Mejores puntuaciones</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<section>
		<form method="POST" action="acciones/verificar_login.php">
			<fieldset>

			<legend id="formulario">Login</legend>
			<div>
				<label>Usuario : </label><input type="text" name="usuario" size="50" maxlength="50" style="width: 200px;" autofocus="autofocus"><br><br>
			</div>
			<div>
				<label>Contraseña : </label> <input type="password" name="contrasenha" size="50" style="width: 200px;" maxlength="255">
			</div>
			<br><br>
			No tienes cuenta? <a href="../sign_up/sign_up.php">Registrate!</a><br><br>
			<input type="submit" name="enviar" value="loguear" style="width: 120px; height: 30px; font-size: 14pt;" />
			</fieldset>
		</form>
	</section>
	<?php

	?>
</body>
</html>