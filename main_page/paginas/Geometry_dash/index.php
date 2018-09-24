<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
	<meta name="description" content="Nuevo super Mario Online esta aquí">
  	<meta name="keywords" content="game,juego,super-mario,online,canvas">
 	<meta name="author" content="Antonio González Mandiá">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Geometry Dash Duoq</title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<header>
		
	</header>
	<nav>
		
	</nav>
	<section>
		<progress id="progress" value="1" max="1000" style="width: 300px; margin-left: 40%; display: none;"></progress>
		<div id="div_canvas">
			
			<canvas id="canvas" width="1000" height="500" onclick="javascript:gameStart();" style="width: 1000px; 
h">
				Su navegador no soporta Canvas.
			</canvas>
		</div>
		<div id="div_dialog" style="display: none;">
			<label for="puntuacion">Puntuacion : </label><input id="puntuacion" value="0" type="text" name="puntuacion" disabled="disabled" style="width: 90px;">
		</div>
	</section>
	<footer>
		
	</footer>
</body>
<!-- archivos js necesarios-->
<script type="text/javascript" src="js/mapas/mapa_1.js"></script>
<script>
	var mundo;
	window.onload=function(){
		mundo=new Mundo("canvas",150,1500);	
	};
</script>
<script type="text/javascript" src="js/index.js"></script>
</html>