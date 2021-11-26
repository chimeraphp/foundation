<?php
declare(strict_types=1);

namespace Chimera;

/**
 * Abstraction for data used to create messages
 *
 * The idea is to allow us to use chimera to expose commands and queries
 * handlers regardless of the user interface used (web, cli, ...)
 */
interface Input
{
    /**
     * Returns metadata related to the input
     *
     * The metadata can be used to retrieve options or routing arguments
     */
    public function getAttribute(string $name, mixed $default = null): mixed;

    /**
     * Returns the data to be used to create the message object
     *
     * @return array<string, mixed>
     */
    public function getData(): array;
}
