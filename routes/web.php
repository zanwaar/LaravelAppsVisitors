<?php

use App\Http\Livewire\Analytics;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Users\ListUsers;
use App\Http\Livewire\Admin\Profile\UpdateProfile;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\ActivityLog\ActivityLog;
use App\Http\Livewire\Admin\Appointments\ListAppointments;
use App\Http\Livewire\Admin\Appointments\CreateAppointmentForm;
use App\Http\Livewire\Admin\Appointments\UpdateAppointmentForm;
use App\Http\Livewire\Admin\Messages\ListConversationAndMessages;
use App\Http\Livewire\Admin\Settings\UpdateSetting;
use App\Http\Livewire\Bagian\ListBagian;
use App\Http\Livewire\Magang\ListMagang;
use App\Http\Livewire\Tamu\CreateTamu;
use App\Http\Livewire\Tamu\ListTamu;
use App\Http\Livewire\Tamu\LogTamu;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->middleware(['guest:' . config('fortify.guard')])
    ->name('login.login');

Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('bukuTamu', LogTamu::class)->name('tamu');
    Route::get('daftarTamu', ListTamu::class)->name('daftartamu');
    Route::get('tambahTamu', CreateTamu::class)->name('tambahtamu');
    Route::get('listMagang', ListMagang::class)->name('listmagang');


    Route::get('profile', UpdateProfile::class)->name('profile.edit');
    Route::get('settings', UpdateSetting::class)->name('settings');
    Route::get('users', ListUsers::class)->name('users');
    Route::get('activity', ActivityLog::class)->name('activity');
    Route::get('bagian', ListBagian::class)->name('bagian');




    Route::get('appointments', ListAppointments::class)->name('appointments');
    Route::get('appointments/create', CreateAppointmentForm::class)->name('appointments.create');
    Route::get('appointments/{appointment}/edit', UpdateAppointmentForm::class)->name('appointments.edit');
    Route::get('analytics', Analytics::class)->name('analytics');
    Route::get('messages', ListConversationAndMessages::class)->name('messages');
});
