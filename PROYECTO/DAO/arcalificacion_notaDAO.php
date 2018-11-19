<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/arcalificacion_nota.php';

class Arcalificacion_notaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
		$dba = new DBAccess();
		$this->pdo = $dba->get_connection();
	}

	public function Registrar(Arcalificacion_nota $arcalificacion_nota)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_arcalificacion_nota(?,?,?)");
	    $statement->bindParam(1, $arcalificacion_nota->__GET('id_arcnota'));
			$statement->bindParam(2, $arcalificacion_nota->__GET('id_arcalificacion')->__GET('id_arcalificacion'));
			$statement->bindParam(3, $arcalificacion_nota->__GET('id_nota')->__GET('id_nota'));
	    $statement -> execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Buscar(Arcalificacion_nota $arcalificacion_nota)
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("CALL up_buscar_arcalificacion_nota(?)");
			$statement->bindParam(1, $arcalificacion_nota->__GET('id_arcnotas'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$arcalificacion_nota = new Arcalificacion_nota();
				$arcalificacion_nota->__SET('id_arcnota', $r->id_arcnota);
				$arcalificacion_nota->__GET('id_arcalificacion')->__SET('id_arcalificacion', $r->id_arcalificacion);
				$arcalificacion_nota->__GET('id_nota')->__SET('id_nota', $r->id_nota);

				$result[] = $arcalificacion_nota;
			}

			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
