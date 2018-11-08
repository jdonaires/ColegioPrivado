<?php
require_once 'funcion.php';
require_once 'persona.php';
/*require aulas.php;
require registro_calificacion.php;
*/
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
