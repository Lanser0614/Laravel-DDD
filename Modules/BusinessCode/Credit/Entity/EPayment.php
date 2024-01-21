<?php
declare(strict_types=1);

namespace Modules\BusinessCode\Credit\Entity;

class EPayment
{
    public function __construct(
        private readonly ECredit $credit,
        private readonly int     $amount,
        private readonly string  $date,
        private readonly bool    $isCancelled,
        private readonly string  $cancelledAt
    ) {}

    public function getCredit(): ECredit
    {
        return $this->credit;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function isCancelled(): bool
    {
        return $this->isCancelled;
    }

    public function getCancelledAt(): string
    {
        return $this->cancelledAt;
    }
}
