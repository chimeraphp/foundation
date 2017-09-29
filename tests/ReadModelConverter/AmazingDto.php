<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\Tests\ReadModelConverter;

final class AmazingDto implements \JsonSerializable
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    private function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function fromDomain(AmazingDomainObject $object): self
    {
        return new self($object->id(), $object->name());
    }

    public function jsonSerialize()
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
        ];
    }
}
