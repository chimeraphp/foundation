<?php
declare(strict_types=1);

namespace Chimera\Tests;

use Chimera\ExecuteCommand;
use Chimera\Input;
use Chimera\MessageCreator;
use Chimera\ServiceBus;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use stdClass;

/** @coversDefaultClass \Chimera\ExecuteCommand */
final class ExecuteCommandTest extends TestCase
{
    /** @var ServiceBus&MockObject */
    private ServiceBus $bus;

    /** @var Input&MockObject */
    private Input $input;

    /** @var MessageCreator&MockObject */
    private MessageCreator $messageCreator;

    /** @before */
    public function createDependencies(): void
    {
        $this->bus            = $this->createMock(ServiceBus::class);
        $this->input          = $this->createMock(Input::class);
        $this->messageCreator = $this->createMock(MessageCreator::class);
    }

    /**
     * @test
     *
     * @covers ::__construct()
     * @covers ::getCommand()
     */
    public function getCommandShouldReturnTheNameOfTheMessageToBeExecuted(): void
    {
        $action = new ExecuteCommand($this->bus, $this->messageCreator, SampleMessage::class);

        self::assertSame(SampleMessage::class, $action->getCommand()); // @phpstan-ignore-line we'll remove this soon
    }

    /**
     * @test
     *
     * @covers ::__construct()
     * @covers ::execute()
     */
    public function executeShouldCreateTheMessageAndHandleItWithTheBus(): void
    {
        $command = new stdClass();

        $this->messageCreator->expects(self::once())
                             ->method('create')
                             ->with(SampleMessage::class, $this->input)
                             ->willReturn($command);

        $this->bus->expects(self::once())
                  ->method('handle')
                  ->with($command);

        $this->executeAction();
    }

    /**
     * @test
     *
     * @covers ::__construct()
     * @covers ::execute()
     */
    public function executeShouldNotCatchExceptionsFromBus(): void
    {
        $command   = new stdClass();
        $exception = new RuntimeException('No handler found');

        $this->messageCreator->expects(self::once())
                             ->method('create')
                             ->with(SampleMessage::class, $this->input)
                             ->willReturn($command);

        $this->bus->expects(self::once())
                  ->method('handle')
                  ->with($command)
                  ->willThrowException($exception);

        $this->expectExceptionObject($exception);
        $this->executeAction();
    }

    /**
     * @test
     *
     * @covers ::__construct()
     * @covers ::execute()
     */
    public function executeShouldNotCatchExceptionsFromMessageCreator(): void
    {
        $exception = new RuntimeException('Message creation failed');

        $this->messageCreator->expects(self::once())
                             ->method('create')
                             ->with(SampleMessage::class, $this->input)
                             ->willThrowException($exception);

        $this->bus->expects(self::never())
                  ->method('handle');

        $this->expectExceptionObject($exception);
        $this->executeAction();
    }

    private function executeAction(): void
    {
        $action = new ExecuteCommand($this->bus, $this->messageCreator, SampleMessage::class);
        $action->execute($this->input);
    }
}
