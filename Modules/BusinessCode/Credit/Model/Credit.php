<?php
declare(strict_types=1);

namespace Modules\BusinessCode\Credit\Model;

use Modules\BaseModule\BaseAggregate\AggregateRoot;
use Modules\BaseModule\BaseModel\BaseModel;
use Modules\BusinessCode\Credit\Entity\ECredit;
use Modules\BusinessCode\Credit\Enum\CreditStatusEnum;

/**
 * @class ECredit
 * @property-read  string $uuid
 * @property string $contract_number
 * @property int $client_id
 * @property int $application_id
 * @property int $merchant_id
 * @property string $contract_date
 * @property null|string $closed_at
 * @property int $application_amount
 * @property int $initial_amount
 * @property int $total_amount
 * @property int $duration
 * @property int $client_commission
 * @property int $partner_discount
 * @property int $vat
 * @property string $first_payment_date
 * @property string $status_key
 */
class Credit extends BaseModel
{
    protected $table = 'credits';

    public function toEntity(): AggregateRoot
    {
        return new ECredit(
            $this->contract_number,
            $this->client_id,
            $this->application_id,
            $this->merchant_id,
            $this->contract_date,
            $this->application_amount,
            $this->initial_amount,
            $this->total_amount,
            $this->duration,
            $this->client_commission,
            $this->partner_discount,
            $this->vat,
            $this->first_payment_date,
            CreditStatusEnum::from($this->status_key),
            $this->uuid,
        );
    }
}
