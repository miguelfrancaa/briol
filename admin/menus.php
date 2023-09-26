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
		<title>Menus BACKEND - SITE</title>
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
			<h1>Gestao de Menus</h1>
			<h6>Aqui pode gerir todos os menus</h6>

			<div class="accoes-gerais">
				<a href="novo-menu.php">Novo Menu</a>
			</div>

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
					<th>URL</th>
					<th>TARGET</th>
					<th>AÇÕES</th>
				</tr>

				<?php 

				$pesquisa = $mysqli->query("SELECT * FROM `menus` WHERE `parent_id` = '0' ORDER BY `posicao_menu` ASC"); 

				while($printMenu = $pesquisa->fetch_object()){ ?>
					<tr>
						<td><?php echo $printMenu->id_menu; ?></td>
						<td>
							<?php if ($printMenu->icon!='') { ?>
								<i class="fa <?php echo $printMenu->icon; ?>" style="color: <?php echo $printMenu->cor_icon; ?>"></i>
							<?php } ?>
							<?php echo $printMenu->nome_menu; ?></td>
						<td><?php echo $printMenu->url_menu; ?></td>
						<td><?php echo $printMenu->target_menu; ?></td>
						<td>
							<a href="apagar-menu.php?id=<?php echo $printMenu->id_menu; ?>" class="apagar">ELIMINAR</a><br>
							<a href="editar-menu.php?id=<?php echo $printMenu->id_menu; ?>" class="editar">EDITAR</a>
						</td>
					</tr>
					<?php 
					$idAnterior = $printMenu->id_menu;
					$pesquisa2 = $mysqli->query("SELECT * FROM `menus` WHERE `parent_id` = '$idAnterior' ORDER BY `posicao_menu` ASC"); 

					while($printMenu2 = $pesquisa2->fetch_object()){ ?>
						<tr style="background: orange;">
							<td><?php echo $printMenu2->id_menu; ?></td>
							<td>
								<?php if ($printMenu2->icon!='') { ?>
									<i class="fa <?php echo $printMenu2->icon; ?>" style="color: <?php echo $printMenu2->cor_icon; ?>"></i>
								<?php } ?>
								<?php echo $printMenu2->nome_menu; ?></td>
							<td><?php echo $printMenu2->url_menu; ?></td>
							<td><?php echo $printMenu2->target_menu; ?></td>
							<td>
								<a href="apagar-menu.php?id=<?php echo $printMenu2->id_menu; ?>" class="apagar">ELEMINAR</a><br>
								<a href="editar-menu.php?id=<?php echo $printMenu2->id_menu; ?>" class="editar">EDITAR</a>
							</td>
						</tr>

					<?php } ?>


				<?php } ?>

			</table>



		</main>
		<!-- ACABA AQUI DE DECORRER AS ALTERAÇÕES ENTRE PAGINAS-->
		<?php include __DIR__.'/includes/footer-back.php'; ?>	
	</body>
</html>