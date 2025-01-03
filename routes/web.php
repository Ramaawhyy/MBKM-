<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Middleware\TokenAuthenticate;
use App\Http\Controllers\ContenController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\SuperadmController;
use App\Models\event;
use App\Models\Kandidat;
use App\Models\token;

// Definisi rute untuk otentikasi
Route::get('/login', [SesiController::class, 'index'])->name('login');
Route::post('/login', [SesiController::class, 'login']);

// Definisi rute otentikasi login token
Route::get('/login-token', [SesiController::class, 'token'])->name('logintoken');
Route::post('/login-token', [SesiController::class, 'loginToken']);




// Grup rute yang memerlukan otentikasi
Route::middleware(['auth'])->group(function () {

    Route::get('/index', [IndexController::class, 'index']);
    Route::get('/index/admin', [IndexController::class, 'admin'])->middleware('userAkases:admin')->name('admin');
    Route::get('/index/admin/edit/{id}', [IndexController::class, 'adminsopedit'])->name('mr.sop.edit');

    // Meng-handle update persetujuan MR dari form edit
    Route::put('/index/admin/update/{id}', [IndexController::class, 'adminsopupdate'])->name('mr.sop.update');
    Route::get('/sop/{id}', [IndexController::class, 'sopshow'])->name('sop.show');
    Route::delete('/sop/{id}', [IndexController::class, 'sopdestroy'])->name('sop.delete');


    // Rute yang hanya dapat diakses dengan token valid
    Route::get('index/sekretaris', [IndexController::class, 'sekretaris'])->middleware('userAkases:sekretaris')->name('sekretaris');
    Route::get('index/sekretaris/{id}/edit', [IndexController::class, 'editsekre'])->name('sekretaris.sop.edit');
    Route::put('index/sekretaris/{id}/update', [IndexController::class, 'sekresopupdate'])->name('sekretaris.sop.update');

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
   


    //TOKEN
    Route::get('/index/token/{id_event}', [IndexController::class, 'token'])
        ->name('adminall.token')
        ->middleware('userAkases:admin,superadm');
    //Route::get('/createTokensForm/{id_event}', [IndexController::class, 'createTokensForm'])->name('adminall.tambahtoken');
    Route::get('/createTokensForm/{id_event}', function ($id_event) {
        // Mengambil nilai $id_event dari URL
        $event = Token::where('id_event', $id_event)->first();
        // Lakukan sesuatu dengan $event dan $id_event
        return view('adminall.tambahtoken', compact('event', 'id_event'));
    })->name('adminall.tambahtoken');
    Route::post('/generateTokens', [IndexController::class, 'generateTokens'])->name('adminall.generateTokens');
    Route::delete('/deleteToken/{id}', [IndexController::class, 'deleteToken'])->name('deleteToken');


    //RESULT HASIL
    Route::get('/index/result/{id_event}', [IndexController::class, 'result'])->name('adminall.result')->middleware('userAkases:superadm');


    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
    Route::get('/create', [IndexController::class, 'create'])->name('adminall.tambah');
    Route::post('/store', [IndexController::class, 'store'])->name('adminall.store');


    // Rute pemilihan yang memerlukan otentikasi dengan peran user
    Route::get('/pemilihan', function () {
        return view('fill.pemilihan');
    })->name('pemilihan')->middleware('userAkases:user');
    Route::get('/kandidat', function () {
        return view('fill.kandidat');
    })->name('kandidat')->middleware('userAkases:admin');



    //tambah superadmin
    //token untuk buat login user token
    //Route::post('/voting-tokens/use', 'VotingTokenController@useToken')->name('voting_tokens.use');
});

// Rute fallback untuk tampilan landing
Route::fallback(function () {
    return view('login');
});
