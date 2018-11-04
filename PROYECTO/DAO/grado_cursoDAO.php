<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/grado_curso.php';

class Grado_cursoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
		$dba = new DBAccess();
		$this->pdo = $dba->get_connection();
	}

	public function Registrar(Grado_curso $grado_curso)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_grado_curso(?,?)");
			$statement->bindParam(1, $grado_curso->__GET('id_grado'));
			$statement->bindParam(2, $grado_curso->__GET('id_curso'));
	    $statement -> execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("CALL up_listar_grado_curso()");
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$grado_curso = new Grado_curso();
				$grado_curso->__SET('id_gcurso', $r->id_gcurso);
				$grado_curso->__GET('id_grado')->__SET('id_grado', $r->id_grado);
				$grado_curso->__GET('id_curso')->__SET('id_curso', $r->id_curso);

				$result[] = $grado_curso;
			}

			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
