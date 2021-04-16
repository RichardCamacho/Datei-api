<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', 'UserController@index');
////////////////////////////Usuario////////////////////////////////////
//autenticar el inicio de sesion de un usuario
Route::get('/user', 'UserController@user')->middleware('auth:api');
//registro de usuario
Route::post('/register-user', 'UserController@register');
//consulta de registros de usuario
Route::get('/list-users', 'UserController@listUsers');
//consultar usuario por id
Route::get('/user/{id}', 'UserController@getUserById');
//actualizar usuario
Route::put('/update-user/{id}', 'UserController@updateUser');
//eliminar un registro de usuario
Route::delete('/delete-user/{id}', 'UserController@deleteUser');

////////////////////////////Tipos de Referencia////////////////////////////////////
//registro de un tipo de referencia
Route::post('/register-reference-type', 'TiposReferenciaController@register');
//consulta de una lista de todos los tipo de referencia
Route::get('/list-reference-type', 'TiposReferenciaController@listTiposReferencia');
//consultar un tipo de referencia por id
Route::get('/reference-type/{id}', 'TiposReferenciaController@getTipoReferenciaById');
//actualizar un tipo de referencia
Route::put('/update-reference-type/{id}', 'TiposReferenciaController@updateTipoReferencia');
//eliminar un registro de un tipo de referencia
Route::delete('/delete-reference-type/{id}', 'TiposReferenciaController@deleteTipoReferencia');
//consulta de detalles de tipo de referencia por id
Route::get('/reference-type-details/{id}', 'TiposReferenciaController@getDetallesTipoReferenciaById');
//consulta de detalles de tipo de referencia por nombre
Route::get('/reference-type-details-name/{name}', 'TiposReferenciaController@getDetallesTipoReferenciaByName');

////////////////////////////Detalles Tipos de Referencia////////////////////////////////////
//registro de un detalle tipo de referencia
Route::post('/register-reference-type-detail', 'DetalleTipoReferenciaController@register');
//consulta de una lista de detalle tipo de referencia
Route::get('/list-reference-type-detail', 'DetalleTipoReferenciaController@listDetallesTipoReferencia');
//consultar un detalle tipo de referencia por id
Route::get('/reference-type-detail/{id}', 'DetalleTipoReferenciaController@getDetalleTipoReferenciaById');
//actualizar un detalle tipo de referencia
Route::put('/update-reference-type-detail/{id}', 'DetalleTipoReferenciaController@updateDetalleTipoReferencia');
//eliminar un registro de un detalle tipo de referencia
Route::delete('/delete-reference-type-detail/{id}', 'DetalleTipoReferenciaController@deleteDetalleTipoReferencia');

////////////////////////////Hojas de Vida////////////////////////////////////
//registro de una hoja de vida
Route::post('/register-curriculum', 'HojasVidaController@register');
//consultar una hoja de vida por id de usuario
Route::get('/curriculum/{id}', 'HojasVidaController@getCurriculumByIdUser');
//actualizar una hoja de vida
Route::put('/update-curriculum/{id}', 'HojasVidaController@updateCurriculum');
//actualizar una fecha de la hoja de vida
Route::put('/update-date-curriculum/{id}', 'HojasVidaController@updateDateCurriculum');

////////////////////////////Estudios/Cursos////////////////////////////////////
//registro de un estudio reaizado
Route::post('/register-schooling', 'EstudiosController@register');
//lista de TODOS estudios realizados
Route::get('/list-schooling', 'EstudiosController@listSchooling');
//lista de TODOS estudios realizados por hoja de vida
Route::get('/list-schooling/{idHv}', 'EstudiosController@listSchoolingByHv');
//consultar un estudio realizado por id
Route::get('/schooling/{id}', 'EstudiosController@getSchoolingById');
//actualizar un estudio realizado
Route::put('/update-schooling/{id}', 'EstudiosController@updateSchooling');
//eliminar un registro de un estudio realizado
Route::delete('/delete-schooling/{id}', 'EstudiosController@deleteSchooling');

