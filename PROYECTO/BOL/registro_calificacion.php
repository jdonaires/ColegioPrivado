<?php 
require 'alumnos_rcalificacion.php';
require 'periodos.php';
require 'grados_curso.php';
require 'seccion.php';
require 'docentes.php';

class Registro_calificacion
{
	private $id_rcalificacion;
	private $fecha;
	private $hora;
	private $id_periodo;
	private $id_grado;
	private $id_seccion;
	private $id_docente;

	public function __construct(){
		$this->id_rcalificacion = new Alumnos_rcalificacion();
		$this->id_periodo = new Periodos();
		$this->id_grado = new grados_cursos();
		$this->id_seccion = new Seccion();
		$this->id_docente = new Docente();
		
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