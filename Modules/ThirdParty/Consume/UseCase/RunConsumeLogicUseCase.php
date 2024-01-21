<?php
declare(strict_types=1);

namespace Modules\ThirdParty\Consume\UseCase;

use App\Rabbitmq\Contracts\Dto\AbstractDataObjectTransfer;
use Modules\ThirdParty\Consume\DTO\BaseConsumeDTO;

class RunConsumeLogicUseCase
{
    /**
     * @param BaseConsumeDTO $DTO
     * @return mixed
     */
    public function perform(BaseConsumeDTO $DTO): mixed
    {
        $methods = config('rabbit_events', []);
        $method = data_get($methods, $DTO->getEventName());
        $function_name = $method['method'];
        /** @var AbstractDataObjectTransfer $dtoClass */
        $dtoClass = new $method['dto'](
            $DTO->getPayload()
        );
        $class = app($method['class']);
        return $class->$function_name($dtoClass);
    }
}
