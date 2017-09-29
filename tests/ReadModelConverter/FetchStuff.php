<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\Tests\ReadModelConverter;

final class FetchStuff
{
    /**
     * @var int
     */
    public $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
