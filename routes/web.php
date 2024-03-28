<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataPeminjam;
use App\Http\Controllers\DataPeminjamController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
#<<<<<<< HEAD
#use App\Http\Controllers\VerifikasiController;

#get nampilke halaman
#post ambil data
#=======
use App\Http\Controllers\pinjamController;


#>>>>>>> 5e259d86d50200bd7611cd9ad94070a133dc52a2

 
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

#Route::get('/', [LoginController::class, 'login'])->name('login');
#Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
// =========AUTH LOGIN
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class,'action_login'])->name('actionlogin');
#Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::get('/peminjam', 'App\Http\Controllers\PeminjamController@create');


Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dasboard');

Route::post('peminjam.store', 'App\Http\Controllers\PeminjamController@store')->name('peminjam.store');

Route::get('/data-peminjam', [DataPeminjam::class, 'index']);

Route::get('DataPeminjam', [DataPeminjamController::class, 'index']);

Route::get('tambahalat', 'App\Http\Controllers\TambahAlatController@create');

//MASUK KE ADMIN
Route::get('adminpage/dashboard', function(){
    return view("adminpage/dashboard");
    });

Route::post('tambahalat.store', 'App\Http\Controllers\TambahAlatController@store')->name('tambahalat.store');

#<<<<<<< HEAD
#Route::get('verifikasi',[VerifikasiController::class,'index']) -> name ('verifikasi') ;

//REGISTER
Route::get('/register', [LoginController::class, 'showRegistrationPage'])->name('register.index');
Route::post('/register', [LoginController::class, 'register'])->name('register');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



#=======
// Definisikan rute untuk menangani permintaan POST dari form
Route::post('/history', [pinjamController::class, 'index'])->name('history');
Route::get('/pinjam', [pinjamController::class, 'create'])->name('pinjam');
Route::post('/simpan', [pinjamController::class, 'store'])->name('simpan');
#>>>>>>> 5e259d86d50200bd7611cd9ad94070a133dc52a2
Route::get("/", function(){
return view("mahasiswa.index");
});
Route::get("/history", function(){
    return view("mahasiswa.history");
    });
    