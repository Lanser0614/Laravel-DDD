<?php

namespace Modules\ThirdParty\Services;

use Illuminate\Support\Facades\Log;
use Modules\ThirdParty\Services\Dto\ProductServiceObject;

class ProductService
{
    public function createCredit(ProductServiceObject $object): void
    {
        Log::info('test', $object->toArray());
    }
}
