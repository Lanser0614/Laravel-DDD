<?php
declare(strict_types=1);

namespace App\Rabbit;

class RabbitQueue
{
    const CREDIT_QUEUE = 'credit-stream';
    const CREDIT_QUEUE_EXCHANGE = '/';
    const CREDIT_QUEUE_ROUTE_KEY = 'credit_key';
}
