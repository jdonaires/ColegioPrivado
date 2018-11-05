<?php
class Tipo_documento
{
	private $id_tdocumento;
	private $tipo_documento;

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
