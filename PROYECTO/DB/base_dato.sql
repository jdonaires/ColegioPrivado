DROP DATABASE IF EXISTS mydb;

CREATE DATABASE mydb DEFAULT CHARACTER SET utf8;
USE mydb;

CREATE TABLE tipos_documentos
(
  id_tdocumento INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  tipo_documento VARCHAR(100) NOT NULL
);

CREATE TABLE estados_civiles
(
  id_ecivil INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  estado_civil VARCHAR(60) NOT NULL
);

CREATE TABLE personas
(
  id_persona INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  apellido_paterno VARCHAR(50) NOT NULL,
  apellido_materno VARCHAR(50) NOT NULL,
  numero_documento VARCHAR(20) UNIQUE NOT NULL,
  fecha_nacimiento DATE NOT NULL,
  sexo CHAR(1) NOT NULL,
  direccion VARCHAR(80) NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  id_tdocumento INT(11) NOT NULL,
  id_ecivil INT(11) NOT NULL,
  CONSTRAINT fk_personas_tipos_documentos FOREIGN KEY (id_tdocumento) REFERENCES tipos_documentos(id_tdocumento),
  CONSTRAINT fk_personas_estados_civiles FOREIGN KEY (id_ecivil) REFERENCES estados_civiles(id_ecivil)
);

CREATE TABLE funciones
(
  id_funcion INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  funcion VARCHAR(50) NOT NULL
);

CREATE TABLE docentes
(
  id_persona INT(11) PRIMARY KEY NOT NULL,
  estado CHAR(1) NOT NULL,
  id_funcion INT(11) NOT NULL,
  CONSTRAINT fk_docentes_personas FOREIGN KEY (id_persona) REFERENCES personas(id_persona),
  CONSTRAINT fk_docentes_funciones FOREIGN KEY (id_funcion) REFERENCES funciones(id_funcion)
);

CREATE TABLE IF NOT EXISTS notas
(
  id_nota INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nota VARCHAR(100) NOT NULL
);

CREATE TABLE periodos
(
  id_periodo INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  periodo VARCHAR(100) NOT NULL
);

CREATE TABLE secciones
(
  id_seccion INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  seccion VARCHAR(100) NOT NULL
);

CREATE TABLE grados
(
  id_grado INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  grado VARCHAR(100) NOT NULL
);

CREATE TABLE niveles_instrucciones
(
  id_ninstruccion INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nivel_instruccion VARCHAR(100) NOT NULL
);

CREATE TABLE registros_calificaciones
(
  id_rcalificacion INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  fecha DATE NOT NULL,
  hora TIME NOT NULL,
  id_periodo INT(11) NOT NULL,
  id_grado INT(11) NOT NULL,
  id_seccion INT(11) NOT NULL,
  id_docente INT(11) NOT NULL,
  CONSTRAINT fk_registros_calificaciones_periodos FOREIGN KEY (id_periodo) REFERENCES periodos(id_periodo),
  CONSTRAINT fk_registros_calificaciones_grados FOREIGN KEY (id_grado) REFERENCES grados(id_grado),
  CONSTRAINT fk_registros_calificaciones_docentes FOREIGN KEY (id_docente) REFERENCES docentes(id_persona),
  CONSTRAINT fk_registros_calificaciones_secciones FOREIGN KEY (id_seccion) REFERENCES secciones(id_seccion)
);

CREATE TABLE estudiantes
(
  id_persona INT(11) PRIMARY KEY NOT NULL,
  codigo_estudiante VARCHAR(20) UNIQUE NOT NULL,
  CONSTRAINT fk_estudiantes_personas FOREIGN KEY (id_persona) REFERENCES personas(id_persona)
);

CREATE TABLE alumnos_rcalificaciones
(
  id_arcalificacion INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_rcalificacion INT(11) NOT NULL,
  id_estudiante INT(11) NOT NULL,
  nota_final VARCHAR(2) NOT NULL,
  CONSTRAINT fk_alumnos_rcalificaciones_registros_calificaciones FOREIGN KEY (id_rcalificacion) REFERENCES registros_calificaciones(id_rcalificacion),
  CONSTRAINT fk_alumnos_rcalificaciones_estudiantes FOREIGN KEY (id_estudiante) REFERENCES estudiantes(id_persona)
);

CREATE TABLE arcalificaciones_notas
(
  id_arcnotas INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_arcalificacion INT(11) NOT NULL,
  id_nota INT(11) NOT NULL,
  CONSTRAINT fk_arcalificaciones_notas_notas FOREIGN KEY (id_nota) REFERENCES notas(id_nota),
  CONSTRAINT fk_arcalificaciones_notas_alumnos_rcalificaciones FOREIGN KEY (id_arcalificacion) REFERENCES alumnos_rcalificaciones(id_arcalificacion)
);

