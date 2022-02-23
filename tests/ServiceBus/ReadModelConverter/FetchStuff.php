<?php
declare(strict_types=1);

namespace Chimera\Tests\ServiceBus\ReadModelConverter;

final class FetchStuff
{
    public function __construct(public readonly int $id)
    {
    }
}
