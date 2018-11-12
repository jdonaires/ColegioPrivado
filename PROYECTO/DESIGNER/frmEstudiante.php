<?php
require_once('../BOL/estudiante.php');
require_once('../DAO/estudianteDAO.php');

$est = new Estudiante();
$estudianteDAO = new EstudianteDAO();

if(isset($_POST['guardar']))
{
	$est->__GET('id_persona')->__SET('nombre',          						$_POST['nombre']);
	$est->__GET('id_persona')->__SET('apellido_paterno',						$_POST['apellido_paterno']);
	$est->__GET('id_persona')->__SET('apellido_materno',						$_POST['apellido_materno']);
	$est->__GET('id_persona')->__SET('numero_documento',						$_POST['numero_documento']);
	$est->__GET('id_persona')->__SET('fecha_nacimiento',						$_POST['fecha_nacimiento']);
	$est->__GET('id_persona')->__SET('sexo',							     	$_POST['sexo']);
	$est->__GET('id_persona')->__SET('direccion',	          					$_POST['direccion']);
	$est->__GET('id_persona')->__SET('telefono',						        $_POST['telefono']);
	$est->__GET('id_persona')->__SET('id_tdocumento',						'1');
	$est->__GET('id_persona')->__SET('id_ecivil',						'1');

	$estudianteDAO->Registrar($est);
	header('Location: frmEstudiante.php');
}



?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
        <!-- <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">-->
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" ">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" autocomplete="off">

                    <table style="width:500px;" border="0">

                        <tr>
                            <th style="text-align:left;">Nombre:</th>
                            <td><input type="text" name="nombre" value="" style="width:100%;" required="" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Apellido Paterno:</th>
                            <td><input type="text" name="apellido_paterno" value="" style="width:100%;" required="" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Apellido Materno:</th>
                            <td><input type="text" name="apellido_materno" value="" style="width:100%;" required="" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Numero Documento:</th>
                            <td><input type="text" name="numero_documento" value="" style="width:100%;" required="" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Fecha Nacimiento:</th>
                            <td><input type="date" name="fecha_nacimiento" value="" style="width:100%;" required="" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Sexo:</th>
                            <td><input type="text" name="sexo" value="" style="width:100%;" required="" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Direccion:</th>
                            <td><input type="text" name="direccion" value="" style="width:100%;" required="" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Telefono:</th>
                            <td><input type="text" name="telefono" value="" style="width:100%;" required="" /></td>
                        </tr>
                        <tr>
                            <td colspan="2">
								<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
								<!--<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">-->
                            </td>
                        </tr>
                    </table>
                </form>


            </div>
        </div>

				<?php
				
					$resultado = array();//VARIABLE TIPO RESULTADO
					$resultado = $estudianteDAO->Listar(); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
											<th style="text-align:left;">id Estudiante</th>
												<th style="text-align:left;">Codigo Estudiante</th>
												<th style="text-align:left;">Nombre</th>
												<th style="text-align:left;">Apellido Paterno</th>
												<th style="text-align:left;">Apellido Materno</th>
												<th style="text-align:left;">Numero Documento</th>
												<th style="text-align:left;">sexo</th>
												<th style="text-align:left;">fecha_nacimiento</th>
												<th style="text-align:left;">direccion</th>
												<th style="text-align:left;">telefono</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('codigo_estudiante'); ?></td>
										<td><?php echo $r->__GET('id_persona')->__GET('id_persona'); ?></td>
										<td><?php echo $r->__GET('id_persona')->__GET('nombre'); ?></td>
										<td><?php echo $r->__GET('id_persona')->__GET('apellido_paterno'); ?></td>
										<td><?php echo $r->__GET('id_persona')->__GET('apellido_materno'); ?></td>
										<td><?php echo $r->__GET('id_persona')->__GET('numero_documento'); ?></td>
										<td><?php echo $r->__GET('id_persona')->__GET('sexo'); ?></td>
										<td><?php echo $r->__GET('id_persona')->__GET('fecha_nacimiento'); ?></td>
										<td><?php echo $r->__GET('id_persona')->__GET('direccion'); ?></td>
										<td><?php echo $r->__GET('id_persona')->__GET('telefono'); ?></td>
							
								</tr>
						<?php endforeach;
					}
					else
					{
						echo 'no se encuentra en la base de datos!';
					}
					?>
					</table>

    </body>
</html>
