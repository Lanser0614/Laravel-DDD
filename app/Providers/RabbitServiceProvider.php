<?php

namespace App\Providers;

use App\Rabbit\RabbitQueue;
use App\Rabbitmq\Rabbit\Client;
use App\Rabbitmq\Rabbit\MessageDispatcher;
use Illuminate\Support\ServiceProvider;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitServiceProvider extends ServiceProvider
{
    private static array $queue = [
        RabbitQueue::CREDIT_QUEUE
    ];
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, function ($app) {
            $client = new Client($app->make(AMQPStreamConnection::class));

            return $client
                ->addQueues(self::$queue)
                ->setDefaultQueue('queue-one')
                ->setColumn('name')
                ->setGuard('web') // if not provided, default guard will be used
                ->setUser('admin') // remote auth user name
                ->disableMultiQueue()
                // authentication is disabled by default
                // ->disableAuthentication()
                ->enableAuthentication()
                ->init();
        });
    }
}
