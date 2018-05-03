<?php
declare(strict_types=1);

namespace Chimera\Tests\ServiceBus\ReadModelConverter;

final class AmazingDomainObject
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    public function __construct(int $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
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
