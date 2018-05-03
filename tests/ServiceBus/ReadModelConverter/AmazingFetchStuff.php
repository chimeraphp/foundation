<?php
declare(strict_types=1);

namespace Chimera\Tests\ServiceBus\ReadModelConverter;

use Chimera\ServiceBus\ReadModelConverter\Query;

final class AmazingFetchStuff implements Query
{
    /**
     * @var int
     */
    public $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function conversionCallback(): callable
    {
        return [AmazingDto::class, 'fromDomain'];
    }
}
