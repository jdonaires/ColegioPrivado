<?php
class Funcion1
{
	/*Funcion es una tabla independiente*/
	private $id_funcion;
	private $funcion;

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
