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

/* Start Web Routes */ 
Route::get('/web','WebController@index');
Route::get('/webLogin','WebController@login');
Route::get('/webRegister','WebController@register');
Route::post('post-register','WebController@save');
Route::post('post-login','WebController@postLogin');
Route::get('user-profile','WebController@profile');
Route::get('change-password','WebController@changePassword');
Route::post('update-user','WebController@userUpdate')->name('update');
Route::get('address','WebController@address')->name('address');
Route::get('state','WebController@state')->name('state');
Route::get('city','WebController@city')->name('city');
Route::post('shipping','WebController@AddShepping')->name('shipping');
Route::get('order-detail','WebController@order_details')->name('order');
Route::get('/order-details/{order_id?}','WebController@detail')->name('onedetail');
Route::get('/order-invoice/{order_id?}','WebController@order_invoice')->name('orde_invoice');
//......Klarna payment route.....//
Route::get('/klarna-payment/{uid}','WebController@klarnapayment')->name("klarna-payment");
Route::get('/klarnaPayorder/{uid}','WebController@klarnaPayorder');
Route::GET('thankyou', function(){
	return view('thankyou');
});
Route::get('/thankyou_user','WebController@thakyou');

// Route::post('update-password','WebController@updatePassword');
Route::get('user-logout','WebController@logout');
Route::get('user-home','WebController@show');
Route::get('/start','WebController@start');
Route::get('/review','WebController@cutomizeFrame');
Route::GET('/review/data/','WebController@data')->name('/review/data/');
Route::post('/upload_image','WebController@upload_image');
Route::post('frame/add', 'WebController@addFrame');
Route::post('removeCartItem', 'WebController@removeCartItem');
Route::post('add_shipping_details', 'WebController@add_shipping_details');
Route::post('add_billing_details', 'WebController@add_billing_details');
Route::post('edit_shipping_details', 'WebController@edit_shipping_details')->name('edit_shipping');
Route::get('/facebookLogin','WebController@facebookLogin');
Route::post('/upload_image1','WebController@upload_image1');
Route::post('edit_order_billing','WebController@edit_order_billing')->name('edit_order_billing');
Route::post('edit_order_shipping','WebController@edit_order_shipping')->name('edit_order_shipping');
Route::get('add_order_cod','WebController@add_order_cod')->name('add_order_cod');
Route::post('add_code','WebController@add_order_promo')->name('code_add');
Route::get('remove_code','WebController@remove_code')->name('code_remove');
/* End Web Routes */ 
 



Route::get('/instagram/feed', [
        'name' => 'Instagram Feed',
        'as' => 'app.instagram.feed',
        'uses' => 'InstagramController@feed',
    ]);


Route::GET('/', function () {
	return redirect('login');
});

Route::GET('/error_page', function () {
	return view('errorpage');
});
Route::GET('resetpasswordapp', function(){
	return view('thankyou');
});

Auth::routes();
// Route::middleware('auth')->group(function (){

