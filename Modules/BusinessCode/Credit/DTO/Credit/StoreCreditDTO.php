<?php
declare(strict_types=1);

namespace Modules\BusinessCode\Credit\DTO\Credit;

use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Data;

class StoreCreditDTO extends Data
{
    public function __construct(
        #[IntegerType]
        private readonly int $client_id,
        #[IntegerType]
        private readonly int $application_id,
        #[IntegerType]
        private readonly int $merchant_id,
        #[IntegerType]
        private readonly int $application_amount,
        #[IntegerType]
        private readonly int $initial_amount,
        #[IntegerType]
        private readonly int $duration,
        #[IntegerType]
        private readonly int $client_commission,
        #[IntegerType]
        private readonly int $partner_discount,
        #[IntegerType]
        private readonly int $vat,
        #[DateFormat('Y-m-d')]
        private readonly ?string $first_payment_date,
    )
    {
    }

    public static function fromArray(array $data): static
    {
        return new static(
            client_id: $data['client_id'],
            application_id: $data['application_id'],
            merchant_id: $data['merchant_id'],
            application_amount: $data['application_amount'],
            initial_amount: $data['initial_amount'],
            duration: $data['duration'],
            client_commission: $data['client_commission'],
            partner_discount: $data['partner_discount'],
            vat: $data['vat'],
            first_payment_date: $data['first_payment_date'],
        );
    }

    public function getClientId(): int
    {
        return $this->client_id;
    }

    public function getApplicationId(): int
    {
        return $this->application_id;
    }

    public function getMerchantId(): int
    {
        return $this->merchant_id;
    }

    public function getApplicationAmount(): int
    {
        return $this->application_amount;
    }

    public function getInitialAmount(): int
    {
        return $this->initial_amount;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getClientCommission(): int
    {
        return $this->client_commission;
    }

    public function getPartnerDiscount(): int
    {
        return $this->partner_discount;
    }

    public function getVat(): int
    {
        return $this->vat;
    }

    public function getFirstPaymentDate(): ?string
    {
        return $this->first_payment_date;
    }
}
