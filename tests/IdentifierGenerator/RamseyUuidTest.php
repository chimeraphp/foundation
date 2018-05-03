<?php
declare(strict_types=1);

namespace Chimera\Tests\IdentifierGenerator;

use Chimera\IdentifierGenerator\RamseyUuid;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

final class RamseyUuidTest extends TestCase
{
    /**
     * @test
     *
     * @covers \Chimera\IdentifierGenerator\RamseyUuid
     */
    public function generateShouldReturnAUuidVersion4(): void
    {
        $generator  = new RamseyUuid();
        $identifier = $generator->generate();

        self::assertInstanceOf(Uuid::class, $identifier);
        self::assertSame(4, $identifier->getVersion());
    }

    /**
     * @test
     *
     * @covers \Chimera\IdentifierGenerator\RamseyUuid
     */
    public function generateShouldAlwaysReturnANewIdentifier(): void
    {
        $generator = new RamseyUuid();

        $identifier1 = $generator->generate();
        $identifier2 = $generator->generate();

        self::assertInstanceOf(Uuid::class, $identifier1);
        self::assertInstanceOf(Uuid::class, $identifier2);

        self::assertNotEquals($identifier1, $identifier2);
        self::assertNotSame((string) $identifier1, (string) $identifier2);
    }
}
