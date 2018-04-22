<?php
declare(strict_types=1);

namespace Lcobucci\Chimera;

/**
 * Encapsulates the execution of a query
 */
final class ExecuteQuery
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
    private $query;

    public function __construct(ServiceBus $bus, MessageCreator $messageCreator, string $query)
    {
        $this->bus            = $bus;
        $this->messageCreator = $messageCreator;
        $this->query          = $query;
    }

    /**
     * Creates the query with given input, executes it, and returns the result
     *
     * @return mixed
     */
    public function fetch(Input $input)
    {
        return $this->bus->handle(
            $this->messageCreator->create($this->query, $input)
        );
    }

    /**
     * Returns the name of the query to be handled
     */
    public function getQuery(): string
    {
        return $this->query;
    }
}
