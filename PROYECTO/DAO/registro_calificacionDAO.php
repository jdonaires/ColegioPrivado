<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/registro_calificacion.php';

class Registro_calificacionDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
		$dba = new DBAccess();
		$this->pdo = $dba->get_connection();
	}

	public function Registrar(Registro_calificacion $registro_calificacion)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_registro_calificacion(?,?,?,?,?,?)");
			$statement->bindParam(1,$registro_calificacion->__GET('fecha'));
			$statement->bindParam(2,$registro_calificacion->__GET('hora'));
			$statement->bindParam(3,$registro_calificacion->__GET('id_periodo')->__GET('id_periodo'));
			$statement->bindParam(4,$registro_calificacion->__GET('id_grado')->__GET('id_grado'));
			$statement->bindParam(5,$registro_calificacion->__GET('id_seccion')->__GET('id_seccion'));
			$statement->bindParam(6,$registro_calificacion->__GET('id_docente')->__GET('id_docente'));
			$statement->execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Buscar(Registro_calificacion $registro_calificacion)
	{
		try
		{
			$result = array();
			$statement = $this->pdo->prepare("call up_buscar_registro_calificacion(?)");
			$statement->bindParam(1, $registro_calificacion->__GET('id_rcalificacion'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$registro_calificacion = new Registro_calificacion();
				$registro_calificacion->__SET('id_rcalificacion', $r->id_rcalificacion);
				$registro_calificacion->__SET('fecha', $r->fecha);
				$registro_calificacion->__SET('hora', $r->hora);
				$registro_calificacion->__GET('id_periodo')->__SET('id_periodo', $r->id_periodo);
				$registro_calificacion->__GET('id_grado')->__SET('id_grado', $r->id_grado);
				$registro_calificacion->__GET('id_seccion')->__SET('id_seccion', $r->id_seccion);
				$registro_calificacion->__GET('id_docente')->__SET('id_docente', $r->id_docente);

				$result[] = $registro_calificacion;
			}

			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}

?>
