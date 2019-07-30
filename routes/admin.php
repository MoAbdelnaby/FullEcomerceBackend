<?php 

Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function () {

	Config::set('auth.defines','admin');
	Route::get('login','AdminAuth@login');
	Route::post('login','AdminAuth@dologin');
	Route::get('forgot/password','AdminAuth@forgot_password');
	Route::post('forgot/password','AdminAuth@forgot_password_post');
	Route::get('reset/password/{token}','AdminAuth@reset_password');
	Route::post('reset/password/{token}','AdminAuth@reset_password_final');
	
	Route::group(['middleware' => 'admin:admin'], function () {


		Route::resource('admin', 'AdminController');
		Route::delete('admin/destroy/all','AdminController@multidelete');

		Route::resource('users', 'UsersController');
		Route::delete('users/destroy/all','UsersController@multidelete');

		Route::resource('countries', 'CountriesController');
		Route::delete('countries/destroy/all','CountriesController@multidelete');

		Route::resource('states', 'StatesController');
		Route::delete('states/destroy/all','StatesController@multidelete');

		Route::resource('cities', 'CitiesController');
		Route::delete('cities/destroy/all','CitiesController@multidelete');

		Route::resource('trademarks', 'TrademarksController');
		Route::delete('trademarks/destroy/all','TrademarksController@multidelete');

		Route::resource('manufacturers', 'manufactController');
		Route::delete('manufacturers/destroy/all','manufactController@multidelete');

		Route::resource('malls', 'MallsController');
		Route::delete('malls/destroy/all','MallsController@multidelete');

		Route::resource('colors', 'ColorsController');
		Route::delete('colors/destroy/all','ColorsController@multidelete');

		Route::resource('weights', 'WeightsController');
		Route::delete('weights/destroy/all','WeightsController@multidelete');

		Route::resource('shipping', 'ShippingController');
		Route::delete('shipping/destroy/all','ShippingController@multidelete');

		Route::resource('sizes', 'SizesController');
		Route::delete('sizes/destroy/all','SizesController@multidelete');

		Route::resource('products', 'ProductsController');
		Route::delete('products/destroy/all','ProductsController@multidelete');

		Route::resource('departments', 'DepartmentsController');
		
		Route::get('/', function () {
			return view('admin.home');
		});

		Route::get('settings','Settings@setting');
		Route::post('settings','Settings@setting_save');

		Route::any('logout','AdminAuth@logout');
	});

	Route::get('lang/{lang}', function($lang) {

		session()->has('lang')? session()->forget('lang') : '';
		

		if($lang ==  "ar")
		{
			session()->put('lang','ar');
		} else {
			
			session()->put('lang','en');
		}

		return back();

	});




});