<?php
declare(strict_types=1);

namespace Modules\UI\Http\Controllers\Api\ApiGateway;


use Illuminate\Http\JsonResponse;
use Modules\BusinessCode\Credit\DTO\Credit\StoreCreditDTO;
use Modules\BusinessCode\Credit\UseCases\Credit\StoreCreditUseCase;
use Modules\UI\Http\Controllers\Api\BaseApiController;
use Modules\UI\Http\RequestValidation\ApiGateway\StoreCreditRequest;

class CreditController extends BaseApiController
{
    public function __construct(
        private readonly StoreCreditUseCase $storeCreditUseCase
    )
    {
    }

    public function store(StoreCreditRequest $request)
    {
        $dto = StoreCreditDTO::fromArray($request->validated());
        $this->storeCreditUseCase->perform($dto);
        return new JsonResponse();
    }
}
