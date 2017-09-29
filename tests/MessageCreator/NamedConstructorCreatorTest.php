<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\Tests\MessageCreator;

use Lcobucci\Chimera\MessageCreator\NamedConstructorCreator;
use Psr\Http\Message\ServerRequestInterface;

final class NamedConstructorCreatorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     *
     * @covers \Lcobucci\Chimera\MessageCreator\NamedConstructorCreator
     *
     * @uses \Lcobucci\Chimera\Tests\MessageCreator\DoStuff
     */
    public function createShouldUseDefaultCallbackToCreateTheMessageWhenNothingIsProvided(): void
    {
        $creator = new NamedConstructorCreator();
        $request = $this->createMock(ServerRequestInterface::class);

        $message = $creator->create(DoStuff::class, $request);

        self::assertInstanceOf(DoStuff::class, $message);
        self::assertSame($request, $message->request);
        self::assertSame([], $message->extra);
    }

    /**
     * @test
     *
     * @covers \Lcobucci\Chimera\MessageCreator\NamedConstructorCreator
     *
     * @uses \Lcobucci\Chimera\Tests\MessageCreator\DoStuff
     */
    public function createShouldSendAnyExtraArgumentsToConstructor(): void
    {
        $creator = new NamedConstructorCreator();
        $request = $this->createMock(ServerRequestInterface::class);
        $id      = uniqid();

        $message = $creator->create(DoStuff::class, $request, $id);

        self::assertInstanceOf(DoStuff::class, $message);
        self::assertSame($request, $message->request);
        self::assertSame([$id], $message->extra);
    }

    /**
     * @test
     *
     * @covers \Lcobucci\Chimera\MessageCreator\NamedConstructorCreator
     *
     * @uses \Lcobucci\Chimera\Tests\MessageCreator\DoStuff
     */
    public function createShouldUseACustomisedConstructorWhenItWasConfigured(): void
    {
        $creator = new NamedConstructorCreator('aCustomName');
        $request = $this->createMock(ServerRequestInterface::class);

        $message = $creator->create(DoStuff::class, $request);

        self::assertInstanceOf(DoStuff::class, $message);
        self::assertSame($request, $message->request);
        self::assertSame(['testing'], $message->extra);
    }
}
