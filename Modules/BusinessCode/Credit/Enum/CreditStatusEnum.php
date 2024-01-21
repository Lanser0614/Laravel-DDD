<?php

namespace Modules\BusinessCode\Credit\Enum;

use MyCLabs\Enum\Enum;

/**
 * CreditStatusEnum enum
 *
 * @extends Enum<CreditStatusEnum::*>
 */
class CreditStatusEnum extends Enum
{
    private const  ACTIVE = 'ACTIVE';
    private const  PROBLEM = 'PROBLEM';
    private const  DELETED = 'DELETED';
    private const  CLOSED = 'CLOSED';
}
