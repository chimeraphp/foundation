<?php
declare(strict_types=1);

namespace Chimera\Tests\ServiceBus\ReadModelConverter;

use Chimera\ServiceBus\ReadModelConverter\Callback;
use PHPUnit\Framework\TestCase;

use function assert;

/**
 * @covers \Chimera\ServiceBus\ReadModelConverter\Callback
 *
 * @uses \Chimera\Tests\ServiceBus\ReadModelConverter\AmazingDomainObject
 * @uses \Chimera\Tests\ServiceBus\ReadModelConverter\AmazingDto
 * @uses \Chimera\Tests\ServiceBus\ReadModelConverter\AmazingFetchStuff
 */
final class CallbackTest extends TestCase
{
    /** @test */
    public function convertShouldNotChangeResultIfMessageIsNotAQuery(): void
    {
        $converter = new Callback();
        $domainObj = new AmazingDomainObject(1, 'Test');

        $result = $converter->convert(new FetchStuff(1), $domainObj);
        assert($result instanceof AmazingDomainObject);

        self::assertSame($domainObj, $result);
    }

    /** @test */
    public function convertShouldUseTheQueryCallbackToCreateASingleReadModel(): void
    {
        $converter = new Callback();
        $domainObj = new AmazingDomainObject(1, 'Test');

        $result = $converter->convert(new AmazingFetchStuff(1), $domainObj);

        self::assertInstanceOf(AmazingDto::class, $result);
        self::assertSame($domainObj->id(), $result->id);
        self::assertSame($domainObj->name(), $result->name);
    }

    /** @test */
    public function convertShouldUseTheQueryCallbackToCreateMultipleReadModels(): void
    {
        $converter = new Callback();
        $domainObj = new AmazingDomainObject(1, 'Test');

        $result = $converter->convert(new AmazingFetchStuff(1), [$domainObj]);

        self::assertIsArray($result);
        self::assertContainsOnlyInstancesOf(AmazingDto::class, $result);
        self::assertCount(1, $result);
    }
}
