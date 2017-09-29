<?php
declare(strict_types=1);

namespace Lcobucci\Chimera;

use Psr\Http\Message\ServerRequestInterface;

interface CommandBus
{
    public function handle(
        string $command,
        ServerRequestInterface $request,
        ...$extra
    ): void;
}
