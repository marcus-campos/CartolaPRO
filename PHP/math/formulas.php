<?php 
class ForMath
{
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
	
	function previsaoDePontuacao($medias)
	{
		return $proximaPontuacao = makeProbableNextScore($medias->medias);		
	}
}
?>