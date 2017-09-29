<?php
declare(strict_types=1);

namespace Lcobucci\Chimera;

/**
 * Defines the public API for the services that converts domain concepts into read models
 */
interface ReadModelConverter
{
    /**
     * Converts a domain object (or a list of objects) to a read model
     *
     * @param object            $query
     * @param object|array|null $result
     *
     * @return object|array|null
     */
    public function convert($query, $result);
}
