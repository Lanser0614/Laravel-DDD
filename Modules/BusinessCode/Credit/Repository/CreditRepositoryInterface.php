<?php

namespace Modules\BusinessCode\Credit\Repository;

use Modules\BaseModule\BaseRepository\BaseRepositoryInterface;

interface CreditRepositoryInterface extends BaseRepositoryInterface
{
    public function fetchByClientId(int $clientId): BaseRepositoryInterface;
}
