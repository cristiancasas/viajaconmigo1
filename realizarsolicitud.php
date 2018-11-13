<?php 
	if (isset($_SERVER['HTTP_ORIGIN'])) {  
	    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");  
	    header('Access-Control-Allow-Credentials: true');  
	    header('Access-Control-Max-Age: 86400');   
	}  
	  
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {  
	  
	    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))  
	        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  
	  
	    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))  
	        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");  
	}

	$conexion = new mysqli("localhost","root","","viajaconmigo");
	$conexion->set_charset("utf8");

	$data = file_get_contents("php://input");
	$datadecode = json_decode($data, true);

	$idusuario = $datadecode['idusuario'];
	$idgrupo = $datadecode['idgrupo'];

	$sql = $conexion->prepare("INSERT INTO preconfirmacion(idusuario, idgrupo, tipo) values(?, ?, 2)");
	$sql->bind_param('ii', $idusuario, $idgrupo);
	$sql->execute();

	echo json_encode("Se ha realizado la solicitud");
?>
