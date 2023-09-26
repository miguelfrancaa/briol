<?php 
  session_start();
  include __DIR__."/admin/includes/config.php"; 

  $sms = '';

  if (isset($_POST['enviar'])) {
  		$nome  = $_POST["nome"]; 
  		$email  = $_POST["email"]; 
  		$mensagem  = $_POST["mensagem"];  

			$inserir = $mysqli->query("INSERT INTO `contactos` (
					`id_contacto`,
					`nome`,
					`email`,
					`mensagem`
				) VALUES (
					default,
					'$nome',
					'$email',
					'$mensagem'
				)");

			$sms = '<div class="overlay">
								<div id="alerta">Mensagem enviada com sucesso! <button class="fa fa-times fecha"></button></div>
							</div>';
  }

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>BRIOL</title>
		<meta name="keywords" content="briol, dubstep, music, portugal, pt, wut, wat, kayops, dub, rhythm, design">
		<meta name="description" content="BRIOL PT">
		<link rel="icon" href="img/icontabbriol.ico">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<?php echo $sms; ?>
		<?php include __DIR__.'/includes/header.php'; ?>
		<main>
			
		<div class="container ddf">
			<div class="row">
				<div class="col-md-12 envio laranja2">
					<div class="linecenter line">
						
					</div>
					<div class="lineright line">
						
					</div>
					<div class="lineleft line">
						
					</div>
					<div class="entre">ENTRE EM CONTACTO</div>
					<form action="" method="post">
							<div class="row form1">
									<div class="col-md-2 col-sm-12 col-xs-12"><label for="fname" id="fname">NAME</label></div>
									<div class="col-md-10 col-sm-12 col-xs-12"><input type="text" name="nome" id="inname" required></div><br>
								</div>
								<div class="row form2">
									<div class="col-md-2 col-sm-12 col-xs-12"><label for="femail" id="femail">EMAIL</label></div>
									<div class="col-md-10 col-sm-12 col-xs-12"><input type="email" name="email" id="inemail" required></div><br>
								</div>
								<div class="row form3">
									<div class="col-md-2 col-sm-12 col-xs-12"><label for="fmessage" id="fmessage" required>MENSAGEM</label></div>
									<div class="col-md-10 col-sm-12 col-xs-12 textarea"><textarea id="inmessage" name="mensagem" required></textarea><br><br><br></div>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="enviar"><input type="submit" name="enviar" id="sendButton" value="ENVIAR"></div>
								</div>
								</div>
								</div>
					</form>
				</div>

			</div>
		</div>
			
		</div>

		</main>

		<?php include __DIR__.'/includes/footer.php'; ?>

		
		<!-- INPAGE -->
		<script src="js/jquery-3.6.0.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/script.js"></script>
		<!-- INFILE -->
	</body>
</html>