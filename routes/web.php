<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;
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


Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/proseslogin', [AuthController::class, 'proseslogin'])->name('loginkaryawan');
});

Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin'])->name('prosesloginadmin');
});

Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboardkaryawan');
    Route::get('/proseslogout', [AuthController::class, 'proseslogout'])->name('logoutkaryawan');

    //Presensi
    Route::get('/presensi/create', [PresensiController::class, 'create'])->name('presensi.create');
    Route::post('/presensi/store', [PresensiController::class, 'store'])->name('presensi.store');

    //Edit Profile
    Route::get('/editprofile', [PresensiController::class, 'editprofile'])->name('editprofilekaryawan');
    Route::post('/presensi/{username}/updateprofile', [PresensiController::class, 'updateprofile'])->name('presensi.updateprofile');

    //History
    Route::get('/presensi/histori',[PresensiController::class, 'histori'])->name('presensi.histori');
    Route::post('/gethistori',[PresensiController::class, 'gethistori'])->name('gethistori');

    //Izin
    Route::get('/presensi/izin',[PresensiController::class, 'izin'])->name('presensi.izin');
    Route::get('/presensi/buatizin',[PresensiController::class, 'buatizin'])->name('presensi.buatizin');
    Route::post('/presensi/storeizin',[PresensiController::class, 'storeizin'])->name('presensi.storeizin');

});

Route::middleware(['auth:user'])->group(function() {
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin'])->name('logoutadmin');
    Route::get('/panel/dashboardadmin', [DashboardController::class, 'dashboardadmin'])->name('dashboardadmin');
});

