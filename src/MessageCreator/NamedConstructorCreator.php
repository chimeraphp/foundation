<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\MessageCreator;

use Lcobucci\Chimera\MessageCreator;
use Psr\Http\Message\ServerRequestInterface;
use function call_user_func;

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
        return call_user_func([$message, $this->methodName], $request);
    }
}
