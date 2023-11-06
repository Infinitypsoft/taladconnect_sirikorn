<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\GallerysController;
use App\Http\Controllers\SettingSeoController;
// use App\Http\Controllers\ZgAdminController;
use App\Http\Controllers\AwardsController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\StallController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContractBlockController;
use App\Http\Controllers\ContractSettingController;
use App\Http\Controllers\MarketSettingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TransfersController;
use App\Http\Controllers\MeterElectricController;
use App\Http\Controllers\MeterWaterController;
use App\Http\Controllers\MeterElectricBillController;
use App\Http\Controllers\MeterWaterBillController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StoreRecommenController;
use App\Http\Controllers\TennantMemberController;
use App\Http\Controllers\TennantMemberElectric;
use App\Http\Controllers\TennantMemberWater;
use App\Models\block;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//   return $request->user();
// });

// Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[AdminController::class,'getList']);
    Route::post('/create',[AdminController::class,'create']);
    Route::get('/{id}',[AdminController::class,'getById']);
    Route::get('/detail/{id}',[AdminController::class,'getDetail']);
    Route::post('/update',[AdminController::class,'update']);
    Route::get('/update/status/{id}',[AdminController::class,'updateStatus']);
    Route::get('/delete/{id}',[AdminController::class,'delete']);
    Route::post('/change/password',[AdminController::class,'changePassword']);
});

Route::prefix('seo')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[SettingSeoController::class,'getFirst']);
    Route::post('/update',[SettingSeoController::class,'update']);
});


Route::prefix('banner')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[BannerController::class,'getList']);
    Route::post('/create',[BannerController::class,'create']);
    Route::get('/{id}',[BannerController::class,'getById']);
    Route::get('/detail/{id}',[BannerController::class,'getDetail']);
    Route::post('/update',[BannerController::class,'update']);
    Route::post('/update/status/{id}',[BannerController::class,'updateStatus']);
    Route::get('/delete/{id}',[BannerController::class,'delete']);
});

Route::prefix('gallery')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[GallerysController::class,'getList']);
    Route::post('/update',[GallerysController::class,'update']);
});

Route::prefix('award')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[AwardsController::class,'getList']);
    Route::post('/create',[AwardsController::class,'create']);
    Route::get('/{id}',[AwardsController::class,'getById']);
    Route::get('/detail/{id}',[AwardsController::class,'getDetail']);
    Route::post('/update',[AwardsController::class,'update']);
    Route::post('/update/status/{id}',[AwardsController::class,'updateStatus']);
    Route::get('/delete/{id}',[AwardsController::class,'delete']);
});

Route::prefix('stall')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[StallController::class,'getList']);
    Route::post('/create',[StallController::class,'create']);
    Route::get('/{id}',[StallController::class,'getById']);
    Route::get('/detail/{id}',[StallController::class,'getDetail']);
    Route::post('/update',[StallController::class,'update']);
    Route::post('/update/status/{id}',[StallController::class,'updateStatus']);
    Route::get('/delete/{id}',[StallController::class,'delete']);

    Route::get('/list/to/select/box',[StallController::class,'getListSelectBox']);
});

Route::prefix('content')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[ContentController::class,'getList']);
    Route::post('/create',[ContentController::class,'create']);
    Route::get('/{id}',[ContentController::class,'getById']);
    Route::get('/detail/{id}',[ContentController::class,'getDetail']);
    Route::post('/update',[ContentController::class,'update']);
    Route::post('/update/status/{id}',[ContentController::class,'updateStatus']);
    Route::get('/delete/{id}',[ContentController::class,'delete']);
});

Route::prefix('contact')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[ContactController::class,'getList']);
    Route::post('/create',[ContactController::class,'create']);
    Route::get('/{id}',[ContactController::class,'getById']);
    Route::get('/detail/{id}',[ContactController::class,'getDetail']);
    Route::post('/update',[ContactController::class,'update']);
    Route::post('/update/status/{id}',[ContactController::class,'updateStatus']);
    Route::get('/delete/{id}',[ContactController::class,'delete']);
});

