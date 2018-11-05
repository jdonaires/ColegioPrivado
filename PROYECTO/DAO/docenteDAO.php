<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/docente.php');

class InstitucionesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Instituciones $instituciones)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL PROC_REGISTRAR_INSTITUCIONES(?,?,?)");
   		$statement->bindParam(1,$docentes->__GET('id_persona'));
			$statement->bindParam(2,$docentes->__GET('estado'));
			$statement->bindParam(3,$docentes->__GET('id_funcion'));


    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function Listar(Docentes $docentes)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_id_curso(?)");
			$statement->bindParam(1,$id_persona->__GET('id_persona'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$per = new Persona();

				$per->__SET('$id_persona', $r->id_persona);
				$per->__SET('estado', $r->estado);

				$result[] = $per;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
*/
}

?>
