<?php
declare(strict_types=1);

namespace Modules\BusinessCode\Credit\Creator;

use Modules\BaseModule\BaseRepository\BaseRepositoryInterface;
use Modules\BaseModule\EventBus\Contract\EventBus;
use Modules\BusinessCode\Credit\Entity\ECredit;
use Modules\BusinessCode\Credit\Model\Credit;

final class CreditCreator
{
    private ?BaseRepositoryInterface $repository = null;
    public function __construct(
        private readonly BaseRepositoryInterface $baseRepository,
        private readonly EventBus $eventBus
    )
    {
        $this->repository = $this->baseRepository->setModel(Credit::query());
    }


    public function __invoke(ECredit $credit): void
    {
        $this->repository->save($credit);
        $this->eventBus->publish($credit->pullDomainEvents());
    }
}
