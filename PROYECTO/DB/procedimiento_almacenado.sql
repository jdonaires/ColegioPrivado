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
CREATE PROCEDURE up_listar_docente
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