<?php
class Seccion
{
	private $id_seccion;
	private $seccion;

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
