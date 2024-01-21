<?php
declare(strict_types=1);

namespace Modules\BaseModule\EventBus;

use App\Rabbit\RabbitQueue;
use App\Rabbitmq\Rabbit\Client;
use Exception;
use Modules\BaseModule\BaseEvent\BaseEvent;
use Modules\BaseModule\EventBus\Contract\EventBus;

class RabbitMqEventBus implements EventBus
{
    /**
     * @param BaseEvent ...$events
     * @throws Exception
     */
    public function publish(array $events): void
    {
        foreach ($events as $event) {
            /** @var Client $client */
            $client = app(Client::class);
            $client->setMessage([
                'method' => $event::eventName(),
                'params' => $event->toArray()
            ])->publish(RabbitQueue::CREDIT_QUEUE);
        }
    }
}
