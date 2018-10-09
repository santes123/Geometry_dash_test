<?php
	//if($_GET['deslogueado']){
	if(isset($_GET['deslogueado'])){
		session_start();
		session_destroy();
		header("location: index.php");
	}else{

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
				session_start();
				if($_SESSION){
					echo "<li class=\"li_ul\"><a href=\"paginas/Geometry_dash/index.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"paginas/login/login.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}
			?>
			<?php
				
				if($_SESSION){
					echo "<li class=\"li_ul\"><a href=\"paginas/Arkanoid/index.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"paginas/login/login.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}
			?>
			<li class="li_ul"><a href="#" style='width: 100%; margin-left:0px;'>Opciones</a>
				<ul id="sublista">
					<?php
						if($_SESSION){
							echo "<li class=\"sub_li\"><a href=\"\" style='width: 100%; margin-left:0px;'></a></li>";
							echo "<li class=\"sub_li\"><a href=\"\" style='width: 100%; margin-left:0px;'></a></li>";
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
				
				if($_SESSION){
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_SESSION['usuario']."</b></u>!"."</a>";
					echo "<ul id=\"sublista2\">";
					echo "<li class=\"sub_li\"><a href=\"paginas/Perfil/editar_perfil/editar_perfil.php\" style='width: 100%; margin-left:0px;'>Editar Perfil</a></li>";
					echo "<li class=\"sub_li\"><a href=\"\" style='width: 100%; margin-left:0px;' onclick=\"".session_destroy()."location.reload()\">Logout</li>";
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
			<!-- SUBSTITUIR CON LAS 3 QUE TENGO EN EL CORREO: GEOMETRY DASH,ARKANOID, Y MUCHO MAS-->
			<li><img src="img/geometry_dash.jpg"></li>
			<li><img src="img/arcanoid.png"></li>
			<li><img src="img/mucho_mas.png"></li>
		</ul>
	</div>
	<section>
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
			<a href="#">
			<marquee direction="down" width="400" height="200" behavior="alternate" style="border:solid">
				<marquee behavior="alternate">
					<h3>Contactanos en twitter</h3>
				</marquee>
			</marquee>
			</a>
		</div>
		<div>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d574867.142075881!2d37.072083953754856!3d55.748516969346056!2m3!1f0!2f0!3f0!3m2
			!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54afc73d4b0c9%3A0x3d44d6cc5757cf4c!2zTW9zY8O6LCBSdXNpYQ!5e0!3m2!1ses!2ses!4v1527689790695" width="400" 
			height="100%" frameborder="" style="border:1x solid black;" allowfullscreen>
			</iframe>
		</div>
	</footer>
</body>
</html>