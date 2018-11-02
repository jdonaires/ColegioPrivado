<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/curso_competencia.php');

class Curso_competenciaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Curso_competencia $curso_competencia)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_insertar_curso_competencia(?,?)");
    $statement->bindParam(1,$curso_competencia->__GET('id_curso'));
		$statement->bindParam(2,$curso_competencia->__GET('id_competencia'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Curso_competencia $curso_competencia)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("CALL up_listar_curso_competencia(?)");
			$statement->bindParam(1,$curso_competencia->__GET('id_curso'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$ccompetencia = new Curso_competencia();

				$ccompetencia->__SET('id_ccompetencia', $r->id_ccompetencia);
				$ccompetencia->__GET('id_competencia')->GET('id');
				$ccompetencia->__SET('id_curso', $r->id_curso);

				$result[] = $ccompetencia;
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
