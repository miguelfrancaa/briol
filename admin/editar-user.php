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
		$user = $mysqli->query("SELECT * FROM `administradores` WHERE `id_admin` = '$myid'");
		$printUser = $user->fetch_object();
	}else{
		header("Location: user.php");
		exit();
	}



	if (isset($_POST["enviar"])) {
		if (!empty($_POST["email-admin"]) && !empty($_POST["nome-admin"])) {
			if ($_POST["pass-admin"] == $_POST["pass2-admin"]) {
				$emailUser = $_POST["email-admin"];
				$pesqMail = $mysqli->query("SELECT * FROM `administradores` WHERE `email_admin` = '$emailUser' and `id_admin`!='$myid'");
				if ($pesqMail->num_rows<=0) {
					

					$caminho = '../img/user/';
					$caminhoFront = "img/user/";
					$erroImg = '';
					$foto_admin = '';
					if (isset($_FILES['foto-admin']["name"]) && $_FILES['foto-admin']["name"]!='') {
						$caminhoComFicheiro = $caminho.basename($_FILES['foto-admin']["name"]);
						$ext = strtolower(pathinfo($caminhoComFicheiro, PATHINFO_EXTENSION));

						if (file_exists($caminhoComFicheiro)) {
							$erroImg = 'Já existe no sistema!, Pf mude o nome!';
						}

						if ($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg') {
							$erroImg = 'Não aceitamos a extensão '.$ext;
						}

						if ($_FILES['foto-admin']["size"] > 5000000) {
							$erroImg = 'Carregue uma imagem até 5MB';
						}
					}else{
						$foto_admin = $_POST['foto-antiga'];
					}
					
					if ($erroImg == '' && $foto_admin=='') {
						move_uploaded_file($_FILES['foto-admin']["tmp_name"], $caminhoComFicheiro);
						$foto_admin = $caminhoFront.$_FILES['foto-admin']["name"];
					}

					if ($erroImg == '') { 
						if ($_POST["pass-admin"]=='') {
							$pass_admin  = $printUser->pass_admin; 
						}else{
							$pass_admin  = MD5($_POST["pass-admin"]); 
						}

						$nome_admin  = $_POST["nome-admin"]; 
						$apelido_admin  = $_POST["apelido-admin"]; 
						$email_admin  = $_POST["email-admin"]; 
						$tel_admin  = $_POST["tel-admin"]; 

						
						$atualizar = $mysqli->query("UPDATE `administradores` SET
							`nome_admin` = '$nome_admin',
							`apelido_admin` = '$apelido_admin',
							`email_admin` = '$email_admin',
							`tel_admin` = '$tel_admin',
							`pass_admin` = '$pass_admin',
							`foto_admin` = '$foto_admin'
							WHERE `id_admin` = '$myid'
							");


						$sms = '<div class="alert alert-success">Utilizador editado com sucesso!</div>';
					}else{
						$sms = '<div class="alert alert-danger">'.$erroImg.'</div>';
					}

				}else{
					$sms = '<div class="alert alert-danger">Esse email ja existe na base dados!</div>';
				}
			}else{
				$sms = '<div class="alert alert-danger">As palavras passe nao coincidem!</div>';
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
		<title>NOVO USER BACKEND - SITE</title>
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
			<h1>Editar Utilizador</h1>
			<h6>Aqui pode gerir e editar users</h6>

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
									<input type="text" name="nome-admin" value="<?php echo $printUser->nome_admin; ?>">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Apelido:<br>
									<input type="text" name="apelido-admin" value="<?php echo $printUser->apelido_admin; ?>">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Email:<br>
									<input type="text" name="email-admin" value="<?php echo $printUser->email_admin; ?>">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Foto Perfil:<br>
									<?php if ($printUser->foto_admin!='') {
										echo '<img src="../'.$printUser->foto_admin.'" class="conterImg">';
									} ?>
									<small>Caso pretenda mudar a foto de perfil, carregue aqui</small>
									<input type="file" name="foto-admin">
									<input type="hidden" name="foto-antiga" value="<?php echo $printUser->foto_admin; ?>">
								</label>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-xs-12">
						<div class="campos">
							<div class="form-controls">
								<label>
									Telefone:<br>
									<input type="text" name="tel-admin" value="<?php echo $printUser->tel_admin; ?>">
								</label>
							</div>


							<div class="form-controls">
								<label>
									Palavra Passe:<br>
									<input type="password" name="pass-admin">
								</label>
							</div>


							<div class="form-controls">
								<label>
									Confirmação Palavra Passe:<br>
									<input type="password" name="pass2-admin">
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