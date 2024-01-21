<?php
declare(strict_types=1);

namespace Modules\UI\Http\RequestValidation\ApiGateway;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreditRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'client_id' => ['required', 'integer'],
            'application_id' => ['required', 'integer'],
            'merchant_id' => ['required', 'integer'],
            'application_amount' => ['required', 'integer'],
            'initial_amount' => ['required', 'integer'],
            'duration' => ['required', 'integer'],
            'client_commission' => ['required', 'integer'],
            'partner_discount' => ['required', 'integer'],
            'vat' => ['required', 'integer'],
            'first_payment_date' => ['nullable', 'string'],
        ];
    }
}
