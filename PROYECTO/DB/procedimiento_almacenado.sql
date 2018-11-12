# Registrar docente procedimiento almacenado
DELIMITER $$
CREATE PROCEDURE up_registrar_docente
(
	    IN _estado VARCHAR(20),
	    IN _id_funcion VARCHAR(20),

      IN _nombre VARCHAR(20),
      IN _apellido_paterno VARCHAR(20),
      IN _apellido_materno VARCHAR(20),
      IN _numero_documento VARCHAR(20),
      IN _fecha_nacimiento VARCHAR(20),
      IN _sexo VARCHAR(20),
      IN _direccion VARCHAR(20),
      IN _telefono VARCHAR(20),
      IN _id_tdocumento VARCHAR(20),
      IN _id_ecivil VARCHAR(20)
)
BEGIN
DECLARE ultimoID INT;

SET ultimoID = uf_registrar_persona(
_nombre,
_apellido_paterno,
_apellido_materno,
_numero_documento,
_fecha_nacimiento,
_sexo,_direccion,
_telefono,
_id_tdocumento,
_id_ecivil
);
INSERT INTO docentes(id_persona, estado, id_funcion) VALUES (ultimoID,_estado,_id_funcion);
END
$$

# BUSCAR funcion
DELIMITER $$
CREATE PROCEDURE up_listar_funcion
(
    IN _id_funcion VARCHAR(20)
)
BEGIN

select * from funciones where id_funcion LIKE CONCAT('%', _id_funcion , '%');

END
$$

# BUSCAR docente
DELIMITER $$
CREATE PROCEDURE up_listar_docente
(
    IN _id_persona VARCHAR(20)
)
BEGIN

SELECT * FROM docentes d INNER JOIN personas p ON d.id_persona = p.id_persona where d.id_persona LIKE CONCAT('%', _id_persona , '%');

END
$$

# BUSCAR persona
DELIMITER $$
CREATE PROCEDURE up_listar_persona
(
    IN _id_persona VARCHAR(20)
)
BEGIN

select * from personas where id_persona LIKE CONCAT('%', _id_persona , '%');

END
$$

# BUSCAR estado civil
DELIMITER $$
CREATE PROCEDURE up_listar_estado_civil
(
    IN _id_ecivil VARCHAR(20)
)
BEGIN

select * from estados_civiles where id_ecivil LIKE CONCAT('%', _id_ecivil , '%');

END
$$

# BUSCAR TIPO DOCUMENTO
DELIMITER $$
CREATE PROCEDURE up_listar_tipos_documentos
(
    IN _id_tdocumento VARCHAR(20)
)
BEGIN

select * from tipos_documentos where id_tdocumento LIKE CONCAT('%', _id_tdocumento , '%');

END
$$

/*Registra una nueva capacidad*/
DELIMITER $$
CREATE PROCEDURE up_registrar_capacidad
(
    IN _capacidad VARCHAR (150),
    IN _id_competencia INT (11)
)
BEGIN
	INSERT INTO capacidades VALUES (null, _capacidad, _id_competencia);
END
$$

/*Lista las capacidades de una competencia*/
DELIMITER $$
CREATE PROCEDURE up_listar_capacidad_competencia(
    IN _id_competencia INT (11)
)
BEGIN
	SELECT * FROM capacidades WHERE id_competencia = _id_competencia;
END
$$

/***************** PROCESO REGISTRAR AULA INICIO *****************/
DELIMITER $$
CREATE PROCEDURE up_listar_grado(
)
BEGIN
	SELECT * FROM grados;
END
$$

DELIMITER $$
CREATE PROCEDURE up_listar_seccion(
)
BEGIN
	SELECT * FROM secciones;
END
$$

DELIMITER $$
CREATE PROCEDURE up_listar_aula(
)
BEGIN
	SELECT * FROM aulas a INNER JOIN docentes d ON a.id_docente = d.id_persona INNER JOIN grados g ON a.id_grado = g.id_grado INNER JOIN secciones s ON a.id_seccion = s.id_seccion INNER JOIN personas p ON d.id_persona = p.id_persona;
END
$$

DELIMITER $$
CREATE PROCEDURE up_listar_docente2
(

)

BEGIN
	SELECT * FROM docentes d INNER JOIN personas p ON d.id_persona = p.id_persona;

END

$$

DELIMITER $$
CREATE PROCEDURE up_registrar_aula(
    IN _descripcion VARCHAR(100),
    IN _numero_aula VARCHAR(50),
    IN _numero_alumno VARCHAR(10),
    IN _turno CHAR(1),
    IN _id_docente INT(11),
    IN _id_grado INT(11),
    IN _id_seccion INT(11)
)
BEGIN
	INSERT INTO aulas VALUES (null, _descripcion, _numero_aula, _numero_alumno, _turno, _id_docente, _id_grado, _id_seccion);
END
$$
/***************** PROCESO REGISTRAR AULA FIN *****************/



