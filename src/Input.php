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
     *
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    public function getAttribute(string $name, $default = null);

    /**
     * Returns the data to be used to create the message object
     *
     * @return mixed[]
     */
    public function getData(): array;
}
