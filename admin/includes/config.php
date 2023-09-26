<?php
	
	$mysqli_host = 'localhost';
	$mysqli_database = 'briol';
	$mysqli_user = 'root';
	$mysqli_pass = '';

	$mysqli = new mysqli($mysqli_host,$mysqli_user,$mysqli_pass,$mysqli_database);

	if ($mysqli->connect_errno == true) {
		echo '<p>Houve um erro na linha '.$mysqli->connect_errno.'</p>';
		exit();
	}else{
		//echo '<p>Ligação feita com sucesso</p>';
	}	

	/*$nome_admin = 'Hugo';
	$apelido_admin = 'Vaz';
	$email_admin = 'hugo@hugo.com';
	$pass_admin = 'hugo';
	$tel_admin = '910000000';
	$foto_admin = '';
	$data_registo = date("Y-m-d H:i:s");
	$data_log = '';

	$inserir = $mysqli->query("INSERT INTO `administradores` (
		`id_admin`, 
		`nome_admin`, 
		`apelido_admin`, 
		`email_admin`, 
		`pass_admin`, 
		`tel_admin`, 
		`foto_admin`, 
		`data_registo`, 
		`data_log`
	) VALUES (
		default,
		'$nome_admin',
		'$apelido_admin',
		'$email_admin',
		md5('$pass_admin'),
		'$tel_admin',
		'$foto_admin',
		'$data_registo',
		'$data_log'
	)");*/

?>