////////////////////////////Experiencia academica////////////////////////////////////
//registro de experiencia academica
Route::post('/register-academic-exp', 'ExperienciaAcademicaController@register');
//lista de TODOS los registros de experiencia academica
Route::get('/list-academic-exp', 'ExperienciaAcademicaController@listAcademicExp');
//lista de TODOS los registros de experiencia academica por hoja de vida
Route::get('/list-academic-exp/{idHv}', 'ExperienciaAcademicaController@listAcademicExpByHv');
//consultar un registro de experiencia academica por id
Route::get('/academic-exp/{id}', 'ExperienciaAcademicaController@getAcademicExpById');
//actualizar un registro de experiencia academica
Route::put('/update-academic-exp/{id}', 'ExperienciaAcademicaController@updateAcademicExp');
//eliminar un registro de un registro de experiencia academica
Route::delete('/delete-academic-exp/{id}', 'ExperienciaAcademicaController@deleteAcademicExp');

////////////////////////////Experiencia no academica////////////////////////////////////
//registro de experiencia no academica
Route::post('/register-no-academic-exp', 'ExperienciaNoAcademicaController@register');
//lista de TODOS los registros de experiencia no academica
Route::get('/list-no-academic-exp', 'ExperienciaNoAcademicaController@listNoAcademicExp');
//lista de TODOS los registros de experiencia academica por hoja de vida
Route::get('/list-no-academic-exp/{idHv}', 'ExperienciaNoAcademicaController@listNoAcademicExpByHv');
//consultar un registro de experiencia no academica por id
Route::get('/no-academic-exp/{id}', 'ExperienciaNoAcademicaController@getNoAcademicExpById');
//actualizar un registro de experiencia no academica
Route::put('/update-no-academic-exp/{id}', 'ExperienciaNoAcademicaController@updateNoAcademicExp');
//eliminar un registro de un registro de experiencia no academica
Route::delete('/delete-no-academic-exp/{id}', 'ExperienciaNoAcademicaController@deleteNoAcademicExp');

////////////////////////////Organizaciones////////////////////////////////////
//registro de organizaciones
Route::post('/register-organization', 'OrganizacionesController@register');
//lista de TODOS los registros de organizaciones
Route::get('/list-organization', 'OrganizacionesController@listOrganization');
//lista de TODOS los registros de organizaciones por hoja de vida
Route::get('/list-organization/{idHv}', 'OrganizacionesController@listOrganizationByHv');
//consultar un registro de organizacion por id
Route::get('/organization/{id}', 'OrganizacionesController@getOrganizationById');
//actualizar un registro de organizacion
Route::put('/update-organization/{id}', 'OrganizacionesController@updateOrganization');
//eliminar un registro de un registro de organizacion
Route::delete('/delete-organization/{id}', 'OrganizacionesController@deleteOrganization');

////////////////////////////Actividad Profesional////////////////////////////////////
//registro de actividad profesional
Route::post('/register-professional-activ', 'ActividadProfesionalController@register');
//lista de TODOS los registros de actividad profesional
Route::get('/list-professional-activ', 'ActividadProfesionalController@listProfessionalActv');
//lista de TODOS los registros de actividad profesional por hoja de vida
Route::get('/list-professional-activ/{idHv}', 'ActividadProfesionalController@listProfessionalActvByHv');
//consultar un registro de actividad profesional por id
Route::get('/professional-activ/{id}', 'ActividadProfesionalController@getProfessionalActvById');
//actualizar un registro de actividad profesional
Route::put('/update-professional-activ/{id}', 'ActividadProfesionalController@updateProfessionalActv');
//eliminar un registro de un registro de actividad profesional
Route::delete('/delete-professional-activ/{id}', 'ActividadProfesionalController@deleteProfessionalActv');

////////////////////////////Certificaciones////////////////////////////////////
//registro de certificaciones
Route::post('/register-certification', 'CertificacionesController@register');
//lista de TODOS los registros de certificaciones
Route::get('/list-certification', 'CertificacionesController@listCertification');
//lista de TODOS los registros de certificaciones por hoja de vida
Route::get('/list-certification/{idHv}', 'CertificacionesController@listCertificationByHv');
//consultar un registro de certificacion por id
Route::get('/certification/{id}', 'CertificacionesController@getCertificationById');
//actualizar un registro de certificacion
Route::put('/update-certification/{id}', 'CertificacionesController@updateCertification');
//eliminar un registro de un registro de certificacion
Route::delete('/delete-certification/{id}', 'CertificacionesController@deleteCertification');

