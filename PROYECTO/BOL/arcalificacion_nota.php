<?php
require_once 'alumno_rcalificacion.php';
require_once 'nota.php';

class Arcalificacion_nota
{
	private $id_arcnota;
	private $id_arcalificacion;
	private $id_nota;

	public function _CONSTRUCT()
	{
		$this->id_arcalificacion = new Alumno_rcalificacion();
		$this->id_nota = new Nota();
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
