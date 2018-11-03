<?php
class Estado_civil
{
	private $id_ecivil;
	private $estado_civil;

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
