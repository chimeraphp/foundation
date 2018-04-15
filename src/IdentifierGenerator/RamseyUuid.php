<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\IdentifierGenerator;

use Lcobucci\Chimera\IdentifierGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * ID generation strategy which uses UUIDs (v4)
 */
final class RamseyUuid implements IdentifierGenerator
{
    /**
     * {@inheritdoc}
     */
    public function generate(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
