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

	$confirmacion = $datadecode['confirmacion'];
	$idpreconfirmacion = $datadecode['idpreconfirmacion'];
	$idusuario = $datadecode['idusuario'];
	$idgrupo = $datadecode['idgrupo'];

	/*$sqlcorreo = $conexion->prepare("SELECT correo, telefono FROM usuario WHERE idusuario = ?");
	$sqlcorreo->bind_param('i', $idusuario);
	$sqlcorreo->execute();
	$result = $sql->get_result();
	$fetch = $result->fetch_assoc();
	$correo = $fetch['correo'];
	$telefono = $fetch['telefono'];*/

	if($confirmacion == "ok"){
		$sql = $conexion->prepare("INSERT INTO usuarioporgrupo(idusuario, idgrupo) values(?, ?, 2)");
		$sql->bind_param('ii', $idusuario, $idgrupo);
		$sql->execute();
	}else{
		$sql = $conexion->prepare("DELETE FROM preconfirmacion WHERE idpreconfirmacion = ?");
		$sql->bind_param('i', $idpreconfirmacion);
		$sql->execute();
	}

	//envió notificación via correo y via telefono*/
?>
