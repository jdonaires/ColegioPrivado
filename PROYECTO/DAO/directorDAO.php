<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/director.php');

class DirectorDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Director $director)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_director(?,?,?,?,?,?,?,?,?,?,?,?)");
	    	$statement->bindParam(1,$director->__GET('id_persona')->__GET('nombre'));
			$statement->bindParam(2,$director->__GET('id_persona')->__GET('apellido_paterno'));
			$statement->bindParam(3,$director->__GET('id_persona')->__GET('apellido_materno'));
			$statement->bindParam(4,$director->__GET('id_persona')->__GET('numero_documento'));
			$statement->bindParam(5,$director->__GET('id_persona')->__GET('fecha_nacimiento'));
			$statement->bindParam(6,$director->__GET('id_persona')->__GET('sexo'));
			$statement->bindParam(7,$director->__GET('id_persona')->__GET('direccion'));
			$statement->bindParam(8,$director->__GET('id_persona')->__GET('telefono'));
			$statement->bindParam(9,$director->__GET('id_persona')->__GET('id_tdocumento'));
			$statement->bindParam(10,$director->__GET('id_persona')->__GET('id_ecivil'));
			$statement->bindParam(11,$director->__GET('id_funcion'));
			$statement->bindParam(12,$director->__GET('estado'));

			
    		$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Director $director)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_director(?)");
			$statement->bindParam(1,$director->__GET('id_persona'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$director = new Director();

				
				$director->__GET('id_persona')->__SET('id_persona', $r->id_persona);
				$director->__GET('id_persona')->__SET('nombre', $r->nombre);
				$director->__GET('id_persona')->__SET('apellido_paterno', $r->apellido_paterno);
				$director->__GET('id_persona')->__SET('apellido_materno', $r->apellido_materno);
				$director->__GET('id_persona')->__SET('numero_documento', $r->numero_documento);
				$director->__GET('id_persona')->__SET('sexo', $r->sexo);
				$director->__GET('id_persona')->__SET('fecha_nacimiento', $r->fecha_nacimiento);
				$director->__GET('id_persona')->__SET('direccion', $r->direccion);
				$director->__GET('id_persona')->__SET('telefono', $r->telefono);
				$sec->__SET('id_funcion', $r->id_funcion);
				$sec->__SET('estado', $r->estado);

				$result[] = $director;
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
