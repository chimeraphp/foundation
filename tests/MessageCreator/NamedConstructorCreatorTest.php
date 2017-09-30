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
        $id      = uniqid();
        $request = $this->createMock(ServerRequestInterface::class);

        $request->method('getAttribute')
                ->willReturn($id);

        $creator = new NamedConstructorCreator();
        $message = $creator->create(DoStuff::class, $request);

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
        $request = $this->createMock(ServerRequestInterface::class);

        $creator = new NamedConstructorCreator('aCustomName');
        $message = $creator->create(DoStuff::class, $request);

        self::assertInstanceOf(DoStuff::class, $message);
        self::assertSame($request, $message->request);
        self::assertSame(['testing'], $message->extra);
    }
}
