<?php
declare(strict_types=1);

namespace Chimera\Tests\ServiceBus\ReadModelConverter;

use Chimera\ServiceBus\ReadModelConverter\Query;

final class AmazingFetchStuff implements Query
{
    public function __construct(public readonly int $id)
    {
    }

    public function conversionCallback(): callable
    {
        return [AmazingDto::class, 'fromDomain'];
    }
}
