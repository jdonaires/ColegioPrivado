<?php

class Aula
{
	private $id_aula;
	private $descripcion;
	private $numero_aula;
	private $numero_alumno;
	private $turno;
	private $id_docente;
	private $id_grado;
	private $id_seccion;

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
