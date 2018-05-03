<?php
declare(strict_types=1);

namespace Chimera\ServiceBus;

/**
 * Defines the public API for the services that converts domain concepts into read models
 */
interface ReadModelConverter
{
    /**
     * Converts a domain object (or a list of objects) to a read model
     *
     * @param object|mixed[]|null $result
     *
     * @return object|mixed[]|null
     */
    public function convert(object $query, $result);
}
