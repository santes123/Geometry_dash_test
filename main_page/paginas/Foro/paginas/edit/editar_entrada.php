<?php
	session_start();

	if(isset($_SESSION['usuario'])){
		$usuario = $_SESSION['usuario'];
		include_once("../../../../admin/conection/conection.php");

		//recuperamos los datos del usuario y la discusion concreta
		$idDiscusion = $_GET['id_entrada'];
		$seccion = $_GET['seccion'];
		$usuario = $_GET['user'];

		$conexion = new Conection("localhost","root","","geometrydash");
		//recuperamos la imagen de perfil de la nueva tabla
		$query = "select ius.idUsuario,src from img_usuario_servidor as ius join usuario as u on(ius.idUsuario=u.idUsuario) where usuario = '".$usuario."';";
		$result = $conexion->consulta($query);

		$array_imgs = [];
		while ($row = $result->fetch_object()){
			array_push($array_imgs, $row );
		}
		//recuperamos los datos de la entrada seleccionada
		$query2 = "select ed.id,titulo_entrada,texto,ed.idUsuario,idDiscusion from entradas_discusiones as ed join usuario as u on(ed.idUsuario=u.idUsuario) 
		where id = '".$idDiscusion."' and usuario = '".$usuario."';";
		$result2 = $conexion->consulta($query2);

		$array_datos_entrada = [];
		while ($row2 = $result2->fetch_object()){
			array_push($array_datos_entrada, $row2 );
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
	<title>Editar entrada</title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="../../css/insertar_entrada.css">
</head>
<body>
	<header>
		
	</header>
	<nav id="nav">
		<ul id="nav_ul" class="nav">
			<li class="li_ul"><a href="../../../../index.php" style='width: 100%; margin-left:0px;'>Index</a></li>
			<!-- Mandamos primero al login si no estas logueado-->
			<?php
				//session_start();
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					echo "<li class=\"li_ul\"><a href=\"../../../Geometry_dash/index.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"../../..//login/login.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}
			?>
			<?php
				
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					echo "<li class=\"li_ul\"><a href=\"../../../Arkanoid/index.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"../../../login/login.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}
			?>
			<li class="li_ul"><a href="#" style='width: 100%; margin-left:0px;'>Opciones</a>
				<ul id="sublista">
					<?php
						//if($_SESSION){
						if(isset($_COOKIE["user_session"])){
							echo "<li class=\"sub_li\"><a href=\"../../../Foro/foro.php\" style='width: 100%; margin-left:0px;'>Foro</a></li>";
							echo "<li class=\"sub_li\"><a href=\"../../../Chat/chat_online.php\" style='width: 100%; margin-left:0px;'>Chat online</a></li>";
						}else{
							echo "<li class=\"sub_li\"><a href=\"../../../login/login.php\" style='width: 100%; margin-left:0px;'>Logueate</a></li>";
							echo "<li class=\"sub_li\"><a href=\"../../../sign_up/sign_up.php\" style='width: 100%; margin-left:0px;'>Registrate</a></li>";
						}
					?>
					<!--
					<li class="sub_li"><a href="paginas/login/login.php" style='width: 100%; margin-left:0px;'>Logueate</a></li>
					<li class="sub_li"><a href="paginas/sign_up/sign_up.php" style='width: 100%; margin-left:0px;'>Registrate</a></li>
					-->
					<li class="sub_li"><a href="../../../contacto/contacto.php" style='width: 100%; margin-left:0px;'>Contáctanos</a></li>
				</ul>
			</li>
			<!-- un hueco reservado para cuando te logueas -->
			<?php
				//if($_SESSION){
				if(isset($_COOKIE["user_session"])){
					//echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_SESSION['usuario']."</b></u>!"."</a>";
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_COOKIE['user_session']."</b></u>!"."<img style='width: 30px; height: 30px; margin-left: 10px;' src='../../../Perfil/img_perfil/".$array_imgs[0]->src."'></a>";
					echo "<ul id=\"sublista2\">";
					echo "<li class=\"sub_li\"><a href=\"../../../Perfil/tu_perfil.php\" style='width: 100%; margin-left:0px;'>Tu Perfil</a></li>";
					echo "<li class=\"sub_li\"><a href=\"../../../Perfil/editar_perfil/editar_perfil.php\" style='width: 100%; margin-left:0px;'>Editar Perfil</a></li>";
					//echo "<li class=\"sub_li\"><a href=\"\" style='width: 100%; margin-left:0px;' onclick=\"".session_destroy()."location.reload()\">Logout</li>";
					echo "<li class=\"sub_li\"><a href=\"../../../Perfil/Logros/logros.php\" style='width: 100%; margin-left:0px;'>Logros</a></li>";
					echo "<li class=\"sub_li\"><a href=\"../../../../acciones/Logout.php\" style='width: 100%; margin-left:0px;' onclick=\"\">Logout</a></li>";
					echo "</ul>";
					echo "</li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>No logueado</a></li>";
				}
			?>
		</ul>
	</nav>
	<!-- FORMULARIO -->
	<?php
		echo "<form method='POST' action='../../acciones/editar_entrada.php?idEntrada=".$idDiscusion."&user=".$usuario."&seccion=".$seccion."'>";
	?>
		<fieldset>
			<legend id="formulario">Editando entrada</legend>
			<div>
				<label>Titulo : </label><input type="text" name="titulo" maxlength="100" style="width: 200px;" value="<?php echo utf8_encode($array_datos_entrada[0]->titulo_entrada); ?>" autofocus="autofocus"><br><br>
			</div>
			<div>
				<label>Cuerpo : </label><br>
				<textarea name="cuerpo" maxlength="200" style="width: 400px; height: 120px;">
					<?php echo utf8_encode($array_datos_entrada[0]->texto); ?>
				</textarea><br><br>
			</div>
			<br>
			<input type="submit" name="enviar" value="Enviar" style="width: 120px; height: 30px; font-size: 14pt;" />
		</fieldset>
	</form>
</body>
</html>