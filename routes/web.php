<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Admin Authentication
Route::get(	'/login',						['as' => 'login', 						'uses' => 'AuthController@GET_loginForm']);
Route::post('/login',						['as' => '_auth.login.post', 			'uses' => 'AuthController@GET_loginUser']);
Route::get(	'/logout', 						['as' => 'logout', 						'uses' => 'AuthController@GET_logoutUser']);

//New User Registration
Route::get(	'/register',					['as' => 'register', 					'uses' => 'RegisterController@GET_registerForm']);
Route::post('/register',					['as' => 'register.post', 				'uses' => 'RegisterController@POST_registerForm']);

//RESTful API
Route::get('/api/employees.json', 			['as' => '_api.employees', 				'uses' => 'APIController@GET_employees']);
Route::get('/api/update_employees',			['as' => '_api.update_employees_db',	'uses' => 'APIController@GET_update_db']);
Route::get('/api/division',                 ['as' => '_api.division',               'uses' => 'APIController@GET_division']);
Route::get('/api/alldivision',              ['as' => '_api.alldivision',            'uses' => 'APIController@GET_allDivision']);
Route::get('/api/department',               ['as' => '_api.department',             'uses' => 'APIController@GET_department']);
Route::get('/api/alldepartment',            ['as' => '_api.alldepartment',          'uses' => 'APIController@GET_allDepartment']);
Route::get('/api/listDepartment.json/{id}', ['as' => '_api.listDepartment',         'uses' => 'APIController@GET_listDepartment']);
Route::get('/api/section',                  ['as' => '_api.section',                'uses' => 'APIController@GET_section']);
Route::get('/api/allsection',               ['as' => '_api.allsection',             'uses' => 'APIController@GET_allSection']);
Route::get('/api/listSection.json/{id}',    ['as' => '_api.listSection',            'uses' => 'APIController@GET_listSection']);
Route::get('/api/allunit',                  ['as' => '_api.allunit',                'uses' => 'APIController@GET_allUnit']);
Route::get('/api/allsubunit',               ['as' => '_api.allsubunit',             'uses' => 'APIController@GET_allSubunit']);
Route::get('/api/group/assign/{id}',        ['as' => '_api.group',                  'uses' => 'APIController@GET_group']);
Route::get('/api/listTemplate.json/{id}',   ['as' => '_api.listTemplate',           'uses' => 'APIController@GET_listTemplate']);

// Auth::routes();

