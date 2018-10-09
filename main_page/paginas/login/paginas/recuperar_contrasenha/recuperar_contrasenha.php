<?php
	include_once '../../../../admin/conection/conection.php';

	$query = "select email from datos_usuario order by email desc;";
	$conexion = new Conection('localhost',"root","","geometryDash");
	$result = $conexion->consulta($query);
	$arrayCorreos = [];
	while ($row = $result->fetch_object()){
		array_push($arrayCorreos, $row);
	}
	//var_dump($arrayCorreos);
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
	<title> Recuperar contraseña </title>
	
	<!--archivos css necesarios -->
	<link rel="stylesheet" type="text/css" href="../../css/recuperar_contrasenha.css">
</head>
<body>
	<header>

	</header>
	<nav id="nav">
		<ul id="nav_ul" class="nav">
			<li class="li_ul"><a href="../../../../index.php" style='width: 100%; margin-left:0px;'>Index</a></li>
			<!-- Mandamos primero al login si no estas logueado-->
			<?php
				session_start();
				if($_SESSION){
					echo "<li class=\"li_ul\"><a href=\"../../../Geometry_dash/index.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"../../login.php\" style='width: 100%; margin-left:0px;'>Geometry Dash</a></li>";
				}
			?>
			<?php
				
				if($_SESSION){
					echo "<li class=\"li_ul\"><a href=\"../../../Arkanoid/index.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"../../login.php\" style='width: 100%; margin-left:0px;'>Arkanoid</a></li>";
				}
			?>
			<li class="li_ul"><a href="#" style='width: 100%; margin-left:0px;'>Opciones</a>
				<ul id="sublista">
					<?php
						if($_SESSION){
							echo "<li class=\"sub_li\"><a href=\"\" style='width: 100%; margin-left:0px;'></a></li>";
							echo "<li class=\"sub_li\"><a href=\"\" style='width: 100%; margin-left:0px;'></a></li>";
						}else{
							echo "<li class=\"sub_li\"><a href=\"../../login.php\" style='width: 100%; margin-left:0px;'>Logueate</a></li>";
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
				
				if($_SESSION){
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>Hi <u><b>".$_SESSION['usuario']."</b></u>!"."</a>";
					echo "<ul id=\"sublista2\">";
					echo "<li class=\"sub_li\"><a href=\"paginas/Perfil/editar_perfil/editar_perfil.php\" style='width: 100%; margin-left:0px;'>Editar Perfil</a></li>";
					echo "<li class=\"sub_li\"><a href=\"\" style='width: 100%; margin-left:0px;' onclick=\"".session_destroy()."location.reload()\">Logout</li>";
					echo "</ul>";
					echo "</li>";
				}else{
					echo "<li class=\"li_ul\"><a href=\"\" style='width: 100%; margin-left:0px;'>No logueado</a></li>";
				}
			?>
		</ul>
	</nav>
	<section>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div id="div_aviso" style="border: 2px solid black; border-radius: 20px; height: 50px; width: 250px; margin-left: 250px; 
			padding: 5px; background-color: lightgreen; margin-top: 10px; display: none;">
				Se ha enviado un correo con para reiniciar su contraseña a su email.
			</div>
			<fieldset>

			<legend id="formulario"> Recuperar contraseña </legend>
			<div class="tooltip">
				<label>Email : </label><input id="email" type="email" name="email" maxlength="100" value="" style="width: 200px;" onblur="revisarCorreo(this.value)" required="required">
				<span id="tooltiptext" style="color: red;">Este correo NO existe!</span>
				<br><br>
			</div>
			<div>
				<label>Usuario : </label><input id="usuario" type="text" name="usuario" maxlength="50" style="width: 200px;" required="required"><br><br>
			</div>
			<br>
			<input type="submit" value="Enviar" style="width: 120px; height: 30px; font-size: 14pt;" />
			</fieldset>
		</form>
	</section>
</body>
<!-- archivos js necesarios-->
<script type="text/javascript">
	function revisarCorreo (correoEscrito) {
		var texto_flotante = document.getElementById("tooltiptext");
		texto_flotante.style.visibility = 'hidden';
		texto_flotante.style.opacity = '0'
		<?php 
		for($i = 0;$i < count($arrayCorreos);$i++){
			$correoActual = $arrayCorreos[$i];
		?>
		if(correoEscrito=="<?php echo $correoActual->email; ?>"){
			texto_flotante.style.visibility = "hidden";
			texto_flotante.style.opacity = "0";
			document.getElementById("usuario").focus();
			return true;
			//break;
		}else{
			document.getElementById("email").focus();
			texto_flotante.style.visibility = "visible";
			texto_flotante.style.opacity = "1";
		}
		<?php 
			} 
		?>

	}
</script>
</html>
<?php
	//recuperamos los datos y enviamos el email con los datos al correo del cliente y mostramos el div de "enviado"
	
	if(isset($_POST['email']) && isset($_POST['usuario'])){
		$query = "select contrasenha from datos_usuario where email='".$_POST['email']."' order by email desc;";
		$conexion = new Conection('localhost',"root","","geometryDash");
		$result = $conexion->consulta($query);
		$array_usuarios = [];
		while ($row = $result->fetch_object()){
			array_push($array_usuarios, $row);
		}
		//var_dump($array_usuarios);
		echo "<script type=\"text/javascript\">";
		echo "document.getElementById(\"div_aviso\").style.display = 'block'; ";
		echo "</script>";

		//escribimos el correo
		//var_dump($_POST);
		$destinatario = $_POST['email']; 
		$asunto = "Non-reply -> Contraseña del usuario";
		$cuerpo = '
		<html> 
			<head> 
			   <title>Correo con datos del usuario</title> 
			</head> 
			<body> 
			<h1>Buenas amigo:</h1> 
			<p> 
			Al usuario con correo <b>'.$_POST['email'].'</b> y usuario <b><u>'.$_POST['usuario'].'</u></b> adjunto le enviamos un enlace para cambiar su contraseña.
			</p> 
			<p>
			Puede cambiar su contraseña <a href="http://proyect.local/paginas/login/paginas/cambiar_contrasenha/cambiar_contrasenha.php?usuario='.$_POST['usuario'].'">Aquí</a>.
			</p>
			</body> 
		</html> 
		';
		/*
		// Para enviar un correo HTML, debe establecerse la cabecera Content-type
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Cabeceras adicionales
		$cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
		$cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
		$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
		$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";
		*/
		//para el envío en formato HTML 
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		//dirección del remitente 
		$headers .= 'To: '.$_POST['email']. "\r\n";
		$headers .= "From: Soporte técnico Minijuegos <soporteminijuegos@gmail.com>\r\n";  
		//dirección de respuesta, si queremos que sea distinta que la del remitente 
		$headers .= "Reply-To: soporteminijuegos@gmail.com\r\n"; 
		//ruta del mensaje desde origen a destino 
		$headers .= "Return-path: soporteminijuegos@gmail.com\r\n";
		//direcciones que recibián copia 
		$headers .= "Cc: soporteminijuegos@gmail.com\r\n";

		mail($destinatario,$asunto,$cuerpo,$headers);
		
	}
?>