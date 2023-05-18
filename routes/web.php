<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

Route::get('/', function () {
	return view('welcome');
});

Route::get('/home',        'App\Http\Controllers\Front\Modules\HomeController@index')->name('home');
Route::get('/home/create', 'App\Http\Controllers\Front\Modules\HomeController@create')->name('home');
Route::post('/home/store', 'App\Http\Controllers\Front\Modules\HomeController@store')->name('home');

Route::group(['middleware' => ['web']], function() {

	Auth::routes();

	Route::get('/login',            ['as' => 'login',           'uses' => 'App\Http\Controllers\Admin\System\AuthController@login']);
	Route::post('/login_processor', ['as' => 'login_processor', 'uses' => 'App\Http\Controllers\Admin\System\AuthController@login_processor']);
	Route::get('/logout',           ['as' => 'logout',          'uses' => 'App\Http\Controllers\Admin\System\AuthController@logout']);

	Route::group(['middleware' => 'auth'], function() {

		Route::resource('dashboard', 'App\Http\Controllers\Admin\System\DashboardController');

		// SYSTEM
		Route::group(['prefix' => 'system'], function() {

			// CONFIGURATION
			Route::group(['prefix' => 'config'], function() {
				Route::resource('module',     'App\Http\Controllers\Admin\System\ModulesController',     ['as' => 'system.config']);
				Route::resource('preference', 'App\Http\Controllers\Admin\System\PreferenceController',  ['as' => 'system.config']);
				Route::resource('group',      'App\Http\Controllers\Admin\System\GroupController',       ['as' => 'system.config']);
				
			//	Route::resource('icon',       'App\Http\Controllers\Admin\System\IconController',        ['as' => 'system.config']);
				Route::resource('log',        'App\Http\Controllers\Admin\System\LogController',         ['as' => 'system.config']);
				Route::resource('etl',        'App\Http\Controllers\Admin\System\ExtransloadController', ['as' => 'system.config']);
			});

			// ACCOUNTS
			Route::group(['prefix' => 'accounts'], function() {
				Route::resource('user',       'App\Http\Controllers\Admin\System\UserController',           ['as' => 'system.accounts']);
				Route::resource('import_csv', 'App\Http\Controllers\Admin\System\ImportAccountsController', ['as' => 'system.accounts']);
			});
		});

		Route::group(['prefix' => 'modules'], function() {
			
			Route::group(['prefix' => 'development'], function() {
				Route::resource('form', 'App\Http\Controllers\Admin\Modules\FormController', ['as' => 'modules.development']);
			});
			
		    Route::group(['prefix' => 'programs'], function() {
		        Route::resource('keren_pro',           'App\Http\Controllers\Admin\Modules\Programs\Keren\KerenProController',      ['as' => 'modules.programs']);		        
		        Route::resource('keren_pro_data',      'App\Http\Controllers\Admin\Modules\Programs\Keren\KerenProDataController',  ['as' => 'modules.programs']);
		        Route::resource('merapi',              'App\Http\Controllers\Admin\Modules\Programs\Merapi\MerapiController',       ['as' => 'modules.programs']);
		        
		        Route::resource('fit',                 'App\Http\Controllers\Admin\Modules\Programs\Fit\FitController',             ['as' => 'modules.programs']);
		        Route::resource('fit_pro',             'App\Http\Controllers\Admin\Modules\Programs\Fit\FitProController',          ['as' => 'modules.programs']);
		        Route::resource('freesp3gb',           'App\Http\Controllers\Admin\Modules\Programs\FreeSP3GB\FreeSP3GBController', ['as' => 'modules.programs']);
		        Route::resource('salesforce_canvaser', 'App\Http\Controllers\Admin\Modules\Programs\SalesforceCanvaserController',  ['as' => 'modules.programs']);
		        
		        Route::resource('low_denom',           'App\Http\Controllers\Admin\Modules\Programs\LowDenomController',            ['as' => 'modules.programs']);
		    });
		        
	        Route::group(['prefix' => 'reports'], function() {
	        	Route::resource('natuna_anambas',      'App\Http\Controllers\Admin\Modules\Reports\NatunaAnambasController',        ['as' => 'modules.reports']);
	        	Route::resource('trikom_wireless',     'App\Http\Controllers\Admin\Modules\Reports\TrikomWirelessController',       ['as' => 'modules.reports']);
	        	Route::resource('challange',           'App\Http\Controllers\Admin\Modules\Reports\ChallangeController',            ['as' => 'modules.reports']);
	        });
	        Route::group(['prefix' => 'kpi'], function() {
	            Route::resource('distributors', 'App\Http\Controllers\Admin\Modules\Kpi\KpiDistributorsController', ['as' => 'modules.kpi']);
	        });
	        	
        	Route::group(['prefix' => 'incentive'], function() {
        		Route::resource('incentive', 'App\Http\Controllers\Admin\Modules\Incentive\IncentiveController', ['as' => 'modules.incentive']);
        	});
		});

		Route::group(['prefix' => 'ajax'], function() {
			Route::post('post',   ['uses' => 'App\Http\Controllers\Admin\System\AjaxController@post',   'as' => 'ajax.post']);			
			Route::post('export', ['uses' => 'App\Http\Controllers\Admin\System\AjaxController@export', 'as' => 'ajax.export']);
		});
	});
});