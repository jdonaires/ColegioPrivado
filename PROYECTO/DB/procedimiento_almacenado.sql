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
