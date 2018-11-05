<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/estado_civil.php';

class Estado_civilDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
		$dba = new DBAccess();
		$this->pdo = $dba->get_connection();
	}

	public function Registrar(Estado_civil $estado_civil)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_estado_civil(?)");
	    $statement->bindParam(1, $estado_civil->__GET('estado_civil'));
	    $statement -> execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Estado_civil $estado_civil)
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("call up_listar_estado_civil(?)");
			$statement->bindParam(1, $estado_civil->__GET('estado_civil'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$estado_civil = new Estado_civil();
				$estado_civil->__SET('id_ecivil', $r->id_ecivil);
				$estado_civil->__SET('estado_civil', $r->estado_civil);

				$result[] = $estado_civil;
			}

			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}

?>

?>
