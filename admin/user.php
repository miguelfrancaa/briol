<?php
	session_start();
	include __DIR__.'/includes/config.php';
	$sms = '';
	
	if (!isset($_SESSION['entra']) || $_SESSION['entra']!='xpto') {
		header("Location: index.php");
		exit();
	}


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>USERS BACKEND - SITE</title>
		<meta name="description" content="BACKEND - SITE">
		<meta name="keywords" content="BACKEND - SITE">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!--[if lt IE 9]>
			<script src="js/html5shiv.min.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="admin-crm inicio-page">
		<?php include __DIR__.'/includes/menu.php'; ?>
		<?php include __DIR__.'/includes/header-back.php'; ?>
		<!-- DECORRER AS ALTERAÇÕES ENTRE PAGINAS-->
		<main class="pagina-geral"> 
			<h1>Gestao de Utilizadores</h1>
			<h6>Aqui pode gerir todos os users</h6>

			<div class="accoes-gerais">
				<a href="novo-user.php">Novo Utilizador</a>
			</div>

			<div class="mensagens">
				<?php 
					if (isset($_GET['apagado']) && $_GET['apagado'] == 'sucesso') { ?>
						<div class="alert alert-success">
							Utilizador apagado com sucesso;
						</div>
				<?php }
				?>	
			</div>

			<table>
				<tr class="head-line">
					<th>ID</th>
					<th>FOTO</th>
					<th>NOME</th>
					<th>EMAIL</th>
					<th>TELEFONE</th>
					<th>DATA. Log</th>
					<th>AÇÕES</th>
				</tr>

				<?php 

				$pesquisa = $mysqli->query("SELECT * FROM `administradores`ORDER BY `id_admin` DESC"); 

				while($printUser = $pesquisa->fetch_object()){ ?>
					<tr>
						<td><?php echo $printUser->id_admin; ?></td>
						<td><?php 
							if ($printUser->foto_admin!='') { ?>
								<img class="conterImg" src="../<?php echo $printUser->foto_admin; ?>">
							<?php }
						?></td>
						<td><?php echo $printUser->nome_admin.' '.$printUser->apelido_admin; ?></td>
						<td><?php echo $printUser->email_admin; ?></td>
						<td><?php echo $printUser->tel_admin; ?></td>
						<td><?php echo $printUser->data_log; ?></td>
						<td>
							<?php if ($_SESSION['id'] != $printUser->id_admin) { ?>
								<a href="apagar-user.php?id=<?php echo $printUser->id_admin; ?>" class="apagar">ELIMINAR</a><br>
							<?php } ?>
							<a href="editar-user.php?id=<?php echo $printUser->id_admin; ?>" class="editar">EDITAR</a>
						</td>
					</tr>
				<?php } ?>

			</table>



		</main>
		<!-- ACABA AQUI DE DECORRER AS ALTERAÇÕES ENTRE PAGINAS-->
		<?php include __DIR__.'/includes/footer-back.php'; ?>	
	</body>
</html>