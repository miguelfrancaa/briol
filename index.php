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
		<meta name="keywords" content="briol, dubstep, music, portugal, pt, wut, wut, notruf, dub, rhythm, design">
		<meta name="description" content="BRIOL PT">
		<link rel="icon" href="img/icontabbriol.ico">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<?php include __DIR__.'/includes/header.php'; ?>

		<main>
			<div class="container mainContainer">
				<div class="row changetogrid">

					<?php

					if ( isset($_GET['url']) && !empty($_GET['url'])) {
							$url = $_GET['url'];
							$getProj = $mysqli->query("SELECT * FROM `musicas` where `url_projeto` = '$url' ORDER BY `id_projeto` desc LIMIT 1");
	  					$printProj = $getProj->fetch_object();

	  					$ultimo = $printProj->id_projeto;
					}else{
							$getProj = $mysqli->query("SELECT * FROM `musicas`  ORDER BY `id_projeto` desc LIMIT 1");
	  					$printProj = $getProj->fetch_object();

	  					$ultimo = $printProj->id_projeto;
					}
					

					?>
					<div class="col-md-5 col-sm-12 col-xs-12 fixaAlturaOrigem blPlayer">
						<div class="row">
							<div class="col-md-12 col-sm-12 ">
								<h2>
									<span class="titulo" id="titlemusic"><?php echo $printProj->nome_projeto; ?></span><br>
									<span class="subtitulo" id="subtitlemusic"><?php echo $printProj->conteudo_projeto; ?></span><br>
									<span class="subsubtitulo" id="subsubtitlemusic"><?php echo $printProj->desc_projeto; ?></span><br>
								</h2>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 playerbox ">
								<div class="row">
									<div class="col-md-4 col-sm-4 col-xs-4">
										<button><i class="fa fa-arrow-left" id="prev" style="display: none;"></i></button></div>
									<div class="col-md-4 col-sm-4 col-xs-4"><button class="center"><i class="fa fa-play" id="play"></i></button><button class="center"><i class="fa fa-pause" id="pause"></i></button></div>
									<div class="col-md-4 col-sm-4 col-xs-4"><button class="right"><i class="fa fa-arrow-right" id="next"></i></button></div>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12 tempo">
										<div class="col-md-6 col-sm-6 col-xs-6"><div class="tempo1">0:00</div></div>
										<div class="col-md-6 col-sm-6 col-xs-6"><div class="right tempo2"></div></div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12"><div class="barra">
										<div class="enchimento"></div></div>
									</div>
									<audio src="<?php echo $printProj->audio_projeto; ?>" class="audio" autoplay="0"></audio>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 cover fixaAltura blCapa"><div class="coverimg" style="background-image: url('<?php echo $printProj->img_projeto; ?>');"></div></div>
				</div>
			</div>
			<?php 

			$getOthers = $mysqli->query("SELECT * FROM `musicas` WHERE `id_projeto` != '$ultimo' ORDER BY `id_projeto` desc LIMIT 6");

			if ($getOthers->num_rows>0) { ?>
			
				<div class="container relates">
					<div class="row">
						<div class="col-md-12 col-sm-12 listen">
							OUÇA TAMBÉM
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">

							<?php while ($printOther = $getOthers->fetch_object()) { ?>
								<div class="col-md-2 col-sm-3 col-xs-4">
									<div class="relate">
										<a href="index.php?url=<?php echo $printOther->url_projeto; ?>" target="_self">
											<div class="relate1"  style="background-image: url('<?php echo $printOther->img_projeto; ?>');">
												
											</div>
										</a>
									</div>
									<div class="relDes">
										<a href="index.php?url=<?php echo $printOther->url_projeto; ?>" target="_self">
											<p class="titleRel"><?php echo $printOther->nome_projeto; ?></p>
											<p class="subtitleRel"><?php echo $printOther->desc_projeto; ?></p>
											<p class="subsubtitleRet"><?php echo $printOther->conteudo_projeto; ?></p>
										</a>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="plus"><a href="index3.php"><button class="mais"><i class="fa fa-plus"></i></button></a></div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			<?php } ?>
		</main>

		<?php include __DIR__.'/includes/footer.php'; ?>

		

		<!-- INPAGE -->
		<script src="js/jquery-3.6.0.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/script.js?v=<?php echo date('YmdHis'); ?>"></script>
		<script src="js/vanilla-tilt.min.js"></script>
		<!-- INFILE -->

		<script type="text/javascript">
			
			/*let musicas = [
				{titulo:'WUT#1<br>', artista:'WUT', data:'16.06.2022', src:'audio/briol1.mp3', img:'img/briol1.jpeg'},
				{titulo:'KAYOPS#1<br>', artista:'KAYOPS', data:'17.06.2022', src:'audio/briol2.mp3', img:'img/briol2.jpeg'}
			];*/
			let musicas = [
			<?php 
					if ( isset($_GET['url']) && !empty($_GET['url'])) {
							$url = $_GET['url'];
							$getProj = $mysqli->query("SELECT * FROM `musicas` where `url_projeto` = '$url' ORDER BY `id_projeto` desc LIMIT 1");
	  					$printProj = $getProj->fetch_object();

	  					$ultimo = $printProj->id_projeto;
					}else{
							$getProj = $mysqli->query("SELECT * FROM `musicas`  ORDER BY `id_projeto` desc LIMIT 1");
	  					$printProj = $getProj->fetch_object();

	  					$ultimo = $printProj->id_projeto;
					}
					echo "{titulo:'".$printProj->nome_projeto."', artista:'".$printProj->conteudo_projeto."', data2:'".$printProj->desc_projeto."', src:'".$printProj->audio_projeto."', img:'".$printProj->img_projeto."'},";

					$getOthers = $mysqli->query("SELECT * FROM `musicas` WHERE `id_projeto` != '$ultimo' ORDER BY `id_projeto` desc LIMIT 6");

					if ($getOthers->num_rows>0) {
						 while ($printOther = $getOthers->fetch_object()) {
						 		echo "{titulo:'".$printOther->nome_projeto."', artista:'".$printOther->conteudo_projeto."', data2:'".$printOther->desc_projeto."', src:'".$printOther->audio_projeto."', img:'".$printOther->img_projeto."'},";
						 }
					}
				
			?>
			];

			console.log("Musicas "+musicas);

			let musica = document.querySelector('.audio');
			let indexMusica = 0;
			let tempoTotal = document.querySelector('.tempo2');
			let play = document.getElementById('play');
			let pause = document.getElementById('pause');

			let img = document.querySelector('.coverimg');
			let nomeMusica = document.getElementById('titlemusic');
			let nomeArtista = document.getElementById('subtitlemusic');
			let dataMusica = document.getElementById('subsubtitlemusic');
			let anterior = document.getElementById('prev');
			let proximo = document.getElementById('next');
			let cover = document.querySelector('.coverimg');
			let barra = document.querySelector('.barra');

			//renderizarMusica(indexMusica);

			musica.pause();

			//Eventos

			musica.addEventListener('timeupdate', atualizarBarra);

			play.addEventListener('click', tocarMusica);

			pause.addEventListener('click', pararMusica);

			musica.addEventListener('ended', () => {
				indexMusica++;
				renderizarMusica(indexMusica);
			})

			anterior.addEventListener('click', () => {
				indexMusica--;
				renderizarMusica(indexMusica);
				playIcon();
			});

			proximo.addEventListener('click', () => {
				indexMusica++;
				renderizarMusica(indexMusica);
				playIcon();
			});

			barra.addEventListener('click', (e) => {
				let progressWidth = barra.clientWidth;
				let clickX = e.offsetX;


				musica.currentTime = Math.floor((clickX / progressWidth) * musica.duration);
			});



			//Funções

			function tocarMusica(){
				musica.play();
				pause.style.display = 'block';
				play.style.display = 'none'
			}

			function pararMusica(){
				musica.pause();
				pause.style.display = 'none';
				play.style.display = 'block'

			}

			function atualizarBarra(){
				let enchimento = document.querySelector('.enchimento');
				enchimento.style.width = Math.floor((musica.currentTime / musica.duration) * 100) + '%';

				let tempoDecorrido = document.querySelector('.tempo1');
				tempoDecorrido.innerHTML = segundosParaMinutos(Math.floor(musica.currentTime));
			}

			function segundosParaMinutos(segundos){
				let campoMinutos = Math.floor(segundos / 60);
				let campoSegundos = segundos % 60;

				if (campoSegundos < 10){
					campoSegundos = '0'+ campoSegundos;
				}

				return campoMinutos+':'+campoSegundos;
			}

			function renderizarMusica(index){
				musica.setAttribute('src', musicas[index].src);
				musica.addEventListener('loadeddata', () => {
					nomeMusica.innerHTML = musicas[index].titulo;
					nomeArtista.innerHTML = musicas[index].artista;
					dataMusica.innerHTML = musicas[index].data2;
					//cover.style.backgroundImage = 'url('+musicas[index].img+');';
					console.log(musicas[index].data2);
					$('.coverimg').css({"background-image":'url('+musicas[index].img+')'});
					tempoTotal.innerHTML = segundosParaMinutos(Math.floor(musica.duration));
					atualizarBarra();

					if (index == 0) {
						$("#prev").hide();
					}else{
						$("#prev").show();
					}
					if (index == musicas.length-1) {
						$("#next").hide();
					}else{
						$("#next").show();
					}
				});
			}

			function playIcon() {
				pause.style.display = 'block';
				play.style.display = 'none'
			}

			function pauseIcon() {
				pause.style.display = 'none';
				play.style.display = 'block'
			}

			tempoTotal.innerHTML = segundosParaMinutos(Math.floor(musica.duration));
		</script>
	</body>
</html>