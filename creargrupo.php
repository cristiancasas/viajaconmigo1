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
	$descripcion = $datadecode['descripcion'];
	$sql1 = $conexion->prepare("INSERT INTO grupo (idestado, nombre, descripcion) values(1, ?, ?)");
	$sql1->bind_param('ss', $nombre, $descripcion);
	$sql1->execute();
	$idgrupo = mysqli_insert_id($conexion);
	$sql2 = $conexion->prepare("INSERT INTO usuarioporgrupo (idusuario, idgrupo, idestado, tipo) VALUES (?, ?, 1, 1)");
	$sql2->bind_param('ii', $idusuario, $idgrupo);
	$sql2->execute();
	$sql3 = $conexion->prepare("UPDATE usuario SET idtipousuario = 1 WHERE idusuario = ?");
	$sql3->bind_param('i', $idusuario);
	$sql3->execute();
	echo json_encode("Guardado exitoso");
?>	