////////////////////////////Publicaciones////////////////////////////////////
//registro de publicaciones
Route::post('/register-publication', 'PublicacionesController@register');
//lista de TODOS los registros de publicaciones
Route::get('/list-publication', 'PublicacionesController@listPublication');
//lista de TODOS los registros de publicaciones por hoja de vida
Route::get('/list-publication/{idHv}', 'PublicacionesController@listPublicationByHv');
//consultar un registro de publicacion por id
Route::get('/publication/{id}', 'PublicacionesController@getPublicationById');
//actualizar un registro de publicacion
Route::put('/update-publication/{id}', 'PublicacionesController@updatePublication');
//eliminar un registro de un registro de publicacion
Route::delete('/delete-publication/{id}', 'PublicacionesController@deletePublication');

////////////////////////////Coautores////////////////////////////////////
//registro de coautores
Route::post('/register-coauthor', 'CoautoresController@register');
//lista de TODOS los registros de coautores
Route::get('/list-coauthor', 'CoautoresController@listCoauthor');
//lista de TODOS los registros de coautores por publicacion
Route::get('/list-coauthor/{idPb}', 'CoautoresController@listCoauthorByPublication');
//consultar un registro de coautor por id
Route::get('/coauthor/{id}', 'CoautoresController@getCoauthorById');
//actualizar un registro de coautor
Route::put('/update-coauthor/{id}', 'CoautoresController@updateCoauthor');
//eliminar un registro de un registro de coautor
Route::delete('/delete-coauthor/{id}', 'CoautoresController@deleteCoauthor');

////////////////////////////Premios////////////////////////////////////
//registro de premios
Route::post('/register-award', 'PremiosController@register');
//lista de TODOS los registros de premios
Route::get('/list-award', 'PremiosController@listAwards');
//lista de TODOS los registros de premios por hoja de vida
Route::get('/list-award/{idHv}', 'PremiosController@listAwardsByHv');
//consultar un registro de premio por id
Route::get('/award/{id}', 'PremiosController@getAwardsById');
//actualizar un registro de premio
Route::put('/update-award/{id}', 'PremiosController@updateAwards');
//eliminar un registro de un registro de premio
Route::delete('/delete-award/{id}', 'PremiosController@deleteAwards');

////////////////////////////Actividad de Servicio////////////////////////////////////
//registro de actividad profesional
Route::post('/register-service-activ', 'ActividadServicioController@register');
//lista de TODOS los registros de actividad profesional
Route::get('/list-service-activ', 'ActividadServicioController@listServiceActv');
//lista de TODOS los registros de actividad profesional por hoja de vida
Route::get('/list-service-activ/{idHv}', 'ActividadServicioController@listServiceActvByHv');
//consultar un registro de actividad profesional por id
Route::get('/service-activ/{id}', 'ActividadServicioController@getServiceActvById');
//actualizar un registro de actividad profesional
Route::put('/update-service-activ/{id}', 'ActividadServicioController@updateServiceActv');
//eliminar un registro de actividad profesional
Route::delete('/delete-service-activ/{id}', 'ActividadServicioController@deleteServiceActv');

////////////////////////////Información de Curso////////////////////////////////////
//registro de informacion de curso
Route::post('/register-subject', 'InformacionCursoController@register');
//lista de TODOS los registros de informacion de curso por usuario
Route::get('/list-subject/{idUsuario}', 'InformacionCursoController@listSubjectInfByIdUser');
//consultar un registro de informacion de curso por id
Route::get('/subject/{id}', 'InformacionCursoController@getSubjectInfById');
//consultar un registro de informacion de curso por id con detalles
Route::get('/subject-details/{id}', 'InformacionCursoController@getSubjectInfDetById');
//actualizar un registro de informacion de curso
Route::put('/update-subject/{id}', 'InformacionCursoController@updateSubjectInf');
//eliminar un registro de informacion de curso
Route::delete('/delete-subject/{id}', 'InformacionCursoController@deleteSubjectInf');

