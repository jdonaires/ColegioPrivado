<?php
require_once 'funcion.php';
require_once 'persona.php';
class Director
{
	private $id_persona;
	private $id_funcion;
	private $estado;
	
	public function __CONTRUCT(){
		$this->id_persona = new Persona();
		$this->id_funcion = new funcion();
}
	public function __GET($x)
	{ 
		return $this->$x; 
	}
	public function __SET($x, $y)
	{ 
		return $this->$x = $y; 
	}
}
?>