<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/docente.php');

class DocenteDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Docente $docente)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_registrar_docente(?,?,?)");//MODIFICAR NOMBRE DE PROCEDIMIENTO
   		$statement->bindParam(1,$docente->__GET('id_persona'));
		$statement->bindParam(2,$docente->__GET('estado'));
		$statement->bindParam(3,$docente->__GET('id_funcion'));


    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function Listar(Docente $docente)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_docente(?)");//MODIFICAR NOMBRE DE PROCEDIMIENTO
			$statement->bindParam(1,$docente->__GET('id_persona'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$docente = new Docente();

				$docente->__SET('$id_persona', $r->id_persona);
				$docente->__SET('estado', $r->estado);
				$docente->__SET('id_funcion', $r->id_funcion);

				$result[] = $docente;
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
