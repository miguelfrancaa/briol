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
		<title>CATEGORIAS BACKEND - SITE</title>
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
			<h1>Gestao de Categorias</h1>
			<h6>Aqui pode gerir todos as Categorias</h6>

			<div class="accoes-gerais">
				<a href="nova-categoria.php">Nova Categoria</a>
			</div>

			<div class="mensagens">
				<?php 
					if (isset($_GET['apagado']) && $_GET['apagado'] == 'sucesso') { ?>
						<div class="alert alert-success">
							Categoria apagada com sucesso;
						</div>
				<?php }
				?>	
			</div>

			<table>
				<tr class="head-line">
					<th>ID</th>
					<th>IMG</th>
					<th>NOME</th>
					<th>DESC</th>
					<th>URL</th>
					<th>AÇÕES</th>
				</tr>

				<?php 

				$pesquisa = $mysqli->query("SELECT * FROM `categorias`ORDER BY `nome_cat` ASC"); 

				while($printUser = $pesquisa->fetch_object()){ ?>
					<tr>
						<td><?php echo $printUser->id_cat; ?></td>
						<td><?php 
							if ($printUser->img_cat!='') { ?>
								<img class="conterImg" src="../<?php echo $printUser->img_cat; ?>">
							<?php }
						?></td>
						<td><?php echo $printUser->nome_cat; ?></td>
						<td><?php echo $printUser->desc_cat; ?></td>
						<td><?php echo $printUser->url_cat; ?></td>
						<td>
							<a href="apagar-categoria.php?id=<?php echo $printUser->id_cat; ?>" class="apagar">ELIMINAR</a><br>
							<a href="editar-categoria.php?id=<?php echo $printUser->id_cat; ?>" class="editar">EDITAR</a>
						</td>
					</tr>
				<?php } ?>

			</table>



		</main>
		<!-- ACABA AQUI DE DECORRER AS ALTERAÇÕES ENTRE PAGINAS-->
		<?php include __DIR__.'/includes/footer-back.php'; ?>	
	</body>
</html>