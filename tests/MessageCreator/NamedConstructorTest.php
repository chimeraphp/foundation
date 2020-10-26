<?php
declare(strict_types=1);

namespace Chimera\Tests\MessageCreator;

use Chimera\Input;
use Chimera\MessageCreator\MessageCannotBeCreated;
use Chimera\MessageCreator\NamedConstructor;
use PHPUnit\Framework\TestCase;

use function uniqid;

/**
 * @covers \Chimera\MessageCreator\NamedConstructor
 * @covers \Chimera\MessageCreator\MessageCannotBeCreated
 *
 * @uses \Chimera\Tests\MessageCreator\DoStuff
 */
final class NamedConstructorTest extends TestCase
{
    /** @test */
    public function createShouldUseDefaultCallbackToCreateTheMessageWhenNothingIsProvided(): void
    {
        $id    = uniqid('testing', true);
        $input = $this->createMock(Input::class);

        $input->method('getAttribute')
              ->willReturn($id);

        $creator = new NamedConstructor();
        $message = $creator->create(DoStuff::class, $input);

        self::assertSame($input, $message->request);
        self::assertSame([$id], $message->extra);
    }

    /** @test */
    public function createShouldUseACustomisedConstructorWhenItWasConfigured(): void
    {
        $input = $this->createMock(Input::class);

        $creator = new NamedConstructor('aCustomName');
        $message = $creator->create(DoStuff::class, $input);

        self::assertSame($input, $message->request);
        self::assertSame(['testing'], $message->extra);
    }

    /** @test */
    public function createShouldRaiseExceptionWhenNamedConstructorDoesNotExist(): void
    {
        $creator = new NamedConstructor('nonExistingMethod');

        $this->expectException(MessageCannotBeCreated::class);
        $this->expectExceptionMessage(
            'The "Chimera\Tests\MessageCreator\DoStuff::nonExistingMethod" callback is invalid'
        );

        $creator->create(DoStuff::class, $this->createMock(Input::class));
    }
}
