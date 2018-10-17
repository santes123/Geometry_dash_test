<?php
	session_start();
	if(isset($_SESSION['usuario'])){
		setcookie("user_session", $_SESSION['usuario'], time() + 3600);

		include_once("../../admin/conection/conection.php");

		//recogemos la foto de usuario
		$usuario = $_SESSION['usuario'];

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
	<title>Foro</title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="css/foro.css">
</head>
<body>
	<header>
		
	</header>
	<nav id="nav">
		<ul id="nav_ul" class="nav">
			<li class="li_ul"><a href="../../index.php" style='width: 100%; margin-left:0px;'>Index</a></li>
			<!-- Mandamos primero al login si no estas logueado-->
			<?php
				//session_start();
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					echo "<li class=\"li_ul\"><a href=\"../Geometry_dash/index.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"../login/login.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}
			?>
			<?php
				
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					echo "<li class=\"li_ul\"><a href=\"../Arkanoid/index.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"../login/login.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}
			?>
			<li class="li_ul"><a href="#" style='width: 100%; margin-left:0px;'>Opciones</a>
				<ul id="sublista">
					<?php
						//if($_SESSION){
						if(isset($_COOKIE["user_session"])){
							echo "<li class=\"sub_li\"><a href=\"foro.php\" style='width: 100%; margin-left:0px;'>Foro</a></li>";
							echo "<li class=\"sub_li\"><a href=\"../chat/chat_online.php\" style='width: 100%; margin-left:0px;'>Chat online</a></li>";
						}else{
							echo "<li class=\"sub_li\"><a href=\"../login/login.php\" style='width: 100%; margin-left:0px;'>Logueate</a></li>";
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
				
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					//echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_SESSION['usuario']."</b></u>!"."</a>";
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_COOKIE['user_session']."</b></u>!"."<img style='width: 30px; height: 30px; margin-left: 10px;' src='../Perfil/img_perfil/".$array_imgs[0]->src."'></a>";
					echo "<ul id=\"sublista2\">";
					echo "<li class=\"sub_li\"><a href=\"../Perfil/tu_perfil.php\" style='width: 100%; margin-left:0px;'>Tu Perfil</a></li>";
					echo "<li class=\"sub_li\"><a href=\"../Perfil/editar_perfil/editar_perfil.php\" style='width: 100%; margin-left:0px;'>Editar Perfil</a></li>";
					//echo "<li class=\"sub_li\"><a href=\"\" style='width: 100%; margin-left:0px;' onclick=\"".session_destroy()."location.reload()\">Logout</li>";
					echo "<li class=\"sub_li\"><a href=\"../Perfil/Logros/logros.php\" style='width: 100%; margin-left:0px;'>Logros</a></li>";
					echo "<li class=\"sub_li\"><a href=\"../../acciones/Logout.php\" style='width: 100%; margin-left:0px;' onclick=\"\">Logout</a></li>";
					echo "</ul>";
					echo "</li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>No logueado</a></li>";
				}
			?>
		</ul>
	</nav>
	<section>
		<div id="chat" style="width: 80%; margin-left: 10%; height: 500px; border: 2px solid black;">
			<?php
				$conexion = new Conection("localhost","root","","geometrydash");
				//recuperamos las discusiones
				$query = "select id,nombre_discusion as discusion from discusiones order by id asc;";
				$result = $conexion->consulta($query);

				$array_discusiones = [];
				while ($row = $result->fetch_object()){
					array_push($array_discusiones, $row );
				}
				for ($i=0; $i < count($array_discusiones); $i++) { 
					$discusion = $array_discusiones[$i];
					echo "<a class='enlace_discusion' href='paginas/discusiones/".$discusion->discusion.".php?id=".$discusion->id."'>";
					echo "<div class='discusiones' style='width: 80%; text-align: left; border: 2px solid black; margin: 2%; margin-left: 10%;'>";
					//echo "<a class='enlace_discusion' href='paginas/discusiones/".$discusion->discusion.".php?id=".$discusion->id."'>";
					echo "<p style='font-size: 15pt; margin-left: 1%;'>";
					echo "<b><u>".$discusion->discusion."</u></b>";
					echo "</p>";
					//echo "</a>";
					echo "</div>";
					echo "</a>";
				}
			?>
		</div>
	</section>
</body>
</html>