////////////////////////////Libros////////////////////////////////////
//registro de libros
Route::post('/register-book', 'LibrosController@register');
//lista de TODOS los registros de libros
Route::get('/list-book', 'LibrosController@listBooks');
//lista de TODOS los registros de libros por curso
Route::get('/list-book/{idC}', 'LibrosController@listBooksByC');
//consultar un registro de libros por id
Route::get('/book/{id}', 'LibrosController@getBooksById');
//actualizar un registro de libros
Route::put('/update-book/{id}', 'LibrosController@updateBooks');
//eliminar un registro de libros
Route::delete('/delete-book/{id}', 'LibrosController@deleteBooks');

////////////////////////////Prerequisitos////////////////////////////////////
//registro de prerequisitos
Route::post('/register-prerequisite', 'PrerequisitosController@register');
//lista de TODOS los registros de prerequisitos
Route::get('/list-prerequisite', 'PrerequisitosController@listPrerequisites');
//lista de TODOS los registros de prerequisitos por curso
Route::get('/list-prerequisite/{idC}', 'PrerequisitosController@listPrerequisitesByC');
//consultar un registro de prerequisitos por id
Route::get('/prerequisite/{id}', 'PrerequisitosController@getPrerequisitesById');
//actualizar un registro de prerequisitos
Route::put('/update-prerequisite/{id}', 'PrerequisitosController@updatePrerequisites');
//eliminar un registro de prerequisitos
Route::delete('/delete-prerequisite/{id}', 'PrerequisitosController@deletePrerequisites');

////////////////////////////Objetivos especificos////////////////////////////////////
//registro de objetivos
Route::post('/register-objective', 'ObjetivosController@register');
//lista de TODOS los registros de objetivos
Route::get('/list-objective', 'ObjetivosController@listObjectives');
//lista de TODOS los registros de objetivos por curso
Route::get('/list-objective/{idC}', 'ObjetivosController@listObjectivesByC');
//consultar un registro de objetivos por id
Route::get('/objective/{id}', 'ObjetivosController@getObjectivesById');
//actualizar un registro de objetivos
Route::put('/update-objective/{id}', 'ObjetivosController@updateObjectives');
//eliminar un registro de objetivos
Route::delete('/delete-objective/{id}', 'ObjetivosController@deleteObjectives');

////////////////////////////Student Outcomes////////////////////////////////////
//registro de student outcomes
Route::post('/register-student-outcome', 'StudentOutcomesController@register');
//lista de TODOS los registros de student outcomes
Route::get('/list-student-outcome', 'StudentOutcomesController@listStudentOutcomes');
//lista de TODOS los registros de student outcomes por curso
Route::get('/list-student-outcome/{idC}', 'StudentOutcomesController@listStudentOutcomesByC');
//consultar un registro de student outcomes por id
Route::get('/student-outcome/{id}', 'StudentOutcomesController@getStudentOutcomesById');
//actualizar un registro de student outcomes
Route::put('/update-student-outcome/{id}', 'StudentOutcomesController@updateStudentOutcomes');
//eliminar un registro de student outcomes
Route::delete('/delete-student-outcome/{id}', 'StudentOutcomesController@deleteStudentOutcomes');

////////////////////////////Temas de Curso////////////////////////////////////
//registro de temas de curso
Route::post('/register-topic', 'TemasCursoController@register');
//lista de TODOS los registros de temas de curso
Route::get('/list-topic', 'TemasCursoController@listTopics');
//lista de TODOS los registros de temas de curso por curso
Route::get('/list-topic/{idC}', 'TemasCursoController@listTopicsByC');
//consultar un registro de temas de curso por id
Route::get('/topic/{id}', 'TemasCursoController@getTopicsById');
//actualizar un registro de temas de curso
Route::put('/update-topic/{id}', 'TemasCursoController@updateTopics');
//eliminar un registro de temas de curso
Route::delete('/delete-topic/{id}', 'TemasCursoController@deleteTopics');

