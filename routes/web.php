<?php

use App\Http\Controllers\AgreementController;
use App\Http\Controllers\HousesCategoryController;
use App\Http\Controllers\HousesController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\StationsController;
use App\Http\Controllers\UserController;
use App\Models\HousesCategory;
use App\Http\Controllers\BulkBidderImportController;
use App\Http\Controllers\BulkHouseController;
use App\Http\Controllers\BidderAdditionalDetailsController;
use App\Http\Controllers\DisqualifiedBidderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/updated-bidders', [App\Http\Controllers\HomeController::class, 'updatedBiddersByUser'])->name('updated.bidders');

Route::group(['middleware' => ['auth']], function () {
    //dashboard

    // Categories
    Route::get('/housecategory', [HousesCategoryController::class, 'index'])->name('admin.housecategories');
    Route::get('/housecategory/new', [HousesCategoryController::class, 'create'])->name('admin.housecategory.create');
    Route::post('/housecategory/new/save', [HousesCategoryController::class, 'store'])->name('admin.createHouseCategory');
    Route::get('/housecategory/edit/{id}', [HousesCategoryController::class, 'edit'])->name('admin.editHouseCategory');
    Route::get('/house/showallbidders/{house}', [BidderAdditionalDetailsController::class, 'getHouseBidders'])->name('admin.getHouseBidders');
    Route::post('/housecategory/edit/{id}', [HousesCategoryController::class, 'update'])->name('admin.updateHouseCategory');
    Route::get('/housecategory/show/{id}', [HousesCategoryController::class, 'show'])->name('admin.showHouseCategory');

    // agreements
    Route::get('/agreement', [AgreementController::class, 'index'])->name('admin.agreements');
    Route::get('/agreement/new', [AgreementController::class, 'create'])->name('admin.agreement.create');
    Route::post('/agreement/new/save', [AgreementController::class, 'store'])->name('admin.createAgreement');
    Route::get('/agreement/edit/{id}', [AgreementController::class, 'edit'])->name('admin.editAgreement');
    Route::post('/agreement/edit/{id}', [AgreementController::class, 'update'])->name('admin.updateAgreement');
    Route::get('/agreement/show/{id}', [AgreementController::class, 'show'])->name('admin.showAgreement');

    // stations
    Route::get('/bidderstation', [StationsController::class, 'index'])->name('admin.bidderstation');
    Route::get('/bidderstation/new', [StationsController::class, 'create'])->name('admin.BidderStation.create');
    Route::post('/bidderstation/new/save', [StationsController::class, 'store'])->name('admin.createBidderStation');
    Route::get('/bidderstation/edit/{id}', [StationsController::class, 'edit'])->name('admin.editBidderStation');
    Route::post('/bidderstation/edit/{id}', [StationsController::class, 'update'])->name('admin.updateBidderStation');
    Route::get('/bidderstation/show/{id}', [StationsController::class, 'show'])->name('admin.showBidderStation');

    // houses
    Route::get('/house', [HousesController::class, 'index'])->name('admin.houses');
    Route::get('/house/nobidders', [HousesController::class, 'nobidder'])->name('admin.nobidder');
    Route::get('/house/only/onebidders', [HousesController::class, 'onebidder'])->name('admin.onebidder');
    Route::get('/house/new', [HousesController::class, 'create'])->name('admin.house.create');
    Route::post('/house/new/save', [HousesController::class, 'store'])->name('admin.createHouse');
    Route::get('/house/edit/{house}', [HousesController::class, 'edit'])->name('admin.editHouse');
    Route::post('/house/edit/{house}', [HousesController::class, 'update'])->name('admin.updateHouse');

    Route::get('/house/show/{house}', [HousesController::class, 'show'])->name('admin.showHouse');

    //logs
    Route::get('/logs', [LogController::class, 'index'])->name('admin.logs');
    Route::get('/logs/user/{id}', [LogController::class, 'userLog'])->name('admin.userLog');

    //users
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/trashed', [UserController::class, 'index'])->name('admin.trashed');
    Route::get('/users/new', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/users/new/save', [UserController::class, 'store'])->name('admin.createUser');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('admin.editUser');
    Route::post('/users/edit/{id}', [UserController::class, 'update'])->name('admin.updateUser');
    Route::post('/users/makeadmin/{id}', [UserController::class, 'admin'])->name('user.adminate');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('admin.deleteUser');
    Route::get('/users/trashed', [UserController::class, 'onlyTrashed'])->name('admin.trashedUsers');

    //Bidders Bulk Import
    Route::get('/import-bidders', [BulkBidderImportController::class, 'showForm'])->name('import.bidders.form');
    Route::post('/import-bidders', [BulkBidderImportController::class, 'import'])->name('import.bidders');
    Route::get('/mimport-houses', [BulkHouseController::class, 'mshowForm'])->name('mimport.houses.form');
    Route::post('/mimport-houses', [BulkHouseController::class, 'mimport'])->name('mimport.houses');

    //Biders
    Route::get('/biders', [BidderAdditionalDetailsController::class, 'index'])->name('admin.bidders');
    Route::get('/biders/update', [BidderAdditionalDetailsController::class, 'updatepage'])->name('admin.bidders.update');
    Route::post('/bidders/update/details', [BidderAdditionalDetailsController::class, 'update'])->name('admin.bidders.update.details');
    Route::get('/top-bidders', [BidderAdditionalDetailsController::class, 'topBidders'])->name('admin.topBidders');
    Route::get('/api/bidders/search', [BidderAdditionalDetailsController::class, 'searchReceiptNumbers'])->name('getReceiptNumbers');
    Route::get('/api/bidders/info/{receiptNumber}', [BidderAdditionalDetailsController::class, 'getBidderInfo'])->name('getBidderInfo');
    // Route::get('/api/bidders/house/info/{houseNumber}', [BidderAdditionalDetailsController::class, 'getBidderHouseInfo'])->name('getBidderHouseInfo');
    Route::get('/api/bidders/house/info/{houseNumber}', [BidderAdditionalDetailsController::class, 'getBidderHouseInfo'])
        ->where('houseNumber', '.*')
        ->name('getBidderHouseInfo');
    Route::get('/disqualified-bidders', [BidderAdditionalDetailsController::class, 'disqualifiedBidders'])->name('disqualifiedBidders');
    Route::get('/specialdisqualifiedbidders', [DisqualifiedBidderController::class, 'index'])->name('admin.specialdisqualifiedbidders');
    Route::get('/specialdisqualifiedbidders/update/form', [DisqualifiedBidderController::class, 'updateForm'])->name('admin.specialdisqualifiedbidders.update.form');
    Route::post('/specialdisqualifiedbidders/update/details', [DisqualifiedBidderController::class, 'disqualifiedBidderWithSpecialReason'])->name('admin.specialdisqualifiedbidders.update.details');
    // Route for displaying the form to create a new bidder
    Route::get('/bidders/create', [BidderAdditionalDetailsController::class, 'create'])->name('bidders.create');
    Route::get('/bidders/edit/{id}', [BidderAdditionalDetailsController::class, 'edit'])->name('bidders.edit');
    Route::post('/bidders/{id}', [BidderAdditionalDetailsController::class, 'updateinfo'])->name('bidders.updateinfo');
    Route::get('/bidders/show/{id}', [BidderAdditionalDetailsController::class, 'show'])->name('bidders.show');
    Route::post('/bidders/store', [BidderAdditionalDetailsController::class, 'store'])->name('admin.bidders.store');
    Route::post('/bidders/store/new', [BidderAdditionalDetailsController::class, 'store'])->name('admin.bidders.createnew');
    Route::post('/bidders/update/{id}', [BidderAdditionalDetailsController::class, 'update'])->name('bidders.update');
    Route::get('winner/bidders/print-results', [BidderAdditionalDetailsController::class, 'printTopBiddersForHouses'])->name('print.results');
    Route::post('/bidders/rank/assign', [BidderAdditionalDetailsController::class, 'assignRankForHouseBidders'])->name('bidders.assignRankForHouseBidders');
    
    Route::get('rank/bidders', [BidderAdditionalDetailsController::class, 'updaterank'])->name('admin.updaterank');
    
    //Houses Bulk Import
    Route::get('/import-houses', [BulkHouseController::class, 'showForm'])->name('import.houses.form');
    Route::post('/import-houses', [BulkHouseController::class, 'import'])->name('import.houses');
    Route::get('bidders/{id}/print-results', [BidderAdditionalDetailsController::class, 'printHouseAndBidders'])->name('printHouseAndBidders');

    Route::resource('roles', RoleController::class);
    // Profile
    Route::get('/settings/profile', [UserController::class, 'profile'])->name('admin.profile');
    Route::post('/settings/profile', [UserController::class, 'update'])->name('change.profile');
    Route::get('/settings/changepassword', [UserController::class, 'password'])->name('password');
    Route::post('/settings/changepassword', [UserController::class, 'changepassword'])->name('change.password');


    Route::get('/edit/specialdisqualifiedbidders/update/form/{id}', [DisqualifiedBidderController::class, 'edit'])->name('admin.disedit');
    Route::post('/edit/specialdisqualifiedbidders/update/{id}', [DisqualifiedBidderController::class, 'update'])->name('admin.disupdate');
});
