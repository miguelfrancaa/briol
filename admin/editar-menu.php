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
	}else{
		header("Location: menus.php");
		exit();
	}


	if (isset($_POST["enviar"])) {
		if (!empty($_POST["nome-menu"]) && !empty($_POST["url-menu"])) {
				
			$nome_menu  = $_POST["nome-menu"]; 
			$url_menu  = $_POST["url-menu"]; 
			$posicao_menu  = $_POST["posicao-menu"]; 
			$target_menu  = $_POST["target-menu"]; 
			$parent_id  = $_POST["parent-id"]; 
			$icon  = $_POST["icon"]; 
			$cor_icon  = $_POST["cor-icon"]; 

			$inserir = $mysqli->query("UPDATE `menus` SET 
					`nome_menu` = '$nome_menu',
					`url_menu` = '$url_menu',
					`posicao_menu` = '$posicao_menu',
					`target_menu` = '$target_menu',
					`parent_id` = '$parent_id',
					`icon` = '$icon',
					`cor_icon` = '$cor_icon'
					WHERE `id_menu` = '$myid'");


			$sms = '<div class="alert alert-success">Editado inserido com sucesso!</div>';

				
		}else{
			$sms = '<div class="alert alert-danger">Preenchas os campos obrigatórios (Nome e Link do menu)!</div>';
		}
	}

	
	$user = $mysqli->query("SELECT * FROM `menus` WHERE `id_menu` = '$myid'");
	$printMenus = $user->fetch_object();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>EDITAR Menu BACKEND - SITE</title>
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
			<h1>EDITAR Utilizador</h1>
			<h6>Aqui pode gerir adicionar editar</h6>

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
									Nome:<br>
									<input type="text" name="nome-menu" value="<?php echo $printMenus->nome_menu; ?>">
								</label>
							</div>
							<div class="form-controls">
								<label>
									URL:<br>
									<input type="text" name="url-menu" value="<?php echo $printMenus->url_menu; ?>">
								</label>
							</div>
							<div class="form-controls">
								<label>
									Posição:<br>
									<input type="number" name="posicao-menu" value="<?php echo $printMenus->posicao_menu; ?>">
								</label>
							</div>
							<div class="form-controls">
								<label>
									TARGET:<br>
									<select name="target-menu">
										<?php if ($printMenus->target_menu == '_self') { ?>
											<option value="_self" selected="selected">SELF</option>
											<option value="_blank">BLANK</option>
										<?php }else{ ?>
											<option value="_self">SELF</option>
											<option value="_blank" selected="selected">BLANK</option>
										<?php } ?>
									
									</select>
								</label>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-xs-12">
						<div class="campos">


							<div class="form-controls">
								<label>
									PARENT:<br>
									<select name="parent-id">
										<option value="0">RAIZ</option>
										<?php
											$pesquisa = $mysqli->query("SELECT * FROM `menus` WHERE `parent_id`='0' ORDER BY `posicao_menu` ASC"); 
											while($printMenu = $pesquisa->fetch_object()){
												if ($printMenus->parent_id == $printMenu->id_menu) { 
										?>
												<option value="<?php echo $printMenu->id_menu; ?>" selected="selected"><?php echo $printMenu->nome_menu; ?></option>
										<?php 
												}else{ ?>
													<option value="<?php echo $printMenu->id_menu; ?>"><?php echo $printMenu->nome_menu; ?></option>
											<?php	}

									} ?>
									</select>
								</label>
							</div>


							<div class="form-controls">
								<label>
									Icon (escreve o nome do icon):<br>
									<input type="text" name="icon" value="<?php echo $printMenus->icon; ?>">
								</label>
							</div>


							<div class="form-controls">
								<label>
									Cor do Icon:<br>
									<input type="color" name="cor-icon" value="<?php echo $printMenus->cor_icon; ?>">
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