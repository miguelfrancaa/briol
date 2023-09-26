<?php
	session_start();
	include __DIR__.'/includes/config.php';
	$sms = '';
	if (isset($_POST['enviar'])) {
		if (!empty($_POST['email']) && !empty($_POST['pass'])) {
			$email = $_POST['email'];
			$pass = $_POST['pass'];
			$pesq = $mysqli->query("SELECT * FROM `administradores` WHERE `email_admin` = '$email' AND `pass_admin` = md5('$pass')");
			if ($pesq->num_rows > 0) {
				$print = $pesq->fetch_object();
				$idUser = $print->id_admin;
				$data = date("Y-m-d H:i:s");
				$update = $mysqli->query("UPDATE `administradores` SET `data_log`='$data' WHERE `id_admin` = '$idUser'");

				//$sms = '<div class="alert alert-success">Vc entrou!!!</div>';
				$_SESSION['entra'] = 'xpto';
				$_SESSION['id'] = $print->id_admin;
				$_SESSION['nome'] = $print->nome_admin;
				$_SESSION['apelido'] = $print->apelido_admin;
				$_SESSION['email'] = $print->email_admin;

				header("Location: inicio.php");
				exit();


			}else{
				$sms = '<div class="alert alert-danger">As credenciais estão incorretas</div>';
			}
		}else{
			$sms = '<div class="alert alert-warning">O campo email ou pass estao por preencher!!!!</div>';
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>BACKEND - SITE</title>
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
	<body class="admin-crm login-page">
		<main>
			<img src="img/briollogo2.png">
			<?php echo $sms; ?>
			<form action="" method="POST" enctype="multipart/form-data">
				<label>
					Username:<br>
					<input type="email" name="email" placeholder="Escreva o email">
				</label>
				<label>
					Palavra-Passe:<br>
					<input type="password" name="pass" placeholder="Escreva a pass">
				</label>
				<input type="submit" name="enviar" value="ENTRAR">
			</form>
		</main>

		<script src="js/jquery-3.6.0.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/script.js"></script>
	</body>
</html>