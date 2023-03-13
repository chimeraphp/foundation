<?php
declare(strict_types=1);

namespace Chimera\Tests;

use Chimera\ExecuteQuery;
use Chimera\Input;
use Chimera\MessageCreator;
use Chimera\ServiceBus;
use PHPUnit\Framework\Attributes as PHPUnit;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use stdClass;

#[PHPUnit\CoversClass(ExecuteQuery::class)]
final class ExecuteQueryTest extends TestCase
{
    private ServiceBus&MockObject $bus;
    private Input&MockObject $input;
    private MessageCreator&MockObject $messageCreator;

    #[PHPUnit\Before]
    public function createDependencies(): void
    {
        $this->bus            = $this->createMock(ServiceBus::class);
        $this->input          = $this->createMock(Input::class);
        $this->messageCreator = $this->createMock(MessageCreator::class);
    }

    #[PHPUnit\Test]
    public function fetchShouldCreateTheMessageAndHandleItWithTheBus(): void
    {
        $query = new stdClass();

        $this->messageCreator->expects(self::once())
                             ->method('create')
                             ->with(SampleMessage::class, $this->input)
                             ->willReturn($query);

        $this->bus->expects(self::once())
                  ->method('handle')
                  ->with($query)
                  ->willReturn('testing OK');

        self::assertSame('testing OK', $this->executeAction());
    }

    #[PHPUnit\Test]
    public function fetchShouldNotCatchExceptionsFromBus(): void
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

    #[PHPUnit\Test]
    public function fetchShouldNotCatchExceptionsFromMessageCreator(): void
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

    private function executeAction(): mixed
    {
        $action = new ExecuteQuery($this->bus, $this->messageCreator, SampleMessage::class);

        return $action->fetch($this->input);
    }
}
