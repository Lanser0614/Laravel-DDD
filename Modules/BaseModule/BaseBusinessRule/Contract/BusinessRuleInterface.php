<?php

namespace Modules\BaseModule\BaseBusinessRule\Contract;

use Modules\BaseModule\BaseAggregate\AggregateRoot;

interface BusinessRuleInterface
{
    public function checkRule(AggregateRoot $aggregateRoot);
}
