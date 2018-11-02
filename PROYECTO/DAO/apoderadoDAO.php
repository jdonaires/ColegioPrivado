<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/apoderado.php';

class ApoderadoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
		$dba = new DBAccess();
		$this->pdo = $dba->get_connection();
	}

  /*Registrar apoderado*/
	public function Registrar(Apoderado $apoderado)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_apoderado(?,?,?,?)");
			$statement->bindParam(1, $apoderado->__GET('centro_trabajo'));
			$statement->bindParam(2, $apoderado->__GET('ocupacion'));
			$statement->bindParam(3, $apoderado->__GET('correo'));
			$statement->bindParam(4, $apoderado->__GET('id_ninstruccion')->__GET('id_ninstruccion'));
	    $statement -> execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Apoderado $apoderado)
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("call up_listar_apoderado(?)");
			$statement->bindParam(1,$apoderado->__GET('id_persona'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$apoderado = new Apoderado();
				$apoderado->__GET('id_persona')->__SET('id_persona', $r->id_persona);
				$apoderado->__SET('centro_trabajo', $r->centro_trabajo);
				$apoderado->__SET('ocupacion', $r->ocupacion);
				$apoderado->__SET('correo', $r->correo);
				$apoderado->__GET('id_ninstruccion')->__SET('id_ninstruccion', $r->id_ninstruccion);

				$result[] = $apoderado;
			}
			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
