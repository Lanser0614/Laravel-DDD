<?php

use App\Rabbit\RabbitQueue;
use Illuminate\Support\Facades\Route;
use Modules\BusinessCode\Credit\Enum\CreditStatusEnum;
use App\Rabbitmq\Rabbit\Client;
use PhpAmqpLib\Message\AMQPMessage;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the ModuleRouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return "ok";
});
