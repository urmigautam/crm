<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/contries',[App\Http\Controllers\UserController::class,'contries']);
Route::get('/states',[App\Http\Controllers\UserController::class,'states']);
Route::get('/cities',[App\Http\Controllers\UserController::class,'cities']);
Route::get('/push-to-tally', [App\Http\Controllers\OrdersController::class,'pushToTally']);
Route::get('/get-from-tally', [App\Http\Controllers\OrdersController::class,'getfromTally']);

Route::get('/get-tally-ledgers', [App\Http\Controllers\OrdersController::class,'getTallyledgers']);
Route::get('/get-tally-items', [App\Http\Controllers\OrdersController::class,'getTallyitems']);
Route::get('/get-tally-vouchers', [App\Http\Controllers\OrdersController::class,'getTallyVouchers']);
Route::get('/add-tally-item', [App\Http\Controllers\OrdersController::class,'addItem']);

//ledgers operations
Route::get('/add-leadger', [App\Http\Controllers\OrdersController::class,'addledgers']);
Route::post('/add-new-leadger', [App\Http\Controllers\OrdersController::class,'addNewledgers']);
Route::get('/edit-ledger/{ledger}', [App\Http\Controllers\OrdersController::class,'editNewledgers'])->name('edit-ledger');
Route::get('/delete-ledger/{ledger}', [App\Http\Controllers\OrdersController::class,'deleteledgers'])->name('delete-ledger');
Route::post('/update-leadger', [App\Http\Controllers\OrdersController::class,'updateledgers']);

//Tally items
Route::get('/add-item', [App\Http\Controllers\OrdersController::class,'addItem']);
Route::get('/edit-item', [App\Http\Controllers\OrdersController::class,'addItem']);
Route::get('/delete-item', [App\Http\Controllers\OrdersController::class,'addItem']);



Route::get('/template',[App\Http\Controllers\UserController::class,'template']);
Route::get('/',[App\Http\Controllers\UserController::class,'login']);
Route::post('/login-user',[App\Http\Controllers\UserController::class,'loginUser']);
Route::get('/register',[App\Http\Controllers\UserController::class,'register']);
Route::post('/register-user',[App\Http\Controllers\UserController::class,'registerUser']);

// Route::get('/sendpurposal',[App\Http\Controllers\FollowUpController::class,'sendpurposal']);
Route::get('/order/{id}',[App\Http\Controllers\FollowUpController::class,'placeorder']);
Route::get('/placeOrder',[App\Http\Controllers\OrdersController::class,'submitOrder'])->name('placeOrder');
Route::get('/thankyou',[App\Http\Controllers\OrdersController::class,'thankyou'])->name('thankyou');

