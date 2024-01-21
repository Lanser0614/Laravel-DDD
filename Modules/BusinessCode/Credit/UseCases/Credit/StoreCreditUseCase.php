<?php
declare(strict_types=1);

namespace Modules\BusinessCode\Credit\UseCases\Credit;

use Modules\BaseModule\BaseRepository\BaseRepositoryInterface;
use Modules\BaseModule\BaseUseCase\AbstractUseCase;
use Modules\BusinessCode\Credit\Creator\CreditCreator;
use Modules\BusinessCode\Credit\DTO\Credit\StoreCreditDTO;
use Modules\BusinessCode\Credit\Entity\ECredit;
use Modules\BusinessCode\Credit\Enum\CreditStatusEnum;
use Modules\BusinessCode\Credit\Model\Credit;
use Modules\BusinessCode\Credit\Repository\CreditRepositoryInterface;

class StoreCreditUseCase extends AbstractUseCase
{
    private ?BaseRepositoryInterface $repository = null;
    public function __construct(
        private readonly CreditCreator             $creditCreator,
        private readonly CreditRepositoryInterface $baseRepository
    )
    {
        $this->repository = $this->baseRepository->setModel(Credit::query());
    }

    public function perform(StoreCreditDTO $storeCreditDTO): void
    {
        $credits = $this->repository
            ->fetchByClientId($storeCreditDTO->getClientId())
            ->getEntityList();

        $contractNumber = $storeCreditDTO->getClientId() . '-' . count($credits) + 1;
        $totalAmount =  intval(round($storeCreditDTO->getApplicationAmount() * ( 1 + ($storeCreditDTO->getClientCommission() / 100))));

      $credit =  ECredit::create(
            $contractNumber,
            $storeCreditDTO->getClientId(),
            $storeCreditDTO->getApplicationId(),
            $storeCreditDTO->getMerchantId(),
            now()->format('Y-m-d'),
            $storeCreditDTO->getApplicationAmount(),
            $storeCreditDTO->getApplicationAmount(),
            $totalAmount,
            $storeCreditDTO->getDuration(),
            $storeCreditDTO->getClientCommission(),
            $storeCreditDTO->getPartnerDiscount(),
            $storeCreditDTO->getVat(),
            $storeCreditDTO->getFirstPaymentDate() ?? now()->format('Y-m-d'),
            CreditStatusEnum::from('ACTIVE')
        );

      $this->creditCreator->__invoke($credit);
    }

    protected function BusinessRuleArray(): array
    {
        return [];
    }
}
