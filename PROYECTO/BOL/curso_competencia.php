<?php
require_once 'competencia.php';
require_once 'curso.php';

class Curso_competencia
{
	private $id_ccompetencia;
	private $id_curso;
	private $id_competencia;

	public function _CONSTRUCT()
	{
		$this->id_curso = new Curso();
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
