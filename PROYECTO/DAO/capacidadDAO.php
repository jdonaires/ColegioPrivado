<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/capacidad.php';

class CapacidadDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

  /*Registrar capacidad*/
	public function Registrar(Capacidad $capacidad)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_capacidad(?,?)");
			$statement->bindParam(1, $capacidad->__GET('capacidad'));
			$statement->bindParam(2, $capacidad->__GET('id_competencia')->__GET('id_competencia'));
			$statement -> execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

  /*Listar las capacidades de una competencia*/
	public function ListarCapacidadCompetencia(Capacidad $capacidad)
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("CALL up_listar_capacidad_competencia(?)");
			$statement->bindParam(1, $capacidad->__GET('id_competencia')->__GET('id_competencia'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$capacidad = new Capacidad();
				$capacidad->__SET('id_capacidad', $r->id_capacidad);
				$capacidad->__SET('capacidad', $r->capacidad);
				$capacidad->__GET('id_competencia')->__SET('id_competencia', $r->id_competencia);

				$result[] = $capacidad;
			}

			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
