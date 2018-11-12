<?php
require_once('../BOL/aula.php');
require_once('../DAO/aulaDAO.php');

require_once('../BOL/docente.php');
require_once('../DAO/docenteDAO.php');

require_once('../BOL/grado.php');
require_once('../DAO/gradoDAO.php');

require_once('../BOL/seccion.php');
require_once('../DAO/seccionDAO.php');

$docente = new Docente();
$docenteDAO = new DocenteDAO();

$resultado_docente = array();
$docente->__SET('id_persona', '');
$resultado_docente = $docenteDAO->Listar($docente);

$grado = new Grado();
$gradoDAO = new GradoDAO();

$resultado_grado = array();
$resultado_grado = $gradoDAO->Listar();

$secccion = new Seccion();
$seccionDAO = new SeccionDAO();

$resultado_seccion = array();
$resultado_seccion = $seccionDAO->Listar();

$aula = new Aula();
$aulaDAO = new AulaDAO();

if(isset($_POST['guardar']))
{
	$aula->__SET('descripcion', $_POST['descripcion']);
	$aula->__SET('numero_aula', $_POST['numero_aula']);
	$aula->__SET('numero_alumno', $_POST['numero_alumno']);
	$aula->__SET('turno', $_POST['turno']);
	$aula->__SET('id_docente', $_POST['id_docente']);
	$aula->__SET('id_grado', $_POST['id_grado']);
	$aula->__SET('id_seccion', $_POST['id_seccion']);

	$aulaDAO->Registrar($aula);
	header('Location: frmAula.php');
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
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" autocomplete="off">
				<table style="width:500px;" border="0">
					<tr>
						<th style="text-align:left;">Descripción:</th>
						<td><input type="hidden" name="id_aula" value="" style="width:100%;" />
						<input type="text" name="descripcion" value="" style="width:100%;" /></td>
					</tr>
					<tr>
						<th style="text-align:left;">Número de Aula:</th>
						<td><input type="text" name="numero_aula" value="" style="width:100%;" /></td>
					</tr>
					<tr>
						<th style="text-align:left;">Número de Alumnos:</th>
						<td><input type="text" name="numero_alumno" value="" style="width:100%;" /></td>
					</tr>
					<tr>
						<th style="text-align:left;">Turno:</th>
						<td><select name="turno" style="width:100%;">
							<option value="M">M</option>

							<option value="T">T</option>
						</select></td>
					</tr>
					<tr>
						<th style="text-align:left;">Docente:</th>
						<td><select name="id_docente" style="width:100%;">
							<?php
							if(!empty($resultado_docente))
							{
								foreach( $resultado_docente as $r_d):
							?>
									<option value="<?php echo $r_d->__GET('id_persona')->__GET('id_persona');?>"><?php echo $r_d->__GET('id_persona')->__GET('apellido_paterno')." ".
									$r_d->__GET('id_persona')->__GET('apellido_materno').", ".$r_d->__GET('id_persona')->__GET('nombre');?></option>
							<?php
								endforeach;
							}else
							{
							?>
								<option value="0">No hay opciones</option>
							<?php
							}
							?>
						</select></td>
					</tr>
					<tr>
						<th style="text-align:left;">Grado:</th>
						<td><select name="id_grado" style="width:100%;">
							<?php
							if(!empty($resultado_grado))
							{
								foreach( $resultado_grado as $r_g):
							?>
									<option value="<?php echo $r_g->__GET('id_grado');?>"><?php echo $r_g->__GET('grado');?></option>
							<?php
								endforeach;
							}else
							{
							?>
								<option value="0">No hay opciones</option>
							<?php
							}
							?>
						</select></td>
					</tr>
					<tr>
						<th style="text-align:left;">Sección:</th>
						<td><select name="id_seccion" style="width:100%;">
							<?php
							if(!empty($resultado_seccion))
							{
								foreach( $resultado_seccion as $r_s):
							?>
									<option value="<?php echo $r_s->__GET('id_seccion');?>"><?php echo $r_s->__GET('seccion');?></option>
							<?php
								endforeach;
							}else
							{
							?>
								<option value="0">No hay opciones</option>
							<?php
							}
							?>
						</select></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
							<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>

	<?php
	$aul = new Aula();
	$aulaDAO = new AulaDAO();

	$resultado_aula = array();
	$resultado_aula = $aulaDAO->Listar();
  ?>

  <table class="pure-table pure-table-horizontal">
    <thead>
      <tr>
        <th style="text-align:left;">Id Aula</th>
        <th style="text-align:left;">Descripción</th>
        <th style="text-align:left;">Número de Aula</th>
        <th style="text-align:left;">Número de Alumno</th>
        <th style="text-align:left;">Turno</th>
        <th style="text-align:left;">Docente</th>
        <th style="text-align:left;">Grado</th>
        <th style="text-align:left;">Seccion</th>
      </tr>
    </thead>

  <?php
	if(!empty($resultado_aula)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
	{
    foreach( $resultado_aula as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
	?>

    <tr>
      <td><?php echo $r->__GET('id_aula'); ?></td>
      <td><?php echo $r->__GET('descripcion'); ?></td>
      <td><?php echo $r->__GET('numero_aula'); ?></td>
      <td><?php echo $r->__GET('numero_alumno'); ?></td>
      <td><?php echo $r->__GET('turno'); ?></td>
      <td><?php echo $r->__GET('id_docente')->__GET('id_persona')->__GET('apellido_paterno')
      . " " . $r->__GET('id_docente')->__GET('id_persona')->__GET('apellido_materno')
      . ", ". $r->__GET('id_docente')->__GET('id_persona')->__GET('nombre'); ?></td>
      <td><?php echo $r->__GET('id_grado')->__GET('grado'); ?></td>
      <td><?php echo $r->__GET('id_seccion')->__GET('seccion'); ?></td>
    </tr>

	<?php
    endforeach;
	} else
	{
    echo '<td colspan="8">No se encuentran registros.</td>';
	}
	?>
	</table>
</body>
</html>
