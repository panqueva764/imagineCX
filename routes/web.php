<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', [ContactsController::class, 'index']);
Route::delete('/contacts', [ContactsController::class, 'deleteContact'])->name('contacts.deleteContact');
Route::post('/contacts', [ContactsController::class, 'createContact'])->name('contacts.createContact');
