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

Route::get('/', function () {
   // return \Artisan::call('config:cache');
	return 'comming soon';
});

Auth::routes();

Route::get('create_admin', function () {
	$user = App\User::create(['name' => 'admin', 'email' => 'admin@admin.com', 'city_id' => '1', 'phone' => '01094300234', 'password' => bcrypt(123456)]);
	/*
			create Role Admin if not exists
		 */
	$role_admin = App\Models\Role::firstOrCreate(['name' => 'admin']);

	$user->assignRole('admin');

	return redirect(url('admin'));
});

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin', 'auth']], function () {
	Route::get('/', 'HomeController@admin');
	Route::get('home', 'HomeController@index');
	Route::resource('users', 'UserController', ["as" => 'admin']);
	Route::resource('categories', 'CategoryController', ["as" => 'admin']);
	Route::resource('roles', 'RoleController', ["as" => 'admin']);
	Route::resource('countries', 'CountryController', ["as" => 'admin']);
	Route::resource('cities', 'CityController', ["as" => 'admin']);
	Route::resource('states', 'StateController', ["as" => 'admin']);
	Route::resource('auctions', 'AuctionController', ["as" => 'admin']);
	Route::resource('files', 'FileController', ["as" => 'admin']);
	Route::resource('favorites', 'FavoriteController', ["as" => 'admin']);
	Route::resource('offers', 'OfferController', ["as" => 'admin']);
	Route::resource('settings', 'SettingController', ["as" => 'admin']);
	Route::get('lang/{lang}', function ($lang) {
		session()->has('lang') ? session()->forget('lang') : '';
		$lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
		return back();
	});
	
	Route::resource('conversations', 'ConversationController', ["as" => 'admin']);
	Route::resource('messages', 'MessageController', ["as" => 'admin']);
	
});

Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');
Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');
Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate', '\App\Http\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');
Route::post(
	'generator_builder/generate-from-file',
	'\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');
