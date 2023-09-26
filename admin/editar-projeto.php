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
		$user = $mysqli->query("SELECT * FROM `musicas` WHERE `id_projeto` = '$myid'");
		$printUser = $user->fetch_object();
	}else{
		header("Location: projetos.php");
		exit();
	}



	if (isset($_POST["enviar"])) {
		if (!empty($_POST["nome-projeto"]) && !empty($_POST["url-projeto"])) {
			
					

					$caminho = '../img/projetos/';
					$caminhoFront = "img/projetos/";
					$erroImg = '';
					$img_projeto = '';
					if (isset($_FILES['img-projeto']["name"]) && $_FILES['img-projeto']["name"]!='') {
						$caminhoComFicheiro = $caminho.basename($_FILES['img-projeto']["name"]);
						$ext = strtolower(pathinfo($caminhoComFicheiro, PATHINFO_EXTENSION));

						if (file_exists($caminhoComFicheiro)) {
							$erroImg = 'Já existe no sistema!, Pf mude o nome!';
						}

						if ($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg') {
							$erroImg = 'Não aceitamos a extensão '.$ext;
						}

						if ($_FILES['img-projeto']["size"] > 5000000) {
							$erroImg = 'Carregue uma imagem até 5MB';
						}
					}else{
						$img_projeto = $_POST['foto-antiga'];
					}
					

					$caminhoAudio = '../audio/';
					$caminhoAudioFront = "audio/";
					$erroAudio = '';
					if (isset($_FILES['audio-projeto']["name"]) && $_FILES['audio-projeto']["name"]!='') {
						$caminhoComFicheiroAudio = $caminhoAudio.basename($_FILES['audio-projeto']["name"]);
						$ext2 = strtolower(pathinfo($caminhoComFicheiroAudio, PATHINFO_EXTENSION));
						if ($ext2 != 'wav' && $ext2 != 'mp3') {
							$erroAudio = 'Não aceitamos a extensão '.$ext;
						}
						
					}else{
						$audio_projeto = $_POST['audio-antiga'];
					}


					if ($erroAudio==''  && $audio_projeto=='') {
						move_uploaded_file($_FILES['audio-projeto']["tmp_name"], $caminhoComFicheiroAudio);
					}

					if ($erroImg == '' && $img_projeto=='') {
						move_uploaded_file($_FILES['img-projeto']["tmp_name"], $caminhoComFicheiro);
						$img_projeto = $caminhoFront.$_FILES['img-projeto']["name"];
					}

					if ($erroImg == '') { 
						

						$nome_projeto  = $_POST["nome-projeto"]; 
						$desc_projeto  = $_POST["desc-projeto"]; 
						$url_projeto  = $_POST["url-projeto"];
						$conteudo_projeto  = $_POST["conteudo-projeto"];
						$fk_cat  = $_POST["fk-cat"]; 

						
						$atualizar = $mysqli->query("UPDATE `musicas` SET
							`nome_projeto` = '$nome_projeto',
							`desc_projeto` = '$desc_projeto',
							`url_projeto` = '$url_projeto',
							`conteudo_projeto` = '$conteudo_projeto',
							`fk_cat` = '$fk_cat',
							`img_projeto` = '$img_projeto',
							`audio_projeto` = '$audio_projeto'
							WHERE `id_projeto` = '$myid'
							");


						$sms = '<div class="alert alert-success">Projeto editado com sucesso!</div>';
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
			<h1>Editar Projeto</h1>
			<h6>Aqui pode gerir e editar projetos</h6>

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
									<input type="text" name="nome-projeto" value="<?php echo $printUser->nome_projeto; ?>">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Descrição:<br>
									<input type="text" name="desc-projeto" value="<?php echo $printUser->desc_projeto; ?>">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Conteudo:<br>
									<textarea rows="5" name="conteudo-projeto"><?php echo $printUser->conteudo_projeto; ?></textarea>
								</label>
							</div>
							
							
						</div>
					</div>

					<div class="col-md-6 col-xs-12">
						<div class="campos">
							<div class="form-controls">
								<label>
									IMG Projeto:<br>
									<?php if ($printUser->img_projeto!='') {
										echo '<img src="../'.$printUser->img_projeto.'" class="conterImg">';
									} ?>
									<small>Caso pretenda mudar a foto de projeto, carregue aqui</small>
									<input type="file" name="img-projeto">
									<input type="hidden" name="foto-antiga" value="<?php echo $printUser->img_projeto; ?>">
								</label>
							</div>

							<div class="form-controls">
								<label>
									Áudio Projeto:<br>
									<?php if ($printUser->audio_projeto!='') {
										echo '<audio src="../'.$printUser->audio_projeto.'" autoplay="0"></audio>';
									} ?>
									<small>Caso pretenda mudar o audio do projeto, carregue aqui</small>
									<input type="file" name="audio-projeto">
									<input type="hidden" name="audio-antiga" value="<?php echo $printUser->audio_projeto; ?>">
								</label>
							</div>
					
							<div class="form-controls">
								<label>
									URL:<br>
									<input type="text" name="url-projeto" value="<?php echo $printUser->url_projeto; ?>">
								</label>
							</div>


							<div class="form-controls">
								<label>
									Categoria:<br>
									<select name="fk-cat">
										<option value="0">Sem Categoria</option>
										<?php  

										$getCat = $mysqli->query("SELECT * FROM`categorias` ORDER BY `nome_cat` ASC");
										while($printCat = $getCat->fetch_object()){
											if ($printUser->fk_cat == $printCat->id_cat) {
												echo '<option value="'.$printCat->id_cat.'" selected="selected">'.$printCat->nome_cat.'</option>';
											}else{
												echo '<option value="'.$printCat->id_cat.'">'.$printCat->nome_cat.'</option>';
											}
											
										}

										?>
									</select>
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