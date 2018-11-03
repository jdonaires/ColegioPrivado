<?php
require_once 'grado.php';
require_once 'curso.php';

class Grado_curso
{
  private $id_gcurso;
  private $id_grado;
  private $id_curso;

  public function _CONSTRUCT(){
    $this->id_grado = new Grado();
    $this->id_curso = new Curso();
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
