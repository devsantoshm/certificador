<?php

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::get('/pdf', function () {
    $pdf = App::make('dompdf.wrapper');

    $pdf->loadView('events.pdf.CUFM');
    $pdf->setOrientation('landscape');

    return $pdf->stream();
});

Route::get('/view', function () {
    return view('events.pdf.CUFM');
});

Route::group(['middleware' => ['web']], function () {
    Route::auth();

    Route::get(
        '/home',
        ['as' => 'home.index', 'uses' => 'HomeController@index']
    );

    // Prof.
    Route::get(
        '/profesores',
        ['as' => 'professors.index', 'uses' => 'ProfessorsController@index']
    );
    Route::get(
        '/profesores/crear/{personalDetailsID}',
        ['as' => 'professors.create', 'uses' => 'ProfessorsController@create']
    );
    Route::post(
        '/profesores/{personalDetailsID}',
        ['as' => 'professors.store', 'uses' => 'ProfessorsController@store']
    );
    Route::get(
        '/profesores/{id}/editar',
        ['as' => 'professors.edit', 'uses' => 'ProfessorsController@edit']
    );
    Route::patch(
        '/profesores/{id}',
        ['as' => 'professors.update', 'uses' => 'ProfessorsController@update']
    );
    Route::delete(
        '/profesores/{id}',
        ['as' => 'professors.destroy', 'uses' => 'ProfessorsController@destroy']
    );

    // Users
    Route::get(
        '/usuarios',
        ['as' => 'users.index', 'uses' => 'UsersController@index']
    );
    Route::get(
        '/usuarios/crear',
        ['as' => 'users.create', 'uses' => 'UsersController@create']
    );
    Route::get(
        '/usuarios/{id}',
        ['as' => 'users.show', 'uses' => 'UsersController@show']
    );
    Route::post(
        '/usuarios',
        ['as' => 'users.store', 'uses' => 'UsersController@store']
    );
    Route::get(
        '/usuarios/{id}/editar',
        ['as' => 'users.edit', 'uses' => 'UsersController@edit']
    );
    Route::patch(
        '/usuarios/{id}',
        ['as' => 'users.update', 'uses' => 'UsersController@update']
    );
    Route::delete(
        '/usuarios/{id}',
        ['as' => 'users.destroy', 'uses' => 'UsersController@destroy']
    );

    // Personal Details
    Route::get(
        '/datos-personales/crear/{userID}',
        ['as'   => 'personalDetails.create',
         'uses' => 'PersonalDetailsController@create',
        ]
    );
    Route::post(
        '/datos-personales/{userID}',
        ['as'   => 'personalDetails.store',
         'uses' => 'PersonalDetailsController@store',
        ]
    );
    Route::get(
        '/datos-personales/{id}/editar',
        ['as'   => 'personalDetails.edit',
         'uses' => 'PersonalDetailsController@edit',
        ]
    );
    Route::patch(
        '/datos-personales/{id}',
        ['as'   => 'personalDetails.update',
         'uses' => 'PersonalDetailsController@update',
        ]
    );

    // Titles
    Route::get(
        '/titulos',
        ['as' => 'titles.index', 'uses' => 'TitlesController@index']
    );
    Route::get(
        '/titulos/crear',
        ['as' => 'titles.create', 'uses' => 'TitlesController@create']
    );
    Route::get(
        '/titulos/{id}',
        ['as' => 'titles.show', 'uses' => 'TitlesController@show']
    );
    Route::post(
        '/titulos',
        ['as' => 'titles.store', 'uses' => 'TitlesController@store']
    );
    Route::get(
        '/titulos/{id}/editar',
        ['as' => 'titles.edit', 'uses' => 'TitlesController@edit']
    );
    Route::patch(
        '/titulos/{id}',
        ['as' => 'titles.update', 'uses' => 'TitlesController@update']
    );
    Route::delete(
        '/titulos/{id}',
        ['as' => 'titles.destroy', 'uses' => 'TitlesController@destroy']
    );

    // Institutes
    Route::get(
        '/institutos',
        ['as' => 'institutes.index', 'uses' => 'InstitutesController@index']
    );
    Route::get(
        '/institutos/crear',
        ['as' => 'institutes.create', 'uses' => 'InstitutesController@create']
    );
    Route::get(
        '/institutos/{id}',
        ['as' => 'institutes.show', 'uses' => 'InstitutesController@show']
    );
    Route::post(
        '/institutos',
        ['as' => 'institutes.store', 'uses' => 'InstitutesController@store']
    );
    Route::get(
        '/institutos/{id}/editar',
        ['as' => 'institutes.edit', 'uses' => 'InstitutesController@edit']
    );
    Route::patch(
        '/institutos/{id}',
        ['as' => 'institutes.update', 'uses' => 'InstitutesController@update']
    );
    Route::delete(
        '/institutos/{id}',
        ['as' => 'institutes.destroy', 'uses' => 'InstitutesController@destroy']
    );

    // Events
    Route::get(
        '/eventos',
        ['as' => 'events.index', 'uses' => 'EventsController@index']
    );
    Route::get(
        '/eventos/crear',
        ['as' => 'events.create', 'uses' => 'EventsController@create']
    );
    Route::get(
        '/eventos/{id}',
        ['as' => 'events.show', 'uses' => 'EventsController@show']
    );
    Route::post(
        '/eventos',
        ['as' => 'events.store', 'uses' => 'EventsController@store']
    );
    Route::get(
        '/eventos/{id}/editar',
        ['as' => 'events.edit', 'uses' => 'EventsController@edit']
    );
    Route::patch(
        '/eventos/{id}',
        ['as' => 'events.update', 'uses' => 'EventsController@update']
    );
    Route::delete(
        '/eventos/{id}',
        ['as' => 'events.destroy', 'uses' => 'EventsController@destroy']
    );

    // InstitutesProfessors
    // Relaciona un profesor lead a un instituto (desde profesor)
    Route::get(
        '/institutos-profesores/crear-lead-prof/{id}',
        [
            'as'   => 'institutesProfessors.createLeadProf',
            'uses' => 'InstitutesProfessorsController@createLeadForProfessor',
        ]
    );
    Route::post(
        '/institutos-profesores/crear-lead-prof/{id}',
        [
            'as'   => 'institutesProfessors.storeLeadProf',
            'uses' => 'InstitutesProfessorsController@storeLeadForProfessor',
        ]
    );

    // Relaciona un profesor lead a un instituto (desde instituto)
    Route::get(
        '/institutos-profesores/crear-lead-inst/{id}',
        [
            'as'   => 'institutesProfessors.createLeadInst',
            'uses' => 'InstitutesProfessorsController@createLeadForInstitute',
        ]
    );
    Route::post(
        '/institutos-profesores/crear-lead-inst/{id}',
        [
            'as'   => 'institutesProfessors.storeLeadInst',
            'uses' => 'InstitutesProfessorsController@storeLeadForInstitute',
        ]
    );

    // Varios profesores a ser insertados a un instituto
    Route::get(
        '/institutos-profesores/crear-prof-inst/{id}',
        [
            'as'   => 'institutesProfessors.createProfInst',
            'uses' => 'InstitutesProfessorsController@createProfessorForInstitute',
        ]
    );
    Route::post(
        '/institutos-profesores/crear-prof-inst/{id}',
        [
            'as'   => 'institutesProfessors.storeProfInst',
            'uses' => 'InstitutesProfessorsController@storeProfessorForInstitute',
        ]
    );

    // Eliminar profesor de instituto
    Route::delete(
        '/institutos-profesores/eliminar-prof-inst/{professor}/{institute}',
        [
            'as'   => 'institutesProfessors.destroyProfInst',
            'uses' => 'InstitutesProfessorsController@destroyProfessorInstitute',
        ]
    );
});
