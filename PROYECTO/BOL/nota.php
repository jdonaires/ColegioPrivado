<?php
class Nota
{
	private $id_nota;
	private $nota;

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
