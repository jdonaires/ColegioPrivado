<?php
require_once('../DAL/DBAccess.php');

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

    $statement = $this->pdo->prepare("CALL up_insertar_periodo(?,?)");
    $statement->bindParam(1,$periodos->__GET('id_periodo'));
    $statement->bindParam(2,$periodos->__GET('descripcion'));
    $statement -> execute();
  }  catch (Exception $e)
  {
    die($e->getMessage());
  }
}

/*Listar Periodo*/
 public function ListarPeriodoRegistroCalificaciones(Periodo $periodo)
 {
   try
   {
     $result = array();
     $statement = $this->pdo->prepare("CALL up_buscar_periodo(?)");
     $statement->bindParam(1, $periodo->__GET("id_periodo");
     $statement->execute();

     foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
     {
       $periodo = new Periodo();
       $periodo->__SET('id_periodo', $r->id_periodo);
       $periodo->__SET('descripcion', $r->descripcion);

       $result[] = $periodo;
     }

     return $result;
   }
   catch(Exception $e)
   {
     die($e->getMessage());
   }
 }
}
 ?>
