<?php
declare(strict_types=1);

namespace Chimera\Tests\ServiceBus\ReadModelConverter;

use JsonSerializable;

final class AmazingDto implements JsonSerializable
{
    public int $id;
    public string $name;

    private function __construct(int $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    public static function fromDomain(AmazingDomainObject $object): self
    {
        return new self($object->id(), $object->name());
    }

    /** @return mixed[] */
    public function jsonSerialize(): array
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
        ];
    }
}
