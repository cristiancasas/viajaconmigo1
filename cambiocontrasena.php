<?php
	$user = $_REQUEST['user'];
	$documento = $_REQUEST['documento'];
	$contrasenaanterior = $_REQUEST['contrasenaanterior'];
	$contrasenanueva = md5($_REQUEST['contrasenanueva']);

	$conexion = new mysqli("localhost","root","","viajaconmigo");
	$conexion->set_charset("utf8");
	
	$sql = $conexion->prepare("SELECT * FROM usuario WHERE usuario = ? AND contrasena = ? AND documento = ?");
	$sql->bind_param('sss', $user, $contrasenaanterior, $documento);
	$sql->execute();
	$result = $sql->get_result();
	$rows = $result->num_rows;
	$fetch = $result->fetch_assoc();
	if($rows > 0){
		$sql = $conexion->prepare("update usuario set contrasena = ?");
		$sql->bind_param('s', $contrasenanueva);
	}else{
		echo json_encode("Datos incorrectos");
	}
?>