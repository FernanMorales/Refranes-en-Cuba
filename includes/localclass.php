<?php
class zonasgeo{
	public $items;
	
	function addgeo ($artnr, $zona){
		$this->items[$artnr]['zona'] = $zona;
		$this->items[$artnr]['del'] = 0;
	}
	
	function desgeo($artnr){
		return $this->items[$artnr]['zona'];
	}
	
	function delgeo($artnr){
		$this->items[$artnr]['del'] = 1;
	}
	
	function nodelgeo($artnr){
		$this->items[$artnr]['del'] = 0;
	}
	
	function isdelgeo($artnr){
		if ($this->items[$artnr]['del'] == 1)
		$respuesta = true;
		else
		$respuesta = false;
		return $respuesta;
	}
	
	function totalgeo() {
		return count($this->items);
	}
	
	function totaldelgeo() {
		$i = 0;
		reset($this->items);
		while ($i < count($this->items)) {
			$item = current($this->items);
			if ($item['del'] == 1)
			$cant++;
			next($this->items);
			$i++;
		}
		return $cant;
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
}

class locaciones{
	public $items;

	function additem ($artnr, $des, $num){
		$this->items[$artnr]['num'] += $num;
		$this->items[$artnr]['des'] = $des;
	}
	
	function unomas ($artnr, $num){
		$this->items[$artnr]['num'] += $num;
	}
	
	function index(){
		return key($this->items);
	}
	
	function next(){
		return next($this->items);
	}
	
	function reset(){
		return reset($this->items);
	}
	
	function ordenar(){
		return ksort($this->items);
	}
	
	function setquantity($artnr, $num){
		$this->items[$artnr]['num'] = $num;
	}
	
	function delitem ($artnr, $num){
		$this->items[$artnr]['num'] -= $num;
	}
	
	function deleteitem($artnr){
		unset($this->items[$artnr]);
	}

	function totalitem() {
		return count($this->items);
	}
	
	function item(){
		return current($this->items);
	}
}
?>