Route::group(['middleware' => 'admin'], function () {
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
Route::get('/logout',[App\Http\Controllers\UserController::class,'logout']);


Route::group(['middleware' => 'permissions'], function () {

Route::post('/add-company', [App\Http\Controllers\CompanyController::class, 'create']);
Route::get('/company', [App\Http\Controllers\CompanyController::class, 'companylist']);
Route::get('/add-company', [App\Http\Controllers\CompanyController::class, 'index']);
Route::get('/company-list', [App\Http\Controllers\CompanyController::class, 'companylist']);
Route::get('/company-edit/{id}', [App\Http\Controllers\CompanyController::class, 'companyedit']);
Route::get('/company-block/{id}', [App\Http\Controllers\CompanyController::class, 'blockcompany']);
Route::put('update-company/{id}',[App\Http\Controllers\CompanyController::class,'updatecompany']);

Route::get('/mail-setting',[App\Http\Controllers\MailController::class,'maillist']);
Route::get('/mail-list',[App\Http\Controllers\MailController::class,'maillist']);
Route::get('/server-edit/{id}',[App\Http\Controllers\MailController::class,'serveredit']);
Route::put('/server-update/{id}',[App\Http\Controllers\MailController::class,'serverupdate']);

// users

Route::get('/users',[App\Http\Controllers\UserController::class,'userlist']);
Route::get('/add-new-user',[App\Http\Controllers\UserController::class,'index']);
Route::post('/add-user',[App\Http\Controllers\UserController::class,'create']);
Route::get('/user-block/{id}',[App\Http\Controllers\UserController::class,'userblock']);
Route::get('/user-edit/{id}',[App\Http\Controllers\UserController::class,'useredit']);
Route::put('/update-user/{id}',[App\Http\Controllers\UserController::class,'userupdate']);
 

// refrences

Route::get('/refrences',[App\Http\Controllers\RefrenceController::class,'index']);
Route::get('/add-new-refrence',[App\Http\Controllers\RefrenceController::class,'addRefrence']);
Route::post('/add-refrence',[App\Http\Controllers\RefrenceController::class,'createRefence']);
Route::get('/refrence-edit/{id}',[App\Http\Controllers\RefrenceController::class,'refrenceEdit']);
Route::put('/update-refrence/{id}',[App\Http\Controllers\RefrenceController::class,'refrenceUpdate']);
Route::get('/refrence-delete/{id}',[App\Http\Controllers\RefrenceController::class,'delete']);



// category

Route::get('/category-list',[App\Http\Controllers\CategoryController::class,'index']);
Route::get('/category-add',[App\Http\Controllers\CategoryController::class,'addcategory']);
Route::post('/category-create',[App\Http\Controllers\CategoryController::class,'create']);
Route::get('/category-edit/{id}',[App\Http\Controllers\CategoryController::class,'editcategory']);
Route::put('/category-update/{id}',[App\Http\Controllers\CategoryController::class,'updatecategory']);
Route::get('/category-delete/{id}',[App\Http\Controllers\CategoryController::class,'categorydelete']);


//place of business

Route::get('/place-of-bussiness',[App\Http\Controllers\PlaceOfBusinessController::class,'index']);
Route::get('/business-place-add',[App\Http\Controllers\PlaceOfBusinessController::class,'addnew']);
Route::post('/business-place-create',[App\Http\Controllers\PlaceOfBusinessController::class,'create']);
Route::get('/edit-place-of-business/{id}',[App\Http\Controllers\PlaceOfBusinessController::class,'edit']);
Route::get('/delete-place-of-business/{id}',[App\Http\Controllers\PlaceOfBusinessController::class,'deleteedit']);
Route::put('/business-place-update/{id}',[App\Http\Controllers\PlaceOfBusinessController::class,'update']);


//currency
Route::get('/currency-list',[App\Http\Controllers\CurrencyController::class,'index']);
Route::get('/add-currency',[App\Http\Controllers\CurrencyController::class,'addcurrency']);
Route::post('/create-currency',[App\Http\Controllers\CurrencyController::class,'createCurrency']);
Route::get('/edit-currency/{id}',[App\Http\Controllers\CurrencyController::class,'editCurrency']);
Route::put('/update-currency/{id}',[App\Http\Controllers\CurrencyController::class,'updateCurrency']);


//items
Route::get('/items-list',[App\Http\Controllers\ItemsController::class,'index']);
Route::get('/add-item',[App\Http\Controllers\ItemsController::class,'additem']);
Route::post('/additem',[App\Http\Controllers\ItemsController::class,'createitem']);
Route::get('/item-edit/{id}',[App\Http\Controllers\ItemsController::class,'edititem']);
Route::put('/update-item/{id}',[App\Http\Controllers\ItemsController::class,'updateitem']);
Route::get('/item-delete/{id}',[App\Http\Controllers\ItemsController::class,'deleteitem']);


// Lead

Route::get('/leads',[App\Http\Controllers\LeadController::class,'index']);
Route::get('/add-lead',[App\Http\Controllers\LeadController::class,'createLead']);
Route::post('/add-new-lead',[App\Http\Controllers\LeadController::class,'addnewlead']);
Route::get('/lead-edit/{id}',[App\Http\Controllers\LeadController::class,'editlead']);
Route::put('/update-lead/{id}',[App\Http\Controllers\LeadController::class,'updatelead']);


Route::get('/lead-qualified',[App\Http\Controllers\LeadController::class,'qualifiedleads']);
Route::get('/lead-qualified-edit/{id}',[App\Http\Controllers\LeadController::class,'editqualifiedleads']);
Route::put('/update-qualified-lead/{id}',[App\Http\Controllers\LeadController::class,'updatequalifiedlead']);

//onboarding

Route::get('/on-boarding',[App\Http\Controllers\OnboardingController::class,'index']);
Route::get('/edit-onboarding/{id}',[App\Http\Controllers\OnboardingController::class,'editOnboarding']);
Route::put('/update-qualified-lead-onboarding/{id}',[App\Http\Controllers\OnboardingController::class,'updateOnboarding']);


//sales

Route::get('/sales',[App\Http\Controllers\SalesController::class,'index']);
Route::get('/customer-edit/{id}',[App\Http\Controllers\SalesController::class,'edit']);

//follow up


Route::get('/add-follow-up/{id}',[App\Http\Controllers\FollowUpController::class,'index']);
Route::post('/create-folow-up/{id}',[App\Http\Controllers\FollowUpController::class,'create']);
Route::get('/edit-follow-up/{id}',[App\Http\Controllers\FollowUpController::class,'edit']);
Route::put('/update-follow-up/{id}',[App\Http\Controllers\FollowUpController::class,'update']);


Route::get('/add-new-proposal/{id}',[App\Http\Controllers\FollowUpController::class,'createproposal']);
Route::post('/create-purposal',[App\Http\Controllers\FollowUpController::class,'createPurposal']);

Route::get('/search',[App\Http\Controllers\FollowUpController::class,'searchItem'])->name('search');
Route::get('/itemDetail',[App\Http\Controllers\FollowUpController::class,'itemDetail'])->name('itemDetail');

Route::get('/createpurposal',[App\Http\Controllers\FollowUpController::class,'createpurposal'])->name('createpurposal');
Route::get('/purposals',[App\Http\Controllers\FollowUpController::class,'purposals']);

Route::get('/orders-data',[App\Http\Controllers\OrdersController::class,'allOrders']);
Route::get('/order-detail/{id}',[App\Http\Controllers\OrdersController::class,'orderDetail']);

Route::get('/update-status',[App\Http\Controllers\OrdersController::class,'updateorder']);


//supportF
Route::get('/complaints/create',[App\Http\Controllers\ComplaintsController::class,'create']);
Route::get('/complaints/dash', [App\Http\Controllers\ComplaintsController::class,'index']);
Route::post('/complaints', [App\Http\Controllers\ComplaintsController::class,'store']);

Route::get('/complaints-edit/{id}', [App\Http\Controllers\ComplaintsController::class,'edit']);
Route::put('/update-complaint/{id}', [App\Http\Controllers\ComplaintsController::class,'updateComp']);

//roles management
Route::get('/roles-management-system', [App\Http\Controllers\RoleController::class,'roleindex']);
Route::get('/add-new-role', [App\Http\Controllers\RoleController::class,'addRole']);
Route::post('/add-role', [App\Http\Controllers\RoleController::class,'addNewRole']);
Route::get('/edit-role/{id}', [App\Http\Controllers\RoleController::class,'editRole']);
Route::put('/update-role/{id}', [App\Http\Controllers\RoleController::class,'updateRole']);
Route::get('/delete-role/{id}', [App\Http\Controllers\RoleController::class,'DeleteRole']);

//permissions management

Route::get('/permission', [App\Http\Controllers\PermissionController::class,'index']);
Route::get('/add-permission', [App\Http\Controllers\PermissionController::class,'addPermission']);
Route::post('/store-permission', [App\Http\Controllers\PermissionController::class,'storePermission']);
Route::get('/edit-permission/{id}', [App\Http\Controllers\PermissionController::class,'editPermission']);
Route::put('/update-permission/{id}', [App\Http\Controllers\PermissionController::class,'updatePermission']);
Route::get('/delete-permission/{id}', [App\Http\Controllers\PermissionController::class,'delete']);

});
Route::post('/import-orders', [App\Http\Controllers\OrdersController::class,'importOrders']);
Route::get('/count-purposals', [App\Http\Controllers\OrdersController::class,'proposalsCount']);
Route::get('/get-state', [App\Http\Controllers\OrdersController::class,'getState']);



});
