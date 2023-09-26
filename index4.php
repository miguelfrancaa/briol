<?php 
  session_start();
  include __DIR__."/admin/includes/config.php"; 

  $sms = '';


?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
		<?php include __DIR__.'/includes/header.php'; ?>

		<main>

			<?php 

			$getOthers = $mysqli->query("SELECT * FROM `eventos` ORDER BY `id_eventos` desc");

			if ($getOthers->num_rows>0) { ?>
			
		<div class="container events">
			<?php while ($printOther = $getOthers->fetch_object()) { ?>
			<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 event">
				<p class="tituloEvent laranja1"><?php echo $printOther->artista_evento; ?></p>
				<p class="subtituloEvent"><?php echo $printOther->data_evento; ?></p>
				<p class="subsubtituloEvent"><?php echo $printOther->nome_evento; ?></p>
				<p class="subsubtituloEvent"><?php echo $printOther->local_evento; ?></p>
				<a href="<?php echo $printOther->detalhes_evento; ?>" target="_blank"><button class="details laranja1">DETALHES</button></a>
				<div class="marginEvent"></div>
				<?php } ?>
			</div>
			</div>
			<?php } ?>
		</main>

		<?php include __DIR__.'/includes/footer.php'; ?>

		
		<!-- INPAGE -->
		<script src="js/jquery-3.6.0.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/script.js"></script>
		<!-- INFILE -->
	</body>
</html>