Route::group(['middleware' => 'permissions'], function () 
{
    
    //##################################### ADMINISTRATOR | SYSTEM ADMINISTRATOR #####################################################

    //Login
    Route::get('/', 						['as' => 'home', 						'uses' => 'HomeController@GET_index']);

    //Locked
    Route::get('/locked',                   ['as' => 'locked',                      'uses' => 'HomeController@GET_locked']);

    //Group
    Route::get('/group/assign',             ['as' => 'group.assign',                'uses' => 'GroupController@GET_assignGroup']);
    Route::get('/group/assign/{id}',        ['as' => 'group.assign.post',           'uses' => 'GroupController@POST_assignGroup']);
    Route::get('/group/list',               ['as' => 'group.list',                  'uses' => 'GroupController@GET_listGroup']);

    //Division
    Route::get('/division', 				['as' => 'division', 					'uses' => 'DivisionController@GET_division']);
    Route::get('/division/new', 			['as' => 'division.new', 				'uses' => 'DivisionController@GET_newDivision']);
    Route::post('/division/new', 			['as' => 'division.new.post', 			'uses' => 'DivisionController@POST_newDivision']);
    Route::get('/division/view/{id}',       ['as' => 'division.view',               'uses' => 'DivisionController@GET_viewDivision']);
    Route::get('/division/update/{id}', 	['as' => 'division.update', 			'uses' => 'DivisionController@GET_updateDivision']);
    Route::put('/division/update/{id}',		['as' => 'division.update.put', 		'uses' => 'DivisionController@PUT_updateDivision']);
    Route::post('/division/delete/{id}',	['as' => 'division.delete', 			'uses' => 'DivisionController@DELETE_division']);

    //Department
    Route::get('/department',               ['as' => 'department',                  'uses' => 'DepartmentController@GET_department']);
    Route::get('/department/new',           ['as' => 'department.new',              'uses' => 'DepartmentController@GET_newDepartment']);
    Route::post('/department/new',          ['as' => 'department.new.post',         'uses' => 'DepartmentController@POST_newDepartment']);
    Route::get('/department/view/{id}',     ['as' => 'department.view',             'uses' => 'DepartmentController@GET_viewDepartment']);
    Route::get('/department/update/{id}',   ['as' => 'department.update',           'uses' => 'DepartmentController@GET_updateDepartment']);
    Route::put('/department/update/{id}',   ['as' => 'department.update.put',       'uses' => 'DepartmentController@PUT_updateDepartment']);
    Route::post('/department/delete/{id}',  ['as' => 'department.delete',           'uses' => 'DepartmentController@DELETE_department']);

    //Section
    Route::get('/section',                  ['as' => 'section',                     'uses' => 'SectionController@GET_section']);
    Route::get('/section/new',              ['as' => 'section.new',                 'uses' => 'SectionController@GET_newSection']);
    Route::post('/section/new',             ['as' => 'section.new.post',            'uses' => 'SectionController@POST_newSection']);
    Route::get('/section/view/{id}',        ['as' => 'section.view',                'uses' => 'SectionController@GET_viewSection']);
    Route::get('/section/update/{id}',      ['as' => 'section.update',              'uses' => 'SectionController@GET_updateSection']);
    Route::put('/section/update/{id}',      ['as' => 'section.update.put',          'uses' => 'SectionController@PUT_updateSection']);
    Route::post('/section/delete/{id}',     ['as' => 'section.delete',              'uses' => 'SectionController@DELETE_section']);

    //Unit
    Route::get('/unit',                     ['as' => 'unit',                        'uses' => 'UnitController@GET_unit']);
    Route::get('/unit/new',                 ['as' => 'unit.new',                    'uses' => 'UnitController@GET_newUnit']);
    Route::post('/unit/new',                ['as' => 'unit.new.post',               'uses' => 'UnitController@POST_newUnit']);
    Route::get('/unit/view/{id}',           ['as' => 'unit.view',                   'uses' => 'UnitController@GET_viewUnit']);
    Route::get('/unit/update/{id}',         ['as' => 'unit.update',                 'uses' => 'UnitController@GET_updateUnit']);
    Route::put('/unit/update/{id}',         ['as' => 'unit.update.put',             'uses' => 'UnitController@PUT_updateUnit']);
    Route::post('/unit/delete/{id}',        ['as' => 'unit.delete',                 'uses' => 'UnitController@DELETE_unit']);

    //Subunit
    Route::get('/subunit',                  ['as' => 'subunit',                     'uses' => 'SubunitController@GET_subunit']);
    Route::get('/subunit/new',              ['as' => 'subunit.new',                 'uses' => 'SubunitController@GET_newSubunit']);
    Route::post('/subunit/new',             ['as' => 'subunit.new.post',            'uses' => 'SubunitController@POST_newSubunit']);
    Route::get('/subunit/view/{id}',        ['as' => 'subunit.view',                'uses' => 'SubunitController@GET_viewSubunit']);
    Route::get('/subunit/update/{id}',      ['as' => 'subunit.update',              'uses' => 'SubunitController@GET_updateSubunit']);
    Route::put('/subunit/update/{id}',      ['as' => 'subunit.update.put',          'uses' => 'SubunitController@PUT_updateSubunit']);
    Route::post('/subunit/delete/{id}',     ['as' => 'subunit.delete',              'uses' => 'SubunitController@DELETE_subunit']);

    //Document
    Route::get('/document',                 ['as' => 'document',                    'uses' => 'DocumentController@GET_document']);
    Route::get('/document/new',             ['as' => 'document.new',                'uses' => 'DocumentController@GET_newDocument']);
    Route::post('/document/new',            ['as' => 'document.new.post',           'uses' => 'DocumentController@POST_newDocument']);
    Route::get('/document/view/{id}',       ['as' => 'document.view',               'uses' => 'DocumentController@GET_viewDocument']);
    Route::get('/document/update/{id}',     ['as' => 'document.update',             'uses' => 'DocumentController@GET_updateDocument']);
    Route::put('/document/update/{id}',     ['as' => 'document.update.put',         'uses' => 'DocumentController@PUT_updateDocument']);
    Route::post('/document/delete/{id}',    ['as' => 'document.delete',             'uses' => 'DocumentController@DELETE_document']);

    //Template
    Route::get('/template',                 ['as' => 'template',                    'uses' => 'TemplateController@GET_template']);
    Route::get('/template/new',             ['as' => 'template.new',                'uses' => 'TemplateController@GET_newTemplate']);
    Route::post('/template/new',            ['as' => 'template.new.post',           'uses' => 'TemplateController@POST_newTemplate']);
    Route::get('/template/view/{id}',       ['as' => 'template.view',               'uses' => 'TemplateController@GET_viewTemplate']);
    Route::get('/template/update/{id}',     ['as' => 'template.update',             'uses' => 'TemplateController@GET_updateTemplate']);
    Route::put('/template/update/{id}',     ['as' => 'template.update.put',         'uses' => 'TemplateController@PUT_updateTemplate']);
    Route::post('/template/delete/{id}',    ['as' => 'template.delete',             'uses' => 'TemplateController@DELETE_Template']);

    //Document
    Route::get('/sequence',                 ['as' => 'sequence',                    'uses' => 'SequenceController@GET_sequence']);
    Route::get('/sequence/new',             ['as' => 'sequence.new',                'uses' => 'SequenceController@GET_newSequence']);
    Route::post('/sequence/new',            ['as' => 'sequence.new.post',           'uses' => 'SequenceController@POST_newSequence']);
    Route::get('/sequence/view/{id}',       ['as' => 'sequence.view',               'uses' => 'SequenceController@GET_viewSequence']);
    Route::get('/sequence/update/{id}',     ['as' => 'sequence.update',             'uses' => 'SequenceController@GET_updateSequence']);
    Route::put('/sequence/update/{id}',     ['as' => 'sequence.update.put',         'uses' => 'SequenceController@PUT_updateSequence']);

    //########################################################### RIM USER ############################################################
    Route::get('/dashboard',                ['as' => 'dashboard',                   'uses' => 'DashboardController@GET_dashboard']);

});