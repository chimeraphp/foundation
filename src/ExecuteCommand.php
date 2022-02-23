<?php
declare(strict_types=1);

namespace Chimera;

use Chimera\MessageCreator\MessageCannotBeCreated;

/**
 * Encapsulates the execution of a command
 */
final class ExecuteCommand
{
    /** @param class-string $command */
    public function __construct(
        private readonly ServiceBus $bus,
        private readonly MessageCreator $messageCreator,
        public readonly string $command,
    ) {
    }

    /**
     * Creates the command with given input and executes it
     *
     * @throws MessageCannotBeCreated
     */
    public function execute(Input $input): void
    {
        $this->bus->handle($this->messageCreator->create($this->command, $input));
    }

    /**
     * Returns the name of the command to be handled
     *
     * @deprecated
     *
     * @return class-string
     */
    public function getCommand(): string
    {
        return $this->command;
    }
}
