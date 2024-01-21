<?php
declare(strict_types=1);

namespace Modules\ThirdParty\Consume\DTO;

class BaseConsumeDTO
{
    public function __construct(
        private readonly string $aggregateId,
        private readonly string $eventId,
        private readonly array $payload,
        private readonly string $occurredOn,
        private readonly string $eventName,
    )
    {
    }

    public function getAggregateId(): string
    {
        return $this->aggregateId;
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function getOccurredOn(): string
    {
        return $this->occurredOn;
    }

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public static function fromArray(array $data): static
    {
        return new static(
            aggregateId: $data['aggregate_id'],
            eventId: $data['event_id'],
            payload: $data['payload'],
            occurredOn: $data['occurred_on'],
            eventName: $data['event_name'],
        );
    }
}
