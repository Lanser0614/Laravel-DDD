<?php

use Illuminate\Support\Facades\Route;
use Modules\UI\Http\Controllers\Api\ApiGateway\CreditController;

Route::post('/', [CreditController::class, 'store']);
