<?php
declare(strict_types=1);

namespace Modules\BaseModule\BaseUseCase;

use Modules\BaseModule\BaseAggregate\AggregateRoot;
use Modules\BaseModule\BaseBusinessRule\Contract\BusinessRuleInterface;

abstract class AbstractUseCase
{
   abstract protected function BusinessRuleArray();

    public function apply(AggregateRoot $aggregateRoot): void
    {
        /** @var BusinessRuleInterface $rule */
        foreach ($this->BusinessRuleArray() as $rule) {
            $rule->checkRule($aggregateRoot);
        }
    }
}
