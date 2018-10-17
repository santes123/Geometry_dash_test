<?php
	class Conection
	{
		private $host;
		private $user;
		private $password;
		private $bbdd;
		public $conexion;

		function __construct($host,$user,$password,$bbdd)
		{
			$this->host = $host;
			$this->user = $user;
			$this->password = $password;
			$this->bbdd = $bbdd;
			$this->conexion = new mysqli($host,$user,
				$password,$bbdd);

			if($this->conexion->errno){
				echo ("hubo un error al conectar con 
					la base de datos".$this->conexion->error);
				die();
			}
		}
		public function verificar_usuario($query,$parametro1){
			 $result = $this->conexion->query($query);
			 if($result->num_rows > 0){
			 	while ($row = $result->fetch_object()){
					if($row->pass == $parametro1){
						//session_start();
						//$_SESSION['usuario'] = $row->usuario;
						//una cookie por 1 hora al llegar a index con el valor de la peticion GET
						session_start();
						$_SESSION['usuario'] = $row->usuario;
						//echo "usuario -> ".$_SESSION['usuario'];
						//este header refresca la pagina y ademas te redirige a la pagina principal
						//header("Refresh:0; url=../../../index.php");
						//header("Location: ../../../index.php");
						return true;
						
					}else{
						header("Refresh:0; url=../../login/login.php?no_coinciden=true");
						//echo "el usuario o la contraseña no coinciden. <br>";
						//echo "<input type='button' value='volver' onclick='javascript:history.back();'> ";
					}
				}
			 }else{
			 	header("Refresh:0; url=../../login/login.php?no_existe=true");
				//echo "el usuario o la contraseña no existe.<br>";
				//echo "<input type='button' value='volver' onclick='javascript:history.back();'> ";
			 }
	}
	public function verificar_logro_primer_login($query,$idUsuario){
		$result = $this->conexion->query($query);
		if($result->num_rows <= 0){
			$fecha = date("Y/m/d");
			$query2 = "insert into logros_generales (nombre_logro,dia_conseguido,idUsuario) values ('primer login completado!','".$fecha."','".$idUsuario."');";
			$result2 = $this->conexion->query($query2);
			header("Refresh:0; url=../../../index.php?logro_completado=true");

		}else{
			header("Refresh:0; url=../../../index.php");
		}
	}
	public function consulta($query){
		$result = $this->conexion->query($query);
		if($this->conexion->errno){
			return false;
		}else{
			return $result;
		}
	}
	public function insert_usuario($query,$query2,$query3){
		// cambiar el conjunto de caracteres a utf8
		if ($this->conexion->connect_error) {
		    die("Connection failed: " . $this->conexion->connect_error);
		} 
		if (!mysqli_set_charset($this->conexion,"utf8")) {
		}else{
			echo "<br>";
		}
		$result1 = $this->conexion->query($query);
		$result2 = $this->conexion->query($query2);
		//extra para añadir silueta
		$result3 = $this->conexion->query($query3);
		if ($result1 === TRUE && $result2 === TRUE && $result3 === TRUE) {
		    //header("Location: ../../login/login.php");
		} else {
		    echo "Error: <br>" . $this->conexion->error;
		}
	}
	//verificamos si se ha completado el logro de registro
	public function verificar_logro_registro($query){
		// cambiar el conjunto de caracteres a utf8
		if ($this->conexion->connect_error) {
		    die("Connection failed: " . $this->conexion->connect_error);
		} 
		if (!mysqli_set_charset($this->conexion,"utf8")) {
		}else{
			echo "<br>";
		}
		$result1 = $this->conexion->query($query);
		if ($result1 === TRUE) {
		    header("Location: ../../login/login.php?logro_completado=true");
		} else {
		    echo "Error: <br>" . $this->conexion->error;
		}
	}
	public function insert_puntuacion($query,$query_verificar_logro_primera_partida){
		// cambiar el conjunto de caracteres a utf8
		if ($this->conexion->connect_error) {
		    die("Connection failed: " . $this->conexion->connect_error);
		} 
		if (!mysqli_set_charset($this->conexion,"utf8")) {
		}else{
			echo "<br>";
		}
		$result1 = $this->conexion->query($query);
		$result2 = $this->conexion->query($query_verificar_logro_primera_partida);
		if($result2->num_rows <= 0){
			header("Refresh:0; url=../index.php?logro_completado=true");
		}else if ($result1 === TRUE) {
		    //echo "Nueva puntuacion añadida correctamente!<br>";
		    //echo "<a href='../index.php'><input type='button' value='volver'></a> ";
		    header("Refresh:0; url=../index.php");
		} else {
		    echo "Error: <br>" . $this->conexion->error;
		}
	}
	public function update($query){
		// cambiar el conjunto de caracteres a utf8
			if ($this->conexion->connect_error) {
			    die("Connection failed: " . $this->conexion->connect_error);
			} 
			if (!mysqli_set_charset($this->conexion,"utf8")) {

			}else{
				echo "<br>";
			}
			if ($this->conexion->query($query) === TRUE) {
			    echo "registro actualizado!";
			    //$resultado = "registro actualizado!";
			    //return $resultado;
			} else {
			    echo "Error: <br>" . $this->conexion->error;
			    $resultado = "Error: <br>" . $this->conexion->error;
			    return $resultado;
			}
		}
		public function update_usuario($query,$query2){
		// cambiar el conjunto de caracteres a utf8
			if ($this->conexion->connect_error) {
			    die("Connection failed: " . $this->conexion->connect_error);
			} 
			if (!mysqli_set_charset($this->conexion,"utf8")) {

			}else{
				echo "<br>";
			}
			$result1 = $this->conexion->query($query);
			$result2 = $this->conexion->query($query2);
			if ($result1 === TRUE && $result2 === TRUE) {
			    echo "registro actualizado!";
			    //$resultado = "registro actualizado!";
			    //return $resultado;
			    return true;
			} else {
			    echo "Error: <br>" . $this->conexion->error;
			    //$resultado = "Error: <br>" . $this->conexion->error;
			    //return $resultado;
			    return false;
			}
		}
		public function insert_entrada($query,$seccion,$idDiscusion){
			// cambiar el conjunto de caracteres a utf8
			if ($this->conexion->connect_error) {
			    die("Connection failed: " . $this->conexion->connect_error);
			} 
			if (!mysqli_set_charset($this->conexion,"utf8")) {
			}else{
				echo "<br>";
			}
			$result1 = $this->conexion->query($query);
			if ($result1 === TRUE) {
			    header("Refresh:0; url=../paginas/discusiones/".$seccion.".php?id=".$idDiscusion);
			} else {
			    echo "Error: <br>" . $this->conexion->error;
			}
		}
		public function insert_comentario($query,$seccion,$idDiscusion){
			// cambiar el conjunto de caracteres a utf8
			if ($this->conexion->connect_error) {
			    die("Connection failed: " . $this->conexion->connect_error);
			} 
			if (!mysqli_set_charset($this->conexion,"utf8")) {
			}else{
				echo "<br>";
			}
			$result1 = $this->conexion->query($query);

			if ($result1 === TRUE) {
			    header("Refresh:0; url=../paginas/discusiones/".$seccion.".php?id=".$idDiscusion);
			} else {
			    echo "Error: <br>" . $this->conexion->error;
			}
		}
		public function delete_comentario($query,$seccion,$idDiscusion){
			// cambiar el conjunto de caracteres a utf8
			if ($this->conexion->connect_error) {
			    die("Connection failed: " . $this->conexion->connect_error);
			} 
			if (!mysqli_set_charset($this->conexion,"utf8")) {
			}else{
				echo "<br>";
			}
			$result1 = $this->conexion->query($query);

			if ($result1 === TRUE) {
			    header("Refresh:0; url=../paginas/discusiones/".$seccion.".php?id=".$idDiscusion);
			} else {
			    echo "Error: <br>" . $this->conexion->error;
			}
		}
		public function delete_entrada($query,$seccion,$idDiscusion){
			// cambiar el conjunto de caracteres a utf8
			if ($this->conexion->connect_error) {
			    die("Connection failed: " . $this->conexion->connect_error);
			} 
			if (!mysqli_set_charset($this->conexion,"utf8")) {
			}else{
				echo "<br>";
			}
			$result1 = $this->conexion->query($query);

			if ($result1 === TRUE) {
			   header("Refresh:0; url=../paginas/discusiones/".$seccion.".php?id=".$idDiscusion);
			} else {
			    echo "Error: <br>" . $this->conexion->error;
			}
		}
		public function update_entrada_comentario($query,$seccion,$idDiscusion){
		// cambiar el conjunto de caracteres a utf8
			if ($this->conexion->connect_error) {
			    die("Connection failed: " . $this->conexion->connect_error);
			} 
			if (!mysqli_set_charset($this->conexion,"utf8")) {

			}else{
				echo "<br>";
			}
			$result1 = $this->conexion->query($query);

			if ($result1 === TRUE) {
			    header("Refresh:0; url=../paginas/discusiones/".$seccion.".php?id=".$idDiscusion);
			} else {
			    echo "Error: <br>" . $this->conexion->error;
			}
		}
		//SERVICIOS EXTERNOS (WEB SERVICE)
		
}
?>