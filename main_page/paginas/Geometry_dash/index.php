<?php
	session_start();
	
	if(isset($_SESSION['usuario'])){
		$usuario = $_SESSION['usuario'];
		include_once("../../admin/conection/conection.php");

		$conexion = new Conection("localhost","root","","geometrydash");
		//recuperamos la imagen de perfil de la nueva tabla
		$query = "select ius.idUsuario,src from img_usuario_servidor as ius join usuario as u on(ius.idUsuario=u.idUsuario) where usuario = '".$usuario."';";
		$result = $conexion->consulta($query);

		$array_imgs = [];
		while ($row = $result->fetch_object()){
			array_push($array_imgs, $row );
		}
	}
	//verificamos si el logro ya existe en ese usuario
	$query_logro_30_saltos_conseguido = "select nombre_logro from logros_juegos as lg join usuario as u on(lg.idUsuario=u.idUsuario) where usuario = '".$usuario."' 
	and nombre_logro = '30 saltos en GD!';";
	$result_logro_30_conseguido = $conexion->consulta($query_logro_30_saltos_conseguido);

	//verificamos si se ha superado el logro de 30 saltos
	$query_logro_30_saltos = "select usuario,valor from variables_geometry_dash_usuarios as vgdu join usuario as u on(vgdu.idUsuario = u.idUsuario) 
	where usuario = '".$usuario."' and valor >= 30;";
	$result_logro_30_saltos = $conexion->consulta($query_logro_30_saltos);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
	<meta name="description" content="Nuevo super Mario Online esta aquí">
  	<meta name="keywords" content="game,juego,super-mario,online,canvas">
 	<meta name="author" content="Antonio González Mandiá">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Geometry Dash </title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<header>
		
	</header>
	<nav id="nav">
		<ul id="nav_ul" class="nav">
			<li class="li_ul"><a href="../../index.php" style='width: 100%; margin-left:0px;'>Index</a></li>
			<li class="li_ul"><a href="index.php" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>
			<li class="li_ul"><a href="../Arkanoid/index.php" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>
			<li class="li_ul"><a href="#" style='width: 100%; margin-left:0px;'>Opciones</a>
				<ul id="sublista">
					<li class="sub_li"><a href="puntuaciones/tus_puntuaciones/tus_puntuaciones.php" style='width: 100%; margin-left:0px;'>Tus puntuaciones</a></li>
					<li class="sub_li"><a href="../Geometry_dash/puntuaciones/top_10_puntuaciones/puntuaciones.php" style='width: 100%; margin-left:0px;'>Mejores puntuaciones</a></li>
					<li class="sub_li"><a href="paginas/modo_creativo/modo_creativo.php" style='width: 100%; margin-left:0px;'>Modo creativo</a></li>
					<li class="sub_li"><a href="../Foro/foro.php" style='width: 100%; margin-left:0px;'>Foro</a></li>
					<li class="sub_li"><a href="../Chat/chat_online.php" style='width: 100%; margin-left:0px;'>Chat online</a></li>

				</ul>
			</li>
			<!-- un hueco reservado para cuando te logueas -->
			<?php
				//CONFIGURAR PARA ENVIAR PUNTUACIONES SIN ESTAR LOGUEADO(PREGUNTAR UN "NICK" AL INICIAR,O AL DESLOGUEARTE MANDAR AL USUARIO A LA PAGINA DE INICIO)
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					//echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_SESSION['usuario']."</b></u>!"."</a>";
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_SESSION['usuario']."</b></u>!"."<img style='width: 30px; height: 30px; margin-left: 10px;' src='../Perfil/img_perfil/".$array_imgs[0]->src."'></a>";
					echo "<ul id=\"sublista2\">";
					echo "<li class=\"sub_li\"><a href=\"../Perfil/tu_perfil.php\" style='width: 100%; margin-left:0px;'>Tu Perfil</a></li>";
					echo "<li class=\"sub_li\"><a href=\"../Perfil/editar_perfil/editar_perfil.php\" style='width: 100%; margin-left:0px;'>Editar Perfil</a></li>";
					echo "<li class=\"sub_li\"><a href=\"../Perfil/logros/logros.php\" style='width: 100%; margin-left:0px;'>Logros</a></li>";
					echo "<li class=\"sub_li\"><a href=\"../../acciones/Logout.php\" style='width: 100%; margin-left:0px;'>Logout</a></li>";
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
			if($result_logro_30_saltos->num_rows > 0 && $result_logro_30_conseguido->num_rows < 0){
				echo "<div id='logro_completado' style='margin-left: 40%; border-radius: 10px; border: 3px solid black; width: 20%; background-color: yellow;'><p style='margin-left: 10%;'>Logro <b><u>30 saltos en GD!</u></b></p></div>";
				$query = "select idUsuario from usuario where usuario = '".$usuario."';";
				$result = $conexion->consulta($query);

				$array_usuario_actual = [];
				while ($row = $result->fetch_object()){
					array_push($array_usuario_actual, $row );
				}
				//insertamos el logro en la bd
				$fecha = date("Y/m/d");
				$query2 = "insert into logros_juegos (nombre_logro,dia_conseguido,idUsuario,juego) values('30 saltos en GD!','".$fecha."','".$array_usuario_actual[0]->idUsuario."','geometry dash');";
				$result2 = $conexion->consulta($query2);
			}
			if(isset($_GET['logro_completado'])){
				echo "<div id='logro_completado' style='margin-left: 40%; border-radius: 10px; border: 3px solid black; width: 20%; background-color: yellow;'><p style='margin-left: 15%;'>Logro <b><u>Juega GD por primera vez!</u></b></p></div>";
				//recuperamos la id del usuario
				$query = "select idUsuario from usuario where usuario = '".$usuario."';";
				$result = $conexion->consulta($query);

				$array_usuario_actual = [];
				while ($row = $result->fetch_object()){
					array_push($array_usuario_actual, $row );
				}
				//insertamos el logro en la bd
				$fecha = date("Y/m/d");
				$query2 = "insert into logros_juegos (nombre_logro,dia_conseguido,idUsuario,juego) values ('jugar GD por primera vez!','".$fecha."',".$array_usuario_actual[0]->idUsuario.",'geometry dash');";
				$result2 = $conexion->consulta($query2);
			}
		?>
		<progress id="progress" value="0" max="10000" style="width: 300px; margin-left: 40%; display: none; margin-top: 10px;"></progress>
		<div id="div_canvas">
			
			<canvas id="canvas" width="1000" height="500" onclick="javascript:gameStart();" style="width: 1000px; height:500px;">
				Su navegador no soporta Canvas.
			</canvas>

		</div>
		<div>
			<span id="letrero_pause" style="color: red; font-size: 35pt; margin-left: 38%; visibility: hidden;">GAME PAUSED</span>
		</div>
		<div id="div_dialog" style="display: none;">
			<label for="puntuacion">Puntuacion : </label><input id="puntuacion" value="0" type="text" name="puntuacion" disabled="disabled" style="width: 90px;">
			
			<audio id="audio" src="files/geometry_dash_sounds/nivel 1.mp3">
				<!--<audio id="audio" src="files/RISE-Worlds_2018.mp3">-->
			  <source id="audioSource" src="files/Melano-On_Fire_[Monstercat Release].mp3" type="audio/mpeg">
				Your browser does not support the audio element.
			</audio>

			<audio id="audio_fin" src="files/sonido_choque.mp3">
			  <source id="audioSource" src="files/sonido_choque.mp3" type="audio/mpeg">
				Your browser does not support the audio element.
			</audio>

			<audio id="audio_level_complete" src="files/sonido_finalizar_level.mp3">
			  <source id="audioSource" src="files/sonido_finalizar_level.mp3" type="audio/mpeg">
				Your browser does not support the audio element.
			</audio>
		</div>
	</section>
	<footer>
		
	</footer>
</body>
<!-- archivos js necesarios-->
<!--<script type="text/javascript" src="js\libreria multihilo\Concurrent.Thread\trunk\lib\Concurrent\Thread.js"></script>-->
<script type="text/javascript" src="js/mapas/mapa_1.js" async="async"></script>
<script type="text/javascript" src="js/mapas/mapa_2.js" async="async"></script>
<script type="text/javascript" src="js/mapas/mapa_3.js" async="async"></script>
<script id="index" type="text/javascript" src="js/index.js"></script>
</html>