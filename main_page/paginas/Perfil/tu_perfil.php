<?php
//cargamos los datos del usuario y los mostramos
	session_start();
	$usuario = $_SESSION['usuario'];
	include_once("../../admin/conection/conection.php");
	
	$conexion = new Conection("localhost","root","","geometrydash");
	$query = "select id,nombre,apellidos,email,usuario,contrasenha,telefono,direccion,biografia from datos_usuario where usuario = '".$usuario."';";
	$result = $conexion->consulta($query);

	$array_usuarios = [];
	while ($row = $result->fetch_object()){
		array_push($array_usuarios, $row );
	}
	//recuperamos la imagen de perfil de la nueva tabla
	$query2 = "select ius.idUsuario,src from img_usuario_servidor as ius join usuario as u on(ius.idUsuario=u.idUsuario) where usuario = '".$usuario."';";
	$result2 = $conexion->consulta($query2);

	$array_imgs = [];
	while ($row2 = $result2->fetch_object()){
		array_push($array_imgs, $row2 );
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
	<title>Tu perfil</title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="css/tu_perfil.css">

	<!-- archivos js necesarios-->
	<script type="text/javascript" src="js/"></script>
</head>
<body style="background-color: lightblue;">
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
							echo "<li class=\"sub_li\"><a href=\"../Foro/foro.php\" style='width: 100%; margin-left:0px;'>Foro</a></li>";
							echo "<li class=\"sub_li\"><a href=\"../Chat/chat_online.php\" style='width: 100%; margin-left:0px;'>Chat online</a></li>";
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
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_COOKIE['user_session']."</b></u>!"."<img style='width: 30px; height: 30px; margin-left: 10px;' src='img_perfil/".$array_imgs[0]->src."'></a>";
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
	<section style="display: flex; border: 2px solid black; padding: 5px;">
		<div style="width: 70%; height: 100%;">
			<form method="POST" action="#">
				<fieldset>
					<legend id="formulario">Tus Datos</legend>
					<div style="display: flex;">
					<?php 
						if(isset($_GET['update'])){
							?>
							<div style="border: 2px solid black; border-radius: 5px; background-color: green; width: 220px; height: 50px; padding: 5px; margin-left: 15%; padding-top: 10px;">
								Tus datos han sido actualizados
							</div>
							<?php
						} 
						//si al cargar la pagina tiene un get diciendo que se ha cambiado la foto, verificamos si es diferente de silueta.jpg y si lo es añadimos el logro
						if(isset($_GET['update'])){
							//recuperamos la imagen de perfil y vemos si es diferente de "img_silueta.jpg" devolvemos true, sino false
							$query3 = "select src from img_usuario_servidor as ius join usuario as u on(ius.idUsuario=u.idUsuario) where usuario = '".$usuario."';";
							$result3 = $conexion->consulta($query2);

							$array_img_usuario = [];
							while ($row3 = $result3->fetch_object()){
								array_push($array_img_usuario, $row3 );
							}
							//recuperamos el logro de ese usuario, si ya lo tiene no hacemos nada, si no lo tiene y la img es diferente a "img_silueta.jpg" añadimos el logro
							$query4 = "select nombre_logro from logros_generales as lg join usuario as u on(lg.idUsuario=u.idUsuario) where usuario = '".$usuario."' and 
										nombre_logro = 'cambia tu foto de perfil!';";
							$result4 = $conexion->consulta($query4);

							$array_logros = [];
							while ($row4 = $result4->fetch_object()){
								array_push($array_logros, $row4 );
							}
							if($array_img_usuario[0]->src != "img_silueta.jpg" && $result4->num_rows <= 0){
								echo "<div style='border: 2px solid black; border-radius: 5px; background-color: yellow; width: 220px; height: 50px; padding: 5px; margin-left: 25%; padding-top: 10px;'>";
								echo "Logro <b><u>Cambia tu foto de perfil!</u></b>";
								echo "</div>";
								//recuperamos el id del usuario
								$query6 = "select idUsuario from usuario where usuario = '".$usuario."';";
								$result6 = $conexion->consulta($query6);

								$array_id_usuario = [];
								while ($row6 = $result6->fetch_object()){
									array_push($array_id_usuario, $row6 );
								}
								$fecha = date("Y/m/d");
								$query5 = "insert into logros_generales (nombre_logro, dia_conseguido, idUsuario) values ('cambia tu foto de perfil!','".$fecha."','".$array_id_usuario[0]->idUsuario."');";
								$result5 = $conexion->consulta($query5);
							}
						}

					?>
					</div>
					<div>
						<input type="hidden" name="id" maxlength="11" value="<?php echo utf8_encode($array_usuarios[0]->id); ?>" style="width: 200px;" readonly="readonly"><br>
					</div>
					<div>
						<label>Nombre : </label><input type="text" name="nombre" maxlength="50" value="<?php echo utf8_encode($array_usuarios[0]->nombre); ?>" style="width: 200px;" readonly="readonly"><br><br>
					</div>
					<div>
						<label>Apellidos : </label> <input type="apellidos" name="apellidos" maxlength="80" value="<?php echo utf8_encode($array_usuarios[0]->apellidos); ?>" style="width: 200px;" maxlength="255" readonly="readonly"><br><br>
					</div>
					<div>
						<label>Email : </label><input id="email" type="email" name="email" maxlength="100"value="<?php echo utf8_encode($array_usuarios[0]->email); ?>" style="width: 200px;" readonly="readonly"><br><br>
					</div>
					<div>
						<label>Usuario : </label><input type="text" name="usuario" maxlength="50" value="<?php echo utf8_encode($array_usuarios[0]->usuario); ?>" style="width: 200px;" readonly="readonly"><br><br>
					</div>
					<div>
						<label>Contraseña : </label><input type="password" name="contrasenha" maxlength="50" value="xxxxxxxxxx" style="width: 200px;" readonly="readonly"><br><br>
					</div>
					<div>
						<label>Telefono : </label><input type="text" name="telefono" maxlength="15" value="<?php if(is_null($array_usuarios[0]->telefono) === true){echo 'No especificado';}else{echo utf8_encode($array_usuarios[0]->telefono);} ?>" style="width: 200px;" readonly="readonly"><br><br>
					</div>
					<div>
						<label>Direccion : </label><input type="text" name="direccion" maxlength="100" value="<?php if(is_null($array_usuarios[0]->direccion) === true){echo 'No especificado';}else{echo utf8_encode($array_usuarios[0]->direccion);} ?>" style="width: 300px;" readonly="readonly"><br><br>
					</div>
					<div>
						<label>Biografía : </label><br>
						<textarea name="cuerpo" maxlength="400" value="<?php if(is_null($array_usuarios[0]->biografia) === true){echo 'No especificado';}else{echo utf8_encode($array_usuarios[0]->biografia);} ?>" readonly="readonly" style="width: 400px; height: 120px;">
							<?php echo utf8_encode($array_usuarios[0]->biografia); ?>
						</textarea><br><br>
					</div>
					<br>
					<!--
					<input type="submit" name="enviar" value="Enviar" style="width: 120px; height: 30px; font-size: 14pt;" />
					-->
					<a href="editar_perfil/editar_perfil.php"><input type="button" name="editar" value="Editar" style="width: 120px; height: 30px; font-size: 14pt; border-radius: 10px; background-color: yellow; border: 2px solid black;" /></a>
				</fieldset>
			</form>
		</div>
		<div style="width: 30%; height: 100%; margin-left: 15px;">
			<div style="border: 1px solid black; padding: 10px;">
				<img src="<?php echo "img_perfil/".$array_imgs[0]->src; ?>" style="width: 60%; height: 200px; margin-left: 20%;">
				<p style="margin-left: 35%;"><b><u>Foto de Perfil</u></b></p>
			</div>
		</div>
		
	</section>
</body>
</html>