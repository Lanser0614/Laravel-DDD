<?php
declare(strict_types=1);

namespace Modules\BusinessCode\Credit\ValueObject\Schedule;


use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;

final class InitialSchedule extends Data
{
    /**
     * @param string $uuid
     * @param string $date
     * @param string $paymentDate
     * @param int $baseAmount
     * @param bool $isPaid
     * @param int $amount
     * @param int $balanceAfter
     */
    public function __construct(
        #[Uuid]
        private readonly string $uuid,
        #[DateFormat('Y-m-d')]
        private readonly string $date,
        #[DateFormat('Y-m-d')]
        private readonly string $paymentDate,
        #[IntegerType]
        private readonly int $baseAmount,
        #[BooleanType]
        private readonly bool $isPaid,
        #[IntegerType]
        private readonly int $amount,
        #[IntegerType]
        private readonly int $balanceAfter,
    )
    {
    }

    public function getBalanceAfter(): int
    {
        return $this->balanceAfter;
    }

    public function getPaymentDate(): string
    {
        return $this->paymentDate;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getBaseAmount(): int
    {
        return $this->baseAmount;
    }

    public function isPaid(): bool
    {
        return $this->isPaid;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        return new static(
            uuid: $data['uuid'],
            date: $data['date'],
            paymentDate: $data['payment_date'],
            baseAmount: $data['base_amount'],
            isPaid: $data['is_paid'],
            amount: $data['amount'],
            balanceAfter: $data['balance_after'],
        );
    }
}
