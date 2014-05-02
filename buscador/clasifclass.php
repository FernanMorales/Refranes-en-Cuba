<?php
class listaref{
	public $items;
	
	function addref ($artnr, $des){
		$this->items[$artnr]['des'] = $des;
		$this->items[$artnr]['num'] += 1;
	}
	
	function desref($artnr){
		return $this->items[$artnr]['des'];
	}
	
	function total() {
		return count($this->items);
	}
	
function ordenar(){
		return asort($this->items);
	}
	
	function reset(){
		return reset($this->items);
	}
	
	function zona(){
		return current($this->items);
	}
	
	function index(){
		return key($this->items);
	}
	
	function next(){
		return next($this->items);
	}
	
	function buscar($palabra, $fon, $resultado){
		$aux = new listaref;
		$aux->items = $this->items;
		$i = 0;
		reset($aux->items);
		while ($i < $aux->total()){
			$artnr = $aux->index();
			$des = $aux->desref($artnr);
			if ($fon){
				$des = metaphone($des);
				$palabra = metaphone($palabra);
			}
			if (stristr($des, $palabra))
			$resultado[$aux->index()]['num'] += 1;
			else
			$resultado[$aux->index()]['num'] += 0;
			$aux->next();
			$i += 1;
		}
		return $resultado;
	}

}
?>