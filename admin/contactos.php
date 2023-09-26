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
		<title>Contactos BACKEND - SITE</title>
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
			<h1>Gestao de Leads</h1>
			<h6>Aqui pode gerir todas leads de contacto do site</h6>

			<!--<div class="accoes-gerais">
				<a href="novo-menu.php">Novo Menu</a>
			</div>-->

			<div class="mensagens">
				<?php 
					if (isset($_GET['apagado']) && $_GET['apagado'] == 'sucesso') { ?>
						<div class="alert alert-success">
							Item apagado com sucesso;
						</div>
				<?php }
				?>	
			</div>

			<table>
				<tr class="head-line">
					<th>ID</th>
					<th>NOME</th>
					<th>EMAIL</th>
					<th>MENSAGEM</th>
					<th>ACÇÕES</th>
				</tr>

				<?php 

				$pesquisa = $mysqli->query("SELECT * FROM `contactos` ORDER BY `id_contacto` DESC"); 

				while($printMenu = $pesquisa->fetch_object()){ ?>
					<tr>
						<td><?php echo $printMenu->id_contacto; ?></td>
						<td><?php echo $printMenu->nome; ?></td>
						<td><?php echo $printMenu->email; ?></td>
						<td>
							<?php echo $printMenu->mensagem; ?>
						</td>
						<td>
							<a href="apagar-contacto.php?id=<?php echo $printMenu->id_contacto; ?>" class="apagar">ELIMINAR</a><br>
						</td>
					</tr>
				<?php } ?>

			</table>



		</main>
		<!-- ACABA AQUI DE DECORRER AS ALTERAÇÕES ENTRE PAGINAS-->
		<?php include __DIR__.'/includes/footer-back.php'; ?>	
	</body>
</html>