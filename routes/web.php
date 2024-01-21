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
    $methods = config('rabbit_events', []);
    $method = data_get($methods, 'credit.created');
    $function_name = $method['method'];
    $dtoClass = new $method['dto'](
        [
            'aggregate_id' =>   'aggregate_id',
            'event_id' =>   'event_id',
            'payload' =>   'payload',
            'occurred_on' =>   'occurred_on',
            'event_name' =>   'event_name',
        ]
    );

    $class = app($method['class']);
    dd($class->$function_name($dtoClass));
});
