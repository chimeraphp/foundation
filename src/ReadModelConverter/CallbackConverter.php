<?php
declare(strict_types=1);

namespace Lcobucci\Chimera\ReadModelConverter;

use Lcobucci\Chimera\ReadModelConverter;

/**
 * A read model converter that uses a callback, if the used query object is able to provide that callback
 */
final class CallbackConverter implements ReadModelConverter
{
    public function convert($query, $result)
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
