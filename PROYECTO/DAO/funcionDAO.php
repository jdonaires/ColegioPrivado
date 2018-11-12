?php
require_once '../DAL/DBAccess.php';
require_once '../BOL/funcion.php';

class FuncionDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Funcion $funcion)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_insertar_funcion(?,?)");

    	$statement->bindParam(1,$funcion->__GET('id_funcion'));
		$statement->bindParam(2,$funcion->__GET('funcion'));


		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Funcion $funcion)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_listar_funcion(?)");
			$statement->bindParam(1,$funcion->__GET('id_funcion'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
							$funcion = new Funcion();

		    $funcion->__SET('id_funcion', $r->id_funcion);
			  $funcion->__SET('funcion', $r->funcion);


				$result[] = $funcion;
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