////////////////////////////Carpetas de Asignaturas////////////////////////////////////
//registro de carpeta de asignatura
Route::post('/register-subject-folder', 'CarpetasAsignaturaController@register');
//lista de TODOS los registros de carpeta de asignatura
Route::get('/list-subject-folder', 'CarpetasAsignaturaController@listSubjectFolder');
//lista de TODOS los registros de carpeta de asignatura por curso
Route::get('/list-subject-folder/{idU}', 'CarpetasAsignaturaController@listSubjectFolderByC');
//consultar un registro de carpeta de asignatura por id
Route::get('/subject-folder/{id}', 'CarpetasAsignaturaController@getSubjectFolderById');
//actualizar un registro de carpeta de asignatura
Route::put('/update-subject-folder/{id}', 'CarpetasAsignaturaController@updateSubjectFolder');
//eliminar un registro de carpeta de asignatura
Route::delete('/delete-subject-folder/{id}', 'CarpetasAsignaturaController@deleteSubjectFolder');

////////////////////////////Secciones////////////////////////////////////
//registro de premios
Route::post('/register-section', 'SeccionesController@register');
//lista de TODOS los registros de premios
Route::get('/list-section', 'SeccionesController@listSections');
//lista de TODOS los registros de premios por hoja de vida
Route::get('/list-section/{idHv}', 'SeccionesController@listSectionsByC');
//consultar un registro de premio por id
Route::get('/section/{id}', 'SeccionesController@getSectionsById');
//actualizar un registro de premio
Route::put('/update-section/{id}', 'SeccionesController@updateSections');
//eliminar un registro de un registro de premio
Route::delete('/delete-section/{id}', 'SeccionesController@deleteSections');

////////////////////////////Portadas////////////////////////////////////
//registro de portada
Route::post('/upload-cover', 'PortadasController@register');
//lista de TODOS los registros de archivos
Route::get('/list-files/{idS}/{tipo}', 'SeccionesController@getFileList');
//consultar un registro de portada por id de curso
Route::get('/subject-cover/{idC}', 'PortadasController@GetCoverByC');
//consultar un registro de portada por id
Route::get('/cover/{id}', 'PortadasController@getCoverById');
//actualizar un registro de portada
Route::put('/update-cover/{id}', 'PortadasController@updateCover');
//eliminar un registro de un registro de portada
Route::delete('/delete-cover/{id}', 'PortadasController@deleteCover');

////////////////////////////Carpetas de So////////////////////////////////////
//registro de carpeta so
Route::post('/register-so-folder', 'CarpetasSoController@register');
//lista de TODOS los registros de carpeta so
Route::get('/list-so-folder', 'CarpetasSoController@listSoFolder');
//lista de TODOS los registros de carpeta so por usuario
Route::get('/list-so-folder/{idU}', 'CarpetasSoController@listSoFolderByU');
//consultar un registro de carpeta so por id
Route::get('/so-folder/{id}', 'CarpetasSoController@getSoFolderById');
//actualizar un registro de carpeta so
Route::put('/update-so-folder/{id}', 'CarpetasSoController@updateSoFolder');
//eliminar un registro de carpeta so
Route::delete('/delete-so-folder/{id}', 'CarpetasSoController@deleteSoFolder');

////////////////////////////Actas de mejoramiento////////////////////////////////////
//registro de actas de mejoramiento
Route::post('/register-continuous-improvement', 'ActasMejoramientoController@register');
//lista de TODOS los registros de actas de mejoramiento
Route::get('/list-continuous-improvement', 'ActasMejoramientoController@listActaMejoramiento');
//lista de TODOS los registros de actas de mejoramiento por carpeta
Route::get('/list-continuous-improvement/{idCSO}', 'ActasMejoramientoController@listActaMejoramientoByCso');
//consultar un registro de actas de mejoramiento por id
Route::get('/continuous-improvement/{id}', 'ActasMejoramientoController@getActaMejoramientoById');
//actualizar un registro de actas de mejoramiento
Route::put('/update-continuous-improvement/{id}', 'ActasMejoramientoController@updateActaMejoramiento');
//eliminar un registro de actas de mejoramiento
Route::delete('/delete-continuous-improvement/{id}', 'ActasMejoramientoController@deleteActaMejoramiento');

