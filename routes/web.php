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


use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB
use Carbon\Carbon; //laravel date time

Route::get('/timezone', function(){

	return [ 'laravel'=> Carbon::now(), 'mysql'=> DB::SELECT("SELECT NOW()")  ];

});

Route::get('/query', function(){
	// return \App\ProductsDtlView::all();
});


// Route::get('/db', function(){
// 	config(['database.connections.mysql.options' => [PDO::ATTR_EMULATE_PREPARES => false]]);
// 	return config('database.connections.mysql.options');
// });


Route::get('/artisan-clear', function(){

	Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'config,cache,view and route all cleared';

});


Route::get('/apichecksession', function(){

	if( !Auth::check() ){
		return response()->json('expired', 401);
	}
	return response()->json('active', 200);

});

Route::get('/test', function(){
	return view('index');
});

//default
Route::get('/', function () {

	//if user already login redirect to homepage
	if( Auth::check() ){
		return redirect('/home');
	}

    return view('login');
});


//sessions
Route::get('/login', function(){
	return view('login');
})->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');


//warning page
Route::get('/403', function(){
	session()->flash('active_parent', '');
	return view('403');
})->middleware(['auth']);



Route::get('/404', function(){
	return view('404');
})->name('404');

//home
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/store/{id}', 'HomeController@selectStore');


Route::get('/profile', 'UsersController@showProfile');
Route::post('/profile', 'UsersController@updateProfile');


//pos
Route::get('/pos', 'POSController@index')->middleware(['checkmodule:1200']);
Route::get('/pos/show/{id}', 'POSController@show')->middleware(['checkmodule:1200']);

Route::post('/pos/create', 'POSController@store')->middleware(['checkmodule:1200']);

Route::post('/pos/update/{id}', 'POSController@update')->middleware(['checkmodule:1200']);

Route::post('/pos/additems/{id}', 'POSController@additems')->middleware(['checkmodule:1200']);

Route::post('/pos/payments/{id}', 'POSController@addpayments')->middleware(['checkmodule:1200']);

Route::put('/pos/removeitems/{id}', 'POSController@removeitems')->middleware(['checkmodule:1200']);

Route::get('/pos/searchitems', 'POSController@searchitems')->middleware(['checkmodule:1200']);

//the same as delete sales
Route::put('/pos/delete/{id}', 'POSController@destroy')->middleware(['checkmodule:1305']);


//sales
Route::get('/sales', 'SalesController@index')->middleware(['checkmodule:1301']);

//function already define @POSController@show
Route::get('/sales/show/{id}', 'POSController@show')->middleware(['checkmodule:1303']);

Route::post('/sales/update/{id}', 'SalesController@update')->middleware(['checkmodule:1304']);

//function already define @POSController@destroy
Route::put('/sales/delete/{id}', 'POSController@destroy')->middleware(['checkmodule:1305']);

Route::get('/sales/showpayments/{id}', 'SalesController@showpayments')->middleware(['checkmodule:1306']);

//function already define @POSController@addpayments
Route::post('/sales/payments/{id}', 'POSController@addpayments')->middleware(['checkmodule:1308']);

Route::put('/sales/deletepayments/{id}', 'SalesController@deletepayments')->middleware(['checkmodule:1307']);




//expense
Route::get('/expense', 'ExpenseController@index' )->middleware(['checkmodule:1310']);

Route::get('/expense/create', 'ExpenseController@create')->middleware(['checkmodule:1311']);
Route::post('/expense/create', 'ExpenseController@store')->middleware(['checkmodule:1311']);

Route::get('/expense/show/{id}', 'ExpenseController@show')->middleware(['checkmodule:1312']);

Route::get('/expense/edit/{id}', 'ExpenseController@edit')->middleware(['checkmodule:1313']);
Route::post('/expense/edit/{id}', 'ExpenseController@update')->middleware(['checkmodule:1313']);

Route::put('/expense/delete/{id}', 'ExpenseController@destroy')->middleware(['checkmodule:1314']);





//products
Route::get('/products', 'ProductsController@index' )->middleware(['checkmodule:1401']);

Route::get('/products/searchproductsperstore', 'ProductsController@searchproductsperstore' );

Route::get('/products/create', 'ProductsController@create')->middleware(['checkmodule:1402']);
Route::post('/products/create', 'ProductsController@store')->middleware(['checkmodule:1402']);

Route::get('/products/show/{id}', 'ProductsController@show')->middleware(['checkmodule:1403']);

Route::get('/products/edit/{id}', 'ProductsController@edit')->middleware(['checkmodule:1404']);
Route::post('/products/edit/{id}', 'ProductsController@update')->middleware(['checkmodule:1404']);

Route::put('/products/delete/{id}', 'ProductsController@destroy')->middleware(['checkmodule:1405']);

Route::get('/products/pricelist/{id}', 'ProductsController@showPriceList')->middleware(['checkmodule:1406']);
Route::post('/products/pricelist/{id}', 'ProductsController@updatePriceList')->middleware(['checkmodule:1406']);

Route::get('/products/qtylist/{id}', 'ProductsController@showQtyList')->middleware(['checkmodule:1407']);
Route::post('/products/qtylist/{id}', 'ProductsController@updateQtyList')->middleware(['checkmodule:1407']);

Route::get('/products/visibility/{id}', 'ProductsController@showVisibility')->middleware(['checkmodule:1408']);
Route::post('/products/visibility/{id}', 'ProductsController@updateVisibility')->middleware(['checkmodule:1408']);

