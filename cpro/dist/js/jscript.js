if ($('#mercado_jogadores').length > 0) {
	$.ajax({url : 'php/WebCrawler.php',	
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
		

		
