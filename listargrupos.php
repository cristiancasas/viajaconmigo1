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
	
	header("Content-type:application/json");

	$data = file_get_contents("php://input");
	$datadecode = json_decode($data, true);

	//$idusuario = $datadecode['idusuario'];
	$idusuario = $_REQUEST['idusuario'];
	
	$sql = $conexion->prepare("SELECT g.* FROM grupo g, usuarioporgrupo u, usuario us WHERE g.idgrupo = u.idgrupo AND us.idusuario = u.idusuario AND us.idusuario = ? and u.tipo = 1 and g.idestado = 1 GROUP BY g.idgrupo");
	$sql->bind_param('i', $idusuario);
	$sql->execute();
	$result = $sql->get_result();
	$rows = $result->num_rows;
	if($rows > 1){
		$fetch = array();
		while($r = mysqli_fetch_assoc($result)){
			$fetch[] = $r;
		}
		echo json_encode($fetch);
	}else if($rows == 1){
		$fetch = $result->fetch_assoc();
		echo json_encode($fetch);
	}else{
		echo json_encode(false);
	}
?>
