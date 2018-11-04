<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/competencia.php';

class CompetenciaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
		$dba = new DBAccess();
		$this->pdo = $dba->get_connection();
	}

	public function Registrar(Competencia $competencia)
	{
		try
		{
			$statement = $this->pdo->prepare("call up_insertar_competencia(?,?,?)");
			$statement->bindParam(1, $competencia->__GET('id_competencia'));
			$statement->bindParam(2, $competencia->__GET('nombre_competencia'));
			$statement->bindParam(3, $competencia->__GET('numero_co'));
	    $statement -> execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
