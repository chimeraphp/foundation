<?php
declare(strict_types=1);

namespace Lcobucci\Chimera;

interface ReadModelConverter
{
    /**
     * @param object $query
     * @param object|array|null $result
     *
     * @return object|array|null
     */
    public function convert($query, $result);
}
