<?php
require_once 'alumno_rcalificacion.php';
require_once 'nota.php';

class Arcalificacion_nota
{
	private $id_arcnotas;
	private $id_arcalificacion;
	private $id_nota;

	ublic function _CONSTRUCT(){
		$this-> id_arcalificacion = new Alumno_rcalificacion();
		$this-> id_nota = new Nota();
	
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