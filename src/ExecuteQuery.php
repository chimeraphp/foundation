<?php
declare(strict_types=1);

namespace Chimera;

use Chimera\MessageCreator\MessageCannotBeCreated;

/**
 * Encapsulates the execution of a query
 */
final class ExecuteQuery
{
    /** @param class-string $query */
    public function __construct(
        private ServiceBus $bus,
        private MessageCreator $messageCreator,
        private string $query,
    ) {
    }

    /**
     * Creates the query with given input, executes it, and returns the result
     *
     * @throws MessageCannotBeCreated
     */
    public function fetch(Input $input): mixed
    {
        return $this->bus->handle($this->messageCreator->create($this->query, $input));
    }

    /**
     * Returns the name of the query to be handled
     *
     * @return class-string
     */
    public function getQuery(): string
    {
        return $this->query;
    }
}
