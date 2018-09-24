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
						session_start();
						$_SESSION['usuario'] = $row->usuario;
						header("Location: ../../Geometry_dash/index.php");
					}else{
						echo "el usuario o la contraseña no coinciden. <br>";
						echo "<input type='button' value='volver' onclick='javascript:history.back();'> ";
					}
				}
			 }else{
			 	echo "el usuario o la contraseña no existe.<br>";
			 	echo "<input type='button' value='volver' onclick='javascript:history.back();'> ";
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
	public function insert_usuario($query,$query2){
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
		    header("Location: ../../login/login.php");
		} else {
		    echo "Error: <br>" . $this->conexion->error;
		}
	}
	public function insert_puntuacion($query){
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
		    echo "Nueva puntuacion añadida correctamente!<br>";
		    echo "<a href='../index.php'><input type='button' value='volver'></a> ";
		} else {
		    echo "Error: <br>" . $this->conexion->error;
		}
	}

}
	

?>