<?php

namespace Modules\ThirdParty\Services\Dto;

use App\Rabbitmq\Contracts\Dto\AbstractDataObjectTransfer;

/**
 * @class ProductServiceObject
 * @property string $aggregate_id
 * @property string $event_id
 * @property array $payload
 * @property string $occurred_on
 * @property string $event_name
 */
class ProductServiceObject extends AbstractDataObjectTransfer
{
    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
       return [];
    }

    public function only(): array
    {
        return [
            'aggregate_id' =>   $this->aggregate_id,
            'event_id' =>   $this->event_id,
            'payload' =>   $this->payload,
            'occurred_on' =>   $this->occurred_on,
            'event_name' =>   $this->event_name,
        ];
    }
}
