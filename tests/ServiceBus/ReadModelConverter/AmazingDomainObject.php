<?php
declare(strict_types=1);

namespace Chimera\Tests\ServiceBus\ReadModelConverter;

final class AmazingDomainObject
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
