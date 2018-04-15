<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\Tests\MessageCreator;

use Lcobucci\Chimera\Input;
use Lcobucci\Chimera\MessageCreator\NamedConstructorCreator;
use PHPUnit\Framework\TestCase;
use function uniqid;

final class NamedConstructorCreatorTest extends TestCase
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
        $id    = uniqid('testing', true);
        $input = $this->createMock(Input::class);

        $input->method('getAttribute')
              ->willReturn($id);

        $creator = new NamedConstructorCreator();
        $message = $creator->create(DoStuff::class, $input);

        self::assertInstanceOf(DoStuff::class, $message);
        self::assertSame($input, $message->request);
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
        $input = $this->createMock(Input::class);

        $creator = new NamedConstructorCreator('aCustomName');
        $message = $creator->create(DoStuff::class, $input);

        self::assertInstanceOf(DoStuff::class, $message);
        self::assertSame($input, $message->request);
        self::assertSame(['testing'], $message->extra);
    }
}
