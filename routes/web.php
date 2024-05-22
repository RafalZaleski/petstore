<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PetStore\Controllers\PetStoreController;

Route::get('/', function () {
    return view('index');
});

Route::apiResource('/pets', PetStoreController::Class)
    ->except(['index', 'create', 'edit']);
