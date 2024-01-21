<?php
declare(strict_types=1);

namespace Modules\BaseModule\RegisterInterfaceRealisation;

use Modules\BaseModule\BaseRepository\BaseRepository;
use Modules\BaseModule\BaseRepository\BaseRepositoryInterface;
use Modules\BaseModule\EventBus\Contract\EventBus;
use Modules\BaseModule\EventBus\RabbitMqEventBus;
use Modules\BusinessCode\Credit\Repository\CreditRepository;
use Modules\BusinessCode\Credit\Repository\CreditRepositoryInterface;

abstract class RegisterInterfaceRealisation
{
    public static array $binds = [
        BaseRepositoryInterface::class => BaseRepository::class,
        CreditRepositoryInterface::class => CreditRepository::class,
        EventBus::class => RabbitMqEventBus::class
    ];
}
