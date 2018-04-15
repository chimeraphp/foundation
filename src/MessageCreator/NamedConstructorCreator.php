<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\MessageCreator;

use Lcobucci\Chimera\MessageCreator;
use Psr\Http\Message\ServerRequestInterface;
use function assert;
use function is_callable;

/**
 * The most simple message creation strategy: named constructor in the message itself
 */
final class NamedConstructorCreator implements MessageCreator
{
    private const DEFAULT_CONSTRUCTOR = 'fromRequest';

    /**
     * @var string
     */
    private $methodName;

    public function __construct(string $methodName = self::DEFAULT_CONSTRUCTOR)
    {
        $this->methodName = $methodName;
    }

    public function create(string $message, ServerRequestInterface $request): object
    {
        $callback = [$message, $this->methodName];
        assert(is_callable($callback));

        return $callback($request);
    }
}
