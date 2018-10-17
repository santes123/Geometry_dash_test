<?php
	//mandamos una peticion GET al validar usuario, y si llega el valor,creamos la cookie de usuario para 1 hora
	session_start();
	if(isset($_SESSION['usuario'])){
		/*
		echo "<script type=\"text/javascript\">";
		echo "alert('COOKIE CREADA!');";
		echo "</script>";
		*/
		setcookie("user_session", $_SESSION['usuario'], time() + 3600);

		//recogemos la foto de usuario
		$usuario = $_SESSION['usuario'];
		include_once("admin/conection/conection.php");

		$conexion = new Conection("localhost","root","","geometrydash");
		//recuperamos la imagen de perfil de la nueva tabla
		$query = "select ius.idUsuario,src from img_usuario_servidor as ius join usuario as u on(ius.idUsuario=u.idUsuario) where usuario = '".$usuario."';";
		$result = $conexion->consulta($query);

		$array_imgs = [];
		while ($row = $result->fetch_object()){
			array_push($array_imgs, $row );
		}
	}else{
		unset($_COOKIE['user_session']);
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
	<title>Pagina Principal</title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body style="background-color: lightblue;">
	<header>
		
	</header>
	<nav id="nav">
		<ul id="nav_ul" class="nav">
			<li class="li_ul"><a href="index.php" style='width: 100%; margin-left:0px;'>Index</a></li>
			<!-- Mandamos primero al login si no estas logueado-->
			<?php
				//session_start();
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					echo "<li class=\"li_ul\"><a href=\"paginas/Geometry_dash/index.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"paginas/login/login.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}
			?>
			<?php
				
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					echo "<li class=\"li_ul\"><a href=\"paginas/Arkanoid/index.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"paginas/login/login.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}
			?>
			<li class="li_ul"><a href="#" style='width: 100%; margin-left:0px;'>Opciones</a>
				<ul id="sublista">
					<?php
						//if($_SESSION){
						if(isset($_COOKIE["user_session"])){
							echo "<li class=\"sub_li\"><a href=\"paginas/Foro/foro.php\" style='width: 100%; margin-left:0px;'>Foro</a></li>";
							echo "<li class=\"sub_li\"><a href=\"paginas/Chat/chat_online.php\" style='width: 100%; margin-left:0px;'>Chat online</a></li>";
						}else{
							echo "<li class=\"sub_li\"><a href=\"paginas/login/login.php\" style='width: 100%; margin-left:0px;'>Logueate</a></li>";
							echo "<li class=\"sub_li\"><a href=\"paginas/sign_up/sign_up.php\" style='width: 100%; margin-left:0px;'>Registrate</a></li>";
						}
					?>
					<!--
					<li class="sub_li"><a href="paginas/login/login.php" style='width: 100%; margin-left:0px;'>Logueate</a></li>
					<li class="sub_li"><a href="paginas/sign_up/sign_up.php" style='width: 100%; margin-left:0px;'>Registrate</a></li>
					-->
					<li class="sub_li"><a href="paginas/contacto/contacto.php" style='width: 100%; margin-left:0px;'>Contáctanos</a></li>
				</ul>
			</li>
			<!-- un hueco reservado para cuando te logueas -->
			<?php
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					//echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_COOKIE['user_session']."</b></u>!"."<img style='width: 30px; height: 30px; margin-left: 10px;' src='paginas/Perfil/img_perfil/".$array_imgs[0]->src."'></a>";
					//usamos la $_SESSION porque se actualiza al momento, usando $_COOKIE hace falta refrescar el navegador para que se actualize
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_SESSION['usuario']."</b></u>!"."<img style='width: 30px; height: 30px; margin-left: 10px;' src='paginas/Perfil/img_perfil/".$array_imgs[0]->src."'></a>";
					echo "<ul id=\"sublista2\">";
					echo "<li class=\"sub_li\"><a href=\"paginas/Perfil/tu_perfil.php\" style='width: 100%; margin-left:0px;'>Tu Perfil</a></li>";
					echo "<li class=\"sub_li\"><a href=\"paginas/Perfil/editar_perfil/editar_perfil.php\" style='width: 100%; margin-left:0px;'>Editar Perfil</a></li>";
					//echo "<li class=\"sub_li\"><a href=\"\" style='width: 100%; margin-left:0px;' onclick=\"".session_destroy()."location.reload()\">Logout</li>";
					echo "<li class=\"sub_li\"><a href=\"paginas/Perfil/Logros/logros.php\" style='width: 100%; margin-left:0px;'>Logros</a></li>";
					echo "<li class=\"sub_li\"><a href=\"acciones/Logout.php\" style='width: 100%; margin-left:0px;' onclick=\"\">Logout</a></li>";
					echo "</ul>";
					echo "</li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>No logueado</a></li>";
				}
			?>
		</ul>
	</nav>
	<div id="slider">
		<ul>
			<li><img src="img/geometry_dash.jpg"></li>
			<li><img src="img/arcanoid.png"></li>
			<li><img src="img/mucho_mas.png"></li>
		</ul>
	</div>
	<section>
		<?php
			//div para cuando te registras y te mandan aquí y completas el 1º logro
			if(isset($_GET['logro_completado'])){
				echo "<div id='alerta_sin_conincidencia' style='margin-left: 40%; border-radius: 10px; border: 3px solid black; width: 20%; background-color: yellow;'><p style='margin-left: 15%;'>Logro <b><u>Registro completado!</u></b></p></div>";
			}
		?>
		<div>
			<article class="elemento">
				
			</article>
			<article class="elemento">
				
			</article>
			<article class="elemento">
				
			</article>
		</div>
		<div>
			<article class="elemento">
				
			</article>
			<article class="elemento">
				
			</article>
			<article class="elemento">
				
			</article>
		</div>
	</section>
	<footer>
		<div>
			<a href="https://twitter.com/AnToNiOYeahM">
			<marquee direction="down" width="400" height="200" behavior="alternate" style="border:solid; float: left; margin-right: 100px;">
				<marquee behavior="alternate">
					<h3>Contactanos en twitter</h3>
				</marquee>
			</marquee>
			</a>
		</div>
		<div>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d574867.142075881!2d37.072083953754856!3d55.748516969346056!2m3!1f0!2f0!3f0!3m2
			!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54afc73d4b0c9%3A0x3d44d6cc5757cf4c!2zTW9zY8O6LCBSdXNpYQ!5e0!3m2!1ses!2ses!4v1527689790695" width="400" 
			height="100%" frameborder="" style="border:1x solid black; float: left;" allowfullscreen>
			</iframe>
		</div>
</footer>
</body>
</html>