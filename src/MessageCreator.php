<?php
declare(strict_types=1);

namespace Lcobucci\Chimera;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Defines the public API for message (commands and queries) creation strategies
 */
interface MessageCreator
{
    /**
     * Creates a message from an HTTP request and extra parameters
     *
     * @param string                 $message  The class name of the message to be created
     * @param ServerRequestInterface $request  The HTTP request
     *
     * @return object
     */
    public function create(string $message, ServerRequestInterface $request);
}
