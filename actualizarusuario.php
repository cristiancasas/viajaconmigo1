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
	
    $correo = $_REQUEST['email'];
    $datospassword = $_REQUEST['passwordRetry'];
    $contrasena = $datospassword['password'];
    $telefono = $_REQUEST['userphone'];
    $apellido = $_REQUEST['lastname'];
    $user = $_REQUEST['nameuser'];
    $idusuario = $_REQUEST['iduser'];
    $sql = $conexion->prepare("update usuario set nombre = ?, apellido = ?, telefono = ?, correo = ?, usuario = ?, contrasena = ? where idusuario = ?");
    $sql->bind_param('ssssssi', $nombre, $apellido, $telefono, $correo, $user, $contrasena, $idusuario);
    $sql->execute();
	echo json_encode("Datos actualizados correctamente");
?>	