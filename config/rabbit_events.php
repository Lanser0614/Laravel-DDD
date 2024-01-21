<?php


use Modules\ThirdParty\Services\Dto\ProductServiceObject;
use Modules\ThirdParty\Services\ProductService;

return [
    'credit' => [
        'created' => [
            'class' => ProductService::class,
            'method' => 'createCredit',
            'dto' => ProductServiceObject::class
        ]
    ]
];
