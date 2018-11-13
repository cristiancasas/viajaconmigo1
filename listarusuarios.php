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

	$idgrupo = $_REQUEST['idgrupo'];

	$sql = $conexion->prepare("SELECT us.*, e.nombre as nombreestado FROM grupo g, usuarioporgrupo u, estado e, usuario us WHERE g.idgrupo = u.idgrupo AND us.idusuario = u.idusuario and g.idgrupo = $idgrupo AND e.idestado = u.idestado AND  u.tipo = 2 AND us.idestado = 1 GROUP BY us.idusuario");
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
