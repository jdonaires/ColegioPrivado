<?php
require funciones.php;
require personas.php;
require aulas.php;
require registros_calificaciones.php;

class Docente
{
	private $id_persona;
	private $estado;
	private $id_funcion;

public function __CONSTRUCT()
{
		$this->id_persona = new Persona();
		$this->id_funcion = new Funcion();
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
