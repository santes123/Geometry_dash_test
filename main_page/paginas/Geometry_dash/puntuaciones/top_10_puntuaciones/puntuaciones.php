<?php
	include_once '../../../../admin/conection/conection.php';
	session_start();
	
	if(isset($_SESSION['usuario'])){
		$usuario = $_SESSION['usuario'];
		include_once("../../../../admin/conection/conection.php");

		$conexion = new Conection("localhost","root","","geometrydash");
		//recuperamos la imagen de perfil de la nueva tabla
		$query = "select ius.idUsuario,src from img_usuario_servidor as ius join usuario as u on(ius.idUsuario=u.idUsuario) where usuario = '".$usuario."';";
		$result = $conexion->consulta($query);

		$array_imgs = [];
		while ($row = $result->fetch_object()){
			array_push($array_imgs, $row );
		}
	}

	$db = "geometryDash";
	$query = "select puntuacion,nivel,u.usuario as usuario from puntuaciones as p join usuario as u on(p.user_id=u.idUsuario) order by puntuacion desc limit 10;";
	//$array_campos = array("usuario","contrasenha");
	$conexion = new Conection('localhost',"root","",$db);
	$result = $conexion->consulta($query);
	$array = [];
	while ($row = $result->fetch_object()){
		array_push($array,$row);
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
	<title>Mejores Puntuciones</title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="css/puntuaciones.css">

	<!-- archivos js necesarios-->
	<!--<script type="text/javascript" src="js/"></script>-->
</head>
<body>
	<nav id="nav">
		<ul id="nav_ul" class="nav">
			<li class="li_ul"><a href="../../../../index.php" style='width: 100%; margin-left:0px;'>Index</a></li>
			<li class="li_ul"><a href="../../index.php" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>
			<li class="li_ul"><a href="../../../Arkanoid/index.php" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>
			<li class="li_ul"><a href="#" style='width: 100%; margin-left:0px;'>Opciones</a>
				<ul id="sublista">
					<li class="sub_li"><a href="../tus_puntuaciones/tus_puntuaciones.php" style='width: 100%; margin-left:0px;'>Tus puntuaciones</a></li>
					<li class="sub_li"><a href="puntuaciones.php" style='width: 100%; margin-left:0px;'>Mejores puntuaciones</a></li>
					<li class="sub_li"><a href="../../paginas/modo_creativo/modo_creativo.php" style='width: 100%; margin-left:0px;'>Modo creativo</a></li>
					<li class="sub_li"><a href="../../../Foro/foro.php" style='width: 100%; margin-left:0px;'>Foro</a></li>
					<li class="sub_li"><a href="../../../Chat/chat_online.php" style='width: 100%; margin-left:0px;'>Chat online</a></li>

				</ul>
			</li>
			<!-- un hueco reservado para cuando te logueas -->
			<?php
				//CONFIGURAR PARA ENVIAR PUNTUACIONES SIN ESTAR LOGUEADO(PREGUNTAR UN "NICK" AL INICIAR,O AL DESLOGUEARTE MANDAR AL USUARIO A LA PAGINA DE INICIO)
				//session_start();
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					//echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_SESSION['usuario']."</b></u>!"."</a>";
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_SESSION['usuario']."</b></u>!"."<img style='width: 30px; height: 30px; margin-left: 10px;' src='../../../Perfil/img_perfil/".$array_imgs[0]->src."'></a>";
					echo "<ul id=\"sublista2\">";
					echo "<li class=\"sub_li\"><a href=\"../../../Perfil/tu_perfil.php\" style='width: 100%; margin-left:0px;'>Tu Perfil</a></li>";
					echo "<li class=\"sub_li\"><a href=\"../../../Perfil/editar_perfil/editar_perfil.php\" style='width: 100%; margin-left:0px;'>Editar Perfil</a></li>";
					echo "<li class=\"sub_li\"><a href=\"../../../Perfil/logros/logros.php\" style='width: 100%; margin-left:0px;'>Logros</a></li>";
					echo "<li class=\"sub_li\"><a href=\"../../../../acciones/Logout.php\" style='width: 100%; margin-left:0px;'>Logout</a></li>";
					echo "</ul>";
					echo "</li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>No logueado</a></li>";
				}
			?>
		</ul>
	</nav>
	<section style="border: 2px solid black; padding: 25px;">
		<p style="margin-left: 34%; font-size: 25pt;"><b><u><-TOP 10 PUNTUACIONES-></u></b></p>
		<table style="border: 4px solid black; margin-left: 35%; padding: 15px;">
		<thead>
			<tr>
			<?php
			//creamos la cabecera de la tabla con un primer $result
			$link  = new mysqli('localhost',"root","",$db);
			$resultCabecera = mysqli_query($link,$query);
			$line = mysqli_fetch_array($resultCabecera, MYSQLI_ASSOC);
			foreach ($line as $col_name=>$col_value) {
		        echo "<th style='width: 120px; border: 1px solid black;'>$col_name</th>";
		   	}
			?>
			</tr>
		</thead>
		<tbody>
		<?php
			for ($i=0; $i < count($array); $i++) { 
				$puntuacion = $array[$i];
				echo "<tr>";
				echo "<td style='width: 120px; border: 1px solid black;'>".$puntuacion->puntuacion."</td>";
				echo "<td style='width: 120px; border: 1px solid black;'>".$puntuacion->nivel."</td>";
				echo "<td style='width: 120px; border: 1px solid black;'>".$puntuacion->usuario."</td>";
				echo "</tr>";
			}
		?>
		</tbody>
		</table>
	</section>
</body>
</html>