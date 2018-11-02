<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/arcalificacion_nota.php');

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
		$statement = $this->pdo->prepare("CALL up_insertar_arcalificacion_nota(?,?,?)");
    $statement->bindParam(1,$arcalificacion_nota->__GET('id_arcnotas'));
		$statement->bindParam(2,$arcalificacion_nota->__GET('id_arcalificacion'));
		$statement->bindParam(3,$arcalificacion_nota->__GET('id_nota'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Arcalificacion_nota $arcalificacion_nota)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_arcalificacion_nota(?,
				?,?)");
			$statement->bindParam(1,$arcalificacion_nota->__GET('id_arcnotas'));
			$statement->bindParam(2,$arcalificacion_nota->__GET('id_arcalificacion'))
			$statement->bindParam(2,$arcalificacion_nota->__GET('id_nota'))

			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$not = new Arcalificacion_nota();

				$not->__SET('id_arcnotas', $r->id_arcnotas);
				$not->__SET('id_arcalificacion', $r->id_arcalificacion);
				$not->__SET('id_nota', $r->id_nota);
			

				$result[] = $not;
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
