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
	$data = file_get_contents("php://input");
	$datadecode = json_decode($data, true);
	$correo = $datadecode['email'];
	$nombre = $datadecode['name'];
	$datospassword = $datadecode['passwordRetry'];
	$contrasena = $datospassword['password'];
	$documento = $datadecode['document'];
	$telefono = $datadecode['phone'];
	$apellido = $datadecode['surnames'];
	$user = $datadecode['username'];
	$conexion = new mysqli("localhost","root","","viajaconmigo");
	$conexion->set_charset("utf8");
	
	$sql1 = $conexion->prepare("SELECT usuario, documentoidentidad FROM usuario WHERE usuario = ? AND documentoidentidad <> ?");
	$sql1->bind_param('ss', $user, $documento);
	$sql1->execute();
	$result1 = $sql1->get_result();
	$row1 = $result1->num_rows;
	$sql2 = $conexion->prepare("SELECT usuario, documentoidentidad FROM usuario WHERE usuario = ? AND documentoidentidad = ?");
	$sql2->bind_param('ss', $user, $documento);
	$sql2->execute();
	$result2 = $sql2->get_result();
	$row2= $result2->num_rows;
	$sql3 = $conexion->prepare("SELECT usuario, documentoidentidad FROM usuario WHERE usuario <> ? AND documentoidentidad = ?");
	$sql3->bind_param('ss', $user, $documento);
	$sql3->execute();
	$result3 = $sql3->get_result();
	$row3 = $result3->num_rows;
	if($row1 > 0){
		echo json_encode("El usuario ya existe");
	}else if($row2 > 0){
		echo json_encode("El usuario y el documento de identidad ya existen");
	}else if($row3 > 0){
		echo json_encode("El documento de identidad ya existe");
	}else{
		$sql4 = $conexion->prepare("INSERT INTO usuario (idtipousuario, idestado, otpkey, nombre, apellido, documentoidentidad, telefono, correo, usuario, contrasena) VALUES (2, 1, 0, ?, ?, ?, ?, ?, ?, ?)");
		$sql4->bind_param('sssssss', $nombre, $apellido, $documento, $telefono, $correo, $user, $contrasena);
		$sql4->execute();
		echo json_encode("Datos guardados correctamente");
	}
?>