CREATE TABLE aulas(
  id_aula INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  descripcion VARCHAR(100) NOT NULL,
  numero_aula VARCHAR(50) NOT NULL,
  numero_alumno VARCHAR(10) NOT NULL,
  turno CHAR(1) NOT NULL,
  id_docente INT(11) NOT NULL,
  id_grado INT(11) NOT NULL,
  id_seccion INT(11) NOT NULL,
  CONSTRAINT fk_aulas_docentes FOREIGN KEY (id_docente) REFERENCES docentes(id_persona),
  CONSTRAINT fk_aulas_grados FOREIGN KEY (id_grado) REFERENCES grados(id_grado),
  CONSTRAINT fk_aulas_secciones FOREIGN KEY (id_seccion) REFERENCES secciones(id_seccion)
);

CREATE TABLE especialidades
(
  id_especialidad INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  descripcion VARCHAR(100) NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  estado CHAR(1) NOT NULL
);

CREATE TABLE cursos
(
  id_curso INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  curso VARCHAR(100) NOT NULL
);

CREATE TABLE competencias
(
  id_competencia INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  competencia VARCHAR(150) NOT NULL,
  numero_co CHAR(1) NOT NULL
);

CREATE TABLE cursos_competencias
(
  id_ccompetencia INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_curso INT(11) NOT NULL,
  id_competencia INT(11) NOT NULL,
  CONSTRAINT fk_cursos_competencias_cursos FOREIGN KEY (id_curso) REFERENCES cursos(id_curso),
  CONSTRAINT fk_cursos_competencias_competencias FOREIGN KEY (id_competencia) REFERENCES competencias(id_competencia)
);

CREATE TABLE capacidades
(
  id_capacidad INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  capacidad VARCHAR(100) NOT NULL,
  id_competencia INT(11) NOT NULL,
  CONSTRAINT fk_capacidades_competencias FOREIGN KEY (id_competencia) REFERENCES competencias(id_competencia)
);

CREATE TABLE apoderados
(
  id_persona INT(11) PRIMARY KEY NOT NULL,
  centro_trabajo VARCHAR(80) NOT NULL,
  ocupacion VARCHAR(50) NOT NULL,
  correo VARCHAR(100) NULL,
  id_ninstruccion INT(11) NOT NULL,
  CONSTRAINT fk_apoderados_personas FOREIGN KEY (id_persona) REFERENCES personas(id_persona),
  CONSTRAINT fk_apoderados_niveles_instrucciones FOREIGN KEY (id_ninstruccion) REFERENCES niveles_instrucciones(id_ninstruccion)
);

CREATE TABLE anios_escolares(
  id_aescolar INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  codigo VARCHAR(20) NOT NULL,
  descripcion VARCHAR(50) NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  estado CHAR(1) NOT NULL
);

CREATE TABLE matriculas(
  id_matricula INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  fecha DATE NOT NULL,
  repiete CHAR(1) NOT NULL,
  apoderado_parentesco VARCHAR(50) NOT NULL,
  id_estudiante INT(11) NOT NULL,
  id_apoderado INT(11) NOT NULL,
  id_grado INT(11) NOT NULL,
  id_aescolar INT(11) NOT NULL,
  CONSTRAINT fk_matriculas_estudiantes FOREIGN KEY (id_estudiante) REFERENCES estudiantes(id_persona),
  CONSTRAINT fk_matriculas_apoderados FOREIGN KEY (id_apoderado) REFERENCES apoderados(id_persona),
  CONSTRAINT fk_matriculas_grados FOREIGN KEY (id_grado) REFERENCES grados(id_grado),
  CONSTRAINT fk_matriculas_anios_escolares FOREIGN KEY (id_aescolar) REFERENCES anios_escolares(id_aescolar)
);

CREATE TABLE directores
(
  id_persona INT(11) PRIMARY KEY NOT NULL,
  estado CHAR(1) NOT NULL,
  id_funcion INT(11) NOT NULL,
  CONSTRAINT fk_directores_funciones FOREIGN KEY (id_funcion) REFERENCES funciones(id_funcion),
  CONSTRAINT fk_directores_personas FOREIGN KEY (id_persona) REFERENCES personas(id_persona)
);

CREATE TABLE grados_cursos
(
  id_gcurso INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_grado INT(11) NOT NULL,
  id_curso INT(11) NOT NULL,
  CONSTRAINT fk_grados_cursos_grados FOREIGN KEY (id_grado) REFERENCES grados(id_grado),
  CONSTRAINT fk_grados_cursos_cursos FOREIGN KEY (id_curso) REFERENCES cursos(id_curso)
);
