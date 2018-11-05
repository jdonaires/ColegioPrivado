<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/persona.php';

class PersonaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
		$dba = new DBAccess();
		$this->pdo = $dba->get_connection();
	}

	public function Registrar(Persona $persona)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_persona(?,?,?,?,?,?,?,?,?,?)");
	    $statement->bindParam(1, $persona->__GET('nombre'));
			$statement->bindParam(2, $persona->__GET('apellido_paterno'));
			$statement->bindParam(3, $persona->__GET('apellido_materno'));
			$statement->bindParam(4, $persona->__GET('numero_documento'));
			$statement->bindParam(5, $persona->__GET('fecha_nacimiento'));
			$statement->bindParam(6, $persona->__GET('sexo'));
			$statement->bindParam(7, $persona->__GET('direccion'));
			$statement->bindParam(8, $persona->__GET('telefono'));
			$statement->bindParam(9, $persona->__GET('id_tdocumento'));
			$statement->bindParam(10, $persona->__GET('id_ecivil'));
	    $statement -> execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function Listar(Persona $persona)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_listar_persona(?)");
			$statement->bindParam(1,$persona->__GET('id_persona'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$persona = new Persona();

				$persona->__SET('id_persona', $r->id_persona);
				$persona->__SET('nombre', $r->nombre);
				$persona->__SET('apellido_paterno', $r->apellido_paterno);
				$persona->__SET('apellido_materno', $r->apellido_materno);
				$persona->__SET('numero_documento', $r->numero_documento);
				$result[] = $persona;
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
