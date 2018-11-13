<?php
//Hacemos uso de las clases necesarias para este proceso
require_once '../BOL/curso_competencia.php';
require_once '../DAO/curso_competenciaDAO.php';
require_once '../BOL/curso.php';
require_once '../DAO/cursoDAO.php';
require_once '../BOL/competencia.php';
require_once '../DAO/competenciaDAO.php';

//Obtenemos el objeto de cada clase antes mencionadas
$curso = new Curso();
$cursoDAO = new CursoDAO();
$resultado_curso = array();
$resultado_curso = $cursoDAO->Listar($curso);
$competencia = new Competencia();
$competenciaDAO = new CompetenciaDAO();
$resultado_competencia = array();
$resultado_competenciaDAO = $competenciaDAO->Listar($competencia);
$curso_competencia = new Curso_Competencia();
$curso_competenciaDAO = new Curso_CompetenciaDAO();

//Objeto de tipo array
$resultado_curso_competencia = array();

//Obtenemos e ingresamos cada uno de los valores a los campos del formulario
if(isset($_POST['guardar']))
{
	$curso_competencias->__GET('id_competencia')->__SET('id_competencia', 				$_POST['competencia']);
	$curso_competencias->__GET('id_curso')->__SET('id_curso', 							$_POST['curso']);
	$curso_competenciasDAO->Registrar($curso_competencias);
	header('Location: frmRegistroCursosCompetencia.php');
}
?>

<!--Se inicia con la estructura del formulario-->
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Proceso de Registro Competencia</title>
				<!--Plantilla de google para dar stilos-->
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">
        <div class="pure-g">
            <div class="pure-u-1-12">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">

                    <table style="width:500px;" border="0">

                        <tr>
                            <th style="text-align:left;">Curso</th>
                            <td>
																<!--Se realiza la programación del procedimiento listar-->
                                <?php
                            		$curso->__SET('id_curso','');
																	$resultado_curso = $cursoDAO->Listar($curso);
                            	 	?>
                            	 <select name="curso">
                            	 	<?php foreach($resultado_curso as $per):?>
                            	 		<option><?php echo $per->__GET('id_curso')." - ".$per->__GET('curso'); ?></option>
                            	 	<?php endforeach;?>
                            	 </select>
														</td>
                        </tr>
                        
			    
			    
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
