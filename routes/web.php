<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', [ContactsController::class, 'index']);
