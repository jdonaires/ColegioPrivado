<?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/alumno_rcalificacion.php';

class Alumno_rcalificacionDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
		$dba = new DBAccess();
		$this->pdo = $dba->get_connection();
	}

	public function Registrar(Alumno_rcalificacion $alumno_rcalificacion)
	{
		try
		{
			$statement = $this->pdo->prepare("CALL up_registrar_alumno_rcalificacion(?,?,?)");
			$statement->bindParam(1, $alumno_rcalificacion->__GET('id_rcalificacion'));
			$statement->bindParam(2, $alumno_rcalificacion->__GET('id_estudiante'))
			$statement->bindParam(3, $alumno_rcalificacion->__GET('nota_final'));
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
			$statement = $this->pdo->prepare("CALL up_listar_alumno_rcalificacion()");
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alumno_rcalificacion = new Alumno_rcalificacion();
				$alumno_rcalificacion->__SET('id_arcalificacion', $r->id_arcalificacion);
				$alumno_rcalificacion->__GET('id_rcalificacion')->__SET('id_rcalificacion',$r->id_rcalificacion);
				$alumno_rcalificacion->__GET('id_estudiante')->__SET('id_estudiante'), $r->id_estudiante);
				$alumno_rcalificacion->__SET('nota_final', $r->nota_final);

				$result[] = $alumno_rcalificacion;
			}

			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
