<?php
class Persona
{
	
	private $id_persona;
	private $nombre;
	private $apellido_paterno;
	private $apellido_materno;
	private $numero_documento;
	private $fecha_nacimiento;
	private $sexo;
	private $direccion;
	private $telefono;
	private $id_tdocumento;
	private $id_ecivil;

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