////////////////////////////Actas de so////////////////////////////////////
//registro de actas de so
Route::post('/register-minute', 'ActasSoController@register');
//lista de TODOS los registros de actas de so
Route::get('/list-minute', 'ActasSoController@listActaSo');
//lista de TODOS los registros de actas de so por carpeta
Route::get('/list-minute/{idCSO}', 'ActasSoController@listActaSoByCso');
//consultar un registro de actas de so por id
Route::get('/minute/{id}', 'ActasSoController@getActaSoById');
//actualizar un registro de actas de so
Route::put('/update-minute/{id}', 'ActasSoController@updateActaSo');
//eliminar un registro de actas de so
Route::delete('/delete-minute/{id}', 'ActasSoController@deleteActaSo');

////////////////////////////Asistentes////////////////////////////////////
//registro de asistente
Route::post('/register-attendant', 'AsistentesController@register');
//lista de TODOS los registros de asistente
Route::get('/list-attendant', 'AsistentesController@listAttendant');
//lista de TODOS los registros de asistente por acta
Route::get('/list-attendant/{idAso}', 'AsistentesController@listAttendantByAso');
//consultar un registro de asistente por id
Route::get('/attendant/{id}', 'AsistentesController@getAttendantById');
//actualizar un registro de asistente
Route::put('/update-attendant/{id}', 'AsistentesController@updateAttendant');
//eliminar un registro de asistente
Route::delete('/delete-attendant/{id}', 'AsistentesController@deleteAttendant');

////////////////////////////Actividades////////////////////////////////////
//registro de actividades de compromiso
Route::post('/register-activity', 'ActividadesController@register');
//lista de TODOS los registros de actividades de compromiso
Route::get('/list-activity', 'ActividadesController@listActivity');
//lista de TODOS los registros de actividades de compromiso por acta
Route::get('/list-activity/{idAso}', 'ActividadesController@listActivityByAso');
//consultar un registro de actividades de compromiso por id
Route::get('/activity/{id}', 'ActividadesController@getActivityById');
//actualizar un registro de actividades de compromiso
Route::put('/update-activity/{id}', 'ActividadesController@updateActivity');
//eliminar un registro de actividades de compromiso
Route::delete('/delete-activity/{id}', 'ActividadesController@deleteActivity');

////////////////////////////Cursos////////////////////////////////////
//registro de curso
Route::post('/register-course', 'CursosController@register');
//lista de TODOS los registros de curso
Route::get('/list-course', 'CursosController@listCourse');
//consultar un registro de curso por id
Route::get('/course/{id}', 'CursosController@getCourseById');
//actualizar un registro de curso
Route::put('/update-course/{id}', 'CursosController@updateCourse');
//eliminar un registro de curso
Route::delete('/delete-course/{id}', 'CursosController@deleteCurso');

////////////////////////////Docentes////////////////////////////////////
//registro de docente
Route::post('/register-faculty', 'DocentesController@register');
//lista de TODOS los registros de docente
Route::get('/list-faculty', 'DocentesController@listFaculty');
//lista de los registros de docente por curso
Route::get('/list-faculty/{idC}', 'DocentesController@listFacultyByCourse');
//consultar un registro de docente por id
Route::get('/faculty/{id}', 'DocentesController@getFacultyById');
//actualizar un registro de docente
Route::put('/update-faculty/{id}', 'DocentesController@updateFaculty');
//eliminar un registro de docente
Route::delete('/delete-faculty/{id}', 'DocentesController@deleteFaculty');

////////////////////////////Archivos////////////////////////////////////
//registro de archivo
Route::post('/upload-file', 'ArchivosController@register');
//lista de TODOS los registros de archivos
Route::get('/list-files/{idS}/{tipo}', 'ArchivosController@getFileList');
//consultar un registro de archivo por id de seccion
Route::get('/section-file/{ids}', 'ArchivosController@GetFileByS');
//consultar un registro de archivo por id
Route::get('/file/{id}', 'ArchivosController@getFileById');
//actualizar un registro de archivo
Route::put('/update-file/{id}', 'ArchivosController@updateFile');
//eliminar un registro de un registro de archivo
Route::delete('/delete-file/{id}', 'ArchivosController@deleteFile');