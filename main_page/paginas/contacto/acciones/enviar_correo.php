<?php
	if(isset($_POST['cuerpo'])){
		$Remitente = $_POST['email']; 
		$asunto = $_POST['asunto'];
		$cuerpo =  $_POST['cuerpo'];
		//dirección del remitente 
		$headers = 'To: '."soporteminijuegos@gmail.com". "\r\n";
		$headers .= "From: ".$_POST['nombre']." <".$Remitente.">\r\n";  
		//ruta del mensaje desde origen a destino 
		$headers .= "Return-path: soporteminijuegos@gmail.com\r\n";

		mail("soporteminijuegos@gmail.com",$asunto,$cuerpo,$headers);
	}
?>
<script type="text/javascript">
	//cuenta atras
	var cuentaAtras = setInterval(function(){
			var contador = document.getElementById("cuenta_atras");
			var añadir = document.getElementById("añadir");
			var nuevo_valor = Number.parseInt(contador.value) - 1;
			contador.value = nuevo_valor;
			añadir.innerHTML = contador.value+" segundos";
			if(contador.value == "0"){
				clearInterval(cuentaAtras);
				setTimeout(function(){
					// funciona como una redirección HTTP
					window.location.replace("../../../index.php");

					// funciona como si dieras clic en un enlace
					//window.location.href = "http://sitioweb.com";
				}, 1000);
			}
		}, 1000);
</script>
<!DOCTYPE html>
<html>
<head>
	<title>Redireccion..</title>
	<style type="text/css">
		body{
			background-color: #e9eae3;
		}
	</style>
</head>
<body>
	<section>
		<input type="hidden" id="cuenta_atras" name="" value="4">
		<img src="../../../img/cargando.gif" alt="Loading Gif" style="width: 100%; height: 500px;">
		<center>
			<p style="font-size: 20pt; color: black;">Correo enviado correctamente, redireccionando a la pagina principal en <span id="añadir"> 4 segundos</span></p>
		</center>
	</section>
</body>
</html>