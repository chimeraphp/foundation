<?php
declare(strict_types=1);

namespace Lcobucci\Chimera;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Defines the public API for a service bus which handles messages that retrieves application data (read operations)
 */
interface QueryBus
{
    /**
     * Creates a command object, processes it, and returns the result of the operation
     *
     * @param string                 $query    The class name of the message to be created
     * @param ServerRequestInterface $request  The HTTP request
     * @param mixed                  ...$extra Extra arguments (e.g.: id to be used to create an object)
     *
     * @return mixed
     */
    public function handle(
        string $query,
        ServerRequestInterface $request,
        ...$extra
    );
}
