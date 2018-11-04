<?php
require_once '../DAL/DBAcces.php';
require_once '../BOL/secciones.php';

class seccionDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
		$dba = new DBAccess();
		$this->pdo = $dba->get_connection();
	}

	public function Registrar(Seccion $seccion)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_seccion(?,?)");
	    $statement->bindParam(1,$seccion->__GET('id_seccion'));
			$statement->bindParam(2,$seccion->__GET('seccion'));
	    $statement -> execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Bsucar(Seccion $seccion)
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("CALL up_buscar_seccion(?)");
			$statement->bindParam(1, $seccion->__GET('id_seccion'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$seccion = new Seccion();
				$seccion->__SET('id_seccion', $r->id_seccion);
				$seccion->__SET('seccion', $r->seccion);

				$result[] = $seccion;
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
