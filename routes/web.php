<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatatanController;

Route::get('/', function () {
    return redirect()->route('catatan.index');
});

Route::resource('catatan', CatatanController::class)
    ->except(['show']);
