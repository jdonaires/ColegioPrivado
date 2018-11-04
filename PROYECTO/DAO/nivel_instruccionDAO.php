<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/nivel_instruccion.php';

class Nivel_instruccionDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
		$dba = new DBAccess();
		$this->pdo = $dba->get_connection();
	}

	/*Registrar nivel_instruccion*/
	public function Registrar(Nivel_instruccion $nivel_instruccion)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_nivel_instruccion(?,?)");
	    $statement->bindParam(1, $nivel_instruccion->__GET('id_ninstruccion'));
			$statement->bindParam(2, $nivel_instruccion->__GET('nivel_instruccion'));
	    $statement -> execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	/*Listar nivel_instruccion*/
	public function ListarNivelInstruccionApoderado(Nivel_instruccion $nivel_instruccion)
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("CALL up_listar_nivel_instruccion(?)");
			$statement->bindParam(1, $nivel_instruccion->__GET('id_ninstruccion'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$nivel_instruccion = new Nivel_instruccion();
				$nivel_instruccion->__SET('id_ninstruccion', $r->id_ninstruccion);
				$nivel_instruccion->__SET('nivel_instruccion', $r->nivel_instruccion);

				$result[] = $nivel_instruccion;
			}

			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
