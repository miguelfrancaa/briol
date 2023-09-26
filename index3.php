<?php 
  session_start();
  include __DIR__."/admin/includes/config.php"; 

  $sms = '';


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
		<?php include __DIR__.'/includes/header.php'; ?>

		<main class="ddf">


			
		<div class="container">
			<div class="row">

			


					<?php 

			$getOthers = $mysqli->query("SELECT * FROM `musicas` ORDER BY `id_projeto` desc");

			if ($getOthers->num_rows>0) { ?>

				<div class="col-md-12 monthArchive">2022</div>
				<?php while ($printOther = $getOthers->fetch_object()) { ?>
					<div class="col-md-2 col-sm-2 col-xs-4">
						<a href="index.php?url=<?php echo $printOther->url_projeto; ?>" target="_self">
						
						<div class="imgArchive">
							<img src="<?php echo $printOther->img_projeto; ?>">
						</div>
						<div class="nameArchive"><?php echo $printOther->nome_projeto; ?></div>
						<div class="dataArchive"><?php echo $printOther->conteudo_projeto; ?></div>
						<div class="artistArchive"><?php echo $printOther->desc_projeto; ?></div>
					</a>
						
					</div>
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