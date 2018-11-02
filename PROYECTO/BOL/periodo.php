<?php
class Periodo
{
  private $id_periodo;
  private $periodo;

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
