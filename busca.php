<?php
	require "conn.php";
	$conn = new conn();
	
	$cpf = filter_input(INPUT_GET, 'term', FILTER_SANITIZE_STRING);
	
	$sql = "SELECT cpf FROM cliente WHERE cpf LIKE '".$cpf."%' AND ativo = 1";
	$exec = $conn->getConn()->prepare($sql);
	$exec->execute();
	
	while($linha = $exec->fetch(PDO::FETCH_ASSOC)){
		$data[] = $linha['cpf'];
	}
	echo json_encode($data);
?>