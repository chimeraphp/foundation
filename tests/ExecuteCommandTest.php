<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\Tests;

use Lcobucci\Chimera\ExecuteCommand;
use Lcobucci\Chimera\Input;
use Lcobucci\Chimera\MessageCreator;
use Lcobucci\Chimera\ServiceBus;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use stdClass;

/**
 * @coversDefaultClass \Lcobucci\Chimera\ExecuteCommand
 */
final class ExecuteCommandTest extends TestCase
{
    /**
     * @var ServiceBus|MockObject
     */
    private $bus;

    /**
     * @var Input|MockObject
     */
    private $input;

    /**
     * @var MessageCreator|MockObject
     */
    private $messageCreator;

    /**
     * @before
     */
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
        $action = new ExecuteCommand($this->bus, $this->messageCreator, 'test');

        self::assertSame('test', $action->getCommand());
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
                             ->with('test', $this->input)
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
                             ->with('test', $this->input)
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
                             ->with('test', $this->input)
                             ->willThrowException($exception);

        $this->bus->expects(self::never())
                  ->method('handle');

        $this->expectExceptionObject($exception);
        $this->executeAction();
    }

    private function executeAction(): void
    {
        $action = new ExecuteCommand($this->bus, $this->messageCreator, 'test');
        $action->execute($this->input);
    }
}