Route::prefix('review')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[ReviewController::class,'getList']);
    Route::post('/create',[ReviewController::class,'create']);
    Route::get('/{id}',[ReviewController::class,'getById']);
    Route::get('/detail/{id}',[ReviewController::class,'getDetail']);
    Route::post('/update',[ReviewController::class,'update']);
    Route::post('/update/status/{id}',[ReviewController::class,'updateStatus']);
    Route::get('/delete/{id}',[ReviewController::class,'delete']);
});

Route::prefix('request')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[RequestsController::class,'getList']);
    Route::post('/create',[RequestsController::class,'create']);
    Route::get('/{id}',[RequestsController::class,'getById']);
    Route::get('/detail/{id}',[RequestsController::class,'getDetail']);
    Route::post('/update',[RequestsController::class,'update']);
    Route::post('/update/status/{id}',[RequestsController::class,'updateStatus']);
    Route::get('/delete/{id}',[RequestsController::class,'delete']);
});

Route::prefix('transfer')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[TransfersController::class,'getList']);
    Route::post('/create',[TransfersController::class,'create']);
    Route::get('/{id}',[TransfersController::class,'getById']);
    Route::get('/detail/{id}',[TransfersController::class,'getDetail']);
    Route::post('/update',[TransfersController::class,'update']);
    Route::post('/update/status/{id}',[TransfersController::class,'updateStatus']);
    Route::get('/delete/{id}',[TransfersController::class,'delete']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile/admin', function (Request $request) {  return auth()->user(); })->name('admin.profile');
    Route::get('/logout/admin', [AuthController::class, 'logout']);
});

Route::prefix('site')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[SiteController::class,'getList']);
    Route::post('/create',[SiteController::class,'create']);
    Route::get('/list',[SiteController::class,'getLisite']);
    Route::get('/{id}',[SiteController::class,'getById']);
    Route::get('/detail/{id}',[BlockController::class,'getDetail']);
    Route::get('/delete/{id}',[SiteController::class,'delete']);

});

Route::prefix('block')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[BlockController::class,'getList']);
    Route::post('/create',[BlockController::class,'create']);
    Route::get('/{id}',[BlockController::class,'getById']);
    Route::get('/detail/{id}',[BlockController::class,'getDetail']);
    Route::post('/update',[BlockController::class,'update']);
    Route::get('/update/status/{id}',[BlockController::class,'updateStatus']);
    Route::post('/delete_all',[BlockController::class,'deleteAll']);
    Route::get('/delete/{id}',[BlockController::class,'delete']);

    Route::get('/list/to/create/store',[BlockController::class,'getListToCreateStore']);
});

Route::prefix('electric')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[MeterElectricController::class,'getList']);
    Route::post('/create',[MeterElectricController::class,'create']);
    Route::get('/{id}',[MeterElectricController::class,'getById']);
    Route::post('/update/{id}',[MeterElectricController::class,'update']);
    Route::post('/startdate/update',[MeterElectricController::class,'updateStartDate']);
    Route::get('/delete/{id}',[MeterElectricBillController::class,'delete']);
    Route::post('/bill/create',[MeterElectricBillController::class,'create']);
    Route::post('/bill/update',[MeterElectricBillController::class,'update']);
    Route::get('/bill/status/{id}',[MeterElectricBillController::class,'updateStatus']);
    Route::get('/bill/list',[MeterElectricBillController::class,'getList']);
    Route::get('/bill/{id}',[MeterElectricBillController::class,'getById']);
    Route::get('/bill/check/code',[MeterElectricBillController::class,'checkBillCode']);
    Route::get('/bill/detail/{id}',[MeterElectricBillController::class,'getDetailById']);
    Route::get('/bill/save/meter/{id}',[MeterElectricBillController::class,'getDetailSaveMeterById']);
    Route::get('/tennant/create/{id}',[TennantMemberElectric::class,'create']);
    Route::get('/tennant/list/{id}',[TennantMemberElectric::class,'getList']);
    Route::get('/tennant/detail/{id}',[TennantMemberElectric::class,'getDetailById']);
    Route::get('/tennant/status/{id}',[TennantMemberElectric::class,'updateStatus']);
});

