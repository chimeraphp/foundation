<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\MessageCreator;

use Lcobucci\Chimera\MessageCreator;
use Psr\Http\Message\ServerRequestInterface;

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

    public function create(
        string $message,
        ServerRequestInterface $request,
        ...$extra
    ) {
        return call_user_func([$message, $this->methodName], $request, ...$extra);
    }
}
