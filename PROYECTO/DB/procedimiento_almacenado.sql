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
