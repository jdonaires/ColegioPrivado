<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/estudiante.php');

class EstudianteDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Estudiante $estudiante)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_estudiante(?,?,?,?,?,?,?,?,?,?)");
	    	$statement->bindParam(1,$estudiante->__GET('id_persona')->__GET('nombre'));
			$statement->bindParam(2,$estudiante->__GET('id_persona')->__GET('apellido_paterno'));
			$statement->bindParam(3,$estudiante->__GET('id_persona')->__GET('apellido_materno'));
			$statement->bindParam(4,$estudiante->__GET('id_persona')->__GET('numero_documento'));
			$statement->bindParam(5,$estudiante->__GET('id_persona')->__GET('fecha_nacimiento'));
			$statement->bindParam(6,$estudiante->__GET('id_persona')->__GET('sexo'));
			$statement->bindParam(7,$estudiante->__GET('id_persona')->__GET('direccion'));
			$statement->bindParam(8,$estudiante->__GET('id_persona')->__GET('telefono'));
			$statement->bindParam(9,$estudiante->__GET('id_persona')->__GET('id_tdocumento'));
			$statement->bindParam(10,$estudiante->__GET('id_persona')->__GET('id_ecivil'));
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

			$statement = $this->pdo->prepare("call up_listar_estudiante()");
			$statement -> execute();


			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$est = new Estudiante();

				$est->__SET('codigo_estudiante', $r->codigo_estudiante);
				$est->__GET('id_persona')->__SET('id_persona', $r->id_persona);
				$est->__GET('id_persona')->__SET('nombre', $r->nombre);
				$est->__GET('id_persona')->__SET('apellido_paterno', $r->apellido_paterno);
				$est->__GET('id_persona')->__SET('apellido_materno', $r->apellido_materno);
				$est->__GET('id_persona')->__SET('numero_documento', $r->numero_documento);
				$est->__GET('id_persona')->__SET('sexo', $r->sexo);
				$est->__GET('id_persona')->__SET('fecha_nacimiento', $r->fecha_nacimiento);
				$est->__GET('id_persona')->__SET('direccion', $r->direccion);
				$est->__GET('id_persona')->__SET('telefono', $r->telefono);

				$result[] = $est;
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
