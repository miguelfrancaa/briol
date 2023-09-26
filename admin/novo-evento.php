<?php
	session_start();
	include __DIR__.'/includes/config.php';
	$sms = '';
	
	if (!isset($_SESSION['entra']) || $_SESSION['entra']!='xpto') {
		header("Location: index.php");
		exit();
	}

	if (isset($_POST["enviar"])) {
		if (!empty($_POST["artista-evento"]) && !empty($_POST["nome-evento"])) {
				
			

			$artista_evento  = $_POST["artista-evento"]; 
			$data_evento  = $_POST["data-evento"]; 
			$local_evento  = $_POST["local-evento"]; 
			$nome_evento  = $_POST["nome-evento"]; 
			$detalhes_evento  = $_POST["detalhes-evento"]; 

			$inserir = $mysqli->query("INSERT INTO `eventos` (
					`id_eventos`,
					`artista_evento`,
					`data_evento`,
					`local_evento`,
					`nome_evento`,
					`detalhes_evento`
				) VALUES (
					default,
					'$artista_evento',
					'$data_evento',
					'$local_evento',
					'$nome_evento',
					'$detalhes_evento'
				)");


			$sms = '<div class="alert alert-success">Item inserido com sucesso!</div>';

				
		}else{
			$sms = '<div class="alert alert-danger">Preenchas os campos obrigatórios!</div>';
		}
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>NOVO Evento BACKEND - SITE</title>
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
			<h1>Novo Evento</h1>
			<h6>Aqui pode gerir adicionar evento</h6>

			<div class="mensagens">
				<?php 
					echo $sms; 
				?>	
			</div>

			<form action="" method="POST">
				<div class="row">
					<div class="col-md-6 col-xs-12">
						<div class="campos">
							<div class="form-controls">
								<label>
									Artista:<br>
									<input type="text" name="artista-evento">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Data:<br>
									<input type="text" name="data-evento">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Local:<br>
									<input type="text" name="local-evento">
								</label>
							</div>

							
						</div>
					</div>

					<div class="col-md-6 col-xs-12">
						<div class="campos">


							
							<div class="form-controls">
								<label>
									Nome:<br>
									<input type="text" name="nome-evento">
								</label>
							</div>


							<div class="form-controls">
								<label>
									Detalhe:<br>
									<input type="text" name="detalhes-evento">
								</label>
							</div>

						</div>
					</div>

					<div class="col-md-12 col-xs-12">
						<div class="campos campos2">
							<button class="accao" type="submit" name="enviar">INSERIR</button>
						</div>
					</div>

				</div>
			</form>

		</main>
		<!-- ACABA AQUI DE DECORRER AS ALTERAÇÕES ENTRE PAGINAS-->
		<?php include __DIR__.'/includes/footer-back.php'; ?>	
	</body>
</html>