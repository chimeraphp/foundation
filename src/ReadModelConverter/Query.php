<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\ReadModelConverter;

interface Query
{
    public function conversionCallback(): callable;
}
