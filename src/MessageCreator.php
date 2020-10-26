<?php
declare(strict_types=1);

namespace Chimera;

use Chimera\MessageCreator\MessageCannotBeCreated;

/**
 * Defines the public API for message (commands and queries) creation strategies
 */
interface MessageCreator
{
    /**
     * Creates an instance of given message using the provided input
     *
     * @template T of object
     *
     * @param class-string<T> $message
     *
     * @return T
     *
     * @throws MessageCannotBeCreated
     */
    public function create(string $message, Input $input): object;
}
