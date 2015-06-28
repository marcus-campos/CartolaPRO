$.ajax({url : 'php/WebCrawler.php',	
		success : function(resp) {             
			$('#jogadores').html(resp);

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
		
