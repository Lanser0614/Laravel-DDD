<?php
declare(strict_types=1);

namespace Modules\BaseModule\BaseUtils\Uuid;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Stringable;

class BaseUuid implements Stringable
{

    /**
     * @param string $value
     */
    final public function __construct(protected string $value)
    {
        $this->ensureIsValidUuid($value);
    }

    /**
     * @return self
     */
    final public static function random(): self
    {
        return new static(Uuid::uuid4()->toString());
    }

    /**
     * @return string
     */
    final public function value(): string
    {
        return $this->value;
    }

    /**
     * @param BaseUuid $other
     * @return bool
     */
    final public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }

    public function __toString(): string
    {
        return $this->value();
    }

    /**
     * @param string $id
     * @return void
     */
    private function ensureIsValidUuid(string $id): void
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', self::class, $id));
        }
    }
}
