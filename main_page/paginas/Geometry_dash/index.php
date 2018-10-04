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
			<li class="li_ul"><a href="../../index.php">Index</a></li>
			<li class="li_ul"><a href="login.php">Geometry Dash</a></li>
			<li class="li_ul"><a href="#">Opciones</a>
				<ul id="sublista">
					<li class="sub_li"><a href="puntuaciones/tus_puntuaciones/tus_puntuaciones.php">Tus puntuaciones</a></li>
					<li class="sub_li"><a href="../Geometry_dash/puntuaciones/top_10_puntuaciones/puntuaciones.php">Mejores puntuaciones</a></li>
					<li class="sub_li"><a href="paginas/modo_creativo/modo_creativo.php">Modo creativo</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<section>
		<progress id="progress" value="0" max="10000" style="width: 300px; margin-left: 40%; display: none;"></progress>
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
<script type="text/javascript" src="js/mapas/mapa_1.js"></script>
<script type="text/javascript" src="js/mapas/mapa_2.js"></script>
<script type="text/javascript" src="js/mapas/mapa_3.js"></script>
<script id="index" type="text/javascript" src="js/index.js"></script>
</html>