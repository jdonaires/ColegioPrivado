<?php
require_once 'arcalificacion_nota.php';
require_once 'registro_calificacion.php';
require_once 'estudiante.php';

class Alumno_rcalificacion
{
  private $id_arcalificacion;
  private $id_rcalificacion;
  private $id_estudiante;
  private $nota_final;

  public function _CONSTRUCT()
  {
    $this->id_arcalificacion = new Arcalificacion_nota();
		$this->id_rcalificacion = new Registro_calificacion();
		$this->id_estudiante = new Estudiante();
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