/* INICIO DE LA TABLA PERSONA*/
-- procedimiento almacenado para ingresar a una persona
  DELIMITER $$
  DROP PROCEDURE IF EXISTS up_insertar_persona$$
  CREATE PROCEDURE up_insertar_persona
  (

  IN Nombre VARCHAR(100),
  IN Apellido_paterno VARCHAR(50),
  IN Apellido_materno VARCHAR(50),
  IN Numero_documento VARCHAR(20),
  IN Fecha_nacimiento DATE,
  IN Sexo CHAR(1),
  IN Direccion VARCHAR(80),
  IN Telefono VARCHAR(20),
  IN Id_tdocumento char(6) ,
  IN Id_ecivil char(6)
  )
  BEGIN
  DECLARE contador INT(11);
  DECLARE id CHAR(6),
          SET contador= (SELECT COUNT(*)+1 FROM personas);
          IF(contador<10)THEN
              SET id= CONCAT('P0000',contador);
          ELSE IF(contador<100) THEN
              SET id= CONCAT('P000',contador);
          ELSE IF(contador<1000)THEN
              SET id= CONCAT('P00',contador);
          ELSE IF(contador<10000)THEN
              SET id= CONCAT('P0',contador);
          ELSE IF(contador<100000)THEN
            SET id= CONCAT('P',contador);
          END IF;
          END IF;
          END IF;
          END IF;
          END IF;

  insert into personas
  (id_persona,nombre,apellido_paterno,apellido_materno,numero_documento,fecha_nacimiento,sexo,direccion,telefono,id_tdocumento,id_ecivil)
  values
  (id,Nombre,Apellido_paterno,Apellido_materno,Numero_documento,Fecha_nacimiento,Sexo,Direccion,Telefono,Id_tdocumento,Id_ecivil);
  END


-- procedimiento almacendado para mostrar a una personas en general
DROP PROCEDURE IF EXISTS up_consulta_Persona;

DELIMITER $$
CREATE PROCEDURE up_consulta_Persona()
BEGIN
SELECT p.nombre, p.apellido_materno, p.apellido_paterno,p.fecha_nacimiento, p.numero_documento,
tD.tipo_documento, eC.estado_civil FROM personas AS p
INNER JOIN tipos_documentos AS tD ON tD.id_tdocumento = p.id_tdocumento
INNER JOIN estados_civiles AS eC on eC.id_ecivil = p.id_ecivil;
END

-- procedimiento almacendado para mostrar a una personas por dni
DROP PROCEDURE IF EXISTS up_consulta_Persona;

DELIMITER $$
CREATE PROCEDURE up_consulta_Persona_DNI(IN identidad varchar(20))
BEGIN
SELECT p.nombre, p.apellido_materno, p.apellido_paterno,p.fecha_nacimiento, p.numero_documento,
tD.tipo_documento, eC.estado_civil FROM personas AS p
INNER JOIN tipos_documentos AS tD ON tD.id_tdocumento = p.id_tdocumento
INNER JOIN estados_civiles AS eC on eC.id_ecivil = p.id_ecivil
WHERE p.numero_documento = identidad;
END

/*FIN DE LA TABLA PERSONA*/



/* Procedimiento Almacenado para registrar Arcalificacion nota */

DELIMITER $$

CREATE PROCEDURE up_registrar_arcalificacion_nota
(IN _id_arcalificacion INT(11),
IN _id_nota INT(11)
)
BEGIN

INSERT INTO arcalificacion_notas(id_arcalificacion, id_nota) VALUES (_id_arcalificacion, _id_nota);
END
$$

/* Procedimiento almacenado para buscar arcalificacion nota */

DELIMITER $$
CREATE PROCEDURE up_buscar_arcalificacion_nota(
IN _arcalificacion_notas INT(11)
)
BEGIN
SELECT * FROM arcalificacion_notas where arcalificacion_notas =arcalificacion_notas;
END
$$

/* Fin del Procedimiento Almacenado de Arcalificacion nota */

/*Procedimiento Almacenado - Registrar Nivel Instruccion*/
DELIMITER $$
CREATE PROCEDURE up_registrar_nivel_instruccion
(
 in _idN int,
 in _nivel_instruccion VARCHAR(100)
) 
BEGIN
    INSERT INTO niveles_instrucciones(id_ninstruccion,nivel_instruccion) VALUES (_idN,_nivel_instruccion);
END
$$
							      
							      
/* PROCEDIMIENTO ALMACENADO PARA REGISTRAR APODERADO.*/


delimiter $$
create procedure up_registrar_apoderados
(
  IN _id_persona  int(11),
    IN _centro_trabajo varchar(80),
    IN _ocupacion varchar(50),
    IN _correo varchar(100),
    IN _id_ninstruccion int(11)
)
begin
 insert into apoderados (id_persona, centro_trabajo, ocupacion, correo, id_ninstruccion)
 values (_id_persona,_centro_trabajo, _ocupacion,_correo,_id_ninstruccion);
end
$$


/*PROCEDIMIENTO ALMACENADO PARA BUSCAR APODERADO */


delimiter $$
create procedure up_buscar_apoderados
(
	in _dni varchar(8)
)
begin
	select concat(per.apellido_paterno, ' ', per.apellido_materno, ', ',per.nombre) as Apoderado,per.numero_documento, apo.centro_trabajo, apo.ocupacion, apo.correo, ni.nivel_instruccion
	from apoderados apo
	inner join personas per on apo.id_persona = per.id_persona
	inner join niveles_instrucciones ni on apo.id_ninstruccion = ni.id_ninstruccion
    where per.numero_documento = _dni;
end
$$


/*FIN */

/* PROCEDIMIENTO ALMACENADO PARA LISTAR LOS NIVELES DE INSTRUCCIONES*/



delimiter $$
create procedure up_listar_Nivel_Instruccion
(
  IN _id_ninstruccion int(11)

)
begin

  SELECT * FROM niveles_instrucciones where id_ninstruccion = _id_ninstruccion;

END

$$
							      
							      

/* Procedimiento Almacenado para Registrar curso competencia */

DELIMITER $$ 
CREATE PROCEDURE up_registrar_curso_competencia(
IN _id_curso INT(11),
IN _id_competencia INT(11)
) 
BEGIN 

INSERT INTO cursos_competencias(id_curso, id_competencia) VALUES (_id_curso,_id_competencia ); 
END
$$
/*Fin */
