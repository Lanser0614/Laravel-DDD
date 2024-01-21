<?php
declare(strict_types=1);

namespace Modules\BusinessCode\Credit\Event;

use Modules\BaseModule\BaseEvent\BaseEvent;

class CreditCreatedEvent extends BaseEvent
{
    public function __construct(
        string $uuid,
        private readonly string $contractNumber,
        private readonly int $totalAmount,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($uuid, $eventId, $occurredOn);
    }

    public function getContractNumber(): string
    {
        return $this->contractNumber;
    }

    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): BaseEvent
    {
        return new self($aggregateId, $body['contract_number'], $body['total_amount'], $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'credit.created';
    }

    public function toPrimitives(): array
    {
        return [
            'contract_number' => $this->contractNumber,
            'total_amount' => $this->totalAmount,
        ];
    }
}
