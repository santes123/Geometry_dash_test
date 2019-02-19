<?php
//objeto soap server que recibe los datos y responde, abriendo la conexion
$server = new SoapServer(null,
					//no utilizazr WSDL
					array('uri' => 
					"urn:webservices" ) //se debe especificar el URI
);
//creamos una funcion dentro del servidor que podra ser usada desde el soapClient
/*
function devuelveValor($id){
	
	include_once("../admin/conection/conexion.php");
	$conexion = new conection("localhost","santes123","1234","jardineria");
	$query = "select * from clientes where codigoCliente = '".$id."';";
	$result = $conexion->consulta($query);
	$array = [];
	while ($cliente = $result->fetch_object()) {
		array_push($array, $cliente);
	}
	return $array;
	

}
*/
function devolverPuntuaciones($query){
	include_once '../admin/conection/conection.php';

	$db = "geometryDash";
	//$query = "select puntuacion,nivel,u.usuario as usuario from puntuaciones as p join usuario as u on(p.user_id=u.idUsuario) order by puntuacion desc limit 10;";
	//$array_campos = array("usuario","contrasenha");
	$conexion = new Conection('localhost',"root","",$db);
	$result = $conexion->consulta($query);
	$array = [];
	while ($row = $result->fetch_object()){
		array_push($array,$row);
	}
	return $array;
}
function revolver_cabeceras_puntuaciones($query){
	include_once '../admin/conection/conection.php';
	$conexion  = new mysqli('localhost',"root","",$db);
	$resultCabecera = mysqli_query($conexion,$query);

	$line = mysqli_fetch_array($resultCabecera, MYSQLI_ASSOC);
	$array_cabeceras = [];
	foreach ($line as $col_name=>$col_value) {
		array_push($array_cabeceras, $col_name);
        //echo "<th style='width: 120px; border: 1px solid black;'>$col_name</th>";
   	}
   	return $array_cabeceras;
}
//añadimos la funcion al servidor
//$server->addFunction("devuelveValor");
$server->addFunction("devolverPuntuaciones");
$server->addFunction("revolver_cabeceras_puntuaciones");
//aplicamos los cambios para poder llamarla sin que nos de error
$server->handle();
?>