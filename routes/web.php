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
    return view('welcome');
});

Auth::routes();

// ---------------- Локализация ----------------------
Route::get('/setlocale/{locale}', function($locale){
    if(in_array($locale, \Config::get('app.locales'))){
        Session::put('locale', $locale);
    }
    return redirect()->back();
});

// ---------------- Главная ----------------------
Route::get('/home', 'HomeController@index')->name('home');

// ---------------- Товары ----------------------
Route::group(['prefix' => '/products'], function () {
    Route::get('/', 'ProductController@index')->name('products');
    Route::post('/set-product', 'ProductController@setProduct')->name('set-product');
    Route::post('/del-product', 'ProductController@delProduct')->name('del-product');
    Route::post('/edit-product', 'ProductController@getProduct')->name('edit-product');
    Route::post('/get-all-products', 'ProductController@getAllProducts')->name('get-all-products');
    Route::get('/search', 'ProductController@getSearch');
    Route::post('/search', 'ProductController@search');
    # экспорт в PDF
    Route::get('/products-to-pdf', 'ProductController@getProductsToPdf')->name('products-to-pdf');
    # скачать в PDF
    Route::get('/products-load-pdf', 'ProductController@getProductsToPdfLoad')->name('products-load-pdf');
});

// ---------------- Контрагенты ----------------------
Route::group(['prefix' => '/counterparty'], function () {
    Route::get('/', 'CounterpartyController@index')->name('counterparty');
    Route::post('/set-counterparty', 'CounterpartyController@setCounterparty')->name('set-counterparty');
    Route::post('/del-counterparty', 'CounterpartyController@delCounterparty')->name('del-counterparty');
    Route::post('/edit-counterparty', 'CounterpartyController@getCounterparty')->name('edit-counterparty');
//    Route::get('/search', 'CounterpartyController@getSearch');
    Route::post('/search', 'CounterpartyController@search');
});

// ---------------- Приходный ордер ----------------------
Route::group(['prefix' => '/incoming-payment-order'], function () {
    Route::get('/', 'IncomingPaymentOrderController@index')->name('incoming-payment-order');
    Route::post('/set-incoming-payment-order', 'IncomingPaymentOrderController@setIncomingPaymentOrder')->name('set-incoming-payment-order');
    Route::post('/del-incoming-payment-order', 'IncomingPaymentOrderController@delIncomingPaymentOrder')->name('del-incoming-payment-order');
    Route::post('/edit-incoming-payment-order', 'IncomingPaymentOrderController@getIncomingPaymentOrder')->name('edit-incoming-payment-order');
    Route::post('/add-product-incoming', 'IncomingPaymentOrderController@addProductIncoming')->name('add-product-incoming');
    Route::post('/get-incoming-order', 'IncomingPaymentOrderController@getOrderById')->name('/get-incoming-order');
    Route::post('/del-product-incoming', 'IncomingPaymentOrderController@delProductIncoming')->name('/del-product-incoming');
    Route::post('/get-all-incoming-orders', 'IncomingPaymentOrderController@getAllIncomingPaymentOrder')->name('/get-all-incoming-orders');
    Route::get('/search', 'IncomingPaymentOrderController@getSearch');
    Route::post('/search', 'IncomingPaymentOrderController@search');
    # экспорт в PDF
    Route::get('/incoming-to-pdf/{id}', 'IncomingPaymentOrderController@getToPdf')->name('incoming-to-pdf');
    # скачать в PDF
    Route::get('/incoming-load-pdf/{id}', 'IncomingPaymentOrderController@getToPdfLoad')->name('incoming-load-pdf');
});

// ---------------- Расходный ордер ----------------------
Route::group(['prefix' => '/outgoing-payment-order'], function () {
    Route::get('/', 'OutgoingPaymentOrderController@index')->name('outgoing-payment-order');
    Route::post('/set-outgoing-payment-order', 'OutgoingPaymentOrderController@setOutgoingPaymentOrder')->name('set-outgoing-payment-order');
    Route::post('/del-outgoing-payment-order', 'OutgoingPaymentOrderController@delOutgoingPaymentOrder')->name('del-outgoing-payment-order');
    Route::post('/add-product-outgoing', 'OutgoingPaymentOrderController@addProductOutgoing')->name('add-product-outgoing');
    Route::post('/get-outgoing-order', 'OutgoingPaymentOrderController@getOrderById')->name('/get-outgoing-order');
    Route::post('/del-product-outgoing', 'OutgoingPaymentOrderController@delProductOutgoing')->name('/del-product-outgoing');
    Route::post('/get-all-outgoing-orders', 'OutgoingPaymentOrderController@getAllOutgoingPaymentOrder')->name('/get-all-outgoing-orders');
    Route::get('/search', 'OutgoingPaymentOrderController@getSearch');
    Route::post('/search', 'OutgoingPaymentOrderController@search');
    # экспорт в PDF
    Route::get('/outgoing-to-pdf/{id}', 'OutgoingPaymentOrderController@getToPdf')->name('outgoing-to-pdf');
    # скачать в PDF
    Route::get('/outgoing-load-pdf/{id}', 'OutgoingPaymentOrderController@getToPdfLoad')->name('outgoing-load-pdf');
});

// ---------------- Отчеты ----------------------
Route::group(['prefix' => '/reports'], function (){
    Route::get('/', 'ReportController@index')->name('reports');
    Route::post('/get-report', 'ReportController@getReport')->name('get-report');
});

// ---------------- Склад ----------------------
Route::group(['prefix' => '/storage'], function (){
    Route::get('/', 'StorageController@index')->name('storage');
    Route::get('/search', 'StorageController@getSearch')->name('search');
    Route::post('/search', 'StorageController@search');
});

// ---------------- Настройки ----------------------
Route::group(['prefix' => '/setting'],function (){
    Route::get('/','Settings\SettingsController@index')->name('settings');

    // ---------------- Компании ----------------------
    Route::group(['prefix' => '/company'],function () {
        // ----------- Выбор компании (ajax) -------------
        Route::post('/set/', 'Settings\CompanyController@setCompanyId');
        // -------------- Сохранение компании (ajax) ------------
        Route::post('/save/', 'Settings\CompanyController@saveCompany');
    });
});

// ---------------- Пользователя ----------------------
Route::group(['prefix' => '/users'],function (){
    Route::get('/', 'UserController@index')->name('users');
    Route::post('/del-relation-company', 'UserController@delCompanyRelation');
});


// ---------------- Журнал ----------------------
Route::get('/log', 'HomeController@index')->name('log');

// ---------------- GAME -------------------------
Route::get('/game', 'Game\GameController@index')->name('game');