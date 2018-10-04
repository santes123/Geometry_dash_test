<?php
	include_once '../../../../admin/conection/conection.php';
	$db = "geometryDash";
	session_start();
	$usuario_actual = $_SESSION['usuario'];
	$query = "select puntuacion,nivel,u.usuario as usuario from puntuaciones as p join usuario as u on(p.user_id=u.idUsuario) where u.usuario = '".$usuario_actual."' order by puntuacion desc limit 10;";
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
	<title>Tus mejores Puntuciones</title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="css/tus_puntuaciones.css">

	<!-- archivos js necesarios-->
	<!--<script type="text/javascript" src="js/"></script>-->
</head>
<body>
	<nav id="nav">
		<ul id="nav_ul" class="nav">
			<li class="li_ul"><a href="../../../../index.php">Index</a></li>
			<li class="li_ul"><a href="../../../login/login.php">Geometry Dash</a></li>
			<li class="li_ul"><a href="#">Opciones</a>
				<ul id="sublista">
					<li class="sub_li"><a href="#">Tus puntuaciones</a></li>
					<li class="sub_li"><a href="../top_10_puntuaciones/puntuaciones.php">Mejores puntuaciones</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<section style="border: 2px solid black; padding: 25px;">
		<p style="margin-left: 34%; font-size: 25pt;"><b><u><-Tus 10 mejores Puntuaciones-></u></b></p>
		<table style="border: 4px solid black; margin-left: 35%; padding: 15px;">
		<thead>
			<tr>
			<?php
			//creamos la cabecera de la tabla con un primer $result
			$link  = new mysqli('localhost',"root","",$db);
			$resultCabecera = mysqli_query($link,$query);
			if($resultCabecera->num_rows<= 0){
				echo "<p style='margin-left: 40%;'>NO TIENES PUNTUACIONES GUARDADAS!</p>";
			}else{
				$line = mysqli_fetch_array($resultCabecera, MYSQLI_ASSOC);
				foreach ($line as $col_name=>$col_value) {
		        	echo "<th style='width: 120px; border: 1px solid black;'>$col_name</th>";
		   		}
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