<?php
declare(strict_types=1);

namespace Modules\BaseModule\BaseEvent;

use DateTimeImmutable;
use Modules\BaseModule\BaseUtils\SimpleUuid;
use Modules\BaseModule\BaseUtils\Utils;

abstract class BaseEvent
{
    private readonly string $eventId;
    private readonly string $occurredOn;

    public function __construct(private readonly string $aggregateId, string $eventId = null, string $occurredOn = null)
    {
        $this->eventId = $eventId ?: SimpleUuid::random()->value();
        $this->occurredOn = $occurredOn ?: Utils::dateToString(new DateTimeImmutable());
    }

    abstract public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): self;

    abstract public static function eventName(): string;

    abstract public function toPrimitives(): array;

    final public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    final public function eventId(): string
    {
        return $this->eventId;
    }

    final public function occurredOn(): string
    {
        return $this->occurredOn;
    }

    public function toArray(): array
    {
        return [
         'aggregate_id' =>   $this->aggregateId(),
         'event_id' =>   $this->eventId(),
         'payload' =>   $this->toPrimitives(),
         'occurred_on' =>   $this->occurredOn(),
         'event_name' =>   static::eventName(),
        ];
    }
}
