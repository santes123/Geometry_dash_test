<!--
hacer una pagina que te ponga tus datos y los puedas editar/hacer update
incluiremos todos los datos de la tabla datos_usuario y crearemos otras 2 tablas,una para datos extra como direccion y demas y otra para guardar la ruta de la imagen de perfil de cada usuario(campos idUsuario y src). Con las imagenes de perfil primero, le pondremos al usuario un campo para subir su archivo de imagen al servidor y a su vez poner esa imagen de foto de perfil,y en el formulario mandaremos el src de la imagen en nuestro servidor despues de subirla. Luego la foto aparecera(cargando la src desde la base de datos) en el navegador al lado del nombre y al cargar editar perfil la proxima vez.
-->
<?php
	if(isset($_FILES['img_user'])){
		//var_dump($_FILES);
		//recuperamos el nombre del fichero
		$fichero_subido = basename($_FILES['img_user']['name']);
		
		//2) ruta manual
		$move = move_uploaded_file($_FILES['img_user']['tmp_name'],"../img_perfil/".$fichero_subido);
	}
?>
<?php
//cargamos los datos del usuario y los mostramos, foto incluida de la nueva tabla
	session_start();
	$usuario = $_SESSION['usuario'];
	include_once("../../../admin/conection/conection.php");
	
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
	<link rel="stylesheet" type="text/css" href="../css/tu_perfil.css">

	<!-- archivos js necesarios-->
	<script type="text/javascript" src="../js/"></script>
</head>
<body style="background-color: lightblue;">
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
							echo "<li class=\"sub_li\"><a href=\"../../Chat/chat_online.php\" style='width: 100%; margin-left:0px;'>Chat online</a></li>";
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
					echo "<li class=\"sub_li\"><a href=\"../../Perfil/Logros/logros.php\" style='width: 100%; margin-left:0px;'>Logros</a></li>";
					echo "<li class=\"sub_li\"><a href=\"../../../acciones/Logout.php\" style='width: 100%; margin-left:0px;' onclick=\"\">Logout</a></li>";
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
			<form method="POST" action="../acciones/verificar_update_usuario.php">
				<fieldset>
					<legend id="formulario">Tus Datos</legend>
					<div>
						<input id="img_perfil_2" type="hidden" name="img_perfil" maxlength="100" value="<?php echo $array_imgs[0]->src; ?>" style="width: 200px;"><br>
					</div>
					<div>
						<input type="hidden" name="id" maxlength="11" value="<?php echo utf8_encode($array_usuarios[0]->id); ?>" style="width: 200px;"><br>
					</div>
					<div>
						<label>Nombre : </label><input type="text" name="nombre" maxlength="50" value="<?php echo utf8_encode($array_usuarios[0]->nombre); ?>" style="width: 200px;"><br><br>
					</div>
					<div>
						<label>Apellidos : </label> <input type="apellidos" name="apellidos" maxlength="80" value="<?php echo utf8_encode($array_usuarios[0]->apellidos); ?>" style="width: 200px;" maxlength="255"><br><br>
					</div>
					<div>
						<label>Email : </label><input id="email" type="email" name="email" maxlength="100"value="<?php echo utf8_encode($array_usuarios[0]->email); ?>" style="width: 200px;"><br><br>
					</div>
					<div>
						<label>Usuario : </label><input type="text" name="usuario" maxlength="50" value="<?php echo utf8_encode($array_usuarios[0]->usuario); ?>" style="width: 200px;"><br><br>
					</div>
					<div>
						<label>Contraseña : </label><input type="password" name="contrasenha" maxlength="50" value="<?php //echo utf8_encode($array_usuarios[0]->contrasenha); ?>" style="width: 200px;" required="required" placeholder="escribe tu contraseña"><br><br>
					</div>
					<div>
						<label>Telefono : </label><input type="text" name="telefono" maxlength="15" value="<?php echo utf8_encode($array_usuarios[0]->telefono); ?>" style="width: 200px;"><br><br>
					</div>
					<div>
						<label>Direccion : </label><input type="text" name="direccion" maxlength="100" value="<?php echo utf8_encode($array_usuarios[0]->direccion); ?>" style="width: 300px;"><br><br>
					</div>
					<div>
						<label>Biografía : </label><br>
						<textarea name="biografia" maxlength="400" value="" style="width: 400px; height: 120px;">
							<?php echo utf8_encode($array_usuarios[0]->biografia); ?>
						</textarea><br><br>
					</div>
					<br>
					
					<input type="submit" name="update" value="Update" style="width: 120px; height: 30px; font-size: 14pt; border-radius: 10px; background-color: yellow; border: 2px solid black;" />
					<!--<a href="editar_perfil/editar_perfil.php"><input type="button" name="editar" value="Editar" style="width: 120px; height: 30px; font-size: 14pt;" /></a>-->
				</fieldset>
			</form>
		</div>
		<div style="width: 30%; height: 100%; margin-left: 15px;">
			<div style="border: 1px solid black; padding: 10px;">
				<img id='img_perfil' src="<?php echo "../../Perfil/img_perfil/".$array_imgs[0]->src; ?>" style="width: 60%; height: 200px; margin-left: 20%;">
			</div>
			<br>
			<div>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
					<fieldset>
						<legend id="formulario"><b><u>Sube tu imagen y usala!</u></b></legend>
						<span style="font-size: 8pt;"><u>Si ya tienes tu imagen guardada anteriormente, <b>NO toques este apartado!</b>.</u></span>
						<br>
						<br>
						<input id="imagen_subida" type="file" name="img_user" accept="image/*">
						<br>
						<br>
						<input type="submit" name="enviar" value="Subir imagen" style="width: 100px; height: 30px; border-radius: 10px; background-color: yellow; border: 2px solid black;">
						
						<!--
						<input type="button" name="subir_imagen" value="Subir imagen" onclick="javascript:llamar_ajax(document.getElementById('imagen_subida'));" style="width: 100px; height: 30px; border-radius: 10px; background-color: yellow; border: 2px solid black;">
						-->
					</fieldset>
					
				</form>
			</div>
		</div>
		
	</section>
</body>
<script type="text/javascript">
	//cambiamos la src de la imagen, cambiamos todo y procedemos a updatear
	var img = document.getElementById('img_perfil');
	img.src = "../img_perfil/"+"<?php echo $fichero_subido; ?>"+"";
	var input_src = document.getElementById('img_perfil_2');
	input_src.value = "<?php echo $fichero_subido; ?>";
</script>
</html>