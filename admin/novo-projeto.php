<?php
	session_start();
	include __DIR__.'/includes/config.php';
	$sms = '';
	
	if (!isset($_SESSION['entra']) || $_SESSION['entra']!='xpto') {
		header("Location: index.php");
		exit();
	}

	if (isset($_POST["enviar"])) {
		if (!empty($_POST["nome-projeto"]) && !empty($_POST["url-projeto"]) && !empty($_FILES['img-projeto']['name'])) {
			
			
					/***** TRATAMENTO IMAGENS ****/

					$caminho = '../img/projetos/';
					$caminhoFront = "img/projetos/";


					$caminhoAudio = '../audio/';
					$caminhoAudioFront = "audio/";
					$caminhoComFicheiroAudio = $caminhoAudio.basename($_FILES['audio-projeto']["name"]);
					$ext2 = strtolower(pathinfo($caminhoComFicheiroAudio, PATHINFO_EXTENSION));
					if ($ext2 != 'wav' && $ext2 != 'mp3') {
						$erroAudio = 'Não aceitamos a extensão '.$ext;
					}
					$erroAudio = '';
					if ($erroAudio=='') {
						move_uploaded_file($_FILES['audio-projeto']["tmp_name"], $caminhoComFicheiroAudio);
					}



					$erroImg = '';

					$caminhoComFicheiro = $caminho.basename($_FILES['img-projeto']["name"]);
					$ext = strtolower(pathinfo($caminhoComFicheiro, PATHINFO_EXTENSION));

					/*if (file_exists($caminhoComFicheiro)) {
						$erroImg = 'Já existe no sistema!, Pf mude o nome!';
					}*/

					if ($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg') {
						$erroImg = 'Não aceitamos a extensão '.$ext;
					}

					if ($_FILES['img-projeto']["size"] > 5220000) {
						$erroImg = 'Carregue uma imagem até 5MB';
					}

					if ($erroImg=='' && $erroAudio=='') {
						move_uploaded_file($_FILES['img-projeto']["tmp_name"], $caminhoComFicheiro);

						$img_projeto = $caminhoFront.$_FILES['img-projeto']["name"];
						$audio_projeto = $caminhoAudioFront.$_FILES['audio-projeto']["name"];
						$nome_projeto  = $_POST["nome-projeto"]; 
						$desc_projeto  = $_POST["desc-projeto"]; 
						$url_projeto  = $_POST["url-projeto"]; 
						$conteudo_projeto  = $_POST["conteudo-projeto"]; 
						$fk_cat  = $_POST["fk-cat"]; 

						//$data_registo  = date('Y-m-d H:i:s'); 

						$inserir = $mysqli->query("INSERT INTO `musicas` (
								`id_projeto`,
								`nome_projeto`,
								`desc_projeto`,
								`url_projeto`,
								`conteudo_projeto`,
								`fk_cat`,
								`img_projeto`,
								`audio_projeto`
							) VALUES (
								default,
								'$nome_projeto',
								'$desc_projeto',
								'$url_projeto',
								'$conteudo_projeto',
								'$fk_cat',
								'$img_projeto',
								'$audio_projeto'
							)");


						$sms = '<div class="alert alert-success">Projeto inserido com sucesso!</div>';
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
		<title>NOVA PROJETOS BACKEND - SITE</title>
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
			<h1>Nova PROJETOS</h1>
			<h6>Aqui pode gerir e adicionar PROJETOS</h6>

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
									<input type="text" name="nome-projeto">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Descriçao:<br>
									<input type="text" name="desc-projeto">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Conteudo:<br>
									<textarea rows="5" name="conteudo-projeto"></textarea>
								</label>
							</div>
							
						</div>
					</div>

					<div class="col-md-6 col-xs-12">
						<div class="campos">
							<div class="form-controls">
								<label>
									URL:<br>
									<input type="text" name="url-projeto">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Foto:<br>
									<input type="file" name="img-projeto">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Áudio:<br>
									<input type="file" name="audio-projeto">
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
											echo '<option value="'.$printCat->id_cat.'">'.$printCat->nome_cat.'</option>';
										}

										?>
									</select>
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