<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/competencia.php');

class CompetenciaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Competencias $competencias)
	{
		try
		{
		$statement = $this->pdo->prepare("call up_insertar_competencia(?,?,?)");
		$statement->bindParam(1,$competencias->__GET('id'));
		$statement->bindParam(2,$competencias->__GET('nombreCompetencia'));
		$statement->bindParam(3,$competencias->__GET('numeroCo'));

    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

}

?>
