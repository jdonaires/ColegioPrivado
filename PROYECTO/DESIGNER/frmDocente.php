<?php
require_once('../BOL/docente.php');
require_once('../DAO/docenteDAO.php');

require_once('../DAO/personaDAO.php');
require_once('../DAO/funcionDAO.php');
require_once('../DAO/estado_civilDAO.php');
require_once('../DAO/tipo_documentoDAO.php');

require_once('../BOL/funcion.php');
require_once('../BOL/persona.php');
require_once('../BOL/estado_civil.php');

require_once('../BOL/tipo_documento.php');

$personaDao = new personaDAO();

$funcionDAO = new FuncionDAO();

$docente = new Docente();
$docenteDAO = new DocenteDAO();


$estado_civilDAO = new Estado_civilDAO();

$tipo_documentoDAO = new Tipo_documentoDAO();


if(isset($_POST['guardar']))
{
	$docente->__SET('estado',        												 $_POST['estado']);
	$docente->__GET('id_funcion')->__SET('id_funcion',       $_POST['id_funcion']);

	$persona1 = new Persona();
	$persona1->__SET('nombre',          						$_POST['nombre']);
	$persona1->__SET('apellido_paterno',          	$_POST['apellido_paterno']);
	$persona1->__SET('apellido_materno',          	$_POST['apellido_materno']);
	$persona1->__SET('numero_documento',          	$_POST['numero_documento']);
	$persona1->__SET('fecha_nacimiento',          	$_POST['fecha_nacimiento']);
	$persona1->__SET('sexo',          							$_POST['sexo']);
	$persona1->__SET('direccion',          					$_POST['direccion']);
	$persona1->__SET('telefono',          					$_POST['telefono']);
	$persona1->__SET('id_tdocumento',          			$_POST['id_tdocumento']);
	$persona1->__SET('id_ecivil',          					$_POST['id_ecivil']);

	$docente->__SET('id_persona', $persona1);

	$docenteDAO->Registrar($docente);
	header('Location: frmDocente.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">

                    <table style="width:500px;" border="0">
                      <tr>
                            <th style="text-align:left;">Nombres</th>
                            <td><input type="text" name="nombre" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Apellido Paterno</th>
                            <td><input type="text" name="apellido_paterno" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Apellido Materno</th>
                            <td><input type="text" name="apellido_materno" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Tipo de documento</th>
														<td>
															<?php
																$resultadoTipodocumento = array();//VARIABLE TIPO RESULTADO
																$TipoDocumento = new Tipo_documento();
																$TipoDocumento->__SET('id','');
																$resultadoTipodocumento = $tipo_documentoDAO->Listar($TipoDocumento);
															 ?>
															 <select name="id_tdocumento">
																<?php foreach($resultadoTipodocumento as $per):?>
																	<option value="<?php echo $per->__GET('id')?>"><?php echo $per->__GET('id')." - ".$per->__GET('tipo_documento'); ?></option>
																<?php endforeach;?>
															 </select>
														</td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Numero de Documento</th>
                            <td><input type="text" name="numero_documento" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Fecha de Nacimiento</th>
                            <td><input type="text" name="fecha_nacimiento" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Sexo</th>
                            <td><input type="text" name="sexo" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Direccion</th>
                            <td><input type="text" name="direccion" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Telefono</th>
                            <td><input type="text" name="telefono" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Estado civil</th>
														<td>
															<?php
																$resultadoEstadoCivil = array();//VARIABLE TIPO RESULTADO
																$estadoCivil = new Estado_civil();
																$estadoCivil->__SET('estado_civil','');
																$resultadoEstadoCivil = $estado_civilDAO->Listar($estadoCivil);
															 ?>
															 <select name="id_ecivil">
																<?php foreach($resultadoEstadoCivil as $per):?>
																	<option value="<?php echo $per->__GET('id_ecivil')?>"><?php echo $per->__GET('id_ecivil')." - ".$per->__GET('estado_civil'); ?></option>
																<?php endforeach;?>
															 </select>
														</td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Funcion</th>
														<td>
															<?php
																	$resultadoFuncion = array();//VARIABLE TIPO RESULTADO
																	$funcion = new Funcion1();
																	$funcion->__SET('id_funcion','');
																	$resultadoFuncion = $funcionDAO->Listar($funcion);
															 ?>
															 <select name="id_funcion">
																<?php foreach($resultadoFuncion as $per):?>
																	<option value="<?php echo $per->__GET('id_funcion')?>"><?php echo $per->__GET('id_funcion')." - ".$per->__GET('funcion'); ?></option>
																<?php endforeach;?>
															 </select>
														</td>
                        </tr>
												<tr>
													<th style="text-align:left;">Estado</th>
													<td>
														<select name="estado">
															<option value="1">Activo</option>
															<option value="2">INACTIVO</option>
														</select>
													</td>
												</tr>
                        <tr>
                            <td colspan="2">
																<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
																<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
																<input type="hidden" id="id_rcalificacion" name="id_persona" value="">
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
					$resultado = array();//VARIABLE TIPO RESULTADO
					$docente->__SET('id_persona',          $_POST['id_persona']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $docenteDAO->Listar($docente); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Nombres</th>
												<th style="text-align:left;">Apellido paterno</th>
												<th style="text-align:left;">Apellido materno</th>
												<th style="text-align:left;">DNI</th>
												<th style="text-align:left;">Estado</th>
												<th style="text-align:left;">Funciones</th>
										</tr>
								</thead>
						<?php
						foreach($resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('id_persona')->__GET('id_persona'); ?></td>

										<?php
											$resultadoPersona = array();//VARIABLE TIPO RESULTADO
											$persona = new Persona();
											$persona->__SET('id_persona',$r->__GET('id_persona')->__GET('id_persona'));
											$resultadoPersona = $personaDao->Listar($persona);
										 ?>

											<?php foreach($resultadoPersona as $per):?>

												<td><?php echo $per->__GET('nombre'); ?></td>
												<td><?php echo $per->__GET('apellido_paterno'); ?></td>
												<td><?php echo $per->__GET('apellido_materno'); ?></td>
												<td><?php echo $per->__GET('numero_documento'); ?></td>

											<?php endforeach;?>

										<td><?php echo $r->__GET('estado'); ?></td>
										<td>
											<?php
												$resultadoFuncion = array();//VARIABLE TIPO RESULTADO
												$funcion = new Funcion1();
												$funcion->__SET('id_funcion',$r->__GET('id_funcion')->__GET('id_funcion'));
												$resultadoFuncion = $funcionDAO->Listar($funcion);
											 ?>

												<?php foreach($resultadoFuncion as $per):?>
													<?php echo $per->__GET('id_funcion')." - ".$per->__GET('funcion'); ?>
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
