<?php
require_once 'tipoDocumento.php';
require_once 'estados_civiles.php'
class Persona
{
	private $id_persona;
	private $nombres;
	private $apellidosP;
	private $apellidosM;
	private $numero_ducmento;
	private $fecha_nacimiento;
	private $sexo;
	private $direccion;
	private $telefono;
	private $id_tDocumento;
	private $id_ecivil;

	public function __construct(){
		$this->id_tDocumento = new TipoDocumento();
		$this->id_ecivil = new Estados_civiles();
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