<?php
/*require 'grado_curso.php';
require 'curso_competencia.php';
*/
class Curso
{
	private $id_curso;
	private $curso;

public function __CONSTRUCT
{
		/*$this->id_curso = new idCurso();
		$this->curso= new Curso();*/
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
