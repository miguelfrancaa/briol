<?php
	session_start();
	include __DIR__.'/includes/config.php';
	$sms = '';
	
	if (!isset($_SESSION['entra']) || $_SESSION['entra']!='xpto') {
		header("Location: index.php");
		exit();
	}

	if (isset($_POST["enviar"])) {
		if (!empty($_POST["nome-cat"]) && !empty($_POST["url-cat"]) && !empty($_FILES['img-cat']['name'])) {
			
			
					/***** TRATAMENTO IMAGENS ****/

					$caminho = '../img/categorias/';
					$caminhoFront = "img/categorias/";
					$erroImg = '';

					$caminhoComFicheiro = $caminho.basename($_FILES['img-cat']["name"]);
					$ext = strtolower(pathinfo($caminhoComFicheiro, PATHINFO_EXTENSION));

					if (file_exists($caminhoComFicheiro)) {
						$erroImg = 'Já existe no sistema!, Pf mude o nome!';
					}

					if ($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg') {
						$erroImg = 'Não aceitamos a extensão '.$ext;
					}

					if ($_FILES['img-cat']["size"] > 5000000) {
						$erroImg = 'Carregue uma imagem até 5MB';
					}

					if ($erroImg=='') {
						move_uploaded_file($_FILES['img-cat']["tmp_name"], $caminhoComFicheiro);

						$img_cat = $caminhoFront.$_FILES['img-cat']["name"];
						$nome_cat  = $_POST["nome-cat"]; 
						$desc_cat  = $_POST["desc-cat"]; 
						$url_cat  = $_POST["url-cat"]; 

						$data_registo  = date('Y-m-d H:i:s'); 

						$inserir = $mysqli->query("INSERT INTO `categorias` (
								`id_cat`,
								`nome_cat`,
								`desc_cat`,
								`url_cat`,
								`img_cat`
							) VALUES (
								default,
								'$nome_cat',
								'$desc_cat',
								'$url_cat',
								'$img_cat'
							)");


						$sms = '<div class="alert alert-success">Categoria inserida com sucesso!</div>';
					}else{
						$sms = '<div class="alert alert-danger">'.$erroImg.'</div>';
					}


					/***** TRATAMENTO IMAGENS ****/

					
					

				
			
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
		<title>NOVA CATEGORIA BACKEND - SITE</title>
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
			<h1>Nova Categoria</h1>
			<h6>Aqui pode gerir e adicionar categorias</h6>

			<div class="mensagens">
				<?php 
					echo $sms; 
				?>	
			</div>

			<form action="" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6 col-xs-12">
						<div class="campos">
							<div class="form-controls">
								<label>
									Nome:<br>
									<input type="text" name="nome-cat">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Descriçao:<br>
									<input type="text" name="desc-cat">
								</label>
							</div>
							
						</div>
					</div>

					<div class="col-md-6 col-xs-12">
						<div class="campos">
							<div class="form-controls">
								<label>
									URL:<br>
									<input type="text" name="url-cat">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Foto:<br>
									<input type="file" name="img-cat">
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