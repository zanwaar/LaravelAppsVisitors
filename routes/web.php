<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ActivityLog\ActivityLog;
use App\Http\Livewire\Bagian\ListBagian;
use App\Http\Livewire\Barang\ListBarang;
use App\Http\Livewire\Magang\ListMagang;
use App\Http\Livewire\Profile\UpdateProfile;
use App\Http\Livewire\Settings\UpdateSetting;
use App\Http\Livewire\Tamu\CreateTamu;
use App\Http\Livewire\Tamu\ListTamu;
use App\Http\Livewire\Tamu\LogTamu;
use App\Http\Livewire\Users\ListUsers;
use App\Http\Livewire\Workingpermit\CreateWorkingPermit;
use App\Http\Livewire\Workingpermit\DetailWorkingPermit;
use App\Http\Livewire\Workingpermit\ListWorkingPermit;


Route::middleware(['auth'])->group(function () {
    Route::get('/', DashboardController::class);
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('bukuTamu', LogTamu::class)->name('tamu');
    Route::get('daftarTamu', ListTamu::class)->name('daftartamu');
    Route::get('tambahTamu', CreateTamu::class)->name('tambahtamu');
    Route::get('listMagang', ListMagang::class)->name('listmagang');
    Route::get('listbarang', ListBarang::class)->name('listbarang');
    Route::get('bagian', ListBagian::class)->name('bagian');
    Route::get('activity', ActivityLog::class)->name('activity');
    Route::get('listworking', ListWorkingPermit::class)->name('listworking');
    Route::get('createworking', CreateWorkingPermit::class)->name('createworking');
    Route::get('detailworking/{workingpermit}/detail', DetailWorkingPermit::class)->name('detailworking.detail');
    Route::get('profile', UpdateProfile::class)->name('profile.edit');
    Route::get('settings', UpdateSetting::class)->name('settings');
    Route::get('users', ListUsers::class)->name('users');

});
