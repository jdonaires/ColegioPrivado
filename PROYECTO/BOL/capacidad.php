<?php
require_once 'competencia.php';

class Capacidad
{
	private $id_capacidad;
	private $capacidad;
	private $id_competencia;

	public function __CONSTRUCT()
	{
		$this->id_competencia = new Competencia();
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
