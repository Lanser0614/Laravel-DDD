<?php
declare(strict_types=1);

namespace Modules\BusinessCode\Credit\BusinessRule\Payment;

use Modules\BaseModule\BaseBusinessRule\BaseBusinessRule;
use Modules\BaseModule\BaseBusinessRule\Contract\BusinessRuleInterface;
use Modules\BaseModule\Exceptions\BusinessException;
use Modules\BusinessCode\Credit\Entity\ECredit;
use Modules\BusinessCode\Credit\Mapper\CreditStatusMapper;

class AllowedForPaymentRule extends BaseBusinessRule implements BusinessRuleInterface
{
    /**
     * @param ECredit $credit
     * @return void
     * @throws BusinessException
     */
    public function checkRule(ECredit $credit): void
    {
        $this->balanceIsZero($credit)
            ->checkCreditStatus($credit);
    }

    /**
     * @param ECredit $credit
     * @return AllowedForPaymentRule
     * @throws BusinessException
     */
    private function balanceIsZero(ECredit $credit): static
    {
        if ($credit->getPayments()->sum('amount') === $credit->getTotalAmount()) {
            throw new BusinessException("balanceIsZero");
        }
        return $this;
    }

    /**
     * @param ECredit $credit
     * @return AllowedForPaymentRule
     * @throws BusinessException
     */
    private function checkCreditStatus(ECredit $credit): static
    {
        $statusMapper = app(CreditStatusMapper::class);
        if ($statusMapper->isNotAllowedPaymentStatus($credit->getStatusKey())) {
            throw new BusinessException("isNotAllowedPaymentStatus");
        };
        return $this;
    }




}
