<?php
declare(strict_types=1);

namespace Modules\BaseModule\EventBus;

use App\Rabbit\RabbitQueue;
use Exception;
use Illuminate\Support\Facades\Log;
use Modules\BaseModule\BaseEvent\BaseEvent;
use Modules\BaseModule\Connections\RabbitMq\RabbitConnectionSingleton;
use Modules\BaseModule\EventBus\Contract\EventBus;
use Modules\ThirdParty\Consume\DTO\BaseConsumeDTO;
use Modules\ThirdParty\Consume\UseCase\RunConsumeLogicUseCase;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQEventBus implements EventBus
{
    public function __construct(
        private readonly RunConsumeLogicUseCase $runConsumeLogicUseCase
    )
    {
    }

    /**
     * @param array $events
     * @return void
     * @throws Exception
     */
    public function publish(array $events): void
    {
        $connection = RabbitConnectionSingleton::getInstance()->getConnection();

        /** @var BaseEvent $event */
        foreach ($events as $event) {
            $this->publishMessage($connection, $event->toArray());
        }
    }

    /**
     * @throws Exception
     */
    public function consume(string $queue, string $consumerTag): void
    {
        $connection = RabbitConnectionSingleton::getInstance()->getConnection();

        $channel = $connection->channel();

        $callback = function ($msg) {
            $data = json_decode($msg->body, true);
            Log::info('callback', $data);
            $this->runConsumeLogicUseCase->perform(BaseConsumeDTO::fromArray($data));
        };

        $channel->queue_declare($queue, false, true, false, false);
        $channel->basic_consume($queue, $consumerTag, false, true, false, false, $callback);
        dump("Waiting for new message on " . $queue);
        while ($channel->is_consuming()) {
            $channel->wait();
        }
        $channel->close();
        $connection->close();
    }

    /**
     * @param AMQPStreamConnection $connection
     * @param array $event
     * @return void
     * @throws Exception
     */
    public function publishMessage(AMQPStreamConnection $connection, array $event): void
    {
        $channel = $connection->channel();
        $channel->exchange_declare(RabbitQueue::CREDIT_QUEUE_EXCHANGE, 'direct', false, true, false);
        $channel->queue_declare(RabbitQueue::CREDIT_QUEUE, false, true, false, false);
        $channel->queue_bind(RabbitQueue::CREDIT_QUEUE, RabbitQueue::CREDIT_QUEUE_EXCHANGE, RabbitQueue::CREDIT_QUEUE_ROUTE_KEY);
        $message = json_encode($event);
        $msg = new AMQPMessage($message);
        $channel->basic_publish($msg, RabbitQueue::CREDIT_QUEUE_EXCHANGE, RabbitQueue::CREDIT_QUEUE_ROUTE_KEY);
        $channel->close();
        $connection->close();
    }
}
