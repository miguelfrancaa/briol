$(document).ready(function(){
	let conta = 0;
	$('.thumb').each(function(index){
		console.log("--> "+index);
		if (conta==0 || conta==5) {
			$(this).css({"width":"50%","height":"50vh"});
			if(conta==5){
				$(this).css({"float":"right"});
			}
		}
		let imgPrincipal = $(this).attr("img-principal");
		$(this).css({"background-image":"url("+imgPrincipal+")"});
		conta++;
		if (conta==10) {
			conta=0;
		}
	})
	$('.thumb').mouseenter(function(){
		let imgSecundaria = $(this).attr("img-secundaria");
		$(this).css({"background-image":"url("+imgSecundaria+")"});
	})
	$('.thumb').mouseleave(function(){
		let imgPrincipal = $(this).attr("img-principal");
		$(this).css({"background-image":"url("+imgPrincipal+")"});
	})
});





 