Route::get('/products/barcode/{id}', 'ProductsController@printBarcode')->middleware(['checkmodule:1409']);

Route::get('/products/compositions/{id}', 'ProductsCompositionsController@create')->middleware(['checkmodule:1420']);
Route::post('/products/compositions/{id}', 'ProductsCompositionsController@update')->middleware(['checkmodule:1420']);
Route::get('/products/compositions-search/{id}', 'ProductsCompositionsController@search')->middleware(['checkmodule:1420']);


//customers.suppliers
Route::get('/persons', 'PersonsController@index' )->middleware(['checkmodule:1410']);

//module required. for ajax request search
Route::get('/persons/search', 'PersonsController@index' );

Route::get('/persons/create', 'PersonsController@create')->middleware(['checkmodule:1411']);
Route::post('/persons/create', 'PersonsController@store')->middleware(['checkmodule:1411']);

Route::get('/persons/show/{id}', 'PersonsController@show')->middleware(['checkmodule:1412']);

Route::get('/persons/edit/{id}', 'PersonsController@edit')->middleware(['checkmodule:1413']);
Route::post('/persons/edit/{id}', 'PersonsController@update')->middleware(['checkmodule:1413']);

Route::put('/persons/delete/{id}', 'PersonsController@destroy')->middleware(['checkmodule:1414']);



//reports
Route::get('/reports', 'ReportsController@index')->middleware(['checkmodule:1700']);

Route::get('/reports/show/{id}', 'ReportsController@show')->middleware(['checkmodule:1700']);


Route::get('/rename-reports', 'ReportsController@create')->middleware(['checkmodule:1555']);
Route::post('/rename-reports', 'ReportsController@store')->middleware(['checkmodule:1555']);



//discounts
Route::get('/discounts', 'DiscountsController@index' )->middleware(['checkmodule:1510']);


//module required. for ajax request search
Route::get('/discounts/search', 'DiscountsController@index' );


Route::get('/discounts/create', 'DiscountsController@create')->middleware(['checkmodule:1511']);
Route::post('/discounts/create', 'DiscountsController@store')->middleware(['checkmodule:1511']);

Route::get('/discounts/show/{id}', 'DiscountsController@show')->middleware(['checkmodule:1512']);

Route::get('/discounts/edit/{id}', 'DiscountsController@edit')->middleware(['checkmodule:1513']);
Route::post('/discounts/edit/{id}', 'DiscountsController@update')->middleware(['checkmodule:1513']);

Route::put('/discounts/delete/{id}', 'DiscountsController@destroy')->middleware(['checkmodule:1514']);


//categories
Route::get('/categories', 'CategoriesController@index' )->middleware(['checkmodule:1520']);

Route::get('/categories/create', 'CategoriesController@create')->middleware(['checkmodule:1521']);
Route::post('/categories/create', 'CategoriesController@store')->middleware(['checkmodule:1521']);

Route::get('/categories/show/{id}', 'CategoriesController@show')->middleware(['checkmodule:1522']);

Route::get('/categories/edit/{id}', 'CategoriesController@edit')->middleware(['checkmodule:1523']);
Route::post('/categories/edit/{id}', 'CategoriesController@update')->middleware(['checkmodule:1523']);

Route::put('/categories/delete/{id}', 'CategoriesController@destroy')->middleware(['checkmodule:1524']);


//stores
Route::get('/stores', 'StoresController@index' )->middleware(['checkmodule:1530']);

Route::get('/stores/create', 'StoresController@create')->middleware(['checkmodule:1531']);
Route::post('/stores/create', 'StoresController@store')->middleware(['checkmodule:1531']);

Route::get('/stores/show/{id}', 'StoresController@show')->middleware(['checkmodule:1532']);

Route::get('/stores/edit/{id}', 'StoresController@edit')->middleware(['checkmodule:1533']);
Route::post('/stores/edit/{id}', 'StoresController@update')->middleware(['checkmodule:1533']);

Route::put('/stores/delete/{id}', 'StoresController@destroy')->middleware(['checkmodule:1534']);


//users
Route::get('/users', 'UsersController@index' )->middleware(['checkmodule:1540']);


//module required. for ajax request search
Route::get('/users/search', 'UsersController@index' );


Route::get('/users/create', 'UsersController@create')->middleware(['checkmodule:1541']);
Route::post('/users/create', 'UsersController@store')->middleware(['checkmodule:1541']);

Route::get('/users/show/{id}', 'UsersController@show')->middleware(['checkmodule:1542']);

Route::get('/users/edit/{id}', 'UsersController@edit')->middleware(['checkmodule:1543']);
Route::post('/users/edit/{id}', 'UsersController@update')->middleware(['checkmodule:1543']);

Route::put('/users/delete/{id}', 'UsersController@destroy')->middleware(['checkmodule:1544']);

Route::get('/users/accessibility/{id}', 'UsersController@showAccessibility')->middleware(['checkmodule:1545']);
Route::post('/users/accessibility/{id}', 'UsersController@updateAccessibility')->middleware(['checkmodule:1545']);

//company
Route::get('/company', 'CompanyController@index')->middleware(['checkmodule:1550']);
Route::get('/company/{id}', 'CompanyController@index')->middleware(['checkmodule:1550']);
Route::post('/company/{id}', 'CompanyController@update')->middleware(['checkmodule:1550']);