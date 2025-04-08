<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\userController;
use App\Models\chat;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::resource("/group", GroupController::class);

    // get all user without me
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');

    // get all message for this receiver
    Route::get('/chat/{receiverId}', [ChatController::class, 'chat'])->name('chat.show');

    // send message for this receiver
    Route::post('/chat/{receiverId}/send', [ChatController::class, 'sendMessage'])->name('sendMessage');

    // when i wraiting
    Route::post('/chat/typing/{receiverId}', [ChatController::class, 'typing'])->name('typing');

    Route::post('/online', [ChatController::class, 'setOnline'])->name('setOnline');
    Route::post('/offline', [ChatController::class, 'setOffline'])->name('setOffline');
});



Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
