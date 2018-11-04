<?php
require_once 'persona.php';

class Estudiante
{
	private $id_persona;
	private $codigo_estudiante;

	// Constructor
	public function __CONSTRUCT()
	{
		$this->id_persona = new Persona();
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
