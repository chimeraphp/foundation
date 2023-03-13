<?php
declare(strict_types=1);

namespace Chimera\Tests\IdentifierGenerator;

use Chimera\IdentifierGenerator\RamseyUuid;
use PHPUnit\Framework\Attributes as PHPUnit;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Lazy\LazyUuidFromString;

#[PHPUnit\CoversClass(RamseyUuid::class)]
final class RamseyUuidTest extends TestCase
{
    #[PHPUnit\Test]
    public function generateShouldReturnAUuidVersion4(): void
    {
        $generator  = new RamseyUuid();
        $identifier = $generator->generate();

        self::assertInstanceOf(LazyUuidFromString::class, $identifier);
    }

    #[PHPUnit\Test]
    public function generateShouldAlwaysReturnANewIdentifier(): void
    {
        $generator = new RamseyUuid();

        $identifier1 = $generator->generate();
        $identifier2 = $generator->generate();

        self::assertInstanceOf(LazyUuidFromString::class, $identifier1);
        self::assertInstanceOf(LazyUuidFromString::class, $identifier2);

        self::assertNotEquals($identifier1, $identifier2);
        self::assertNotSame((string) $identifier1, (string) $identifier2);
    }
}
