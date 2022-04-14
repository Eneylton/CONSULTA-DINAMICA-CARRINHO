$(function(){
	$('#busca').keyup(function(){
		var buscaTexto = $(this).val();
		if(buscaTexto.length >= 3){
			$.ajax({
				method: 'post',
				url: 'sys/sys.php',
				data: {busca: 'sim', texto: buscaTexto},
				dataType: 'json',
				success: function(retorno){
					if(retorno.qtd == 0){
						$('#resultado_busca').html('<p>Não encontramos resultados para sua busca</p>');
					}else{
						$('#resultado_busca').html(retorno.dados);
					}
				}
			});
		}
	});

	$('body').on('click', '#resultado_busca a', function(){
		var dadosProduto = $(this).attr('id');
		var splitDados = dadosProduto.split(':');

		$.ajax({
			method: 'post',
			url: 'sys/sys.php',
			data: {add_produto: 'sim', produto: splitDados[0]},
			dataType: 'json',
			success: function(retorno){
				$('tbody#content_retorno').html(retorno.dados);
			}
		});
	});
});


$(document).ready(function(){
	$('#select').on('change',function(){

		var selectValor = '#' + $(this).val();
		
		$('#pai').children('div').hide();
		$('#pai').children(selectValor).show();

	})
})