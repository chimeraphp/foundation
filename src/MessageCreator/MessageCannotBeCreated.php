<?php
declare(strict_types=1);

namespace Chimera\MessageCreator;

use Chimera\Exception;
use RuntimeException;

use function sprintf;

final class MessageCannotBeCreated extends RuntimeException implements Exception
{
    public static function forInvalidCallback(string $message, string $methodName): self
    {
        return new self(
            sprintf('The "%s::%s" callback is invalid', $message, $methodName),
        );
    }
}
