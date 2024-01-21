<?php
declare(strict_types=1);

namespace Modules\BusinessCode\Credit\Repository;

use Modules\BaseModule\BaseRepository\BaseRepository;
use Modules\BaseModule\BaseRepository\BaseRepositoryInterface;

class CreditRepository extends BaseRepository implements CreditRepositoryInterface
{
    public function fetchByClientId(int $clientId): BaseRepositoryInterface
    {
         $this->model->where('client_id', '=', $clientId);
         return $this;
    }
}
