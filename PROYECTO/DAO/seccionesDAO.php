<?php
require_once("../DAL/DBAcces.php");
require_once('../BOL/secciones.php');

class seccionesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Secciones $secciones)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL REGISTRAR_SECCIONES(?,?)");
    $statement->bindParam(1,$secciones->__GET('id_seccion'));
		$statement->bindParam(2,$secciones->__GET('seccion'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Secciones $secciones)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("CALL BUSCAR_SECCIONES(?)");
			$statement->bindParam(1,$secciones->__GET('id_seccion'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$sec = new Secciones();

				$sec->__SET('id_seccion', $r->id_seccion);
				$sec->__SET('seccion', $r->seccion);

				$result[] = $sec;
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
