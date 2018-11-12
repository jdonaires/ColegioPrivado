<?php
require_once('../BOL/persona.php');
require_once('../DAO/personaDAO.php');

require_once('../BOL/nivel_instruccion.php');
require_once('../DAO/nivel_instruccionDAO.php');

require_once('../BOL/apoderado.php');
require_once('../DAO/apoderadoDAO.php');

$per = new Persona();
$perDAO = new PersonaDAO();

$apo = new Apoderado();
$apoDAO = new ApoderadoDAO();

$nivel = new Nivel_instruccion();
$nivelDAO = new Nivel_instruccionDAO();

if(isset($_POST['guardar']))
{
	$apo->__SET('id_persona',              $_POST['id_persona']);
	$apo->__SET('centro_trabajo',          $_POST['centro_trabajo']);
	$apo->__SET('ocupacion',               $_POST['ocupacion']);
	$apo->__SET('correo',                  $_POST['correo']);
	$apo->__SET('id_ninstruccion',         $_POST['id_ninstruccion']);

	$apoDAO->Registrar($apo);
	header('Location: frmApoderado.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
  <!--<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">-->
	  <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">

                    <table style="width:500px;" border="0">
                        <tr>
                            <th style="text-align:left;">Apoderado</th>
                            <td><input type="text" name="apoderado" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">centro de trabajo</th>
                            <td><input type="text" name="centro_trabajo" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Ocupacion</th>
                            <td><input type="text" name="ocupacion" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Correo</th>
                            <td><input type="text" name="correo" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Nivel de Instruccion</th>
                            <td><input type="text" name="nivel_instruccion" value="" style="width:100%;" /></td>
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

				<!--ESTA CONDICION SIRVE PARA REALIZAR BUSQUEDA POR DNI-->

				<?php
				if(isset($_POST['buscar']))
				{
					$resultado = array();//VARIABLE TIPO RESULTADO
					$per->__SET('dni',          $_POST['dni']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $perDAO->Listar($per); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">Apoderado</th>
												<th style="text-align:left;">Centro_Trabajo</th>
												<th style="text-align:left;">Ocupacion</th>
												<th style="text-align:left;">Correo</th>
												<th style="text-align:left;">Nivel_Instruccion</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('apoderado'); ?></td>
										<td><?php echo $r->__GET('centro_trabajo'); ?></td>
										<td><?php echo $r->__GET('ocupacion'); ?></td>
										<td><?php echo $r->__GET('correo'); ?></td>
										<td><?php echo $r->__GET('nivel_instruccion'); ?></td>
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
