<?php 
class ForMath
{
	public function projecaoDePontuacao($pontuacaoConhecida){
		$fMath = new ForMath();
		$matches = count($pontuacaoConhecida->medias);		
		$base = $this->triangular($matches);
		$probability = 0.0;
		for ($i = 0; $i < $matches; $i++){
			$weight = ($i + 1.0) / $base;
			$value = $pontuacaoConhecida->medias[$i] * $weight;
			$probability = $probability + $value;
		}
		return $probability;
	}

	public function triangular($matches){		
		if($matches > 0.0)
			return $matches + $this->triangular($matches - 1.0);
		else
			return 1.0;
	}
	
	public function previsaoDePontuacao($proximaPontuacao, $medias)
	{
		return $proximaPontuacao - $medias->medias[0];	
	}
}
?>