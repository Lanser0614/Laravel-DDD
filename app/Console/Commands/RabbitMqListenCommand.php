<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Rabbit\RabbitQueue;
use App\Rabbitmq\Rabbit\Client;
use Illuminate\Console\Command;
use JetBrains\PhpStorm\NoReturn;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMqListenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit-mq:listen-credit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for consume credit strem queue';

    /**
     * Execute the console command.
     */
   public function handle()
    {
        /** @var Client $client */
        $client = app(Client::class);
        $client->consume(RabbitQueue::CREDIT_QUEUE, function (AMQPMessage $message) {
            /**
             * Acknowledge a message
             */
            $message->ack(true);

            /**
             * @var Client $this
             */
            $this->dispatchEvents($message);
        })->enableMultiQueue()->wait(); // or waitForever();
    }
}
