<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/aula.php';

class AulaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Aula $aula)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_aula(?,?,?,?,?,?,?)");
			$statement->bindParam(1, $aula->__GET('descripcion'));
			$statement->bindParam(2, $aula->__GET('numero_aula'));
			$statement->bindParam(3, $aula->__GET('numero_alumno'));
			$statement->bindParam(4, $aula->__GET('turno'));
			$statement->bindParam(5, $aula->__GET('id_docente'));
		  $statement->bindParam(6, $aula->__GET('id_grado'));
			$statement->bindParam(7, $aula->__GET('id_seccion'));
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
			$statement = $this->pdo->prepare("call up_listar_aula()");
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$aula = new Aula();

		    $aula->__SET('id_aula', $r->id_aula);
				$aula->__SET('descripcion', $r->descripcion);
				$aula->__SET('numero_aula', $r->numero_aula);
				$aula->__SET('numero_alumno', $r->numero_alumno);
        $aula->__SET('turno', $r->turno);
				$aula->__GET('id_docente')->__GET('id_persona')->__SET('nombres', $r->nombre);
				$aula->__GET('id_docente')->__GET('id_persona')->__SET('apellidosP', $r->apellido_paterno);
				$aula->__GET('id_docente')->__GET('id_persona')->__SET('apellidosM', $r->apellido_materno);
				$aula->__GET('id_grado')->__SET('grado', $r->grado);
				$aula->__GET('id_seccion')->__SET('seccion',$r->seccion);

				$result[] = $aula;
			}

			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
