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
			<li class="li_ul"><a href="../../index.php" style='width: 100%; margin-left:0px;'>Index</a></li>
			<!-- Mandamos primero al login si no estas logueado-->
			<?php
				session_start();
				if($_SESSION){
					echo "<li class=\"li_ul\"><a href=\"../Geometry_dash/index.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"../login/login.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}
			?>
			<?php
				
				if($_SESSION){
					echo "<li class=\"li_ul\"><a href=\"../Arkanoid/index.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"../login/login.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}
			?>
			<li class="li_ul"><a href="#" style='width: 100%; margin-left:0px;'>Opciones</a>
				<ul id="sublista">
					<?php
						if($_SESSION){
							echo "<li class=\"sub_li\"><a href=\"\" style='width: 100%; margin-left:0px;'></a></li>";
							echo "<li class=\"sub_li\"><a href=\"\" style='width: 100%; margin-left:0px;'></a></li>";
						}else{
							echo "<li class=\"sub_li\"><a href=\"login.php\" style='width: 100%; margin-left:0px;'>Logueate</a></li>";
							echo "<li class=\"sub_li\"><a href=\"../sign_up/sign_up.php\" style='width: 100%; margin-left:0px;'>Registrate</a></li>";
						}
					?>
					<!--
					<li class="sub_li"><a href="paginas/login/login.php" style='width: 100%; margin-left:0px;'>Logueate</a></li>
					<li class="sub_li"><a href="paginas/sign_up/sign_up.php" style='width: 100%; margin-left:0px;'>Registrate</a></li>
					-->
					<li class="sub_li"><a href="../contacto/contacto.php" style='width: 100%; margin-left:0px;'>Contáctanos</a></li>
				</ul>
			</li>
			<!-- un hueco reservado para cuando te logueas -->
			<?php
				
				if($_SESSION){
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_SESSION['usuario']."</b></u>!"."</a>";
					echo "<ul id=\"sublista2\">";
					echo "<li class=\"sub_li\"><a href=\"paginas/Perfil/editar_perfil/editar_perfil.php\" style='width: 100%; margin-left:0px;'>Editar Perfil</a></li>";
					echo "<li class=\"sub_li\"><a href=\"\" style='width: 100%; margin-left:0px;' onclick=\"".session_destroy()."location.reload()\">Logout</a></li>";
					echo "</ul>";
					echo "</li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>No logueado</a></li>";
				}
			?>
		</ul>
	</nav>
	<section>
		<?php 
		//div para cuando te registras y te mandan aquí y completas el 1º logro
		if(isset($_GET['logro_completado'])){
			echo "<div id='logro_completado' style='margin-left: 40%; border-radius: 10px; border: 3px solid black; width: 20%; background-color: yellow;'><p style='margin-left: 15%;'>Logro <b><u>Registro completado!</u></b></p></div>";
		}
		//div para cuando no existe esa cuenta
		if(isset($_GET['no_existe'])){
			echo "<div id='alerta_sin_conincidencia' style='margin-left: 40%; border-radius: 10px; border: 3px solid black; width: 20%; background-color: #f43838;'><p style='margin-left: 15%;'>El usuario no existe.</p></div>";
		}
		//div para cuando no coindicen usuario y contraseña pero existe el usuario
		if(isset($_GET['no_coinciden'])){
			echo "<div id='alerta_contrasenha_incorrecta' style='margin-left: 40%; border-radius: 10px; border: 3px solid black; width: 25%; background-color: #f43838;';><p style='margin-left: 10%;'>El usuario o la contraseña no coinciden.</p></div>";
		}
		?>
		<form method="POST" action="acciones/verificar_login.php">
			<fieldset>
				<legend id="formulario">Login</legend>
				<div>
					<label>Usuario : </label><input type="text" name="usuario" size="50" maxlength="50" style="width: 200px;" autofocus="autofocus"><br><br>
				</div>
				<div>
					<label>Contraseña : </label> <input type="password" name="contrasenha" size="50" style="width: 200px;" maxlength="255">
				</div>
				<br>
				No tienes cuenta? <a href="../sign_up/sign_up.php">Registrate!</a><br>
				Has olvidado tu contraseña? <a href="paginas/recuperar_contrasenha/recuperar_contrasenha.php">Recuperar contraseña</a><br><br>
				<input type="submit" name="enviar" value="loguear" style="width: 120px; height: 30px; font-size: 14pt;" />
			</fieldset>
		</form>
	</section>
	<?php

	?>
</body>
</html>