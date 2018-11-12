<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/tipo_documento.php');

class Tipo_documentoDAO
{
    private $pdo;
    public function __construct()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}
    public function Listar(Tipo_documento $tipo_documento)
    {
        try
        {
            $result = array();

            $statement = $this->pdo->prepare("call up_listar_tipos_documentos(?)");
            $statement->bindParam(1,$tipo_documento->__GET('id_tdocumento'));
            $statement->execute();

            foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $tipo_documento = new Tipo_documento();
                $tipo_documento->__SET('id_tdocumento', $r->id_tdocumento);
                $tipo_documento->__SET('tipo_documento', $r->tipo_documento);

                $result[] = $tipo_documento;
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
