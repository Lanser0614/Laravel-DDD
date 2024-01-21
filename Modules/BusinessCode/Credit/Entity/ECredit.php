<?php
declare(strict_types=1);

namespace Modules\BusinessCode\Credit\Entity;

use Illuminate\Support\Collection;
use Modules\BaseModule\BaseAggregate\AggregateRoot;
use Modules\BaseModule\BaseUtils\SimpleUuid;
use Modules\BusinessCode\Credit\Enum\CreditStatusEnum;
use Modules\BusinessCode\Credit\Event\CreditCreatedEvent;
use Modules\BusinessCode\Credit\Event\CreditUpdatedEvent;
use Modules\BusinessCode\Credit\Model\Credit;

class ECredit extends AggregateRoot
{


    public ?int $id = null;
    private bool $haveDownPayment = false;
    private int $prePayment = 0;
    private bool $avoidWeekends = true;

    /**
     * @var Collection<EPayment>|null
     */
    public ?Collection $payments = null;

    public function getPayments(): ?Collection
    {
        return $this->payments;
    }
    public ?string $closedAt = null;


    public function __construct(
        private readonly string $contractNumber,
        private readonly int    $clientId,
        private readonly int    $applicationId,
        private readonly int    $merchantId,
        private readonly string $contractDate,
        private readonly int    $applicationAmount,
        private readonly int    $initialAmount,
        private readonly int    $totalAmount,
        private readonly int    $duration,
        private readonly int    $clientCommission,
        private readonly int    $partnerDiscount,
        private readonly int    $vat,
        private readonly string $firstPaymentDate,
        private readonly CreditStatusEnum $statusKey,
        private readonly ?string $uuid,
    )
    {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function isAvoidWeekends(): bool
    {
        return $this->avoidWeekends;
    }

    public function getClientCommission(): int
    {
        return $this->clientCommission;
    }

    public function getPartnerDiscount(): int
    {
        return $this->partnerDiscount;
    }

    public function getVat(): int
    {
        return $this->vat;
    }

    public function getFirstPaymentDate(): string
    {
        return $this->firstPaymentDate;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatusKey(): CreditStatusEnum
    {
        return $this->statusKey;
    }

    public function isHaveDownPayment(): bool
    {
        return $this->haveDownPayment;
    }

    public function getPrePayment(): int
    {
        return $this->prePayment;
    }

    public function getContractNumber(): string
    {
        return $this->contractNumber;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getApplicationId(): int
    {
        return $this->applicationId;
    }

    public function getMerchantId(): int
    {
        return $this->merchantId;
    }

    public function getContractDate(): string
    {
        return $this->contractDate;
    }

    public function getClosedAt(): string
    {
        return $this->closedAt;
    }

    public function getApplicationAmount(): int
    {
        return $this->applicationAmount;
    }

    public function getInitialAmount(): int
    {
        return $this->initialAmount;
    }

    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }


    /**
     * @param string $contract_number
     * @param int $clientId
     * @param int $applicationId
     * @param int $merchantId
     * @param string $contractDate
     * @param int $applicationAmount
     * @param int $initialAmount
     * @param int $totalAmount
     * @param int $duration
     * @param int $clientCommission
     * @param int $partnerDiscount
     * @param int $vat
     * @param string $firstPaymentDate
     * @param CreditStatusEnum $statusKey
     * @return ECredit
     */
    public static function create(
        string $contract_number,
        int    $clientId,
        int    $applicationId,
        int    $merchantId,
        string $contractDate,
        int    $applicationAmount,
        int    $initialAmount,
        int    $totalAmount,
        int    $duration,
        int    $clientCommission,
        int    $partnerDiscount,
        int    $vat,
        string $firstPaymentDate,
        CreditStatusEnum $statusKey,
    ): ECredit
    {
        $uuid = SimpleUuid::random()->value();
        $credit = new self(
            $contract_number,
            $clientId,
            $applicationId,
            $merchantId,
            $contractDate,
            $applicationAmount,
            $initialAmount,
            $totalAmount,
            $duration,
            $clientCommission,
            $partnerDiscount,
            $vat,
            $firstPaymentDate,
            $statusKey,
            $uuid
        );

        $credit->record(
            new CreditCreatedEvent($credit->getUuid(), $credit->getContractNumber(), $credit->getTotalAmount())
        );

        return $credit;
    }


    public static function update(self $credit): ECredit
    {
        $credit->record(
            new CreditUpdatedEvent($credit->getUuid(), $credit->contractNumber, $credit->totalAmount)
        );

        return $credit;
    }


    public function jsonSerialize(): array
    {
        return [
            'uuid' => $this->uuid,
            'contract_number' => $this->contractNumber,
            'client_id' => $this->clientId,
            'application_id' => $this->applicationId,
            'merchant_id' => $this->merchantId,
            'contract_date' => $this->contractDate,
            'closed_at' => $this->closedAt,
            'application_amount' => $this->applicationAmount,
            'initial_amount' => $this->initialAmount,
            'total_amount' => $this->totalAmount,
            'duration' => $this->duration,
            'client_commission' => $this->clientCommission,
            'partner_discount' => $this->partnerDiscount,
            'vat' => $this->vat,
            'first_payment_date' => $this->firstPaymentDate,
            'status_key' => $this->statusKey->getValue(),
        ];
    }
}
