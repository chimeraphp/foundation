<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\Tests\ServiceBus\ReadModelConverter;

use Lcobucci\Chimera\ServiceBus\ReadModelConverter\Callback;
use PHPUnit\Framework\TestCase;

final class CallbackTest extends TestCase
{
    /**
     * @test
     *
     * @covers \Lcobucci\Chimera\ServiceBus\ReadModelConverter\Callback
     *
     * @uses \Lcobucci\Chimera\Tests\ServiceBus\ReadModelConverter\AmazingDomainObject
     * @uses \Lcobucci\Chimera\Tests\ServiceBus\ReadModelConverter\FetchStuff
     */
    public function convertShouldNotChangeResultIfMessageIsNotAQuery(): void
    {
        $converter = new Callback();
        $domainObj = new AmazingDomainObject(1, 'Test');

        /** @var AmazingDomainObject $result */
        $result = $converter->convert(new FetchStuff(1), $domainObj);

        self::assertSame($domainObj, $result);
    }

    /**
     * @test
     *
     * @covers \Lcobucci\Chimera\ServiceBus\ReadModelConverter\Callback
     *
     * @uses \Lcobucci\Chimera\Tests\ServiceBus\ReadModelConverter\AmazingDomainObject
     * @uses \Lcobucci\Chimera\Tests\ServiceBus\ReadModelConverter\AmazingDto
     * @uses \Lcobucci\Chimera\Tests\ServiceBus\ReadModelConverter\AmazingFetchStuff
     */
    public function convertShouldUseTheQueryCallbackToCreateASingleReadModel(): void
    {
        $converter = new Callback();
        $domainObj = new AmazingDomainObject(1, 'Test');

        $result = $converter->convert(new AmazingFetchStuff(1), $domainObj);

        self::assertInstanceOf(AmazingDto::class, $result);
        self::assertSame($domainObj->id(), $result->id);
        self::assertSame($domainObj->name(), $result->name);
    }

    /**
     * @test
     *
     * @covers \Lcobucci\Chimera\ServiceBus\ReadModelConverter\Callback
     *
     * @uses \Lcobucci\Chimera\Tests\ServiceBus\ReadModelConverter\AmazingDomainObject
     * @uses \Lcobucci\Chimera\Tests\ServiceBus\ReadModelConverter\AmazingDto
     * @uses \Lcobucci\Chimera\Tests\ServiceBus\ReadModelConverter\AmazingFetchStuff
     */
    public function convertShouldUseTheQueryCallbackToCreateMultipleReadModels(): void
    {
        $converter = new Callback();
        $domainObj = new AmazingDomainObject(1, 'Test');

        $result = $converter->convert(new AmazingFetchStuff(1), [$domainObj]);

        self::assertInternalType('array', $result);
        self::assertContainsOnlyInstancesOf(AmazingDto::class, $result);
        self::assertCount(1, $result);
    }
}
