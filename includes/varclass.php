<?php
class variantes{
	public $items;
	
	function addvariante ($artnr, $des, $mod){
		$this->items[$artnr]['des'] = $des;
		$this->items[$artnr]['mod'] = $mod;
	}
	
	function desvariante($artnr){
		return $this->items[$artnr]['des'];
	}
	
	function ordenar(){
		return ksort($this->items);;
	}
	
	function modvariante($artnr){
		return $this->items[$artnr]['mod'];
	}
	
	function cambiamod($artnr, $mod){
		$this->items[$artnr]['mod'] = $mod;
	}
	
	function actualmod(){
	if (count($this->items)>0){
		foreach ($this->items as $id => $elemento){
		$this->items[$id]['mod'] = 0;
		}
		}
	}
	
	function modificando(){
		$resultado = -1;
		if (count($this->items)>0){
		foreach ($this->items as $id => $elemento){
		if ($elemento['mod'] == 1){
			$resultado = $id;
			break;
		}
		}
		}
		return $resultado;
	}
	
	function delvariante($artnr){
		unset($this->items[$artnr]);
	}
	
	function totalvariante() {
		$temp = count($this->items);
		return $temp;
	}
	
	function ultimo() {
		$temp = end($this->items);
		if (!$temp)
		$temp = 1;
		else
		$temp = key($this->items);
		return $temp;
	}
	
	function primero() {
		$temp = reset($this->items);
		if (!$temp)
		$temp = 1;
		else
		$temp = key($this->items);
		return $temp;
	}
	
	function reset(){
		return reset($this->items);
	}
	
	function variante(){
		return current($this->items);
	}
	
	function index(){
		return key($this->items);
	}
	
	function next(){
		return next($this->items);
	}
	
	function prox($artnr){
		$this->items[$artnr];
		$i = 0;
		$temp = false;
		while ((!$temp) and ($i <= $this->ultimo($this->items))) {
			$artnr++;
			$i++;
			$temp = isset($this->items[$artnr]);
		}
		
		return $artnr;
	}
	
	function ant($artnr){
		$this->items[$artnr];
		$temp = false;
		while (!$temp) {
			$artnr--;
			$temp = isset($this->items[$artnr]);
		}
		
		return $artnr;
	}
}

class zonasgeovar{
	public $items;
	
	function addgeo ($artnr, $zona, $variante){
		$this->items[$variante][$artnr]['zona'] = $zona;
		$this->items[$variante][$artnr]['del'] = 0;
	}
	
	function arrzonasgeovar($variante){
		return $this->items[$variante];
	}
	
	function desgeo($artnr, $variante){
		return $this->items[$variante][$artnr]['zona'];
	}
	
	function delgeo($artnr, $variante){
		$this->items[$variante][$artnr]['del'] = 1;
	}
	
	function nodelgeo($artnr, $variante){
		$this->items[$variante][$artnr]['del'] = 0;
	}
	
	function delgeovar($variante){
		unset($this->items[$variante]);
	}
	
	function totalgeovar($variante) {
		return count($this->items[$variante]);
	}
	
	function totaldelgeo($variante) {
		$i = 0;
		$cant = 0;
		$temparr = $this->items[$variante];
		reset($temparr);
		while ($i < count($temparr)) {
			$item = current($temparr);
			if ($item['del'] == 1)
			$cant++;
			next($temparr);
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

class locacionesvar{
	public $items;

	function additem ($artnr, $variante, $des, $num){
		$this->items[$variante][$artnr]['num'] += $num;
		$this->items[$variante][$artnr]['des'] = $des;
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
	
	function setquantity($artnr, $variante, $num){
		$this->items[$variante][$artnr]['num'] = $num;
	}
	
	function dellocvar($variante){
		unset($this->items[$variante]);
	}
	
	function delitem ($artnr, $variante, $num){
		$this->items[$variante][$artnr]['num'] -= $num;
	}
	
	function deleteitem($artnr, $variante){
		unset($this->items[$variante][$artnr]);
	}

	function totalitem($variante) {
		$temp = count($this->items[$variante]);
		return $temp;
	}
	
	function totalvar() {
		$temp = count($this->items);
		return $temp;
	}
	
	function item($variante){
		return $this->items[$variante];
	}
	
	function ultimo() {
		$temp = end($this->items);
		if (!$temp)
		$temp = 1;
		else
		$temp = key($this->items);
		return $temp;
	}
}
?>