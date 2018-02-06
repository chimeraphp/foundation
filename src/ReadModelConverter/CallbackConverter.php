<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\ReadModelConverter;

use Lcobucci\Chimera\ReadModelConverter;
use function array_map;
use function is_array;

/**
 * A read model converter that uses a callback, if the used query object is able to provide that callback
 */
final class CallbackConverter implements ReadModelConverter
{
    /**
     * @param object|mixed[]|null $result
     *
     * @return object|mixed[]|null
     */
    public function convert(object $query, $result)
    {
        if (! $query instanceof Query) {
            return $result;
        }

        $converter = $query->conversionCallback();

        if (! is_array($result)) {
            return $converter($result);
        }

        return array_map($converter, $result);
    }
}
