<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::controller('/usuario', 'Usuario_UsuarioController');
Route::controller('/alumno', 'Usuario_AlumnoController');
Route::controller('/docente', 'Usuario_DocenteController');
Route::controller('/demandante', 'Usuario_DemandanteController');

Route::controller('/curso', 'Curso_CursoController');

Route::controller('/empresa', 'Empresa_EmpresaController');
Route::controller('/gestor', 'Gestor_GestorController');
Route::controller('/municipio', 'Municipio_MunicipioController');
Route::controller('/empleo/subarea', 'Empleo_SubareaController');


Route::controller('/oferta', 'Ofertas_OfertaController');
Route::controller('/error', 'ErrorController');

Route::controller('/titulacion', 'Titulacion_TitulacionController');

Route::controller('/ajax-list', 'AjaxListController');
Route::controller('/xml', 'Xml_XmlController');
Route::controller('/documentos', 'Documentos_DocumentosController');
Route::controller('/importer', 'Importer_ImporterController');




