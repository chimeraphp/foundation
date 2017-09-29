<?php
declare(strict_types=1);

namespace Lcobucci\Chimera;

use Psr\Http\Message\ServerRequestInterface;

interface QueryBus
{
    /**
     * @return mixed
     */
    public function handle(
        string $query,
        ServerRequestInterface $request,
        ...$extra
    );
}
