<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/docente.php';

class DocenteDAO
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
			$statement = $this->pdo->prepare("CALL up_listar_docente()");
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$docente = new Docente();
				$docente->__GET('id_persona')->__SET('id_persona', $r->id_persona);
				$docente->__GET('id_persona')->__SET('nombre', $r->nombre);
				$docente->__GET('id_persona')->__SET('apellido_paterno', $r->apellido_paterno);
				$docente->__GET('id_persona')->__SET('apellido_materno', $r->apellido_materno);

				$result[] = $docente;
			}

			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
