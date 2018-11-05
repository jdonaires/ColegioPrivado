<?php
class Grado
{
	private $id_grado;
	private $grado;

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
