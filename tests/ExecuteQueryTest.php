<?php
declare(strict_types=1);

namespace Chimera\Tests;

use Chimera\ExecuteQuery;
use Chimera\Input;
use Chimera\MessageCreator;
use Chimera\ServiceBus;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use stdClass;

/**
 * @coversDefaultClass \Chimera\ExecuteQuery
 */
final class ExecuteQueryTest extends TestCase
{
    /**
     * @var ServiceBus&MockObject
     */
    private ServiceBus $bus;

    /**
     * @var Input&MockObject
     */
    private Input $input;

    /**
     * @var MessageCreator&MockObject
     */
    private MessageCreator $messageCreator;

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
     * @covers ::getQuery()
     */
    public function getQueryShouldReturnTheNameOfTheMessageToBeExecuted(): void
    {
        $action = new ExecuteQuery($this->bus, $this->messageCreator, 'test');

        self::assertSame('test', $action->getQuery());
    }

    /**
     * @test
     *
     * @covers ::__construct()
     * @covers ::fetch()
     */
    public function fetchShouldCreateTheMessageAndHandleItWithTheBus(): void
    {
        $query = new stdClass();

        $this->messageCreator->expects(self::once())
                             ->method('create')
                             ->with('test', $this->input)
                             ->willReturn($query);

        $this->bus->expects(self::once())
                  ->method('handle')
                  ->with($query)
                  ->willReturn('testing OK');

        self::assertSame('testing OK', $this->executeAction());
    }

    /**
     * @test
     *
     * @covers ::__construct()
     * @covers ::fetch()
     */
    public function fetchShouldNotCatchExceptionsFromBus(): void
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
     * @covers ::fetch()
     */
    public function fetchShouldNotCatchExceptionsFromMessageCreator(): void
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

    /**
     * @return mixed
     */
    private function executeAction()
    {
        $action = new ExecuteQuery($this->bus, $this->messageCreator, 'test');

        return $action->fetch($this->input);
    }
}
