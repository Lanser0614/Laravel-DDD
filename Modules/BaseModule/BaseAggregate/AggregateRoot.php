<?php
declare(strict_types=1);

namespace Modules\BaseModule\BaseAggregate;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use JsonSerializable;
use Modules\BaseModule\BaseModel\BaseModel;
use Modules\BaseModule\BaseEvent\BaseEvent;

abstract class AggregateRoot implements JsonSerializable
{
    private array $domainEvents = [];

    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    final protected function record(BaseEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }


    public abstract function getUuid(): string;


}
