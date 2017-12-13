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
use App\Subcategory;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/demo', function () {
    return view('Sales.demo');
});

Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'AutoCompleteController@index'));
Route::get('searchajax',array('as'=>'searchajax','uses'=>'AutoCompleteController@autoComplete'));


Route::get('/','PagesController@getHome');
Auth::routes();
Route::get('/changepassword', 'AuthController@changepwd');
Route::get('/register','AuthController@index');
Route::post('/register','AuthController@store');

//stock
Route::get('/add', 'StocksController@add')->name('add');
Route::get('/transfer', 'StocksController@transfer')->name('transfer');
Route::get('/stockview', 'StocksController@stockview');
Route::get('/stockadd', 'StocksController@stockadd1');
Route::get('/demo', 'StocksController@demo');
Route::get('/select_barcode', 'StocksController@select_barcode');
Route::get('/transfer_select_product', 'StocksController@transfer_select_product');
Route::get('/stocklocation', 'StocksController@stocklocation');
Route::get('/select_product_name', 'StocksController@select_product_name');
Route::get('/selecttolocation', 'StocksController@selecttolocation');
Route::get('/stockadd', 'StocksController@stockadd');
Route::get('/stocksel', 'StocksController@stocksel');
Route::get('/stockaddcheck', 'StocksController@stockaddcheck');
Route::get('/add_supplier', 'StocksController@add_supplier');
Route::get('/select_state', 'StocksController@select_state');
Route::get('/select_district', 'StocksController@select_district');
Route::get('/supplier', 'StocksController@supplier')->name('supplier');
Route::get('/stocktransfermodify', 'StocksController@stocktransfermodify');
Route::get('/stockaddmodify', 'StocksController@stockaddmodify');
Route::get('/stocktransferupdate', 'StocksController@stocktransferupdate');
Route::get('/stock_add_update', 'StocksController@stock_add_update');
Route::get('/transfereditlocation', 'StocksController@transfereditlocation');
Route::get('/ajax_check_quantity', 'StocksController@ajax_check_quantity');
Route::get('/ajax_add_edit_quantity', 'StocksController@ajax_add_edit_quantity');
Route::get('/fill_supplier_details', 'StocksController@fill_supplier_details');
Route::get('/modify_supplier', 'StocksController@modify_supplier');
Route::get('/add_country', 'StocksController@add_country');
Route::get('/stocktransfercheck', 'StocksController@stocktransfercheck');
Route::get('/stock', 'StocksController@stock');
Route::get('/prodname','StocksController@prodname');

//Sales
Route::get('/InVoice/{id}', 'SaleController@create_Invoice')->name('Sales');
Route::get('/InVoiceFromHold/{id}', 'SaleController@create_HeldInvoice')->name('Sales');
Route::get('/HeldInVoice', 'SaleController@create_PickHeldInVoice')->name('Sales');
Route::get('/Receipt/{id}', 'SaleController@create_Receipt');
Route::get('/View', 'SaleController@create_View');
Route::resource('sales','SaleController');

Route::get('/home', 'HomeController@index')->name('home');
//==================================== Sales Module Routes ============================================
//==================================== Sales Module Routes ============================================
//============================ SideBar Contents
// Route::get('InVoice/{id}', 'SaleController@create_Invoice')->name('Sales');
// Route::get('/InVoic', function ()
// {
// 	$id = SaleController::InvoiceNumber();
// 	return redirect()->route('multi-providers',compact('zipcode', 'city', 'state', 'provider', 'data'));
// 	return redirect()->route('InVoice', ['id' => $id]);
// });
// Route::get('/InVoice/{id}', 'SaleController@create_Invoice')->name('Sales');
// Route::get('/InVoiceFromHold/{id}', 'SaleController@create_HeldInvoice')->name('Sales');
// Route::get('/HeldInVoice', 'SaleController@create_PickHeldInVoice')->name('Sales');
// Route::get('/Receipt/{id}', 'SaleController@create_Receipt');
// Route::get('/View', 'SaleController@create_View');
// Route::resource('sales','SaleController');
//============================ ajax Functions
Route::get('/ajaxInvoiceNextval', 'SaleController@InvoiceNumber');
Route::get('/ajaxHoldInVoice', 'SaleController@HoldInVoice');
Route::get('/ajaxPickheldSearch', 'SaleController@PickheldSearch');
Route::get('/ajaxViewheldSearch', 'SaleController@ViewheldSearch');
Route::get('/ajaxInvoiceinsert', 'SaleController@InvoiceInsert');
Route::get('/ajaxInvoiceinsertAll', 'SaleController@ReceiptInsert');
Route::get('/ajaxInvoiceupdate', 'SaleController@InvoiceUpdate');
Route::post('/ajaxInvoicedelete', 'SaleController@Invoicedelete');
Route::post('/ajaxInvoicedeleteAll', 'SaleController@Invoicedeleteall');
Route::get('/ajaxDiscount', 'SaleController@InvoiceDiscount');
Route::get('/ajaxGetAddress', 'SaleController@GetAddress');
Route::get('/state', 'SaleController@state')->name('state');
Route::get('/district', 'SaleController@district')->name('district');


//============================ End of Sales Module Routes ============================================
//============================ SideBar Contents
//Route::get('/InVoice', 'SaleController@create_Invoice')->name('Sales');
//Route::get('/HeldInVoice', 'SaleController@create_HeldInVoice')->name('Sales');
//============================
// Route::resource('sales','SaleController');
//============================ ajax Functions
// Route::get('/ajaxInvoiceNextval', 'SaleController@InvoiceNumber');
// Route::get('/ajaxHoldInVoice', 'SaleController@HoldInVoice');
// Route::get('/ajaxPickheldSearch', 'SaleController@PickheldSearch');
// Route::get('/ajaxViewheldSearch', 'SaleController@ViewheldSearch');
// Route::get('/ajaxInvoiceinsert', 'SaleController@InvoiceInsert');
// Route::get('/ajaxInvoiceinsertAll', 'SaleController@ReceiptInsert');
// Route::get('/ajaxInvoiceupdate', 'SaleController@InvoiceUpdate');
// Route::post('/ajaxInvoicedelete', 'SaleController@Invoicedelete');
// Route::post('/ajaxInvoicedeleteAll', 'SaleController@Invoicedeleteall');
// Route::get('/ajaxDiscount', 'SaleController@InvoiceDiscount');
// Route::get('/ajaxGetAddress', 'SaleController@GetAddress');
//============================ End of Sales Module Routes ============================================
Route::get('/insertitem','ItemController@index');
Route::get('/modifyitem','ItemController@index');
Route::post('/insertitem','ItemController@store');
Route::post('/catadd','CategoryController@store');
Route::post('/subcatadd','SubcategoryController@store');
Route::get('/modifyitem','PagesController@getItemlist')->name('modifyitem');
Route::get('/modify', 'ItemController@modify')->name('modify');
Route::get('/get_item_details', 'ItemController@suggestion');
Route::resource('items',"ItemController");

Route::get('api/dropdown', function(){
  $input = Input::get('option');
	$maker = Maker::find($input);
	$models = $maker->models();
	return Response::eloquent($models->get(['id','name']));
});
// Route::get('/Sales', function () {return view('Sales.Sales');});
