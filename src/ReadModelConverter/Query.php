<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\ReadModelConverter;

/**
 * Defines the public API of a query object that uses a callback to convert query results
 */
interface Query
{
    /**
     * Retrieves the callback function to be used to convert domain objects into read models
     *
     */
    public function conversionCallback(): callable;
}