Route::group(['middleware'=>['auth','checkUserRole']],function (){

	Route::GET('/home', 'DashboardController@index')->name('home');
	Route::GET('/dashboard', 'DashboardController@index')->name('dashboard');
	Route::GET('/dashboard/index','DashboardController@index')->name('dashboard.index');
	Route::GET('/dashboard/daily', 'DashboardController@daily')->name('dashboard.daily');
	Route::GET('/dashboard/weekly', 'DashboardController@weekly')->name('dashboard.weekly');
	Route::GET('/dashboard/monthly', 'DashboardController@monthly')->name('dashboard.monthly');
	Route::GET('/dashboard/yearly', 'DashboardController@yearly')->name('dashboard.yearly');
	Route::GET('/dashboard/all', 'DashboardController@all')->name('dashboard.all');
	/* START Admin Routes */ 
	Route::group(['namespace' => '\App\Http\Controllers\Admin'], function()
	{
		//chage password
		Route::get('/changePassword','ChangePasswordController@index')->name('changePassword');
		Route::POST('/changePassword/store','ChangePasswordController@store')->name('changePassword/store');	

		//my profile
		Route::get('/edit-profile','MyProfileController@index')->name('edit-profile.index');
		Route::GET('/edit-profile/edit','MyProfileController@edit')->name('edit-profile.edit');	
		Route::PATCH('/edit-profile/update/{id}','MyProfileController@update')->name('edit-profile.update');

		//Module
		Route::GET('/module/index','ModuleController@index')->name('module.index');
		Route::GET('/module/data/{filter_data?}','ModuleController@data')->name('module.data');
		Route::GET('/module/create','ModuleController@create')->name('module.create');
		Route::POST('/module/store','ModuleController@store')->name('module.store');
		Route::GET('/module/edit/{id}','ModuleController@edit')->name('module.edit');
		Route::PATCH('/module/update/{id}','ModuleController@update')->name('module.update');
		Route::GET('/module/status/{id}','ModuleController@status')->name('module.status');
		Route::GET('/module/delete/{id}','ModuleController@destroy')->name('module.delete');

		//Module Action
		Route::GET('/moduleaction/index','ModuleactionController@index')->name('moduleaction.index');
		Route::GET('/moduleaction/data','ModuleactionController@data')->name('moduleaction.data');
		Route::GET('/moduleaction/create','ModuleactionController@create')->name('moduleaction.create');
		Route::POST('/moduleaction/store','ModuleactionController@store')->name('moduleaction.store');

		//Module Action
		Route::GET('/userrole/index','UserroleController@index')->name('userrole.index');
		Route::GET('/userrole/data/{filter_data?}','UserroleController@data')->name('userrole.data');
		Route::GET('/userrole/create','UserroleController@create')->name('userrole.create');
		Route::POST('/userrole/store','UserroleController@store')->name('userrole.store');
		Route::GET('/userrole/edit/{id}','UserroleController@edit')->name('userrole.edit');
		Route::PATCH('/userrole/update/{id}','UserroleController@update')->name('userrole.update');
		Route::GET('/userrole/status/{id}','UserroleController@status')->name('userrole.status');
		Route::GET('/userrole/delete/{id}','UserroleController@destroy')->name('userrole.delete');
		Route::GET('/userrole/view/{id}','UserroleController@view')->name('userrole.view');

		//CMS Action
		Route::GET('/content-management/index','ContentManagementController@index')->name('content-management.index');
		Route::GET('/content-management/data/{filter_data?}','ContentManagementController@data')->name('content-management.data');
		Route::GET('/content-management/create','ContentManagementController@create')->name('content-management.create');
		Route::POST('/content-management/store','ContentManagementController@store')->name('content-management.store');
		Route::GET('/content-management/edit/{id}','ContentManagementController@edit')->name('content-management.edit');
		Route::PATCH('/content-management/update/{id}','ContentManagementController@update')->name('content-management.update');
		Route::GET('/content-management/status/{id}','ContentManagementController@status')->name('content-management.status');
		Route::GET('/content-management/delete/{id}','ContentManagementController@destroy')->name('content-management.delete');
		Route::GET('/content-management/view/{id}','ContentManagementController@view')->name('content-management.view');

		//category management
		Route::GET('/category-management/index','CategoryManagementController@index')->name('category-management.index');
		Route::GET('/category-management/data/{filter_data?}','CategoryManagementController@data')->name('category-management.data');
		Route::GET('/category-management/create','CategoryManagementController@create')->name('category-management.create');
		Route::POST('/category-management/store','CategoryManagementController@store')->name('category-management.store');
		Route::GET('/category-management/edit/{id}','CategoryManagementController@edit')->name('category-management.edit');
		Route::PATCH('/category-management/update/{id}','CategoryManagementController@update')->name('category-management.update');
		Route::GET('/category-management/status/{id}','CategoryManagementController@status')->name('category-management.status');
		Route::GET('/category-management/delete/{id}','CategoryManagementController@destroy')->name('category-management.delete');
		Route::GET('/category-management/view/{id}','CategoryManagementController@view')->name('category-management.view');

		//Greeting management
		Route::GET('/greeting-management/index','GreetingManagementController@index')->name('greeting-management.index');
		Route::GET('/greeting-management/data/{filter_data?}','GreetingManagementController@data')->name('greeting-management.data');
		Route::GET('/greeting-management/edit/{id}','GreetingManagementController@edit')->name('greeting-management.edit');
		Route::PATCH('/greeting-management/update/{id}','GreetingManagementController@update')->name('greeting-management.update');
		Route::GET('/greeting-management/status/{id}','GreetingManagementController@status')->name('greeting-management.status');
		Route::GET('/greeting-management/delete/{id}','GreetingManagementController@destroy')->name('greeting-management.delete');
		Route::GET('/greeting-management/view/{id}','GreetingManagementController@view')->name('greeting-management.view');

		//sub-category management
		Route::GET('/sub-category-management/index','SubCategoryManagementController@index')->name('sub-category-management.index');
		Route::GET('/sub-category-management/data/{filter_data?}','SubCategoryManagementController@data')->name('sub-category-management.data');
		Route::GET('/sub-category-management/create','SubCategoryManagementController@create')->name('sub-category-management.create');
		Route::POST('/sub-category-management/store','SubCategoryManagementController@store')->name('sub-category-management.store');
		Route::GET('/sub-category-management/edit/{id}','SubCategoryManagementController@edit')->name('sub-category-management.edit');
		Route::PATCH('/sub-category-management/update/{id}','SubCategoryManagementController@update')->name('sub-category-management.update');
		Route::GET('/sub-category-management/status/{id}','SubCategoryManagementController@status')->name('sub-category-management.status');
		Route::GET('/sub-category-management/delete/{id}','SubCategoryManagementController@destroy')->name('sub-category-management.delete');
		Route::GET('/sub-category-management/view/{id}','SubCategoryManagementController@view')->name('sub-category-management.view');

		//site configuration
		Route::GET('/site-configuration/index','SiteConfigurationController@index')->name('site-configuration.index');
		Route::GET('/site-configuration/data/{filter_data?}','SiteConfigurationController@data')->name('site-configuration.data');
		Route::GET('/site-configuration/create','SiteConfigurationController@create')->name('site-configuration.create');
		Route::POST('/site-configuration/store','SiteConfigurationController@store')->name('site-configuration.store');
		Route::GET('/site-configuration/edit/{id}','SiteConfigurationController@edit')->name('site-configuration.edit');
		Route::PATCH('/site-configuration/update/{id}','SiteConfigurationController@update')->name('site-configuration.update');
		Route::GET('/site-configuration/status/{id}','SiteConfigurationController@status')->name('site-configuration.status');
		Route::GET('/site-configuration/delete/{id}','SiteConfigurationController@destroy')->name('site-configuration.delete');
		Route::GET('/site-configuration/view/{id}','SiteConfigurationController@view')->name('site-configuration.view');



		//User Action
		Route::GET('/user/index','UserController@index')->name('user.index');
		Route::GET('/user/data/{filter_data?}','UserController@data')->name('user.data');
		Route::GET('/user/data?filter_role','UserController@data')->name('user.data');
		Route::GET('/user/create','UserController@create')->name('user.create');
		Route::POST('/user/store','UserController@store')->name('user.store');
		Route::GET('/user/edit/{id}','UserController@edit')->name('user.edit');
		Route::GET('/user/show/{id}','UserController@show')->name('user.show');
		Route::GET('/user/status/{id}','UserController@status')->name('user.status');
		Route::PATCH('/user/update/{id}','UserController@update')->name('user.update');
		Route::GET('/user/delete/{id}','UserController@destroy')->name('user.delete');
		Route::GET('/user/approved/{id}','UserController@approved')->name('user.approved');

		//feedback management
		Route::GET('/feedback-management/index','FeedbackManagementController@index')->name('feedback-management.index');
		Route::GET('/feedback-management/data/{filter_data?}','FeedbackManagementController@data')->name('feedback-management.data');
		Route::GET('/feedback-management/create','FeedbackManagementController@create')->name('feedback-management.create');
		Route::POST('/feedback-management/store','FeedbackManagementController@store')->name('feedback-management.store');
		Route::GET('/feedback-management/edit/{id}','FeedbackManagementController@edit')->name('feedback-management.edit');
		Route::GET('/feedback-management/show/{id}','FeedbackManagementController@show')->name('feedback-management.show');
		Route::GET('/feedback-management/status/{id}','FeedbackManagementController@status')->name('feedback-management.status');
		Route::PATCH('/feedback-management/update/{id}','FeedbackManagementController@update')->name('feedback-management.update');
		Route::GET('/feedback-management/delete/{id}','FeedbackManagementController@destroy')->name('feedback-management.delete');
		Route::GET('/feedback-management/approved/{id}','FeedbackManagementController@approved')->name('feedback-management.approved');

		//feedback management
		Route::GET('/review-ratting/index','ReviewRattingController@index')->name('review-ratting.index');
		Route::GET('/review-ratting/data/{filter_data?}','ReviewRattingController@data')->name('review-ratting.data');
		Route::GET('/review-ratting/create','ReviewRattingController@create')->name('review-ratting.create');
		Route::POST('/review-ratting/store','ReviewRattingController@store')->name('review-ratting.store');
		Route::GET('/review-ratting/edit/{id}','ReviewRattingController@edit')->name('review-ratting.edit');
		Route::GET('/review-ratting/show/{id}','ReviewRattingController@show')->name('review-ratting.show');
		Route::GET('/review-ratting/status/{id}','ReviewRattingController@status')->name('review-ratting.status');
		Route::PATCH('/review-ratting/update/{id}','ReviewRattingController@update')->name('review-ratting.update');
		Route::GET('/review-ratting/delete/{id}','ReviewRattingController@destroy')->name('review-ratting.delete');


		//Order Management Route
		Route::GET('/order-management/index','OrderManagementController@index')->name('order-management.index');
		Route::GET('/order-management/data/{filter_data?}','OrderManagementController@data')->name('order-management.data');

		//Category Master Route
		Route::GET('/category-master/index','CategoryMasterController@index')->name('category-master.index');
		Route::GET('/category-master/data/{filter_data?}','CategoryMasterController@data')->name('category-master.data');

		//User Favrouite Route
		Route::GET('/user-favourite/index','UserFavouriteController@index')->name('user-favourite.index');
		Route::GET('/user-favourite/data/{filter_data?}','UserFavouriteController@data')->name('user-favourite.data');

		//My Cart Route
		Route::GET('/my-cart/index','MyCartController@index')->name('my-cart.index');
		Route::GET('/my-cart/data/{filter_data?}','MyCartController@data')->name('my-cart.data');

		/*State Route*/
		Route::GET('/state/index','StateController@index')->name('state.index');
		Route::GET('/state/create','StateController@create')->name('state.create');
		Route::POST('/state/store','StateController@store')->name('state.store');
		Route::GET('/state/edit/{id}','StateController@edit')->name('state.edit');	
		Route::PATCH('/state/update/{id}','StateController@update')->name('state.update');
		Route::GET('/state/delete/{id}','StateController@destroy')->name('state.delete');
		Route::GET('/state/data','StateController@data')->name('state/data');    
		Route::GET('/state/status/{id}','StateController@status')->name('state.status');	

		/* Country Route */
		Route::GET('/country/index', 'CountryController@index')->name('country.index');
		Route::GET('/country/create', 'CountryController@create')->name('country.create');
		Route::POST('/country/store', 'CountryController@store')->name('country.store');
		Route::GET('/country/edit/{id}', 'CountryController@edit')->name('country.edit');	
		Route::PATCH('/country/update/{id}', 'CountryController@update')->name('country.update');
		Route::GET('/country/delete/{id}', 'CountryController@destroy')->name('country.delete');
		Route::GET('/country/data', 'CountryController@data')->name('country/data');   
		Route::GET('/country/status/{id}','CountryController@status')->name('country.status');

		/*City Route*/
		Route::GET('/city/index','CityController@index')->name('city.index');
		Route::GET('/city/create','CityController@create')->name('city.create');
		Route::POST('/city/store','CityController@store')->name('city.store');
		Route::GET('/city/edit/{id}','CityController@edit')->name('city.edit');	
		Route::GET('/city/status/{id}','CityController@status')->name('city.status');		
		Route::PATCH('/city/update/{id}','CityController@update')->name('city.update');
		Route::GET('/city/delete/{id}','CityController@destroy')->name('city.delete');
		Route::GET('/city/data','CityController@data')->name('city/data');    
		Route::GET('/city/getstate/{id}','CityController@getState')->name('city/getstate');   
		Route::GET('/city/getcity/{id}','CityController@getCity')->name('city/getcoty');   


				//Frame Action
		Route::GET('/frame-management/index','FrameManagementController@index')->name('frame-management.index');
		Route::GET('/frame-management/data/{filter_data?}','FrameManagementController@data')->name('frame-management.data');
		Route::GET('/frame-management/create','FrameManagementController@create')->name('frame-management.create');
		Route::POST('/frame-management/store','FrameManagementController@store')->name('frame-management.store');
		Route::GET('/frame-management/edit/{id}','FrameManagementController@edit')->name('frame-management.edit');
		Route::PATCH('/frame-management/update/{id}','FrameManagementController@update')->name('frame-management.update');
		Route::GET('/frame-management/status/{id}','FrameManagementController@status')->name('frame-management.status');
		Route::GET('/frame-management/delete/{id}','FrameManagementController@destroy')->name('frame-management.delete');
		Route::GET('/frame-management/view/{id}','FrameManagementController@view')->name('frame-management.view');


		//Coupon Action
		Route::GET('/coupon-management/index','CouponManagementController@index')->name('coupon-management.index');
		Route::GET('/coupon-management/data/{filter_data?}','CouponManagementController@data')->name('coupon-management.data');
		Route::GET('/coupon-management/create','CouponManagementController@create')->name('coupon-management.create');
		Route::POST('/coupon-management/store','CouponManagementController@store')->name('coupon-management.store');
		Route::GET('/coupon-management/edit/{id}','CouponManagementController@edit')->name('coupon-management.edit');
		Route::PATCH('/coupon-management/update/{id}','CouponManagementController@update')->name('coupon-management.update');
		Route::GET('/coupon-management/status/{id}','CouponManagementController@status')->name('coupon-management.status');
		Route::GET('/coupon-management/delete/{id}','CouponManagementController@destroy')->name('coupon-management.delete');
		Route::GET('/coupon-management/view/{id}','CouponManagementController@view')->name('coupon-management.view');

		//Report Management
		Route::GET('/report-management/index','ReportManagementController@index')->name('report-management.index');
		Route::GET('/report-management/data/{filter_data?}','ReportManagementController@data')->name('report-management.data');
		Route::GET('/report-management/edit/{id}','ReportManagementController@edit')->name('report-management.edit');
		Route::GET('/report-management/order','ReportManagementController@order_details')->name('report-management_order');
		Route::GET('/report-management/orderDate','ReportManagementController@orderDate');
		Route::GET('/report-management/csv_import','ReportManagementController@csv_export')->name('export');
		Route::GET('/report-management/order_import','ReportManagementController@order_export')->name('order_export');
		Route::get('report-management/order-details/{order_id?}','ReportManagementController@order_details_list')->name('order_details');


		Route::fallback(function(){
		});
	});
	/* END Admin Routes */ 

/*End*/
});
Route::fallback(function(){
	return redirect('/login');
});