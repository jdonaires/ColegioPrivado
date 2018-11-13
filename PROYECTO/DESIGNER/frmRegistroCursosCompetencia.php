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
                        <tr>
                            <th style="text-align:left;">Competencia</th>
                            <td>
															<!--Se realiza la programación del procedimiento listar-->
                                 <?php
                            			$competencia->__SET('id_competencia','');
																	$resultado_competencia = $competenciaDAO->Listar($competencia);
                            	 	?>
                            	 <select name="curso">
                            	 	<?php foreach($resultado_competencia as $per):?>
                            	 		<option><?php echo $per->__GET('id_competencia')." - ".$per->__GET('competencia')." - Numero de competencia: ".$per->__GET('numero_co'); ?></option>
                            	 	<?php endforeach;?>
                            	 </select>
							</td>
                        </tr>
                        <tr>
                            <td colspan="2">
								<!--<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">-->
								<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
								<input type="hidden" id="id_competencia" name="id_ccompetencia" value="">
                            </td>
                        </tr>    
                    </table>
                </form>
            </div>
        </div>
	    
	<!--ESTA CONDICION SIRVE PARA REALIZAR BUSQUEDA POR DNI-->
				<?php
				if(isset($_POST['buscar']))
				{

					$curso_competencia->__SET('id_ccompetencia',$_POST['id_ccompetencia']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado_curso_competencia = $curso_competenciaDAO->Listar($curso_competencia); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado_curso_competencia)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">ID Curso</th>
												<th style="text-align:left;">ID Competencia</th>

										</tr>
								</thead>
						<?php foreach($resultado_curso_competencia as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
						?>
								<tr>
										<td><?php echo $r->__GET('id_ccompetencia'); ?></td>
							<td>

                                 <?php
                            		$competencia->__SET('id_competencia',$r->__GET('id_competencia')->__GET('id_competencia'));
									$resultado_competencia = $competenciaDAO->Listar($competencia);
                            	 ?>

                            	 	<?php foreach($resultado_competencia as $per):?>
                            	 		<?php echo $per->__GET('id_competencia')." - ".$per->__GET('competencia')." - Numero de competencia: ".$per->__GET('numero_co'); ?>
                            	 	<?php endforeach;?>

							</td>
							<td>

								<?php
                            		$curso->__SET('id_curso',$r->__GET('id_curso')->__GET('id_curso'));
									$resultado_curso = $cursoDAO->Listar($curso);
                            	 ?>
                                     <?php foreach($resultado_curso as $per):?>
                            	 		<?php echo $per->__GET('id_curso')." - ".$per->__GET('curso'); ?>
                            	     <?php endforeach;?>

							</td>
								</tr>
						<?php endforeach;
					}
					else
					{
						echo 'no se encuentra en la base de datos!';
					}
					?>
					</table>
					<?php
				}
				?>
    </body>
</html>
