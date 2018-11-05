#REGISTRAR PERSONA FUNCION

DELIMITER $$
CREATE FUNCTION uf_registrar_persona (
 _nombre VARCHAR(20),
 _apellido_paterno VARCHAR(20),
 _apellido_materno VARCHAR(20),
 _numero_documento VARCHAR(20),
 _fecha_nacimiento VARCHAR(20),
 _sexo VARCHAR(20),
 _direccion VARCHAR(20),
 _telefono VARCHAR(20),
 _id_tdocumento VARCHAR(20),
 _id_ecivil VARCHAR(20)
) 
RETURNS int 
BEGIN 

DECLARE lastID int;

INSERT INTO 
personas(nombre, apellido_paterno,apellido_materno,numero_documento,fecha_nacimiento,sexo,direccion,telefono,id_tdocumento,id_ecivil) 
VALUES
 (_nombre, _apellido_paterno,_apellido_materno, _numero_documento,_fecha_nacimiento,_sexo,_direccion,_telefono,_id_tdocumento,_id_ecivil
 );
SET lastID = LAST_INSERT_ID();
RETURN lastID;
END
$$

