<?php 
	session_start();
	include __DIR__.'/includes/config.php';
	
	if (!isset($_SESSION['entra']) || $_SESSION['entra']!='xpto') {
		header("Location: index.php");
		exit();
	}

	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$myid = $_GET['id'];
		$apagar = $mysqli->query("DELETE FROM `categorias` WHERE `id_cat` = '$myid'");
		header("Location: categorias.php?apagado=sucesso");
		exit();
	}else{
		header("Location: categorias.php");
		exit();
	}


?>