<?php
declare(strict_types=1);

namespace Chimera\MessageCreator;

use Chimera\Input;
use Chimera\MessageCreator;

use function is_callable;

/**
 * The simplest message creation strategy: named constructor in the message itself
 */
final class NamedConstructor implements MessageCreator
{
    private const DEFAULT_CONSTRUCTOR = 'fromInput';

    public function __construct(private readonly string $methodName = self::DEFAULT_CONSTRUCTOR)
    {
    }

    public function create(string $message, Input $input): object
    {
        $callback = [$message, $this->methodName];

        if (! is_callable($callback)) {
            throw MessageCannotBeCreated::forInvalidCallback($message, $this->methodName);
        }

        return $callback($input);
    }
}
