<?php
	//PONERME CON LO DE LOGROS Y METER UN PAR DE LOGROS COMO TIEMPO DE CONEXION,JUGAR AL GEOMERY DASH,REGISTRARTE,TU PRIMER LOGUEO..
	session_start();
	if(isset($_SESSION['usuario'])){
		setcookie("user_session", $_SESSION['usuario'], time() + 3600);

		include_once("../../../admin/conection/conection.php");

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
		//recuperamos los datos del usuario sesun su session

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
	<title>Logros</title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="../css/logros.css">

	<!-- archivos js necesarios-->
	<!--<script type="text/javascript" src="../js/logros.js"></script>-->
</head>
<body>
	<header>
		
	</header>
	<nav id="nav">
		<ul id="nav_ul" class="nav">
			<li class="li_ul"><a href="../../../index.php" style='width: 100%; margin-left:0px;'>Index</a></li>
			<!-- Mandamos primero al login si no estas logueado-->
			<?php
				//session_start();
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					echo "<li class=\"li_ul\"><a href=\"../../Geometry_dash/index.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"../../login/login.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}
			?>
			<?php
				
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					echo "<li class=\"li_ul\"><a href=\"../../Arkanoid/index.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"../../login/login.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}
			?>
			<li class="li_ul"><a href="#" style='width: 100%; margin-left:0px;'>Opciones</a>
				<ul id="sublista">
					<?php
						//if($_SESSION){
						if(isset($_COOKIE["user_session"])){
							echo "<li class=\"sub_li\"><a href=\"../../Foro/foro.php\" style='width: 100%; margin-left:0px;'>Foro</a></li>";
							echo "<li class=\"sub_li\"><a href=\"../../chat/chat_online.php\" style='width: 100%; margin-left:0px;'>Chat online</a></li>";
						}else{
							echo "<li class=\"sub_li\"><a href=\"../../login/login.php\" style='width: 100%; margin-left:0px;'>Logueate</a></li>";
							echo "<li class=\"sub_li\"><a href=\"../../sign_up/sign_up.php\" style='width: 100%; margin-left:0px;'>Registrate</a></li>";
						}
					?>
					<!--
					<li class="sub_li"><a href="paginas/login/login.php" style='width: 100%; margin-left:0px;'>Logueate</a></li>
					<li class="sub_li"><a href="paginas/sign_up/sign_up.php" style='width: 100%; margin-left:0px;'>Registrate</a></li>
					-->
					<li class="sub_li"><a href="../../contacto/contacto.php" style='width: 100%; margin-left:0px;'>Contáctanos</a></li>
				</ul>
			</li>
			<!-- un hueco reservado para cuando te logueas -->
			<?php
				
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					//echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_SESSION['usuario']."</b></u>!"."</a>";
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_COOKIE['user_session']."</b></u>!"."<img style='width: 30px; height: 30px; margin-left: 10px;' src='../../Perfil/img_perfil/".$array_imgs[0]->src."'></a>";
					echo "<ul id=\"sublista2\">";
					echo "<li class=\"sub_li\"><a href=\"../../Perfil/tu_perfil.php\" style='width: 100%; margin-left:0px;'>Tu Perfil</a></li>";
					echo "<li class=\"sub_li\"><a href=\"../../Perfil/editar_perfil/editar_perfil.php\" style='width: 100%; margin-left:0px;'>Editar Perfil</a></li>";
					//echo "<li class=\"sub_li\"><a href=\"\" style='width: 100%; margin-left:0px;' onclick=\"".session_destroy()."location.reload()\">Logout</li>";
					echo "<li class=\"sub_li\"><a href=\"logros.php\" style='width: 100%; margin-left:0px;'>Logros</a></li>";
					echo "<li class=\"sub_li\"><a href=\"../../../acciones/Logout.php\" style='width: 100%; margin-left:0px;' onclick=\"\">Logout</a></li>";
					echo "</ul>";
					echo "</li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>No logueado</a></li>";
				}
			?>
		</ul>
	</nav>
	<section style="border: 4px solid black;">
		<div id="logros_generales" style="overflow-y: scroll; overflow-x: hidden; padding: 5px;">
			<p style="margin-left: 40%;"><b><u>LOGROS GENERALES</u></b></p>
			<?php
				//session_start();
				//recuperamos los datos de los logros generales
				$query = "select id,nombre_logro,dia_conseguido,lg.idUsuario from logros_generales as lg join usuario as u on(lg.idUsuario=u.idUsuario) 
				where u.usuario = '".$_SESSION['usuario']."' order by dia_conseguido asc;";
				$result = $conexion->consulta($query);
				$array_logros_generales = [];

				while ($row = $result->fetch_object()){
					array_push($array_logros_generales, $row );
				}
				if($result->num_rows <= 0){
					echo "<div style='border: 3px solid black; border-radius: 10px; width: 35%; margin-left: 30%;'>";
					echo "<p style='margin-left: 5%;'> <b>No tienes logros de esta seccion actualmente.</b></p>";
					echo "</div>";
				}else{
					for ($i=0; $i < count($array_logros_generales); $i++) { 
						$logro = $array_logros_generales[$i];
						echo "<div style='width: calc(100% /5); border: 2px solid black; border-radius: 10px; padding-left: 1.5%; float: left; margin-left: 2%;'>";
						echo "<p><b><u>".$logro->nombre_logro."</u></b></p>";
						echo "<p><u>".$logro->dia_conseguido."</u></p>";
						echo "</div>";
					}
				}
			?>
		</div>
		<div id="logros_juegos" style="overflow-y: scroll; overflow-x: hidden; padding: 5px;">
			<p style="margin-left: 40%;"><b><u>LOGROS DE JUEGOS</u></b></p>
			<?php
				//recuperamos los datos de los logros de juegos
				$query = "select id,nombre_logro,dia_conseguido,lg.idUsuario,juego from logros_juegos as lg join usuario as u on(lg.idUsuario=u.idUsuario) 
				where u.usuario = '".$_SESSION['usuario']."' order by dia_conseguido asc;";
				$result = $conexion->consulta($query);
				$array_logros_juegos = [];

				while ($row = $result->fetch_object()){
					array_push($array_logros_juegos, $row );
				}
				if($result->num_rows <= 0){
					echo "<div style='border: 3px solid black; border-radius: 10px; width: 35%; margin-left: 30%;'>";
					echo "<p style='margin-left: 5%;'> <b>No tienes logros de esta seccion actualmente.</b></p>";
					echo "</div>";
				}else{
					for ($i=0; $i < count($array_logros_juegos); $i++) { 
						$logro = $array_logros_juegos[$i];
						echo "<div style='width: calc(100% /5); border: 2px solid black; border-radius: 10px; padding-left: 1.5%; float: left; margin-left: 2%;'>";
						echo "<p><b><u>".$logro->nombre_logro."</u></b></p>";
						echo "<p>".$logro->dia_conseguido."</p>";
						echo "<p><u>".$logro->juego."</u></p>";
						echo "</div>";
					}
				}
			?>
		</div>
	</section>
</body>
</html>