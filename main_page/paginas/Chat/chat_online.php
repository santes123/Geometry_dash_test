<?php
	//SEGUIR RETOCANDO EL CHAT E INTENTAR PONER ONLINE LA PAGINA PARA PROBARLO
	//cargamos los datos de las categorias
	include_once("../../admin/conection/conection.php");
	
	$conexion = new Conection("localhost","root","","geometrydash");
	$query = "select id,categoria from categorias_chat;";
	$result = $conexion->consulta($query);

	$array_categorias = [];
	while ($row = $result->fetch_object()){
		array_push($array_categorias, $row );
	}

	session_start();
	if(isset($_SESSION['usuario'])){
		/*
		echo "<script type=\"text/javascript\">";
		echo "alert('COOKIE CREADA!');";
		echo "</script>";
		*/
		setcookie("user_session", $_SESSION['usuario'], time() + 3600);

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
	<title>Chat Online</title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="css/chat_online.css">
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
							echo "<li class=\"sub_li\"><a href=\"../Foro/foro.php\" style='width: 100%; margin-left:0px;'>Foro</a></li>";
							echo "<li class=\"sub_li\"><a href=\"chat_online.php\" style='width: 100%; margin-left:0px;'>Chat online</a></li>";
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
			<div style="width: 100%; height: 100%; border: 0px solid black; display: flex;">
				<div id="usuarios_online" style="border-right: 2px solid black; width: 20%; background-color: white;">
					
				</div>
				<div id="mensajes_y_enviar" style="width: 80%; background-color: white;">
					<div id="mensajes" style="width: 100%; height: 90%; padding: 10px; overflow-y: scroll; overflow-x: hidden;">
						
					</div>
					<div id="enviar_mensajes" style="width: 100%; height: 10%; border-top: 2px solid black; padding: 10px;">
						<select name="canal" onchange="javascript:alert(this.value);" style="height: 25px;">
							<option>Canal</option>
							<?php
								for ($i=0; $i < count($array_categorias); $i++) { 
									$categoria = $array_categorias[$i];
									echo "<option value='".$categoria->categoria."'>";
									echo $categoria->categoria;
									echo "</option>";
								}	
							?>
						</select>
						<div class="tooltip">
							<input id="input_mensaje" type="text" name="mensaje" maxlength="150" style="width: 400px; height: 25px; border: 2px solid black;" placeholder="Escribe tu mensaje" autofocus="autofocus">
							<span id="tooltiptext" style="color: red;">Escibre un mensaje!</span>
							<br>
						</div>
						<input type="button" name="enviar_mensaje" value="Enviar mensaje" style="width: 100px; height: 30px; font-size: 10pt; border-radius: 10px; background-color: yellow; border: 2px solid black;" onclick="javascript: enviarMensaje(document.getElementById('input_mensaje').value);">
					</div>
				</div>
			</div>
			
		</div>
	</section>
</body>
<!-- archivos js necesarios-->
<script type="text/javascript" src="js/chat_online.js"></script>

<script type="text/javascript">
	//en el onload() cargamos la funcion para verificar si esta online o no
	//window.onload = entrar_chat();
	//window.onunload = entrar_chat();
	/*window.onload = function(){
		entrar_chat()
	};
	*/
	//guardamos el usuario en el localStorage
	var miStorage = window.localStorage;
	localStorage.setItem("usuario", '<?php echo $_SESSION['usuario']; ?>');
	function entrar_chat () {
		if(navigator.Online){
			alert("Bienvenido, estas conectado!");

			//añadimos tu usuario a la lista
			conectarse_lista(localStorage.getItem("usuario"));
		}else{
			alert("No tienes conexion a internet, vuelve a intentarlo mas tarde." 
				+"Cierra esta ventana y se te redirecionará a la pagina principal.");
			
			setTimeout(function(){
				//funciona como una redirección HTTP
				window.location.replace("../../index.php");
			}, 500);
			
			//conectarse_lista(localStorage.getItem("usuario"));
		}
	}

</script>

</html>