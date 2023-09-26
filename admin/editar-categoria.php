<?php
	session_start();
	include __DIR__.'/includes/config.php';
	$sms = '';
	
	if (!isset($_SESSION['entra']) || $_SESSION['entra']!='xpto') {
		header("Location: index.php");
		exit();
	}


	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$myid = $_GET['id'];
		$user = $mysqli->query("SELECT * FROM `categorias` WHERE `id_cat` = '$myid'");
		$printUser = $user->fetch_object();
	}else{
		header("Location: categorias.php");
		exit();
	}



	if (isset($_POST["enviar"])) {
		if (!empty($_POST["nome-cat"]) && !empty($_POST["url-cat"])) {
			
					

					$caminho = '../img/categorias/';
					$caminhoFront = "img/categorias/";
					$erroImg = '';
					$img_cat = '';
					if (isset($_FILES['img-cat']["name"]) && $_FILES['img-cat']["name"]!='') {
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
					}else{
						$img_cat = $_POST['foto-antiga'];
					}
					
					if ($erroImg == '' && $img_cat=='') {
						move_uploaded_file($_FILES['img-cat']["tmp_name"], $caminhoComFicheiro);
						$img_cat = $caminhoFront.$_FILES['img-cat']["name"];
					}

					if ($erroImg == '') { 
						

						$nome_cat  = $_POST["nome-cat"]; 
						$desc_cat  = $_POST["desc-cat"]; 
						$url_cat  = $_POST["url-cat"]; 

						
						$atualizar = $mysqli->query("UPDATE `categorias` SET
							`nome_cat` = '$nome_cat',
							`desc_cat` = '$desc_cat',
							`url_cat` = '$url_cat',
							`img_cat` = '$img_cat'
							WHERE `id_cat` = '$myid'
							");


						$sms = '<div class="alert alert-success">Categoria editado com sucesso!</div>';
					}else{
						$sms = '<div class="alert alert-danger">'.$erroImg.'</div>';
					}

				
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
		<title>Editar Categoria BACKEND - SITE</title>
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
			<h1>Editar Categoria</h1>
			<h6>Aqui pode gerir e editar categorias</h6>

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
									<input type="text" name="nome-cat" value="<?php echo $printUser->nome_cat; ?>">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Descrição:<br>
									<input type="text" name="desc-cat" value="<?php echo $printUser->desc_cat; ?>">
								</label>
							</div>
							
							
						</div>
					</div>

					<div class="col-md-6 col-xs-12">
						<div class="campos">
							<div class="form-controls">
								<label>
									IMG Categoria:<br>
									<?php if ($printUser->img_cat!='') {
										echo '<img src="../'.$printUser->img_cat.'" class="conterImg">';
									} ?>
									<small>Caso pretenda mudar a foto de categoria, carregue aqui</small>
									<input type="file" name="img-cat">
									<input type="hidden" name="foto-antiga" value="<?php echo $printUser->img_cat; ?>">
								</label>
							</div>


							


							<div class="form-controls">
								<label>
									URL:<br>
									<input type="text" name="url-cat" value="<?php echo $printUser->url_cat; ?>">
								</label>
							</div>

						</div>
					</div>

					<div class="col-md-12 col-xs-12">
						<div class="campos campos2">
							<button class="accao" type="submit" name="enviar">GUARDAR</button>
						</div>
					</div>

				</div>
			</form>

		</main>
		<!-- ACABA AQUI DE DECORRER AS ALTERAÇÕES ENTRE PAGINAS-->
		<?php include __DIR__.'/includes/footer-back.php'; ?>	
	</body>
</html>