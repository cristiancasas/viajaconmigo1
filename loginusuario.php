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
	$user = $datadecode['valuesBase64'];
	$pass = $datadecode['access'];
	$sql = $conexion->prepare("SELECT * FROM usuario WHERE usuario = ? AND contrasena = ?");
	$sql->bind_param('ss', $user, $pass);
	$sql->execute();
	$result = $sql->get_result();
	$fetch=$result->fetch_assoc();
	$rows = $result->num_rows;
	if($rows > 0){
		echo json_encode($fetch);
	}else{
		echo json_encode($fetch);
	}	
?>