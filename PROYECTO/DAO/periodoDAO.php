<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/periodo.php';

class PeriodoDAO
{
  private $pdo;

  public function __CONSTRUCT()
  {
    $dba = new DBAccess();
    $this->pdo = $dba->get_connection();
  }

  /*Registrar Periodo*/
  public function Registrar(Periodo $periodo)
  {
    try
    {
      $statement = $this->pdo->prepare("CALL up_registrar_periodo(?,?)");
      $statement->bindParam(1, $periodo->__GET('id_periodo'));
      $statement->bindParam(2, $periodo->__GET('periodo'));
      $statement -> execute();
    }  catch (Exception $e)
    {
      die($e->getMessage());
    }
  }


  public function Listar(Periodo $periodo)
  {
    try
    {
      $result = array();
      $statement = $this->pdo->prepare("CALL up_listar_periodo_registro_calificacion(?)");
      $statement->bindParam(1, $periodo->__GET("id_periodo"));
        $statement->execute();

        foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
        {
          $periodo = new Periodo();
          $periodo->__SET('id_periodo', $r->id_periodo);
          $periodo->__SET('periodo', $r->periodo);

          $result[] = $periodo;
        }

        return $result;
      } catch(Exception $e)
      {
        die($e->getMessage());
      }
    }
  }
?>
