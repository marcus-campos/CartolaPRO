<?php 
session_start();

class WebCrawler {	
	public function crawler(){	
		try {	
			require_once 'math/formulas.php';
			$fMath = new ForMath();
			$username = $_SESSION['login'];
			$password = $_SESSION['senha'];

			//set the directory for the cookie using defined document root var
			//$dir = "C:\wamp\www";
			//build a unique path with every request to store 
			//the info per user with custom func. 
			//$path = build_unique_path($dir);

			//login form action url
			$url="https://loginfree.globo.com/login/438";
			$postinfo = "login-passaporte=".$username."&senha-passaporte=".$password;

			$cookie_file_path = "cookie.txt";

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_NOBODY, false);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
			//set the cookie the site has for certain features, this is optional
			curl_setopt($ch, CURLOPT_COOKIE, "cookiename=0");
			//curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);

			curl_exec($ch);

			$positions = array("GOL", "LAT", "ZAG", "MEI", "ATA", "TEC");
			?>
				<table id="dtJogadores" class="table table-bordered table-striped">
					<thead>
					  <tr>
						<th>ID</th>
						<th>Apelido</th>
						<th>Posicao</th>
						<th>Preco</th>
						<th>Status</th>
						<th>Clube</th>
						<th>Pontuacao esperada</th>
						<th>Valorizacao esperada</th>
					  </tr>
					</thead>
					<tbody>  

			<?php
			$status = "";
			$posicao = "";
			$time = "";
			$faixa = "";
			
			if(isset($_GET['status']))
				$status = $_GET['status'];
			if(isset($_GET['posicao']))
				$posicaoCampo = $_GET['posicao'];
			if(isset($_GET['time']))
				$time = $_GET['time'];
			if(isset($_GET['faixa']))
				$faixa = $_GET['faixa'];
			
			for($x = 1; $x <= 41; $x++)
			{
				curl_setopt($ch, CURLOPT_URL, "http://cartolafc.globo.com/mercado/filtrar.json?page=$x&order_by=preco&status_id=$status&posicao_id=$posicaoCampo&clube_id=$time&faixa_preco=$faixa"); //Pagina com filtro de jogadores
				$json = curl_exec($ch);
				$jsonObj = json_decode($json);
				$atleta = $jsonObj->atleta;
				if (strpos($json, '405 Not Allowed') !== FALSE)
				{
					session_start();
					session_destroy();
					?>
					<center><h1>Login ou senha invalidos!</h1></center>
					<meta http-equiv="refresh" content="2">
					<?php
				}
					
				foreach ($atleta as $atl) 
				{ 
					curl_setopt($ch, CURLOPT_URL, "http://cartolafc.globo.com/atleta/$atl->id/evolucao/5rodadas.json"); //Médias 5 rodadas
					//--------------------------
					$evolucao = curl_exec($ch);
					$medias = json_decode($evolucao);
					$proximaPontuacao = $fMath->projecaoDePontuacao($medias);	
					$proximaPontuacao = number_format($proximaPontuacao, 2, '.', ',');
					$partidasJogadas = count($medias);
					$valorizacao = 0.0;
					if (!$partidasJogadas == 0)
						$valorizacao = $fMath->previsaoDePontuacao($proximaPontuacao, $medias);
					
					$valorizacao = number_format($valorizacao, 2, '.', ',');
					//--------------------------
					
					$posicao = $atl->posicao;
					$clube = $atl->clube;
					//echo $json;
					//----------------------------------------------------------------------
					//echo "Id:  - Apelido: $atl->apelido - Posição: ".$positions[($posicao->id) - 1]." - Preço:  - Status: $atl->status - Clube: $clube->nome - Pontuação esperada: $proximaPontuacao - Valorização: $valorizacao <br> "; 
					?>
					
								<tr>
									<td><?=$atl->id?></td>
									<td><?=$atl->apelido ?></td>
									<td><?=$positions[($posicao->id) - 1]?></td>	
									<td><?=$atl->preco?></td>
									<td><?=$atl->status?></td>
									<td><?=$clube->nome?></td>
									<td><?=$proximaPontuacao >= 0.0?"<font color=\"blue\">$proximaPontuacao</font>":"<font color=\"red\">$proximaPontuacao</font>"?></td>
									<td><?=$valorizacao >= 0.0?"<font color=\"blue\">$valorizacao</font>":"<font color=\"red\">$valorizacao</font>"?></td>
								</tr>								
					<?php				
					
				}
				
			}
			?>
				</tbody>
				<tfoot>
					<th>ID</th>
					<th>Apelido</th>
					<th>Posicao</th>
					<th>Preco</th>
					<th>Status</th>
					<th>Clube</th>
					<th>Pontuacao esperada</th>
					<th>Valorizacao esperada</th>
				</tfoot>
			</table>
			<?php
			//page with the content I want to grab

			//do stuff with the info with DomDocument() etc

			curl_close($ch);
		}
		catch(Exception $e) 
		{
			header("Location: logout.php");
		}
	}
}

$callCrawler = new WebCrawler();
$callCrawler->crawler();
?>