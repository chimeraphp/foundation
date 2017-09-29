<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\Tests\ReadModelConverter;

use Lcobucci\Chimera\ReadModelConverter\Query;

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
