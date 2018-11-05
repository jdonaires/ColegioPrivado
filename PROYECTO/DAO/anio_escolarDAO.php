<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/anio_escolar.php');

class Anio_escolarDAO
{

	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Anio_escolar $anio_escolar)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_registrar_anio_escolar(?,?,?,?,?,?)");
      	$statement->bindParam(1,$anio_escolar->__GET('id_escolar'));
		$statement->bindParam(2,$anio_escolar->__GET('codigo'));
		$statement->bindParam(3,$anio_escolar->__GET('descripcion'));
		$statement->bindParam(4,$anio_escolar->__GET('fecha_inicioDATE'));
		$statement->bindParam(5,$anio_escolar->__GET('fecha_finDATE'));
		$statement->bindParam(6,$anio_escolar->__GET('estado'));

    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Anio_escolar $anio_escolar)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_anio_escolar(?)");
			$statement->bindParam(1,$anio_escolar->__GET('id_aescolar'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$anio_escolar = new Anio_escolar();

				$anio_escolar->__SET('id_escolar', $r->id_escolar);
				$anio_escolar->__SET('codigo', $r->codigo);
				$anio_escolar->__SET('descripcion', $r->descripcion);
				$anio_escolar->__SET('fecha_inicioDATE', $r->fecha_inicioDATE);
				$anio_escolar->__SET('fecha_finDATE', $r->fecha_finDATE);
				$anio_escolar->__SET('estado', $r->estado);


				$result[] = $anio_escolar;
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
