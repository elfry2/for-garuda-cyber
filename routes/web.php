<?php

use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\MyVoucherController;
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

Route::get('/', function () {
    // return view('welcome');
    // return view('home.index');
    // })->name('home.index');
    return redirect()->route('login');
})->name('home.index');;


Route::get('/dashboard', function () {
    // return view('dashboard');
    // return redirect(route('tasks.index'));
    return redirect()->route('tenants.index');
})->middleware(['auth', 'verified', 'notSuspended'])->name('dashboard');

Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

Route::post('register', [RegisteredUserController::class, 'store']);

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/preference', [PreferenceController::class, 'store'])->name('preference.store');

Route::get('/account-suspended', function () {
    return view('account-suspended.index', [
        'backURL' => route('home.index')
    ]);
})->middleware('auth')->name('account-suspended');

Route::middleware(['auth', 'notSuspended'])->group(function () {
    Route::resource('tenants', TenantController::class)->only('index');
    Route::get('tenants/search', [TenantController::class, 'search'])->name('tenants.search');
    Route::post('tenants/{tenant}/buy', [TenantController::class, 'buy'])->name('tenants.buy');
    Route::get('tenants/purchase-success/{uuid}', [TenantController::class, 'purchaseSuccess'])->name('tenants.purchaseSuccess');
    Route::get('tenants/purchase-success/{uuid}/download', [TenantController::class, 'downloadInvoice'])->name('tenants.downloadInvoice');

    Route::resource('vouchers', VoucherController::class)->only('index');
    Route::get('vouchers/search', [VoucherController::class, 'search'])->name('vouchers.search');
    Route::post('vouchers/{voucher}/buy', [VoucherController::class, 'buy'])->name('vouchers.buy');
    Route::get('vouchers/purchase-success/{uuid}', [VoucherController::class, 'purchaseSuccess'])->name('vouchers.purchaseSuccess');
    Route::get('vouchers/{voucher}/upload-invoice', [VoucherController::class, 'uploadInvoice'])->name('vouchers.uploadInvoice');

    Route::get('my-vouchers', [MyVoucherController::class, 'index'])->name('myVouchers.index');
    Route::get('my-vouchers/search', [MyVoucherController::class, 'search'])->name('my-vouchers.search');

    Route::middleware('admin')->group(function() {
        Route::get('users/{user}/deleteAvatar', [RegisteredUserController::class, 'deleteAvatar'])->name('users.deleteAvatar');
        Route::post('users/{user}/destroyAvatar', [RegisteredUserController::class, 'destroyAvatar'])->name('users.destroyAvatar');
        Route::get('users/{user}/delete', [RegisteredUserController::class, 'delete'])->name('users.delete');
        Route::get('users/search', [RegisteredUserController::class, 'search'])->name('users.search');
        Route::get('users/preferences', [RegisteredUserController::class, 'preferences'])->name('users.preferences');
        Route::post('users/preferences', [RegisteredUserController::class, 'applyPreferences'])->name('users.applyPreferences');
        Route::resource('users', RegisteredUserController::class)->except('show');
    });
});
