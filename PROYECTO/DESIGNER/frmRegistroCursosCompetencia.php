<?php
//Hacemos uso de las clases necesarias para este proceso
require_once '../BOL/curso_competencia.php';
require_once '../DAO/curso_competenciaDAO.php';
require_once '../BOL/curso.php';
require_once '../DAO/cursoDAO.php';
require_once '../BOL/competencia.php';
require_once '../DAO/competenciaDAO.php';

//Obtenemos el objeto de cada clase antes mencionadas
$curso = new Curso();
$cursoDAO = new CursoDAO();
$resultado_curso = array();
$resultado_curso = $cursoDAO->Listar($curso);
$competencia = new Competencia();
$competenciaDAO = new CompetenciaDAO();
$resultado_competencia = array();
$resultado_competenciaDAO = $competenciaDAO->Listar($competencia);
$curso_competencia = new Curso_Competencia();
$curso_competenciaDAO = new Curso_CompetenciaDAO();

//Objeto de tipo array
$resultado_curso_competencia = array();

?>
