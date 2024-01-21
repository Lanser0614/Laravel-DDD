<?php
declare(strict_types=1);

namespace Modules\BaseModule\Exceptions;


use Exception;

class BusinessException extends Exception
{
    protected $code = 500;
}
