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

/*Se utiliza para el proceso registrar docente*/

	public function Registrar(Docente $docente)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_docente(?,?,?,?,?,?,?,?,?,?,?,?)");
			$statement->bindParam(1,$docente->__GET('estado'));
			$statement->bindParam(2,$docente->__GET('id_funcion')->__GET('id_funcion'));

			$statement->bindParam(3,$docente->__GET('id_persona')->__GET('nombre'));
			$statement->bindParam(4,$docente->__GET('id_persona')->__GET('apellido_paterno'));
			$statement->bindParam(5,$docente->__GET('id_persona')->__GET('apellido_materno'));
			$statement->bindParam(6,$docente->__GET('id_persona')->__GET('numero_documento'));
			$statement->bindParam(7,$docente->__GET('id_persona')->__GET('fecha_nacimiento'));
			$statement->bindParam(8,$docente->__GET('id_persona')->__GET('sexo'));
			$statement->bindParam(9,$docente->__GET('id_persona')->__GET('direccion'));
			$statement->bindParam(10,$docente->__GET('id_persona')->__GET('telefono'));
			$statement->bindParam(11,$docente->__GET('id_persona')->__GET('id_tdocumento'));
			$statement->bindParam(12,$docente->__GET('id_persona')->__GET('id_ecivil'));

   		$statement -> execute();

		}
			catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


/*Se utiliza para el proceso listar docente*/
	public function Listar(Docente $docente)
		{
			try
			{
				$result = array();

				$statement = $this->pdo->prepare("call up_listar_docente(?)");
				$tempIdPersona = $docente->__GET('id_persona');
				$statement->bindParam(1,$tempIdPersona);
				$statement->execute();

				foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
				{
					$docente = new Docente();

					$docente->__GET('id_persona')->__SET('id_persona', $r->id_persona);
					$docente->__SET('estado', $r->estado);
					$docente->__GET('id_funcion')->__SET('id_funcion', $r->id_funcion);

					$result[] = $docente;
				}

				return $result;
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
		}
}

	class DocenteDAO2
		{
			private $pdo;

			public function __CONSTRUCT()
			{
		    $dba = new DBAccess();
		    $this->pdo = $dba->get_connection();
			}
  /*Se utiliza para el proceso listar aula*/
	/*se le ha asignado docente2 por ser la continuidad*/
	public function Listar2()
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("CALL up_listar_docente2()");
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$docente2 = new Docente();
				$docente2->__GET('id_persona')->__SET('id_persona', $r->id_persona);
				$docente2->__GET('id_persona')->__SET('nombre', $r->nombre);
				$docente2->__GET('id_persona')->__SET('apellido_paterno', $r->apellido_paterno);
				$docente2->__GET('id_persona')->__SET('apellido_materno', $r->apellido_materno);

				$result[] = $docente2;
			}

			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}

?>
