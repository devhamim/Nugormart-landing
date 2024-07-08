<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DelevaryChargeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\landingpageController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MarkatingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TermAndConditionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// multipal
Route::post('/multi/view/invoice', [PrintController::class, 'multi_view_invoice'])->name('multi.view.invoice');

Route::post('/multi/order/status', [PrintController::class, 'multi_order_status'])->name('multi.order.status');



Route::get('/', [landingpageController::class, 'landing_page'])->name('landing.page');
Route::post('/landing/order/store', [landingpageController::class, 'landing_order_store'])->name('landing.order.store');

// landing three page
// Route::get('/black/dress', [landingpageController::class, 'black_dress'])->name('black.dress');
// Route::get('/batik/dress', [landingpageController::class, 'batik_dress'])->name('batik.dress');
// Route::get('/putul/dress', [landingpageController::class, 'putul_dress'])->name('putul.dress');
// Route::get('/premium/dress', [landingpageController::class, 'premium_dress'])->name('premium.dress');
// Route::get('/fotula', [landingpageController::class, 'fotula'])->name('fotula');
// Route::get('/premium/tiya', [landingpageController::class, 'premium_tiya'])->name('premium.tiya');
Route::get('/karijma/stone', [landingpageController::class, 'karijma_stone'])->name('karijma.stone');



// login
Route::group(['prefix' => 'admin'], function(){
    // login route
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // logout route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('markatingSetting', MarkatingController::class);
    Route::resource('product', ProductController::class);
    Route::resource('inventory', InventoryController::class);
    Route::resource('categorys', CategoryController::class);
    Route::resource('subcategorys', SubcategoryController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('delevarycharge', DelevaryChargeController::class);
    Route::resource('pos', POSController::class);


    Route::get('landingpage', [HomeController::class, 'landingpage'])->name('landingpage');
    Route::post('/getsubcategory', [ProductController::class, 'getsubcategory']);
    Route::post('/getinventorydata', [ProductController::class, 'getinventorydata']);
    Route::post('/order/status/update', [OrderController::class, 'order_status_update'])->name('order.status.update');
    Route::get('/invoice/download/{id}', [OrderController::class, 'invoice_download'])->name('invoice.download');

    Route::get('/print/invoice/{id}', [PrintController::class, 'print_invoice'])->name('print.invoice');

    Route::get('/commingsoon', [HomeController::class, 'commingsoon'])->name('commingsoon');
});

Route::post('/getProduct', [POSController::class, 'getProduct'])->name('getProduct');
Route::post('/getAttributeDetails', [POSController::class, 'getAttributeDetails'])->name('getAttributeDetails');

