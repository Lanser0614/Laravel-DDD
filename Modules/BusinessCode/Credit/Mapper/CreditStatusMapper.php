<?php
declare(strict_types=1);

namespace Modules\BusinessCode\Credit\Mapper;

use Modules\BusinessCode\Credit\Enum\CreditStatusEnum;

class CreditStatusMapper
{

    public function isNotAllowedPaymentStatus(CreditStatusEnum $creditStatusEnum): bool
    {
        return (
            CreditStatusEnum::CLOSED === $creditStatusEnum->value
             ||
            CreditStatusEnum::DELETED === $creditStatusEnum->value
        );
    }
}
