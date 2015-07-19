$('#modal-index').click(function() {
	$('#myModal').modal('show');
});	

if ($('#mercado_jogadores').length > 0) {
	
	getMercadoPlayers();
	
	$('#status-lista').change(function() {
		load();
		getMercadoPlayers();
	});	
	$('#posicao-lista').change(function() {
		load();
		getMercadoPlayers();
	});	
	$('#time-lista').change(function() {
		load();
		getMercadoPlayers();
	});	
	$('#faixa-lista').change(function() {

		getMercadoPlayers();
	});	
	
	function getMercadoPlayers()
	{		
		var statusId = $('#status-lista').val();	
		var posicaoId = $('#posicao-lista').val();
		var timeId = $('#time-lista').val();
		var faixaId = $('#faixa-lista').val();
		
		$.ajax({		
				url : 'php/WebCrawler.php',		
				type: 'GET',
				data: { status: statusId,
						posicao: posicaoId,
						time: timeId,
						faixa: faixaId
					},
				success : function(resp) {             
					$('#mercado_jogadores').html(resp);

					$('#dtJogadores').dataTable({
					  "bPaginate": true,
					  "bLengthChange": true,
					  "bFilter": true,
					  "bSort": true,
					  "bInfo": true,
					  "bAutoWidth": false
					});				
				}
		});	
	}		
	
	function load()
	{
		$.ajax({		
				url : 'load.html',					
				success : function(resp) {             
					$('#mercado_jogadores').html(resp);

					$('#dtJogadores').dataTable({
					  "bPaginate": true,
					  "bLengthChange": true,
					  "bFilter": true,
					  "bSort": true,
					  "bInfo": true,
					  "bAutoWidth": false
					});				
				}
		});	
	}		
}

if ($('#time_jogadores').length > 0) {
	$.ajax({url : 'php/MeuTimeCrawler.php',	
			success : function(resp) {             
				$('#time_jogadores').html(resp);

				$('#dtJogadores').dataTable({
				  "bPaginate": true,
				  "bLengthChange": true,
				  "bFilter": true,
				  "bSort": true,
				  "bInfo": true,
				  "bAutoWidth": false
				});				
			}
	});	
}
		

		
