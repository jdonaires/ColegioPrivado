<?php
require_once 'docentes.php';
require_once 'grado.php';
require_once 'seccion.php';

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

	public function __construct()
	{
		$this->id_docente = new Docente();
		$this->id_grado = new Grado();
		$this->id_seccion = new Seccion();
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
