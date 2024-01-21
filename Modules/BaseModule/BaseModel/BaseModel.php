<?php
declare(strict_types=1);

namespace Modules\BaseModule\BaseModel;

use Illuminate\Database\Eloquent\Model;
use Modules\BaseModule\BaseAggregate\AggregateRoot;

abstract class BaseModel extends Model
{
    protected $keyType = 'string';

    public abstract function toEntity(): AggregateRoot;
}
