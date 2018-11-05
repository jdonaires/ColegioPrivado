<?php
class Anio_escolar
{

	private $id_aescolar;
	private $codigo;
	private $descripcion;
	private $fecha_inicioDATE;
	private $fecha_finDATE;
	private $estado;


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
