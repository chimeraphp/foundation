<?php
declare(strict_types=1);

namespace Chimera;

/**
 * Abstraction for a bus that either execute commands or queries
 */
interface ServiceBus
{
    /**
     * Processes the given message and returns the result of the operation
     */
    public function handle(object $message): mixed;
}
