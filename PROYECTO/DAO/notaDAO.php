<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/nota.php';

class NotaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
		$dba = new DBAccess();
		$this->pdo = $dba->get_connection();
	}

	public function Registrar(Nota $nota)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_nota(?)");
			$statement->bindParam(1 ,$nota->__GET('nota'));
	    $statement -> execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Buscar(Nota $nota)
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("call up_buscar_nota(?)");
			$statement->bindParam(1, $nota->__GET('id_nota'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$nota = new Nota();
				$nota->__SET('id_nota', $r->id_nota);
				$nota->__SET('nota', $r->nota);

				$result[] = $nota;
			}

			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}

?>
