<?php

use App\Http\Controllers\AgentApiController;
use App\Http\Middleware\VerifyAgentToken;
use Illuminate\Support\Facades\Route;

Route::prefix('agent')->middleware([VerifyAgentToken::class, 'throttle:600,1'])->group(function () {
    Route::get('business', [AgentApiController::class, 'business']);
    Route::post('calls', [AgentApiController::class, 'storeCall']);
});
