<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/estudiante.php';

class EstudianteDAO
{
	private $pdo;

	public function __construct()
	{
		$dba = new DBAccess();
		$this->pdo = $dba->get_connection();
	}

	public function Registrar(Estudiante $estudiante)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_estudiante(?,?)");
			$statement->bindParam(1, $estudiante->__GET('id_persona')->__GET('id_persona'));
			$statement->bindParam(2, $estudiante->__GET('codigo_estudiante'));
			$statement->execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Estudiante $estudiante)
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("call up_listar_estudiante(?)");
			$statement->bindParam(1, $estudiante->__GET('id_persona')->__GET('id_persona'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$estudiante = new Estudiante();
				$estudiante->__GET('id_persona')->__SET('id_persona', $r->id_persona);
				$estudiante->__SET('codigo_estudiante', $r->codigo_estudiante);

				$result[] = $estudiante;
			}

			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}

?>
