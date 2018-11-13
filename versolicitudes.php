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

	$idgrupo = $datadecode['idgrupo'];

	$sql = $conexion->prepare("SELECT u.nombre as nombreu, g.nombre as nombreg FROM usuario u, grupo g, preconfirmacion p WHERE p.idgrupo = ?");
	$sql->bind_param('i', $idgrupo);
	$sql->execute();
	$result = $sql->result();

	while($fetch = $result->fetch_assoc()){
		echo json_encode($fetch);
	}
?>
