$(document).ready(function(){
	$('.hamb').click(function(){
		$('.xis').toggleClass('abertohamb');
		$('.hamb').toggleClass('fechadohamb');
		$('.menuPrincipal').toggleClass('aberto');
		$('.menuPrincipal ul').toggleClass('list-inline');
		$('.listaMenus').toggleClass('laranja1');
	})
	$('.xis').click(function(){
		$('.xis').toggleClass('abertohamb');
		$('.hamb').toggleClass('fechadohamb');
		$('.menuPrincipal').toggleClass('aberto');
		$('.menuPrincipal ul').toggleClass('list-inline');
		$('.listaMenus').toggleClass('laranja1');
	})

	$('.fecha').click(function(){
		$(".overlay").css("display", "none");
	});

})


$(document).ready(function(){

	$(window).resize(function(){
		console.log("Resize");
		verificaAltura();
	})
	verificaAltura();
})

function verificaAltura(){
	let alt = $('.fixaAlturaOrigem').height();
	$(".fixaAltura .coverimg").css({"height":alt+'px', "width":alt+'px'});
}


