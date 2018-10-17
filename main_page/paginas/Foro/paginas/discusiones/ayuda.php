<?php
	session_start();
	if(isset($_SESSION['usuario'])){
		setcookie("user_session", $_SESSION['usuario'], time() + 3600);

		include_once("../../../../admin/conection/conection.php");

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

		//recuperamos el id de la discusion para cargar los acticulos
		$id_discusion = $_GET['id'];
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
	<title>Foro - ayuda</title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="../../css/foro.css">
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
					echo "<li class=\"li_ul\"><a href=\"../../../login/login.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
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
							echo "<li class=\"sub_li\"><a href=\"../../foro.php\" style='width: 100%; margin-left:0px;'>Foro</a></li>";
							echo "<li class=\"sub_li\"><a href=\"../../../chat/chat_online.php\" style='width: 100%; margin-left:0px;'>Chat online</a></li>";
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
	<section>
		<div id="chat" style="width: 80%; margin-left: 10%; height: 500px; border: 2px solid black; overflow-y: scroll; overflow-x: hidden;">
			<?php
				$conexion = new Conection("localhost","root","","geometrydash");
				//recuperamos el nombre de la discusion(seccion/pagina dentro del foro) actual
				$query8 = "select nombre_discusion from discusiones where id = '".$id_discusion."';";
				$result8 = $conexion->consulta($query8);

				$discusion_actual = [];
				while ($row8 = $result8->fetch_object()){
					array_push($discusion_actual, $row8 );
				}
				//recuperamos los posts de esta discusion
				$query = "select id,titulo_entrada,texto,idUsuario,idDiscusion from entradas_discusiones where idDiscusion='".$id_discusion."';";
				$result = $conexion->consulta($query);

				$array_discusiones = [];
				while ($row = $result->fetch_object()){
					array_push($array_discusiones, $row );
				}
				//recuperamos el usuario actual
				$query4 = "select idUsuario,usuario from usuario where usuario='".$_SESSION['usuario']."';";
				$result4 = $conexion->consulta($query4);
				$usuarioActual = [];

				while ($row4 = $result4->fetch_object()){
					array_push($usuarioActual, $row4 );
				}
				//verificamos si hay acticulos en esta seccion
				if(count($array_discusiones) > 0){
					//$contador_posicion = 1;
					for ($i=0; $i < count($array_discusiones); $i++) { 

						$discusion = $array_discusiones[$i];
						//recuperamos el usuario k lo posteo
						$query2 = "select u.idUsuario,usuario,ed.id as entrada from usuario as u join entradas_discusiones as ed on(u.idUsuario=ed.idUsuario) where ed.id='".$discusion->id."';";
						$result2 = $conexion->consulta($query2);

						$array_usuarios = [];
						while ($row2 = $result2->fetch_object()){
							array_push($array_usuarios, $row2 );
						}
						echo "<div class='discusiones' style='width: 80%; text-align: left; border: 2px solid black; margin: 2%; margin-left: 10%; padding: 5px;'>";
						if($array_usuarios[0]->usuario == $_SESSION['usuario']){
							echo "<input type='checkbox' value='".$discusion->id."'> Seleccionar ";
						}
						//titulo
						echo "<p style='font-size: 18pt; color: blue; margin-left: 2.5%;'>";
						echo "<u>".utf8_encode($discusion->titulo_entrada)."</u>";
						echo "</p>";
						//texto
						echo "<p style='font-size: 15pt; margin-left: 2.5%;'>";
						echo "".utf8_encode($discusion->texto)."";
						echo "</p>";

						//recuperamos el nombre del usuario
						$query10 = "select usuario from usuario as u join entradas_discusiones as ed on(u.idUsuario=ed.idUsuario) where ed.id = '".$discusion->id."';";
						$result10 = $conexion->consulta($query10);

						$escrito_por_entrada = [];
						while ($row10 = $result10->fetch_object()){
							array_push($escrito_por_entrada, $row10 );
						}
						if(utf8_encode($escrito_por_entrada[0]->usuario) == $_SESSION['usuario']){
							echo "<div style=display:flex;>";
							//boton de editar comentario
							echo "<a href='../edit/editar_entrada.php?id_entrada=".$discusion->id."&seccion=".utf8_encode($discusion_actual[0]->nombre_discusion)."&user=".$_SESSION['usuario']."'><input id='editar_entrada' class='borrar_entrada' type='button' value = 'Editar esta entrada' style=''></a>";
							//usuario que lo posteo
							echo "<p style='text-align: right; margin-right: 5%; font-size: 14pt; color: red; width: 50%;'>";
							echo "<b><u>".utf8_encode($array_usuarios[0]->usuario)."</u></b>";
							echo "</div>";
						}else{
							//usuario que lo posteo
							echo "<p style='text-align: right; margin-right: 5%; font-size: 14pt; color: red;'>";
							echo "<b><u>".utf8_encode($array_usuarios[0]->usuario)."</u></b>";
						}
						//seccion de comentarios
						//verificamos que hay comentarios en este post y los recuperamos si existen
						$query7 = "select id,comentario from comentarios_entradas_foro as cef where idEntrada = '".$discusion->id."';";
						$result7 = $conexion->consulta($query7);

						$array_comentarios_entrada_actual = [];
						while ($row7 = $result7->fetch_object()){
							array_push($array_comentarios_entrada_actual, $row7 );
						}

						if(count($array_comentarios_entrada_actual) > 0){
							echo "<p style='margin-left: 5%; font-size: 14pt;'> Comentarios :</p>";
							for ($x=0; $x < count($array_comentarios_entrada_actual); $x++) {

								//los comentarios tambien podemos añadirlos por ajax 
								$comentario = $array_comentarios_entrada_actual[$x];
								//recuperamos el nombre del usuario
								$query4 = "select usuario from usuario as u join comentarios_entradas_foro as cef on(u.idUsuario=cef.idUsuario) where cef.id = '".$comentario->id."';";
								$result4 = $conexion->consulta($query4);

								$escrito_por = [];
								while ($row4 = $result4->fetch_object()){
									array_push($escrito_por, $row4 );
								}
								echo "<div style='border: 1px solid black; margin-bottom: 5px; width: 90%;'>";
								echo "<p style='text-align: left; margin-left: 10%; font-size: 12pt; color: black;'>";
								echo "".utf8_encode($comentario->comentario);
								echo "</p>";
								echo "<div style='display:flex; justify-content: space-between;'>";
								echo "<p style='text-align: left; margin-left: 10%; font-size: 10pt;'>Escrito por <a><b><u>".utf8_encode($escrito_por[0]->usuario)."</u></b></a></p>";
								if(utf8_encode($escrito_por[0]->usuario) == $_SESSION['usuario']){
									//editar comentario
									echo "<a href='../edit/editar_comentario.php?id_comentario=".$comentario->id."&seccion=".utf8_encode($discusion_actual[0]->nombre_discusion)."&user=".$_SESSION['usuario']."'><input id='borrar_comentario' class='borrar_comentario' type='button' value = 'Editar este comentario' style=''></a>";
									//eliminar comentario
									echo "<a href='../../acciones/borrar_comentario.php?id_comentario=".$comentario->id."&seccion=".utf8_encode($discusion_actual[0]->nombre_discusion)."'><input id='borrar_comentario' class='borrar_comentario' type='button' value = 'Borrar este comentario' style=''></a>";
								}
								if(isset($_GET['fallido'])){
									echo "<div style='border: 2px solid black; border-radius: 10px;'>";
									echo "<p style='color: red; font-size: 14pt; background-color:grey;'>Tu comentario o entrada no se ha podido borrar por alguna causa inesperada</p>";
									echo "</div>";
								}
								echo "</div>";
								echo "</div>";
							}
						}else{
							echo "<div>";
							echo "</div>";
						}
						echo "<b><p style='margin-left: 2.5%; font-size: 13pt;'> Añade tu comentario : </p></b>";
						echo "<form method='POST' action='../../acciones/add_comentario.php?id=".$id_discusion."&userId=".$usuarioActual[0]->idUsuario."&idEntrada=".$array_discusiones[$i]->id."'>";
						echo "<textarea name='comentario' style='width: 400px; height: 120px; margin-left: 2.5%; padding: 1%;' maxlength='200'></textarea>";
						echo "<br>";
						echo "<input type='submit' value='Enviar' style='width: 150px; margin-top: 2.5%;'>";
						echo "</form>";
						echo "</div>";
						//$contador_posicion++;
					}
				}else{
					echo "<div class='discusiones' style='width: 80%; text-align: left; border: 2px solid black; margin: 2%; margin-left: 10%;'>";
					echo "<p style='font-size: 15pt; margin-left: 1%;'>";
					echo "<b><u>No hay posts actualmente en esta seccion! Crea uno tu mismo</u></b>";
					echo "</p>";
					echo "</div>";
				}
				
				echo "<div style='margin-top: 10%;'>";
				echo "<input type='button' value='Nueva entrada' onclick='javascript: window.location =  \"../../paginas/add/insertar_entrada.php?id=".$id_discusion."&userId=".$usuarioActual[0]->idUsuario."\"' style='float: right;'>";
				//al boton le pasamos una funcion para borrar las entradas seleccionadas
				echo "<input type='button' value='Borrar seleccionado' onclick='javascript: borrar_entrada_seleccionada();' style='float: right;'>";
				echo "</div>";
			?>
		</div>
		<a href="../../foro.php"><input type="button" name="volver" value="Atras"></a>
	</section>
</body>
<!-- archivos js necesarios-->
<script type="text/javascript" src="../../js/ajax.js"></script>
<script type="text/javascript">
	//borramos el post seleccionad (solo tuyos) y refrescar la pagina
	function borrar_entrada_seleccionada () {
		//recuperamos las posiciones que estan seleccionadas
		var array_checkbox = document.getElementsByTagName("input");
		var array_checkbox_seleccionados = [];
		//recorremos los checkbox para saber cuales estan seleccionados
		for (var i = 0; i < array_checkbox.length; i++) {
			if(array_checkbox[i].checked){
				array_checkbox_seleccionados.push(array_checkbox[i]);
			}
		}
		//mediante ajax eliminamos los seleccionados y refrescamos la pagina
		for (var x = 0; x < array_checkbox_seleccionados.length; x++) {
			//console.log('vuelta '+x)
			ajax_borrado(array_checkbox_seleccionados[x].value,"ayuda");
		}
		//location.reload();
	}
</script>
</html>