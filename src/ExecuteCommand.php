<?php
declare(strict_types=1);

namespace Chimera;

/**
 * Encapsulates the execution of a command
 */
final class ExecuteCommand
{
    /**
     * @var ServiceBus
     */
    private $bus;

    /**
     * @var MessageCreator
     */
    private $messageCreator;

    /**
     * @var string
     */
    private $command;

    public function __construct(ServiceBus $bus, MessageCreator $messageCreator, string $command)
    {
        $this->bus            = $bus;
        $this->messageCreator = $messageCreator;
        $this->command        = $command;
    }

    /**
     * Creates the command with given input and executes it
     */
    public function execute(Input $input): void
    {
        $this->bus->handle(
            $this->messageCreator->create($this->command, $input)
        );
    }

    /**
     * Returns the name of the command to be handled
     */
    public function getCommand(): string
    {
        return $this->command;
    }
}
