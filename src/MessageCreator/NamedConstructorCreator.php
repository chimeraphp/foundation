<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\MessageCreator;

use Lcobucci\Chimera\Input;
use Lcobucci\Chimera\MessageCreator;
use function assert;
use function is_callable;

/**
 * The most simple message creation strategy: named constructor in the message itself
 */
final class NamedConstructorCreator implements MessageCreator
{
    private const DEFAULT_CONSTRUCTOR = 'fromInput';

    /**
     * @var string
     */
    private $methodName;

    public function __construct(string $methodName = self::DEFAULT_CONSTRUCTOR)
    {
        $this->methodName = $methodName;
    }

    /**
     * {@inheritdoc}
     */
    public function create(string $message, Input $input): object
    {
        $callback = [$message, $this->methodName];
        assert(is_callable($callback));

        return $callback($input);
    }
}
