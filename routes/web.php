<?php

use App\Livewire\CreateBox;
use App\Livewire\Feedbox;
use App\Livewire\JoinFeedbox;
use App\Livewire\Profile;
use App\Livewire\RequestFeedbox;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/tutorial',function(){
    return view('howitworks');
})->name('howitworks');

Route::get('/community',function(){
    return view('community');
})->name('community');

Route::prefix('dashboard')->middleware(['auth','verified'])->group(function(){
    Route::view('/', 'dashboard')->name('dashboard');
    Route::get('/addbox', CreateBox::class)->name('createbox');
});

Route::prefix('feedbox')->middleware(['auth','verified'])->group(function(){
    Route::get('/{box}', Feedbox::class)->name('feedbox');

});
Route::get('/profile', Profile::class)->name('profile')->middleware(['auth','verified']);

Route::prefix('joinfeedbox')->middleware(['auth','verified'])->group(function(){
    Route::get('/',JoinFeedbox::class)->name('joinfeedbox');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
