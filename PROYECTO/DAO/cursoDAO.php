<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/curso.php');

class CursoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Curso $curso)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_registrar_curso(?,?)");
   		$statement->bindParam(1,$curso->__GET('id_curso'));
		$statement->bindParam(2,$curso->__GET('curso'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Curso $curso)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_curso(?)");
			$statement->bindParam(1,$curso->__GET('id_curso'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$curso = new Curso();

				$curso->__SET('id_curso', $r->id_curso);
				$curso->__SET('curso', $r->curso);

				$result[] = $curso;
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
