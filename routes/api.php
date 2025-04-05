<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;

Route::get('/users', [UserApiController::class, 'index']);
