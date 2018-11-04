<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/persona.php');

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
		$statement = $this->pdo->prepare("CALL up_insertar_persona(?,?,?,?,?,?,?,?,?,?)");
    	$statement->bindParam(1,$persona->__GET('nombres'));
		$statement->bindParam(2,$persona->__GET('apellidoP'));
		$statement->bindParam(3,$persona->__GET('apellidoM'));
		$statement->bindParam(4,$persona->__GET('numeroD'));
		$statement->bindParam(5,$persona->__GET('fechaNac'));
		$statement->bindParam(6,$persona->__GET('sexo'));
		$statement->bindParam(7,$persona->__GET('direccion'));
		$statement->bindParam(8,$persona->__GET('telefono'));
		$statement->bindParam(9,$persona->__GET('id_tDocumento')->__GET('id_tDocumento'));
		$statement->bindParam(10,$persona->__GET('id_eCivil')->__GET('id_eCivil'));
    	$statement -> execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function Listar_Personas()
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("call up_consulta_Persona()");
			$statement->execute();
			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$per = new Persona();
				$per->__SET('nombre', $r->nombre);
				$per->__SET('apellido_materno', $r->apellido_materno);
				$per->__SET('apellido_paterno', $r->apellido_paterno);
				$per->__SET('fecha_nacimiento', $r->fecha_nacimiento);
				$per->__SET('numero_documento', $r->numero_documento);
				$per->__GET('id_tDocumento') ->__SET('tipo_documento', $r->tipo_documento);
				$per->__GET('id_eCivil') ->__SET('estado_civil', $r->estado_civil);
				$result[] = $per;
			}
			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	/*
	public function Listar(Persona $persona)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_persona(?)");
			$statement->bindParam(1,$persona->__GET('dni'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$per = new Persona();

				$per->__SET('id_persona', $r->id_persona);
				$per->__SET('nombres', $r->nombres);
				$per->__SET('apellidos', $r->apellidos);
				$per->__SET('dni', $r->dni);

				$result[] = $per;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}*/
}

?>
