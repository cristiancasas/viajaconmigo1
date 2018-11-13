<?php
	require 'conexion.php';
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
	
	$data = file_get_contents("php://input");
	$datadecode = json_decode($data, true);
	$idusuario = $datadecode['UserAdmin'];
	$nombre = $datadecode['nombre'];
	$apellido = $datadecode['apellido'];
	$documento = $datadecode['apellido'];
	$correo = $datadecode['apellido'];
	

	$sql = $conexion->prepare("UPDATE usuario SET nombre = ?, apellido = ?, documentoidentidad = ?, correo = ? WHERE idusuario = ?");
	$sql->bind_param('ssssi', $nombre, $apellido, $documento, $correo, $idusuario);
	$Sql->execute();

	echo json_encode("Datos actualizados correctamente");
?>	