<?php
declare(strict_types=1);

namespace Modules\BaseModule\Connections\RabbitMq;

use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitConnectionSingleton
{
    private static $instance;

    private ?AMQPStreamConnection $connection = null;

    public function getConnection(): AMQPStreamConnection
    {
        return $this->connection;
    }

    /**
     * @throws Exception
     */
    private function __construct()
    {
        $this->connection = new AMQPStreamConnection(
            config('amqp.host'),
            config('amqp.port'),
            config('amqp.username'),
            config('amqp.password'),
            config('amqp.vhost')
        );
    }

    public static function getInstance(): RabbitConnectionSingleton
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
