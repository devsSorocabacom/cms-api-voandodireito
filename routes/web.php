<?php
 
/* ROUTES SITE */
Route::get('/sorocabacomclearcache', function() {
	Artisan::call('cache:clear');
	Artisan::call('config:cache');
	Artisan::call('config:clear');
	Artisan::call('view:clear');
	return "Cache is cleared";
});

Route::redirect('/', 'cms');

/* ROUTES AUTHENTICATE */
Route::group(['prefix'=>'cms'], function(){
	Auth::routes();
});

/* ROUTES CMS */
Route::group(['prefix'=>'cms','middleware' => 'auth'], function(){
	Route::get('/', 'DashboardController@index')->name('dashboard');
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');

	//Static Pages
	//Route::resource('pages', 'PagesController');
	Route::resource('informacoes', 'InformacoesController');
	Route::resource('usuarios', 'UsersController');
	Route::resource('topics', 'TopicsController');
	Route::resource('results', 'ResultsController');

	Route::get('generateResultsToExcel', 'ResultsController@generateResultsToExcel')->name('generateResultsToExcel');
	Route::post('results/modal', 'ResultsController@show')->name("results.modal");
	Route::post('results/destroyAll', 'ResultsController@destroyAll')->name("results.destroyAll");
	
	//Filtros
	Route::get('filtrar/usuarios', 'FiltrosController@usuariosfiltro')->name('usuarios.filtro');
	Route::get('buscar/usuarios', 'FiltrosController@usuariosbusca')->name('usuarios.busca');  
	Route::get('buscar/topics', 'FiltrosController@topicsbusca')->name('topics.busca');
	Route::get('filtrar/topics', 'FiltrosController@topicsfiltro')->name('topics.filtro');
	Route::get('buscar/results', 'FiltrosController@resultsbusca')->name('results.busca');
});
