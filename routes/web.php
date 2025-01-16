<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\RegisterController;


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
// Definisi rute untuk otentikasi
Route::get('/login', [SesiController::class, 'index'])->name('login');
Route::post('/login', [SesiController::class, 'login']);
Route::get('/logout', [SesiController::class, 'logout'])->name('logout');




// Grup rute yang memerlukan otentikasi
Route::middleware(['auth'])->group(function () {

    Route::get('/index', [IndexController::class, 'index']);
    Route::get('/index/admin', [IndexController::class, 'admin'])->middleware('userAkases:admin')->name('admin');
    Route::get('/index/admin/users', [IndexController::class, 'daftaruser'])->name('daftaruser');
    Route::get('/admin/users/create', [IndexController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/users', [IndexController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/users/{id}/edit', [IndexController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/users/{id}', [IndexController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin/users/{id}', [IndexController::class, 'destroy'])->name('admin.user.delete');

    
    // Dosen
    Route::get('index/dosen', [IndexController::class, 'dosen'])->middleware('userAkases:dosen')->name('dosen');
    Route::get('/index/dosen/approve1', [IndexController::class, 'approveadmin'])->name('approveadmin');
    Route::get('/index/dosen/history', [IndexController::class, 'history'])->name('history');
    Route::get('/index/dosen/detail1/{id}', [IndexController::class, 'showDetail1'])->name('dosen.detail1');
    Route::post('/index/dosen/administrasi/update/{id}', [IndexController::class, 'updatedetail1'])->name('administrasi.update');
    Route::get('/index/dosen/administrasi/detail2/{id}', [IndexController::class, 'showDetail2'])->name('dosen.detail2');
    Route::post('/index/dosen/administrasi/update2/{id}', [IndexController::class, 'updatedetail2'])->name('administrasi.update2');
    Route::get('/index/dosen/administrasi/detail3/{id}', [IndexController::class, 'showDetail3'])->name('dosen.detail3');
    Route::post('index/dosen/administrasi/update3/{id}', [IndexController::class, 'updatedetail3'])->name('administrasi.update3');
    Route::get('/index/dosen/administrasi/detail4/{id}', [IndexController::class, 'showDetail4'])->name('dosen.detail4');
    Route::get('/index/dosen/approve2', [IndexController::class, 'approvekegiatan'])->name('approvekegiatan');
    Route::get('/index/dosen/approve3', [IndexController::class, 'approvematkul'])->name('approvematkul');
    Route::get('/index/dosen/view-pdf/{id}', [IndexController::class, 'viewPdf'])->name('administrasi.view_pdf');

    // Rute user
    Route::get('/index/user', [IndexController::class, 'user'])->middleware('userAkases:user')->name('user');
    Route::get('/index/user/tambahsop', [IndexController::class, 'createsop'])->name('user.tambahsop');
    Route::get('/index/user/status', [IndexController::class, 'status'])->name('user.status');
    Route::get('/index/user/pemilihankegiatan', [IndexController::class, 'createpemilihankegiatan'])->name('user.pemilihankegiatan');
    Route::get('/index/user/matakuliah', [IndexController::class, 'creatematakuliah'])->name('user.matakuliah');
    Route::post('/index/user/sop/store', [IndexController::class, 'usersopstore'])->name('sop.store');
    Route::post('/index/user/administrasi/store', [IndexController::class, 'administrasi'])->name('administrasi.store');
    Route::post('/index/user/administrasi/program-mbkm', [IndexController::class, 'storeProgramMbkm'])->name('administrasi.storeProgramMbkm');
    Route::post('/administrasi/mata-kuliah', [IndexController::class, 'storeMataKuliah'])->name('administrasi.storeMataKuliah');
    Route::get('/administrasi/{id}', [IndexController::class, 'show'])->name('administrasi.show');

    Route::get('/index/kaprodi', [IndexController::class, 'superadm'])->middleware('userAkases:admin,superadm')->name('superadm');
    Route::get('/index/kaprodi/historykaprodi', [IndexController::class, 'historykaprodi'])->name('historykaprodi');
    Route::get('/index/kaprodi/detail3/{id}', [IndexController::class, 'showDetailkaprodi'])->name('kaprodi.detail3');
    Route::post('/index/kaprodi/detail3/{id}', [IndexController::class, 'updatedetailkaprodi'])->name('kaprodi.updateDetail');
    Route::get('/index/kaprodi/detail4/{id}', [IndexController::class, 'showDetail5'])->name('kaprodi.detail4');
    Route::get('/index/kaprodi/approve', [IndexController::class, 'approvekaprodi'])->name('kaprodi.approve');
   





 
   
});

// Rute fallback untuk tampilan landing
Route::fallback(function () {
    return view('login');
});
