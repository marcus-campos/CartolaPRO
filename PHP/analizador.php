<?php 
//http://cartolafc.globo.com/mercado/filtrar.json?page=1

$username = "marcus_ultimate@hotmail.com";
$password = "m.ultime987";

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
for($x = 1; $x <= 41; $x++)
{
	curl_setopt($ch, CURLOPT_URL, "http://cartolafc.globo.com/mercado/filtrar.json?page=$x");
	$html = convertToUtf8(curl_exec($ch));
	$jsonObj = json_decode($html);
	$atleta = $jsonObj->atleta;
	
	foreach ($atleta as $atl ) 
	{ 
		curl_setopt($ch, CURLOPT_URL, "http://cartolafc.globo.com/atleta/$atl->id/evolucao/5rodadas.json");
		//--------------------------
		$evolucao = curl_exec($ch);
		$medias = json_decode($evolucao);
		$proximaPontuacao = makeProbableNextScore($medias->medias);		
		$partidasJogadas = count($medias);
		$valorizacao = 0.0;
		if (!$partidasJogadas == 0)
			$valorizacao = $proximaPontuacao - $medias->medias[0];
		//--------------------------
		
		$posicao = $atl->posicao;
		$clube = $atl->clube;
		echo "Id: $atl->id - Apelido: $atl->apelido - Posição: ".$positions[($posicao->id) - 1]." - Preço: $atl->preco - Status: $atl->status - Clube: $clube->nome - Pontuação esperada: $proximaPontuacao - Valorização: $valorizacao <br> "; 
	}

}
//page with the content I want to grab

//do stuff with the info with DomDocument() etc

curl_close($ch);

function convertToUtf8($text) {  
    return mb_convert_encoding($text, 'UTF-8');   
}

function makeProbableNextScore($knowScore){
        $matches = count($knowScore);
        $base = triangular($matches);
        $probability = 0.0;
        for ($i = 0; $i < count($matches); $i++){
            $weight = ($i + 1.0) / $base;
            $value = $knowScore[$i] * $weight;
            $probability = $probability + $value;
		}
        return $probability;
}

function triangular($matches){
        if($matches > 0.0)
            return $matches + triangular($matches - 1.0);
        else
            return 1.0;
}
?>