<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CatatanApiController;

Route::get('/catatans', [CatatanApiController::class, 'index']);
