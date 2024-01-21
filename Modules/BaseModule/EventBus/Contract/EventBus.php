<?php

namespace Modules\BaseModule\EventBus\Contract;

use Modules\BaseModule\BaseEvent\BaseEvent;

interface EventBus
{
    public function publish(array $events): void;

    public function consume(string $queue, string $consumerTag);
}
