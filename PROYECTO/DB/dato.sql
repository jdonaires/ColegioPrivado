/*Verificar que no se repitan los registros por defecto*/

INSERT INTO funciones VALUES (null, 'Sin funciones extras');
INSERT INTO funciones VALUES (null, 'Puede Matricular');

INSERT INTO secciones VALUES (null, 'A'), (null, 'B'), (null, 'C');
INSERT INTO grados VALUES (null, 'Primer Grado'), (null, 'Segundo Grado');


-- otros tipos de documentos

insert into tipos_documentos (id_tdocumento,tipo_documento)values(1,'DNI');
insert into tipos_documentos (id_tdocumento,tipo_documento)values(2,'CARNET DE EXTRANGERIA');
insert into tipos_documentos (id_tdocumento,tipo_documento)values(3,'LIBRETA ELECTORAL - 7 DIGITOS');
insert into tipos_documentos (id_tdocumento,tipo_documento)values(4,'LIBRETA ELECTORAL - 8 DIGITOS');
insert into tipos_documentos (id_tdocumento,tipo_documento)values(5,'CARNET DE FUERZAS POLICIALES');
insert into tipos_documentos (id_tdocumento,tipo_documento)values(6,'CARNET DE FUERZAS ARMADAS');
insert into tipos_documentos (id_tdocumento,tipo_documento)values(7,'PASAPORTE');



-- otros estados civiles

insert into estados_civiles (id_ecivil,estado_civil)values(1,'SOLTERO');
insert into estados_civiles (id_ecivil,estado_civil)values(2,'CASADO');
insert into estados_civiles (id_ecivil,estado_civil)values(3,'DIVORCIADO');
insert into estados_civiles (id_ecivil,estado_civil)values(4,'VIUDO');

INSERT INTO personas VALUES (null, 'Luis', 'Martinez', 'Napa', '1234567', '1996-07-28', 'M', 'América', '11111', '1', '1');
INSERT INTO personas VALUES (null, 'Rosa', 'Loza', 'Salas', '649372', '1980-01-02', 'F', 'Panamericana', '22222', '2', '2');

INSERT INTO docentes VALUES ('1', '1', '1');
INSERT INTO docentes VALUES ('2', '1', '1');

INSERT INTO aulas VALUES (null, 'Prueba', '23', '43', 'M', '1', '1', '1');

INSERT INTO competencias VALUES (null, 'Lectura', '1'), (null, 'Comprensión', '2');

INSERT INTO capacidades VALUES (null, 'Diálogo', '1'), (null, 'Entiende', '2');

-- tabla persona

CALL up_insertar_persona(null,'paul','ochoa','sanchez','76574338','1995-01-01','M','jr lima 406','994541220',1,1);
CALL up_insertar_persona(null,'jair','felix','cespedes','88654123','1995-02-01','F','ica','999541922',3,3);
CALL up_insertar_persona(null,'juan','huaroto','mozo','88754123','1994-03-01','M','pisco','998541921',4,2);
CALL up_insertar_persona(null,'sebastian','cusipuma','napa','89054123','1996-03-01','F','cañete','996541928',1,3);
CALL up_insertar_persona(null,'fiorella','gutierrez','deochoa','85154123','1994-05-05','M','sunampe','997541920',2,4);
CALL up_insertar_persona(null,'adriel','alpanpan','alvino','87654321','1999-07-07','F','muylejano','987654321',2,2);
CALL up_insertar_persona(null,'adriel','aljamon','alqueso','75654321','2000-07-07','F','muycercano','997654321',1,1);
CALL up_insertar_persona(null,'jose','booleano','vasquez','74215478','2001-01-01','M','el carmen','954541928',1,1);
CALL up_insertar_persona(null,'pedro','pela','rocas','98765432','2000-09-09','M','chincha','986541932',1,1);
