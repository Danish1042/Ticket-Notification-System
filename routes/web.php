<?php

use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/',[WebsiteController::class, 'index'])->name('/');
Route::post('tickets-buy',[WebsiteController::class, 'tickets_buy'])->name('tickets.buy');

Route::middleware('auth')->group(function () {

    Route::get('my-tickets',[WebsiteController::class, 'my_tickets'])->name('my-tickets');
    Route::post('book-me',[WebsiteController::class, 'book_me'])->name('book-me');
    Route::delete('distroy-tickets/{id}',[WebsiteController::class, 'distroy_tickets'])->name('distroy-tickets');
    Route::get('logout',[WebsiteController::class, 'logout'])->name('logout-user');
});

require __DIR__.'/auth.php';
