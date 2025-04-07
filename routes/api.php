<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Jobs\FetchAndStoreRandomUser;

Route::get('/run-job', function () {
    FetchAndStoreRandomUser::dispatch();
    return 'Job dispatched successfully!';
});

Route::get('/users', [UserApiController::class, 'index']);
