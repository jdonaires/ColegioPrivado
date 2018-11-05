<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/grado.php';

class GradoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
    $dba = new DBAccess();
    $this->pdo = $dba->get_connection();
	}

  /*Se utiliza para el proceso registrar aula*/
	public function Listar()
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("CALL up_listar_grado()");
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$grado = new Grado();
				$grado->__SET('id_grado', $r->id_grado);
				$grado->__SET('grado', $r->grado);

				$result[] = $grado;
			}
			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