Route::prefix('water')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[MeterWaterController::class,'getList']);
    Route::post('/create',[MeterWaterController::class,'create']);
    Route::get('/{id}',[MeterWaterController::class,'getById']);
    Route::post('/update/{id}',[MeterWaterController::class,'update']);
    Route::post('/startdate/update',[MeterWaterController::class,'updateStartDate']);
    Route::get('/delete/{id}',[MeterWaterBillController::class,'delete']);
    Route::post('/bill/create',[MeterWaterBillController::class,'create']);
    Route::post('/bill/update',[MeterWaterBillController::class,'update']);
    Route::get('/bill/status/{id}',[MeterWaterBillController::class,'updateStatus']);
    Route::get('/bill/list',[MeterWaterBillController::class,'getList']);
    Route::get('/bill/{id}',[MeterWaterBillController::class,'getById']);
    Route::get('/bill/check/code',[MeterWaterBillController::class,'checkBillCode']);
    Route::get('/bill/detail/{id}',[MeterWaterBillController::class,'getDetailById']);
    Route::get('/bill/save/meter/{id}',[MeterWaterBillController::class,'getDetailSaveMeterById']);
    Route::get('/tennant/create/{id}',[TennantMemberWater::class,'create']);
    Route::get('/tennant/list/{id}',[TennantMemberWater::class,'getList']);
    Route::get('/tennant/detail/{id}',[TennantMemberWater::class,'getDetailById']);
    Route::get('/tennant/status/{id}',[TennantMemberWater::class,'updateStatus']);
});

Route::prefix('tennant')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[TennantMemberController::class,'getList']);
    Route::post('/create',[TennantMemberController::class,'create']);
    Route::get('/{id}',[TennantMemberController::class,'getById']);
    Route::get('/detail/{id}',[TennantMemberController::class,'getDetail']);
    Route::post('/update',[TennantMemberController::class,'update']);
    Route::post('/update/status/{id}',[TennantMemberController::class,'updateStatus']);
    Route::get('/delete/{id}',[TennantMemberController::class,'delete']);
    Route::get('/list/selectbox',[TennantMemberController::class,'getListToSelectBox']);


});

Route::prefix('contract')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[ContractSettingController::class,'getById']);
    Route::post('/update',[ContractSettingController::class,'update']);

    Route::prefix('block')->group(function () {
        Route::get('/',[ContractBlockController::class,'getList']);
        Route::post('/create',[ContractBlockController::class,'create']);
        Route::get('/{id}',[ContractBlockController::class,'getById']);
        Route::post('/update',[ContractBlockController::class,'update']);
        Route::get('/confirm/{id}',[ContractBlockController::class,'confirmContract']);
        Route::post('/upload/slip',[ContractBlockController::class,'uploadSlip']);
        Route::get('/check/buyed/{id}',[ContractBlockController::class,'checkBlockGotBuyed']);
    });
});


Route::prefix('store')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/list/{tennant_id}',[StoreController::class,'getListStoreByTenantId']);
    Route::post('/create',[StoreController::class,'create']);
    Route::get('/{store_id}',[StoreController::class,'getById']);
    Route::post('/update',[StoreController::class,'update']);

    Route::get('/list/select/box',[StoreController::class,'getListToselectBox']);


    Route::prefix('recommen')->group(function () {
        Route::get('/list',[StoreRecommenController::class,'getList']);
        Route::post('/update',[StoreRecommenController::class,'update']);
    });
});


Route::prefix('bill')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',[BillController::class,'getList']);
    Route::get('/bill_id',[BillController::class,'getIdBill']);
    Route::post('/create',[BillController::class,'create']);
    Route::get('/{id}',[BillController::class,'getById']);
    Route::get('/detail/{id}',[BillController::class,'getDetail']);
    Route::post('/update',[BillController::class,'update']);
    Route::post('/update/status/{id}',[BillController::class,'updateStatus']);
    Route::get('/delete/{id}',[BillController::class,'delete']);
});


Route::prefix('market')->group(function () {
    Route::get('/',[MarketSettingController::class,'getDetail']);
});
