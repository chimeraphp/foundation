<?php
declare(strict_types=1);

namespace Chimera\Tests\ServiceBus\ReadModelConverter;

use Chimera\ServiceBus\ReadModelConverter\Callback;
use PHPUnit\Framework\Attributes as PHPUnit;
use PHPUnit\Framework\TestCase;

use function assert;

#[PHPUnit\CoversClass(Callback::class)]
#[PHPUnit\UsesClass(AmazingDomainObject::class)]
#[PHPUnit\UsesClass(AmazingDto::class)]
#[PHPUnit\UsesClass(AmazingFetchStuff::class)]
final class CallbackTest extends TestCase
{
    #[PHPUnit\Test]
    public function convertShouldNotChangeResultIfMessageIsNotAQuery(): void
    {
        $converter = new Callback();
        $domainObj = new AmazingDomainObject(1, 'Test');

        $result = $converter->convert(new FetchStuff(1), $domainObj);
        assert($result instanceof AmazingDomainObject);

        self::assertSame($domainObj, $result);
    }

    #[PHPUnit\Test]
    public function convertShouldUseTheQueryCallbackToCreateASingleReadModel(): void
    {
        $converter = new Callback();
        $domainObj = new AmazingDomainObject(1, 'Test');

        $result = $converter->convert(new AmazingFetchStuff(1), $domainObj);

        self::assertInstanceOf(AmazingDto::class, $result);
        self::assertSame($domainObj->id(), $result->id);
        self::assertSame($domainObj->name(), $result->name);
    }

    #[PHPUnit\Test]
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
