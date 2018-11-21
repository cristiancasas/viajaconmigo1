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

	$idusuario = $datadecode['idusuario'];
	$idgrupo = $datadecode['idgrupo'];

	$sql1 = "select * from preconfirmacion where idusuario = ? and idgrupo = ?";
	$sql1->bind_param('ii', $idusuario, $idgrupo);
	$sql1->execute();
	$result = $sql->get_result();
	$row = $result->num_rows;

	if($row == 0){
		$sql2 = $conexion->prepare("INSERT INTO preconfirmacion(idusuario, idgrupo, tipo) values(?, ?, 2)");
		$sql2->bind_param('ii', $idusuario, $idgrupo);
		$sql2->execute();
		echo json_encode("Se ha realizado la solicitud");
	}else{
		echo json_encode("Ya haz realizado una solicitud de ingreso a este grupo");
	}
?>
